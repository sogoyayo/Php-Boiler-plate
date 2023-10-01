<?

class User extends db {

public function Login ($mail, $pword){

try {
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
        }else{
            
           if($user = $stmt->fetchAll(PDO::FETCH_ASSOC)){
    if (md5($pword) == $user[0]['pword']) {
      // code...
      return $user[0];
    }else{
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