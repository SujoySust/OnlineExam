<?php
/**
 * Created by PhpStorm.
 * User: Sujoy Nath
 * Date: 1/18/2018
 * Time: 11:43 PM
 */
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/classes/User.php');
$usr = new User();
if($_SERVER['REQUEST_METHOD'] == "POST")
{

    $reg = $_POST['reg'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    $userregi = $usr->userRegistration($reg,$name, $username, $password, $email);
}

?>