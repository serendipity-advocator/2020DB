<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "test";
$password = "test";
$dbname = "ebusproject";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
// 检测连接
if (mysqli_connect_errno($conn)) 
{ 
    echo "连接 MySQL 失败: " . mysqli_connect_error(); 
}
else
{
    echo "連接成功<br>";
}


$Picked_trans = $_POST["transport_name"];
echo "你選擇的交通方式為: ".$Picked_trans."<br>";

$sql = "SELECT transportation, y2020, y2021, y2022, y2023, y2024 FROM oilprice WHERE transportation = "."'".$Picked_trans."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo "Transportaion method = ".$row["transportation"]."<br>";
for ($i=2020; $i < 2025; $i++) { 
    echo "year ".$i." : ".$row["y".$i]."<br>";
}
?>

</body>
</html>