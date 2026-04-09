<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>GetPro</title>


<link rel="stylesheet" href="style.css">


<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">


<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


</head>



<body>



<!-- HEADER -->

<header class="header">

<div class="container nav-container">


<h2 class="logo">
Get<span>Pro</span>
</h2>



<!-- NAVIGATION -->

<nav id="menu">

<ul>


<li>
<a href="index.php">Home</a>
</li>


<li>
<a href="about.php">About</a>
</li>



<!-- SERVICES DROPDOWN -->

<li class="dropdown">


<a href="#" class="services-toggle">

Services ▾

</a>



<ul class="services-menu">


<?php

$q = mysqli_query($conn,"SELECT * FROM services");

while($row = mysqli_fetch_assoc($q)){

?>


<li>

<a href="services.php?id=<?php echo $row['id']; ?>">

<?php echo $row['title']; ?>

</a>

</li>


<?php } ?>


</ul>



</li>



<li>
<a href="works.php">Work</a>
</li>



<li>
<a href="contact.php">Contact</a>
</li>



</ul>

</nav>



<!-- MOBILE MENU BUTTON -->

<div class="hamburger" onclick="toggleMenu()">

☰

</div>



</div>

</header>