<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->SetTitle(GetMessage("AUTH_AUTH"));?>
<?if(!$USER->isAuthorized()):?>
	<div class="module-authorization">
		<?if ($arResult['SHOW_ERRORS'] == 'Y' ){ ShowMessage($arResult['ERROR_MESSAGE']);}?>
		<script>$(document).ready(function(){ $(".form-block form").validate({ rules:{ USER_LOGIN: { email:true, required:true } } }); })</script>
		
		<p><?=GetMessage("AUTH_TO_CONTINUE")?></p>
		<div class="authorization-cols">
			<div class="col authorization">
				<div class="auth-title"><?=GetMessage("ALLREADY_REGISTERED")?></div>
				<div class="form-block">
					<div class="intro"><?=GetMessage("GLAD_TO_SEE_YOU");?></div>
						<form id="avtorization-form-page" name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=SITE_DIR?>auth/<?=!empty( $_REQUEST["backurl"] ) ? '?backurl='.$_REQUEST["backurl"] : ''?>">
							<?if($arResult["BACKURL"] <> ''):?><input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" /><?endif?>
							<?foreach ($arResult["POST"] as $key => $value):?><input type="hidden" name="<?=$key?>" value="<?=$value?>" /><?endforeach?>
							<input type="hidden" name="AUTH_FORM" value="Y" />
							<input type="hidden" name="TYPE" value="AUTH" />
							<div class="r">
								<label><?=GetMessage("EMAIL")?>:<span class="star">*</span></label>
								<input type="text"  name="USER_LOGIN" required maxlength="50" value="<?=$arResult["USER_LOGIN"]?>" size="17" tabindex="7" />
								<?if($_POST["USER_LOGIN"]=='' && isset($_POST["USER_LOGIN"])){?><label class="error"><?=GetMessage("FIELD_REQUIRED")?></label><?}?>
							</div>
							<div class="r">
								<label><?=GetMessage("AUTH_PASSWORD")?>:<span class="star">*</span></label><br />									
								<input type="password" name="USER_PASSWORD" required maxlength="50" size="17" tabindex="8" />
								<a class="forgot" href="<?=SITE_DIR?>auth/forgot-password/<?=!empty( $_REQUEST["backurl"] ) ? '?backurl='.$_REQUEST["backurl"] : ''?>" tabindex="9"><?=GetMessage("FORGOT_PASSWORD")?></a>
								<?if($_POST["USER_PASSWORD"]=='' && isset($_POST["USER_PASSWORD"])){?><label class="error"><?=GetMessage("FIELD_REQUIRED")?></label><?}?>
							</div>
							<div class="but-r">
								<button type="submit" class="button25 orange" name="Login" tabindex="10"><span><?=GetMessage("AUTH_LOGIN_BUTTON")?></span></button>
								<div class="remember">
									<input id="remuser" type="checkbox" tabindex="11"/>
									<label for="remuser" tabindex="11"><?=GetMessage("AUTH_REMEMBER_ME")?></label>
								</div>
								<div class="clearboth"></div>
							</div>							
						</form>
						<div class="soc-avt">
							<?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "icons", array( "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"], "SUFFIX"=>"form"), $component, array("HIDE_ICONS"=>"Y"));?>
						</div>
				</div>
				
			</div>
			<div class="col registration">
				<div class="auth-title"><?=GetMessage("NEW_USER")?></div>	
				<div class="form-block">
					<p><?=GetMessage("ORDER_AUTH_DESCRIPTION")?></p><?=GetMessage("TWO_MINUTES")?>: <br /><br />
					<!--noindex-->
						<a href="<?=SITE_DIR?>auth/registration/<?=!empty( $_REQUEST["backurl"] ) ? '?backurl='.$_REQUEST["backurl"] : ''?>" class="button1 user-ic" rel="nofollow">
							<span><?=GetMessage("REGISTER")?></span>
						</a>
					<!--/noindex-->
				</div>					
			</div>
		</div>
	</div>
	
	<script type="text/javascript">

		var fRand = function() {return Math.floor(arguments.length > 1 ? (999999 - 0 + 1) * Math.random() + 0 : (0 + 1) * Math.random());};
		
		var waitForFinalEvent = (function () 
		{
		  var timers = {};
		  return function (callback, ms, uniqueId) 
		  {
			if (!uniqueId) {
			  uniqueId = fRand();
			}
			if (timers[uniqueId]) {
			  clearTimeout (timers[uniqueId]);
			}
			timers[uniqueId] = setTimeout(callback, ms);
		  };
		})();

		if ($(window).width()>=600)
		{
			$('.authorization-cols').equalize({children: '.col .auth-title', reset: true});
			$('.authorization-cols').equalize({children: '.col .form-block', reset: true}); 
		}
		
		$(document).ready(function()
		{
			$(window).resize(function () 
			{
				waitForFinalEvent(function() 
				{ 
					if ($(window).width()>=600)
					{
						$('.authorization-cols').equalize({children: '.col .auth-title', reset: true}); 
						$('.authorization-cols').equalize({children: '.col .form-block', reset: true}); 
					}
				}, 333, fRand());
			});
		});
	</script>
	
<?endif;?>