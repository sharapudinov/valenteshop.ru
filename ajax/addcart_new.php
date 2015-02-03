<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("catalog"))
{
	/*получаем ид*/
	if($_REQUEST['sku_id']){
		$product_id = $_REQUEST['sku_id'];
	}else{
		$product_id = $_REQUEST['id'];
	}
	/*получаем количество*/
	if(!empty($_REQUEST['quantity'])){
		$quanity =  $_REQUEST['quantity'];
	}else{
		$quanity =  '1';
	}
	$i = 1;
	foreach($_REQUEST['prop'] as $propkey => $propval){
		if($propval['val'] != "выбор" && $propval['val'] != "Выбор" ){
			$PROP[$i]['NAME'] = $propval['name'];
			$PROP[$i]['CODE'] = $propkey;
			if($propval['valzn']){
				$PROP[$i++]['VALUE'] = $propval['valzn'][$propval['val']];
			}else{
				$PROP[$i++]['VALUE'] = $propval['val'];
			}
		}
	}
	/*print_r($PROP);*/
	if(!empty($product_id)){
		Add2BasketByProductID($product_id, $quanity,  array("PROPS"=>$PROP), $PROP);
	}

}
?>