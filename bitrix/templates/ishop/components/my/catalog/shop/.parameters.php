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
	
	"SKU_DISPLAY_LOCATION" => Array(
		"NAME" => GetMessage("SKU_DISPLAY_LOCATION"),
		"TYPE" => "LIST",
		"VALUES" => array("RIGHT"=>GetMessage("SKU_DISPLAY_LOCATION_RIGHT"), "BOTTOM"=>GetMessage("SKU_DISPLAY_LOCATION_BOTTOM")),
		"DEFAULT" => "RIGHT",
		"PARENT" => "DETAIL_SETTINGS",
	),
	"PROPERTIES_DISPLAY_LOCATION" => Array(
		"NAME" => GetMessage("PROPERTIES_DISPLAY_LOCATION"),
		"TYPE" => "LIST",
		"VALUES" => array("DESCRIPTION"=>GetMessage("PROPERTIES_DISPLAY_LOCATION_DESCRIPTION"), "TAB"=>GetMessage("PROPERTIES_DISPLAY_LOCATION_TAB")),
		"DEFAULT" => "DESCRIPTION",
		"PARENT" => "DETAIL_SETTINGS",
	),
	"PROPERTIES_DISPLAY_TYPE" => Array(
		"NAME" => GetMessage("PROPERTIES_DISPLAY_TYPE"),
		"TYPE" => "LIST",
		"VALUES" => array("BLOCK"=>GetMessage("PROPERTIES_DISPLAY_TYPE_BLOCK"), "TABLE"=>GetMessage("PROPERTIES_DISPLAY_TYPE_TABLE")),
		"DEFAULT" => "BLOCK",
		"PARENT" => "DETAIL_SETTINGS",
	),
	"SHOW_QUANTITY" => Array(
			"NAME" => GetMessage("SHOW_QUANTITY"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
	),
	"SHOW_BRAND_PICTURE" => Array(
			"NAME" => GetMessage("SHOW_BRAND_PICTURE"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"SHOW_FOUND_CHEAPER" => Array(
			"NAME" => GetMessage("SHOW_FOUND_CHEAPER"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"SHOW_ASK_BLOCK" => Array(
			"NAME" => GetMessage("SHOW_ASK_BLOCK"),
			"TYPE" => "CHECKBOX",
			"DEFAULT" => "Y",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"ASK_FORM_ID" => Array(
			"NAME" => GetMessage("ASK_FORM_ID"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
			"PARENT" => "DETAIL_SETTINGS",
	),
	"DEFAULT_LIST_TEMPLATE" => Array(
			"NAME" => GetMessage("DEFAULT_LIST_TEMPLATE"),
			"TYPE" => "LIST",
			"VALUES" => array("table"=>GetMessage("DEFAULT_LIST_TEMPLATE_TABLE"), "list"=>GetMessage("DEFAULT_LIST_TEMPLATE_LIST")),
			"DEFAULT" => "list",
			"PARENT" => "LIST_SETTINGS",
	),
	
);

?>
