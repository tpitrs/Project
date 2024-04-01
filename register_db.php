<?php 
    session_start();
    include('server.php');

    $errors = array();

    if (isset($_POST['reg_user'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $ident = mysqli_real_escape_string($conn, $_POST['ident']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);

        // รับค่ารหัสผ่านจากฟอร์ม
        $password_1 = $_POST['password_1'];
        // เข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($password_1, PASSWORD_DEFAULT);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // รับค่ารหัสผ่านจากฟอร์ม
            $passwordFromUser = $_POST['password_1'];
            // ฮาชรหัสผ่านจากฐานข้อมูล
            $hashedPasswordFromDatabase = "ฮาชรหัสผ่านจากฐานข้อมูล";
            // ตรวจสอบรหัสผ่าน
            if (password_verify($passwordFromUser, $hashedPasswordFromDatabase)) {
                // รหัสผ่านถูกต้อง
            } else {
                // รหัสผ่านไม่ถูกต้อง
            }
        }
        if (empty($name)) {
            array_push($errors, "name is required");
        }

        if (empty($ident)) {
            array_push($errors, "ident is required");            
        }

        if (empty($address)) {
            array_push($errors, "address is required");            
        }

        if (empty($phone)) {
            array_push($errors, "phone is required");            
        }

        if (empty($email)) {
            array_push($errors, "email is required");       
        }

        if (empty($username)) {
            array_push($errors, "username is required");            
        }

        if (empty($password_1)) {
            array_push($errors, "password is required");
        }

        if ($password_1 != $password_2) {
            array_push($errors, "password do not match");
        }

        $check_query = "SELECT * FROM register WHERE username = '$username' OR email = '$email'";
        $query = mysqli_query($conn, $check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) { //user exists
            if ($result['username'] === $username) {
                array_push($errors, "รหัสนักศึกษานี้ได้รับการลงทะเบียนแล้ว");
            }
            if ($result['email'] === $email) {
                array_push($errors, "อีเมลนี้ได้รับการลงทะเบียนแล้ว");
            }
        }

        if (count($errors) == 0) {
            $password = md5($password_1);

            $sql = "INSERT INTO register (name, ident, address, phone, email, username, password) VALUES ('$name','$ident','$address','$phone','$email','$username','$password')";
            mysqli_query($conn, $sql);

            $_SESSION['username'] = $username;
            $_SESSION['success'] = "เข้าสู่ระบบเรียบร้อย";
            header('location: index.php'); //ใส่ login.php เพื่อหลังยืนยันการสมัครจะเด้งไปหน้า login
        } else {
            array_push($errors, "มีข้อผิดพลาดโปรดตรวจสอบอีกครั้ง");
            $_SESSION['error'] = "มีข้อผิดพลาดโปรดตรวจสอบอีกครั้ง";
            header("location: register.php");
        }
    }
?>