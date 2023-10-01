<?

/**
 * 
 */
class Student extends db
{
	

public function Login ($mail, $pword){

		try {
		$sql = "SELECT * from students where mail = ?";
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
            
           if($student = $stmt->fetchAll(PDO::FETCH_ASSOC)){
    if (md5($pword) == $student[0]['pword']) {
    	// code...
    	return $student;
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

}

?>