<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>

<?


CModule::IncludeModule("catalog");
/*
if($_GET['tes'] == 1){
	$_REQUEST['id'] = 'my_form_723';
	$_REQUEST['price'] = 0;	
}
*/
$id = explode("_", $_REQUEST['id']);

$arPrice = CPrice::GetBasePrice($id[2]);
$PRICE = $arPrice[PRICE] + $_REQUEST['price'];
CModule::IncludeModule("currency");
$PRICE_RUB = CurrencyFormat($PRICE, 'RUB');

$arDiscounts = CCatalogDiscount::GetDiscountByProduct($id[2],$USER->GetUserGroupArray(), "N");


if($arDiscounts['0']['VALUE'] > 0){
$skidka = $PRICE*$arDiscounts['0']['VALUE']/100;
$skidka = round($skidka);
$sum = $PRICE - $skidka;
$sum_RUB = CurrencyFormat($sum, 'RUB');
?>
	<span class="new"> <?=$sum_RUB?></span>
	<span style="margin-top:8px;" class="old"> <?=$PRICE_RUB;?></span>
	<input class="price_id" name="price_id" value="<?=$sum_RUB?>" type="hidden">
	<input class="price_id" name="price_id_discont" value="<?=$skidka?>" type="hidden">
<?}else{?>
	<span> <?=$PRICE_RUB;?></span>
	<input class="price_id" name="price_id" value="<?=$PRICE_RUB;?>" type="hidden">
<?}?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>