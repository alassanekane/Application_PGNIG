<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/scripts_function.php";
require "config/script_lpo.php";
?>
<?php
        if(($_GET['step']==0)):
?>
<div class="container">
<h1>Catalogue</h1>
<div id="ajoute_user" >          
        <form class="form-horizontal" id="article" method="POST" action="lpo_manager.php?creer_article&pass1&step=1" enctype="multipart/form-data">
        <fieldset>
          <legend>Ajouter un Article</legend>
          <div class="control-group">
            <label class="control-label" for="nom">Intitulé</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="titre" name="titre" minlength="3">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="textarea">Description</label>
            <div class="controls">
              <textarea class="input-xlarge required" id="description" inlength="5" name="description" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Unité</label>
          <div class="controls">
              <select name="unit_mesure" id="unit">
               
              </select>

            </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="select01">Autre unité</label>
            <div class="controls">
              <input id="diff_unite" name="autre_unite" type="checkbox" value="Diff_unite">
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="nom"> </label>
            <div class="controls" id="lab_plus_unite">
             
            </div>
          </div>

             <div class="control-group">
            <label class="control-label" for="textarea">Tags</label>
            <div class="controls">
              <textarea class="input-xlarge" name="tags" id="tags" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
           
           <div class="control-group">
            <label class="control-label" for="fileInput">Charger une images [jpeg,png,gif] </label>
            <div class="controls">
              <input class="input-file" id="fileInput" name="img_article" type="file">
            </div>


          <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="ajout_article" >Ajouter</button>
            <a class="btn btn-danger" href="lpo_manager.php" >Cancel</a>
          </div>
        </fieldset>
      </form>
</div>

</div>

<?php
        elseif(($_GET['step']==1)):
