<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<?php
                if($_COOKIE['type_utilisateur']==0):
               
?>
                <?php
                if(isset($_GET['admin'])||empty($_GET)):
                include 'administrateur.php'
                ?>
                <?php 
                elseif(isset($_GET['ajouter_user'])):
                include 'ajoute_user.php'
                ?>
                <?php 
                elseif(isset($_GET['modifuser'])):
                include 'modifier_user.php'
                ?>
                <?php
                endif;
                ?>
                
<?php
                elseif($_COOKIE['type_utilisateur']==1):
?>
                <?php 
                if(isset($_GET['lpo_manager'])||empty($_GET)):
                include 'manager.php';
                ?>
                <?php
                elseif(isset($_GET['lpo_encour'])):
                include 'liste_cmd.php'
                ?>
                <?php
                elseif(isset($_GET['traitercommande'])):
                include 'reporte/traiterraport.php'
                ?>
                <?php
                elseif(isset($_GET['livreraport'])):
                include 'reporte/livreraport.php'
                ?>
                <?php
                elseif(isset($_GET['viewreport'])):
                include 'reporte/viewreport.php'
                ?>
                <?php 
                elseif(isset($_GET['modifcomande'])&&isset($_GET['id_commande'])):
                include 'reporte/modifexpense.php'
                ?>
                <?php
                endif;
                ?>

<?php
                elseif($_COOKIE['type_utilisateur']==2):
?>

                <?php 
                if(isset($_GET['creer_lpo'])||empty($_GET)):
                include 'utilisateur.php'
                ?>
                <?php 
                elseif(isset($_GET['creer_article'])&&isset($_GET['pass1'])):
                include 'ajoute_article.php'
                ?>
                
                <?php 
                elseif(isset($_GET['liste_lpo'])):
                include 'liste_cmd_user.php'
                ?>
                <?php
                endif;
                ?>

<?php
                endif;
?>