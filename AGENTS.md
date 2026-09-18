# Tutor LMS Elementor Addons — agent notes

WordPress plugin that registers **Tutor LMS widgets** inside Elementor so course (and bundle) pages can be designed in the Elementor editor.

- **Plugin file:** `tutor-lms-elementor-addons.php`
- **Version:** keep in sync across the plugin header, `ETLMS_VERSION`, and `readme.txt` Stable tag.
- **Text domain:** `tutor-lms-elementor-addons`
- **PHP namespace (plugin core):** `TutorLMS\Elementor`
- **PHP namespace (widgets):** `TutorLMS\Elementor\Addons`
- **Requires:** WordPress 5.3+, PHP 7.4+, Tutor LMS **≥ 4.0.0**, Elementor loaded (`elementor/loaded`). Bundle widgets also need **Tutor Pro**.

This plugin does **not** implement LMS business logic. It wraps Tutor course/bundle data as Elementor widgets and templates. Prefer Tutor APIs (`tutor()`, `tutor_utils()`, `function_exists( 'tutor_lms' )`) over duplicating core.

## Boot sequence

`plugins_loaded` → `elementor_tutor_lms_init()`:

1. Always load `classes/ManageDependency.php`.
2. If Tutor (`tutor_lms`) **or** Elementor is missing → `classes/Installer.php` (admin notices + install/activate AJAX). **Do not** load widgets.
3. Else if Tutor exists but version **<** `ETLMS_TUTOR_CORE_REQ_VERSION` (`4.0.0`) → admin notice via `ManageDependency::show_admin_notice()`. Version is read from `wp-content/plugins/tutor/tutor.php`, not from a constant on a possibly-old Tutor.
4. Else → `classes/Base.php` singleton: i18n, helpers, Elementor category `tutor_addons_category` (label **Tutor LMS**), then `AddonsManager`, `AssetsManager`, `Template`. Fires `tutor_elementor_addons_loaded`.

Temporary workaround in the bootstrap file: on `save_post_course-bundle` priority 9, if the request is Elementor AJAX (`action=elementor_ajax`), strip other `save_post_course-bundle` callbacks so bundle saves from the editor do not collide. Comment says this should move to a bundle addon later — do not “fix” by deleting it without a replacement.

## Constants

| Constant | Meaning |
| --- | --- |
| `ETLMS_VERSION` | Plugin version |
| `ETLMS_TUTOR_CORE_REQ_VERSION` | Minimum Tutor LMS version |
| `ETLMS_FILE__` / `ETLMS_BASENAME` | Main file / basename |
| `ETLMS_DIR_PATH` / `ETLMS_DIR_URL` | Plugin path / URL |
| `ETLMS_TEMPLATE` | `templates/course/` |
| `ETLMS_ASSETS` | URL to `assets/` (trailing slash) |

Always `defined( 'ABSPATH' )` (or `die()`) at the top of PHP files.

## Directory map

```
tutor-lms-elementor-addons.php   Bootstrap + constants + init
classes/                         Runtime: Base, AddonsManager, AssetsManager, Template, Installer, ManageDependency, AddonsTrait
includes/functions.php           etlms_get_template(), camel2dashed(), editor course/bundle setup helpers
includes/addons/                 One widget class per file; Base.php = BaseAddon
templates/                       PHP markup widgets include; course/list and course/carousel skins
templates/single-course-*.php    Front templates swapped in via template_include
assets/                          Built CSS/JS; SCSS sources under assets/scss/
assets/layout/*.json             Default Elementor layouts (course + bundle)
```

Gulp (`npm run watch` / `npm run build`) compiles SCSS to `assets/css/*.min.css`, runs `makepot`, and can zip a release. Edit SCSS, not only the minified CSS.

## Adding or changing a widget

1. Create `includes/addons/{PascalCase}.php` in namespace `TutorLMS\Elementor\Addons`.
2. Extend `BaseAddon` (`includes/addons/Base.php`). Widget `get_name()` becomes `etlms-` + dashed class name (`CourseTitle` → `etlms-course-title`). Category is always `tutor_addons_category`.
3. Implement `get_title()`, `register_content_controls()` (optional), and **required** `register_style_controls()`.
4. Reuse `TutorLMS\Elementor\AddonsTrait` for shared layout/alignment control arrays (`etlms_layout`, `etlms_alignment`, …). Those expect static `$prefix_class_layout` / `$prefix_class_alignment` on the widget.
5. Register the class key in `AddonsManager::get_all_addons()`:
   - Course widgets → `$default_addon`
   - Bundle widgets → `$pro_addon` (merged only if `tutor-pro/tutor-pro.php` is active)
6. Markup lives in `templates/`. Load with `etlms_get_template( 'course/foo' )` (dots become directory separators). Filters: `etlms_template_dir`, `etlms_get_template_path`.
7. Frontend strings: `__()` / `esc_html_e()` with text domain `tutor-lms-elementor-addons`.

**CourseDescription special case:** if the current post is a Tutor course **and** the document is built with Elementor, `CourseDescription` is **unregistered** to avoid `the_content` recursion. Do not “restore” it on Elementor-built single courses without addressing that.

## Templates vs per-course Elementor documents

`classes/Template.php` filters `template_include` (priority 100):

- Single **course** (`tutor()->course_post_type`): if the course is Elementor-built **or** a published Elementor library post is marked as Tutor single template (`_tutor_lms_elementor_template_id`), load `templates/single-course-fullwidth.php`, or `single-course-canvas.php` when the template slug is `elementor_canvas`.
- Single **bundle** (`course-bundle`): same idea with `templates/single-course-bundle.php`. Requires `post_type_supports( 'course-bundle', 'elementor' )`.
- If Tutor option `student_must_login_to_view_course` is on and the user is logged out, return Tutor’s login template.
- Content: course/bundle built with Elementor → `the_content()`; otherwise render the shared library template via `Plugin::instance()->frontend->get_builder_content_for_display( $template_id )`.

New Elementor library templates can be flagged **Tutor LMS Single Course Template** (checkbox on Elementor’s create-template dialog → post meta).

In the Elementor editor, `setup_course_data()` / `setup_bundle_data()` / `etlms_get_bundle()` load a sample published course/bundle for the current author so widgets have `$post` context.

## Assets

`AssetsManager`: editor icons + default layout injection; frontend Slick carousel, Font Awesome shim, `tutor-elementor` CSS/JS. Version all enqueues with `ETLMS_VERSION`.

## Conventions for agents

- Match existing widget style: Elementor `Controls_Manager`, group typography, `prefix_class` for layout/align.
- Do not bootstrap widgets if Tutor or Elementor is missing.
- Do not put bundle widgets in `$default_addon`; they are Pro-gated.
- Course post type is `tutor()->course_post_type`, not a hardcoded `courses` string (except where this plugin already hardcodes `course-bundle`).
- Prefer small, file-local changes. Do not refactor Installer/Template unless the task requires it.
- After PHP/UI changes, check Elementor editor (widget in **Tutor LMS** category) and a front single course/bundle that uses the widget.
- Docs: https://docs.themeum.com/tutor-lms/elementor-integration/
