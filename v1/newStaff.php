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

if (isset($data->usertoken)) {
	// code...
	$usertoken = input_check($data->usertoken);
	$Mgnt = new Management();

if (isset($data->lname) or !empty($data->fname) or !empty($data->mail) or !empty($data->facultyid) or !empty($data->deptid) or !empty($data->phone)) {
	// code...

$lname = input_check($data->lname);
$fname = input_check($data->fname);
$mname = input_check($data->mname);
$mail = input_check($data->mail);
$facultyid = input_check($data->facultyid);
$deptid = input_check($data->deptid);
$phone = input_check($data->phone);

if ($Mgnt->AddStaff($fname, $mname, $lname, $mail, $phone, $deptid, $facultyid) == true) {
	// code...
		$array = [
			'success' => true,
			'message' => "Staff added.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}else{
		$array = [
			'success' => false,
			'message' => "Staff not added."
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