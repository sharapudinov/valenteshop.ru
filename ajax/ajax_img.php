<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if (CModule::IncludeModule("sale"))
{
	$img = CFile::ResizeImageGet($_POST['id'], array('width'=>1000, 'height'=>1000), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	echo $img["src"];
}?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>