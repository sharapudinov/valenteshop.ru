<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>                <?if($APPLICATION->GetCurDir()!=SITE_DIR){?></div><?}?>
            </div>
         </div>
		</div>
		<!-- footer -->
		<div id="footer">
      	<div class="footer-box">
         	<div class="left">
                <div class="right">
               	 <div class="inner">
                    <div class="col-1">
                        <p class="phone"><strong style="float: left; margin: 0 5px 0 0;"><?=GetMessage('FOOTER_PHONE')?></strong> <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/telephone.php"), false);?></p>
                        <div class="clear"></div>                        
                        <p class="icq"><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/icq.php"), false);?></p>
                        <div class="clear"></div>
                    </div>
                    <div class="col-2">
					    <?$APPLICATION->IncludeComponent("bitrix:menu", "bottom", Array(
	"ROOT_MENU_TYPE" => "bottom",	// Тип меню для первого уровня
	"MAX_LEVEL" => "1",	// Уровень вложенности меню
	),
	false
);?>
					</div>
                 </div>
                </div>
            </div>
         </div>
         <div class="indent">
         	<div class="wrapper">
               <div class="fleft">&copy; <?=date('Y')?> | <a href="<?=SITE_DIR?>" ><?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/copyright.php"), false);?></a>
					<br />
					<?=GetMessage('site_create')?>&nbsp; &nbsp;<a href="http://www.webvbi.ru" target="blank"><?=GetMessage('webvbi')?></a>
				</div>
			   <div class="fright">
			   <!--<img alt="" src="images/footer-img.jpg" />-->
					<span><?=GetMessage('work_on')?>&nbsp; &nbsp; </span>
					<a href="http://www.1c-bitrix.ru" title="<?=GetMessage('bitrix')?>" target="_blank">
						<img src="<?=SITE_TEMPLATE_PATH?>/images/1c.png" width="111px" height="21px" alt="<?=GetMessage('bitrix')?>"/>
					</a>
			   </div>
            </div>
         </div>
      </div>
	</div>
</div>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter22807384 = new Ya.Metrika({id:22807384,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/22807384" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>