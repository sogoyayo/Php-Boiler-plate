<?

/**
 * 
 */
class Staff extends db
{
	
	// function __construct(argument)
	// {
	// 	// code...
	// }

public function Login ($mail, $pword){

		try {
		$sql = "SELECT * from staff where mail = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$mail])) {
                    $stmt = null;
                    return "false";
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }else{
            
           if($staff = $stmt->fetchAll(PDO::FETCH_ASSOC)){
    if (md5($pword) == $staff[0]['pword']) {
    	// code...
    	return $staff;
    }else{
    	$_SESSION['err'] ="Incorrect password for $mail";
    	return false;
        }

    }

    }
}
	} catch (PDOException $e) {
		$_SESSION['err'] = $e->getMessage();
  return false;
	}
}



// end of class
}

?>