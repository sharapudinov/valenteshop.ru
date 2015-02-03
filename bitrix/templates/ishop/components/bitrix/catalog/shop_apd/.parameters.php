<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arTemplateParameters = array(
	"IBLOCK_STOCK_ID" => Array(
		"NAME" => GetMessage("IBLOCK_STOCK_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SEF_MODE_STOCK_SECTIONS" => array(
		"NAME" => GetMessage("SEF_MODE_STOCK_SECTIONS"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SEF_MODE_STOCK_ELEMENT" => array(
		"NAME" => GetMessage("SEF_MODE_STOCK_ELEMENT"),
		"TYPE" => "STRING",
		"DEFAULT" => "#ELEMENT_CODE#/",
	),
	"IBLOCK_ADVT_TYPE" => Array(
		"NAME" => GetMessage("IBLOCK_ADVT_TYPE"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"IBLOCK_ADVT_ID" => Array(
		"NAME" => GetMessage("IBLOCK_ADVT_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"IBLOCK_ADVT_SECTION_ID" => Array(
		"NAME" => GetMessage("IBLOCK_ADVT_SECTION_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"IBLOCK_ADVT_SECTION_ID_SECT" => Array(
		"NAME" => GetMessage("IBLOCK_ADVT_SECTION_NAME_SECT"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	
	"SEF_MODE_BRAND_SECTIONS" => array(
		"NAME" => GetMessage("SEF_MODE_BRAND_SECTIONS"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	"SEF_MODE_BRAND_ELEMENT" => array(
		"NAME" => GetMessage("SEF_MODE_BRAND_ELEMENT"),
		"TYPE" => "STRING",
		"DEFAULT" => "#ELEMENT_CODE#/",
	),
	
	/*"IBLOCK_REVIEWS_TYPE" => Array(
		"NAME" => GetMessage("IBLOCK_REVIEWS_TYPE"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),
	
	"IBLOCK_REVIEWS_ID" => Array(
		"NAME" => GetMessage("IBLOCK_REVIEWS_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "",
	),*/
	
	"SKU_DISPLAY_LOCATION" => Array(
		"NAME" => GetMessage("SKU_DISPLAY_LOCATION"),
		"TYPE" => "LIST",
		"VALUES" => array("RIGHT"=>GetMessage("SKU_DISPLAY_LOCATION_RIGHT"), "BOTTOM"=>GetMessage("SKU_DISPLAY_LOCATION_BOTTOM")),
		"DEFAULT" => "RIGHT",
		"PARENT" => "DETAIL_SETTINGS",
	),
	"SHOW_QUANTITY" => Array(
			"NAME" => GetMessage("SHOW_QUANTITY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
	),
	
);

?>
