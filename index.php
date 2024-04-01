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
    <style>
        body {
            margin-top: 250px;
            text-align: center;
            margin-bottom: 0px;
            font-size: 25px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            text-align: center;
            background-color: #4F4A45;
            color: #F6F1EE;
            font-size: 35px;
            display: inline-block;
            text-decoration: none;
            border: 10px solid #4F4A45;
            border-radius: 15px 15px 15px 15px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
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

        <!-- logged in user information -->
        <?php if (isset($_SESSION['username'])) : ?>
            <p class="body"> ยินดีต้อนรับ <strong><?php echo $_SESSION['username']; ?></strong></p>
            <a href = "rentreturn.php" class="button">ต้องการยืม-คืน</a>
            <!-- <p><a href = "rentreturn.php" class="btn" style = "color: #F6F1EE; font-size: 40px; margin: 50px; text-decoration: none;">ต้องการยืม-คืน</a></p> -->
            <p><a href = "index.php?logout='1'" style = "color: orange; ">Log out</a></p>
        <?php endif ?>
    </div>

</body>
</html>