<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>
<!--noindex-->
	<div class="filter_block">


		<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
			<?foreach($arResult["HIDDEN"] as $arItem){?>
				<input type="hidden" name="<?=$arItem["CONTROL_NAME"]?>" id="<?echo $arItem["CONTROL_ID"]?>" value="<?echo $arItem["HTML_VALUE"]?>" />
			<?}?>
			<?foreach($arResult["ITEMS"] as $arItem):?>
				<?if(isset($arItem["PRICE"])){
					$cur_min = !empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) ? floor($arItem["VALUES"]["MIN"]["HTML_VALUE"]) : floor($arItem["VALUES"]["MIN"]["VALUE"]);
					$cur_max = !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"]) ? ceil($arItem["VALUES"]["MAX"]["HTML_VALUE"]) : ceil($arItem["VALUES"]["MAX"]["VALUE"]);
					if (!$cur_min) $cur_min = 0;
					if (!$cur_max) $cur_max = 50000;?>
					<span class="filter-name"><??><?if ($arItem["NAME"]) {echo $arItem["NAME"];} else {echo $arItem["CODE"];}?></span>
					<div class="separate_filter">
						<span class="for_modef"></span>
						<div class="scroller_block">
							<div class="<?=$arItem["CODE"]?>_abs_min" style="display: none;"><?=floor($arItem["VALUES"]["MIN"]["VALUE"])?></div>
							<div class="<?=$arItem["CODE"]?>_abs_max" style="display: none;"><?=ceil($arItem["VALUES"]["MAX"]["VALUE"])?></div>
							<?=GetMessage('CT_BCSF_FILTER_FROM')?><input onkeyup="smartFilter.keyup(this)" type="text" class="minCost" id="<?=$arItem["CODE"]?>_abs_min" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=floor($cur_min);?>" />
							<?=GetMessage('CT_BCSF_FILTER_TO')?><input onkeyup="smartFilter.keyup(this)" type="text" class="maxCost" id="<?=$arItem["CODE"]?>_abs_max" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=ceil($cur_max);?>" />
							<div class="filter_P<?=$arItem["ID"]?>"></div>
						</div>
						<script>
							$(".filter_P<?=$arItem["ID"]?>").slider({
								min: <?=floor($arItem["VALUES"]["MIN"]["VALUE"])?>,
								max: <?=ceil($arItem["VALUES"]["MAX"]["VALUE"])?>,
								values: [<?=$cur_min?>,<?=$cur_max?>],
								range: true,
								stop: function(event, ui) {
									$(this).parent().find("input.minCost").val(ui.values[0]).change();
									$(this).parent().find("input.maxCost").val(ui.values[1]).change();
								},
								slide: function(event, ui){
									$(this).parent().find("input.minCost").val(ui.values[0]).change();
									$(this).parent().find("input.maxCost").val(ui.values[1]).change();
									smartFilter.keyup(BX("<?=$arItem["CODE"]?>_abs_min"));
								}
							});
							$(".<?=$arItem["CODE"]?> input.minCost").bind("keyup change", function(e){
								var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
								var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
								
								
								if( min_value < <?=$arItem["VALUES"]["MIN"]["VALUE"]?> ) { min_value = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.minCost").val(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>)}
								
								if(parseInt(min_value) > parseInt(max_value)){
									min_value = max_value;
									$(".<?=$arItem["CODE"]?> input.minCost").val(min_value);
								}
								smartFilter.keyup(BX("<?=$arItem["VALUES"]["MIN"]["CONTROL_ID"]?>"));
								$(".filter_<?=$arItem["CODE"]?>").slider("values", 0, min_value);
							});
							$(".<?=$arItem["CODE"]?> input.maxCost").bind("keyup change", function(e){
								var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
								var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
								
								if (max_value > <?=$arItem["VALUES"]["MAX"]["VALUE"]?>) { max_value = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.maxCost").val(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>)}

								if(parseInt(min_value) > parseInt(max_value)){
									max_value = min_value;
									$(".<?=$arItem["CODE"]?> input.maxCost").val(max_value);
								}
								smartFilter.keyup(BX("<?=$arItem["VALUES"]["MAX"]["CONTROL_ID"]?>"));
								$(".filter_<?=$arItem["CODE"]?>").slider("values", 1, max_value);
							});
						</script>
					</div>			
				<?}?>
			<?endforeach;?>
			
			<?foreach($arResult["ITEMS"] as $arItem){
				if(!isset($arItem["PRICE"])&&( $arItem["PROPERTY_TYPE"] == "N" && !empty($arItem["VALUES"]["MIN"]["VALUE"]) || $arItem["PROPERTY_TYPE"] != "N" && !empty($arItem["VALUES"]) )&&
				(!($arItem["PROPERTY_TYPE"]=="N"&&($arItem["VALUES"]["MIN"]["VALUE"]==$arItem["VALUES"]["MAX"]["VALUE"])))){?>

					<?if( $arItem["CODE"] != "HIT" && $arItem["CODE"] != "RECOMMEND" && $arItem["CODE"] != "NEW" && $arItem["CODE"] != "STOCK" ):?>
							<?$prop = CIBlockProperty::GetByID($arItem["ID"], $arParams["IBLOCK_ID"])->GetNext();?>
							<span class="filter-name"><?=$arItem["NAME"]?><?if ($prop["HINT"]):?><span class="hint"><span class="icon"><i>i</i></span><div class="tooltip"><?=$prop["HINT"]?></div></span><?endif;?></span>
							
					<?elseif (!$specialtitle):?>
						<span class="filter-name special"><?=GetMessage('CT_BCSF_SPECIAL')?></span>
						<span class="for_modef_special"></span>
						<? $specialtitle=true; ?>
					<?endif;?>
						
					
						<?if( $arItem["CODE"] == "HIT" || $arItem["CODE"] == "RECOMMEND" || $arItem["CODE"] == "NEW" || $arItem["CODE"] == "STOCK" ){?>
							<?$cur = current($arItem["VALUES"])?>
							<div class="special_props<?=$cur["DISABLED"]? ' disabled': ''?>">
								<input onclick="smartFilter.click(this)" id="<?=$cur["CONTROL_ID"]?>" type="checkbox" name="<?=$cur["CONTROL_NAME"]?>" value="<?=$cur["HTML_VALUE"]?>" <?=$cur["CHECKED"] ? 'checked="checked"': ''?>>
								<label for="<?=$cur["CONTROL_ID"]?>"><?=$arItem["NAME"]?></label>
							</div>
						<?}elseif( $arItem["PROPERTY_TYPE"] == "N" ){
							$cur_min = !empty($arItem["VALUES"]["MIN"]["HTML_VALUE"]) ? $arItem["VALUES"]["MIN"]["HTML_VALUE"] : $arItem["VALUES"]["MIN"]["VALUE"];
							$cur_max = !empty($arItem["VALUES"]["MAX"]["HTML_VALUE"]) ? $arItem["VALUES"]["MAX"]["HTML_VALUE"] : $arItem["VALUES"]["MAX"]["VALUE"];?>
						<div class="separate_filter">
							<span class="for_modef"></span>
							<div class="scroller_block">
								<div class="<?=$arItem["CODE"]?>_abs_min" style="display: none;"><?=$arItem["VALUES"]["MIN"]["VALUE"]?></div>
								<div class="<?=$arItem["CODE"]?>_abs_max" style="display: none;"><?=$arItem["VALUES"]["MAX"]["VALUE"]?></div>
								<?=GetMessage('CT_BCSF_FILTER_FROM')?><input onkeyup="smartFilter.keyup(this)" type="text" class="minCost" id="<?=$arItem["CODE"]?>_abs_min" name="<?=$arItem["VALUES"]["MIN"]["CONTROL_NAME"]?>" value="<?=floor($cur_min);?>" />
								<?=GetMessage('CT_BCSF_FILTER_TO')?><input onkeyup="smartFilter.keyup(this)" type="text" class="maxCost" id="<?=$arItem["CODE"]?>_abs_max" name="<?=$arItem["VALUES"]["MAX"]["CONTROL_NAME"]?>" value="<?=ceil($cur_max);?>" />
								<div class="filter_<?=$arItem["CODE"]?>"></div>
							</div>
							<script>
								$(".filter_<?=$arItem["CODE"]?>").slider({
									min: <?=$arItem["VALUES"]["MIN"]["VALUE"]?>,
									max: <?=$arItem["VALUES"]["MAX"]["VALUE"]?>,
									values: [<?=$cur_min?>,<?=$cur_max?>],
									range: true,
									stop: function(event, ui) {
										$(this).parent().find("input.minCost").val(ui.values[0]).change();
										$(this).parent().find("input.maxCost").val(ui.values[1]).change();
									},
									slide: function(event, ui){
										$(this).parent().find("input.minCost").val(ui.values[0]).change();
										$(this).parent().find("input.maxCost").val(ui.values[1]).change();
									}
								});
								$(".<?=$arItem["CODE"]?> input.minCost").bind("keyup change", function(e){
									var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
									var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
									
									if( min_value < <?=$arItem["VALUES"]["MIN"]["VALUE"]?> ) { min_value = <?=$arItem["VALUES"]["MIN"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.minCost").val(<?=$arItem["VALUES"]["MIN"]["VALUE"]?>)}
									
									if(parseInt(min_value) > parseInt(max_value)){
										min_value = max_value;
										$(".<?=$arItem["CODE"]?> input.minCost").val(min_value);
									}
									smartFilter.keyup(e.target);
									$(".filter_<?=$arItem["CODE"]?>").slider("values", 0, min_value);
								});

											
								$(".<?=$arItem["CODE"]?> input.maxCost").bind("keyup change", function(e){
									var min_value = $(".<?=$arItem["CODE"]?> input.minCost").val();
									var max_value = $(".<?=$arItem["CODE"]?> input.maxCost").val();
									
									if (max_value > <?=$arItem["VALUES"]["MAX"]["VALUE"]?>) { max_value = <?=$arItem["VALUES"]["MAX"]["VALUE"]?>; $(".<?=$arItem["CODE"]?> input.maxCost").val(<?=$arItem["VALUES"]["MAX"]["VALUE"]?>)}

									if(parseInt(min_value) > parseInt(max_value)){
										max_value = min_value;
										$(".<?=$arItem["CODE"]?> input.maxCost").val(max_value);
									}
									smartFilter.keyup(e.target);
									$(".filter_<?=$arItem["CODE"]?>").slider("values", 1, max_value);
								});
							</script>
						</div>
						<?}elseif( !empty($arItem["VALUES"]) ){?>
						<div class="separate_filter">
							<span class="for_modef"></span>
							<?if( count( $arItem["VALUES"] ) < 7 ){
								foreach($arItem["VALUES"] as $val => $ar){?>
									<div<?=$ar["DISABLED"]? ' class="disabled"': ''?>>
										<input onclick="smartFilter.click(this)" id="<?echo $ar["CONTROL_ID"]?>" type="checkbox" name="<?echo $ar["CONTROL_NAME"]?>" value="<?echo $ar["HTML_VALUE"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?>>
										<label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label>
									</div>
								<?}
							}else{?>
								<div class="checkboxes_block scroll">
									<?foreach($arItem["VALUES"] as $val => $ar){?>
										<div>
											<input onclick="smartFilter.click(this)" id="<?echo $ar["CONTROL_ID"]?>" type="checkbox" name="<?echo $ar["CONTROL_NAME"]?>" value="<?echo $ar["HTML_VALUE"]?>" <?echo $ar["CHECKED"]? 'checked="checked"': ''?>>
											<label for="<?echo $ar["CONTROL_ID"]?>"><?echo $ar["VALUE"];?></label>
										</div>
									<?}?>
								</div>
							<?}?>
						</div>
						<?}?>
					
				<?}?>
			<?}?>
			<div class="for_button reset_layout">
				<button style="margin-bottom: 10px;" class="button3" type="submit" id="set_filter" name="set_filter" value="<?=GetMessage("CT_BCSF_SET_FILTER")?>"><span><?=GetMessage("CT_BCSF_SET_FILTER")?></span></button>
				<div></div>
				<button class="button5" type="submit" id="clear_all" name="del_filter" value="<?=GetMessage("CT_BCSF_DEL_FILTER")?>" /><span><?=GetMessage("CT_BCSF_DEL_FILTER")?></span></button>
			</div>
			<div style="clear: both;"></div>
			
			<div class="modef" id="modef" <?if(!isset($arResult["ELEMENT_COUNT"])) echo 'style="display:none"';?>>
				<?=GetMessage("CT_BCSF_FILTER_COUNT", array("#ELEMENT_COUNT#" => '<span id="modef_num">'.intval($arResult["ELEMENT_COUNT"]).'</span>'));?>
				<a href="<?=$arResult["FILTER_URL"]?>" class="showchild"><?=GetMessage("CT_BCSF_FILTER_SHOW")?></a>
				<span class="ece"></span>
			</div>
		</form>
		<script>
			//var smartFilter = new JCSmartFilter('<?echo CUtil::JSEscape($APPLICATION->GetCurPageParam())?>');
			var smartFilter = new JCSmartFilter('<?echo $arResult["FORM_ACTION"]?>');
			function ShowChildren (element)
			{
				var clickitem = $(element);
				if( clickitem.parent("span").parent("li").hasClass('lvl1')){
					if( clickitem.parent("span").parent("li").hasClass('current')){
						clickitem.parent("span").parent("li").find("ul").animate({height: 0,'padding-top':0,'padding-bottom':0}, 300);
						clickitem.parent("span").parent("li").removeClass("current");
						clickitem.parent("span").parent("li").find(".current").removeClass("current");

					} else {

						setHeightlvlp(clickitem);
						clickitem.parent("span").parent("li").find("ul:first").attr('rel',heightlvl2Ul);
						clickitem.parent("span").parent("li").find("ul:first").css({height: 0, display: 'block'});
						clickitem.parent("span").parent("li").find("ul:first").animate({height: heightlvl2Ul+'px','padding-top':10+'px','padding-bottom':25+'px'}, 300);
						clickitem.parent("span").parent("li").addClass("current");
					}
				} else {
					if( clickitem.parent("span").parent("li").hasClass('current')){
						clickitem.parent("span").parent("li").find("ul").animate({height: 0,'padding-top':0,'padding-bottom':0}, 300);
						heightLVL1 = clickitem.parents(".lvl1").find("ul:first").attr('rel');
						clickitem.parents(".lvl1").find("ul:first").animate({height: heightLVL1+"px"}, 300);
						clickitem.parent("span").parent("li").removeClass("current");
					} else {
						setHeightlvlp(clickitem);

						heightLVL1 = clickitem.parents(".lvl1").find("ul:first").attr('rel');
						clickitem.parent("span").parent("li").find("ul:first").attr('rel',heightlvl2Ul);
						clickitem.parent("span").parent("li").find("ul:first").css({height: 0, display: 'block'});
						clickitem.parent("span").parent("li").find("ul:first").animate({height: heightlvl2Ul+'px','padding-top':10+'px','padding-bottom':25+'px'}, 300);
						clickitem.parents(".lvl1").find("ul:first").animate({height:  parseInt(heightlvl2Ul)+ parseInt(heightLVL1)+'px','padding-top':10+'px','padding-bottom':20+'px'}, 300);
						clickitem.parent("span").parent("li").addClass("current");
					}
				}
				return false;
			}
		</script>
	</div>
	
<!--/noindex-->