<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("sale"))
{
	$sov = 0;
	$arID = array();
	$arBasketItems = array();

	$dbBasketItems = CSaleBasket::GetList(array("NAME" => "ASC","ID" => "ASC"),array("FUSER_ID" => CSaleBasket::GetBasketUserID(),"LID" => "s2","ORDER_ID" => "NULL","PRODUCT_ID"=>$_POST['id']),false,false, array('ID'));
	if($arItems = $dbBasketItems->Fetch())
	{
		// Выведем все свойства элемента корзины с кодом $basketID
		$db_res = CSaleBasket::GetPropsList(array("SORT" => "ASC","NAME" => "ASC"),array("BASKET_ID" => $arItems['ID']));
		while ($ar_res = $db_res->Fetch())
		{
		   $ar_res_arr[$ar_res['CODE']] = $ar_res['VALUE'];
		}
		foreach($_REQUEST['prop'] as $prop_key => $prop_val){
			if(preg_match('/\//', $prop_val)){
				$prop_val_a = explode('/', $prop_val);
				$prop_val = $prop_val_a['1'];
			}
			if($prop_val != $ar_res_arr[$prop_key]){
				$sov = 1;
				break;
			}
		}
	}else{
		$sov = 1;
	}
	
	if($sov == 0){
		echo "added";
	}
	/*print_r($_POST);*/
}
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>