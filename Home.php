<!DOCTYPE html>
<html>
<head>
<style>
body {
  margin: 0;
  padding: 0;
  background-image: url('./bank.jpg');
  background-size: cover;
  background-repeat: no-repeat;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  color: white; 
}

.color-white {
  color: white;
}

.align-center {
  text-align: center;
}

.login-form {
  margin-top: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
}

label {
  margin: 5px 0;
}

input {
  padding: 8px;
  margin: 5px 0;
  font-size: 14px; 
}

.login-button {
  padding: 10px;
  margin-top: 10px;
  background-color: #4CAF50; 
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.login-button:hover {
  background-color: #45a049;
}

.sign-in-button {
  padding: 10px;
  margin-top: 10px;
  background-color: #4CAF50; 
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.sign-in-button:hover {
  background-color: #007BFF; /* Blue */
}

</style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="align-center">
    <h1 class="color-white">Welcome to KB</h1>
    <form class="login-form" action="login_process.php" method="post">
        <label for="username" class="color-white">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password" class="color-white">Password:</label>
        <input type="password" id="password" name="password" required>

        <a href="dashboard.php" class="login-button">Login</a>
        <a href="sign.php" class="sign-in-button">Sign In</a>
    </form>
</div>

</body>
</html>