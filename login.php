<?php


$server = "localhost";
$username = "root";
$password = "";
$database = "cashwatch";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error: " . mysqli_connect_error());
}

$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $fname = $_POST["fname"];
    $fpass = $_POST["fpass"]; 
    
     
    $sql = "SELECT * FROM users WHERE fname='$fname' AND fpass='$fpass'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
        // Fetch the userID associated with the username
        $row = mysqli_fetch_assoc($result);
        $u_id = $row['u_id'];

        $login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        // Store userID instead of username in session
        $_SESSION['u_id'] = $u_id;
        header("location: activity.php");
        exit();

    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    
?>




<!DOCTYPE html>
    <html>
        <head>
            <title>LOGIN</title>
            <link type="text/css" rel="stylesheet" href="style/login.css">
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <style>body {
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f3f3f3;
}

.all {
    border: 2px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    background-color: white;
    width: 400px; /* Adjust the width as needed */
}

.container {
    text-align: center;
}

.login {
    margin-bottom: 20px;
}

.inp {
    position: relative;
    margin-bottom: 20px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    width: 100%;
    padding: 10px;
    border: none;
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

.txt {
    margin-top: 10px;
}

/* Responsive adjustments */
@media screen and (max-width: 600px) {
    .all {
        width: 90%;
    }
}
</style>

        </head>
        <body>
        
                

            <div class="all">
            
                
            <div class="container">
                <form action="login.php" method="post" ><div class="login">
                    <h1>LOGIN</h1>
                </div>



        
                <div class="box">
                    <div class="inp">
                        
                        <input type="text" placeholder="username" name="fname" required>
                        <i class='bx bxs-user' ></i>
                    </div>

                    <div class="inp">
                        
                        <input type="password" placeholder="password" name="fpass"  required>
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                      <button>Login</button>
                    
                    <div class="txt">
                        Don't have an account?
                        <a href="register.php">Register</a>
                    </div>
                        
                </div></form>
            </div>    
        </div>
        </body>
    </html>