<?php
session_start(); // Start session at the beginning of the script

// Check if user ID is set in the session
if (isset($_SESSION['u_id'])) {
    $u_id = $_SESSION['u_id'];
} else {
    // Handle the case where user ID is not set
    // For now, let's redirect the user to login
    header("location: login.php");
    exit;
}

// Check if user is logged in
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true){
    header("location: login.php");
    exit;
}

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

// Get daily and weekly expenses
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
       /* Your existing CSS styles */
   </style>
</head>
<body>
   
    <!-- Your existing HTML content -->

    <!-- Display daily and weekly expenses -->
    <div>
        <h3>Daily Expense: <?php echo $dailyExpense; ?></h3>
        <h3>Weekly Expense: <?php echo $weeklyExpense; ?></h3>
    </div>

</body>
</html>
