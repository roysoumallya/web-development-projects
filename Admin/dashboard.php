<?php

session_start();
include "db.php";
// Prevent browser caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// Check if admin is logged in
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin-style.css">
    <script>
        // This ensures back button won't load cached page
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        window.onpageshow = function(evt) {
            if (evt.persisted) {
                window.location.reload();
            }
        };
    </script>
    <script src="js/admin-script.js" defer></script>
</head>
<body>
<div class="sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="newsletters.php">Newsletters</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="works.php">Works</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <h1>Welcome, <?php echo $_SESSION['admin']; ?></h1>

    <div class="cards">
        <div class="card">
            <?php
            $count = mysqli_query($conn,"SELECT * FROM newsletters");
            echo "<h3>".mysqli_num_rows($count)."</h3><p>Newsletters</p>";
            ?>
        </div>
        <div class="card">
            <?php
            $count = mysqli_query($conn,"SELECT * FROM services");
            echo "<h3>".mysqli_num_rows($count)."</h3><p>Services</p>";
            ?>
        </div>
        <div class="card">
            <?php
            $count = mysqli_query($conn,"SELECT * FROM works");
            echo "<h3>".mysqli_num_rows($count)."</h3><p>Works</p>";
            ?>
        </div>
    </div>

    <h2>Recent Newsletters</h2>
<div class="newsletter-cards">
<?php
// Fetch latest 5 newsletters
$res = mysqli_query($conn, "SELECT * FROM newsletters ORDER BY id DESC LIMIT 4");
while($row = mysqli_fetch_assoc($res)){
?>
    <a href="newsletters.php?edit=<?php echo $row['id']; ?>" class="newsletter-card">
        <div class="card-header">
            <?php if(!empty($row['image'])): ?>
                <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
            <?php else: ?>
                <div class="placeholder-img">No Image</div>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
            <p><strong><?php echo htmlspecialchars($row['name']); ?></strong> – <?php echo htmlspecialchars($row['designation']); ?></p>
            <p>Rating: <?php echo $row['rating']; ?> ★</p>
        </div>
    </a>
<?php } ?>
</div>
</div>
</body>
</html>