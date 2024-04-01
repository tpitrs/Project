<?php 
    session_start();
    include('server.php');
    if (isset($_POST['return_submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        // $id_2nd = mysqli_real_escape_string($conn, $_POST['id_2nd']);
        // $status_2nd = mysqli_real_escape_string($conn, $_POST['status_2nd']);

        $check_user = $conn->prepare("SELECT * FROM register WHERE username = ? LIMIT 1");
        $check_user->bind_param("s", $username);
        $check_user->execute();
        $result = $check_user->get_result();
        $user_exists = $result->num_rows > 0;

        $status_update_st = null;
        $status_update_nd = null; 

        // SQL SELECT statement สำหรับช่องที่ 1
        $sql_ststatus = "SELECT status FROM forrent WHERE id = '1st'";
        $result_ststatus = mysqli_query($conn, $sql_ststatus);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result_ststatus) {
            $row_ststatus = mysqli_fetch_assoc($result_ststatus);
            $ststatus = $row_ststatus['status'];
        } else {
            $ststatus = 1;
        }
        // SQL SELECT statement สำหรับช่องที่ 2
        $sql_ndstatus = "SELECT status FROM forrent WHERE id = '2nd'";
        $result_ndstatus = mysqli_query($conn, $sql_ndstatus);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result_ndstatus) {
            $row_ndstatus = mysqli_fetch_assoc($result_ndstatus);
            $ndstatus = $row_ndstatus['status'];
        } else {
            $ndstatus = 1;
        }

        if ($user_exists) {
            // Assuming status_1st and status_2nd are integers in the database
            if ($id == '1st' && $ststatus == 1) {
                $status_update_st = $conn->prepare("UPDATE forrent SET status = '0' WHERE id = '1st'");
                $status_update_st->execute();
                echo "ดำเนินการคืนพาวเวอร์แบงค์สำเร็จ";
            } else if ($id == '2nd' && $ndstatus == 1) {
                $status_update_nd = $conn->prepare("UPDATE forrent SET status = '0' WHERE id = '2nd'");
                $status_update_nd->execute();
                echo "ดำเนินการคืนพาวเวอร์แบงค์สำเร็จ";
            } else {
                echo "ดำเนินการคืนไม่สำเร็จ กรุณาเลือกคืนพาวเวอร์แบงค์ช่องถัดไป";
            }
        } else {
            echo "ดำเนินการคืนไม่สำเร็จ เนื่องจากไม่พบรหัสนักศึกษานี้ในระบบ";
        }  
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ต้องการคืน</title>
    <link rel="stylesheet" href="stye.css">
    <style>
        body {
            padding: 50px;
            text-align: center;
            background-color: #F6F1EE;
        }
        .header {
            font-size: 40px;
            margin: 70px auto 0px;
            color: #4F4A45;
            background-color: #F6F1EE;
            text-align: center;
            
        }
        .ListProduct {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        .ListProduct .item {
            background-color: #ED7D31;
            border: 5px solid #F6F1EE;
            border-radius: 20px;
            align-items: center;
            padding: 20px;
        }
        .ListProduct .item h2 {
            font-weight: 500;
            font-size: large;
        }
        .ListProduct .item button {
            color: #F6F1EE;
            font-size: 25px;
            align-items: center;
            background-color: #4F4A45;
            padding: 10px;
            border-radius: 10px;
            margin-top: 13px;
            border: none;
            cursor: pointer;
        }
        .btn {
            width: 100%;
            padding: 10px;
            font-size: 20px;
            color: #F6F1EE;
            background: #4F4A45;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class = "header">
        <h2>ต้องการคืนพาวเวอร์แบงค์</h2>
    </div>
    <div class="ListProduct">
        <form method="post" action=""> <!-- ช่องที่ 1 -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="id" value="1st">
            <input type="hidden" name="status" value="<?php echo $ststatus; ?>">
            <div class="item">
                <!-- <img src="002.jpg" alt="">            -->
                <h1>ช่องที่ 1</h1>
                <button type="submit" name="return_submit" class="button">คืนช่องที่ 1</button>
            </div>
        </form>
        
        <form method="post" action=""> <!-- ช่องที่ 2 -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="id" value="2nd">
            <input type="hidden" name="status" value="<?php echo $ndstatus; ?>">
            <div class="item">
                <!-- <img src="002.jpg" alt="">            -->
                <h1>ช่องที่ 2</h1>
                <button type="submit" name="return_submit" class="button">คืนช่องที่ 2</button>
            </div>
        </form>
        <div class="btn">
            <a href="index.php" class="btn">กลับหน้าหลัก</a>
        </div>
    </div>
</body>
</html>