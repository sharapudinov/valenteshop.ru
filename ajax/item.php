<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!CModule::IncludeModule("sale") || !CModule::IncludeModule("catalog") || !CModule::IncludeModule("iblock")) {
	echo "failure";
	return;
}

//session_start();
//session_name('PHPSESSID');

if( !empty( $_REQUEST["add_item"] ) ){ // Добавление в корзину
	if( $_REQUEST["add_item"] == "Y" ){
		$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"PRODUCT_ID" => $_POST["item_id"],
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
				),
			false,
			false,
			array("ID", "DELAY")
		)->Fetch();
		
		if( !empty( $dbBasketItems ) && $dbBasketItems["DELAY"] == "Y" ){
			$arFields = array(
				"DELAY" => "N"
			);
			CSaleBasket::Update($dbBasketItems["ID"], $arFields);
		}else{
			Add2BasketByProductID(
				$_REQUEST["item_id"], 
				$_REQUEST["quantity"]
			);
		}
	}else{
		
	}
}elseif( !empty( $_REQUEST["wish_item"] ) ){ // Добавляем товар в вишлист
	if( $_REQUEST["wish_item"] == "Y" ){
		$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"PRODUCT_ID" => $_POST["item_id"],
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
				),
			false,
			false,
			array("ID", "DELAY")
		)->Fetch();
		
		if( !empty( $dbBasketItems ) && $dbBasketItems["DELAY"] == "N" ){
			$arFields = array(
				"DELAY" => "Y"
			);
			CSaleBasket::Update($dbBasketItems["ID"], $arFields);
		}else{
			$id = Add2BasketByProductID(
				$_REQUEST["item_id"], 
				$_REQUEST["quantity"]
			);
			
			$arFields = array(
				"DELAY" => "Y"
			);
			CSaleBasket::Update($id, $arFields);
			
		}
	}else{
		$dbBasketItems = CSaleBasket::GetList(
			array(
					"NAME" => "ASC",
					"ID" => "ASC"
				),
			array(
					"PRODUCT_ID" => $_REQUEST["item_id"],
					"FUSER_ID" => CSaleBasket::GetBasketUserID(),
					"LID" => SITE_ID,
					"ORDER_ID" => "NULL"
				),
			false,
			false,
			array("ID", "DELAY")
		)->Fetch();
		
		if( !empty( $dbBasketItems ) ){
			CSaleBasket::Delete($dbBasketItems["ID"]);
		}
	}
}elseif( !empty( $_REQUEST["compare_item"] ) ){
	$iblock_id = $_REQUEST["iblock_id"];
	if( !empty( $_SESSION["CATALOG_COMPARE_LIST"] ) && !empty($_SESSION["CATALOG_COMPARE_LIST"][$iblock_id]) && array_key_exists($_REQUEST["item_id"], $_SESSION["CATALOG_COMPARE_LIST"][$iblock_id]["ITEMS"]) ){
		unset( $_SESSION["CATALOG_COMPARE_LIST"][$iblock_id]["ITEMS"][$_REQUEST["item_id"]] );
	}else{
		$_SESSION["CATALOG_COMPARE_LIST"][$iblock_id]["ITEMS"][$_REQUEST["item_id"]] = CIBlockElement::GetByID($_REQUEST["item_id"])->Fetch();
	}
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>