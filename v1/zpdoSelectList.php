<?php
require('../assets/v1/connect.php');

$User = new PDOClass();

$result = $User->SelectListPDOTest();
var_dump($result[0]['token']);
exit();
// var_dump($result);
// $result = json_encode($result);
  	$rownum= sizeof($result);
 echo "[";
     $counter = 0;
     foreach ($result as $key => $value) {
     	// code...

        $counter = ++$counter;

  $array = [
 'mail' => $value['mail'],
 'name' => $value['name'],
 'timestamp' => $value['timestamp'],
 'pword' => $value['pword']
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

 ?>