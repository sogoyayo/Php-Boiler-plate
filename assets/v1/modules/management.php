<?

class Management extends db{

public function AddFaculty ($usertoken, $faculty){
		try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO faculties (usertoken, faculty, timestamp)
  VALUES (:usertoken, :faculty, :timestamp)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':usertoken', $usertoken);
  $stmt->bindParam(':faculty', $faculty);
  $stmt->bindParam(':timestamp', time());

  // $stmt->execute();

  // return "New records created successfully $name";
  if (!$stmt->execute()) {
  	// code...
  	return false;
  }else{
  	return true;
  }
} 
catch(PDOException $e) {
	$_SESSION['err'] = $e->getMessage();
  return false;
}
}



public function AddDept ($usertoken, $facultyid, $dept){
		try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO faculties (usertoken, facultyid, dept, timestamp)
  VALUES (:usertoken, :faculty, dept, :timestamp)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':usertoken', $usertoken);
  $stmt->bindParam(':facultyid', $facultyid);
  $stmt->bindParam(':timestamp', time());
  $stmt->bindParam(':dept', $dept);

  // $stmt->execute();

  // return "New records created successfully $name";
  if (!$stmt->execute()) {
  	// code...
  	return false;
  }else{
  	return true;
  }
} 
catch(PDOException $e) {
	$_SESSION['err'] = $e->getMessage();
  return false;
}
}


public function ListFaculties ()
{
		try {
		 $sql = "SELECT * from faculties";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute()) {
                    $stmt = null;
                  $_SESSION['err'] = "Something went wrong, please try again..";
                    return false;
                }else{
if($stmt->rowCount() == 0){

           $stmt = null;
           $_SESSION['err'] = "No faculties found..";
            return false;
            // code...
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){

return $user;

    }

    }
}
	} catch (PDOException $e) {
		$_SESSION['err'] = $e->getMessage();
  return false;
	}
}



public function ListDepts($facultyid)
{
		try {
		 $sql = "SELECT * from depts where facultyid = '$facultyid'";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute()) {
                    $stmt = null;
                  $_SESSION['err'] = "Something went wrong, please try again..";
                    return false;
                }else{
if($stmt->rowCount() == 0){

           $stmt = null;
           $_SESSION['err'] = "No department found..";
            return false;
            // code...
        }else{
            
           if($depts = $stmt->fetchAll(PDO::FETCH_ASSOC)){

return $depts;

    }

    }
}
	} catch (PDOException $e) {
$_SESSION['err'] = $e->getMessage();
  return false;
	}
}


public function getFacultyName($facultyid)
{
	// code...
	try {
		 $sql = "SELECT * from faculties where id = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$facultyid])) {
                    $stmt = null;
                  $_SESSION['err'] = "Could not fetch faculty.";
                    return false;
                }else{
        if($stmt->rowCount() == 0){
$_SESSION['err'] = "Faculty not found.";
           $stmt = null;
            return false;
            // code...
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
 
           	return $user[0]['faculty'];
    }

    }
}
	} catch (PDOException $e) {
		$_SESSION['err'] = $e->getMessage();
  return false;
	}
}



public function AddLevel($usertoken, $level)
{
	// code...
			try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO levels (usertoken, level, timestamp)
  VALUES (:usertoken, :level, :timestamp)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':usertoken', $usertoken);
  $stmt->bindParam(':level', $level);
  $stmt->bindParam(':timestamp', time());

  // $stmt->execute();

  // return "New records created successfully $name";
  if (!$stmt->execute()) {
  	// code...
  	return false;
  }else{
    $_SESSION['err'] = "Sql error";
  	return true;
  }
} 
catch(PDOException $e) {
	$_SESSION['err'] = $e->getMessage();
  return false;
}
}


// public function ListDepts($facultyid)
// {
// 		try {
// 		 $sql = "SELECT * from depts where facultyid = '$facultyid'";
//                 $stmt = $this->connect()->prepare($sql);
//                 if (!$stmt->execute()) {
//                     $stmt = null;
//                   $_SESSION['err'] = "Something went wrong, please try again..";
//                     return false;
//                 }else{
// if($stmt->rowCount() == 0){

//            $stmt = null;
//            $_SESSION['err'] = "No department found..";
//             return false;
//             // code...
//         }else{
            
//            if($depts = $stmt->fetchAll(PDO::FETCH_ASSOC)){

// return $depts;

//     }

//     }
// }
// 	} catch (PDOException $e) {
// 		$_SESSION['err'] = $e;
// 	}
// }



public function ListLevel()
{
		try {
		 $sql = "SELECT * from levels";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute()) {
                    $stmt = null;
                  $_SESSION['err'] = "Something went wrong, please try again..";
                    return false;
                }else{
if($stmt->rowCount() == 0){

           $stmt = null;
           $_SESSION['err'] = "No level found..";
            return false;
            // code...
        }else{
            
           if($levels = $stmt->fetchAll(PDO::FETCH_ASSOC)){

return $levels;

    }

    }
}
	} catch (PDOException $e) {
		$_SESSION['err'] = $e->getMessage();
  return false;
	}
}




