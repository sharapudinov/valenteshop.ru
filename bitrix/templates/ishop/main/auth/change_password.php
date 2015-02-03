<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
extract($_REQUEST, EXTR_SKIP);
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".SITE_TEMPLATE_ID."/main/auth/auth_form.php");
$cur_page = $GLOBALS["APPLICATION"]->GetCurPage();
$str = "";
if(defined("AUTH_404"))
{
	$page = SITE_DIR."auth.php";
	$str = "<input type='hidden' name='backurl' value='".$GLOBALS["APPLICATION"]->GetCurPage()."'>";
}
else 
	$page = $cur_page;

ShowMessage($arAuthResult);
?>
<form class="ishop auth" method="POST" action="<?echo $page.(($s=DeleteParam(array("change_password"))) == ""? "?change_password=yes":"?$s&change_password=yes")?>" name="bform">
<?=$str?>
<input type="hidden" name="AUTH_FORM" value="Y">
<input type="hidden" name="TYPE" value="CHANGE_PWD">

	<label><?=GetMessage("AUTH_LOGIN")?><font class="starrequired">*</font></label>
	<input type="text" name="USER_LOGIN" size="30" maxlength="50" value="<?echo (strlen($USER_LOGIN)>0) ? htmlspecialcharsbx($USER_LOGIN) : htmlspecialcharsbx($last_login)?>" class="inputtext">
	<label><?=GetMessage("AUTH_CHECKWORD")?><font class="starrequired">*</font></label>
	<input type="text" name="USER_CHECKWORD" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_CHECKWORD)?>" class="inputtext">
	<label><?=GetMessage("AUTH_NEW_PASSWORD")?><font class="starrequired">*</font></label>
	<input type="password" name="USER_PASSWORD" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_PASSWORD)?>" class="inputtext">
	<label><?=GetMessage("AUTH_NEW_PASSWORD_CONFIRM")?><font class="starrequired">*</font></label>
	<input type="password" name="USER_CONFIRM_PASSWORD" size="30" maxlength="50" value="<?echo htmlspecialcharsbx($USER_CONFIRM_PASSWORD)?>" class="inputtext">
	<br/><button class="button2" type="submit" name="change_pwd" value="<?=GetMessage("AUTH_CHANGE")?>" class="inputbodybutton"><span><?=GetMessage("AUTH_CHANGE")?></span></button><br/><br/>
	
<p><font class="starrequired">*</font><font class="text"><?=GetMessage("AUTH_REQ")?></font></p>
<p><font class="text">
<a href="<?=$cur_page.($s=="" ? "?login=yes" : "?$s&login=yes")?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
</font></p> 

</form>

<script>
<!--
document.bform.USER_LOGIN.focus();
// -->
</script>