

<!-- HEADER -->
<?php include "header.php"; ?>


<!-- HERO -->
<section class="hero">
    <div class="container hero-grid">

        <div class="hero-text">
            <h1>
            We Build 
            <span id="typing-text"></span>
            </h1>
            <p>
                Interactive websites, web apps and digital experiences
                designed for performance and scalability.
            </p>

            <button class="btn">Get Started</button>
        </div>

        <div class="hero-img">

<div class="slider">

<img src="Images/rocket.png" class="slide active">

<img src="Images/slide-2.jfif" class="slide">

<img src="Images/slide-3.jfif" class="slide">

</div>

</div>

    </div>
</section>


<!-- ABOUT -->
<section class="about" id="about" data-aos="fade-up">
<div class="container about-grid">


<div class="collage-wrapper">

    <div class="image-collage">

        <img src="Images/about-1.webp" class="img img1">

        <img src="Images/about-2.avif" class="img img2">

        <img src="Images/about-3.jfif" class="img img3">

        <img src="Images/about-4.jfif" class="img img4">

    </div>

</div>

<div>
<h2>Choose <span>The Best</span> IT Service Company</h2>

<p>
We specialize in creating responsive, user-friendly application and website designs. 
Our team delivers modern UI/UX, smooth performance, 
and tailored digital solutions that help businesses grow effectively.
</p>

<div class="features">

<div class="feature">
✔ Money Back Guarantee
</div>

<div class="feature">
✔ Technical Support 
</div>



</div>
<a href="about.html" class="btn about-btn">Learn More</a>
</div>

</div>
</section>


<!-- SERVICES -->

<section class="services" id="services" data-aos="fade-up">

<h2 class="section-title">
We Are <span>Dedicated To Serve</span> You All Time.
</h2>


<div class="services-wrapper container">

<button class="scroll-btn left" onclick="scrollServices(-1)">❮</button>


<div class="services-slider" id="servicesSlider">



