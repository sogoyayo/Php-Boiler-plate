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
	if (!empty($_POST['facultyid'])) {
		// code...
$Mgnt = new Management();
$facultyid = input_check($_POST['facultyid']);
$result = $Mgnt->ListDepts($facultyid);
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

$faculty = $Mgnt->getFacultyName($value['facultyid']);

$array = [
 'id' => $value['id'],
 'usertoken' => $value['usertoken'],
 'facultyId' => $value['facultyid'],
 'faculty' => $faculty,
 'timeAdded' => $timeago
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
			'message' => "Select faculty."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
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