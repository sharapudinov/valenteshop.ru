$(window).resize(function() {	$('.menu .cat_menu').width($('ul.menu').width()+7);});

$.fn.keyupDelay = function( cb, delay ){
	if(delay == null){
		delay = 1000;
	}
	var timer = 0;
	return $(this).on('keyup',function(){
		clearTimeout(timer);
		timer = setTimeout( cb , delay );
	});
}

function onLoadjqm(name, hash){

	var width = $('.'+name+'_frame').width();
	$('.'+name+'_frame').css('margin-left', '-'+width/2+'px');
	$('.'+name+'_frame').css('position', 'fixed');
	
	if( name == 'found_cheaper' ){
		$('input.item_name').val($(hash.t).attr('item-name'));
	}
	if( name == 'staff_send' ){
		$('input.staff_fio').val($(hash.t).attr('item-name'));
		$('input.staff_email').val($(hash.t).attr('item-mail'));
	}
	if( name == 'resume_send' ){
		$('input.vacancy').val($(hash.t).attr('jobs'));
	}
	
	if ( name == 'one_click_buy'){
		$('#one_click_buy_form').live('submit', function() 
		{
/*alert($(this).attr('action'));*/
			$.ajax({
				url: '/bitrix/components/aspro/oneclickbuy/script.php',
				data: $(this).serialize(),
				type: 'POST',
				dataType: 'json',
				error: function(data) { 
					alert('Error connecting server'); 
				},
				success: function(data) 
				{
					if(data.result=='Y') { $('.one_click_buy_result').show(); $('.one_click_buy_result_success').show(); } 
					else { $('.one_click_buy_result').show(); $('.one_click_buy_result_fail').show(); $('.one_click_buy_result_text').text(data.message);}
					$('.one_click_buy_modules_button', self).removeClass('disabled');
					$('#one_click_buy_form').hide();
					$('#one_click_buy_form_result').show();
				}
			});
			return false;
		});
	}
	
	if (name =='show_offer_stores'){
		$(".offers_stores_frame").css("marginLeft", -$(".offers_stores_frame").width()/2);
		
	}

	$('.'+name+'_frame').show();
}

/* ajax cart */

function UpdateCart(res){
	jsAjaxUtil.InsertDataToNode('/ajax/show_cart.php', 'basket', false);
	jsAjaxUtil.InsertDataToNode('/ajax/show_small_cart.php', 'basket_small', false);
}

function UpdateCompare(res){
	jsAjaxUtil.InsertDataToNode('/ajax/show_compare.php', 'compare', true);
	jsAjaxUtil.CloseLocalWaitWindow('wait_id', 'ajax_fade');
	$('#ajax_fade').prop('id', '');
}

function SetQuantity( div, type ){
	var count = parseFloat(div.parent().find('.text').val());
	if( type == '+' ){
		count++;
	}else if( type == '-' && count > 1 ){
		count--;
	}
	div.parent().find('.text').val(count);
}

function oneClickBuy(elementID)
{	
	$('body').append('<span class="one_click_buy_item_popup"></span>');
	$('.one_click_buy_frame').jqm({trigger: '.one_click_buy_item_popup', onLoad: function(hash){ onLoadjqm('one_click_buy', hash); }, ajax: '/ajax/one_click_buy.php?ELEMENT_ID='+elementID});
	$('.one_click_buy_item_popup').click();
}

function showOffersStores(ELEMENT_ID, MIN_AMOUNT, USE_MIN_AMOUNT, USE_STORE_SCHEDULE, USE_STORE_PHONE, STORE_PATH)
{	
	$('body').append('<span class="offers_stores_popup"></span>');
	$('.offers_stores_frame').jqm({trigger: '.offers_stores_popup', onLoad: function(hash){ onLoadjqm('show_offer_stores', hash); }, ajax: '/ajax/offer_stores.php?ELEMENT_ID='+ELEMENT_ID+'&MIN_AMOUNT='+MIN_AMOUNT+'&USE_MIN_AMOUNT='+USE_MIN_AMOUNT+'&USE_STORE_SCHEDULE='+USE_STORE_SCHEDULE+'&STORE_PATH='+STORE_PATH});
	$('.offers_stores_popup').click();
}

