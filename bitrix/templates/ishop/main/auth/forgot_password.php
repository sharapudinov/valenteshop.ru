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
<form class="ishop auth" name="bform" method="post" target="_top" action="<?=$page.(($s=DeleteParam(array("forgot_password"))) == ""? "?forgot_password=yes":"?$s&forgot_password=yes")?>">
	<?=$str?>
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<p><font class="text">
	<?=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
	</font></p>

	<label><?=GetMessage("AUTH_LOGIN")?></label>
	<input type="text" name="USER_LOGIN" maxlength="50" size="20" value="<?echo htmlspecialcharsbx($last_login)?>" class="inputtext">&nbsp;<font class="tablebodytext"><?=GetMessage("AUTH_OR")?>&nbsp;</nobr></font>
	<label>E-Mail:</label>
	<input type="text" name="USER_EMAIL" maxlength="255" size="20" class="inputtext">
	<br/><button class="button2" type="submit" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" class="inputbodybutton"><span><?=GetMessage("AUTH_SEND")?></span></button><br/><br/>
	
	
<p><font class="text">
<a href="<?=$cur_page.($s=="" ? "?login=yes" : "?$s&login=yes")?>"><b><?=GetMessage("AUTH_AUTH")?></b></a>
</font></p> 
</form>
<script>
<!--
document.bform.USER_LOGIN.focus();
// -->
</script>