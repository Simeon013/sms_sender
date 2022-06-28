<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
<div class="header">
  <h1>HELLO!!!</h1>
  <p>Plateforme d'envoi de SMS.</p>
</div>
    <ul class="menu">
    <li><a href="index.php" class="active">Accueil</a></li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Envoi de SMS</a>
    <div class="dropdown-content">
      <a href="numero.php">A partir de numero</a>
      <a href="excel.php">A partir d'un fichier Excel(Xlsx)</a>
    </div>
  </li>
    <li><a href="about.asp">About</a></li>
    <li  style="float:right" class="dropdown">
    <?php 
        $user = $_SESSION['login'];
    ?>
    <a href="javascript:void(0)" class="dropbtn"><?php echo($user);?></a>
    <div class="dropdown-content">
      <a href="compte.php">Compte</a>
      <a href="auth/deconnexion.php">Deconnection</a>
    </div>
  </li>
    </ul>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});


// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("myHeader");

// Get the offset position of the navbar
var sticky = header.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>