'use strict';
(function ($) {
jQuery(window).on('elementor/frontend/init', function(){

    /*
      *elementor js hook
    */
    elementorFrontend.hooks.addAction('frontend/element_ready/etlms-course-carousel.default',function ($scope, $) {

        /*
          *get button type 
          *get cart icon 
        */  
        var button_type = $scope.find("#etlms_enroll_btn_type").val();
        var cart_icon = $scope.find("#etlms_enroll_btn_cart").val();

        /*
          *find tutor-loop-cart-btn-wrap from etlms-carousel-footer
          *remove class for setting new style
        */
        var carousel_footer = $scope.find(".etlms-carousel-footer").find('.tutor-loop-cart-btn-wrap');

        if(carousel_footer)
        {
          carousel_footer.removeClass('tutor-loop-cart-btn-wrap');
          carousel_footer.addClass('etlms-loop-cart-btn-wrap');

          /*
            *add to cart has default button class
            *remove it
            *makte it dynamic from elementor
          */
          if(carousel_footer.children("a").hasClass('button'))
            {
                carousel_footer.children("a").removeClass('button');
            };
        }

        /*
          *if default button 
          *add button class
        */
        if(button_type =='default' || button_type =='default_with_cart_icon')
        {     

          carousel_footer.children("a").addClass('tutor-button');
        }
        
        /*
          *if cart icon set from elementor
          *add cart icon to all button
        */
        if(button_type =='text_with_cart' || button_type =='default_with_cart_icon')
        {
            var length = carousel_footer.length;
            var i = 0;
            for(i; i<length; i++)
            {
              var text = carousel_footer.children("a")[i].innerHTML;
              carousel_footer.children("a")[i].innerHTML = `<i class="${cart_icon}" aria-hidden="true"></i> ${text}`;              
            }


        }  
    

    });
});
})(jQuery);


