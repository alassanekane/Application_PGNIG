<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: ../connexion.php'); 
        exit(); 
}
define('INCLUDE_CHECK',true);

        require "config/connect_db.php";
        require "config/scripts_function.php";
?>
<?php
        if(isset($_GET['id_report'])&&($_GET['just']==0)):
?>
<div class="page-header">
        <h2>Charger le justificatif</h2>
 </div>
<div id="ajoute_user" > 
<form class="form-horizontal" method="POST" action="travel_expensive.php?justificatif&just=1&id_report=<?php echo $_GET['id_report'];?> "  enctype="multipart/form-data">
        <fieldset>
           <div class="control-group">
            <label class="control-label" for="fileInput">Joindre le justificatif </label>
            <div class="controls">
              <input class="input-file" id="fileInput" name="justif" type="file">
            </div>
            
          <div class="form-actions">
            <input type="submit" value="Charger" class="btn btn-primary"/>
            <a class="btn btn-danger" href="travel_expensive.php?creer_travelstep1&pass1=success&step2=<?php echo $_GET['id_report'];?>" >Annuler</a>
          </div>
        </fieldset>
 </form>
</div>
</div>
<?php
        elseif(isset($_GET['id_report'])&&($_GET['just']==1)):
        
        if(isset($_FILES['justif'])){
         $id_report = $_GET['id_report'].$_FILES['justif']['justif'];
         $fichier = $_FILES['justif']['name'];
         $dossier = './reporte/justif/';
        if(move_uploaded_file($_FILES['justif']['tmp_name'], $dossier . $id_report)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        {
        $chemin = $dossier . $id_report;
        $query2="UPDATE Espreport SET justificatif='$chemin' WHERE id_report='$id_report'";
        $resultat2=mysql_query($query2);
        if($resultat2){
                        echo '<div class="page-header">'
                                .'<h2>Charger le justificatif</h2>'
                                .'</div>'
                               .' <div id="ajoute_user" >'
                               .'<h3>Fichier charger avec succes!</h3>'
                               .'<a class="btn btn-primary" href="travel_expensive.php?creer_travelstep1&pass1=success&step2='.$_GET['id_report'].'" >Continuez</a>'
                               .'</div>';
         }else{
         echo '<div class="page-header">'
                                .'<h2>Charger le justificatif</h2>'
                                .'</div>'
                               .' <div id="ajoute_user" >'
                               .'<h3>Erreur lors du chargement du fichier! Recommancer</h3>'
                               .'<a class="btn btn-primary" href="travel_expensive.php?creer_travelstep1&pass1=success&step2='.$_GET['id_report'].'" >Continuez</a>'
                               .'</div>';
         
         }
        }
        else //Sinon (la fonction renvoie FALSE).
        {
        echo '<div class="page-header">'
                                .'<h2>Charger le justificatif</h2>'
                                .'</div>'
                               .' <div id="ajoute_user" >'
                               .'<h3>Erreur lors du chargement du fichier! Recommancer</h3>'
                               .'<a class="btn btn-primary" href="travel_expensive.php?creer_travelstep1&pass1=success&step2='.$_GET['id_report'].'" >Continuez</a>'
                               .'</div>';
        }
         
        }
        
        
        
?>
<?php
endif;
?>

