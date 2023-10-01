<?
header('Content-Type: application/json charset=utf-8');
header("Access-Control-Allow-Methods: PUT, GET, POST");

require('../assets/v1/connect.php');

if (isset($_POST['apptoken'])) {
	// code...
	$apptoken = input_check($_POST['apptoken']);
	if (CheckToken($mysqli, $apptoken)==true) {
		// code...

if (!empty($_POST['usertoken'])) {
	// code...
	$usertoken = input_check($_POST['usertoken']);
	$Mgnt = new Management();

if (!empty($_POST['lname']) or !empty($_POST['fname']) or !empty($_POST['levelid']) or !empty($_POST['mail']) or !empty($_POST['facultyid']) or !empty($_POST['deptid']) or !empty($_POST['phone'])) {
	// code...

$lname = input_check($_POST['lname']);
$fname = input_check($_POST['fname']);
$mname = input_check($_POST['mname']);
$levelid = input_check($_POST['levelid']);
$mail = input_check($_POST['mail']);
$facultyid = input_check($_POST['facultyid']);
$deptid = input_check($_POST['deptid']);
$phone = input_check($_POST['phone']);

if ($Mgnt->AddStudent($fname, $mname, $lname, $levelid, $mail, $phone, $deptid, $facultyid) == true) {
	// code...
		$array = [
			'success' => true,
			'message' => "Student added.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}else{
		$array = [
			'success' => false,
			'message' => "Student not added."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}

}else{
	$array = [
			'success' => false,
			'message' => "Empty field.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}
}else{
$array = [
			'success' => false,
			'message' => "Unknown access.."
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