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
<form class="ishop auth" name="form_auth" method="post" target="_top" action="<?echo htmlspecialcharsbx($page).(($s=DeleteParam(array("logout", "login"))) == ""? "?login=yes":"?$s&login=yes");?>">

	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="AUTH">
	<?=$str?>
	<?foreach($GLOBALS["HTTP_POST_VARS"] as $vname=>$vvalue):
	if($vname=="USER_LOGIN")continue;
	?>
		<input type="hidden" name="<?echo htmlspecialcharsbx($vname)?>" value="<?echo htmlspecialcharsbx($vvalue)?>">
	<?endforeach?>

	<p><font class="text"><?=GetMessage("AUTH_PLEASE_AUTH")?></font></p>

	<label><?=GetMessage("AUTH_LOGIN")?></label>
	<input type="text" name="USER_LOGIN" maxlength="50" size="20" value="<?echo htmlspecialcharsbx($last_login)?>" class="inputtext">
	<label><?=GetMessage("AUTH_PASSWORD")?></label>
	<input type="password" name="USER_PASSWORD" maxlength="50" class="inputtext" size="20">
	
	<?if (COption::GetOptionString("main", "store_password", "Y")=="Y") :?>
		<br/><input type="checkbox" name="USER_REMEMBER" id="USER_REMEMBER" value="Y" class="inputcheckbox"><label for="USER_REMEMBER"><?=GetMessage("AUTH_REMEMBER_ME")?></label><br/><br/>
	<?endif;?>
	<button class="button2" type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" class="inputbodybutton"><span><?=GetMessage("AUTH_AUTHORIZE")?></span></button><br/><br/>

<?if ($not_show_links!="Y"):?>
<?if(COption::GetOptionString("main", "new_user_registration", "N")=="Y"):?>
<p>
<font class="text">
<a href="<? echo $cur_page."?register=yes".($s<>""? "&amp;$s":"");?>"><b><?=GetMessage("AUTH_REGISTER")?></b></a>
<br><?=GetMessage("AUTH_FIRST_ONE")?> <a href="<? echo $cur_page."?register=yes".($s<>""? "&amp;$s":"");?>"><?=GetMessage("AUTH_REG_FORM")?></a>.<br>
</font>
</p>
<?endif;?>
<p>
<font class="text">
<a href="<?echo $cur_page."?forgot_password=yes".($s<>""? "&amp;$s":"");?>"><b><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></b></a>
<br><?=GetMessage("AUTH_GO")?> <a href="<?echo $cur_page."?forgot_password=yes".($s<>""? "&amp;$s":"");?>"><?=GetMessage("AUTH_GO_AUTH_FORM")?></a>
<br><?=GetMessage("AUTH_MESS_1")?> <a href="<?echo $cur_page."?change_password=yes".($s<>""? "&amp;$s":"");?>"><?=GetMessage("AUTH_CHANGE_FORM")?></a>
</font>
</p>
<?endif;?>
</form>
<script>
<!--
<? if (strlen($last_login)>0) : ?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<? else : ?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<? endif; ?>
// -->
</script>