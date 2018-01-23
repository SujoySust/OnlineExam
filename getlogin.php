<?php
/**
 * Created by PhpStorm.
 * User: Sujoy Nath
 * Date: 1/19/2018
 * Time: 1:38 AM
 */
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/classes/User.php');
$usr = new User();
if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $email = $_POST['email'];
    $password = $_POST['password'];


    $userlogin = $usr->userLogin($email,$password);
}


?>