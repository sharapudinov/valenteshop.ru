<?
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "VALENTE - мебель и сантехника для ванных комнат");
$APPLICATION->SetPageProperty("description", "VALENTE - мебель и сантехника для ванных комнат");
	$APPLICATION->SetTitle("Контактная информация");
?> 
<div width="100%" cellspacing="0" cellpadding="0" border="0" class="main_contacts"> 	 
  <div class="map"> 		<?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view",
	".default",
	Array(
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:4:{s:10:\"google_lat\";d:55.71868814509245;s:10:\"google_lon\";d:37.78049426123868;s:12:\"google_scale\";i:17;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:4:\"TEXT\";s:21:\"Валенте Шоп\";s:3:\"LON\";d:37.779868841171;s:3:\"LAT\";d:55.718844049339;}}}",
		"MAP_WIDTH" => "760",
		"MAP_HEIGHT" => "380",
		"CONTROLS" => array(0=>"SMALL_ZOOM_CONTROL",1=>"TYPECONTROL",2=>"SCALELINE",),
		"OPTIONS" => array(0=>"ENABLE_DBLCLICK_ZOOM",1=>"ENABLE_DRAGGING",2=>"ENABLE_KEYBOARD",),
		"MAP_ID" => ""
	)
);?> 	 	</div>
 	 
  <div class="right_block"> 		 
    <div class="description"> 			<?$APPLICATION->IncludeFile(SITE_DIR."include/contacts.php", Array(), Array("MODE"      => "html","NAME"      => "",));?> 		</div>
   		 
    <div class="contacts_wrapp"> 		 
      <table cellspacing="0" cellpadding="0" border="0" width="100%"> 			 
        <tbody> 
          <tr><td valign="top" style="line-height: 18px;"> 					<b style="font-size: 13px; color: rgb(0, 0, 0);">Адрес</b> 
              <br />
             ООО &quot;Контакт Плюс&quot;, Москва, Рязанский проспект 30/15, 
              <br />
             9 этаж, офис 904 
              <br />
             ОГРН 1137746176039                                  
              <br />
             
              <br />
             					<b style="font-size: 13px; color: rgb(0, 0, 0);">Телефон:</b> 
              <br />
             <span id="comagic_phone3"><?='+7 (495) 741-19-12';?> </span> 
              <br />
             
              <br />
             					<b style="font-size: 13px; color: rgb(0, 0, 0);">E-mail:</b> 
              <br />
             <a href="mailto:info@valenteshop.ru" style="color: rgb(24, 139, 119); outline: none;" >info@valenteshop.ru</a> 
              <br />
             <a href="mailto:sale@valenteshop.ru" style="color: rgb(24, 139, 119); outline: none;" >sale@valenteshop.ru</a> 				</td><td valign="top" style="padding-left: 10px;"> 					<b style="font-size: 13px; color: rgb(0, 0, 0);">Режим работы:</b> 
              <br />
             <span style="font-size: 13px; line-height: 18px;">ежедневно:  с 10:00 до 18:30</span> 
              <br />
             </td> 			</tr>
         		 </tbody>
       </table>
     
      <br />
     		 		 		</div>
   									 		 	</div>
 
  <div class="feedback_form"> 				<?$APPLICATION->IncludeComponent(
	"bitrix:form",
	"shop_faq",
	Array(
		"START_PAGE" => "new",
		"SHOW_LIST_PAGE" => "N",
		"SHOW_EDIT_PAGE" => "N",
		"SHOW_VIEW_PAGE" => "N",
		"SUCCESS_URL" => "",
		"WEB_FORM_ID" => "1",
		"RESULT_ID" => "",
		"SHOW_ANSWER_VALUE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_STATUS" => "N",
		"EDIT_ADDITIONAL" => "N",
		"EDIT_STATUS" => "N",
		"NOT_SHOW_FILTER" => array(0=>"",1=>"",),
		"NOT_SHOW_TABLE" => array(0=>"",1=>"",),
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"AJAX_OPTION_ADDITIONAL" => "",
		"VARIABLE_ALIASES" => Array(
			"action" => "action"
		)
	)
);?> 			</div>
 	 </div>
 	 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>