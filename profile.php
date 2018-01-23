<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php
Session::checkSession();
$userId = Session::get("userId");

?>
<style>
    .profile{width: 530px;margin: 0 auto;border: 1px solid #3399FF;padding:30px 50px 50px 138px}
    .profile table{padding: 20px}
    .profile table tr td{padding: 10px}
</style>

    <div class="main">
        <h1>Your Profile</h1>

        <div class="profile">
            <form action="" method="post">
                <?php
                $getData= $usr->getUserData($userId);
                if($getData){
                    $result = $getData->fetch_assoc();
                ?>
                <table class="tblone">
                    <tr>
                        <td>Name</td>
                        <td><strong><?php echo $result['name']?></strong></td>
                        <td><a href="editprofile.php?userId=<?php echo $result['userId'];?>">Edit</a></td>

                    </tr>
                    <tr>
                        <td>UserName</td>
                        <td><strong><?php echo $result['username']?></strong></td>
                        <td><a href="editprofile.php?userId=<?php echo $result['userId'];?>">Edit</a></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><strong><?php echo $result['email']?></strong></td>
                        <td><a href="editprofile.php?userId=<?php echo $result['userId'];?>">Edit</a></td>
                    </tr>
                </table>
                <?php }?>
            </form>
        </div>

    </div>
<?php include 'inc/footer.php'; ?>