public function AddStudent($fname, $mname, $lname, $levelid, $mail,$phone, $deptid, $facultyid)
{
    // code...
            try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO students (token, fname, mname, lname, levelid, deptid, facultyid, mail, phone, timestamp)
  VALUES (:token, :fname, :mname, :lname, :levelid, :deptid, :facultyid, :mail, :phone, :timestamp)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':token', generateAlphaNumericOTP(9));
  $stmt->bindParam(':fname', $fname);
  $stmt->bindParam(':mname', $mname);
  $stmt->bindParam(':lname', $lname);
  $stmt->bindParam(':mail', $mail);
  $stmt->bindParam(':timestamp', time());
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':facultyid', $facultyid);
  $stmt->bindParam(':deptid', $deptid);

  // $stmt->execute();

  // return "New records created successfully $name";
  if (!$stmt->execute()) {
    // code...
    return false;
  }else{
    return true;
  }
} 
catch(PDOException $e) {
    $_SESSION['err'] = $e->getMessage();
  return false;
}
}



public function ListAllStudents()
{
        try {
         $sql = "SELECT * from students";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute()) {
                    $stmt = null;
                  $_SESSION['err'] = "Something went wrong, please try again..";
                    return false;
                }else{
if($stmt->rowCount() == 0){

           $stmt = null;
           $_SESSION['err'] = "No student found..";
            return false;
            // code...
        }else{
            
           if($students = $stmt->fetchAll(PDO::FETCH_ASSOC)){

return $students;

    }

    }
}
    } catch (PDOException $e) {
        $_SESSION['err'] = $e->getMessage();
  return false;
    }
}




public function AddStaff($fname, $mname, $lname, $mail,$phone, $deptid, $facultyid)
{
    // code...
            try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO staff (token, fname, mname, lname, deptid, facultyid, mail, phone, timestamp)
  VALUES (:token, :fname, :mname, :lname, :deptid, :facultyid, :mail, :phone, :timestamp)";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':token', generateAlphaNumericOTP(9));
  $stmt->bindParam(':fname', $fname);
  $stmt->bindParam(':mname', $mname);
  $stmt->bindParam(':lname', $lname);
  $stmt->bindParam(':mail', $mail);
  $stmt->bindParam(':timestamp', time());
  $stmt->bindParam(':phone', $phone);
  $stmt->bindParam(':facultyid', $facultyid);
  $stmt->bindParam(':deptid', $deptid);

  // $stmt->execute();

  // return "New records created successfully $name";
  if (!$stmt->execute()) {
    // code...
    return false;
  }else{
    return true;
  }
} 
catch(PDOException $e) {
    $_SESSION['err'] = $e->getMessage();
  return false;
}
}


public function ListAllStaff()
{
        try {
         $sql = "SELECT * from staff";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute()) {
                    $stmt = null;
                  $_SESSION['err'] = "Something went wrong, please try again..";
                    return false;
                }else{
if($stmt->rowCount() == 0){

           $stmt = null;
           $_SESSION['err'] = "No student found..";
            return false;
            // code...
        }else{
            
           if($staff = $stmt->fetchAll(PDO::FETCH_ASSOC)){

return $staff;

    }

    }
}
    } catch (PDOException $e) {
       $_SESSION['err'] = $e->getMessage();
  return false;
    }
}


public function SendMemoToStudents($result, $Subject, $Memo)
{
    // code...
            try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO staff (usertoken, subject, memo, acc_type, timestamp)
  VALUES (:usertoken, :subject, :memo, :acc_type, :timestamp)";
  $stmt = $db->prepare($sql);


$rownum= sizeof($result);
     $counter = 0;

foreach ($result as $key => $value) {
$counter = ++$counter;

 $stmt->bindParam(':usertoken', $value['token']);
  $stmt->bindParam(':subject', $Subject);
  $stmt->bindParam(':memo', $Memo);
  $stmt->bindParam(':acc_type', "Students");
  $stmt->bindParam(':timestamp', time());

  $stmt->execute();

}

  // $stmt->execute();

  // return "New records created successfully $name";
  if ($counter == $rownum) {
    // code...
    return true;
  }else{
    return false;
  }
} 
catch(PDOException $e) {
    $_SESSION['err'] = $e->getMessage();
  return false;
}
}



public function SendMemoToStaff($result, $Subject, $Memo)
{
    // code...
            try{
$db = new db();
$db = $db->connect();
  // prepare sql and bind parameters
$sql = "INSERT INTO staff (usertoken, subject, memo, acc_type, timestamp)
  VALUES (:usertoken, :subject, :memo, :acc_type, :timestamp)";
  $stmt = $db->prepare($sql);


$rownum= sizeof($result);
     $counter = 0;

foreach ($result as $key => $value) {
$counter = ++$counter;

 $stmt->bindParam(':usertoken', $value['token']);
  $stmt->bindParam(':subject', $Subject);
  $stmt->bindParam(':memo', $Memo);
  $stmt->bindParam(':acc_type', "Staff");
  $stmt->bindParam(':timestamp', time());

  $stmt->execute();

}

  // $stmt->execute();

  // return "New records created successfully $name";
  if ($counter == $rownum) {
    // code...
    return true;
  }else{
    return false;
  }
} 
catch(PDOException $e) {
    $_SESSION['err'] = $e->getMessage();
  return false;
}
}



public function Login ($mail, $pword){

        try {
        $sql = "SELECT * from admin where mail = ?";
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