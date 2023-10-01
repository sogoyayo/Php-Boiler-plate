<?
 // Start with PHPMailer class
use PHPMailer\PHPMailer\PHPMailer;
$timestamp=time();

# DECODE THE HTMLSPECIAL STRING IN TO STRING
# -----------------------------------------------------------------------*/
function escape_data($data){
  //$con=mysqli_connect(DB_SERVER,DBASE_USER,DBASE_PASS,DBASE_NAME);
  $mysqli = mysqli_connect(DB_SERVER,DBASE_USER,DBASE_PASS,DBASE_NAME);
  if(function_exists('mysql_real_escape_string')){
    $data = mysqli_real_escape_string($mysqli, $data);
    $data = strip_tags($data);
  }else{
    $data = trim($data);
    $data = mysqli_escape_string($mysqli, $data);
    $data = strip_tags($data);
  }
  return $data;
}
# ---------------------------------------------------------------------


function get_ip_info(){
  $indicesServer = array('PHP_SELF',
'argv',
'argc',
'GATEWAY_INTERFACE',
'SERVER_ADDR',
'SERVER_NAME',
'SERVER_SOFTWARE',
'SERVER_PROTOCOL',
'REQUEST_METHOD',
'REQUEST_TIME',
'REQUEST_TIME_FLOAT',
'QUERY_STRING',
'DOCUMENT_ROOT',
'HTTP_ACCEPT',
'HTTP_ACCEPT_CHARSET',
'HTTP_ACCEPT_ENCODING',
'HTTP_ACCEPT_LANGUAGE',
'HTTP_CONNECTION',
'HTTP_HOST',
'HTTP_REFERER',
'HTTP_USER_AGENT',
'HTTPS',
'REMOTE_ADDR',
'REMOTE_HOST',
'REMOTE_PORT',
'REMOTE_USER',
'REDIRECT_REMOTE_USER',
'SCRIPT_FILENAME',
'SERVER_ADMIN',
'SERVER_PORT',
'SERVER_SIGNATURE',
'PATH_TRANSLATED',
'SCRIPT_NAME',
'REQUEST_URI',
'PHP_AUTH_DIGEST',
'PHP_AUTH_USER',
'PHP_AUTH_PW',
'AUTH_TYPE',
'PATH_INFO',
'ORIG_PATH_INFO') ;
$result ="";
$result = $result . '<table cellpadding="10">' ;
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        $result = $result . '<tr><td>'.$arg.'</td><td> __ ' . $_SERVER[$arg] . ' </td> </tr>' ;
    }
    else {
        $result = $result .'<tr><td>'.$arg.'</td><td>__</td> </tr>' ;
    }
}
$result = $result .'</table>' ;
return $result;
}


function sql_detect($data){
    $sql = array(
    "DROP DATABASE",
    "ALTER TABLE",
    "TRUNCATE TABLE",
    "DELETE FROM",
    "INSERT INTO",
    "DROP TABLE",
    "CREATE TABLE"
    );

    $str  = strtoupper($data);
    $count = count($sql);
    $b="";

    for ($i=0; $i < $count; $i++) {
      $pos = strpos($str, $sql[$i]);
      if ($pos === false) {
        $b= FALSE;
      }else{
        $b= TRUE;
        break;
      }
    }

    if ($b == false) {
      return FALSE;
    }else{
      return TRUE;
    }
}

function sql_offence($data){
        $data = escape_data($data);
        $data = str_replace(" ", "_", $data);
        $data = "__".$data."__";
        return $data;
}

function attack_detect($offence,$mem_id){
    $con=mysqli_connect(DB_SERVER,DBASE_USER,DBASE_PASS,DBASE_NAME);
     $ip_info = escape_data(get_ip_info());
      $offence = escape_data($offence);
     if(empty($memid)){
      $memid = "UN-KNOWN";
     }

    $sql = " insert into db_offence_tb (ip_address ,timestamp ,ip_info,offence,user_id,dir_url) values ('".get_client_ip()."','". date("F j, Y, D, h:i a")."','".$ip_info."','$offence','$memid','$realurl')";
    mysqli_query($con,$sql);

      $subject = 'THREAT ALERT';

      $email = "ayodeletim@gmail.com" ;
      //-----
        $from = "$webmail3";
        //-----

        $Server ="";
        $headers = "From: $Server <".$from.">\n";
        $headers .= "Reply-To: $Server <".$from.">\n";
        $headers .= "Return-Path: $Server <".$from.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";

        $message = msg_html("<h2>$offence<h2> </br>" . get_ip_info());

        mail($email, $subject, $message, $headers);

}


