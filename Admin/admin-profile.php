<?php
include "db.php";
include "auth-check.php";


if(!isset($_SESSION['admin'])){
header("Location: login.php");
exit();
}


$username = $_SESSION['admin'];


/* fetch admin data */

$query =
mysqli_query($conn,

"SELECT * FROM admin_users
WHERE username='$username'"

);

$admin =
mysqli_fetch_assoc($query);



/* update profile */

if(isset($_POST['update'])){

$new_username =
$_POST['username'];

$new_password =
$_POST['password'];



/* if password entered */

if(!empty($new_password)){

mysqli_query($conn,

"UPDATE admin_users
SET username='$new_username',
password='$new_password'
WHERE id='{$admin['id']}'"

);

}
else{

mysqli_query($conn,

"UPDATE admin_users
SET username='$new_username'
WHERE id='{$admin['id']}'"

);

}



/* update session */

$_SESSION['admin']=$new_username;



header("Location: admin-profile.php");

exit();

}

?>


<!DOCTYPE html>

<html>

<head>

<title>Admin Profile</title>

<link rel="stylesheet" href="admin-style.css">

</head>



<body>

<?php include "includes/sidebar.php"; ?>


<div class="main-content">

<h1>Admin Profile</h1>



<div class="profile-box">


<form method="POST" onsubmit="return confirmUpdate()">

<label>Username</label>

<input type="text"
name="username"
value="<?php echo $admin['username']; ?>"
required>

<label>New Password</label>

<input type="password"
name="password"
placeholder="Leave blank to keep same">

<button name="update">
Update Profile
</button>

</form>


</div>


</div>
<script>

function confirmUpdate(){

return confirm(
"Update profile details?\n\nThis will change your login credentials."
);

}

</script>

</body>

</html>