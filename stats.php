<?php
session_start(); // Start session at the beginning of the script

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}

$server = "localhost";
$username = "root";
$password = "";
$database = "cashwatch";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error: " . mysqli_connect_error());
}

// Fetching data from the database
$u_id = $_SESSION['u_id']; // Retrieve user ID from session
$sql_expenses = "SELECT category, SUM(amount) AS total_exp FROM expenses WHERE u_id = '$u_id' GROUP BY category";

$result_expenses = mysqli_query($conn, $sql_expenses);

// Generating data for the chart
$data = array();
while ($row = mysqli_fetch_assoc($result_expenses)) {
    $data[] = array($row['category'], (float)$row['total_exp']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expenses by Category</title>
   
    <!-- Include the Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Google Charts library
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        // Function to draw the pie chart
        function drawChart() {
            // Create the data table
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Category of Expense');
            data.addColumn('number', 'Amount');
            data.addRows(<?php echo json_encode($data); ?>); // Add data to the chart

            // Set chart options
            var options = {
                title: 'Expenses by Category',
                width: 900,
                height: 500,
                is3D: true,
                sliceVisibilityThreshold: 0.02,
                chartArea: {width: '90%', height: '80%'},
                legend: {position: 'right', alignment: 'center'},
                pieSliceText: 'value',
                pieStartAngle: 90,
                backgroundColor: '#f1f8e9',
                slices: {
                    0: {color: '#f44336'},
                    1: {color: '#2196f3'},
                    2: {color: '#4caf50'}
                }
            };

            // Instantiate and draw the chart
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <?php include 'nav.php'; ?>
    
    <!-- Display the pie chart -->
    <div id="piechart"></div>
</body>
</html>


<?php



// Establish database connection
$server = "localhost";
$username = "root";
$password = "";
$database = "cashwatch";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error: " . mysqli_connect_error());
}

// Function to get daily and weekly expenses
function getExpenses($conn, $u_id, $interval) {
    $sql = "SELECT SUM(amount) as total FROM `expenses` WHERE `u_id` = '$u_id' AND `date` >= CURDATE() - INTERVAL $interval DAY";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}


$dailyExpense = getExpenses($conn, $u_id, 1);
$weeklyExpense = getExpenses($conn, $u_id, 7);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense tracker</title>
   
   <style>
      .statstable{
        
           margin-top: 20px;
           border-radius:30px;
       }

       table {
           width: 30%
           border-collapse: collapse; 
           border: 1px solid black; 
       }
       th, td {
           border: 1px solid black; 
           padding: 8px; 
           text-align: left; }

      
   </style>
</head>
<body>
   <div class="statstable">
    <table>
        <tr>
            <th>Daily Expense</th>
            <th>Weekly Expense</th>
        </tr>
        <td><?php echo $dailyExpense; ?></td>
        <td><?php echo $weeklyExpense; ?></td>
    </table>
    </div>

</body>
</html>
