<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update User</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      width: 80%;
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      color: #333;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #333;
    }

    input {
      width: 100%;
      padding: 10px;
      margin-bottom: 16px;
      box-sizing: border-box;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    a {
      color: #3498db;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <?php
      $servername = "localhost";
      $username = "root";
      $dbpassword = "";
      $dbname = "csd223khushpreet";

      $conn = new mysqli($servername, $username, $dbpassword, $dbname);
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];

        $sql = "UPDATE tbl_user SET name='$name', email='$email' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
          echo "<h2>Record updated successfully.</h2>";
          echo "<a href='Profile.php'>Back to View</a>";
        } else {
          echo "<p>Error updating record: " . $conn->error . "</p>";
        }
      }

      $conn->close();
    ?>
  </div>

</body>
</html>