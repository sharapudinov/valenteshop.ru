<?
define("NO_KEEP_STATISTIC", true);
define("NOT_CHECK_PERMISSIONS", true);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
include(GetLangFileName($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sale/payment/best2pay/", "/payment.php"));
include($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/sale/payment/best2pay/common.php");

$fail_url = "http://" . getServerHost();

try {
	if (!CModule::IncludeModule("sale"))
		throw new Exception("Error when initializing sale module");

	$arOrder = CSaleOrder::GetByID(intval($_REQUEST["reference"]));
	if (!$arOrder)
		throw new Exception("No such order id");
	CSalePaySystemAction::InitParamArrays($arOrder, $arOrder["ID"]);

	$sector = CSalePaySystemAction::GetParamValue("Sector");
	$password = CSalePaySystemAction::GetParamValue("Password");
	$test_mode = (strlen(CSalePaySystemAction::GetParamValue("TestMode")) > 0) ?
		intval(CSalePaySystemAction::GetParamValue("TestMode")) :
		1;
	$success_url = (strlen(CSalePaySystemAction::GetParamValue("SuccessURL")) > 0) ?
		CSalePaySystemAction::GetParamValue("SuccessURL") :
		$fail_url;
	$fail_url = (strlen(CSalePaySystemAction::GetParamValue("FailURL")) > 0) ?
		CSalePaySystemAction::GetParamValue("FailURL") :
		$fail_url;

	$b2p_order_id = intval($_REQUEST["id"]);
	if (!$b2p_order_id)
		throw new Exception("Invalid order id");

	$b2p_operation_id = intval($_REQUEST["operation"]);
	if (!$b2p_operation_id)
		throw new Exception("Invalid operation id");

	// check payment operation state
	$signature = base64_encode(md5($sector . $b2p_order_id . $b2p_operation_id . $password));

	$best2pay_url = "https://pay.best2pay.net";
	if ($test_mode == 1)
		$best2pay_url = "https://test.best2pay.net";

	$context  = stream_context_create(array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query(array(
				'sector' => $sector,
				'id' => $b2p_order_id,
				'operation' => $b2p_operation_id,
				'signature' => $signature
			)),
		)
	));

	$repeat = 3;

	while ($repeat) {

		$repeat--;

		// pause because of possible background processing in the Best2Pay
		sleep(2);

		$xml = file_get_contents($best2pay_url . '/webapi/Operation', false, $context);
		if (!$xml)
			throw new Exception("Empty data");
		$xml = simplexml_load_string($xml);
		if (!$xml)
			throw new Exception("Non valid XML was received");
		$response = json_decode(json_encode($xml));
		if (!$response)
			throw new Exception("Non valid XML was received");

		if (!orderAsPayed($response))
			continue;

		header("Location: {$success_url}", true, 302);
		exit();

	}
	
	header("Location: {$fail_url}", true, 302);
	exit();

} catch (Exception $ex) {
	error_log($ex->getMessage());
	header("Location: {$fail_url}", true, 302);
	exit();
}

?>
