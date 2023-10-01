<?php
require('../assets/v1/connect.php');

$User = new PDOClass();

$result = $User->InsertPDOTest();
echo $result;
?>