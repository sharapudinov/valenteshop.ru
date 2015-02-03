<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
/* global $USER;
if ($USER->IsAdmin()){
print_r($_POST);
echo "<br />";
print_r($_GET);
echo "<br />";
print_r($_REQUEST);
echo "<br />";
print_r($arResult);
}*/
?>
<?
if($_SESSION['ORDER'.$_GET["ORDER_ID"]] == 'Y'){
$_SESSION['ORDER'.$_GET["ORDER_ID"]] = '';
$trans = array('id'=>$arResult['ORDER']['ID'], 'affiliation'=>'valenteshop', 'revenue'=>$arResult['ORDER']['PRICE'], 'shipping'=>$arResult['ORDER']['PRICE_DELIVERY']);	
// List of Items Purchased.
function getTransactionJs(&$trans) {
  return <<<HTML
ga('ecommerce:addTransaction', {
  'id': '{$trans['id']}',
  'affiliation': '{$trans['affiliation']}',
  'revenue': '{$trans['revenue']}',
  'shipping': '{$trans['shipping']}'
});
HTML;
}		
// Function to return the JavaScript representation of an ItemData object.
function getItemJs(&$transId, &$item) {
  return <<<HTML
ga('ecommerce:addItem', {
  'id': '{$item['PRODUCT_ID']}',
  'name': '{$item['NAME']}',
  'price': '{$item['PRICE']}',
  'quantity': '{$item['QUANTITY']}'
});
HTML;
}	
?>
<!-- Begin HTML -->
<script>
ga('require', 'ecommerce');

<?php
echo getTransactionJs($trans);

$dbBasketItems = CSaleBasket::GetList(array("NAME" => "ASC","ID" => "ASC" ), array( "ORDER_ID" => $_GET["ORDER_ID"] ),false, false,array());
while ($arItems = $dbBasketItems->Fetch())
{
	echo getItemJs($arItems['PRODUCT_ID'], $arItems);
}
?>

ga('ecommerce:send');
</script>

<?
}


if (!empty($arResult["ORDER"]))
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ORDER_COMPLETE")?></b><br /><br />
	<table class="sale_order_full_table">
		<tr>
			<td>
				<?= GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?><br /><br />
				<?= GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?>
			</td>
		</tr>
	</table>
	<?
	if (!empty($arResult["PAY_SYSTEM"]))
	{
		?>
		<br /><br />

		<table class="sale_order_full_table">
			<tr>
				<td>
					<?=GetMessage("SOA_TEMPL_PAY")?>: <?= $arResult["PAY_SYSTEM"]["NAME"] ?>
				</td>
			</tr>
			<?
			if (strlen($arResult["PAY_SYSTEM"]["ACTION_FILE"]) > 0)
			{
				?>
				<tr>
					<td>
						<?
						if ($arResult["PAY_SYSTEM"]["NEW_WINDOW"] == "Y")
						{
							?>
							<script language="JavaScript">
								window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))?>');
							</script>
							<?= GetMessage("SOA_TEMPL_PAY_LINK", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]))))?>
							<?
							if (CSalePdf::isPdfAvailable())
							{
								?><br />
								<?= GetMessage("SOA_TEMPL_PAY_PDF", Array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$arResult["ORDER_ID"]."&pdf=1")) ?>
								<?
							}
						}
						else
						{
							if (strlen($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"])>0)
							{
								include($arResult["PAY_SYSTEM"]["PATH_TO_ACTION"]);
							}
						}
						?>
					</td>
				</tr>
				<?
			}
			?>
		</table>
		<?
	}
}
else
{
	?>
	<b><?=GetMessage("SOA_TEMPL_ERROR_ORDER")?></b><br /><br />

	<table class="sale_order_full_table">
		<tr>
			<td>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ORDER_ID"]))?>
				<?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?>
			</td>
		</tr>
	</table>
	<?
}
?>
