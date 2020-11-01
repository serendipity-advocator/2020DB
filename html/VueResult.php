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
$condition_list = array();
$vehicle_list = array();
$query_results = array();
$station_price = 0;
$charger_price = 0;

switch ($asked_method) {
    case 'search':
        # code...
        break;

    case 'compare':
        if (!empty($_GET['compare_check'])) {
            $condition_list = $_GET['compare_condition'];
            $vehicle_list = $_GET['compare_check'];
        } else {
            echo "Null Selection is not allowed! Please go back to the homepage.";
            return;
        }
        if(!empty($_GET['station_price']))
            $station_price = $_GET['station_price'];
        if(!empty($_GET['charger_price']))
            $charger_price = $_GET['charger_price'];
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
$oil_results = array();
mysqli_select_db($conn, "ebusproject");


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

    <script>
        var condition_list = <?php echo json_encode($condition_list); ?>;
        var vehicle_list = <?php echo json_encode($vehicle_list); ?>;
        var query_results = <?php echo json_encode($query_results); ?>;

        function PV(rate, nper, pmt, fv = 0, type = 0) {
            rate = rate*0.01;
            return (-(pmt * (1 + rate * type) * ((Math.pow(1 + rate, nper) - 1) / rate) + fv)) / Math.pow(1 + rate, nper);
        }

        function AssetCost(vehicle, battery = 0, charger = 0, station = 0, vehicleCount = 12){
            console.log("AssetCost: " + (parseInt(query_results[vehicle]["body_price"]) + battery + charger/vehicleCount + station/vehicleCount));
            return parseInt(query_results[vehicle]["body_price"]) + battery + charger/vehicleCount + station/vehicleCount;
        }

        function RunningCost(vehicle, energyPrice = 2.02, yearlyMileage = 41667, accountYear = 8){
            energyUnitPrice = energyPrice;
            growthRate = 0.019;
            sum = 0;
            for (index = 0; index < accountYear; index++) {
                energyUnitPrice *= (1+growthRate);
                sum += (yearlyMileage*query_results[vehicle]["require_energy"]/100)*energyUnitPrice;
            }
            console.log("RunningCost: " + sum);
            return sum;
        }

        // Not yet implenmented
        function MaintenanceCost(accountYear = 8){
            console.log("MaintenanceCost: " + 17917*accountYear)
            return 17917*accountYear;
        }

        // Not yet complete
        function DiscountCost(accountYear = 8){
            discountRate = 2.5;
            boughtAllowance = 3209698;
            yearlyAllowance = 208335;
            yearlyInsurance = 10000;
            discount = PV(discountRate, accountYear, yearlyInsurance,type = 1) - PV(discountRate, accountYear, -yearlyAllowance) - boughtAllowance;
            console.log("DiscountCost: " + discount);
            return discount;
        }

        function LifeCycle(vehicle, boughtYear, battery = 0, charger = 0, station = 0, accountYear, yearlyMileage, energyPrice = 2.02, vehicleCount = 12) {
            console.log("accountYear: " + accountYear);
            console.log("yearlyMileage: " + yearlyMileage);
            life = AssetCost(vehicle,parseInt(battery),charger,station,vehicleCount) + 
            RunningCost(vehicle,energyPrice,yearlyMileage,accountYear) +
            MaintenanceCost(accountYear) +
            DiscountCost(accountYear);
            return life * vehicleCount;
        }

    </script>

    <script type="text/javascript">
        //Assign php generated json to JavaScript variable
        var condition_list = <?php echo json_encode($condition_list); ?>;
        var vehicle_list = <?php echo json_encode($vehicle_list); ?>;
        var query_results = <?php echo json_encode($query_results); ?>;
        var station_price = <?php echo json_encode($station_price); ?>;
        if (station_price == null)
            station_price = 0;
        var charger_price = <?php echo json_encode($charger_price); ?>;
        if (charger_price == null)
            charger_price = 0;
        

        //var lifecycle_value_K9A = 118669552;
        var lifecycle_value_dis = 106452602;

        var yearly_acc_value_K9A = [10364900, 10287167, 10209670, 10136641, 10068923, 10003388, 9941785, 9884125];
        var yearly_acc_value_12m = [6063223, 5967311, 5874206, 5787372, 5707091, 5632171, 5562676, 5499165];
        var yearly_acc_value_KL5 = [4363232, 4332283, 4302973, 4281807, 4270322, 4263603, 4264634, 4273605];
        var yearly_acc_value_RAC = [6071566, 5979824, 5890823, 5808213, 5732825, 5661825, 5596866, 5538018];
        var yearly_acc_value_dis = [5442038, 5918545, 6399794, 6881699, 7371895, 7873330, 8379565, 8887774];

        var yearlySeries = [];
        var lifeSeries = [];

        vehicle_list.forEach(element => {
            if (element === "K9A") {
                var lifecycle_value_K9A = LifeCycle("K9A", condition_list[0], query_results["K9A"]["battery_price"], charger_price, station_price, condition_list[1],condition_list[2]);
                lifeSeries.push(lifecycle_value_K9A);
                yearlySeries.push(yearly_acc_value_K9A);
            }
            if (element === "12米低地板") {
                var lifecycle_value_12m = LifeCycle("12米低地板", condition_list[0], query_results["12米低地板"]["battery_price"], charger_price, station_price, condition_list[1],condition_list[2]);
                lifeSeries.push(lifecycle_value_12m);
                yearlySeries.push(yearly_acc_value_12m);
            }
            if (element === "RAC-700") {
                var lifecycle_value_RAC = LifeCycle("RAC-700", condition_list[0], query_results["RAC-700"]["battery_price"], charger_price, station_price, condition_list[1],condition_list[2]);
                lifeSeries.push(lifecycle_value_RAC);
                yearlySeries.push(yearly_acc_value_RAC);
            }
            if (element === "KL5850L") {
                var lifecycle_value_KL5 = LifeCycle("KL5850L", condition_list[0], query_results["KL5850L"]["battery_price"], charger_price, station_price, condition_list[1],condition_list[2]);
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

    
</body>

</html>