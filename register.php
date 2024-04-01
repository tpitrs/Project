<?php
session_start();
include('server.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="header">
        <h2>ลงทะเบียนสมัครสมาชิก</h2>
    </div>

    <form action="register_db.php" method="post">
        <?php include('errors.php'); ?>
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
        <div class="input-group">
            <label for="name">ชื่อ-นามสกุล</label>
            <input type="text" name="name">
        </div>
        <div class="input-group">
            <label for="ident">เลขบัตรประชาชน</label>
            <input type="text" name="ident">
        </div>
        <div class="input-group">
            <label for="address">ที่อยู่</label>
            <input type="text" name="address">
        </div>
        <div class="input-group">
            <label for="phone">เบอร์โทรศัพท์</label>
            <input type="tel" name="phone">
        </div>
        <div class="input-group">
            <label for="email">อีเมล</label>
            <input type="email" name="email">
        </div>
        <div class="input-group">
            <label for="username">รหัสนักศึกษา</label>
            <input type="number" name="username">
        </div>
        <div class="input-group">
            <label for="password_1">รหัสผ่าน</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label for="password_2">ยืนยันรหัสผ่าน</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <button type="submit" name="reg_user" class="btn">ยืนยัน</button>
        </div>
        <p>เป็นสมาชิกอยู่แล้ว ? <a href="login.php">เข้าสู่ระบบ</a></p>
    </form>
</body>

</html>