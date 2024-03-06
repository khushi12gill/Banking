<?php
include('navbar.php');

class BankAccount {
    private $balance;
    private $transactionHistory;

    public function __construct($initialBalance = 0) {
        $this->balance = $initialBalance;
        $this->transactionHistory = [];
    }

    public function deposit($amount) {
        $this->balance += $amount;
        $this->recordTransaction('Deposit', $amount);
        return true;
    }

    public function withdraw($amount) {
        if ($amount <= $this->balance) {
            $this->balance -= $amount;
            $this->recordTransaction('Withdrawal', $amount);
            return true;
        } else {
            echo "Insufficient funds. Cannot withdraw $amount.\n";
            return false;
        }
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getTransactionHistory() {
        return $this->transactionHistory;
    }

    private function recordTransaction($type, $amount) {
        $this->transactionHistory[] = [
            'type' => $type,
            'amount' => $amount,
            'balance' => $this->balance,
        ];
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "csd223khushpreet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
    $amount = isset($_POST['amount']) ? $_POST['amount'] : 0;

    if (isset($_POST['deposit'])) {
        $deposit = $amount;
        $withdraw = 0;
        $balance = $amount + getUserBalance($conn, $userId);
        $sql = "INSERT INTO `tbl_transaction`(`withdraw`, `deposit`, `balance`, `user_id`) VALUES ($withdraw, $deposit, $balance, $userId)";
    } elseif (isset($_POST['withdraw'])) {
        $deposit = 0;
        $withdraw = $amount;
        $currentBalance = getUserBalance($conn, $userId);
        if ($currentBalance >= $withdraw) {
            $balance = $currentBalance - $withdraw;
            $sql = "INSERT INTO `tbl_transaction`(`withdraw`, `deposit`, `balance`, `user_id`) VALUES ($withdraw, $deposit, $balance, $userId)";
        } else {
            echo "Error: Insufficient balance.";
        }
    }
    
    if ($conn->query($sql) === TRUE) {
        updateUserBalance($conn, $balance, $userId);
        echo "Transaction successful.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

function getUserBalance($conn, $userId) {
    $sql = "SELECT `balance` FROM `tbl_transaction` WHERE `user_id` = $userId";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["balance"];
    } else {
        return 0;
    }
}

function updateUserBalance($conn, $balance, $userId) {
    $sql = "UPDATE `tbl_transaction` SET `balance` = $balance WHERE `user_id` = $userId";
    $conn->query($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
    <style>
        body {background-color: #f2f2f2; margin: 0; font-family: Arial, sans-serif;}
        .navbar {
            overflow: hidden;
            background-color: #4CAF50; 
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #006400;
            color: black;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #add8e6; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 50px;
        }
        h1 {color: #333;}
        table {width: 100%; border-collapse: collapse; margin-top: 20px;}
        th, td {border: 1px solid #ddd; padding: 8px; text-align: left;}
        th {background-color: #4CAF50; color: white;}
    </style>
</head>
<body>

<div class="container">
    <h1>Deposit or Withdraw</h1>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="user_id">User ID:</label>
        <input type="number" name="user_id" required>
        <label for="amount">Amount:</label>
        <input type="number" name="amount" required>
        <button type="submit" name="deposit">Deposit</button>
        <button type="submit" name="withdraw">Withdraw</button>
    </form>