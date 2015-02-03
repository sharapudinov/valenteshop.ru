<?
	if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	global $SectionPageProperties;
	foreach($SectionPageProperties as $code => $value ) { if ($value) { $APPLICATION->SetPageProperty($code, $value); }}
?>