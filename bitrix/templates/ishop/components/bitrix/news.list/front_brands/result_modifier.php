<?
	foreach( $arResult["ITEMS"] as $key => $arItem ):
		if( $arItem["DATE_CREATE"] != "" ):
			$time_date = explode(" ", $arItem["DATE_CREATE"]);
			$date = $time_date[0];
			$time = $time_date[1];
			$date = explode(".", $date);
			$day = $date[0];
			$month = $date[1];
			$year = $date[2];
			switch( $month ){
				case "1":
					$month = "������";
					break;
				case "2":
					$month = "�������";
					break;
				case "3":
					$month = "�����";
					break;
				case "4":
					$month = "������";
					break;
				case "5":
					$month = "���";
					break;
				case "6":
					$month = "����";
					break;
				case "7":
					$month = "����";
					break;
				case "8":
					$month = "�������";
					break;
				case "9":
					$month = "��������";
					break;
				case "10":
					$month = "�������";
					break;
				case "11":
					$month = "������";
					break;
				case "12":
					$month = "�������";
					break;
			}
		endif;
		$arResult["ITEMS"][$key]["DATE_CREATE"] = $day." ".$month." ".$year;
	endforeach;
?>