<?php
        // Fetch all services from the database
        $query = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");
        
        if(mysqli_num_rows($query) > 0){
            while($service = mysqli_fetch_assoc($query)){
        ?>
        <div class="card">
            <img src="Admin/uploads/<?php echo $service['image']; ?>" alt="<?php echo htmlspecialchars($service['title']); ?>">
            <h3><?php echo htmlspecialchars($service['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
            <!-- Optional: Link to detailed service page -->
            <a href="service-detail.php?id=<?php echo $service['id']; ?>" class="learn-btn">Learn More</a> 
        </div>
        <?php
            }
        } else {
            echo "<p>No services found.</p>";
        }
        ?>




</div>



<button class="scroll-btn left" onclick="scrollServices(-1)">❮</button>

<button class="scroll-btn right" onclick="scrollServices(1)">❯</button>

</div>


</section>


<!-- INDUSTRIES -->


<section class="industries" data-aos="fade-up">

<div class="container">


<div class="section-header">

<span class="tag">Why Choose Us</span>

<h2>
We Serve A Wide <span>Variety</span> Of Industries
</h2>

<p>
Below is just a small sample of some of the industries that we serve.
</p>

</div>



<!-- tabs -->

<div class="tabs">

<button class="tab active" onclick="openTab(0)">
Company Mission
</button>

<button class="tab" onclick="openTab(1)">
Award Winner
</button>

<button class="tab" onclick="openTab(2)">
Using Software
</button>

</div>



<!-- tab content -->

<div class="tab-content active">

<div class="tab-grid">

<img src="Images/tab-1.jfif" data-aos="fade-right">

<div>

<h3>Empowering Digital Innovation</h3>

<p>
We focus on delivering reliable digital solutions that help businesses
improve productivity and customer engagement.
</p>

<a href="contact.html" class="primary-btn">
Contact Us →
</a>

</div>

</div>

</div>



<div class="tab-content">

<div class="tab-grid">

<img src="Images/tab-2.jfif" data-aos="fade-right">

<div>

<h3>Award Winning Services</h3>

<p>
Recognized for excellence in UI design and development delivering
high quality business solutions.
</p>

<a href="contact.html" class="primary-btn">
Contact Us →
</a>

</div>

</div>

</div>



<div class="tab-content">

<div class="tab-grid">

<img src="Images/tab-3.jfif" data-aos="fade-right">

<div>

<h3>Technology Driven Approach</h3>

<p>
We use modern software tools and frameworks to ensure scalable
and efficient applications.
</p>

<a href="contact.html" class="primary-btn">
Contact Us →
</a>

</div>

</div>

</div>



</div>

</section>


<!-- COUNTER SECTION -->


<section class="stats-section">

<div class="container">

<h2 class="stats-title">
We develop strategic software solutions for business.
</h2>


<div class="stats-grid">


<div class="stat-card">

<div class="icon">

<svg viewBox="0 0 24 24">
<path d="M3 17h4v4H3v-4zm7-7h4v11h-4V10zm7-6h4v17h-4V4z"/>
</svg>

</div>

<h3 class="counter" data-target="885">0</h3>

<p>Projects</p>

</div>



<div class="stat-card">

<div class="icon">

<svg viewBox="0 0 24 24">
<path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7z"/>
</svg>

</div>

<h3 class="counter" data-target="365">0</h3>

<p>Working Days</p>

</div>



<div class="stat-card">

<div class="icon">

<svg viewBox="0 0 24 24">
<path d="M12 12a5 5 0 100-10 5 5 0 000 10zm-7 9v-2a7 7 0 0114 0v2H5z"/>
</svg>

</div>

<h3 class="counter" data-target="220">0</h3>

<p>Team Members</p>

</div>



<div class="stat-card">

<div class="icon">

<svg viewBox="0 0 24 24">
<path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 
5.42 4.42 3 7.5 3c1.74 0 3.41.81 
4.5 2.09C13.09 3.81 14.76 3 
16.5 3 19.58 3 22 5.42 22 
8.5c0 3.78-3.4 6.86-8.55 
11.54L12 21.35z"/>
</svg>

</div>

<h3 class="counter" data-target="890">0</h3>

<p>Happy Clients</p>

</div>


</div>


<p class="stats-subtext">
You have better things to do than worry about IT for your business.
Let’s discuss your project.
</p>


</div>

</section>

<?php

$q = mysqli_query($conn,

"SELECT * FROM newsletters
WHERE status='active'
ORDER BY id DESC");

?>
<!-- NEWSLETTER -->


<section class="testimonial-section">

<div class="container">


<h2 class="section-title">
What Our <span>Clients Say</span>
</h2>



<div class="testimonial-wrapper">


<div class="testimonial-track" id="testimonialTrack">

<?php
while($row = mysqli_fetch_assoc($q)){
?>
<!-- testimonial 1 -->

<div class="testimonial-card">

<div class="testimonial-left">

<img src="admin/uploads/<?php
echo $row['image'];
?>">

</div>


<div class="testimonial-right">

<div class="quote">“</div>


<h3>
<?php echo $row['name']; ?>
<span><?php echo $row['designation']; ?></span>
</h3>


<div class="stars">
<?php

for($i=1;$i<=5;$i++){

if($i <= $row['rating']){

echo "★";

}else{

echo "☆";

}

}

?>
</div>


<h2>
<?php echo $row['title']; ?>
</h2>


<p>
<?php echo $row['message']; ?>
</p>


</div>

</div>



<?php } ?>

</div>


<!-- navigation buttons -->

<div class="testimonial-controls">

<button onclick="prevTestimonial()" class="nav-btn">
❮
</button>


<button onclick="nextTestimonial()" class="nav-btn">
❯
</button>

</div>


</div>


</div>

</section>


<!-- FOOTER -->

<?php include "footer.php"; ?>