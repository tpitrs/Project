<?php 
    session_start();
    include('server.php');
    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "you must log in";
        header('location: login.php');

    }
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['username']);
        header('location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="style.css"></link>
</head>
<body>
    <div class = "header">
        <h2> Home Page</h2>
    </div>
    <div class = "content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="success">
                <h3>
                    <?php 
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class="container">
        <div class="row">
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-12 col-sm-11 col-md-7 devbanban" style="margin-top: 50px">
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="alert alert-warning" role="alert"></div>
                        <hr>
                            <div class="row" style="margin-bottom: 20px;">
                            <?php foreach ($result as $row) {
                            if ($row['status'] == 0) { //ว่าง
                                echo '<div class="col-2 col-md-2 col-sm-2" style ="margin: 5px;">';
                            echo '<a href="login.php?id='.$row["id"].'&act=booking"class="btn btn-success" target="_blank">'.$row['channel'].'</a></div>';
                            } else { //ถูกจอง
                                echo '<div class="col-2 col-md-2 col-sm-2" style="margin: 5px;">';
                                echo '<a href="#" class="btn btn-secondary disabled" target="_blank">'.$$row['channel'].'</a></div>';
                            }
                            } ?>
                            </div>
                        <p>*เขียว = ว่าง, เทา = ไม่ว่าง</p>
                    </div>
                </div>
            </div>
        </div>
            <?php include "footer.php"; ?>
        </div>
        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p> ยินดีต้อนรับ <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href = "index.php?logout='1'" style = "color: orange;">Log out</a></p>
        <?php endif ?>
    </div>

</body>
</html>