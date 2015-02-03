<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?/*
print_r($_REQUEST);
*/
if (CModule::IncludeModule("catalog"))
{?>
<?
$code_clrs = unserialize($_POST['mas']);
$arResult['PROPERTIES'] = unserialize($_POST['masprop']);
?>
<?$ic = 1;?> 
	<?foreach($code_clrs as $prop_colors_code){?>
		<?if(!empty($arResult['PROPERTIES'][$prop_colors_code]['VALUE'])):?>
			<div id="ton_colors<?=$prop_sku_code?>_block_<?=$arResult['ID'];?>" class="block_colors_code block_colors_code<?=$ic++;?>">
				<div class="block_colors_code_name"><?=$arResult['PROPERTIES'][$prop_colors_code]['NAME']?>:</div>
							<?$arFilter = Array("IBLOCK_ID"=>'31', "ID" =>  $arResult['PROPERTIES'][$prop_colors_code]['VALUE']);
							$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
							$iii = 0;
							while($ob = $res->GetNextElement()){
										$ar_fields = $ob->GetFields();  
										$arProps = $ob->GetProperties();?>
								<div class="block_colors_elem">
									<div style="display:none;" class="block_colors_elem_name">prop[<?=$prop_colors_code?>]</div>
									<div style="display:none;" class="block_colors_elem_value"><?=$ar_fields['NAME']?></div>
								<?if(!empty($ar_fields['PREVIEW_PICTURE'])){
									$file = CFile::ResizeImageGet($ar_fields['PREVIEW_PICTURE'], array('width'=>142, 'height'=>47), BX_RESIZE_IMAGE_PROPORTIONAL, true);
									echo '<img class="colors_picture" border="0" src="'.$file["src"].'" width="'.$file["width"].'" height="'.$file["height"].'" alt="'.$ar_fields["NAME"].'" title="'.$ar_fields["NAME"].'" />';
								}?>
								<?=$ar_fields['NAME']?>
								</div>
							<?}?>
				<div class="clear_both"></div>
			</div>	
		<?endif;?>
	<?}?>
<?}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>