<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/exam.php');
	$exm = new exam();
?>

<?php
 if(isset($_GET['del'])){
 	$delid = (int)$_GET['del'];
 	$delQues = $exm->DeleteQues($delid);
 }
?>

<div class="main">
    <h1>Qustion List</h1>

<div class="quelist">
	<?php
       if(isset($eblQues))
       	echo $eblQues;
       if(isset($delQues))
       	echo $delQues;

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
              <a onclick="return confirm('Are You Sure to Remove')" href="?del= <?php echo $result['quesNo'];?>">Delete</a>
			</td>
          </tr>
            <?php } }?>
	</table>

</div>

</div>
<?php include 'inc/footer.php'; ?>