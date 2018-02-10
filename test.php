<?php include 'inc/header.php'; ?>
    <div class="menu">
        <ul>
                <li><a href="final.php">End Exam</a></li>
                <li><a href="?action=logout">Logout</a></li>

        </ul>
        <span style="float: right;background: #00007C;padding: 10px 20px;">
            <strong><?php echo Session::get("name");?></strong>
        </span>

    </div>
<?php
Session::checkSession();
if(isset($_GET['q'])){
   $number = (int)$_GET['q'];
}
else{
    header("Location:exam.php");
}
$total = $exm ->getTotalRows();
$question = $exm->getQuesByNumber($number);
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $process = $pro->processData($_POST);
}

?>
<div class="main">
<h1>Question <?php echo $question['quesNo'];?> of <?php echo $total?></h1>
	<div class="test">
		<form method="post" action="">
		<table> 
			<tr>
				<td colspan="2">
				 <h3>Que <?php echo $question['quesNo'];?>: <?php echo $question['ques'];?></h3>
				</td>
			</tr>
            <?php
            $answer = $exm ->getAnswer($number);
            if ($answer){
                while ($result = $answer->fetch_assoc()){

            ?>

			<tr>
				<td>
				 <input type="radio" name="ans" value="<?php echo $result['id'];?>" style="width: 40px;height: 20px;"/>
                    <?php echo $result['ans'];?>
				</td>
			</tr>
			<?php } }?>


			<tr>
			  <td>
				<input type="submit" name="submit" value="Next Question"/>
				<input type="hidden" name="number" value="<?php echo $number;?>"/>
			</td>
			</tr>
			
		</table>
</div>
 </div>
<?php include 'inc/footer.php'; ?>