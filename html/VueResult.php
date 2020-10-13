<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ebus";

// 創建連結
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 檢查連結狀況
if (mysqli_connect_errno($conn)) {
    echo "連接 MySQL 失敗: " . mysqli_connect_error();
} else {
    //echo "連接成功<br>";
}

$asked_method = 'compare';
$vehicle_list = array();
$query_results = array();

switch ($asked_method) {
    case 'search':
        # code...
        break;

    case 'compare':
        if (!empty($_GET['compare_check'])) {
            $vehicle_list = $_GET['compare_check'];
        } else {
            echo "Null Selection is not allowed! Please go back to the homepage.";
            return;
        }
        foreach ($vehicle_list as $comp) {
            $sql = "SELECT * FROM bus WHERE model = " . "'" . $comp . "'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $query_results[$comp] = $row;
        }
        break;
    default:
        # code...
        break;
}
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Chartist CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <script src="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <!-- Chartist plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.js"></script>

    <link href="../css/VueResult.css" rel="stylesheet">
</head>

<body>
    <h3>補助後之車輛全生命週期成本 (12輛車隊為例)</h3>
    <div class="ct-chart" id="lifecycle_value"></div>
    <h3>年度累積成本現值</h3>
    <div class="ct-chart" id="yearly_acc_value"></div>

    <script type="text/javascript">
        //Assign php generated json to JavaScript variable
        var vehicle_list = <?php echo json_encode($vehicle_list); ?>;
        var query_results = <?php echo json_encode($query_results); ?>;

        var lifecycle_value_K9A = 118669552;
        var lifecycle_value_12m = 64997901;
        var lifecycle_value_KL5 = 53625966;
        var lifecycle_value_RAC = 67300427;
        var lifecycle_value_dis = 105852602;

        var yearly_acc_value_K9A = [10364900, 10287167, 10209670, 10136641, 10068923, 10003388, 9941785, 9884125];
        var yearly_acc_value_12m = [6063223, 5967311, 5874206, 5787372, 5707091, 5632171, 5562676, 5499165];
        var yearly_acc_value_KL5 = [4363232, 4332283, 4302973, 4281807, 4270322, 4263603, 4264634, 4273605];
        var yearly_acc_value_RAC = [6071566, 5979824, 5890823, 5808213, 5732825, 5661825, 5596866, 5538018];
        var yearly_acc_value_dis = [5442038, 5918545, 6399794, 6881699, 7371895, 7873330, 8379565, 8887774];

        var yearlySeries = [];
        var lifeSeries = [];

        vehicle_list.forEach(element => {
            if (element === "K9A") {
                lifeSeries.push(lifecycle_value_K9A);
                yearlySeries.push(yearly_acc_value_K9A);
            }
            if (element === "12米低地板") {
                lifeSeries.push(lifecycle_value_12m);
                yearlySeries.push(yearly_acc_value_12m);
            }
            if (element === "RAC-700") {
                lifeSeries.push(lifecycle_value_RAC);
                yearlySeries.push(yearly_acc_value_RAC);
            }
            if (element === "KL5850L") {
                lifeSeries.push(lifecycle_value_KL5);
                yearlySeries.push(yearly_acc_value_KL5);
            }
            if (element === "柴油") {
                lifeSeries.push(lifecycle_value_dis);
                yearlySeries.push(yearly_acc_value_dis);
            }
        });

        new Chartist.Bar('#lifecycle_value', {
            labels: vehicle_list,
            series: lifeSeries
        }, {
            chartPadding: {
                left: 40
            },
            distributeSeries: true,
            plugins: [
                Chartist.plugins.legend({
                    legendNames: vehicle_list,
                    clickable: false
                })
            ]
        });


        var chart = new Chartist.Line('#yearly_acc_value', {
            labels: ['2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026'],
            series: yearlySeries
        }, {
            fullWidth: true,
            height: '100%',
            chartPadding: {
                left: 40
            },
            plugins: [
                Chartist.plugins.legend({
                    legendNames: vehicle_list,
                })
            ]
        });
    </script>

    <script>
        var vehicle_list = <?php echo json_encode($vehicle_list); ?>;
        var query_results = <?php echo json_encode($query_results); ?>;
        function PV(rate, nper, pmt, fv = 0, type = 0) {
            rate = rate*0.01;
            return (-(pmt * (1 + rate * type) * ((Math.pow(1 + rate, nper) - 1) / rate) + fv)) / Math.pow(1 + rate, nper)
        }

        function LifeCycle(boughtYear, accountYear, yearlyMileage, energyPrice = 0, vehicleCount = 12) {


        }

        function AssetCost(vehicle, battery = 0, charger = 0, station = 0, vehicleCount = 12){
            return query_results[vehicle]["body_price"] + battery + charger/vehicleCount + station/vehicleCount  
        }

        function RunningCost(vehicel, yearlyMileage, accountYear, )

    </script>
</body>

</html>