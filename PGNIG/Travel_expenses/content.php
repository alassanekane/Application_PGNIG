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
                if(isset($_GET['manger_travel'])||empty($_GET)):
                include 'manager.php';
                ?>
                <?php
                elseif(isset($_GET['travel_encour'])):
                include 'liste_travel.php'
                ?>
                <?php
                elseif(isset($_GET['traiterraport'])):
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
                elseif(isset($_GET['modifexpense'])&&isset($_GET['id_report'])):
                include 'reporte/modifexpense.php'
                ?>
                <?php
                endif;
                ?>

<?php
                elseif($_COOKIE['type_utilisateur']==2):
?>

                <?php 
                if(isset($_GET['creer_travel'])||empty($_GET)):
                include 'utilisateur.php'
                ?>
                <?php 
                elseif(isset($_GET['creer_travelstep1'])&&isset($_GET['pass1'])):
                include 'reporte/reportstep2.php'
                ?>
                <?php 
                elseif(isset($_GET['reportencours'])&&isset($_GET['id_report'])):
                include 'reporte/ajouteexpense.php'
                ?>
                <?php 
                elseif(isset($_GET['modifexpense'])&&isset($_GET['id_report'])):
                include 'reporte/modifexpense.php'
                ?>
                 <?php 
                elseif(isset($_GET['justificatif'])&&isset($_GET['id_report'])):
                include 'reporte/justificatif.php'
                ?>
                <?php 
                elseif(isset($_GET['sendreport'])):
                include 'reporte/reportsuccess.php'
                ?>
                <?php 
                elseif(isset($_GET['liste_travel'])):
                include 'liste_travel_user.php'
                ?>
                <?php
                endif;
                ?>

<?php
                endif;
?>