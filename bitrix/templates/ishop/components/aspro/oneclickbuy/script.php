<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


header('Content-type: application/json; charset=utf-8');
require(dirname(__FILE__)."/lang/" . LANGUAGE_ID . "/script.php");

if (!function_exists('inputClean')) 
{ 
	function inputClean($input, $sql=false) 
	{
		$input = htmlentities($input, ENT_QUOTES, LANG_CHARSET);
		if(get_magic_quotes_gpc ())	{$input = stripslashes ($input);}
		if ($sql){$input = mysql_real_escape_string ($input);}
		$input = strip_tags($input);
		$input=str_replace ("\n"," ", $input);
		$input=str_replace ("\r","", $input);
		return $input;
	}
}

if (!function_exists('json_encode')) 
{  
    function json_encode($value) 
    {
        if (is_int($value)) { return (string)$value; } 
		elseif (is_string($value)) 
		{
	        $value = str_replace(array('\\', '/', '"', "\r", "\n", "\b", "\f", "\t"),  array('\\\\', '\/', '\"', '\r', '\n', '\b', '\f', '\t'), $value);
	        $convmap = array(0x80, 0xFFFF, 0, 0xFFFF);
	        $result = "";
	        for ($i = mb_strlen($value) - 1; $i >= 0; $i--) 
			{
	            $mb_char = mb_substr($value, $i, 1);
	            if (mb_ereg("&#(\\d+);", mb_encode_numericentity($mb_char, $convmap, "UTF-8"), $match)) { $result = sprintf("\\u%04x", $match[1]) . $result;  } 
				else { $result = $mb_char . $result;  }
	        }
	        return '"' . $result . '"';                
        } 
		elseif (is_float($value)) { return str_replace(",", ".", $value); } 
		elseif (is_null($value)) {  return 'null';} 
		elseif (is_bool($value)) { return $value ? 'true' : 'false';   } 
		elseif (is_array($value)) 
		{
            $with_keys = false;
            $n = count($value);
            for ($i = 0, reset($value); $i < $n; $i++, next($value))  { if (key($value) !== $i) {  $with_keys = true; break;  }  }
        } 
		elseif (is_object($value)) { $with_keys = true; } 
		else { return ''; }
        $result = array();
        if ($with_keys)  {  foreach ($value as $key => $v) {  $result[] = json_encode((string)$key) . ':' . json_encode($v); }  return '{' . implode(',', $result) . '}'; } 
		else {  foreach ($value as $key => $v) { $result[] = json_encode($v); } return '[' . implode(',', $result) . ']';  }
    } 
}

if (!function_exists('getJson')) 
{ 
	function getJson($message, $res='N', $error='') 
	{
		global $APPLICATION;
		$result = array(
			'result' => $res=='Y'?'Y':'N',
			'message' => $APPLICATION->ConvertCharset($message, SITE_CHARSET, 'utf-8')
		);
		if (strlen($error) > 0) { $result['err'] = $APPLICATION->ConvertCharset($error, SITE_CHARSET, 'utf-8'); }
		return json_encode($result);
	}
}

