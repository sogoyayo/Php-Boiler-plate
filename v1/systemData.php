<?
header('Content-Type: application/json charset=utf-8');
header("Access-Control-Allow-Methods: PUT, GET, POST");

require('../assets/v1/connect.php');

if (isset($_POST['apptoken'])) {
	// code...
	$apptoken = input_check($_POST['apptoken']);
	if (CheckToken($mysqli, $apptoken)==true) {
		// code...
		

$array = [
			'success' => true,
			'color' => "red",
			'app_name' => APP_NAME,
			'app_phone' => APP_PHONE,
			'app_mail' => APP_MAIL,
			'logo' => "",
			'current_time' => time()
		];
				$return = json_encode($array);
		echo "$return";
		exit();


	}else{
		$array = [
			'success' => false,
			'message' => "Unauthorized access.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
	}
}else{
$array = [
			'success' => false,
			'message' => "Unauthorized access.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}

?>