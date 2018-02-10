<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php

Session::checkSession();
?>
<div class="main">
<h1>Welcome to Online Exam - Start Now</h1>
	<div class="segment" style="margin-right:30px;">
		<img src="img/online_exam.png"/>
	</div>
	<div class="segment">
	<h2>Start Test</h2>
	<ul>
		<li><a href="starttest.php">MCQ</a></li>
	</ul>
	</div>
    <div class="segment" style="margin-right:30px;">
        <img src="img/online_exam.png"/>
    </div>
    <div class="segment">
        <h2>Start Test</h2>
        <ul>
            <li><a href="writtentest.php">WRITTEN</a></li>
        </ul>
    </div>
	
  </div>
<?php include 'inc/footer.php'; ?>