function addToCart(element, mode, text, type, basketAddr, element_id, sku_id){

	if( !element && !element.href ) return;
	var href = element.href;

	var button = $(element);
	button.unbind('click').removeAttr("onclick").attr("href", basketAddr).find("span").text(text);
	if (!button.hasClass("add_item")){button.text(text);}
	button.addClass("added");
	
	$('body').append('<span class="add_item_popup"></span>');
	
	if (sku_id) { $('.add_item_frame').jqm({trigger: '.add_item_popup', onLoad: function(hash){ onLoadjqm('add_item', hash); }, ajax: '/ajax/add_item.php?ELEMENT_ID='+element_id+'&SKU_ID='+sku_id}); }
	else { $('.add_item_frame').jqm({trigger: '.add_item_popup', onLoad: function(hash){ onLoadjqm('add_item', hash); }, ajax: '/ajax/add_item.php?ELEMENT_ID='+element_id}); }
	
	$('.add_item_popup').click();
	
	var quantity = button.parents(".middle_info").find("input[name=count_items]").val(); 
	if (href)
		$.get( href+"&quantity="+quantity+"&ajax_buy=1", $.proxy(
			function(data) {
				jsAjaxUtil.InsertDataToNode('/ajax/show_cart.php', 'basket', false);
				jsAjaxUtil.InsertDataToNode('/ajax/show_small_cart.php', 'basket_small', false);
			}, button)
		);
	return false;
}
function addToCart_new(element, mode, text, type, basketAddr, element_id, sku_id){

	if( !element && !element.href ) return;
	var href = element.href;

	var button = $(element);
	button.unbind('click').removeAttr("onclick").attr("href", basketAddr).find("span").text(text);
	if (!button.hasClass("add_item")){button.text(text);}
	button.addClass("added");
	
	$('body').append('<span class="add_item_popup"></span>');
	
	if (sku_id) { $('.add_item_frame').jqm({trigger: '.add_item_popup', onLoad: function(hash){ onLoadjqm('add_item', hash); }, ajax: '/ajax/add_item.php?ELEMENT_ID='+element_id+'&SKU_ID='+sku_id}); }
	else { $('.add_item_frame').jqm({trigger: '.add_item_popup', onLoad: function(hash){ onLoadjqm('add_item', hash); }, ajax: '/ajax/add_item.php?ELEMENT_ID='+element_id}); }
	
	$('.add_item_popup').click();
	
	var quantity = button.parents(".middle_info").find("input[name=count_items]").val(); 
	/*if (href)
		$.get( href+"&quantity="+quantity+"&ajax_buy=1", $.proxy(
			function(data) {
				jsAjaxUtil.InsertDataToNode('/ajax/show_cart.php', 'basket', false);
				jsAjaxUtil.InsertDataToNode('/ajax/show_small_cart.php', 'basket_small', false);
			}, button)
		);*/
		var form=$('#my_form_' + element_id).serialize();
      $.ajax({
          type: 'POST',
		  url: "/ajax/addcart_new.php?sku_id=" + sku_id,
          data: form,
          success: function(data) {
				jsAjaxUtil.InsertDataToNode('/ajax/show_cart.php', 'basket', false);
				jsAjaxUtil.InsertDataToNode('/ajax/show_small_cart.php', 'basket_small', false);
				/*alert(data); */
          }
     	});
		
	return false;
}

function addToCart_my2(element, mode, text, type, basketAddr, element_id, sku_id){
	if ( $(element).hasClass("added") ) {
		window.location.href = "/basket/";
	return false;
	}
	if( !element && !element.href ) return;
	var href = element.href;

	var button = $(element);
	button.unbind('click').find("span").text(text);
	if (!button.hasClass("add_item")){button.text(text);}
	button.addClass("added");
	
	$('body').append('<span class="add_item_popup"></span>');
	
	if (sku_id) { $('.add_item_frame').jqm({trigger: '.add_item_popup', onLoad: function(hash){ onLoadjqm('add_item', hash); }, ajax: '/ajax/add_item.php?ELEMENT_ID='+element_id+'&SKU_ID='+sku_id}); }
	else { $('.add_item_frame').jqm({trigger: '.add_item_popup', onLoad: function(hash){ onLoadjqm('add_item', hash); }, ajax: '/ajax/add_item.php?ELEMENT_ID='+element_id}); }
	
	$('.add_item_popup').click();
	
	var quantity = button.parents(".middle_info").find("input[name=count_items]").val(); 

	var form=$('#my_form_' + element_id).serialize();


      $.ajax({
          type: 'POST',
	   url: "/ajax/addcart.php",
          data: form,
          success: function(data) {
		/*jsAjaxUtil.InsertDataToNode('/ajax/show_cart.php', 'basket', false);*/
		jsAjaxUtil.InsertDataToNode('/ajax/show_small_cart.php', 'basket_small', false);
		var in_b = $("#my_form_" + element_id + " .price_block span").html();
		$('.in_basket .price span').html(in_b);
		/*alert(data);*/
          },
          	error:  function(xhr, str){
				/*jsAjaxUtil.InsertDataToNode('/ajax/show_cart.php', 'basket', false);
				jsAjaxUtil.InsertDataToNode('/ajax/show_small_cart.php', 'basket_small', false);*/

          }
     	});
	return false;
}

