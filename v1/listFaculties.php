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

$result = $Mgnt->ListFaculties();
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

$array = [
 'id' => $value['id'],
 'usertoken' => $value['usertoken'],
 'faculty' => $value['faculty'],
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