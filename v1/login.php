<?
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
		
	if (!empty($data->email)) {
			
		if (!empty($data->pword)) {

$mail = input_check($data->email);
$pword = input_check($data->pword);

$Gets = new Gets();

$acc_type = $Gets->getAccountType($mail);

if ($acc_type == false) {
	// code...
	$array = [
	            'success' => false,
	            'message' => $_SESSION['err']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}

if ($acc_type == "Student") {
	// code...
$Students = new Student();

$login = $Students->Login($mail, $pword);
if ($login != false) {
	// code...
	$array = [
	            'success' => true,
	            'message' => "Login successful.",
	            'acc_type' => "Student",
	            'fistName' => $login[0]['fname'],
	            'lastName' => $login[0]['lname'],
	            'middleName' => $login[0]['mname'],
	            'mail' => $login[0]['mail']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}else{
$array = [
	            'success' => false,
	            'message' => $_SESSION['err']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}

}elseif ($acc_type == "Staff") {
	// code...
$Staff = new Staff();

$login = $Staff->Login($mail, $pword);
if ($login != false) {
	// code...
	$array = [
	            'success' => true,
	            'message' => "Login successful.",
	            'acc_type' => "Staff",
	            'fistName' => $login[0]['fname'],
	            'lastName' => $login[0]['lname'],
	            'middleName' => $login[0]['mname'],
	            'mail' => $login[0]['mail']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}else{
$array = [
	            'success' => false,
	            'message' => $_SESSION['err']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}

}elseif ($acc_type == "Management") {
	// code...
$Mgnt = new Management();

$login = $Mgnt->Login($mail, $pword);

// var_dump($login[0]);
// exit();
if ($login != false) {
	// code...
	$array = [
	            'success' => true,
	            'message' => "Login successful.",
	            'acc_type' => "Management",
	            'name' => $login[0]['name'],
	            'mail' => $login[0]['mail'],
	            'usertoken' => $login[0]['token']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}else{
$array = [
	            'success' => false,
	            'message' => $_SESSION['err']
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}
}else{
	$array = [
	            'success' => false,
	            'message' => "Unknown account. $mail not found.."
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
}


			}else{
		$array = [
	            'success' => false,
	            'message' => "kindly,enter your password"
	        ];
	        $return= json_encode($array);
	        echo "$return";
	        exit();
		}
			
		}else{
			$array = [
	            'success' => false,
	            'message' => "kindly,enter your email"
	        ];
	        $return= json_encode($array);
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