<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<?php 
         if(($_GET['sendreport']=='success')):
         
 ?>
<div class="hero-unit">
  <h2>Report Expense</h2>
  <p>Le report a été envoyer avec succes!</p>
  <p>
    <a class="btn btn-large"  href="travel_expensive.php">
      Continuez
    </a>
      <a class="btn btn-primary btn-large"  href="travel_expensive.php?liste_travel">
      Reports en Cours
    </a>
  </p>
</div>

<?php 
         else:
         
 ?>
 
<?php 
         endif;
         
 ?>