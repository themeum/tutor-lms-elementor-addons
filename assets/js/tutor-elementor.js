'use strict';
(function ($) {

	jQuery(window).on('elementor/frontend/init', function () {

		elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-thumbnail.default', function ($scope, $) {
			// remove course play and spining class
			if (etlmsUtility.is_editor_mode) {
				const coursePlayers = document.querySelectorAll('.course-players');
				if (coursePlayers.length) {
					coursePlayers.forEach( (player) => {
						player.setAttribute('class', '');
						const spinner = player.querySelector('.loading-spinner');
						if (spinner) {
							spinner.setAttribute('class', '');
						}
					})	
				}
			}
		});
		/**
		 * Course Curriculum
		 * @since 1.0.0
		 */
		elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-curriculum.default', function ($scope, $) {
			if (etlmsUtility.is_editor_mode) {
				const accordionItemHeaders = document.querySelectorAll('.tutor-accordion-item-header');
				if (accordionItemHeaders) {
					accordionItemHeaders.forEach((accordionItemHeader) => {
						accordionItemHeader.addEventListener('click', () => {
							accordionItemHeader.classList.toggle('is-active');
							const accordionItemBody = accordionItemHeader.nextElementSibling;
							if (accordionItemHeader.classList.contains('is-active')) {
								accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + 'px';
							} else {
								accordionItemBody.style.maxHeight = 0;
							}
						});
					});
				}
			}
		});
		elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-content.default', function ($scope, $) {
			if (etlmsUtility.is_editor_mode) {
				const accordionItemHeaders = document.querySelectorAll('.tutor-accordion-item-header');
				if (accordionItemHeaders) {
					accordionItemHeaders.forEach((accordionItemHeader) => {
						accordionItemHeader.addEventListener('click', () => {
							accordionItemHeader.classList.toggle('is-active');
							const accordionItemBody = accordionItemHeader.nextElementSibling;
							if (accordionItemHeader.classList.contains('is-active')) {
								accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + 'px';
							} else {
								accordionItemBody.style.maxHeight = 0;
							}
						});
					});
				}
			}
		});

		/**
		 * Course Carousel
		 * @since 1.0.0
		 */
		elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-carousel.default', function ($scope, $) {
			/**
			 * get all carousel settings
			 */
			var desktop = $scope.find("#etlms_carousel_settings").attr('desktop');
			var medium = $scope.find("#etlms_carousel_settings").attr('medium');
			var mobile = $scope.find("#etlms_carousel_settings").attr('mobile');
			var carousel_arrows = $scope.find("#etlms_carousel_settings").attr('arrows');
			var carousel_dots = $scope.find("#etlms_carousel_settings").attr('dots');
			var carousel_transition = $scope.find("#etlms_carousel_settings").attr('transition');
			var carousel_center = $scope.find("#etlms_carousel_settings").attr('center');
			var smooth_scroll = $scope.find("#etlms_carousel_settings").attr('smoth_scroll');
			var carousel_autoplay = $scope.find("#etlms_carousel_settings").attr('auto_play');
			var carousel_auto_play_speed = $scope.find("#etlms_carousel_settings").attr('auto_play_speed');
			var carousel_infinite_loop = $scope.find("#etlms_carousel_settings").attr('infinite_loop');
			var carousel_pause_on_hover = $scope.find("#etlms_carousel_settings").attr('pause_on_hover');
		

			carousel_arrows == 'yes' ? carousel_arrows = true : carousel_arrows = false;
			carousel_dots == 'yes' ? carousel_dots = true : carousel_dots = false;
			carousel_transition = Number(carousel_transition);
			carousel_center == 'yes' ? carousel_center = true : carousel_center = false;
			carousel_autoplay == 'yes' ? carousel_autoplay = true : carousel_autoplay = false;
			Number(carousel_auto_play_speed);
			carousel_infinite_loop == 'yes' ? carousel_infinite_loop = true : carousel_infinite_loop = false;
			carousel_pause_on_hover == 'yes' ? carousel_pause_on_hover = true : carousel_pause_on_hover = false;
			
			/**
			 * applying all settings here
			 */
			$scope.find('#etlms-slick-responsive').slick({
				dots: carousel_dots,
				arrows: carousel_arrows,
				infinite: carousel_infinite_loop,
				autoplay: carousel_autoplay,
				autoplaySpeed: carousel_auto_play_speed,				
				slidesToShow: Number(desktop),
				slidesToScroll: 1,
				speed: carousel_transition,
				centerMode: carousel_center,
				pauseOnHover: carousel_pause_on_hover,

				cssEase: smooth_scroll,

				prevArrow: $scope.find('.etlms-carousel-arrow-prev'),
				nextArrow: $scope.find('.etlms-carousel-arrow-next'),

				rtl: elementorFrontend.config.is_rtl ? true : false,

				responsive: [
					{
						breakpoint: 1024,
						settings: {
							slidesToShow: Number(medium),
							slidesToScroll: 1,
							infinite: true,
							dots: true
						}
					},
					{
						breakpoint: 576,
						settings: {
							slidesToShow: Number(mobile),
							slidesToScroll: 1
						}
					}
				]
			});

		});

	});
})(jQuery);