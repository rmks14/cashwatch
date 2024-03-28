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

$insert = false; // Initialize insert variable

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $category = $_POST["category"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    
    
    // Insert data into database
    $sql = "INSERT INTO `expenses` (`u_id`, `category`, `amount`, `date`) VALUES ('$u_id', '$category', '$amount',  '$date')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $insert = true; // Set insert to true if data is successfully inserted
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Output any delete parameter if set
if(isset($_GET['delete'])){
    echo $_GET['delete'];
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
           background-color: #1d1e1f; /* Set background color of the body */
           color: white; /* Set text color */
           margin: 0; /* Reset margin */
           padding: 0; /* Reset padding */
       }

       .container {
    background-color: #424447; /* Set background color of the form container */
    padding: 20px; /* Add padding for better spacing */
    border-radius: 20px; /* Add border-radius for rounded corners */
    margin: 50px auto 0; /* Center the container and add margin from the top */
    width: 90%; /* Set width of the container */
    max-width: 500px; /* Set maximum width of the container */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box shadow for depth */
}

.container label {
    display: block; /* Make labels display block to stack them */
    margin-bottom: 5px; /* Add margin below labels for spacing */
    color: #fff; /* Set label text color */
    border-radius: 10px;
}

.container input[type="text"],
.container input[type="number"],
.container input[type="date"],
.container select {
    width: calc(100% - 20px); /* Set input width to fill the container minus padding */
    padding: 10px; /* Add padding for better spacing */
    margin-bottom: 15px; /* Add margin between inputs */
    border: none; /* Remove default input border */
    border-radius: 10px; /* Add border-radius for rounded corners */
    background-color: #dcdde1; /* Set background color of input fields */
    color: #333; /* Set text color */
    box-sizing: border-box; /* Include padding and border in element's total width and height */
}

.container select {
    width: 100%; /* Set select width to fill the container */
    border-radius: 10px;
}

.container button[type="submit"] {
    width: 100%; /* Set button width to fill the container */
    padding: 12px; /* Add padding for better spacing */
    background-color: #4CAF50; /* Set background color of the submit button */
    color: white; /* Set text color */
    border: none; /* Remove border */
    border-radius: 10px; /* Add border-radius for rounded corners */
    cursor: pointer; /* Change cursor on hover */
    transition: background-color 0.3s; /* Add transition effect */
}

.container button[type="submit"]:hover {
    background-color: #45a049; /* Darken background color on hover */
}


       .table-container {
           margin-top: 20px; /* Add margin to separate table from the form */
           border-radius:10px;
       }

       table {
           width: 100%;
           border-collapse: collapse; /* Collapse borders to avoid double borders */
           border: 1px solid white; /* Add border to the table */
       }

       th, td {
           border: 1px solid white; /* Add border to table cells */
           padding: 8px; /* Add padding for better spacing */
           text-align: left; /* Align text to the left */
       }

       th {
           background-color: #1d1e1f; /* Set background color of table headers */
       }

       tbody tr:nth-child(odd) {
           background-color: #1d1e1f; /* Set background color of odd rows */
       }

       tbody tr:nth-child(even) {
           background-color: #333; /* Set background color of even rows */
       }

       .btn {
           padding: 6px 12px; /* Adjust button padding */
           margin-right: 5px; /* Add margin between buttons */
           text-decoration: none; /* Remove default button underline */
       }

       .btn-success {
           background-color: green; /* Set background color of success buttons */
       }

       .btn-danger {
           background-color: red; /* Set background color of danger buttons */
       }

       .btn-success, .btn-danger {
           border: none; /* Remove button borders */
           color: white; /* Set button text color */
       }
   </style>
</head>
<body><?php
include 'nav.php';
?>
   
    <form action="activity.php" method="post">
        <div class="container">
            <label for="category">Select category of Expense:</label><br><br>
            <select id="expcat" name="category">
                <option value="Food">Food</option>
                <option value="Travel">Travel</option>
                <option value="Medical">Medical</option>
                <option value="Rent/EMI">Rent/EMI</option>
                <option value="Groceries/Clothing">Groceries/Clothing</option>
                <option value="Bills">Bills</option>
                <option value="Other">Other</option>
            </select><br><br>
            <input type="hidden" name="u_id" value="<?php echo $u_id; ?>"> <!-- Hidden input to store user ID -->
           
            Enter Amount:<br><input type="number" name="amount" placeholder="0.0" required><br><br>
            Enter date:<br><input type="date" name="date" required><br>
            <br><br>
            <button type="submit" class="submit-btn">Submit</button>
        </div>
    </form>

    <!-- Monthly Expenses Table -->
    <h2>Your Expenses</h2>
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
                // Fetch and display expenses for the logged-in user
                $sql = "SELECT * FROM `expenses` WHERE `u_id` = '$u_id'";
                $result = mysqli_query($conn, $sql);
                $id = 0;
                while($row = mysqli_fetch_assoc($result)) { 
                ?>
                <tr>
                    <td><?php echo ++$id; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo $row['date']; ?></td>
                    <td><?php echo $row['amount']; ?></td>
                    
                    <td>
                        <a class="btn btn-success" href="update.php?id=<?php echo $row['id']; ?>" role="button">Update</a>
                        <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>" role="button">Delete</a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <a class="btn btn-success" href="stats.php" role="button">Stats</a>
    <a class="btn btn-success" href="stats2.php" role="button">Stats</a>
    <a class="btn btn-success" href="f.php" role="button">profile</a>
    <!-- Your JavaScript libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
