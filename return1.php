<?php 
    session_start();
    include('server.php');
    if (isset($_POST['return_submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $id_1st = mysqli_real_escape_string($conn, $_POST['id_1st']);
        $status_1st = mysqli_real_escape_string($conn, $_POST['status_1st']);
        $id_2nd = mysqli_real_escape_string($conn, $_POST['id_2nd']);
        $status_2nd = mysqli_real_escape_string($conn, $_POST['status_2nd']);

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

        $return = "SELECT * FROM forrent ORDER BY id ASC";
        $result_1 = mysqli_query($conn, $return); 

        if ($id == '1st' && $ststatus == 1) {
            $status_update_st = "UPDATE forrent SET status = '0' WHERE id = '1st' ";
            $stUpdate = mysqli_query($conn, $status_update_st);
            echo "ดำเนินการคืนพาวเวอร์แบงค์สำเร็จ";
        } else if ($id == '2nd' && $ndstatus == 1) {
            $status_update_nd = "UPDATE forrent SET status = '0' WHERE id = '2nd' ";
            $ndUpdate = mysqli_query($conn, $status_update_nd);
            echo "ดำเนินการคืนพาวเวอร์แบงค์สำเร็จ";
        } else {
            echo $user_exists ? "" : "ดำเนินการคืนไม่สำเร็จ เนื่องจากไม่พบรหัสนักศึกษานี้ในระบบ";
        }      
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ต้องการคืน</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            margin-top: 150px;
            padding: 50px;
        }
    </style>
</head>
<body>
    <div class = "header">
        <h2>ต้องการคืนพาวเวอร์แบงค์</h2>
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

        <input type="hidden" name="id" value="1st">
        <input type="hidden" name="status" value="<?php echo $ststatus; ?>">

        <input type="hidden" name="id" value="2nd">
        <input type="hidden" name="status" value="<?php echo $ndstatus; ?>">

        <div class = "input-group">
            <label for = "username">รหัสนักศึกษา</label>
            <input type = "number" name = "username">
        </div>
        <div class = "input-group">
            <button type = "submit" name="return_submit" class = "btn">ยืนยัน</button>
        </div> 
    </form>
</body>
</html>