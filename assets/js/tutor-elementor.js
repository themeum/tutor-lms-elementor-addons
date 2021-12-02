'use strict';
(function ($) {
	/**
	 * Course Enroll Button
	 * @since 1.0.0
	 */
	function enroll_button($scope) {
		/**
		 * if default button 
		 * add button class
		 */
		var button_type = $scope.find("#etlms_enroll_btn_type").val();
		var cart_icon = $scope.find("#etlms_enroll_btn_cart").val();

		/**
		 * find tutor-loop-cart-btn-wrap from etlms-carousel-footer
		 * remove class for setting new style
		 */
		var carousel_footer = $scope.find(".etlms-carousel-footer").find('.tutor-loop-cart-btn-wrap');

		if (carousel_footer) {
			carousel_footer.removeClass('tutor-loop-cart-btn-wrap');
			carousel_footer.addClass('etlms-loop-cart-btn-wrap');
			/**
			 * add to cart has default button class
			 * remove it
			 * make it dynamic from elementor
			 */
			if (carousel_footer.children("a").hasClass('button')) {
				carousel_footer.children("a").removeClass('button');
			};
		}

		/**
		 * if default button 
		 * add button class
		 */
		if (button_type == 'default' || button_type == 'default_with_cart_icon') {
			carousel_footer.children("a").addClass('tutor-button');
		}

		/**
		 * if cart icon set from elementor
		 * add cart icon to all button
		 */
		if (button_type == 'text_with_cart' || button_type == 'default_with_cart_icon') {

			var length = carousel_footer.length;
			var i = 0;
			for (i; i < length; i++) {

				/*
					*check if it is add to cart
					button then add cart icon
				*/
				var is_add_to_cart = carousel_footer.children("a")[i].classList.contains('add_to_cart_button');
				var added_to_cart = carousel_footer.children("a")[i].innerHTML;
				
				if(is_add_to_cart)
				{

					var text = carousel_footer.children("a")[i].innerHTML;
					carousel_footer.children("a")[i].innerHTML = `<i class="${cart_icon}" aria-hidden="true"></i> ${text}`;
				}
				
				if(added_to_cart == "View Cart")
				{
					var text = carousel_footer.children("a")[i].innerHTML;
					carousel_footer.children("a")[i].innerHTML = `<i class="${cart_icon}" aria-hidden="true"></i> ${text}`;
				}

			}
		}
	}

	jQuery(window).on('elementor/frontend/init', function () {
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

			enroll_button($scope, $);  
		});

		/**
		 * Course List
		 * @since 1.0.0
		 */
		elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-list.default', function ($scope, $) {
			enroll_button($scope, $);
		});
	});
})(jQuery);