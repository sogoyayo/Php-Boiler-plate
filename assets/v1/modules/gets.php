<?

class Gets extends db {

public function getLevelName ($levelid){

 $sql = "SELECT * from levels where id = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$levelid])) {
                    $stmt = null;
                    return false;
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
    	return $user[0]['level'];
    }

    }
}

}



public function getFacultyName ($facultyid){

 $sql = "SELECT * from levels where id = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$facultyid])) {
                    $stmt = null;
                    return false;
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
      return $user[0]['faculty'];
    }

    }
}

}


public function getDeptName ($deptid){

 $sql = "SELECT * from levels where id = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$deptid])) {
                    $stmt = null;
                    return false;
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
      return $user[0]['dept'];
    }

    }
}

}


private function userIsStudent ($mail) {
    $sql = "SELECT * from students where mail = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$mail])) {
                    $stmt = null;
                    return false;
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }elseif($stmt->rowCount() > 0){
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
      return true;
    }else{
      $stmt = null;
            return false;
    }

    }else{
      $stmt = null;
            return false;
    }
}

}


private function userIsStaff ($mail) {
    $sql = "SELECT * from staff where mail = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$mail])) {
                    $stmt = null;
                    return false;
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }elseif($stmt->rowCount() > 0){
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
      return true;
    }else{
      $stmt = null;
            return false;
    }

    }else{
      $stmt = null;
            return false;
    }
}

}



private function userIsManagement ($mail) {
    $sql = "SELECT * from admin where mail = ?";
                $stmt = $this->connect()->prepare($sql);
                if (!$stmt->execute([$mail])) {
                    $stmt = null;
                    return false;
                }else{
        if($stmt->rowCount() == 0){

           $stmt = null;
            return false;
            // code...
        }elseif($stmt->rowCount() > 0){
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
      return true;
    }else{
      $stmt = null;
            return false;
    }

    }else{
      $stmt = null;
            return false;
    }
}

}


public function getAccountType ($mail){
$Gets = new Gets();
   if ($Gets->userIsStudent($mail)==true) {
      // code...
      return "Student";
   }elseif($Gets->userIsStaff($mail)==true){
return "Staff";
   }elseif($Gets->userIsManagement($mail)==true){
      return "Management";
   }else{
      $_SESSION['err'] = "Unknown account.. $mail does not exist here.";
      return false;
   }

}


// end of class
}

?>