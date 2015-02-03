<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$arElementsID = array();
foreach($arResult as $key => $val)
{
	
	$arElementsID[] = $val["PRODUCT_ID"];
	$img = "";
	if ($val["DETAIL_PICTURE"] > 0)
		$img = $val["DETAIL_PICTURE"];
	elseif ($val["PREVIEW_PICTURE"] > 0)
		$img = $val["PREVIEW_PICTURE"];

	$file = CFile::ResizeImageGet($img, array('width'=>$arParams["VIEWED_IMG_WIDTH"], 'height'=>$arParams["VIEWED_IMG_HEIGHT"]), BX_RESIZE_IMAGE_PROPORTIONAL, true);

	$val["PICTURE"] = $file;
	$arResult[$key] = $val;
}


$arElements = array();
$db_res = CIBlockElement::GetList(Array("SORT"=>"ASC"),  Array("ID"=>$arElementsID), false, false, Array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL"));
while($arElement = $db_res->GetNext())
{
	foreach($arResult as $key => $val)
	{
		if ($arElement["ID"]==$val["PRODUCT_ID"])
		{
			$arResult[$key]["DETAIL_PAGE_URL"]=$arElement["DETAIL_PAGE_URL"];
		}
	}
}


?>