function input_check($data){
  if(sql_detect($data) ==TRUE){
    $offence = sql_offence($data);
    attack_detect($offence);
    return "****";
  }else{
    $data = trim($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $data = strip_tags($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data , ENT_QUOTES,'UTF-8');
    $data = escape_data($data);

/*
      $subject = 'THREAT ALERT';

      $email = "ayodeletim@gmail.com" ;
      //-----
        $from = "$webmail3";
        //-----

        $Server ="jhfhfjhfh";
        $headers = "From: $Server <".$from.">\n";
        $headers .= "Reply-To: $Server <".$from.">\n";
        $headers .= "Return-Path: $Server <".$from.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";

        $message = msg_html("<h2>$offence<h2> </br>" . get_ip_info());

        mail($email, $subject, $message, $headers);
*/
    return $data;
  }

}

function input_check_large($data){
  if(sql_detect($data) ==TRUE){
    $offence = sql_offence($data);
    attack_detect($offence);
    return "****";
  }else{
    $data = trim($data);
    $data = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
   // $data = strip_tags($data);
   // $data = stripslashes($data);
 //   $data = htmlspecialchars($data , ENT_QUOTES,'UTF-8');
    $data = escape_data($data);

/*
      $subject = 'THREAT ALERT';

      $email = "ayodeletim@gmail.com" ;
      //-----
        $from = "$webmail3";
        //-----

        $Server ="jhfhfjhfh";
        $headers = "From: $Server <".$from.">\n";
        $headers .= "Reply-To: $Server <".$from.">\n";
        $headers .= "Return-Path: $Server <".$from.">\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";

        $message = msg_html("<h2>$offence<h2> </br>" . get_ip_info());

        mail($email, $subject, $message, $headers);
*/
    return $data;
  }

}


function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    $ipaddress = $_SERVER['SERVER_ADDR'] ;
    return $ipaddress;
}


function datediff ($olddate, $newdate){

// Declare and define two dates 
// $date1 = strtotime("2016-06-01 22:45:00"); 
// $date2 = strtotime("2018-09-21 10:44:01"); 

// Formulate the Difference between two dates 
  $newdate = intval($newdate);
  $olddate = intval($olddate);
$diff = abs($newdate - $olddate); 


// To get the year divide the resultant date into 
// total seconds in a year (365*60*60*24) 
$years = floor($diff / (365*60*60*24)); 


// To get the month, subtract it with years and 
// divide the resultant date into 
// total seconds in a month (30*60*60*24) 
$months = floor(($diff - $years * 365*60*60*24) 
              / (30*60*60*24)); 


// To get the day, subtract it with years and 
// months and divide the resultant date into 
// total seconds in a days (60*60*24) 
$days = floor(($diff - $years * 365*60*60*24 - 
      $months*30*60*60*24)/ (60*60*24)); 


// To get the hour, subtract it with years, 
// months & seconds and divide the resultant 
// date into total seconds in a hours (60*60) 
$hours = floor(($diff - $years * 365*60*60*24 
  - $months*30*60*60*24 - $days*60*60*24) 
                / (60*60)); 


// To get the minutes, subtract it with years, 
// months, seconds and hours and divide the 
// resultant date into total seconds i.e. 60 
$minutes = floor(($diff - $years * 365*60*60*24 
    - $months*30*60*60*24 - $days*60*60*24 
            - $hours*60*60)/ 60); 


// To get the minutes, subtract it with years, 
// months, seconds, hours and minutes 
$seconds = floor(($diff - $years * 365*60*60*24 
    - $months*30*60*60*24 - $days*60*60*24 
        - $hours*60*60 - $minutes*60)); 

// Print the result 
// printf("%d years, %d months, %d days, %d hours, "
//   . "%d minutes, %d seconds", $years, $months, 
//       $days, $hours, $minutes, $seconds); 

if ($years!='') {
  # code...
  // $value = "$years years, $months months, $days days, $hours hours, $minutes minutes, $seconds seconds";
   $value = "$years year(s)";
  return $value;
}elseif ($months!='') {
  # code...
  // $value = "$months months, $days days, $hours hours, $minutes minutes, $seconds seconds";
   $value = "$months month(s)";
  return $value;
}elseif ($days!='') {
  # code...
  // $value = "$days days, $hours hours, $minutes minutes, $seconds seconds";
  $value = "$days day(s)";
  return $value;
}elseif ($hours!='') {
  # code...
  // $value = "$hours hours, $minutes minutes, $seconds seconds";
   $value = "$hours hour(s)";
  return $value;
}elseif ($minutes!='') {
  # code...
  // $value = "$minutes minutes, $seconds seconds";
  $value = "$minutes minute(s)";
  return $value;
}elseif ($seconds!='') {
  # code...
  $value = "$seconds second(s)";
  return $value;
}
}

