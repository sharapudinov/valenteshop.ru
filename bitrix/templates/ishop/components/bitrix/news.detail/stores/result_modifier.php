<?if( !empty( $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] ) ):
	$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE_SMALL"] = array();
	foreach( $arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $img_id ):
		$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"][$key] = CFile::GetFileArray($img_id);
		$resize_img = CFile::ResizeImageGet( $img_id, array( "width" => 140, "height" => 90 ), BX_RESIZE_IMAGE_PROPORTIONAL, true, array() );
		$arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE_SMALL"][$key] = array( "SRC" => $resize_img["src"] );
	endforeach;
endif;?>