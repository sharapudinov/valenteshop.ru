<?
	$arElementsID = array();
	$arProductsToElements = array();

	foreach($arResult["ITEMS"]["AnDelCanBuy"] as $key => $val)
	{
		if ($arResult["ITEMS_IMG"][$val["ID"]])
		{
			$arResult["ITEMS"]["AnDelCanBuy"][$key]["DETAIL_PICTURE"] = $arResult["ITEMS_IMG"][$val["ID"]];
		} else {$arElementsID[] = $val["PRODUCT_ID"];}
		if ($productId = CCatalogSku::GetProductInfo($val["PRODUCT_ID"]))
		{
			$arElementsID[] = $productId["ID"];
			$arProductsToElements[$productId["ID"]][] = $val["PRODUCT_ID"];
		}
	}


	foreach($arResult["ITEMS"]["DelDelCanBuy"] as $key => $val)
	{
		if ($arResult["ITEMS_IMG"][$val["ID"]])
		{
			$arResult["ITEMS"]["DelDelCanBuy"][$key]["DETAIL_PICTURE"] = $arResult["ITEMS_IMG"][$val["ID"]];

		} else  { $arElementsID[] = $val["PRODUCT_ID"]; }
		if ($productId = CCatalogSku::GetProductInfo($val["PRODUCT_ID"]))
		{
			$arElementsID[] = $productId["ID"];

			$arProductsToElements[$productId["ID"]][] = $val["PRODUCT_ID"];
		}
	}


	foreach($arResult["ITEMS"]["nAnCanBuy"] as $key => $val)
	{
		if ($arResult["ITEMS_IMG"][$val["ID"]])
		{
			$arResult["ITEMS"]["nAnCanBuy"][$key]["DETAIL_PICTURE"] = $arResult["ITEMS_IMG"][$val["ID"]];
		} else {$arElementsID[] = $val["PRODUCT_ID"];}
		if ($productId = CCatalogSku::GetProductInfo($val["PRODUCT_ID"]))
		{
			$arElementsID[] = $productId["ID"];
			$arProductsToElements[$productId["ID"]][] = $val["PRODUCT_ID"];
		}
	}
	
	foreach($arResult["ITEMS"]["ProdSubscribe"] as $key => $val)
	{
		if ($arResult["ITEMS_IMG"][$val["ID"]])
		{
			$arResult["ITEMS"]["ProdSubscribe"][$key]["DETAIL_PICTURE"] = $arResult["ITEMS_IMG"][$val["ID"]];
		} else {$arElementsID[] = $productId["ID"];}
		if ($productId = CCatalogSku::GetProductInfo($val["PRODUCT_ID"]))
		{
			$arElementsID[] = $productId["ID"];
			$arProductsToElements[$productId["ID"]][] = $val["PRODUCT_ID"];
		}
	}

	$arElementsID = array_unique($arElementsID);

	$db_res = CIBlockElement::GetList(Array("SORT"=>"ASC"),  Array("ID"=>$arElementsID), false, false, Array("ID", "IBLOCK_ID", "DETAIL_PAGE_URL", "DETAIL_PICTURE", "PREVIEW_PICTURE"));
	while($arElement = $db_res->GetNext())
	{
		foreach($arResult["ITEMS"]["AnDelCanBuy"] as $key => $val)
		{
			if (in_array($val["PRODUCT_ID"], $arProductsToElements[$arElement["ID"]]))
			{
				$arResult["ITEMS"]["AnDelCanBuy"][$key]["DETAIL_PAGE_URL"]=$arElement["DETAIL_PAGE_URL"];
			}
			if (!$arResult["ITEMS"]["AnDelCanBuy"][$key]["DETAIL_PICTURE"]["SRC"] && ($val["PRODUCT_ID"]==$arElement["ID"]))
			{
			
				if (!$arResult["ITEMS"]["AnDelCanBuy"][$key]["PREVIEW_PICTURE"]["SRC"])
				{
					$img = array();
					if ($arElement["DETAIL_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], Array("width" => "80", "height" => "80")); }
					elseif ($arElement["PREVIEW_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => "80", "height" => "80")); }
					if ($img["src"])  { foreach($img as $i=>$v) {$arResult["ITEMS"]["AnDelCanBuy"][$key]["DETAIL_PICTURE"][strtoupper($i)]=$v;} }
				} else {$arResult["ITEMS"]["AnDelCanBuy"][$key]["DETAIL_PICTURE"]["SRC"] = $arResult["ITEMS"]["AnDelCanBuy"][$key]["PREVIEW_PICTURE"]["SRC"];}
			}
			
		}

		foreach($arResult["ITEMS"]["DelDelCanBuy"] as $key => $val)
		{
			if (in_array($val["PRODUCT_ID"], $arProductsToElements[$arElement["ID"]]))
			{
				$arResult["ITEMS"]["DelDelCanBuy"][$key]["DETAIL_PAGE_URL"]=$arElement["DETAIL_PAGE_URL"];
			}
			if (!$arResult["ITEMS"]["DelDelCanBuy"][$key]["DETAIL_PICTURE"]["SRC"] && ($val["PRODUCT_ID"]==$arElement["ID"]))
			{


				if (!$arResult["ITEMS"]["DelDelCanBuy"][$key]["PREVIEW_PICTURE"]["SRC"])
				{
					$img = array();
					if ($arElement["DETAIL_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], Array("width" => "80", "height" => "80")); }
					elseif ($arElement["PREVIEW_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => "80", "height" => "80")); }
					if ($img["src"])  { foreach($img as $i=>$v) {$arResult["ITEMS"]["DelDelCanBuy"][$key]["DETAIL_PICTURE"][strtoupper($i)]=$v;} }
				} else {$arResult["ITEMS"]["DelDelCanBuy"][$key]["DETAIL_PICTURE"]["SRC"] = $arResult["ITEMS"]["DelDelCanBuy"][$key]["PREVIEW_PICTURE"]["SRC"];}
			}
		}
		
		foreach($arResult["ITEMS"]["nAnCanBuy"] as $key => $val)
		{
			if (in_array($val["PRODUCT_ID"], $arProductsToElements[$arElement["ID"]]))
			{
				$arResult["ITEMS"]["nAnCanBuy"][$key]["DETAIL_PAGE_URL"]=$arElement["DETAIL_PAGE_URL"];
			}
			if (!$arResult["ITEMS"]["nAnCanBuy"][$key]["DETAIL_PICTURE"]["SRC"] && ($val["PRODUCT_ID"]==$arElement["ID"]))
			{
				if (!$arResult["ITEMS"]["nAnCanBuy"][$key]["PREVIEW_PICTURE"]["SRC"])
				{
					$img = array();
					if ($arElement["DETAIL_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], Array("width" => "80", "height" => "80")); }
					elseif ($arElement["PREVIEW_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => "80", "height" => "80")); }
					if ($img["src"])  { foreach($img as $i=>$v) {$arResult["ITEMS"]["nAnCanBuy"][$key]["DETAIL_PICTURE"][strtoupper($i)]=$v;} }
				} else {$arResult["ITEMS"]["nAnCanBuy"][$key]["DETAIL_PICTURE"]["SRC"] = $arResult["ITEMS"]["nAnCanBuy"][$key]["PREVIEW_PICTURE"]["SRC"];}
			}	
		}
		
		foreach($arResult["ITEMS"]["ProdSubscribe"] as $key => $val)
		{
			if (in_array($val["PRODUCT_ID"], $arProductsToElements[$arElement["ID"]]))
			{
				$arResult["ITEMS"]["ProdSubscribe"][$key]["DETAIL_PAGE_URL"]=$arElement["DETAIL_PAGE_URL"];
			}
			if (!$arResult["ITEMS"]["ProdSubscribe"][$key]["DETAIL_PICTURE"]["SRC"] && ($val["PRODUCT_ID"]==$arElement["ID"]))
			{
				if (!$arResult["ITEMS"]["ProdSubscribe"][$key]["PREVIEW_PICTURE"]["SRC"])
				{
					$img = array();
					if ($arElement["DETAIL_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], Array("width" => "80", "height" => "80")); }
					elseif ($arElement["PREVIEW_PICTURE"]) { $img = CFile::ResizeImageGet($arElement["PREVIEW_PICTURE"], Array("width" => "80", "height" => "80")); }
					if ($img["src"])  { foreach($img as $i=>$v) {$arResult["ITEMS"]["ProdSubscribe"][$key]["DETAIL_PICTURE"][strtoupper($i)]=$v;} }
				} else {$arResult["ITEMS"]["ProdSubscribe"][$key]["DETAIL_PICTURE"]["SRC"] = $arResult["ITEMS"]["ProdSubscribe"][$key]["PREVIEW_PICTURE"]["SRC"];}
			}
		}
	}
?>