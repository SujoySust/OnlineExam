<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include 'inc/navbar.php';
	include_once ($filepath.'/../classes/exam.php');
	$exm = new exam();
?>

<?php
 if(isset($_GET['edit'])){
 	$delid = (int)$_GET['del'];
 	$delQues = $exm->DeleteQues($delid);
 }
?>

<?php
if(isset($_GET['delall'])){
    $delAllQues = $exm->DeleteAllQues();
}
?>

<div class="main">
    <h1>Qustion List</h1>



<div class="quelist">
    <div class="starttest">
        <a onclick="return confirm('Are You Sure to Remove All of the Questions??')" href="?delall=2">Remove All Question</a>
    </div>
	<?php
       if(isset($eblQues)){
           echo $eblQues;
       }

       if(isset($delQues)){
           echo $delQues;
       }

       if(isset($delAllQues)){
           echo $delAllQues;
       }


	?>

	<table class="tblone">
		<tr>
			<th>No</th>
			<th width="70%">Questions</th>
			<th width="20%">Action</th>
		</tr>
      <?php

        $questiondata = $exm->getAllQusetion();
          if($questiondata){
          $i=0;
     	   while($result = $questiondata->fetch_assoc())
     	       {
     		$i++;


 
      ?>
          <tr>
              <td>
                  <?php echo "<span>".$i."</span>";?>

			</td>


            <td><?php echo $result['ques'];?></td>



            <td>
              <a href="editques.php?edit=<?php echo $result['quesNo'];?>" style="
	text-decoration: none;
	font-size: 15px;
	border: none;
	outline: 0;
	display: inline-block;
	padding: 7px;
	color: #ffff00;
	background-color: #000;
	text-align: center;
	cursor: pointer;
	width: 95%;
">EDIT</a>
			</td>
          </tr>
            <?php } }?>
	</table>

</div>

</div>
<?php include 'inc/footer.php'; ?>