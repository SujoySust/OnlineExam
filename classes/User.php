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

    public function userRegistration($name,$username,$password,$email){
        $name = $this->fm->validation($name);
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        $email = $this->fm->validation($email);

        $name = mysqli_real_escape_string($this->db->link,$name);
        $username = mysqli_real_escape_string($this->db->link,$username);
        $password = mysqli_real_escape_string($this->db->link,md5($password));
        $email = mysqli_real_escape_string($this->db->link,$email);

        if($name == ""||$username==""||$password==""||$email==""){
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
                $query = "insert into tbl_user(name,username,password,email)values('$name','$username','$password','$email')";
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
         $name = $this->fm->validation($data['name']);
         $username = $this->fm->validation($data['username']);
         $email = $this->fm->validation($data['email']);
         $name = mysqli_real_escape_string($this->db->link,$name);
         $username = mysqli_real_escape_string($this->db->link,$username);
         $email = mysqli_real_escape_string($this->db->link,$email);
         $query = "update tbl_user
                    set 
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
     public function userScore($userId,$name,$score){
         $userId = $this->fm->validation($userId);
         $name = $this->fm->validation($name);
         $score = $this->fm->validation($score);
         $userId = mysqli_real_escape_string($this->db->link, $userId);
         $name = mysqli_real_escape_string($this->db->link,$name);
         $score = mysqli_real_escape_string($this->db->link,$score);

         $query = "insert into tbl_score(userId,name,score)values('$userId','$name','$score')";
         $inserted_row = $this->db->insert($query);

     }
    public function userScoreBoard($userId,$name,$score){
        $userId = $this->fm->validation($userId);
        $name = $this->fm->validation($name);
        $score = $this->fm->validation($score);
        $userId = mysqli_real_escape_string($this->db->link, $userId);
        $name = mysqli_real_escape_string($this->db->link,$name);
        $score = mysqli_real_escape_string($this->db->link,$score);

        $query = "insert into tbl_scoreboard(userId,name,score)values('$userId','$name','$score')";
        $inserted_row = $this->db->insert($query);
    }
    public function getAllScore(){
        $query = "select * from tbl_scoreboard order by score desc,id asc";
        $result = $this->db->select($query);
        return $result;
    }
}



?>