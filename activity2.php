<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "expenses";

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
//     echo "success";
// }
// else{
    die("Error". mysqli_connect_error());
}
$insert = false; // Initialize insert variable
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'dbconnect.php';
    $exp= $_POST["category"];
    $amt = $_POST["amount"];
    $dt = $_POST["date"];
   

        $sql = "INSERT INTO `expenses` ( `exp`, `amt`, `dt`) VALUES ( '$exp', '$amt', '$dt')";
        $result = mysqli_query($conn, $sql);
       
       if($result) {
            $insert = true; // Set insert to true if data is successfully inserted
        } else {
            echo "Error: " . mysqli_error($conn);
        }
}   

/* DELETE FROM `expenses` WHERE `expenses`.`id` = 8*/
?>
<?php 
    if(isset($_GET['delete'])){
      echo  $_GET['delete'];
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense tracker</title>
    <style>
    body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
       
        
    .content {
            margin-left: 250px;
            padding: 20px;
        }
        .submit-btn {
    background-color: #f94b1b; 
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 8px;
}

.submit-btn:hover {
    background-color: #f74f1b; /* Darker green */
}
.container {
    background-color: #f0f0f0; 
    border: 1px solid #ccc; /* Gray border */
    padding: 20px; /* Add some padding inside the container */
    margin: 40px auto; /* Center the container horizontally */
    width: 300px; /* Set a fixed width (optional) */
   border-radius: 10px;
  }
  body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

.table-container {
  margin: 20px;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #f2f2f2;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.actions-column {
  width: 100px; /* Adjust width as needed */
}


    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
   
   
    <form  action="activity.php" method="post">
    <div class="container">
        Enter category:<br><input type="text" name="exp" placeholder="Enter category of Expenses"><br>
        Enter Amount:<br><input type="number" name="amt" placeholder="0.0"><br>
        Enter date:<br><input type="date" name="dt" ><br>
        <br><br>
        <button type="submit" class="submit-btn">Submit</button>
        
    </div>
   
    
 
<h2>Monthly Expenses</h2>

<div class="table-container">
  <table>
    <thead>
      <tr>
        <th>Serial No.</th>
        <th>Expense Category</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
       $sql="SELECT * FROM `expenses`";
        $result = mysqli_query($conn, $sql);
        $id=0;
        while($row=mysqli_fetch_assoc($result))
        { 
            ?>
           
            
           <td><?php echo $row['id'];?></td>
            <td><?php echo $row['exp'];?></td>
            <td><?php echo $row['dt'];?></td>
            <td><?php echo $row['amt'];?></td>
            <td>
            <a class="btn btn-success" href="update.php?id=<?php echo $row['id'];?>" role="button">Update</a>
            <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id'];?>" role="button">delete</a>
            </td>
            </tr>";
           
            <?php
        }
   ?>
      
      <!-- Add more rows as needed -->
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</form>
</body>
</html>