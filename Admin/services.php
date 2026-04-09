<?php
session_start();
include "db.php";

// Prevent access without login
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

// Add a new service
if(isset($_POST['add'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);

    mysqli_query($conn, "INSERT INTO services(title, description, image) VALUES('$title', '$description', '$image')");
    header("Location: services.php");
}

// Update an existing service
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    if(!empty($_FILES['image']['name'])){
        $image = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/".$image);
        mysqli_query($conn,"UPDATE services SET title='$title', description='$description', image='$image' WHERE id=$id");
    } else {
        mysqli_query($conn,"UPDATE services SET title='$title', description='$description' WHERE id=$id");
    }
    header("Location: services.php");
}

// Delete a service
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM services WHERE id=$id");
    header("Location: services.php");
}

// Edit service
$edit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM services WHERE id=$id"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Services</title>
    <link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="newsletters.php">Newsletters</a></li>
        <li><a href="services.php" class="active">Services</a></li>
        <li><a href="works.php">Works</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <h1><?php echo $edit ? "Edit Service" : "Add New Service"; ?></h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $edit['id'] ?? ''; ?>">
        <input type="text" name="title" placeholder="Service Title" value="<?php echo $edit['title'] ?? ''; ?>" required>
        <textarea name="description" placeholder="Service Description" required><?php echo $edit['description'] ?? ''; ?></textarea>
        <input type="file" name="image" <?php echo $edit ? '' : 'required'; ?>>
        <?php if($edit && !empty($edit['image'])): ?>
            <p>Current Image: <img src="uploads/<?php echo $edit['image']; ?>" width="80"></p>
        <?php endif; ?>
        <button type="submit" name="<?php echo $edit ? 'update' : 'add'; ?>">
            <?php echo $edit ? "Update Service" : "Add Service"; ?>
        </button>
    </form>

    <h2>Existing Services</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
        $i=1;
        while($row = mysqli_fetch_assoc($res)){
            echo "<tr>
                <td>{$i}</td>
                <td>{$row['title']}</td>
                <td>".substr($row['description'],0,50)."...</td>
                <td><img src='uploads/{$row['image']}' width='80'></td>
                <td>
                    <a href='services.php?edit={$row['id']}'>Edit</a> |
                    <a href='services.php?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                </td>
            </tr>";
            $i++;
        }
        ?>
    </table>
</div>
</body>
</html>