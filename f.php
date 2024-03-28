<?php
session_start(); // Start the session at the beginning of the PHP script

$server = "localhost";
$username = "root";
$password = "";
$database = "cashwatch";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error: " . mysqli_connect_error());
}

$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $fname = $_POST["fname"];
    $email = $_POST["femail"];
    $fpass = $_POST["fpass"];

    
     
    $sql = "SELECT fname, fpass, femail FROM users WHERE fname='$fname' AND fpass='$fpass' AND femail='$email'";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1){
      // Fetch the userID associated with the username
      $row = mysqli_fetch_assoc($result);
      $u_id = $row['u_id'];
  
      // Set $_SESSION['loggedin'] to true
      $_SESSION['loggedin'] = true;
  
      // Store userID instead of username in session
      $_SESSION['u_id'] = $u_id;
  
      // Redirect to activity.php
      header("location: activity.php");
      exit; 
    } else {
      $showError = "Invalid Credentials";
    }
}
?>


<!DOCTYPE html>
<hmtl>
	<head>
    	<link rel="stylesheet" href="f.css">
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title></title>
		<script>
			function rtn(){
				window.location.href="file:///C:/Users/Shreyas/Documents/html/registration.html";
			}
		</script>
		<style>.container1{
  text-align: center;
	margin-top: 30px;
	margin-left: 30%;
  background-color: #1d1e1f;
  padding-top: 10px;
  padding-bottom: 10px;
  margin-right: 20px;
  width: 40%;
  border-radius: 10px;
    
    
}


.contaniner4 button{
	background-color:#1d1e1f;
	width: 99%;
  text-align: left;
	color: #ffff;
	margin: 1px;	
	box-shadow: none;
	cursor: pointer;
	font-size:17px;
  padding: 1.5%;
  text-decoration: none;
  border: 0;
  border-radius: 20px;
}

.button:hover {
	background-color: #46494b;
    
  }

.container2{
  text-align: center;
  margin-top: 20px;
  margin-left: 30%;
  background-color: #1d1e1f;
  padding-top: 10px;
  padding-bottom: 10px;
  margin-right: 20px;
  width: 40%;
  border-radius: 10px;

}

  
.img1{
  float: right;
  width: 25px;
  height: 20px;
  }

  .txt{
  color: white;
  text-align: left;
  margin-left: 11px;
  }

  body{
  font-family: sans-serif;
  background-color: rgb(5,5,5);
  }


   img{
    float: left;
    width: 25px;
    height: 25px;
    margin-right: 10px;
  }

  .b1 h2{
    padding-left: 170px;
    padding-top: 120px;
    
  }

  .B1{
    display: block;
    
    padding-left: 200px;
    width: 100px;
    height: 100px;
    
  }

  .b1{
    margin-left: 568px;
    color:white;
    background-color: #46494b; 
    width: 26.8%;
    height: 240px;
    border-radius: 10px;
  }

  .container3{
    display: inline-flex;
    width: 100%;
    margin-top: 40px;
  }


  .B2{
    width: 200px;
    height: 200px;
    
    
  }

  .b2 h2{
    color: white;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 100px;
	width:100%;
    
  }



.container1 a{
  text-decoration: none;
  color: white;
}


.container5{
  text-align: center;
  margin-top: 20px;
  margin-left: 30%;
  background-color: #1d1e1f;
  padding-top: 10px;
  padding-bottom: 10px;
  margin-right: 20px;
  width: 40%;
  border-radius: 10px;

}</style>
	</head>
	<body>
		<div class="box">	
			<div class="container3">
				<div class="b1">
					<img class="B1" src="logo-no-background.png">
					<h2>CASH WATCH</h2>					
				</div>
				
			</div>
			
			<div class="contaniner4">
      
    <div class="container1">
        <h3 class="txt">ACCOUNT</h3>
        <?php if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']) { ?>
            <button class="button" role="button"> <img class="img2" src="person.png"><a href="manage_profile.php">Manage Profile</a><img class="img1" src="icons8-double-right-24.png" ></button>
            <button class="button" role="button"><img src="man.png"><a href="edit_profile.php">Edit Profile</a><img class="img1" src="icons8-double-right-24.png" width="40px" height="40px"></button>
            <button class="button" role="button"><img src="password.png"><a href="edit_password.php"> Edit Password</a> <img class="img1" src="icons8-double-right-24.png" width="40px" height="40px"></button>
        <?php } 
        else { ?>
            <p>Please login to access your account.</p>
        <?php } ?>    	
    </div>
</div>

</div>
				
				<div class="container5">
					<h3 class="txt"></h3>
					<button class="button" role="button"><img src="connect wit friends.png"> Connect with others<img class="img1" src="icons8-double-right-24.png" width="40px" height="40px"></button>
					<button class="button" role="button">Connect our social media<img class="img1" src="icons8-double-right-24.png" width="40px" height="40px"></button>
					<button class="button" role="button"><img src="contact us2.png"> Contact us<img class="img1" src="icons8-double-right-24.png" width="40px" height="40px"></button>
					<button class="button" role="button" type="submit" onclick="rtn()"><img src="sign out.png"> Signout from here<img class="img1" src="icons8-double-right-24.png" width="40px" height="40px"></button>     
				</div>
			</div>
		</div>
	</body>
</html>


