jQuery(document).ready(function($) {
	
	//product tabs
	jQuery('#product-tab a').on('click',function (e) { 
		var prodcutTabA = jQuery(this);
		if(!prodcutTabA.parent('li').hasClass('active')){
			var prodcutTabHref = prodcutTabA.attr('href').substr(1);
			prodcutTabA.parent('li').addClass('active');
			prodcutTabA.parent('li').siblings().removeClass('active');
			jQuery('#'+prodcutTabHref).addClass('active');
			jQuery('#'+prodcutTabHref).siblings().removeClass('active');
		}
		return false;
	});
	
	//show shipping calculator box in Cart page
	if(jQuery('.shipping-calculator-form').length){
		
		jQuery('.shipping-calculator-form').siblings('h4.lined-heading').css('cursor','pointer');
		
		jQuery('.shipping-calculator-form').siblings('h4.lined-heading').click(function(){
		
			jQuery(".shipping-calculator-form").slideToggle(500, function() {
				if (jQuery(this).is(":visible")) {
					
				}
			});
		
		})
		
	}
	
	//Close Login form box
	jQuery('.modal-header').find('button').click(function(){
	
		if(jQuery('#login-form,#modal-mask').hasClass('in')){
		
			jQuery('#login-form,#modal-mask').removeClass('in').addClass('out');
		
		}
	
	});
	//open Login formbox
	jQuery('.show-login').click(function(){
	
		if(!jQuery('#login-form,#modal-mask').hasClass('in')){
		
			jQuery('#login-form,#modal-mask').addClass('in').removeClass('out');
			jQuery('#login-form').find('form').show(300);
		
		}
	
	});
	
	jQuery('.quantity input[type=\"number\"]').each(function() {
		var number = $(this),
			newNum = jQuery(jQuery('<div />').append(number.clone(true)).html().replace('number','text')).insertAfter(number);
			number.remove();
	});

	jQuery('.woocommerce-product-rating').each(function() { 
		jQuery(this).appendTo('.price');

	});
	
	if(jQuery('#payment .payment_methods').length){
		jQuery('.payment_methods > li').each(function(){
			jQuery(this).find('input.input-radio').click('click', function(){
				console.log('s');
			});
		});
	}
});

jQuery('.woocommerce-message').find('.button').removeClass('button').addClass('ux-btn');