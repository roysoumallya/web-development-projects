<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
include "db.php";

// Add new newsletter
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $rating = $_POST['rating'];

    // Handle image upload
    $image = '';
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);
    }

    mysqli_query($conn, "INSERT INTO newsletters(name,designation,title,message,rating,image,status) VALUES('$name','$designation','$title','$message','$rating','$image','active')");
    header("Location: newsletters.php");
    exit();
}

// Update newsletter
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $title = $_POST['title'];
    $message = $_POST['message'];
    $rating = $_POST['rating'];

    // Handle image if uploaded
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);
        mysqli_query($conn, "UPDATE newsletters SET name='$name', designation='$designation', title='$title', message='$message', rating='$rating', image='$image' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE newsletters SET name='$name', designation='$designation', title='$title', message='$message', rating='$rating' WHERE id=$id");
    }
    header("Location: newsletters.php");
    exit();
}

// Delete newsletter
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM newsletters WHERE id=$id");
    header("Location: newsletters.php");
    exit();
}

// Edit newsletter
$edit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM newsletters WHERE id=$id"));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Newsletters</title>
<link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="newsletters.php" class="active">Newsletters</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="works.php">Works</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
<h1><?php echo $edit ? "Edit" : "Add"; ?> Newsletter</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $edit['id'] ?? ''; ?>">

    <input type="text" name="name" placeholder="Name" value="<?php echo $edit['name'] ?? ''; ?>" required>
    <input type="text" name="designation" placeholder="Designation" value="<?php echo $edit['designation'] ?? ''; ?>" required>
    <input type="text" name="title" placeholder="Title" value="<?php echo $edit['title'] ?? ''; ?>" required>
    <textarea name="message" placeholder="Message" required><?php echo $edit['message'] ?? ''; ?></textarea>
    <input type="number" name="rating" placeholder="Rating (1-5)" min="1" max="5" value="<?php echo $edit['rating'] ?? 5; ?>" required>
    <input type="file" name="image" <?php echo $edit ? '' : 'required'; ?>>

    <?php if($edit && !empty($edit['image'])): ?>
        <p>Current Image: <img src="uploads/<?php echo $edit['image']; ?>" width="80"></p>
    <?php endif; ?>

    <button type="submit" name="<?php echo $edit ? 'update' : 'add'; ?>">
        <?php echo $edit ? "Update" : "Add"; ?>
    </button>
</form>

<h2>Existing Newsletters</h2>
<table>
<tr>
    <th>#</th>
    <th>Name</th>
    <th>Designation</th>
    <th>Title</th>
    <th>Message</th>
    <th>Rating</th>
    <th>Image</th>
    <th>Actions</th>
</tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM newsletters ORDER BY id DESC");
$i=1;
while($row = mysqli_fetch_assoc($res)){
    echo "<tr>
        <td>{$i}</td>
        <td>{$row['name']}</td>
        <td>{$row['designation']}</td>
        <td>{$row['title']}</td>
        <td>".substr($row['message'],0,50)."...</td>
        <td>{$row['rating']}</td>
        <td>";
    if(!empty($row['image'])){
        echo "<img src='uploads/{$row['image']}' width='80'>";
    }
    echo "</td>
        <td>
            <a href='newsletters.php?edit={$row['id']}'>Edit</a> |
            <a href='newsletters.php?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        </td>
    </tr>";
    $i++;
}
?>
</table>
</div>
</body>
</html>