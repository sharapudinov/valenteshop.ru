<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<div class="colors_blocks">
<?
$IDEL = $_POST['id'];
$IDELS = $_POST['ids'];
$IBLOCK_ID = 36;
?>
<?
CModule::IncludeModule('catalog');

$arFilter = Array("IBLOCK_ID"=>IntVal($IBLOCK_ID), "ID"=>$IDEL);
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
if($ob = $res->GetNextElement()){ 
	$arProps = $ob->GetProperties();
	/*print_r($arProps);*/
}
?>
<?
CModule::IncludeModule('highloadblock');
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;



foreach($arProps as $arProp){
	if($arProp['USER_TYPE_SETTINGS']['TABLE_NAME'] && $arProp['VALUE']){

		$hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(array("filter" => array('TABLE_NAME' => $arProp['USER_TYPE_SETTINGS']['TABLE_NAME'])))->fetch();
		$entity = HL\HighloadBlockTable::compileEntity($hlblock);
		$filter = array('ID' => $arProp['VALUE']);
		$main_query = new Entity\Query($entity);
		$main_query->setSelect(array('*'));
		$main_query->setFilter($filter);
		$main_query->setOrder(array('ID' => 'DESC'));

		$result = $main_query->exec();
		$result = new CDBResult($result);
		
		$rows = array();$tableColumns = array();
		while ($row = $result->Fetch())
		{
			foreach ($row as $k => $v)
			{
				if ($k == 'ID')
				{
					$tableColumns['ID'] = true;
					continue;
				}

				$arUserField = $fields[$k];

				if ($arUserField["SHOW_IN_LIST"]!="Y")
				{
					continue;
				}

				$html = call_user_func_array(
					array($arUserField["USER_TYPE"]["CLASS_NAME"], "getadminlistviewhtml"),
					array(
						$arUserField,
						array(
							"NAME" => "FIELDS[".$row['ID']."][".$arUserField["FIELD_NAME"]."]",
							"VALUE" => htmlspecialcharsbx($v)
						)
					)
				);

				if($html == '')
				{
					$html = '&nbsp;';
				}

				$tableColumns[$k] = true;

				$row[$k] = $html;
			}


			$rows[] = $row;
		}
?>	
		<div id="ton_colors<?=$prop_sku_code?>_block_<?=$arResult['ID'];?>" class="block_colors_code block_colors_code<?=$ic++;?>">
			<div class="block_colors_code_name"><?=$arProp['NAME'];?>:</div>
			<?foreach($rows as $row):?>
			<div class="block_colors_elem_new block_colors_elem_click">
				<input type="hidden" name='prop[<?=$IDELS?>][val]' value="<?=$row['UF_NAZVANIE']?>" />
				<input type="hidden" name='prop[<?=$IDELS?>][name]' value="<?if($_POST['idname']){echo $_POST['idname'].", цвет";}else{echo 'цвет';}?>" />
				<?if($row['UF_HEX']){?>
					<div style="width:142px;height:47px;background:#<?=$row['UF_HEX'];?>;"></div>
				<?}else if(!empty($row['UF_FILE'])){
					$file = CFile::ResizeImageGet($row['UF_FILE'], array('width'=>142, 'height'=>47), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					echo '<img class="colors_picture" border="0" src="'.$file["src"].'" width="'.$file["width"].'" height="'.$file["height"].'" alt="'.$row['UF_NAME'].'" title="'.$row['UF_NAME'].'" />';
				}?>
				<?=$row['UF_NAZVANIE']?>
			</div>
			<?endforeach;?>
			<div class="clear_both"></div>
		</div>	
		<?
	}
}
?>
<input id="id_block" type="hidden" name="id_block" value="<?=$IDELS?>" />
<a class="jqmClose close"></a>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>