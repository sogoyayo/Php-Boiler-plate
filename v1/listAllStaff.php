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
		
if (!empty($data->usertoken)) {
	// code...
$Mgnt = new Management();
$Gets = new Gets();

$result = $Mgnt->ListAllStaff();
if ($result == false) {
	// code...
	$array = [
			'success' => false,
			'message' => $_SESSION['err']
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}else{
  	$rownum= sizeof($result);
 echo "[";
     $counter = 0;
 
 foreach ($result as $key => $value) {
     	// code...
$counter = ++$counter;
$timeago = datediff($value['timestamp'], time());
$faculty = $Gets->getFacultyName($value['facultyid']);
$dept = $Gets->getDeptName($value['deptid']);


$array = [
 'id' => $value['id'],
 'usertoken' => $value['usertoken'],
 'level' => $level,
 'timeAdded' => $timeago,
 'fname' => $value['fname'],
 'lname' => $value['lname'],
 'mname' => $value['mname'],
 'mail' => $value['mail'],
 'status' => $value['status'],
 'faculty' => $faculty,
 'dept' => $dept,
 'deptid' => $value['deptid'],
 'facultyid' => $value['facultyid']
 ];

$return = json_encode($array, JSON_FORCE_OBJECT);
if ($rownum > $counter) {
	# code...
	echo "$return,";
}elseif ($rownum==$counter) {
	# code...
	echo "$return";
}
     }
     echo "]";
 }
}else{
$array = [
			'success' => false,
			'message' => "Unauthorized access."
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
			'message' => "Unauthorized access..."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
}

?>