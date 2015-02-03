<?
	$arMenu = array();
	$inx = 0;
	for( $i = 0; $i < count($arResult); $i++ ){
		if( $arResult[$i]["DEPTH_LEVEL"] == 1 ):
			$arMenu[$inx] = $arResult[$i];
			if( $arResult[$i]["IS_PARENT"] == 1 ):
				while(1){
					$i++;
					$arMenu[$inx]["ITEMS"][] = $arResult[$i];
					if( $i+1 >= count($arResult) || $arResult[$i+1]["DEPTH_LEVEL"] == 1 ):
						break;
					endif;
				}
			endif;
			$inx++;
		endif;
	}
	$arResult = $arMenu;
		
	$arCatalogItems = array();
	foreach($arResult as $key => $value)
	{
		if ( $value["LINK"] == $arParams["IBLOCK_CATALOG_DIR"] )
		{
			foreach( $value["ITEMS"] as $i => $arItem )
			{
				if( $arItem["PARAMS"]["DEPTH_LEVEL"] == 1 ) { $arCatalogItems[$i] = $arItem; }
			}
			
			foreach( $value["ITEMS"] as $i => $arItem )
			{
				if( $arItem["PARAMS"]["DEPTH_LEVEL"] == 2 )
				{
					foreach ($arCatalogItems as $j => $val)
					{
						$stripos = stripos($arItem["LINK"], $val["LINK"]);
						if ($stripos!==false) { $arCatalogItems[$j]["ITEMS"][] = $arItem; }
					}
				}
			}
			$arResult[$key]["ITEMS"] = $arCatalogItems;
		}
	}
?>