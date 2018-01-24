<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Session.php');
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');

class User
{
	private $db;
	private $fm;
	public function __construct()
	{
		$this->db = new Database();
		$this->fm = new Format();
	}

    public function userRegistration($reg,$name,$username,$password,$email){
        $reg = $this->fm->validation($reg);
        $name = $this->fm->validation($name);
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        $email = $this->fm->validation($email);

        $reg = mysqli_real_escape_string($this->db->link,$reg);
        $name = mysqli_real_escape_string($this->db->link,$name);
        $username = mysqli_real_escape_string($this->db->link,$username);
        $password = mysqli_real_escape_string($this->db->link,md5($password));
        $email = mysqli_real_escape_string($this->db->link,$email);

        if($reg== ""||$name == ""||$username==""||$password==""||$email==""){
            echo "<span class='error'>Fileds Must not be empty !!</span>";
            exit();

        }else if(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
            echo "<span class='error'>Invalid email address !!</span>";
            exit();

        }else{
            $check = "select * from tbl_user where email = '$email'";
            $check = $this->db->select($check);
            if($check!=false){
                echo "<span class='error'>Email address already exist</span>";
            }
            else{
                $query = "insert into tbl_user(reg,name,username,password,email)values('$reg','$name','$username','$password','$email')";
                $inserted_row = $this->db->insert($query);
                if($inserted_row){
                    echo "<span class='success'>Registration Successful</span>";

                }else{
                    echo "<span class='success'>Registration Failed</span>";
                }
            }
        }


    }

    public function userLogin($email,$password){
	    $email = $this->fm->validation($email);
	    $password = $this->fm->validation($password);
	    $email = mysqli_real_escape_string($this->db->link,$email);
	    $password =mysqli_real_escape_string($this->db->link,md5($password));
        if($password==""||$email==""){
            echo "empty";
            exit();

        }else{
            $query = "select * from tbl_user where email = '$email' and password = '$password'";
            $result = $this->db->select($query);
            if($result!=false){
                $value = $result->fetch_assoc();
                if($value['status']=='1'){
                    echo "disable";
                    exit();
                }else{
                    Session::init();
                    Session::set("login",true);
                    Session::set("reg",$value['reg']);
                    Session::set("userId",$value['userId']);
                    Session::set("username",$value['username']);
                    Session::set("name",$value['name']);
                }
            }else{
                echo "error";
                exit();
            }

        }

    }



	public function getAdminData($data){

          $adminUser = $this->fm->validation($data['adminUser']);
          $adminPass = $this->fm->validation($data['adminPass']);
          $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
          $adminPass = mysqli_real_escape_string($this->db->link,md5($adminPass));

	}
    public function getUserData($userId){

        $query = "select * from tbl_user where userId = '$userId'";
        $result = $this->db->select($query);
        return $result;
    }
     public function getAllUser(){

          $query = "select * from tbl_user order by userId desc";
          $result = $this->db->select($query);
          return $result;
     }

     public function DisableUser($userid)
     {
          $query = "update tbl_user
                    set 
                    status = '1'
                    where userId = '$userid'";
          $updated_row = $this->db->update($query);
          if($updated_row)
          {
               $msg = "<span class='success'>User Disabled! </span>";
               return $msg;
          }
          else{
               $msg = "<span class='error'>User Not Disabled! </span>";
               return $msg; 
          }

     }

     public function EnableUser($userid)
     {
          $query = "update tbl_user
                    set 
                    status = '0'
                    where userId = '$userid'";
          $updated_row = $this->db->update($query);
          if($updated_row)
          {
               $msg = "<span class='success'>User Enabled! </span>";
               return $msg;
          }
          else{
               $msg = "<span class='error'>User Not Enabled! </span>";
               return $msg; 
          }

     }

     public function DeleteUser($userid){

      $query = "delete from tbl_user where userId = '$userid'";
      $deldata = $this->db->delete($query);
         if($deldata)
          {
               $msg = "<span class='success'>User Removed! </span>";
               return $msg;
          }
          else{
               $msg = "<span class='error'>User Not Removed! </span>";
               return $msg; 
          }

     }

