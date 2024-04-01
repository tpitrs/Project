<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in Page</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class = "header">
        <h2>Log in</h2>
    </div>

    <form action = "index.php" method="post">
    <?php if (isset($_SESSION['error'])) : ?>
            <div class="error">
                <h3>
                    <?php 
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <div class = "input-group">
            <label for = "username">รหัสนักศึกษา</label>
            <input type = "int" name = "username">
        </div>
        <div class = "input-group">
            <label for = "password">รหัสผ่าน</label>
            <input type = "password" name = "password">
        </div>
        <div class = "input-group">
            <button type = "submit" name = "login_user" class = "btn">Log in</button>
        </div> 
        <p>ยังไม่เป็นสมาชิก? <a href = "register.php">Sign Up</a></p> 
    </form>
</body>
</html>
