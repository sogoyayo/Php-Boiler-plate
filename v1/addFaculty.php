<?
header('Content-Type: application/json charset=utf-8');
header("Access-Control-Allow-Methods: PUT, GET, POST");

require('../assets/v1/connect.php');

if (isset($_POST['apptoken'])) {
	// code...
	$apptoken = input_check($_POST['apptoken']);
	if (CheckToken($mysqli, $apptoken)==true) {
		// code...
		
$Mgnt = new Management();

if (!empty($_POST['usertoken']) or !empty($_POST['faculty'])) {
	// code...
	$faculty = input_check($_POST['faculty']);
	$usertoken = input_check($_POST['usertoken']);

	if ($Mgnt->AddFaculty($usertoken, $faculty)==true) {
		// code...
		$array = [
		'success' => true,
		'message' => "$faculty has been created."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
	}else{
		$array = [
		'success' => false,
		'message' => "Faculty not created, please try again.."
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