     public function updateUserData($userId,$data){
	     $reg = $this->fm->validation($data['reg']);
         $name = $this->fm->validation($data['name']);
         $username = $this->fm->validation($data['username']);
         $email = $this->fm->validation($data['email']);
         $reg = mysqli_real_escape_string($this->db->link,$reg);
         $name = mysqli_real_escape_string($this->db->link,$name);
         $username = mysqli_real_escape_string($this->db->link,$username);
         $email = mysqli_real_escape_string($this->db->link,$email);
         $query = "update tbl_user
                    set 
                    reg = '$reg',
                    name = '$name',
                    username = '$username',
                    email = '$email'
                    where userId = '$userId'";
         $updated_row = $this->db->update($query);
         if($updated_row)
         {
             $msg = "<span class='success'>User Update successful! </span>";
             return $msg;
         }
         else{
             $msg = "<span class='error'>User Not Udated! </span>";
             return $msg;
         }

     }
     public function getUserScore($userId){
         $query = "select * from tbl_scoreboard where userId = '$userId'";
         $result = $this->db->select($query);
         return $result;
     }

    public function userScoreBoard($userId,$reg,$name,$score){
        $userId = $this->fm->validation($userId);
        $reg = $this->fm->validation($reg);
        $name = $this->fm->validation($name);
        $score = $this->fm->validation($score);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $reg = mysqli_real_escape_string($this->db->link, $reg);
        $name = mysqli_real_escape_string($this->db->link,$name);
        $score = mysqli_real_escape_string($this->db->link,$score);

        $query = "insert into tbl_scoreboard(userId,reg,name,score)values('$userId','$reg','$name','$score')";
        $inserted_row = $this->db->insert($query);
    }
    public function getAllScore(){
        $query = "select * from tbl_scoreboard order by score desc,id asc";
        $result = $this->db->select($query);
        return $result;
    }
    public function getPersonalScore($reg){
        $query = "select * from tbl_score where reg = '$reg'";
        $result = $this->db->select($query);
        return $result;
    }
    public function resetScoreBord(){
        $query = "delete from tbl_scoreboard";
        $deldata = $this->db->delete($query);
    }
    public function resetPastScore(){
        $query = "delete from tbl_scoreteacher";
        $deldata = $this->db->delete($query);
        if(isset($deldata)){
            $msg = "Previous Result Successfully Removed";
            return $msg;
        }else{
            $msg = "Previous Result Not Removed";
            return $msg;
        }
    }

    public function addToTeacherScore($userId,$reg, $name,$score){

        $userId = $this->fm->validation($userId);
        $reg = $this->fm->validation($reg);
        $name = $this->fm->validation($name);
        $score = $this->fm->validation($score);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $reg = mysqli_real_escape_string($this->db->link, $reg);
        $name = mysqli_real_escape_string($this->db->link,$name);
        $score = mysqli_real_escape_string($this->db->link,$score);

        $query = "insert into tbl_scoreteacher(userId,reg,name,score)values('$userId','$reg','$name','$score')";
        $inserted_row = $this->db->insert($query);
    }
    public function addToStudentScore($userId,$reg, $name,$score){

        $userId = $this->fm->validation($userId);
        $reg = $this->fm->validation($reg);
        $name = $this->fm->validation($name);
        $score = $this->fm->validation($score);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $reg = mysqli_real_escape_string($this->db->link, $reg);
        $name = mysqli_real_escape_string($this->db->link,$name);
        $score = mysqli_real_escape_string($this->db->link,$score);

        $query = "insert into tbl_score(userId,reg,name,score)values('$userId','$reg','$name','$score')";
        $inserted_row = $this->db->insert($query);
    }
    public function getAllScoreTeacher(){
        $query = "select * from tbl_scoreteacher";
        $result = $this->db->select($query);
        return $result;
    }
}



?>