// Function to generate OTP 
function generateNumericOTP($n) { 
      
    // Take a generator string which consist of 
    // all numeric digits 
    $generator = "1357902468"; 
  
    // Iterate for n-times and pick a single character 
    // from generator and append it to $result 
      
    // Login for generating a random character from generator 
    //     ---generate a random number 
    //     ---take modulus of same with length of generator (say i) 
    //     ---append the character at place (i) from generator to result 
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 

function generateAlphaNumericOTP($n) { 
      
    // Take a generator string which consist of 
    // all numeric digits 
    $generator = "1357902468ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
  
    // Iterate for n-times and pick a single character 
    // from generator and append it to $result 
      
    // Login for generating a random character from generator 
    //     ---generate a random number 
    //     ---take modulus of same with length of generator (say i) 
    //     ---append the character at place (i) from generator to result 
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 


function generateAlphaNumericOTP_case($n) { 
      
    // Take a generator string which consist of 
    // all numeric digits 
    $generator = "1357902468ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"; 
  
    // Iterate for n-times and pick a single character 
    // from generator and append it to $result 
      
    // Login for generating a random character from generator 
    //     ---generate a random number 
    //     ---take modulus of same with length of generator (say i) 
    //     ---append the character at place (i) from generator to result 
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 



function generateAlphaOTP($n) { 
      
    // Take a generator string which consist of 
    // all numeric digits 
    $generator = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
  
    // Iterate for n-times and pick a single character 
    // from generator and append it to $result 
      
    // Login for generating a random character from generator 
    //     ---generate a random number 
    //     ---take modulus of same with length of generator (say i) 
    //     ---append the character at place (i) from generator to result 
  
    $result = ""; 
  
    for ($i = 1; $i <= $n; $i++) { 
        $result .= substr($generator, (rand()%(strlen($generator))), 1); 
    } 
  
    // Return result 
    return $result; 
} 
# end of custom functions


function CheckMailExist($mysqli,$mail){
  $sql = "SELECT * FROM users where mail='$mail'"; 
if ($res = $mysqli->query($sql)) { 
    if ($res->num_rows > 0) { 
       // while ($row = $res->fetch_array())  
        if ($row = $res->fetch_array())  
        { 
            // $_SESSION['usertoken'] = $row['token'];
           return true;
        } 
        // echo "</table>"; 
        $res->free(); 
    } 
    else { 
      return false;
      //  echo "Incorrect Code. Try again. <br> <b>Reset</b> and try again biko"; 
    } 
} 
else {
return false; 
   // echo "ERROR: Could not able to execute command.. ";
                                             $mysqli->error; 
} 
$mysqli->close(); 
}

function mail_tb1 ($mysqli,$email,$subject,$body,$timestamp){
$body = addslashes($body);
    $sql = "INSERT INTO mail_tb (mail, subject, body, timestamp, sent) 
              VALUES('$email', '$subject','$body','$timestamp','0') "; 
    if ($mysqli->query($sql) == true) 
{ 
  return true;
} 
else
{ 
   // echo "ERROR: Could not able to execute $sql. ";
  return false;
           $mysqli->error; 
} 
  
// Close connection 
$mysqli->close(); 

}


function mail_tb($mysqli,$email,$subject,$body,$timestamp){
 
require_once 'vendor/autoload.php';

    // create a new object
    $mail = new PHPMailer();

    // configure an SMTP
    $mail->isSMTP();
    $mail->Host = 'business147.web-hosting.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@renitrust.com';
    $mail->Password = 'C^k+xGz^X^II';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('no-reply@renitrust.com', ''.APPNAME.'');
$dbname = "ReniTrust";
$mail2 = clone $mail;
    $mail2->addAddress($email, $dbname);
   $mail2->addReplyTo(''.EMAIL.'', ''.APPNAME.'');
    $mail2->Subject = "$subject";


        $body ="
        <img src='http://api.renitrust.com/logo/png/Main.png' width='15%' />
        <br /><br />
        $body<br /><br />
        Stay safe.<br /><b>Reni</b>
        ";

        // Set HTML 
        $mail2->isHTML(TRUE);
        $mail2->Body = $body;
        $mail2->AltBody = strip_tags($body);

          if($mail2 -> send()){

            $body = addslashes($body);
    $sql = "INSERT INTO mail_tb (mail, subject, body, timestamp, sent)
              VALUES('$email', '$subject','$body','$timestamp','1') "; 
    if ($mysqli->query($sql) == true) 
{ 
            return true;

            }
else{

   // echo "ERROR: Could not able to execute $sql. ";
  return false;
           $mysqli->error; 
} 
          }else{
$body = addslashes($body);
    $sql = "INSERT INTO mail_tb (mail, subject, body, timestamp, sent)
              VALUES('$email', '$subject','$body','$timestamp','0') "; 
    if ($mysqli->query($sql) == true) 
{ 

            return true;

                 }
else
{ 
   // echo "ERROR: Could not able to execute $sql. ";
  return false;
           $mysqli->error; 
} 
          }


  
// Close connection 
$mysqli->close(); 

}



function CheckToken($mysqli, $apptoken){
   $sql = "SELECT * FROM apptoken_tb where token='$apptoken'"; 
if ($res = $mysqli->query($sql)) { 
    if ($res->num_rows > 0) { 
       // while ($row = $res->fetch_array())  
        if ($row = $res->fetch_array())  
        { 
           return true;
        } 
        // echo "</table>"; 
        $res->free(); 
    } 
    else { 
      return false;
      //  echo "Incorrect Code. Try again. <br> <b>Reset</b> and try again biko"; 
    } 
} 
else {
return false; 
   // echo "ERROR: Could not able to execute command.. ";
                                             $mysqli->error; 
} 
$mysqli->close(); 
}



function CheckActivated($mysqli, $mail){
  $timestamp = time();
    $sql = "SELECT * FROM users where mail='$mail'"; 
if ($res = $mysqli->query($sql)) { 
    if ($res->num_rows > 0) { 
       // while ($row = $res->fetch_array())  
        if ($row = $res->fetch_array())  
        { 
          $activated=$row['activated'];
          $usertoken=$row['token'];
if ($activated=='1') {
  # code...
     return true;
}else{
  $subject = "Your ".APPNAME." Account Activation";
  $body = "Your activation key is <b>$usertoken</b>
  <br/>Activate your account by clicking ".APPURL."/auth and inputing the key above.";
  
if(mail_tb($mysqli,$mail,$subject,$body,$timestamp)==true) {

  return false;
}
}
  }
  else{
    return false;
  }
        // echo "</table>"; 
        $res->free(); 
    } 
    else { 
      return false;
      //  echo "Incorrect Code. Try again. <br> <b>Reset</b> and try again biko"; 
    } 
} 
else {
return false; 
   // echo "ERROR: Could not able to execute command.. ";
                                             $mysqli->error; 
} 
$mysqli->close(); 
}




function SignUserIn($mysqli, $email, $password){
$timestamp = time();
  $sql = "SELECT * FROM users where mail='$email'"; 
if ($res = $mysqli->query($sql)) { 
    if ($res->num_rows > 0) { 
       // while ($row = $res->fetch_array())  
        if ($row = $res->fetch_array())  
        { 


          if ($password==$row['pword']) {
            # code...

$timestamp = time();
$time = date("d-m-Y, h:m:s A ",$timestamp);
$usertoken = $row['token'];
$subject = "Login access notification";
$body = "This is to notify you of a detected login access to your account at exactly $time.<br /> 
If this is not you, please change your password immediately and contact support.";

notifications($mysqli,$usertoken, $subject, $body, $timestamp);


            $_SESSION['fullname']=$row['fullname'];
            $_SESSION['mail']=$row['mail'];
            $_SESSION['usertoken']=$row['token'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['picture'] = $row['picture'];
            $_SESSION['ref'] = $row['ref'];
             $_SESSION['accno'] = $row['accno'];
         
            $subject ="[".APPNAME."] Login Activity";
  $body = "You just logged in to your ".APPNAME." account few seconds ago.<br/>
Kindly let us know if you did not..<br/>
Warm regards,<br/>
".APPNAME." team
  ";
  
if(mail_tb($mysqli,$email,$subject,$body,$timestamp)==true) {

            return true;
                     }
          }else{
          
            return false;
          }
        } 
       
        $res->free(); 
    }
    else { 
     
    } 
} 
else { 
    return false;
} 
$mysqli->close(); 

}



?>