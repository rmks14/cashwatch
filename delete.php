<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "cashwatch";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $sql = "DELETE FROM `expenses` WHERE `id` = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_close($stmt);
        // Redirect to the activity page
        header("Location: activity.php");
        exit(); // Make sure to stop script execution after redirect
    } else {
        echo "Error deleting record: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
}
?>
