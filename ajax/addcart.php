<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("catalog"))
{

function Add2BasketByProductID1($PRODUCT_ID, $QUANTITY = 1, $arRewriteFields = array(), $arProductParams = false)
{
	global $APPLICATION;

	/* for old use */
	if (false === $arProductParams)
	{
		$arProductParams = $arRewriteFields;
		$arRewriteFields = array();
	}

	$PRODUCT_ID = IntVal($PRODUCT_ID);
	if ($PRODUCT_ID <= 0)
	{
		$APPLICATION->ThrowException(GetMessage('CATALOG_ERR_EMPTY_PRODUCT_ID'), "EMPTY_PRODUCT_ID");
		return false;
	}

	$QUANTITY = DoubleVal($QUANTITY);
	if ($QUANTITY <= 0)
		$QUANTITY = 1;

	if (!CModule::IncludeModule("sale"))
	{
		$APPLICATION->ThrowException(GetMessage('CATALOG_ERR_NO_SALE_MODULE'), "NO_SALE_MODULE");
		return false;
	}

	if (CModule::IncludeModule("statistic") && IntVal($_SESSION["SESS_SEARCHER_ID"])>0)
	{
		$APPLICATION->ThrowException(GetMessage('CATALOG_ERR_SESS_SEARCHER'), "SESS_SEARCHER");
		return false;
	}

	$arProduct = CCatalogProduct::GetByID($PRODUCT_ID);
	if ($arProduct === false)
	{
		$APPLICATION->ThrowException(GetMessage('CATALOG_ERR_NO_PRODUCT'), "NO_PRODUCT");
		return false;
	}

	$CALLBACK_FUNC = "CatalogBasketCallback";
	$productProviderClass = "CCatalogProductProvider";

	//ADD PRODUCT TO SUBSCRIBE
	if ((isset($arRewriteFields["SUBSCRIBE"]) && $arRewriteFields["SUBSCRIBE"] == "Y"))
	{
		global $USER;

		if ($USER->IsAuthorized() && !isset($_SESSION["NOTIFY_PRODUCT"][$USER->GetID()]))
		{
			$_SESSION["NOTIFY_PRODUCT"][$USER->GetID()] = array();
		}

		$arBuyerGroups = CUser::GetUserGroup($USER->GetID());
		$arPrice = CCatalogProduct::GetOptimalPrice($PRODUCT_ID, 1, $arBuyerGroups, "N", array(), SITE_ID, array());

		$arCallbackPrice = array(
			"PRICE" => $arPrice["DISCOUNT_PRICE"],
			"VAT_RATE" => 0,
			"CURRENCY" => CSaleLang::GetLangCurrency(SITE_ID),
			"QUANTITY" => 1
		);
	}
	else
	{
		$arRewriteFields["SUBSCRIBE"] = "N";

		if ($arProduct["CAN_BUY_ZERO"]!='Y' && $arProduct["QUANTITY_TRACE"]=="Y" && DoubleVal($arProduct["QUANTITY"])<=0)
		{
			$APPLICATION->ThrowException(GetMessage('CATALOG_ERR_PRODUCT_RUN_OUT'), "PRODUCT_RUN_OUT");
			return false;
		}

		$arCallbackPrice = CSaleBasket::ReReadPrice($CALLBACK_FUNC, "catalog", $PRODUCT_ID, $QUANTITY, "N", $productProviderClass);
		if (!is_array($arCallbackPrice) || empty($arCallbackPrice))
		{
			$APPLICATION->ThrowException(GetMessage('CATALOG_PRODUCT_PRICE_NOT_FOUND'), "NO_PRODUCT_PRICE");
			return false;
		}
	}

	$dbIBlockElement = CIBlockElement::GetList(array(), array(
					"ID" => $PRODUCT_ID,
					"ACTIVE" => "Y",
					"ACTIVE_DATE" => "Y",
					"CHECK_PERMISSIONS" => "Y",
					"MIN_PERMISSION" => "R",
				), false, false, array(
					"ID",
					"IBLOCK_ID",
					"XML_ID",
					"NAME",
					"DETAIL_PAGE_URL",
	));
	$arIBlockElement = $dbIBlockElement->GetNext();

	if ($arIBlockElement == false)
	{
		$APPLICATION->ThrowException(GetMessage('CATALOG_ERR_NO_IBLOCK_ELEMENT'), "NO_IBLOCK_ELEMENT");
		return false;
	}

	$arProps = array();

	$dbIBlock = CIBlock::GetList(
			array(),
			array("ID" => $arIBlockElement["IBLOCK_ID"])
		);
	if ($arIBlock = $dbIBlock->Fetch())
	{
		$arProps[] = array(
				"NAME" => "Catalog XML_ID",
				"CODE" => "CATALOG.XML_ID",
				"VALUE" => $arIBlock["XML_ID"]
			);
	}

	$arProps[] = array(
			"NAME" => "Product XML_ID",
			"CODE" => "PRODUCT.XML_ID",
			"VALUE" => $arIBlockElement["XML_ID"]
		);

	$arPrice = CPrice::GetByID($arCallbackPrice["PRODUCT_PRICE_ID"]);

	if(!empty($_REQUEST['price_id'])){
		$price_arr = explode(" ", $_REQUEST['price_id']);
		array_pop($price_arr);
		$price = implode("", $price_arr);

	}else{
		$price = $arCallbackPrice["PRICE"];
	}

	$arFields = array(
			"PRODUCT_ID" => $PRODUCT_ID,
			"PRODUCT_PRICE_ID" => $arCallbackPrice["PRODUCT_PRICE_ID"],
			"PRICE" => $price,
			"CURRENCY" => $arCallbackPrice["CURRENCY"],
			"WEIGHT" => $arProduct["WEIGHT"],
			"QUANTITY" => $QUANTITY,
			"LID" => "s2",
			"DELAY" => "N",
			"CAN_BUY" => "Y",
			"NAME" => $arIBlockElement["~NAME"],
			"MODULE" => "catalog",
			"DETAIL_PAGE_URL" => $arIBlockElement["DETAIL_PAGE_URL"],
			"CATALOG_XML_ID" => $arIBlock["XML_ID"],
			"PRODUCT_XML_ID" => $arIBlockElement["XML_ID"],
			"VAT_RATE" => $arCallbackPrice['VAT_RATE'],
			"SUBSCRIBE" => $arRewriteFields["SUBSCRIBE"],
		"CATALOG_XML_ID" => $strIBlockXmlID,
		"PRODUCT_XML_ID" => $arProduct["XML_ID"],
		"VAT_RATE" => $arCallbackPrice['VAT_RATE'],
		"TYPE" => ($arCatalogProduct["TYPE"] == CCatalogProduct::TYPE_SET) ? CCatalogProductSet::TYPE_SET : NULL
		);
	if(!empty($_REQUEST['price_id_discont'])){
		$arFields['DISCOUNT_PRICE'] = $_REQUEST['price_id_discont'];
	}
		

	if ($arProduct["CAN_BUY_ZERO"]!="Y" && $arProduct["QUANTITY_TRACE"]=="Y")
	{
		if (IntVal($arProduct["QUANTITY"])-$QUANTITY < 0)
			$arFields["QUANTITY"] = DoubleVal($arProduct["QUANTITY"]);
	}

	if (is_array($arProductParams) && !empty($arProductParams))
	{
		foreach ($arProductParams as &$arOneProductParams)
		{
			$arProps[] = array(
					"NAME" => $arOneProductParams["NAME"],
					"CODE" => $arOneProductParams["CODE"],
					"VALUE" => $arOneProductParams["VALUE"],
					"SORT" => $arOneProductParams["SORT"]
				);
		}
		if (isset($arOneProductParams))
			unset($arOneProductParams);
	}
	$arFields["PROPS"] = $arProps;

	if (is_array($arRewriteFields) && !empty($arRewriteFields))
	{
		while(list($key, $value)=each($arRewriteFields)) $arFields[$key] = $value;
	}

	$addres = CSaleBasket::Add($arFields);
	if ($addres)
	{
		if ((isset($arRewriteFields["SUBSCRIBE"]) && $arRewriteFields["SUBSCRIBE"] == "Y"))
			$_SESSION["NOTIFY_PRODUCT"][$USER->GetID()][$PRODUCT_ID] = $PRODUCT_ID;

		if (CModule::IncludeModule("statistic"))
			CStatistic::Set_Event("sale2basket", "catalog", $arFields["DETAIL_PAGE_URL"]);
	}

	return $addres;
}
?>
<?




	$product_id = $_REQUEST['id'];
	if(!empty($_REQUEST['quan'])){
		$quanity =  $_REQUEST['quantity'];
	}else{
		$quanity =  '1';
	}
	if( $_REQUEST[skuname][$_REQUEST[SKU]] != "Не выбран" && !empty($_REQUEST[skuname][$_REQUEST[SKU]])){
		$PROP[0]['NAME'] = 'Дополнение';
		$PROP[0]['VALUE'] = $_REQUEST[skuname][$_REQUEST[SKU]];
		$PROP[0]['CODE'] = 'skuname';
	}

	$i = 1;

	foreach($_REQUEST[prop] as $propkey => $propval){
		if($propval != "Выбор"){
		$IBLOCK_ID_PROP = 15;
			$properties = CIBlockProperty::GetList(Array("sort"=>"asc", "name"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID_PROP,  "CODE"=>$propkey));
			if($prop_fields = $properties->GetNext())
			{
				if(is_array($propval)){
					foreach($propval as $propval_val){
						$PROP[$i]['NAME'] = $prop_fields['NAME'];
						$PROP[$i]['CODE'] = $prop_fields['CODE'];
						$propval_arr = explode('/', $propval_val);
						if(!empty($propval_arr['1'])){
							$PROP[$i++]['VALUE'] = $propval_arr['1'];
						}else{
							$PROP[$i++]['VALUE'] = $propval_val;
						}
					}
				}else{
					$PROP[$i]['NAME'] = $prop_fields['NAME'];
					$PROP[$i]['CODE'] = $prop_fields['CODE'];
					$propval_arr = explode('/', $propval);
					if(!empty($propval_arr['1'])){
						$PROP[$i++]['VALUE'] = $propval_arr['1'];
					}else{
						$PROP[$i++]['VALUE'] = $propval;
					}
				}
			}

		}
	}
	if(!empty($product_id)){
		Add2BasketByProductID1($product_id, $quanity,$PROP);
	}
}
?>