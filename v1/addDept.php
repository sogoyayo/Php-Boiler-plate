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

if (!empty($_POST['usertoken']) or !empty($_POST['facultyid']) or !empty($_POST['dept'])) {
	// code...
	$facultyid = input_check($_POST['facultyid']);
	$usertoken = input_check($_POST['usertoken']);
	$dept = input_check($_POST['dept']);

	if ($Mgnt->AddDept($usertoken, $facultyid, $dept)==true) {
		// code...
		$array = [
		'success' => true,
		'message' => "$dept has been created."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
	}else{
		$array = [
		'success' => false,
		'message' => "Department not created, please try again.."
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