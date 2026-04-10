<?php



session_start();


/* prevent cache */

header("Cache-Control: no-cache, no-store, must-revalidate");

header("Pragma: no-cache");

header("Expires: 0");



include "db.php";

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($conn,
"SELECT * FROM admin_users WHERE username='$username'");

$admin = mysqli_fetch_assoc($result);

if($admin && $password === $admin['password']){

$_SESSION['admin']=$username;

header("Location: dashboard.php");
exit();

}

else{

$error="Invalid Credentials";

}

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="login-container">
    <h2>Admin Login</h2>
    <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
</div>
</body>
</html>