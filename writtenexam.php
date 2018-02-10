<?php include 'inc/header.php';
Session::checkSession();
?>
    <div class="menu">
        <ul>
                <li><a href="final.php">End Exam</a></li>
                <li><a href="?action=logout">Logout</a></li>

        </ul>
        <span style="float: right;color: brown">
                <strong><?php echo Session::get("name");?></strong>
            </span>
    </div>
<?php
$question = $exm->getWrittenQues();
if($question == null)
{
    $count = 0;
}else{
    $count = $question->num_rows;
}

 $id = Session::get("userId");
 //$reg = Session::get("reg");
 //$name = Session::get("name");
?>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $answer = $pro->getWrittenAnswer($id);
    //$question = $exm->getWrittenQues();
  //  $count = $question->num_rows;
   if($answer == null){
       $process = $pro->processWrittenReasult($_POST,$count,$id);
       $scoreboard = $pro->processScoreboard();

    }
}

if (isset($process)){
    header("Location:writtenfinal.php");
}

?>
<style>

    .table tr td {padding: 1%;margin: 2%}
</style>
<div class="main" style="background: #2E5E79;">
	<div class="test">
        <?php if($count == 0){?>
     <h2>Examination Not Started.Please Wait .....</h2>
    <?php } else{?>

		<form method="post" action="">
		<table class="table"style="width: 80%">
            <?php
            $i = 0;
             if(isset($question)){
                while ($result=$question->fetch_assoc()){

                ?>
			<tr>

				<td>
				 <h3>Que <?php echo $result['quesNo'];?>:<?php echo $result['question'];?><strong style="color:#FFFFFF;float: right;font-size: 24px;"><?php echo $result['marks']?></strong> </h3>
                    <input type="hidden" name="number<?php echo $i;?>" value="<?php echo $result['quesNo'];?>"/>
                    <input type="hidden" name="question<?php echo $i;?>" value="<?php echo $result['question'];?>"/>
				</td>

			</tr>
			<tr>
				<td>
				 <textarea name="ans<?php echo $i;?>" style="border: 1px solid #fff;color: #000;padding: 10px;width: 125%;height: 100px;font-size: 20px;"></textarea>
                 <input type="hidden" name="marks<?php echo $i;?>" value="<?php echo $result['marks'];?>"/>
				</td>
			</tr>


			<?php $i++; } }?>

            <tr>
                <td>
                    <input type="submit" name="submit" value="Submit"/>

                </td>
            </tr>
			
		</table>
            <?php }?>
</div>
 </div>
<?php include 'inc/footer.php'; ?>