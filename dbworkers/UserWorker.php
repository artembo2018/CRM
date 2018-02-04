<?php
class UserWorker extends Worker {
    
    public function validate($login, $pass, $pass_repeat) {
        $status = $this->check_login($login);
        if($status['status'] == 'success')
          return $this->check_pass($pass, $pass_repeat);
        else 
          return $status;
    }
    
    private function check_pass($pass, $pass_repeat) {
        if($pass !== $pass_repeat)
          return array('status' => 'error','message' => "Пароли не совпадают"); 
        if(strlen($pass) < 6 ) 
          return array('status' => 'error','message' => "Пароль должен иметь не менее 6 символов");
        return array('status' => 'success','message' => "OK");
    }
    
    private function check_login($login) {
        if(strlen($login) < 4 ) 
          return array('status' => 'error','message' => "Логин должен иметь не менее 4 символов");
        if($this->check_user_login_exists($login))  
          return array('status' => 'error','message' => "Такой пользователь уже существует");
        return array('status' => 'success','message' => "OK");        
    }
    
    public function insert($login, $pass) {
        $statement = $this->dbh->prepare("INSERT INTO users(login,pwd) VALUES (:login,:pass);");
        $statement->execute(array(":login" => $login, ":pass" => $pass));
        $rows = $this->dbh->query("SELECT MAX(id) AS user_id FROM users;");
        $row =$rows->fetch();
        return $row['user_id'];
    }
    
    private function check_user_login_exists($login) {
        $statement = $this->dbh->prepare("SELECT id FROM users WHERE login = :login;");
        $statement->execute(array(":login" => $login));
        $row = $statement->fetch();
        return empty($row['id'])? false : $row['id'];
    }
    
    public function check_user_exists($login,$pwd) {
        $statement = $this->dbh->prepare("SELECT id FROM users WHERE login = :login AND pwd=:pwd;");
        $statement->execute(array(":login" => $login, ":pwd" => $pwd));
        $row = $statement->fetch();
        return empty($row['id'])? false : $row['id'];
    }
    
    public function check_user_admin($login) {
        $statement = $this->dbh->prepare("SELECT isAdmin FROM users WHERE login = :login;");
        $statement->execute(array(":login" => $login));
        $row = $statement->fetch();
        return empty($row['isAdmin'])? false : $row['isAdmin'];        
    }
    
     public function check_user_admin_by_id($id) {
        $statement = $this->dbh->prepare("SELECT isAdmin FROM users WHERE id = :id;");
        $statement->execute(array(":id" => $id));
        $row = $statement->fetch();
        return empty($row['isAdmin'])? false : $row['isAdmin'];        
    }
    
    public function check_user_admin2($id, $pwd) {
        $statement = $this->dbh->prepare("SELECT isAdmin FROM users WHERE id = :id AND pwd = :pwd ;");
        $statement->execute(array(":id" => $id, ":pwd" => $pwd));
        $row = $statement->fetch();
        return empty($row['isAdmin'])? false : $row['isAdmin'];        
    }
    
    public function delete_user($admin_id, $id, $pwd) {
        if(!$this->check_user_admin2($admin_id,$pwd)) return false;
        $statement = $this->dbh->prepare(" DELETE FROM users_reports WHERE user_id = :id; DELETE FROM users WHERE id = :id;");
        $statement->execute(array(":id" => $id));
        return true;
    }
    
    public function change_user_login($admin_id, $id, $login, $pwd) {
        if(!$this->check_user_admin2($admin_id,$pwd)) return false; // user is not admin
        if($this->check_user_login_exists($login)) return false; // this login already exists
        $statement = $this->dbh->prepare("UPDATE users SET login = :login WHERE id = :id");
        $statement->execute(array(":id" => $id , ":login" => $login));
        return true;
    }
    
    public function change_user_pwd($admin_id, $id, $pwd, $pwd_admin) {
        if(!$this->check_user_admin2($admin_id,$pwd_admin)) return false;
        $statement = $this->dbh->prepare("UPDATE users SET pwd = :pwd WHERE id = :id");
        $statement->execute(array(":id" => $id , ":pwd" => $pwd));
        return true;
    }
    
    public function check_user_record_exists($user_id,$month,$day) {
        $statement = $this->dbh->prepare("SELECT hours, comment FROM users_reports WHERE  user_id = :id AND month = :month AND day = :day;");
        $statement->execute(array(":id" => $user_id, ":month" => $month, "day" => $day));
        $row = $statement->fetch();
        return empty($row)? false : $row;
    }
    
    public function get_user_report($id, $month, $day) {
        $statement = $this->dbh->prepare("SELECT month, day, hours, comment FROM users_reports WHERE user_id = :id AND month = :month AND day = :day;");
        $statement->execute(array(":id" => $id, ":month" => $month, ":day" => $day));
        return $statement->fetch();
    }
    
    public function get_users_info($month) {
        $statement = $this->dbh->prepare("SELECT users.id AS id, SUM(hours) AS sum_hours, login, pwd FROM users LEFT JOIN users_reports ON users.id = users_reports.user_id WHERE users_reports.month = :month AND users.isAdmin = 0 GROUP BY users.id");
        $statement->execute(array(":month" => $month));
        return $statement->fetchAll();        
    }
    
    public function change_user_report($id, $month, $day, $hours, $comment) {
        $comment = $this->normalize($comment);
        $s = 'id='.$id.'&month='.$month.'&day='.$day."&hours=".$hours."&comment=".$comment;
        if($this->check_user_record_exists($id,$month,$day)) 
            $statement = $this->dbh->prepare("UPDATE users_reports SET hours = :hours, comment = :comment WHERE user_id = :id AND month = :month AND day = :day;");
        else 
            $statement = $this->dbh->prepare("INSERT INTO users_reports(user_id, month, day, hours, comment) VALUES(:id,:month,:day,:hours,:comment);");
        $statement->execute(array(":id" => $id, ":month" => $month, ":day" => $day, ":hours" => intval($hours), ":comment" => $comment));

        return array("s" => $s, "hours" => intval($hours), "comment" => $comment);
    }
    
    public function add_user_report($id, $month, $day,$hours,$comment) {
        if( $hours <= 0 ) return 0;
        $comment = $this->normalize($comment);
        $statement = $this->dbh->prepare("SELECT hours FROM users_reports WHERE user_id = :id AND month = :month AND day = :day;");
        $statement->execute(array(":id" => $id, ":month" => $month, ":day" => $day));
        $row = $statement->fetch();
        
        $hours += intval($row['hours']);
        if(!empty($row['hours']))
            $statement = $this->dbh->prepare("UPDATE users_reports SET hours = :hours, comment = :comment WHERE user_id = :id AND month = :month AND day = :day;");
        else
            $statement = $this->dbh->prepare("INSERT INTO users_reports(user_id, month, day, hours, comment) VALUES(:id,:month,:day,:hours,:comment);");
        $statement->execute(array(":id" => $id, ":month" => $month, ":day" => $day, ":hours" => $hours, ":comment" => $comment));
        return $hours;
    }
    
    
}