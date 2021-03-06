(function($) {

    'use strict';

    // Extend core script
    $.extend($.nmTheme, {

        /**
         *	Initialize cart scripts
         */
        cart_init: function() {
            var self = this;


            // Init quantity buttons
            if ($('body').hasClass('woocommerce-cart')) {
                self.quantityInputsBindButtons($('.woocommerce'));
            }
            /* Bind: Update-cart button */
            /*self.$document.on('click', '#jws-cart-update-button', function() {
                self.cartTriggerUpdate();
            });*/


            /* Bind: "added_to_cart" event (products can be added via cross sells) */
            self.$body.on('added_to_cart', function() {
                // Is the quick-view visible?
                if ($('#jws-quickview').is(':visible')) {
                    self.cartTriggerUpdate();
                }
            });


            /* Coupon - Bind: Coupon toggle button */
            $('#jws-coupon-btn').bind('click', function(e) {
                e.preventDefault();

                $(this).next('.jws-coupon').slideToggle('slow');
            });


            /* Coupon - Bind: "Apply coupon" button */
            $('#jws-apply-coupon-btn').bind('click', function(e) {
                e.preventDefault();

                var couponInputVal = $('#jws-coupon-code').val();

                if (couponInputVal && couponInputVal.length > 0) {
                    var $woocommerceCouponField = $('#coupon_code');

                    // Add coupon code to original WooCommerce coupon field
                    $woocommerceCouponField.val(couponInputVal);
                    // Trigger "click" event on original WooCommerce "Apply coupon" button to submit form
                    $woocommerceCouponField.next('.button').trigger('click');

                    // Scroll to page top (so loading-overlay and notice is visible)
                    setTimeout(function() {
                        $('html, body').animate({
                            'scrollTop': 0
                        }, self.shopScrollSpeed);
                    }, 200);
                }
            });
        },


        /**
         *	Trigger update button
         */
        cartTriggerUpdate: function() {
            // Get original update button
            var $wooUpdateButton = $('div.woocommerce > form input[name="update_cart"]');

            // Remove "disabled" state/attribute
            $wooUpdateButton.prop('disabled', false);

            // Trigger "click" event
            setTimeout(function() { // Use a small timeout to make sure the element isn't disabled
                $wooUpdateButton.trigger('click');
            }, 100);
        }

    });

    // Add extension so it can be called from $.nmThemeExtensions
    $.nmThemeExtensions.cart = $.nmTheme.cart_init;

})(jQuery);