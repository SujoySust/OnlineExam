<?php include 'inc/header.php'; ?>
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

<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $updateAdmin=$usr->updateAdminData($_POST);
}
?>
    <style>
        .profile{width: 530px;margin: 0 auto;border: 1px solid #3399FF;padding:30px 50px 50px 138px}

    </style>

    <div class="main">
        <h1>Your Profile</h1>


        <div class="profile">
            <?php
            if(isset($updateAdmin)){
            ?>
                <h3>Admin Data Updated Succeessfully </h3>
                <?php }?>

            <form action="" method="post">
                <?php
                $getData= $usr->getAdminData();
                if($getData){
                    $result = $getData->fetch_assoc();
                    ?>
                    <table class="tbl">
                        <tr>
                            <td>Name</td>
                            <td><input name="adminUser" type="text" value="<?php echo $result['adminUser'];?>"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input name="adminPass" type="password"></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td><input type="submit" value="Update">
                            </td>
                        </tr>
                    </table>
                <?php }?>
            </form>
        </div>
    </div>
<?php include 'inc/footer.php'; ?>