if (CModule::IncludeModule('sale')	&& CModule::IncludeModule('iblock') && CModule::IncludeModule('catalog') && CModule::IncludeModule('currency')) 
{
    $user_registered = false;
	$currency = CCurrencyLang::GetByID($_POST['CURRENCY'], LANGUAGE_ID);

	global $APPLICATION;
	$_POST['ONE_CLICK_BUY']['USER_NAME'] = $APPLICATION->ConvertCharset($_POST['ONE_CLICK_BUY']['USER_NAME'], 'utf-8', SITE_CHARSET);
	$_POST['ONE_CLICK_BUY']['COMMENT'] = $APPLICATION->ConvertCharset($_POST['ONE_CLICK_BUY']['COMMENT'], 'utf-8', SITE_CHARSET);
	
	if (!empty($_POST['ONE_CLICK_BUY']['EMAIL']) && !preg_match('/^[0-9a-zA-Z\-_\.]+@[0-9a-zA-Z\-]+[\.]{1}[0-9a-zA-Z\-]+[\.]?[0-9a-zA-Z\-]+$/', $_POST['ONE_CLICK_BUY']['EMAIL'])) die(getJson(GetMessage('BAD_EMAIL_FORMAT')));
	elseif (!empty($_POST['ONE_CLICK_BUY']['PHONE']) && !preg_match('/^[+0-9\-\(\)\s]+$/', $_POST['ONE_CLICK_BUY']['PHONE'])) die(getJson(GetMessage('NO_PHONE')));
	elseif (empty($_POST['ONE_CLICK_BUY']['USER_NAME'])) die(getJson(GetMessage('NO_USER_NAME')));
	elseif  (!$currency) die(getJson(GetMessage('CURRENCY_NOT_FOUND')));
	
	if (strlen($_POST['CURRENCY']) != 3) $_POST['CURRENCY'] = COption::GetOptionString('sale', 'default_currency', 'RUB');

	global $USER;
	if (!$USER->IsAuthorized()) 
	{
		if (!isset($_POST['ONE_CLICK_BUY']['EMAIL']) || trim($_POST['ONE_CLICK_BUY']['EMAIL']) == '') 
		{
			$login = 'user_' . (microtime(true) * 10000);
			if (strlen(SITE_SERVER_NAME)) { $server_name = SITE_SERVER_NAME; } else { $server_name = $_SERVER["SERVER_NAME"];}
			$_POST['ONE_CLICK_BUY']['EMAIL'] = $login . '@' . $server_name;
			$user_registered = true;
		} 
		else 
		{
			$dbUser = CUser::GetList(($by = 'ID'), ($order = 'ASC'), array('=EMAIL' => trim($_POST['ONE_CLICK_BUY']['EMAIL'])));
			if ($dbUser->SelectedRowsCount() == 0) 
			{
				$login = 'user_' . (microtime(true) * 10000);
				$user_registered = true;
			} 
			elseif ($dbUser->SelectedRowsCount() == 1) 
			{
				$ar_user = $dbUser->Fetch();
				$registeredUserID = $ar_user['ID'];
			} else die(getJson(GetMessage('TOO_MANY_USERS')));
		}

		if ($user_registered) 
		{
			$captcha = COption::GetOptionString('main', 'captcha_registration', 'N');
			if ($captcha == 'Y'){COption::SetOptionString('main', 'captcha_registration', 'N');}
			$userPassword = randString(10);
			$username = explode(' ', trim($_POST['ONE_CLICK_BUY']['USER_NAME']));
			$newUser = $USER->Register($login, $username[0], $username[1], $userPassword,  $userPassword,$_POST['ONE_CLICK_BUY']['EMAIL']);
			if ($captcha == 'Y'){ COption::SetOptionString('main', 'captcha_registration', 'Y');}
			if ($newUser['TYPE'] == 'ERROR') { die(getJson(GetMessage('USER_REGISTER_FAIL'), 'N', $newUser['MESSAGE'])); } 
			else 
			{
				$registeredUserID = $USER->GetID();
				if (!empty($_POST['ONE_CLICK_BUY']['PHONE'])) { $USER->Update($registeredUserID,  array('PERSONAL_PHONE' => $_POST['ONE_CLICK_BUY']['PHONE']));}
				$USER->Logout();
			}
		}
	} else { $registeredUserID = $USER->GetID(); }

	$newOrder = array( 'LID' => SITE_ID, 	'PERSON_TYPE_ID' => intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID']: 1, 'PAYED' => 'N', 'CURRENCY' => $_POST['CURRENCY'], 'USER_ID' => $registeredUserID);
	if ($_POST['DELIVERY_ID'] > 0) $newOrder['deliveryId'] = $_POST['DELIVERY_ID'];
	if ($_POST['PAY_SYSTEM_ID'] > 0) $newOrder['paysystemId'] = $_POST['PAY_SYSTEM_ID'];
	$newOrder['COMMENTS'] = $_POST['ONE_CLICK_BUY']['COMMENT'];
	$orderID = CSaleOrder::Add($newOrder);

	if ($orderID == false) 
	{
		$strError = '';
		if($ex = $APPLICATION->GetException()) $strError = $ex->GetString();
		die(getJson(GetMessage('ORDER_CREATE_FAIL'), 'N', $strError));
	}

	$res = CSaleBasket::GetList(array('SORT' => 'DESC'),array('FUSER_ID' => CSaleBasket::GetBasketUserID(), 'LID' => SITE_ID, 'ORDER_ID' => 'NULL', 'DELAY' => 'N'));
	
	$orderPrice = 0;
	$orderList = '';
	CSaleBasket::DeleteAll(CSaleBasket::GetBasketUserID());

	$db_product = CIBlockElement::GetByID($_POST['PRODUCT_ID']);
	$arProduct = $db_product->GetNext();
	if ($useSku)
	{
		$detailPageURL = "";
		$arCatalog = CCatalog::GetByID($arProduct['IBLOCK_ID']);
		if (is_array($arCatalog) && intval($arCatalog['PRODUCT_IBLOCK_ID']) > 0 && intval($arCatalog['SKU_PROPERTY_ID']) > 0) 
		{
			$dbSKUProp = CIBlockElement::GetProperty($arProduct['IBLOCK_ID'], $_POST['PRODUCT_ID'],array(),array('ID' => $arCatalog['SKU_PROPERTY_ID']));
			if ($arSKUProp = $dbSKUProp->Fetch()) 
			{
				if (0 < intval($arSKUProp['VALUE'])) 
				{
					$db_parent = CIBlockElement::GetByID($arSKUProp['VALUE']);
					$ar_parent = $db_parent->GetNext();
					$detailPageURL = $ar_parent['DETAIL_PAGE_URL'];
				}
			}
		}
		$arProduct['DETAIL_PAGE_URL'] = $detailPageURL;
	}		

	$res = CPrice::GetList( array(), array( 'PRODUCT_ID' => $_POST['PRODUCT_ID'], 'CATALOG_GROUP_ID' => $_POST['PRICE_ID'] ) );
	
	if ($res->SelectedRowsCount() != 1) die(getJson(GetMessage('PRODUCT_PRICE_NOT_FOUND')));
	
	$arPrice = $res->Fetch();
	$arProps = array();
	$iblockID = intval($_POST['IBLOCK_ID']);
	$product_desc_string = '';
	$useSku = (isset($_POST['USE_SKU']) && $_POST['USE_SKU']=='Y');

	if ($useSku && $iblockID > 0) 
	{
		$skuCodes = explode('|', $_POST['SKU_CODES']);
		if (is_array($skuCodes)) 
		{
			foreach ($skuCodes as $k => $v) { if ($v === '') unset($skuCodes[$k]); }
			if (!empty($skuCodes)) $arProps = CIBlockPriceTools::GetOfferProperties( $_POST['PRODUCT_ID'], $iblockID, $skuCodes);
		}
	}

	$added = Add2BasketByProductID($_POST['PRODUCT_ID'], 1, array('ORDER_ID' => $orderID), $arProps);
	if (!$added) 
	{
		$strError = '';
		if($ex = $APPLICATION->GetException()) {$strError = $ex->GetString();}
		die(getJson(GetMessage('ITEM_ADD_FAIL'), 'N', $strError));
	} 
	else
	{
		$ar_basket_item = CSaleBasket::GetByID($added);
		if ($ar_basket_item['CURRENCY'] != $_POST['CURRENCY'])
		{ $ar_basket_item['PRICE'] = CCurrencyRates::ConvertCurrency(	$ar_basket_item['PRICE'], $ar_basket_item['CURRENCY'], $_POST['CURRENCY']); }			
		$orderPrice += roundEx($ar_basket_item['PRICE'], SALE_VALUE_PRECISION);
		$orderList .= GetMessage('ITEM_NAME') . $arProduct['NAME'] . $product_desc_string . GetMessage('ITEM_PRICE') . str_replace('#', $ar_basket_item['PRICE'], $currency['FORMAT_STRING']) . GetMessage('ITEM_QTY') . '1'. GetMessage('ITEM_TOTAL') . str_replace('#', $ar_basket_item['PRICE'], $currency['FORMAT_STRING']) . "\n";
	}
	
	$res = CSaleOrderProps::GetList();
	
	$personType = intval($_POST['PERSON_TYPE_ID']) > 0 ? $_POST['PERSON_TYPE_ID']: 1;
	while ($prop = $res->Fetch())
	{
		if ($prop["PERSON_TYPE_ID"]==$personType)
		{
			if ($prop["CODE"]=="PHONE")
			{
				CSaleOrderPropsValue::Add(array( 'ORDER_ID' => $orderID, 'NAME' => $prop['NAME'], 'ORDER_PROPS_ID' => $prop['ID'], 'CODE' => $prop['CODE'], 'VALUE' => $_POST['ONE_CLICK_BUY']["PHONE"]));
			}
			if ($prop["CODE"]=="FIO")
			{
				CSaleOrderPropsValue::Add(array( 'ORDER_ID' => $orderID, 'NAME' => $prop['NAME'], 'ORDER_PROPS_ID' => $prop['ID'], 'CODE' => $prop['CODE'], 'VALUE' => $_POST['ONE_CLICK_BUY']["USER_NAME"]));
			}
		}
	}
	
	$_SESSION['SALE_BASKET_NUM_PRODUCTS'][SITE_ID] = 0;
	CSaleOrder::Update($orderID,  array('PRICE' => $orderPrice));

	die(getJson(GetMessage('EMPTY_BASKET'), 'Y'));
}
die(getJson(GetMessage('NO_PROPER_DATA')));
?>