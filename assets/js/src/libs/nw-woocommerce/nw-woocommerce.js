/***
* GENERAL WOOCOMMERCE FUNCTIONALITY
***/

jQuery(document).ready(function ($) {


	if ($(".cart-count").length > 0){
		if ($(".cart-count").html() == '0' || $(".cart-count").html() == '') {
			$(".cart-count").css({'display':'none'});
		} else {
			$(".cart-count").css({'display':'inline-block'});
		}
	}

	//onload
	// updateNumberInputUI();
	updateCartTableLayout();


	// on cart page if page updated via ajax, need to recall the onload functions
	$(document.body).on('updated_cart_totals', function(){
		// updateNumberInputUI();
		updateCartTableLayout();
	});

	/***
	* NUMBER INPUT UI
	***/
	// function updateNumberInputUI() {
	// 	$('input[type="number"]').wrap('<div class="nw-quantity"></div>');
	// 	$('<div class="quantity-nav"><span class="quantity-button quantity-up">+</span><span class="quantity-button quantity-down">-</span></div>').insertAfter('input[type="number"]');
	// 	$('.nw-quantity').each(function () {
	// 		var spinner = $(this),
	// 				input = spinner.find('input[type="number"]'),
	// 				btnUp = spinner.find('.quantity-up'),
	// 				btnDown = spinner.find('.quantity-down'),
	// 				min = (input.attr('min')) ? input.attr('min') : 0,
	// 				max = (input.attr('max')) ? input.attr('max') : 100;
	//
	// 		btnUp.click(function () {
	// 			var oldValue = parseFloat(input.val());
	// 			if (oldValue >= max) {
	// 				var newVal = oldValue;
	// 			} else {
	// 				var newVal = oldValue + 1;
	// 			}
	// 			spinner.find("input").val(newVal);
	// 			spinner.find("input").trigger("change");
	// 		});
	//
	// 		btnDown.click(function () {
	// 			var oldValue = parseFloat(input.val());
	// 			if (oldValue <= min) {
	// 				var newVal = oldValue;
	// 			} else {
	// 				var newVal = oldValue - 1;
	// 			}
	// 			spinner.find("input").val(newVal);
	// 			spinner.find("input").trigger("change");
	// 		});
	//
	// 	});
	// }


	/***
	* CART TABLE LAYOUT UPDATES
	***/
	function updateCartTableLayout() {
		// move product title to above thumbnail
		$('.woocommerce-cart table.cart th.product-thumbnail').html($('.woocommerce-cart table.cart th.product-name').html());
		$('.woocommerce-cart table.cart th.product-name').html('&nbsp');

		// move 'remove' col contents to below product link
		$('.woocommerce-cart table.cart tbody tr').each(function(index, element) {
			$(this).find('.product-name').append('<div>'+$(this).find('.product-remove').html()+'</div>');
		});

		// disable number input on product child items
		$('.woocommerce-cart table.cart .pewc-child-product input[type="number"]').attr('readonly', 'readonly');
	}


	/***
	* SHOP BY PRODUCT PAGE
	***/
	if ($('.shop-by-product-form').length > 0) {

		setFormAction();
		$('.shop-by-product-form select').change(function(){
			setFormAction();
			$('.shop-by-product-form-submit').submit();
		});

		function setFormAction() {
			var $newAction = $('.shop-by-product-form').data('action')+$('.shop-by-product-form select').find('option:selected').val();
			$('.shop-by-product-form-submit').attr('action', $newAction);
		}
	}


});
