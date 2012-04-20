<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])) { 
   header ('Location: connexion.php'); 
   exit();  
} 
?>
<?php if(isset($_COOKIE['id_utilisateur'])) { 

     header ('Location: travel_expensive.php');

} else { ?>
<p>
     <a href="creer-compte-utilisateur.php">Créer un compte utilisateur</a> | 
     <a href="connexion.php">Connexion</a>
</p>
<?php } ?>