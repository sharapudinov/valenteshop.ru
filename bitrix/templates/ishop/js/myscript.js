$(document).ready(function(){

	$('.ajax_img').live('hover', function(){
		var id = $(this).attr('data-num');
		var parent = $(this).parent('span');
       	$.ajax({
       		type: 'POST',
			url: "/ajax/ajax_img.php",
          	data: ({id : id}),
       		success: function(data) {
				$(parent).find('img').attr('src', data);
				$(parent).find('img').removeClass('ajax_img');
          	},
       		error:  function(xhr, str){}
     	});
		
		
		return false;
	});

	$('#sku_lineForm span').live('click', function(){
		var id_sku = $(this).attr('val');
		$('.block_price_add').css('display','none');
		$('#table_sku_' + id_sku).css('display','block');	
		$('#product_ids').val(id_sku);	
	});
	/*		$('.center_right_info a.found_descript').css('color','red');
			$('.center_right_info a.found_kompl').css('color','#000');
			$('.komplekt').css('display','none');
			$('.top_info_text').css('display','block');*/
	$('.center_right_info a.found_descript').live('click', function(){
		if($(".top_info_text").is(":hidden")){
			$(this).css('color','red');
			$('.center_right_info a.found_kompl').css('color','#000');
			$('.komplekt').css('display','none');
			$('.top_info_text').css('display','block');
		}else{
			$(this).css('color','#000');
			$('.top_info_text').css('display','none');
		}
		return false;
	});

	$('.center_right_info a.found_kompl').live('click', function(){
		if($(".komplekt").is(":hidden")){
			$(this).css('color','red');
			$('.center_right_info a.found_descript').css('color','#000');
			$('.top_info_text').css('display','none');
			$('.komplekt').css('display','block');
		}else{
			$(this).css('color','#000');
			$('.komplekt').css('display','none');
		}
		return false;
	});
	$('.lineForm span').live('click', function(){	
		var id = $(this).parents('form').attr('id');
		var form = $(this).parents('form').serialize();
       		$.ajax({
         		 type: 'POST',
				url: "/ajax/basket_empty.php",
          		data: form,
          		success: function(data) {
					$('#' + id + ' .button.add_item').removeClass('added');
					$('#' + id + ' .button.add_item').addClass(data);
					if($('#' + id + ' .button.add_item').hasClass('added')){
						$('#' + id + ' .button.add_item.added span').html('в корзине');
					}else{
						$('#' + id + ' .button.add_item span').html('в корзину');
					}
          		},
          		error:  function(xhr, str){}
     		});
	
	});
	$('.lineForm span').click();

	$('#nabor_complect .compl_checkradio, .check_select span').live('click', function(){	
		var id = $(this).parents('form').attr('id');	


		var price_sum = 0;
		$('#' + id + ' .compl_checkradio:checked').each(function (){
			var price = $(this).val();
			price = parseInt(price, 10);
			price_sum = price_sum + Number(price);
		});

		$('#' + id + ' .check_select span.cuselActive').each(function (){
			var price_val = $(this).attr('val');
			price_val = parseInt(price_val, 10);
			price_sum = price_sum + Number(price_val);
		});
       		$.ajax({
         		 type: 'POST',
				url: "/ajax/property.php",
          		data: ({id : id, price : price_sum}),
          		success: function(data) {
				$("#" + id + " .price_block").html(data);
				/*$("#" + id + " .price_id").val(data); */
          		},
          		error:  function(xhr, str){}
     		});
	});

	$('.proceed').live('click', function(){	
		$('.in_basket').fadeOut();
		return false;
	});

	$('.button_colors_block').live('click', function(){	
		var parent = $(this).parents('.colors_boxbox');
		var mas =  $(parent).find('.frame_colors_mass').html();
		var masprop =  $(parent).find('.frame_colors_mass_prop').html();
		/*$.ajax({
			type: 'POST',
			url: "/ajax/prop_img.php",
			data: ({mas : mas, masprop : masprop}),
			success: function(data) {
			alert(data);
				$(parent).find('.frame_colors').html(data);		
			},
			error:  function(xhr, str){}
		 });*/
		var col = $(this).parents('.colors_boxbox').find('.frame_colors').html();
		var i = 0;var ic = '';
		$(this).parents('.check_select').find('.cuselScrollArrows span').each(function (){
			i++;
			if($(this).is('.cuselActive')){
				ic = i;
			}
		});
		$('.olors_popup_text').html('<a class="jqmClose close"></a>' + col);
		$('.block_colors_code').css('display','none');
		$('.block_colors_code' + ic).css('display','block');	

		$('.offers_colors_popup').show();
		$('.olors_popup_text').show();

	});
	$('.offers_colors_popup').live('click', function(){	
		$('.offers_colors_popup').hide();
		$('.olors_popup_text').hide();	
	});
	$('.jqmClose.close').live('click', function(){	
		$('.offers_colors_popup').hide();
		$('.olors_popup_text').hide();	
	});
	$('.block_colors_elem').live('click', function(){
		var par_id = $(this).parents('.block_colors_code').attr('id');
		var elem = $(this).html();
		var name = $(this).find('.block_colors_elem_name').html();
		var value = $(this).find('.block_colors_elem_value').html();
		$('#but' + par_id).html('<input style="display:none;" type="radio" name="' + name + '" value="' + value + '" checked="checked"/>' + elem);	
		$('.offers_colors_popup').hide();
		$('.olors_popup_text').hide();	
	});
	/*$('.button_colors_click').live('click', function(){
		var id = $(this).attr('id');
		var idprop = $('#sel' + id).val();
       	$.ajax({
         	type: 'POST',
			url: "/ajax/colors.php",
          	data: ({id : idprop, ids : id}),
          	success: function(data) {
				$(".olors_popup_text").html(data);
          	},
          	error:  function(xhr, str){}
     	});
		
	});*/
	$('.block_colors_elem_click').live('click', function(){
		var par_id = $('.colors_blocks #id_block').val();
		var elem = $(this).html();
		
		$('#' + par_id).html(elem);
		$('.offers_colors_popup').hide();
		$('.olors_popup_text').hide();	
	});
});