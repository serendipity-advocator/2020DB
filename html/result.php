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
        if(!empty($_GET['compare_check'])){
            $comp_name = array();
            $comp_value = array();
            foreach ($_GET["compare_check"] as $comp) {
                $sql = "SELECT * FROM bus WHERE model = " . "'" . $comp . "'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                array_push($comp_name, $comp);
                array_push($comp_value, $row["body_price"]);
                array_push($comp_value, $row["battery_price"]);
            }
        }
        else
            echo "Null Selection is not allowed! Please go back to the homepage.";
        break;
    
    default:
            echo "Undefined Method! Please go back to the homepage.";
        break;
}
?>

<!DOCTYPE html>
<html>
<head>
<style type="text/css">
table, th, td {
    border: 1px solid black;
}
.myProgress {
  width: 100%;
  background-color: #ddd;
}

.myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
  text-align: right;
  line-height: 30px;
  color: white;
}
</style>
<title>Result Page</title>
<meta charset="UTF-8">
</head>
<body onload = "Compare()">
<div id = "compare_main">
    <h2>Body Price</h2>
    <div class="myProgress">
        <div class="myBar" id = "Body_A"></div>
    </div>
    <br>
    <div class="myProgress">
        <div class="myBar" id = "Body_B"></div>
    </div>

    <h2>Battery Price</h2>
    <div class="myProgress">
        <div class="myBar" id = "Batt_A"></div>
    </div>
    <br>
    <div class="myProgress">
        <div class="myBar" id = "Batt_B"></div>
    </div>
</div>



<script>
    function Compare(){
        var method = "<?php echo $asked_method; ?>";
        //alert(method);
        if(method == "compare"){
            document.getElementById("compare_main").style.display = "block";
            var body_A = "<?php echo $comp_value[0]; ?>", body_B = "<?php echo $comp_value[2]; ?>";
            var batt_A = "<?php echo $comp_value[1]; ?>", batt_B = "<?php echo $comp_value[3]; ?>";
            if(body_A > body_B){
                document.getElementById("Body_A").style.width = "100%";
                document.getElementById("Body_A").innerHTML = "<?php echo $comp_name[0]; ?>" + ':' + body_A;
                var ratio = body_B/body_A * 100;
                document.getElementById("Body_B").style.width = ratio + "%";
                document.getElementById("Body_B").innerHTML = "<?php echo $comp_name[1]; ?>" + ':' + body_B;
            }
            else{
                document.getElementById("Body_A").style.width = "100%";
                document.getElementById("Body_A").innerHTML = "<?php echo $comp_name[1]; ?>" + ':' + body_B;
                var ratio = body_A/body_B * 100;
                document.getElementById("Body_B").style.width = ratio + "%";
                document.getElementById("Body_B").innerHTML = "<?php echo $comp_name[0]; ?>" + ':' + body_A;
            }
            if(batt_A > batt_B){
                document.getElementById("Batt_A").style.width = "100%";
                document.getElementById("Batt_A").innerHTML = "<?php echo $comp_name[0]; ?>" + ':' + batt_A;
                var ratio = batt_B/batt_A * 100;
                document.getElementById("Batt_B").style.width = ratio + "%";
                document.getElementById("Batt_B").innerHTML = "<?php echo $comp_name[1]; ?>" + ':' + batt_B;
            }
            else{
                document.getElementById("Batt_A").style.width = "100%";
                document.getElementById("Batt_A").innerHTML = "<?php echo $comp_name[1]; ?>" + ':' + batt_B;
                var ratio = batt_A/batt_B * 100;
                document.getElementById("Batt_B").style.width = ratio + "%";
                document.getElementById("Batt_B").innerHTML = "<?php echo $comp_name[0]; ?>" + ':' + batt_A;
            }
        }
        else{
            document.getElementById("compare_main").style.display = "none";
        }
    }
</script>

</body>
</html>