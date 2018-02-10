<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
?>
<?php
  // Session::checkLogin();
?>
    <div class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="mcq.php">Mcq Exam</a></li>
            <li><a href="written.php">Written exam</a></li>
            <li><a href="editadminprofile.php">Change Username</a></li>
            <li><a href="editadminprofile.php">Change Password</a></li>
            <li><a href="users.php">Manage user</a></li>
            <li><a href="?action=logout">Logout</a></li>

        </ul>
    </div>
<div class="main">
<h1>Admin Panel</h1>
    <h3 style="padding: 2%;border: 1px solid black;background: #000000;text-align: center">Welcome Teacher To Your Controll Panel</h3>
    <div class="starttest">
        <a href="mcq.php"">MCQ EXAM</a>
        <a href="written.php"">WRITTEN EXAM</a>
    </div>


	
</div>
<?php include 'inc/footer.php'; ?>