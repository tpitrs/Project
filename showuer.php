<?php
    session_start();
    include('server.php');
    if (isset($_POST['rent_submit']))  {

        $username = $_POST['username'];
        $channel = $_POST['channel'];
        $date = $_POST['date'];
        $dateCreate = date('Y-m-d H:i:s');

        mysqli_query($conn, "BEGIN");
        $sqlshowuser = "INSERT INTO showuser (username, channel, date, dateCreate) VALUES('$username', '$channel', '$date', '$dateCreate')";
        $sqltime = $sql = "INSERT INTO showuser.time (timestamp_column) VALUES (CURRENT_TIMESTAMP)";
        $rsshowuser = mysqli_query($conn, $sqlshowuser);

        $sqlshowuser = "SELECT register.username FROM register
        JOIN forrent ON register.username = forrent.username WHERE forrent.status = 1 ";
        $result = $conn->query($sqlshowuser);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($result->num_rows > 0) {
            // แสดงข้อมูลทั้งหมดที่ดึงได้
            while($row = $result->fetch_assoc()) {
                echo "Username: " . $row["username"] . "<br>";
            }
        } else {
            echo "ไม่พบข้อมูลการยืมพาวเวอร์แบงค์";
        }
    }
?>