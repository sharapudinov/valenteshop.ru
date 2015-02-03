<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();$this->setFrameMode(true);?>
<?if( !empty( $arResult ) ){?>
	<ul class="mini-menu">
		<li><a href="#"><?=GetMessage('MENU_NAME')?></a></li>
	</ul>
	<ul class="menu">
		<?foreach( $arResult as $key => $arItem ){?>
			<li><a href="<?=$arItem["LINK"]?>" <?if( $arItem["SELECTED"] ):?>class="current"<?endif?>><?=$arItem["TEXT"]?></a>
				<?if(( $arItem["IS_PARENT"] == 1 ) && ($arItem["LINK"] != $arParams["IBLOCK_CATALOG_DIR"]) ){?>
					<div class="child submenu">
						<?foreach( $arItem["ITEMS"] as $arSubItem ){?>
							<a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?></a>
						<?}?>
					</div>
				<?}?>
				
				<?if( $arItem["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] ){?>
					<div class="child cat_menu">
						<?foreach( $arItem["ITEMS"] as $arItems ){?>
							<ul>
								<li class="menu_title"><a href="<?=$arItems["LINK"]?>"><?=$arItems["TEXT"]?></a></li>
								<?$i = 1;?>
								<?foreach( $arItems["ITEMS"] as $arItem ){?>
									<li  <?=$i > 5 ? 'class="d menu_item" style="display: none;"' : 'class="menu_item"'?>><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
									<?$i++;?>
								<?}?>
								<!--noindex-->
									<?if( count( $arItems["ITEMS"] ) > 5 ){?>
										<li class="see_more">
											<a rel="nofollow" href="#" onclick="if( $(this).hasClass('open') ){ $(this).text('<?=GetMessage('CATALOG_VIEW_MORE')?>').removeClass('open').parent().parent().find('li.d').hide(); }else{ $(this).text('<?=GetMessage('CATALOG_VIEW_LESS')?>').addClass('open').parent().parent().find('li.d').show(); } return false;"><?=GetMessage('CATALOG_VIEW_MORE')?></a>
										</li>
									<?}?>
								<!--/noindex-->
							</ul>
						<?}?>
					</div>
				<?}?>
			</li>
		<?}?>
	</ul>
<?}?>