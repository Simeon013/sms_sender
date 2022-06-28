<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["login"])){
    include("assets/entete.inc.php");
}else{
    include("assets/entete_connect.inc.php");
}
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Slideshow container -->
<div class="slideshow-container">

  <!-- Full-width images with number and caption text -->
  <div class="mySlides fade">
    <div class="numbertext">1 / 3</div>
    <img src="assets/img/5.jpg" class="image">
    <div class="text-content">
                  <h3>Welcome</h3>
                  <h5>Envoie de SMS</h5>
                  <a href="#" class="main-stroked-button">Learn More</a>
                  <a href="numero.php" class="main-filled-button">Essayer</a>
                </div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">2 / 3</div>
    <img src="assets/img/ban2.jpg" style="width:100%" class="image">
    <div class="text-content">
                  <h3>Envoie par fichier excel</h3>
                  <h5>Envoie de SMS a partir d'un fichier xlsx</h5>
                  <a href="#" class="main-stroked-button">Learn More</a>
                  <a href="excel.php" class="main-filled-button">Essayer</a>
                </div>
  </div>

  <div class="mySlides fade">
    <div class="numbertext">3 / 3</div>
    <img src="assets/img/6.jpg" style="width:100%" class="image">
    <div class="text-content">
                  <h3>Programmez vos envoies</h3>
                  <h5>Envoie de SMS programmé a l'avance</h5>
                  <a href="#" class="main-stroked-button">Learn More</a>
                  <a href="program-num.php" class="main-filled-button">Essayer</a>
                </div>
  </div>

  <!-- Next and previous buttons -->
  <a class="prec" onclick="plusSlides(-1)">&#10094;</a>
  <a class="suiv" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<!-- The dots/circles -->
<div style="text-align:center">
  <span class="dot" onclick="currentSlide(1)"></span>
  <span class="dot" onclick="currentSlide(2)"></span>
  <span class="dot" onclick="currentSlide(3)"></span>
</div>
  </div>

  <h2>Presentation</h2>
<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ratione quis libero, facilis laboriosam consequuntur temporibus natus voluptas omnis laudantium deleniti maxime consectetur nemo aliquam excepturi atque? Quasi sunt nisi eveniet?</p>

<!-- About Section -->
<div class="w3-container" style="padding:128px 16px" id="about">
  <h3 class="w3-center">ABOUT THE COMPANY</h3>
  <p class="w3-center w3-large">Key features of our company</p>
  <div class="w3-row-padding w3-center" style="margin-top:64px">
    <div class="w3-quarter">
      <i class="fa fa-desktop w3-margin-bottom w3-jumbo w3-center"></i>
      <p class="w3-large">Responsive</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-heart w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Passion</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-diamond w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Design</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="w3-quarter">
      <i class="fa fa-cog w3-margin-bottom w3-jumbo"></i>
      <p class="w3-large">Support</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
  </div>
</div>

  
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    }
</script>

<h2 style="text-align:center">Responsive Pricing Tables</h2>
<p style="text-align:center">Resize the browser window to see the effect.</p>

<div class="columns">
  <ul class="price">
    <li class="head">Basic</li>
    <li class="grey">$ 9.99 / year</li>
    <li>10GB Storage</li>
    <li>10 Emails</li>
    <li>10 Domains</li>
    <li>1GB Bandwidth</li>
    <li class="grey"><a href="#" class="button">Sign Up</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="head" style="background-color:#04AA6D">Pro</li>
    <li class="grey">$ 24.99 / year</li>
    <li>25GB Storage</li>
    <li>25 Emails</li>
    <li>25 Domains</li>
    <li>2GB Bandwidth</li>
    <li class="grey"><a href="#" class="button">Sign Up</a></li>
  </ul>
</div>

<div class="columns">
  <ul class="price">
    <li class="head">Premium</li>
    <li class="grey">$ 49.99 / year</li>
    <li>50GB Storage</li>
    <li>50 Emails</li>
    <li>50 Domains</li>
    <li>5GB Bandwidth</li>
    <li class="grey"><a href="#" class="button">Sign Up</a></li>
  </ul>
</div>