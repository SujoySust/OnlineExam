<?php include 'inc/header.php'; ?>
<?php include 'inc/navsection.php';?>
<?php
Session::checkSession();
$userId = Session::get("userId");
$name = Session::get("name");
$reg = Session::get("reg");

?>


<?php
if(isset($_GET['mcq']))
{
    $id = $_GET['mcq'];
    $deldata = $usr->deletePersonalScore($id);
}

if(isset($_GET['written']))
{
    $id = $_GET['written'];
    $deldatawritten = $usr->deletePersonalWrittenScore($id);
}

?>


    <style>
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 350px;
            margin: auto;
            text-align: center;
            font-family: arial;
            color: #ffff00;
        }
        .card img {
            max-width: 200px;
        }

        .card h3 {
            padding: 1%;
            box-shadow: 0px 0px 8px 0px #1da1a8;
            background: #00007C;
            color: #fff;
        }

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

       .card a {
            text-decoration: none;
            font-size: 22px;
            border: none;
            outline: 0;
            display: inline-block;
            padding: 9px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 95%;
        }

        button:hover, a:hover {
            opacity: 0.7;
        }
    </style>

    <div class="main">
        <h1>Your Profile</h1>

        <div class="profile">
                <?php
                $getData= $usr->getUserData($userId);
                if($getData){
                    $result = $getData->fetch_assoc();
                ?>

                    <div class="card">
                        <img src="img/online_exam.png" alt="John" style="width:100%">
                        <h3><?php echo $result['reg']?></h3>
                        <h3><?php echo $result['name']?></h3>
                        <h3><?php echo $result['username']?></h3>
                        <h3><?php echo $result['email']?></h3>
                        <p><a href="editprofile.php?userId=<?php echo $result['userId'];?>">Update</a></p>
                    </div>

                <?php }?>
        </div>
        <h1>Your Past Mcq Score</h1>
        <div class="profile">
            <?php if( isset($deldata)){?>
            <h3>Your Score Has been Deleted</h3>
    <?php }?>
            <table class="tblone">
                <tr>
                    <th>No</th>
                    <th width="20%">Reg No</th>
                    <th width="40%">Name</th>
                    <th width="10%">Marks</th>
                    <th width="20%">Action</th>
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
                            <td><a href="?mcq=<?php echo $result['id']?>" style="text-decoration: none;color:#ffff40">Delete</a></td>
                        </tr>
                    <?php } }?>

            </table>
        </div>

        <h1>Your Past Written Score</h1>
        <div class="profile">
            <?php if(isset($deldatawritten)){?>
            <h3>Written Score Succeessfully Deleted</h3>
    <?php }?>
            <table class="tblone">
                <tr>
                    <th>No</th>
                    <th width="20%">Reg No</th>
                    <th width="40%">Name</th>
                    <th width="10%">Marks</th>
                    <th width="20%">Action</th>
                </tr>
                <?php

                $scoredata = $usr->getPersonalWrittenScore($userId);
                if($scoredata){
                    $i=0;
                    while($result = $scoredata->fetch_assoc())
                    {
                        $i++;
                        ?>
                        <tr>

                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['reg']; ?></td>
                            <td><?php echo $result['username']; ?></td>
                            <td><?php echo $result['marks']; ?></td>
                            <td><a href="?written=<?php echo $result['id']?>" style="text-decoration: none;color:#ffff40">Delete</a></td>
                        </tr>
                    <?php } }?>

            </table>
        </div>

    </div>
<?php include 'inc/footer.php'; ?>