<?

class PDOClass extends db {

public function UpdatePDOTest () {
	try
{
 $database = new db();
 $db = $database->connect();
 $timestamp = time();
 $sql = "UPDATE admin SET `timestamp`= '".time()."' WHERE `id` = 1" ;
     $affectedrows  = $db->exec($sql);
   if(isset($affectedrows))
    {
       return "Record has been successfully updated";
    }          
}
catch (PDOException $e)
{
    return "There is some problem in connection: " . $e->getMessage();
}
}



public function InsertPDOTest () {
	try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO admin (name, mail, pword, timestamp)
  VALUES (:name, :mail, :pword, :timestamp)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':name', $name);
  $stmt->bindParam(':mail', $mail);
  $stmt->bindParam(':pword', $pword);
  $stmt->bindParam(':timestamp', $timestamp);

  // // insert a row
  // $name = "John";
  // $mail = "mail@ums.ng";
  // $pword = md5(time());
  // $timestamp = time();
  // $stmt->execute();

  // insert another row
  $name = "Mary";
  $mail = "Moe@ums.ng";
  $pword = md5(time());
  $timestamp = time();
  $stmt->execute();

  // insert another row
  $name = "Julie";
  $mail = "Dooley@ums.ng";
  $pword = md5(time());
  $timestamp = time();
  $stmt->execute();

  return "New records created successfully $name";
} 
catch(PDOException $e) {
  return "Error: " . $e->getMessage();
}
	}



public function SelectListPDOTest (){
	try {
		 $sql = "SELECT * from admin";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute()) {
                    $stmt = null;
                    return "false";
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
    // if (md5($pword) == $user[0]['pword']) {
    // 	// code...
    	
    // }else{
    // 	return false;
    //     }

return $user;

    }

    }
}
	} catch (PDOException $e) {
		
	}
}


}


?>