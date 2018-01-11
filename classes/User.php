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

	public function getAdminData($data){

          $adminUser = $this->fm->validation($data['adminUser']);
          $adminPass = $this->fm->validation($data['adminPass']);
          $adminUser = mysqli_real_escape_string($this->db->link,$adminUser);
          $adminPass = mysqli_real_escape_string($this->db->link,md5($adminPass));

	}

     public function getAllUser(){

          $query = "select * from tbl_user";
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
}



?>