function addToSubscribe(element, text){
	var href = element.href;
	if (href)
		$.get(href, function() {
		});
	return false;
}

function addToCompare(element, mode, deleteUrl) {
	if (!element && !element.href) return;
	var href = element.href;
	var button = $(element);
	if( mode == 'list' )
	{
		//var removeCompare = '<input type="checkbox" class="addtoCompareCheckbox"/ checked><span class="checkbox_text">'+text+'</span>';
		//button.html(removeCompare);
		//button.attr("href", deleteUrl);
		//button.attr("onclick", "return deleteFromCompare(this, \'"+mode+"\', \'"+text+"\', \'"+href+"\');");
	}
	else if( mode == 'detail' )
	{
		button.attr("href", deleteUrl);
		button.addClass('active');
		button.attr("onclick", "return deleteFromCompare(this, \'"+mode+"\', \'"+href+"\');");
	}
	if (href)
		$.get( href + '&ajax_compare=1', $.proxy(
			function(data) {
				jsAjaxUtil.InsertDataToNode('/ajax/show_compare.php', 'compare', true);
			}, button )
		);
	return false;
}

function deleteFromCompare(element, mode, addUrl) {
	if (!element && !element.href) return;
	var href = element.href;
	var button = $(element);
	if( mode == 'list' )
	{
		//var removeCompare = '<input type="checkbox" class="addtoCompareCheckbox"/ checked><span class="checkbox_text">'+text+'</span>';
		//button.html(removeCompare);
		//button.attr("href", deleteUrl);
		//button.attr("onclick", "return deleteFromCompare(this, \'"+mode+"\', \'"+text+"\', \'"+href+"\');");
	}
	else if( mode == 'detail' )
	{
		button.attr("href", addUrl);
		button.removeClass('active');
		button.attr("onclick", "return addToCompare(this, \'"+mode+"\', \'"+href+"\');");
	}
	if (href)
		$.get( href + '&ajax_compare=1', $.proxy(
			function(data) {
				jsAjaxUtil.InsertDataToNode('/ajax/show_compare.php', 'compare', true);
			}, button )
		);
	return false;
}

