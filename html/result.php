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
    //echo "連接成功<br>";
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
            $comp_option = array("body_price", "battery_price", "charge_station_price");
            foreach ($_GET["compare_check"] as $comp) {
                $sql = "SELECT * FROM bus WHERE model = " . "'" . $comp . "'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
                array_push($comp_name, $comp);
                foreach ($comp_option as $option) {
                    array_push($comp_value, $row[$option]);
                }
            }
            $comp_num = count($comp_name);
            $comp_count = count($comp_option);
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

.BarChart{
    display: flex;
    height: 300px;
    width: 70%;
    padding: 20px;
    margin: 10px;
    background-color: #ddd;
    justify-content: space-around;
    align-items: flex-end;
}

.myProgress {
  height: 100%;
  margin: 5px;
  flex: 1;
  display: flex;
  justify-content: bottom;
  align-items: bottom;
  background-color: #ddd;
}

.myBar {
  flex: 0 1 18%;
  background-color: #4CAF50;
  text-align: center;
  line-height: 30px;
  word-wrap: break-word;
  color: white;
}

/*#compare_main{
    display: none;
}*/
</style>
<title>Result Page</title>
<meta charset="UTF-8">
</head>
<body>
<div id="compare_main">
</div>
<!-- Layout Conference
<h2>車身價格</h2>
<div class = "BarChart">
    <div class="myBar" id = "Body_A"></div>
    <div class="myBar" id = "Body_B"></div>
    <div class="myBar" id = "Body_3"></div>
    <div class="myBar" id = "Body_4"></div>
    <div class="myBar" id = "Body_5"></div>
</div>
<h2>電池售價</h2>
<div class = "BarChart">
    <div class="myBar" id = "Batt_A"></div>
    <div class="myBar" id = "Batt_B"></div>
    <div class="myBar" id = "Batt_3"></div>
    <div class="myBar" id = "Batt_4"></div>
    <div class="myBar" id = "Batt_5"></div>
</div>
-->
<script>
    window.onload = Compare;
    function Compare(){
        var method = "<?php echo $asked_method; ?>";
        if(method == "compare"){
            document.getElementById("compare_main").style.display = "block";
            var compare_values = [];
            compare_values = <?php echo json_encode($comp_value); ?>;
            var compare_names = [];
            compare_names = <?php echo json_encode($comp_name); ?>;
            var compare_options = [];
            compare_options = <?php echo json_encode($comp_option); ?>;
            var compare_num, compare_count;

            compare_num = compare_names.length;
            compare_count = compare_options.length;

            var i,j;
            for(i = 0 ; i < compare_count; i++){
                var temp_head = "<h2>" + compare_options[i] + "</h2>" + "<div id='Chart" + i + "' class = 'BarChart'>";
                var temp_content = "";
                var values = [];
                for (j = 0; j < compare_num; j++) {
                    values.push({name: compare_names[j], value: compare_values[j+compare_num*i]});
                }
                values.sort(function (a, b) {
                    return a.value - b.value;
                });
                //values.reverse();
                for (j = 0; j < compare_num; j++) {
                    temp_content += "<div class='myBar' id = '" + compare_options[i] + j + "'>" + values[j].name + ":" + values[j].value + "</div>";
                }
                document.getElementById("compare_main").innerHTML += (temp_head + temp_content);
                var bars = document.getElementById("Chart"+i).children;
                for(j = 0; j < compare_num; j++){
                    var ratio = (values[j].value/values[compare_num-1].value) * 100;
                    if(ratio <= 0)
                        ratio = 8;
                    bars[j].style.height = ratio + "%";
                }
                values
            }

            /*var body_A = "<?php echo $comp_value[0]; ?>", body_B = "<?php echo $comp_value[2]; ?>";
            var batt_A = "<?php echo $comp_value[1]; ?>", batt_B = "<?php echo $comp_value[3]; ?>";
            if(body_A > body_B){
                document.getElementById("Body_A").style.height = "100%";
                document.getElementById("Body_A").innerText = "<?php echo $comp_name[0]; ?>" + ':' + body_A;
                var ratio = body_B/body_A * 100;
                document.getElementById("Body_B").style.height = ratio + "%";
                document.getElementById("Body_B").innerText = "<?php echo $comp_name[1]; ?>" + ':' + body_B;
            }
            else{
                document.getElementById("Body_A").style.height = "100%";
                document.getElementById("Body_A").innerText = "<?php echo $comp_name[1]; ?>" + ':' + body_B;
                var ratio = body_A/body_B * 100;
                document.getElementById("Body_B").style.height = ratio + "%";
                document.getElementById("Body_B").innerText = "<?php echo $comp_name[0]; ?>" + ':' + body_A;
            }
            if(batt_A > batt_B){
                document.getElementById("Batt_A").style.height = "100%";
                document.getElementById("Batt_A").innerText = "<?php echo $comp_name[0]; ?>" + ':' + batt_A;
                var ratio = batt_B/batt_A * 100;
                document.getElementById("Batt_B").style.height = ratio + "%";
                document.getElementById("Batt_B").innerText = "<?php echo $comp_name[1]; ?>" + ':' + batt_B;
            }
            else{
                document.getElementById("Batt_A").style.height = "100%";
                document.getElementById("Batt_A").innerText = "<?php echo $comp_name[1]; ?>" + ':' + batt_B;
                var ratio = batt_A/batt_B * 100;
                document.getElementById("Batt_B").style.height = ratio + "%";
                document.getElementById("Batt_B").innerText = "<?php echo $comp_name[0]; ?>" + ':' + batt_A;
            }*/
        }
        else{
            document.getElementById("compare_main").style.display = "none";
        }
    }

</script>

</body>
</html>