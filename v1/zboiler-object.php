<?
header('Content-Type: application/json charset=utf-8');
header("Access-Control-Allow-Methods: PUT, GET, POST");

require('../assets/v1/connect.php');


$data = file_get_contents('php://input');
$data = json_decode($data);

if (!isset($data)) {
    // code...
    $array= [
        'success'=> false,
        'message'=>"Payload not found."
    ];
    $return= json_encode($array);
    echo "$return";
    exit();
}


if (isset($data->apptoken)) {
	// code...
	$apptoken = input_check($data->apptoken);
	if (CheckToken($mysqli, $apptoken)==true) {
		// code...
		






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