?>
<?php

 if ( isset( $_POST['titre'] ) && isset ( $_POST['description']) ){

 if(isset($_FILES['img_article'])&& (!empty($_FILES['img_article']))){

  if (($_FILES['img_article']['type'] == "image/jpeg")||($_FILES['img_article']['type'] == "image/jpg")||($_FILES['img_article']['type'] == "image/png")||($_FILES['img_article']['type'] == "image/gif")){
               
               $titre=$_POST['titre'];
                $description=$_POST['description'];
                $liste_tags=$_POST['tags'];
                 $liste_tags3='';



              if (isset($_POST['unit_sup'])) {
                
                $nom_unit = $_POST['unit_sup'];
                ajoute_unite($nom_unit);
                $unit_mesure = getunit2 ();


              }else{
              if(isset($_POST['unit_mesure'])) {
                
                $unit_mesure=$_POST['unit_mesure'];

              }}
                
                if ($liste_tags!='') {                  
                $liste_tags2 = str_replace("]x["," , ",$liste_tags);
                $liste_tags3 = str_replace("]x","]",$liste_tags2);
                }
                
                $sql = "INSERT INTO article VALUES (NULL, '$titre', '$description', '$liste_tags3', '$unit_mesure', '', '0') ";
                $resultat=mysql_query($sql);

                $lastid= getlastidarticle();
                $extension  = pathinfo($_FILES['img_article']['name'], PATHINFO_EXTENSION);
                $nametof=$lastid.'.'.$extension;
                
                $dossier = './imgarticle/';


                if(move_uploaded_file($_FILES['img_article']['tmp_name'], $dossier.$nametof)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                  $chemin = $dossier . $nametof;
                  $query2="UPDATE article SET photo='$chemin' WHERE id_intituler='$lastid'";
                  $resultat2=mysql_query($query2);
                  header('Location:lpo_manager.php');
                  exit();
                }else{
                  $sql3 ="DELETE from article WHERE id_intituler= '$lastid'" ;
                  $rep3 = mysql_query($sql3);
                  
                 ?>
                 <div class="container">
<h1>Catalogue</h1>
<div id="ajoute_user" >
<div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
  <h3>Il y a eu des erreurs lors de l'ajout de l'article Veuillez recommencer!</h3>
</div>          
        <form class="form-horizontal" id="article" method="POST" action="lpo_manager.php?creer_article&pass1&step=1" enctype="multipart/form-data">
        <fieldset>
          <legend>Ajouter un Article</legend>
          <div class="control-group">
            <label class="control-label" for="nom">Intitulé</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="titre" name="titre" minlength="3" value="<?php echo $titre; ?>">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="textarea">Description</label>
            <div class="controls">
              <textarea value="<?php echo $description; ?>" class="input-xlarge required" id="description" inlength="5" name="description" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Unité</label>
          <div class="controls">
              <select name="unit_mesure" id="unit">
               
              </select>

            </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="select01">Autre unité</label>
            <div class="controls">
              <input id="diff_unite" name="autre_unite" type="checkbox" value="Diff_unite">
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="nom"> </label>
            <div class="controls" id="lab_plus_unite">
             
            </div>
          </div>

             <div class="control-group">
            <label class="control-label" for="textarea">Tags</label>
            <div class="controls">
              <textarea value="<?php echo $liste_tags; ?>" class="input-xlarge" name="tags" id="tags" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
           
           <div class="control-group">
            <label class="control-label" for="fileInput">Charger une images [jpeg,png,gif] </label>
            <div class="controls">
              <input class="input-file" id="fileInput" name="img_article" type="file">
            </div>


          <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="ajout_article" >Ajouter</button>
            <a class="btn btn-danger" href="lpo_manager.php" >Cancel</a>
          </div>
        </fieldset>
      </form>
</div>

</div>
                 <?php
                }

            }else{
           
             ?> 
<div class="container">
<h1>Catalogue</h1>
<div id="ajoute_user" >
<div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
  <h3>Veuillez recommencer l'extension du fichier doit être de type (JPEG, PNG, GIF).</h3>
</div>          
        <form class="form-horizontal" id="article" method="POST" action="lpo_manager.php?creer_article&pass1&step=1" enctype="multipart/form-data">
        <fieldset>
          <legend>Ajouter un Article</legend>
          <div class="control-group">
            <label class="control-label" for="nom">Intitulé</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="titre" name="titre" minlength="3" value="<?php echo $titre; ?>">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="textarea">Description</label>
            <div class="controls">
              <textarea value="<?php echo $description; ?>" class="input-xlarge required" id="description" inlength="5" name="description" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Unité</label>
          <div class="controls">
              <select name="unit_mesure" id="unit">
               
              </select>

            </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="select01">Autre unité</label>
            <div class="controls">
              <input id="diff_unite" name="autre_unite" type="checkbox" value="Diff_unite">
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="nom"> </label>
            <div class="controls" id="lab_plus_unite">
             
            </div>
          </div>

             <div class="control-group">
            <label class="control-label" for="textarea">Tags</label>
            <div class="controls">
              <textarea value="<?php echo $liste_tags; ?>" class="input-xlarge" name="tags" id="tags" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
           
           <div class="control-group">
            <label class="control-label" for="fileInput">Charger une images [jpeg,png,gif] </label>
            <div class="controls">
              <input class="input-file" id="fileInput" name="img_article" type="file">
            </div>


          <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="ajout_article" >Ajouter</button>
            <a class="btn btn-danger" href="lpo_manager.php" >Cancel</a>
          </div>
        </fieldset>
      </form>
</div>

</div>
<?php
            }

}else{
          
                $titre=$_POST['titre'];
                $description=$_POST['description'];
                $liste_tags=$_POST['tags'];
                 $liste_tags3='';



              if (isset($_POST['unit_sup'])) {
                
                $nom_unit = $_POST['unit_sup'];
                ajoute_unite($nom_unit);
                $unit_mesure = getunit2 ();


              }else{
              if(isset($_POST['unit_mesure'])) {
                
                $unit_mesure=$_POST['unit_mesure'];

              }}
                
                if ($liste_tags!='') {                  
                $liste_tags2 = str_replace("]x["," , ",$liste_tags);
                $liste_tags3 = str_replace("]x","]",$liste_tags2);
                }
                
                $sql = "INSERT INTO article VALUES (NULL, '$titre', '$description', '$liste_tags3', '$unit_mesure', './imgarticle/unknown.jpg', '0') ";
                $resultat=mysql_query($sql);
                 header('Location:lpo_manager.php');
              exit();
}
}else{
?>
   <div class="container">
<h1>Catalogue</h1>
<div id="ajoute_user" >
<div class="alert alert-error">
  <a class="close" data-dismiss="alert">×</a>
  <h3>Erreur champs invalide ou vide!.</h3>
</div>          
        <form class="form-horizontal" id="article" method="POST" action="lpo_manager.php?creer_article&pass1&step=1" enctype="multipart/form-data">
        <fieldset>
          <legend>Ajouter un Article</legend>
          <div class="control-group">
            <label class="control-label" for="nom">Intitulé</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="titre" name="titre" minlength="3" value="<?php echo $titre; ?>">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="textarea">Description</label>
            <div class="controls">
              <textarea value="<?php echo $description; ?>" class="input-xlarge required" id="description" inlength="5" name="description" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Unité</label>
          <div class="controls">
              <select name="unit_mesure" id="unit">
               
              </select>

            </div>
            </div>
            <div class="control-group">
            <label class="control-label" for="select01">Autre unité</label>
            <div class="controls">
              <input id="diff_unite" name="autre_unite" type="checkbox" value="Diff_unite">
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="nom"> </label>
            <div class="controls" id="lab_plus_unite">
             
            </div>
          </div>

             <div class="control-group">
            <label class="control-label" for="textarea">Tags</label>
            <div class="controls">
              <textarea value="<?php echo $liste_tags; ?>" class="input-xlarge" name="tags" id="tags" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
           
           <div class="control-group">
            <label class="control-label" for="fileInput">Charger une images [jpeg,png,gif] </label>
            <div class="controls">
              <input class="input-file" id="fileInput" name="img_article" type="file">
            </div>


          <div class="form-actions">
            <button type="submit" class="btn btn-primary" id="ajout_article" >Ajouter</button>
            <a class="btn btn-danger" href="lpo_manager.php" >Cancel</a>
          </div>
        </fieldset>
      </form>
</div>

</div>
<?php
}


?>

<?php
        else:
?>

<?php
        endif;
?>