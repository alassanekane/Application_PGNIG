<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<div class="container">
<h1>Administrateur</h1>
<p><a class="btn btn-success" href="lpo_manager.php?ajouter_user"><i class="icon-plus icon-white"></i> Ajouter utilisateur</a></p>

<?php
        include 'liste_user.php';
?>