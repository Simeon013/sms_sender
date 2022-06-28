<?php
  // Initialiser la session
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
 if(!isset($_SESSION["login"])){
    header("Location: ../auth/connexion.php");
    exit(); 
  }
  include("assets/db_connect.php");
?>
<?php 
    include("assets/entete_connect.inc.php");
?>

<div class="alert">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  <?php echo("Bonjour ".$_SESSION['login'].". Vous etes connecté(e) avec succès") ?>
</div>
<button class="tablink" onclick="openPage('tableau-de-bord', this, 'red')" id="defaultOpen">Tableau de bord</button>
<button class="tablink" onclick="openPage('historique', this, 'red')">Historique</button>
<button class="tablink" onclick="openPage('Contact', this, 'red')">Contact</button>
<button class="tablink" onclick="openPage('About', this, 'red')">Compte</button>

<div id="tableau-de-bord" class="tabcontenue">
  <h3>Tableau de bord</h3>
  <p>Home is where the heart is..</p>

<?php 
      $host = 'localhost';
      $dbname = 'gest_sms';
      $username = 'root';
      $password = '';
        
      $dsn = "mysql:host=$host;dbname=$dbname"; 
      $dateD="2022-05-11 16:15:2";
      $dateF= date('Y-m-d h:i:s a');

          // récupérer tous les utilisateurs
      $sql = "SELECT sms_id,destinateur,date_envoi,objet,contenu 
                FROM sms,compte 
                WHERE sender='$user'";
      //$sql = "SELECT * FROM SMS";
      
      try{
      $pdo = new PDO($dsn, $username, $password);
      $stmt = $pdo->query($sql);
      //var_dump($stmt);
      
      if($stmt === false){
        die("Erreur");
      }
      
      }catch (PDOException $e){
        echo $e->getMessage();
      }
      ?>
        
  <link rel="stylesheet" href="css/reporting.css">
  <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Reporting</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" action="reporting.php" method="post">
    <!--<div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="assets/img/2.jpg" alt="Avatar" class="avatar">
    </div>-->

    <div class="reporting-container">
      <input type="date" name="date_top">

      <input type="date" name="date_end">
    </div>


    <div class="reporting-container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <button type="submit" class="valide">Valider</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</div>
</div>

<div id="historique" class="tabcontenue" style="overflow-x: auto;">

  <h3>Historique</h3>
      <?php 
      

      $host = 'localhost';
      $dbname = 'gest_sms';
      $username = 'root';
      $password = '';
        
      $dsn = "mysql:host=$host;dbname=$dbname"; 
      $dateD="2022-05-11 16:15:2";
      $dateF= date('Y-m-d h:i:s a', time());

          // récupérer tous les utilisateurs
      $sql = "SELECT sms_id,destinateur,date_envoi,objet,contenu 
                FROM sms,compte 
                WHERE sender='$user' ";
      //$sql = "SELECT * FROM SMS";
      
      try{
      $pdo = new PDO($dsn, $username, $password);
      $stmt = $pdo->query($sql);
      //var_dump($stmt);
      
      if($stmt === false){
        die("Erreur");
      }
      
      }catch (PDOException $e){
        echo $e->getMessage();
      }
      ?>

      	<!-- CSS  -->
	<link rel="stylesheet" href="assets/css/table_style.css">

<script src="assets/datatables/js/jquery-3.5.1.js"></script>
<script src="assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="assets/datatables/js/dataTables.jqueryui.min.js"></script>
<script src="assets/datatables/js/dataTables.buttons.min.js"></script>
<script src="assets/datatables/js/buttons.jqueryui.min.js"></script>
<script src="assets/datatables/js/jszip.min.js"></script>
<script src="assets/datatables/js/pdfmake.min.js"></script>
<script src="assets/datatables/js/vfs_fonts.js"></script>
<script src="assets/datatables/js/buttons.html5.min.js"></script>
<script src="assets/datatables/js/buttons.print.min.js"></script>
<script src="assets/datatables/js/buttons.colVis.min.js"></script>
<script class="filtre">
$("#myTable > thead th").each(function(i) {
    $("<select />").attr("data-index", i).html($("<option />")).change(function() {
        $("#myTable > tbody > tr").show().filter(function() {
            var comb = [], children = $(this).children();
            children.each(function(i) {
                var value = $("select[data-index='" + i + "']").val();
                if (value == $(this).text() || value == "") comb.push(1);
            });
            return comb.length != children.length;
        }).hide();
    }).appendTo("body");
});
$("#myTable > tbody tr").each(function() {
    $(this).children().each(function(i) {
        var that = $(this);
        var select = $("select[data-index='" + i + "']");
        if (!select.children().filter(function() {
            return $(this).text() == that.text();
        }).length) {
            select.append($("<option />").text($(this).text()));
        }
    });
});
</script>

<link rel="stylesheet" href="assets/datatables/css/jquery-ui.css">
<link rel="stylesheet" href="assets/datatables/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="assets/datatables/css/buttons.jqueryui.min.css">
        
    <table class="paleBlueRows" id="myTable">
      <thead>
      <tr>
      <th>ID SMS</th>
      <th>Destinateur</th>
      <th>Date d'envoi</th>
      <th>Objets</th>
      <th>Contenu</th>
      </tr>
      </thead>
      <!--<tfoot>
      <tr>
      <td colspan="5">
      <div class="links"><a href="#">&laquo;</a> <a class="active" href="#">1</a> <a href="#">2</a> <a href="#">3</a> <a href="#">4</a> <a href="#">&raquo;</a></div>
      </td>
      </tr>
      </tfoot>-->
      <tbody>
          <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
          <tr>
            <td><?php echo htmlspecialchars($row['sms_id']); ?></td>
            <td style="overflow-y: auto;"><?php echo htmlspecialchars($row['destinateur']); ?></td>
            <td><?php echo htmlspecialchars($row['date_envoi']); ?></td>
            <td><?php echo htmlspecialchars($row['objet']); ?></td>
            <td style="overflow-y: auto;"><?php echo htmlspecialchars($row['contenu']); ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
  </table>

  <script>
    $(document).ready( function () {
    var table = $('#myTable').DataTable( {
        lengthChange: false,
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
    } );
 
    table.buttons().container()
        .insertBefore( '#myTable_filter' );
} );
</script>

</div>




<div id="Contact" class="tabcontenue">

  

</div>

<div id="About" class="tabcontenue">
  <h3>About</h3>
  <p>Who we are and what we do.</p>
</div>

<script>
  function openPage(pageName, elmnt, color) {
  // Hide all elements with class="tabcontenue" by default */
  var i, tabcontenue, tablinks;
  tabcontenue = document.getElementsByClassName("tabcontenue");
  for (i = 0; i < tabcontenue.length; i++) {
    tabcontenue[i].style.display = "none";
  }

  // Remove the background color of all tablinks/buttons
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].style.backgroundColor = "";
  }

  // Show the specific tab content
  document.getElementById(pageName).style.display = "block";

  // Add the specific color to the button used to open the tab content
  elmnt.style.backgroundColor = color;
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>