<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}
include "db.php";

// Function to generate project_id
function generateProjectID($conn) {
    $date = date('dmy'); // DDMMYY
    $result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM works WHERE project_id LIKE 'PRO-$date-%'");
    $row = mysqli_fetch_assoc($result);
    $number = $row['total'] + 1;
    return "PRO-$date-$number";
}

// Add new work
if(isset($_POST['add'])){
    $project_id = generateProjectID($conn);
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] ?? NULL;
    $status = $_POST['status'];

    $feature_image = '';
    if(isset($_FILES['feature_image']['name']) && $_FILES['feature_image']['name'] != ''){
        $feature_image = $_FILES['feature_image']['name'];
        move_uploaded_file($_FILES['feature_image']['tmp_name'], "uploads/".$feature_image);
    }

    mysqli_query($conn, "INSERT INTO works(project_id, project_name, project_description, start_date, end_date, status, feature_image) 
    VALUES('$project_id','$project_name','$project_description','$start_date','$end_date','$status','$feature_image')");
    header("Location: works.php");
    exit();
}

// Update work
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $project_name = $_POST['project_name'];
    $project_description = $_POST['project_description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'] ?? NULL;
    $status = $_POST['status'];

    if(isset($_FILES['feature_image']['name']) && $_FILES['feature_image']['name'] != ''){
        $feature_image = $_FILES['feature_image']['name'];
        move_uploaded_file($_FILES['feature_image']['tmp_name'], "uploads/".$feature_image);
        mysqli_query($conn, "UPDATE works SET project_name='$project_name', project_description='$project_description', start_date='$start_date', end_date='$end_date', status='$status', feature_image='$feature_image' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE works SET project_name='$project_name', project_description='$project_description', start_date='$start_date', end_date='$end_date', status='$status' WHERE id=$id");
    }
    header("Location: works.php");
    exit();
}

// Delete work
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM works WHERE id=$id");
    header("Location: works.php");
    exit();
}

// Edit work
$edit = null;
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM works WHERE id=$id"));
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Works</title>
<link rel="stylesheet" href="admin-style.css">
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="newsletters.php">Newsletters</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="works.php" class="active">Works</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
<h1><?php echo $edit ? "Edit" : "Add"; ?> Work</h1>

<form method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $edit['id'] ?? ''; ?>">
    <input type="text" name="project_name" placeholder="Project Name" value="<?php echo $edit['project_name'] ?? ''; ?>" required>
    <textarea name="project_description" placeholder="Project Description" required><?php echo $edit['project_description'] ?? ''; ?></textarea>
    <label>Start Date:</label>
    <input type="date" name="start_date" value="<?php echo $edit['start_date'] ?? ''; ?>" required>
    <label>End Date:</label>
    <input type="date" name="end_date" value="<?php echo $edit['end_date'] ?? ''; ?>">
    <label>Status:</label>
    <select name="status" required>
        <?php
        $statuses = ['Completed','Active','Inactive'];
        foreach($statuses as $s){
            $selected = ($edit['status'] ?? '') == $s ? 'selected' : '';
            echo "<option value='$s' $selected>$s</option>";
        }
        ?>
    </select>
    <input type="file" name="feature_image" <?php echo $edit ? '' : 'required'; ?>>
    <?php if($edit && !empty($edit['feature_image'])): ?>
        <p>Current Image: <img src="uploads/<?php echo $edit['feature_image']; ?>" width="80"></p>
    <?php endif; ?>
    <button type="submit" name="<?php echo $edit ? 'update' : 'add'; ?>">
        <?php echo $edit ? "Update Work" : "Add Work"; ?>
    </button>
</form>

<h2>Existing Works</h2>
<table>
<tr>
    <th>#</th>
    <th>Project ID</th>
    <th>Name</th>
    <th>Description</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Status</th>
    <th>Feature Image</th>
    <th>Actions</th>
</tr>

<?php
$res = mysqli_query($conn, "SELECT * FROM works ORDER BY id DESC");
$i=1;
while($row = mysqli_fetch_assoc($res)){
    echo "<tr>
        <td>{$i}</td>
        <td>{$row['project_id']}</td>
        <td>{$row['project_name']}</td>
        <td>".substr($row['project_description'],0,50)."...</td>
        <td>{$row['start_date']}</td>
        <td>".($row['end_date'] ?? '')."</td>
        <td>{$row['status']}</td>
        <td>";
    if(!empty($row['feature_image'])){
        echo "<img src='uploads/{$row['feature_image']}' width='80'>";
    }
    echo "</td>
        <td>
            <a href='works.php?edit={$row['id']}'>Edit</a> |
            <a href='works.php?delete={$row['id']}' onclick='return confirm(\"Are you sure?\")'>Delete</a>
        </td>
    </tr>";
    $i++;
}
?>
</table>
</div>
</body>
</html>