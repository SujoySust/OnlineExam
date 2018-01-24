<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php
Session::checkSession();
$userId = Session::get("userId");
$name = Session::get("name");
$reg = Session::get("reg");

?>
<style>
    .profile{width: 530px;margin: 0 auto;border: 1px solid #3399FF;padding:30px 50px 50px 138px;margin-bottom: 10px}

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
                        <td>Reg No</td>
                        <td><strong><?php echo $result['reg']?></strong></td>
                        <td><a href="editprofile.php?userId=<?php echo $result['userId'];?>">Edit</a></td>

                    </tr>
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
        <h1>Your Past Score</h1>
        <div class="profile">
            <table class="tblone">
            <tr>
                <th>No</th>
                <th width="20%">Reg No</th>
                <th width="50%">Name</th>
                <th width="20%">Score</th>
            </tr>
            <?php

            $scoredata = $usr->getPersonalScore($reg);
            if($scoredata){
                $i=0;
                while($result = $scoredata->fetch_assoc())
                {
                    $i++;
                    ?>
                    <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $result['reg']; ?></td>
                        <td><?php echo $result['name']; ?></td>
                        <td><?php echo $result['score']; ?></td>
                    </tr>
                <?php } }?>

            </table>
        </div>

    </div>
<?php include 'inc/footer.php'; ?>