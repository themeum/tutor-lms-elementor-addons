'use strict';
(function ($) {
jQuery(window).on('elementor/frontend/init', function(){
	elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-curriculum.default',function ($scope, $) {

			//var active_icon = $("#etlms-course-topic-active").val();
			var active_icon = $scope.find("#etlms-course-topic-active").val();
			var inactive_icon = $scope.find("#etlms-course-topic-inactive").val();
		  	$scope.find(".etlms-course-curriculum-title").click(function(){
		  	
		    $scope.find(".tutor-course-topic").toggleClass('etlms-topic-active');
		    if($scope.find('.etlms-topic-active').length)
		    {
		    	$scope.find('#etlms-course-topic-icon').removeClass(active_icon).addClass(inactive_icon);
		    }
		    else
		    {
		    	$scope.find('#etlms-course-topic-icon').removeClass(inactive_icon).addClass(active_icon);
		    }
		    $scope.find(".tutor-course-lessons").animate({
		    	height:'toggle'
		    },'slow');
		  });

		});
});
})(jQuery);


