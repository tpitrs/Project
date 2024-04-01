<?php 
    session_start();
    include('server.php');
    if (isset($_POST['rent_submit'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // SQL SELECT statement สำหรับช่องที่ 1
        $sql_ststatus = "SELECT status FROM forrent WHERE id = '1st'";
        $result_ststatus = mysqli_query($conn, $sql_ststatus);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result_ststatus) {
            $row_ststatus = mysqli_fetch_assoc($result_ststatus);
            $ststatus = $row_ststatus['status'];
        } else {
            $ststatus = 0; // กำหนดเป็นค่าเริ่มต้น
        }
        
        $status_update_st = null;
        $status_update_nd = null; 

        // SQL SELECT statement สำหรับช่องที่ 2
        $sql_ndstatus = "SELECT status FROM forrent WHERE id = '2nd'";
        $result_ndstatus = mysqli_query($conn, $sql_ndstatus);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result_ndstatus) {
            $row_ndstatus = mysqli_fetch_assoc($result_ndstatus);
            $ndstatus = $row_ndstatus['status'];
        } else {
            $ndstatus = 0; // กำหนดค่าเริ่มต้น
        }

        $rent = "SELECT * FROM forrent ORDER BY id ASC";
        $result_1 = mysqli_query($conn, $rent); 

        if ($id == '1st' && $ststatus == 0) {
            // ยืมได้
            $status_update_st = "UPDATE forrent SET status = '1' WHERE id = '1st'";
            $stUpdate = mysqli_query($conn, $status_update_st);
            echo "ดำเนินการยืมสำเร็จ";
        } else if ($id == '2nd' && $ndstatus == 0) {
            // ยืมได้
            $status_update_nd = "UPDATE forrent SET status = '1' WHERE id = '2nd'";
            $ndUpdate = mysqli_query($conn, $status_update_nd);
            echo "ดำเนินการยืมสำเร็จ";
        } else {
            // ยืมไม่ได้
            echo "ไม่สามารถยืมได้ในขณะนี้";
        }
        
        if ($status_update_st !== null) {
            $stUpdate = mysqli_query($conn, $status_update_st);
        }
        if ($status_update_nd !== null) {
            $ndUpdate = mysqli_query($conn, $status_update_nd);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แสดงรายการพาวเวอร์แบงค์</title>
    <link rel="stylesheet" href="stylecss">
    <style>
        body {
            background-color: #F6F1EE;
            text-align: center;
            font-size: 30px;
            padding: 40px;
        }
        .slot {
            font-size: large;
            margin-top: 20px;
            align-items: center;
            gap: 20px;
        }
        .ListProduct .item img {
            width: 100%;
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
        .ListProduct .item .detail {
            letter-spacing: 0px;
            font-size: medium ;
            margin-top: 6px;
        }
        .ListProduct .item button {
            color: #F6F1EE;
            font-size: 25px;
            background-color: #4F4A45;
            padding: 10px;
            border-radius: 10px;
            margin-top: 13px;
            border: none;
            cursor: pointer;
        }
        .img{
            border: 2px solid #F6F1EE;
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

    <div><h1 >รายการพาวเวอร์แบงค์</h1></div>
    <div class="ListProduct">
        <form method="post" action=""> <!-- ช่องที่ 1 -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="id" value="1st">
            <input type="hidden" name="status" value="<?php echo $ststatus; ?>">
            <div class="item">
            <h1 style="font-size: 40px;">ช่องที่ 1</h1>
                <img src="002.png" alt="" class="img">                         
                <div class="slot">เช่าพาวเวอร์แบงค์ช่องที่ 1</div>
                <button type="submit" name="rent_submit" class="button">เช่า</button>
            </div>
        </form>
        
        <form method="post" action=""> <!-- ช่องที่ 2 -->
            <input type="hidden" name="username" value="<?php echo $_SESSION['username']; ?>">
            <input type="hidden" name="id" value="2nd">
            <input type="hidden" name="status" value="<?php echo $ndstatus; ?>">
            <div class="item">
                <h1 style="font-size: 40px;">ช่องที่ 2</h1>
                <img src="002.png" alt="" class="img">                        
                <div class="slot">เช่าพาวเวอร์แบงค์ช่องที่ 2</div>
                <button type="submit" name="rent_submit" class="button">เช่า</button>
            </div>
        </form>
        <!-- <div><button type="submit" href="index.php" class="btn">กลับสู่หน้าหลัก</button></div>       -->
        <!-- <p><a href="index.php" class="btn">กลับสู่หน้าหลัก</a></p> -->
        <div class="btn">
            <a href="index.php" class="btn">กลับหน้าหลัก</a>
        </div>
    </div>


</body>
</html>