<?

 $sql = "SELECT * FROM settings where id=1";
 
if ($res = $mysqli->query($sql)) { 
    if ($res->num_rows > 0) { 
    	if ($row = $res->fetch_array())  {
    	$app_name=$row['app_name'];
    	$system_last_update=$row['timestamp'];
        $app_mail=$row['app_mail'];
        $app_phone=$row['app_phone'];
        // $platform_status=$row['platform_status'];
}
    }
}

define('APP_NAME', $app_name);
define('APP_PHONE', $app_phone);
define('URL', 'http://' . $_SERVER['HTTP_HOST']);
define('DOMAIN', $_SERVER["HTTP_HOST"]);
define('APPURL', 'https://ums.fireswitch.com.ng');
define('APP_MAIL', $app_mail);
define('SYSTEMTOKEN', '1');
define('BACKURL', 'http://system.accounting.reni.tech');
define('RENIBACK', 'https://dev.out.renitrust.com');
define('RENITOKEN', 'hbfhbuhfi4bubf4ubvtub8v4uyvb84y');

$systemtoken ="1";
$timestamp=time();

define('TIMESTAMP', $timestamp);

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d-m-Y, h:m:s A ",$timestamp);
$add_impressions="0.8";
$add_views="1";
$link_exp_hr="24";
$link_exp_hr_dne=$link_exp_hr * 3600;
$link_exp=$timestamp + $link_exp_hr_dne;
$twentyfourhours = 24 * 3600;
$twentyfourhoursago = $timestamp - $twentyfourhours;
//$unik=rand(111,999);
$sagecloudendpoint = "https://sagecloud.ng/api/v2";

//$show = date("d-m-Y, h:m:s A ",$twentyfourhoursago);
//echo "$link_exp_hr_dne and $link_exp and $twentyfourhoursago <br />";
//echo "$show";
//exit();
//echo "$timestamp + $link_exp_hr_dne gave $link_exp";
//exit;

// $connectDB;

$uri = $_SERVER['REQUEST_URI'];
//echo $uri; // Outputs: URI
 
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
 
 $realurl1 = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
 // echo $realurl; // Outputs: Full URL without https://

$realurl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $realurl; // Outputs: Full URL
//exit;
 
 
$query = $_SERVER['QUERY_STRING'];
//echo $query; // Outputs: Query String

//echo "below data string <br>";
 


?>