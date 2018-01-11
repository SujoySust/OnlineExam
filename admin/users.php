<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/inc/header.php');
	include_once ($filepath.'/../classes/User.php');
	$user = new User();
?>
<?php
 if(isset($_GET['dis'])){
 	$dblid = (int)$_GET['dis'];
 	$dblUser = $user->DisableUser($dblid);
 }
?>

<?php
 if(isset($_GET['ena'])){
 	$eblid = (int)$_GET['ena'];
 	$eblUser = $user->EnableUser($eblid);
 }
?>

<?php
 if(isset($_GET['del'])){
 	$delid = (int)$_GET['del'];
 	$delUser = $user->DeleteUser($delid);
 }
?>

<div class="main">
    <h2>Admin Panel -User List</h2>
<div class="manageUser">
	<?php

       if(isset($dblUser))
       	echo $dblUser;
       if(isset($eblUser))
       	echo $eblUser;
       if(isset($delUser))
       	echo $delUser;

	?>

	<table class="tblone">
		<tr>
			<th>No</th>
			<th>Name</th>
			<th>UserName</th>
			<th>Email</th>
			<th>Action</th>
		</tr>
<?php
     
     $userdata = $user->getAllUser(); 
     if($userdata){
       $i=0;
     	while($result = $userdata->fetch_assoc())
     	{
     		$i++;

 

?>
		<tr>
			<td>
				<?php
                     
                     if($result['status']=='1')
                     {
                     	echo "<span class='error'>".$i."</span>";
                     }else{
                     	echo $i;
                     }

				 ?>
					
			</td>
			<td><?php echo $result['name'];?></td>
			<td><?php echo $result['username'];?></td>
			<td><?php echo $result['email'];?></td>
			<td> 
                  
                 <?php
                 if($result['status']=='0'){

                 ?> 

				<a onclick="return confirm('Are You Sure to Disable')" href="?dis= <?php echo $result['userId'];?>">Disable</a>
				<?php } else {?>
                <a onclick="return confirm('Are You Sure to Enable')" href="?ena= <?php echo $result['userId'];?>">Enable</a>
                <?php }?>
				||<a onclick="return confirm('Are You Sure to Remove')" href="?del= <?php echo $result['userId'];?>">Remove</a>
			</td>

		</tr>

<?php } }?>


	</table>

</div>



	
</div>
<?php include 'inc/footer.php'; ?>