<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include 'inc/navbarwritten.php';
	include_once ($filepath.'/../classes/exam.php');
	$exm = new exam();
?>

<?php
if(isset($_GET['delall'])){
    $delAllQues = $exm->DeleteAllWrittenQues();
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
			<th width="65%">Questions</th>
            <th width="10%">Marks</th>
			<th width="15%">Action</th>
		</tr>
      <?php

        $questiondata = $exm->getWrittenQuesList();
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


            <td><?php echo $result['question'];?></td>
              <td><?php echo $result['marks'];?></td>



            <td>
              <a href="editwrittenques.php?edit= <?php echo $result['quesNo'];?>" style="text-decoration: none;
            font-size: 20px;
            border: none;
            outline: 0;
            display: inline-block;
            padding: 7px;
            color: #ffff00;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 95%;">Edit</a>
			</td>
          </tr>
            <?php } }?>
	</table>

</div>

</div>
<?php include 'inc/footer.php'; ?>