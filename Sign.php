<!DOCTYPE HTML>  
<html>
<head>
<style>
        .error {color: #FF0000;}
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        form {
            margin: 0 auto;
            width: 300px;
        }

        form input,
        form textarea,
        form select {
            display: block;
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        form select {
            height: 40px;
        }

        form .error {
            color: red;
            font-size: 12px;
            margin-bottom: 5px;
        }

        form input[type=submit] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        form input[type=submit]:hover {
            background-color: #45a049;
        }

        .success-message {
            color: #008000;
            margin-top: 10px;
        }
</style>
</head>
<body>  
<?php include('navbar.php'); ?>
<?php
// define variables and set to empty values
$nameErr = $accountErr = $passwordErr = $cpasswordErr = $emailErr = $addressErr = $contactErr = "";
$name = $account = $password = $cpassword = $email = $address = $contact = "";

$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
        $valid = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
            $valid = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        $valid = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
    }

    if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $valid = false;
    } else {
        $password = test_input($_POST["password"]);
        // check if e-mail address is well-formed

        if (strlen($password) < 6) {
            $passwordErr = "Please enter at least six characters password";
            $valid = false;
        }
    }

    if (empty($_POST["cpassword"])) {
        $cpasswordErr = "Confirm Password is required";
        $valid = false;
    } else {
        $cpassword = test_input($_POST["cpassword"]);

        if ($cpassword != $password) {
            $cpasswordErr = "Password and Confirm Password Need to be same";
            $valid = false;
        }
    }

    if (empty($_POST["address"])) {
        $addressErr = "Address is required";
        $valid = false;
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["account"])) {
        $accountErr = "Account is required";
        $valid = false;
    } else {
        $account = test_input($_POST["account"]);
    }

    if (empty($_POST["contact"])) {
        $contactErr = "Contact number is required";
        $valid = false;
    } else {
        $contact = test_input($_POST["contact"]);
        // You may add additional validation for contact number if needed
    }

    if ($valid) {

        $servername = "localhost";
        $username = "root";
        $db_password = "";
        $dbname = "csd223khushpreet";

        // Create connection
        $conn = new mysqli($servername, $username, $db_password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO `tbl_user`( `name`, `account`, `password`, `email`, `address`, `contact`) VALUES ('" . $name . "','" . $account . "','" . $password . "','" . $email . "','" . $address . "','" . $contact . "')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<h2>Add User Details</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Name: <input type="text" name="name" value="<?php echo $name; ?>">
    <span class="error">* <?php echo $nameErr; ?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email; ?>">
    <span class="error">* <?php echo $emailErr; ?></span>
    <br><br>

    Password: <input type="password" name="password" value="<?php echo $password; ?>">
    <span class="error">* <?php echo $passwordErr; ?></span>
    <br><br>

    Confirm Password: <input type="password" name="cpassword" value="<?php echo $cpassword; ?>">
    <span class="error">* <?php echo $cpasswordErr; ?></span>
    <br><br>

    Address: <textarea name="address" rows="5" cols="40"><?php echo $address; ?></textarea>
    <span class="error">* <?php echo $addressErr; ?></span>
    <br><br>

    Account: <input type="text" name="account" value="<?php echo $account; ?>">
    <span class="error">* <?php echo $accountErr; ?></span>
    <br><br>

    Contact Number: <input type="text" name="contact" value="<?php echo $contact; ?>">
    <span class="error">* <?php echo $contactErr; ?></span>
    <br><br>

    <input type="submit" name="submit" value="Submit">
</form>
</body>
</html>


