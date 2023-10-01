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
		

if (!empty($data->To) or !empty($data->Subject) or !empty($data->Memo)) {
	// code...
	if ($data->To == "Staff") {
		// code...
		$result = $Mgnt->ListAllStaff();

	if ($Mgnt->SendMemoToStaff($result, $data->Subject, $data->Memo)) {
			// code...
		$array = [
			'success' => true,
			'message' => "Memo has been sent to all Staff members.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
		}

	}elseif ($data->To == "Students") {
		// code...
		$result = $Mgnt->ListAllStudents();

	if ($Mgnt->SendMemoToStudents($result, $data->Subject, $data->Memo)) {
			// code...
		$array = [
			'success' => true,
			'message' => "Memo has been sent to all Students.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
		}
	
	}elseif ($data->To == "All") {
		// code...

	}else{
		$array = [
			'success' => false,
			'message' => "You have to pick a recipient.."
		];
				$return = json_encode($array);
		echo "$return";
		exit();
	}
}else{
	$array = [
			'success' => false,
			'message' => "Empty fields.."
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