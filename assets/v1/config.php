<?php
error_reporting(E_ALL);
// echo "aaconfig string <br>";

if(session_id() == '') {
 session_start();
  //  echo "string";
   //exit();
} else {
  // echo "session exists";
  // exit();
}
ob_start();

date_default_timezone_set("Africa/Lagos");

define("DB_SERVER", "localhost");

define("DBASE_NAME", 'fireswit_ums');

define("DBASE_USER", 'fireswit_ums');

define("DBASE_PASS", 'AaCmr)2GOCcO');

$connect_error = "We sincerely apologise. We are experiencing connection problems";

$con=mysqli_connect(DB_SERVER,DBASE_USER,DBASE_PASS,DBASE_NAME);

($con)? TRUE : die($connect_error);

$mysqli = mysqli_connect(DB_SERVER,DBASE_USER,DBASE_PASS,DBASE_NAME);

if (mysqli_connect_errno()) {
       die("Unable to connect to the server ".mysqli_connect_error());
}
global $mysqli;


class db{

    private $host = "localhost";
    private $user = "fireswit_ums";
    private $pwd = "AaCmr)2GOCcO";
    private $dbname = "fireswit_ums";

    protected function connect(){

  
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $this->pdo = new PDO($dsn, $this->user, $this->pwd);
        if(!$this->pdo){
    echo "Unable to connect to database";
}
    # DEFAULT FETCH_MODE = FETCH_OBJ
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    return $this->pdo;


    }
}


?>
