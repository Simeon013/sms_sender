<?php 
    include("assets/entete_connect.inc.php");
?>
      <?php 

      $host = 'localhost';
      $dbname = 'gest_sms';
      $username = 'root';
      $password = '';
        
      $dsn = "mysql:host=$host;dbname=$dbname"; 
      $dateD="2022-05-11";
      $dateF= date('Y-m-d h:i:s');
      $dateD=$_POST['date_top'];
      $dateF=$_POST['date_end'];
      //var_dump($dateD);
      //var_dump($dateF);

          // récupérer tous les utilisateurs
      $sql = "SELECT sms_id,destinateur,date_envoi,objet,contenu 
                FROM sms,compte 
                WHERE sender='$user' 
                AND date_envoi BETWEEN '$dateD' AND '$dateF'";
                //var_dump($sql);
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
    

    <link rel="stylesheet" href="assets/datatables/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/datatables/css/dataTables.jqueryui.min.css">
    <link rel="stylesheet" href="assets/datatables/css/buttons.jqueryui.min.css">



    <table id="myTable">
      <thead>
      <tr>
      <th>ID SMS</th>
      <th>Destinateur</th>
      <th>Date d'envoi</th>
      <th>Objets</th>
      <th>Contenu</th>
      </tr>
      </thead>
      <tbody>
          <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
          <tr>
            <td><?php echo htmlspecialchars($row['sms_id']); ?></td>
            <td><?php echo htmlspecialchars($row['destinateur']); ?></td>
            <td><?php echo htmlspecialchars($row['date_envoi']); ?></td>
            <td><?php echo htmlspecialchars($row['objet']); ?></td>
            <td><?php echo htmlspecialchars($row['contenu']); ?></td>
          </tr>
          <?php endwhile; ?>
        </tbody>
  </table>
  
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