$(document).ready(function() {
			
	$('.table_item img').load(function(){
		var w = $(this).width();
		if( w % 2 == 1 ){
			$(this).css('width', w+1+'px');
		}
	});
	
	$('.menu .cat_menu').width($('ul.menu').width()+7);
	
	$('.group_item .image').each(function(){
		//console.log($(this).height());
		//$(this).css('width', $(this).css('height'))
	})
	
	 $('.flexslider').flexslider({
		animation: "slide",
		slideshow: true,
		slideshowSpeed: 10000,
		animationSpeed: 600,
		directionNav: false
	});
	
	$.elastislide.prototype._setCurrentValues = function(){
		// the total space occupied by one item
		this.itemW			= this.$items.outerWidth(true);
		
		// total width of the slider / <ul>

		// this will eventually change on window resize
		this.sliderW		= this.itemW * this.itemsCount;
		
		// the ul parent's (div.es-carousel) width is the "visible" width
		this.visibleWidth	= this.$esCarousel.width();
		
		var b_w = this.visibleWidth;
		var b_c = Math.floor(b_w / 185);
		var b_w_n = Math.floor(this.visibleWidth / b_c);
		
		this._setDim(b_w_n);
		
		// how many items fit with the current width
		this.fitCount		= Math.floor( this.visibleWidth / this.itemW );
	}
	
	var b_w = $('.brands_list').width();
	var b_c = Math.floor(b_w / 185);
	var b_w_n = $('.brands_list').width() / b_c;
	
	$('.brands_list').elastislide({
		margin: 0,
		imageW: b_w_n,
		border: 0,
		min_imageW: 185
	});
	
	$('.news_wr .tabs i').click(function(){
		left = $(this).attr('id').replace('tab','');
		//console.log(left);
		$(".news_cols ul").css('left',-left);
		$('.news_wr .tabs i').removeClass('active');
		$(this).addClass('active');
	});

	$('.fancy').fancybox();
	
/* popup */
	$('.found_cheaper_frame').jqm({trigger: '.found_cheaper', onLoad: function(hash){ onLoadjqm('found_cheaper', hash); }, ajax: '/ajax/form_found_cheaper.php'});
	$('.staff_send_frame').jqm({trigger: '.staff_send', onLoad: function(hash){ onLoadjqm('staff_send', hash); }, ajax: '/ajax/form_staff_send.php'});
	$('.resume_send_frame').jqm({trigger: '.resume_send', onLoad: function(hash){ onLoadjqm('resume_send', hash); }, ajax: '/ajax/form_resume_send.php'});
	$('.compare_frame').jqm({trigger: '.go_to_compare', onLoad: function(hash){ onLoadjqm('compare', hash); }, ajax: '/ajax/show_compare_list.php'});
	
/* breadcrumb */
	$('.drop_section .name').mouseover( function(){
		$(this).parent().find('.section_list').show();
	});
	
	$('.drop_section .section_list').mouseleave( function(){
		$(this).hide();
	});

/* show number */
	
	$('.drop_number .number').mouseover( function(){
		$(this).parent().find('.number_list').show();
	});
	
	$('.drop_number .number_list').mouseleave( function(){
		$(this).hide();
	});
	
/* compare */
	
	/*$('.compare .link').toggle(function(e){
		e.preventDefault();
		$('.compare_list').show();
	},function(e){
		e.preventDefault();
		$('.compare_list').hide();
	})
	
	$('.compare_list a.close').live('click', function(e){
		e.preventDefault();
		$('.compare_list').hide();
	})*/
	
/* wish item */
	
	$('.wish_item').live( 'click', function(e){
		if( !$(this).attr('href') ) return;
		e.preventDefault();
		var href = $(this).attr('href');
		$(this).unbind('click').removeAttr("href");
		$(this).closest('.item_ws').prop('id', 'ajax_fade');
		var item_id = href;
		item_id = item_id.substring(1);
		
		var wish = '';
		
		if( $(this).hasClass('active') ){
			$(this).removeClass('active');
			wish = 'N';
		}else{
			$(this).addClass('active');
			wish = 'Y';
		}
		
		data = {
			"item_id" : item_id,
			"wish_item" : wish
		};
		
		BX.ajax.post(
			'/ajax/item.php',
			data,
			function(res){ setTimeout( UpdateCart(res), 1000 ); }
		)
	})
	
/* item detail */
	$('.slides').mouseover(function(){
		$(this).find('span.lupa').show();
	})
	$('.slides').mouseout(function(){
		$(this).find('span.lupa').hide();
	})
	
	$('.counter_block input').keypress(function(event){
		var key, keyChar;
		if(!event) var event = window.event;
		if (event.keyCode) key = event.keyCode;
		else if(event.which) key = event.which;
		if(key == null || key == 0 || key == 8 || key == 13 || key == 9 || key == 46 || key == 37 || key == 39 ) return true;
		keyChar = String.fromCharCode(key);
		if(!/\d/.test(keyChar)) return false;
	});
	
	$('.counter_block input').live('change', function(){
		if( $(this).val() == '0' ){ $(this).val(1); }
	})
	
/* thumbs */
	$('.slides li').not('.current').hide();
	$('.thumbs li a').live("click", function(e){
		e.preventDefault();
		$('.thumbs li').removeClass('current');
		$(this).closest('li').toggleClass('current');
		$('.slides li').hide();
		$('.slides li'+$(this).attr('href')).show();
	});
	
/* tabs */
	$('.add_review').live('click', function(){
		$('.tabs_section ul.tabs li#reviews').click();
	} )
	
	$('.tabs_section ul.tabs').delegate('li:not(.current)', 'click', function(e){
		e.preventDefault();
		$(this).addClass('current').siblings().removeClass('current')
		.parents('.tabs_section').find('.box').eq($(this).index()).fadeIn(100).siblings('.box').hide();
	})
	
/* accordion */
	$('.accordion_list .item_list').hide().first().show();
	$('.accordion_list .item_name').live('click', function(e){
		e.preventDefault();
		$(this).next('.item_list').slideToggle();
	})
	
/* staff */
	
	$('.item_jobs .down').live('click', function(e){
		e.preventDefault();
		$(this).closest('.item_jobs').find('.detail_text').show().closest('.item_jobs').find('.up').show();
		$(this).hide();
	})
	
	$('.item_jobs .up').live('click', function(e){
		e.preventDefault();
		$(this).closest('.item_jobs').find('.detail_text').hide().closest('.item_jobs').find('.down').show();
		$(this).hide();
	})
	
/* faq */
	$('.item_faq:not(.show) .name').toggle(function(){
		$(this).closest('.item_faq').find('.text').show();
	},function(){
		$(this).closest('.item_faq').find('.text').hide();
	})
	
	$('.item_faq.show .name').toggle(function(){
		$(this).closest('.item_faq').find('.text').hide();
	},function(){
		$(this).closest('.item_faq').find('.text').show();
	})
	
/* plus minus */
	
	$('.counter_block .plus').live('click', function(){
		SetQuantity($(this), '+');
	})

	$('.counter_block .minus').live('click', function(){
		SetQuantity($(this), '-');
	})
	
/* differences */
	
	$('.differences .left_arrow, .differences .right_arrow').live("click", function(){
	
		var pos_start = $('input[name$="start_position"]').val();
		var pos_end = $('input[name$="end_position"]').val();
	
		var count_items = $('.differences td.item_td').length;

		if( $(this).hasClass('inc') && pos_end < count_items ){
			$('input[name$="start_position"]').val(++pos_start);
			$('input[name$="end_position"]').val(++pos_end);
		}else if( $(this).hasClass('dec') && pos_start > 1 ){
			$('input[name$="start_position"]').val(--pos_start);
			$('input[name$="end_position"]').val(--pos_end);
		}
		
		$('.differences td.item_td').each(function(){
			var index = $(this).index();
			if( index < pos_start || index > pos_end ){
				$(this).hide();
			}else{
				$(this).show();
			}
		})
		
		$('.differences td.prop_item').each(function(){
			var index = $(this).index();
			if( index < pos_start || index > pos_end ){
				$(this).hide();
			}else{
				$(this).show();
			}
		})
		
	});
	
	/*Таблица сравнения*/
	
	/*Удаление элемента из сравнения*/

	$('.differences .remove_item a').live("click", function(e){
		e.preventDefault();
		
		var query = $(this).attr('href').split('?');
		var query_all = query[1].split('&');
		
		var query_item = query_all[0].split('=');
		
		$.post(
			'/ajax/add_to_compare.php?add='+query_item[1],
			function(data){
				var index = $('.differences td.item_td.item_'+query_item[1]).index();
				var count_items = $('.differences td.item_td').length;

				for( var i = index+1; i <= count_items; i++ ){
					if( $('.differences td.item_td').eq(i).css("display") == 'none' ){
						$('.differences td.item_td').eq(i).show();
						break;
					}
				}
				
				var count_props = $('.differences tr.hovered').length;
				
				for( var i = 1; i <= count_props; i++ ){
					for( var j = index+1; j <= count_items; j++ ){
						if( $('.differences tr.prop_'+i+' td.prop_item').eq(j).css("display") == 'none' ){
							$('.differences tr.prop_'+i+' td.prop_item').eq(j).show();
							break;
						}
					}
				}
				$('.differences td.item_'+query_item[1]).remove();
				
				if( $('.differences td.item_td').length == 0 ){
					$('.differences').html('<p><font style="color: green">Список сравниваемых элементов пуст.</font></p>');
				}
			}
		)
	});
	
	/*Удаление элемента из сравнения*/
	
	$('.mini-menu li').toggle(function(){
		$('.mini-menu').css('margin-bottom', '0')
		$('ul.menu').addClass('visible-menu');
		$('ul.menu').removeClass('hidable-menu');
	}, function(){
		$('.mini-menu').css('margin-bottom', '17px')
		$('ul.menu').addClass('hidable-menu');
		$('ul.menu').removeClass('visible-menu');
	})
});