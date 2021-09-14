<?php
$username = "root"; // Khai báo username
$password = "";      // Khai báo password
$server   = "localhost";   // Khai báo server
$dbname   = "myfirst_database";      // Khai báo database

// Kết nối database tintuc
$connect = new mysqli($server, $username, $password, $dbname);

//Nếu kết nối bị lỗi thì xuất báo lỗi và thoát.
if ($connect->connect_error) {
    die("Không kết nối :" . $conn->connect_error);
    exit();
}

//Khai báo giá trị ban đầu, nếu không có thì khi chưa submit câu lệnh insert sẽ báo lỗi
$title = "";
$date = "";
$description = "";
$content = "";
$rowcount ="";

//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["title"])) { $title = $_POST['title']; }
    if(isset($_POST["date"])) { $date = $_POST['date']; }
    if(isset($_POST["description"])) { $description = $_POST['description']; }
    if(isset($_POST["content"])) { $content = $_POST['content']; }
//lenh lay dem so lan cua description
$sql = "SELECT * FROM mytable_test WHERE id_name='$description'";
$results = mysqli_query($connect,$sql);
$rowcount = mysqli_num_rows($results);
echo $rowcount;
    //Code xử lý, insert dữ liệu vào table
    $sql = "INSERT INTO mytable_test (id_name, timeid, count_id)
    VALUES ('$description', '$date','$rowcount'+1)";

    if ($connect->query($sql) === TRUE) {
        echo "Thêm dữ liệu thành công";
    } else {
        echo "Error: " . $sql . "<br>" . $connect->error;
    }
}
//Đóng database
$connect->close();
?>

<form action="" method="post">
    <table>
        <tr>
            <th>Tiêu đề:</th>
            <td><input type="text" name="title" value=""></td>
        </tr>

        <tr>
            <th>Ngày tháng:</th>
            <td><input type="date" name="date" value=""></td>
        </tr>

        <tr>
            <th>Mô tả:</th>
            <td><input type="text" name="description" value=""></td>
        </tr>

        <tr>
            <th>Nội dung:</th>
            <td><textarea cols="30" rows="7" name="content"></textarea></td>
        </tr>
    </table>
    <button type="submit">Gửi</button>
</form>