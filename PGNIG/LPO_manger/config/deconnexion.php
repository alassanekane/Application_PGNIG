<?php

if(empty($_COOKIE['id_utilisateur']))
{
     header("Location: connexion.php");
}
else
{
     
     // Suppression des cookies
     setcookie("id_utilisateur", "", time() - 1, "/");
     setcookie("prenom", "", time() - 1, "/");
     setcookie("nom", "", time() - 1, "/");
     // Redirection de l'utilisateur
     header("Location: ../index.php");
     
}

?>