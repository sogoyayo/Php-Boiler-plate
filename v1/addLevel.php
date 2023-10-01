<?
header('Content-Type: application/json charset=utf-8');
header("Access-Control-Allow-Methods: PUT, GET, POST");

require('../assets/v1/connect.php');

$data = file_get_contents('php://input');
$data = json_decode($data);

if (isset($data->apptoken)) {
	// code...
	$apptoken = input_check($data->apptoken);
	if (CheckToken($mysqli, $apptoken)==true) {
		// code...
		
$Mgnt = new Management();

if (isset($data->usertoken) or isset($data->faculty)) {
	// code...
	$faculty = input_check($_POST['faculty']);
	$usertoken = input_check($_POST['usertoken']);

	if ($Mgnt->AddLevel($usertoken, $level)==true) {
		// code...
		$array = [
		'success' => true,
		'message' => "$level has been created."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
	}else{
		$array = [
		'success' => false,
		'message' => "Level not created, please try again..".$_SESSION['err'].""
		];
				$return = json_encode($array);
		echo "$return";
		exit();
	}
}else{
		$array = [
		'success' => false,
		'message' => "Incomplete data, please fill all necessary fields.."
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