<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<title>Result Page</title>
<meta charset="UTF-8">
</head>
<body>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebus";
 
// 創建連結
$conn = mysqli_connect($servername, $username, $password, $dbname);
 
// 檢查連結狀況
if (mysqli_connect_errno($conn)) 
{ 
    echo "連接 MySQL 失敗: " . mysqli_connect_error(); 
}
else
{
    echo "連接成功<br>";
}


$asked_method = $_GET["asked_method"];
//echo "你選擇的交通方式為: ".$Picked_trans."<br>";

//$sql = "SELECT transportation, y2020, y2021, y2022, y2023, y2024 FROM oilprice WHERE transportation = "."'".$Picked_trans."'";

switch ($asked_method) {
    case 'search':
        if(!empty($_GET['vehicle_list'])) {
            echo "<table><tr><th>Model</th><th>manufacturer</th>";
            foreach ($_GET['info_list'] as $info) {
                echo "<th>" . $info . "</th>";
            }
            echo "</tr>";
            foreach($_GET['vehicle_list'] as $check) {
                $sql = "SELECT * FROM bus WHERE model = " . "'" . $check . "'";
                //echo $sql;
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                $output = "<tr><td>" . $row["model"] . "</td><td>" . $row["manufacturer"] . "</td>";
                foreach ($_GET['info_list'] as $info) {
                    if($info == "class"){
                        if($row[$info] == "000")
                            $output = $output . "<td>" . "甲類" . "</td>";
                        else
                            $output = $output . "<td>" . "乙類" . "</td>";
                    }
                    elseif($info == "battery_type"){
                        if($row[$info] == "0000")
                            $output = $output . "<td>" . "磷酸鋰鐵" . "</td>";
                        else
                            $output = $output . "<td>" . "鋰三元" . "</td>";
                    }
                    elseif ($info == "charge_method") {
                        if($row[$info] == "1")
                            $output = $output . "<td>" . "交流" . "</td>";
                        else
                            $output = $output . "<td>" . "直流" . "</td>";
                    }    
                    elseif($info == "charge_time"){
                        $output = $output . "<td>" . $row["charge_time_min"] . "~" . $row["charge_time_max"] . "</td>";
                    }

                    else{
                        $output = $output . "<td>" . $row[$info] . "</td>";
                    }
                }
                
                //$output = $output . "<td>" . $row["body_price"] . "</td>" . "<td>" . $row["battery_unit_price"] . "</td>" . "<td>" . $row["charge_station_price"] . "</td>";
                //$output = $output . "<td>" . $row["num_seat"] . "</td>" . "<td>" . $row["num_stand"] . "</td>" . "<td>" . $row["durability"] . "</td>";
                echo $output . "</tr>";

                //echo "<tr><td>" . $row["manufacturer"] . "</td><td>" . $row["model"] . "</td><td>" . $row["class"]. "</td></tr>";
            }
            echo "</table>";
        }
        else
            echo "Null Selection is not allowed! Please go back to the homepage.";
        break;

    case 'compare':
        # code...
        break;
    
    default:
            echo "Undefined Method! Please go back to the homepage.";
        break;
}


?>

</body>
</html>