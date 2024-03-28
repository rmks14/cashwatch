<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "cashwatch";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}


$showAlert = false;
$showError = false;


if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $fname = $_POST["fname"];
    $femail = $_POST["femail"];
    $fpass = $_POST["fpass"];
    $cfpass = $_POST["cfpass"];
    $exists=false;
    if(($fpass == $cfpass) && $exists==false){
        $sql = "INSERT INTO `users` (`fname`, `femail`, `fpass`) VALUES  ('$fname', '$femail', '$fpass');";
        $result = mysqli_query($conn, $sql);
        if ($result){
            $showAlert = true;
        }
    }
    else{
        $showError = "Passwords do not match";
    }
}
    
?>
    
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense tracker</title>
    <link rel="stylesheet" href="style/register.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 
    <script>
    // Function to validate password fields
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("cpassword").value;

        // Regular expression for password validation
        var regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/;

        if (!regex.test(password)) {
            // Display error message if password does not meet the criteria
            document.getElementById("passwordError").innerHTML = "Password must contain at least one uppercase letter, one special character, and be at least 8 characters long";
            return false;
        } else if (password !== confirmPassword) {
            // Display error message if passwords do not match
            document.getElementById("passwordError").innerHTML = "Passwords do not match";
            return false;
        } else {
            // Clear error message if passwords match and meet the criteria
            document.getElementById("passwordError").innerHTML = "";
            return true;
        }
    }

    // Add event listener to the form submission to call the validatePassword function
    document.getElementById("registerform").addEventListener("submit", function(event) {
        if (!validatePassword()) {
            // Prevent form submission if passwords do not match or do not meet the criteria
            event.preventDefault();
        }
    });
</script>

    <style>
            img{
                width:63%;
                padding-left: 65px;
            }

            .box{
                display: flex;
                align-items: center;
                padding: 2% 18%;
            }
            .container {
                
                width: 350px;
                margin: 80px auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 20px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .formdesign {
                margin-bottom: 20px;
            }

            .inp i {
                position: absolute;
                right: 20px;
                top: 30%;
                transform: translateY(-5%);
                font-size: 23px;
            }

            .formdesign input[type="text"],
            .formdesign input[type="email"],
            .formdesign input[type="password"] {
                width: calc(100% - 20px); 
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 10px;
                box-sizing: border-box;
                transition: all 0.3s ease;
            }

            .button {
                width: calc(100% - 20px); 
                padding: 12px;
                border: none;
                border-radius: 10px;
                background-color: #007bff;
                color: #fff;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .button:hover {
                background-color: #0056b3;
            }

            #description {
                text-align: center;
                color:#666;
            }

            #description a {
                color: #007bff;
                text-decoration: none;
                transition: all 0.3s ease
                
            }

            #description a:hover {
                text-decoration: underline;
                color: #0056b3;
            }

            body{
                background-color: #fff;
            }

            .formerror{
                color:red;
            }

    </style>
</head>
<body><?php
include 'nav.php';
?>
<?php
    if($showAlert){
    echo ' <div class="alert alert-success" role="alert">
    Your account is successfully created
  </div>';
    }
    if($showError){
    echo ' <div class="alert alert-danger" role="alert">
    Failed to register!
  </div> ';
    }
    ?>
    <div class="box">
    <img src="lp.png">
    
    <div class="container">
    
        
        <form id="reisterform" action="register.php" method="post">
            <h1>Register here</h1>
            <div class="formdesign" id="name">
                Name:<br> <i class='bx bxs-user' ></i><input type="text" name="fname" placeholder="Enter your name" required><b><span class="formerror"></span></b>
                
            </div>
            <div class="formdesign" id="email">
                Email:<br><i class='bx bxl-gmail'></i> <input type="email" name="femail" placeholder="Enter Valid EMAIL" required><b><span class="formerror"></span></b>
                
            </div>
            <div class="formdesign" id="password">
                Password: <br><i class='bx bxs-lock-alt' ></i><input type="password" name="fpass" placeholder="Enter password" required><b><span class="formerror"></span></b>
                
            </div>
            <div class="formdesign" id="cpassword">
                Repeat Password:<br> <i class='bx bxs-lock-alt' ></i><input type="password" name="cfpass" placeholder="Confirm password" required><b><span class="formerror"></span></b>
                
            </div>
            <br>
            <input class="button" type="submit" value="Register">
            <p id="description">Already have an account? <a href="login.php">Login</a></p>
        

        </form>
        
    </div>
</div>
</body>
</html>
