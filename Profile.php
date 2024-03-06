<!DOCTYPE html>
<html>
<head>
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  text-align: center;
}

#customers {
  border-collapse: collapse;
  width: 50%;
  margin: auto;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

.form-container {
  margin-top: 20px;
  text-align: center;
}
</style>
</head>
<body>
<br>
<br>


<h1>User Detail</h1>

<form method="post" action="" class="form-container">
  <label for="userid">Enter User ID:</label>
  <input type="text" id="userid" name="userid" required>
  <input type="submit" value="Get User Details">
</form>
<br>
<br>

<?php include('navbar.php'); ?>

<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223khushpreet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $userid = $_POST["userid"];

  $sql = "SELECT * FROM tbl_user WHERE id = $userid";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // Display user details
    $row = $result->fetch_assoc();
    ?>
    <table id="customers">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Account</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <tr>
        <td><?php echo $row["id"] ?></td>
        <td><?php echo $row["name"] ?></td>
        <td><?php echo $row["account"] ?></td>
        <td><?php echo $row["email"] ?></td>
        <td><?php echo $row["contact"] ?></td>
        <td><a href="update.php"><button>Update</button></a></td>
        <td><a href="delete.php?id=<?php echo $row["id"] ?>"><button>Delete</button></a></td>
      </tr>
    </table>
    <?php
  } else {
    echo "User with ID $userid not found.";
  }
}

$conn->close();


?>

</body>
</html>
