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
        $id=$_GET['id'];
        $sql = "SELECT * FROM `expenses` WHERE `id`='$id'";
        $result = mysqli_query($conn, $sql);
       
       if(!$result) {
           die("query failed".mysqli_error());
        } else {
           $row=mysqli_fetch_assoc($result);
        }
    }

    if(isset($_POST['update-btn'])){
        $category=$_POST['category'];
        $amount=$_POST['amount'];
        $description=$_POST['description'];
        $date=$_POST['date'];

        $sql = "UPDATE `expenses` 
        SET `category` = '$category', 
            `amount` = '$amount', 
            `description` = '$description', 
            `date` = '$date' 
        WHERE `id` = '$id';";

        $result = mysqli_query($conn, $sql);
   
        if(!$result) {
            die("query failed".mysqli_error());
        } 
        else{
            header('location:activity.php?update_msg=you have successfully updated');
            exit; // It's a good practice to exit after a header redirect to prevent further execution.
        }
    }
?>
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
</style>

<form action="activity.php" method="post">
<div class="container">
    <label for="category">Select category of Expense:</label>
    <select id="expcat" name="category">
        <option value="Food" <?php if(isset($row['category']) && $row['category'] == 'Food') echo 'selected'; ?>>Food</option>
        <option value="Travel" <?php if(isset($row['category']) && $row['category'] == 'Travel') echo 'selected'; ?>>Travel</option>
        <option value="Travel" <?php if(isset($row['category']) && $row['category'] == 'Medical') echo 'selected'; ?>>medical</option>
        <option value="Travel" <?php if(isset($row['category']) && $row['category'] == 'Rent/eEMI') echo 'selected'; ?>>rent/EMI</option>
        <option value="Travel" <?php if(isset($row['category']) && $row['category'] == 'Other') echo 'selected'; ?>>Other</option>
        
    </select><br>
    Enter Amount:<br>
    <input type="number" name="amount" placeholder="0" 
           value="<?php echo isset($row['amount']) ? $row['amount'] : ''; ?>"><br>
    Enter date:<br>
    <input type="date" name="date" value="<?php echo isset($row['date']) ? $row['date'] : ''; ?>"><br>
    <br><br>
    <button type="submit" class="submit-btn" name="update-btn">Update</button>
</div>

</form>
