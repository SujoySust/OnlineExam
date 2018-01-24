<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php
Session::checkSession();
$userId = Session::get("userId");

?>

<?php
if ($_SERVER['REQUEST_METHOD']=='POST')
{
    $updateUser=$usr->updateUserData($userId,$_POST);
}
?>
    <style>
        .profile{width: 530px;margin: 0 auto;border: 1px solid #3399FF;padding:30px 50px 50px 138px}

    </style>

    <div class="main">
        <h1>Your Profile</h1>


        <div class="profile">
            <?php
            if(isset($updateUser)){
                echo $updateUser;

            }
            ?>
            <form action="" method="post">
                <?php
                $getData= $usr->getUserData($userId);
                if($getData){
                    $result = $getData->fetch_assoc();
                    ?>
                    <table class="tbl">
                        <tr>
                            <td>Reg No</td>
                            <td><input name="reg" type="text" value="<?php echo $result['reg'];?>"></td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><input name="name" type="text" value="<?php echo $result['name'];?>"></td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input name="username" type="text" value="<?php echo $result['username'];?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input name="email" type="text" value="<?php echo $result['email'];?>"></td>
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