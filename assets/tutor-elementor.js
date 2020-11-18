'use strict';
(function ($) {
	jQuery(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-curriculum.default', function ($scope, $) {
			var active_icon = $scope.find("#etlms-course-topic-active").val();
            var inactive_icon = $scope.find("#etlms-course-topic-inactive").val();
			$scope.find(".etlms-course-curriculum-title").click(function (e) {
                var $this = $(this);
                $this.parent().toggleClass('etlms-topic-active');
                $this.find('#etlms-course-topic-icon').toggleClass(active_icon+' '+inactive_icon);
				$this.parent().find(".tutor-course-lessons").animate({
					height: 'toggle'
				}, 'slow');
			});
		});
	});
})(jQuery);