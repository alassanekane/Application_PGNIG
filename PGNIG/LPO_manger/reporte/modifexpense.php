<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: ../connexion.php'); 
        exit(); 
}
?>
<?php
        define('INCLUDE_CHECK',true);

        require "config/connect_db.php";
        require "config/scripts_function.php";
        require "config/script_lpo.php";
        
        if(!empty($_GET['id_article'])&&!empty($_GET['id_commande'])):
        
       $id_article = $_GET['id_article'];
       $id_commande = $_GET['id_commande'];
       $info_commande=getInfocommande($id_commande);
       $info_article = getUnArticleCommande($id_commande,$id_article);
?>
<div class="container">
<h1>LPO_Manager</h1>
<div id="ajout_expense" class="<?php echo $_GET['id_article'];?>" >          
        <form class="form-horizontal" id="modifitem">
        <fieldset class="info_article" id="<?php echo $_GET['id_article'];?>">
          <legend>Modification Item</legend>
            

            <div class="control-group" >
            <label class="control-label " for="phone">Info Item</label>
            <div class="controls well">
              <strong>Intitulé: </strong> <?php echo $info_article['intitule'];?><br>
              <strong>Quantité: </strong> <?php echo $info_article['quantite'];?><br>
              <strong>Unité: </strong> <?php echo $info_article['unite'];?><br>
              <strong>Prix: </strong> <?php echo prix($info_article['prix']);?><br>
            </div>
          </div>
          
            <div class="control-group">
            <label class="control-label " for="phone">Nouvelle Quantité</label>
            <div class="controls">
              <input type="text" class="input-xlarge required number" name="newquantite" minlength="1"  placeholder="Nouvelle Quantité" >
            </div>
            </div>

            <div class="control-group">
            <label class="control-label " for="phone">Prix de l'article</label>
            <div class="controls">
              <input type="text" class="input-xlarge number" name="newprix" placeholder="Quantité"  >
              <span><em>Faculatatif (. et non ,)</em></span>
            </div>
            </div>
          
         
          <div class="form-actions" id="<?php echo $_GET['id_commande'];?>">
            <button type="submit" class="btn btn-primary">Modifier</button>
             <a class="btn btn-danger" href="lpo_manager.php?traitercommande=success&id_user=<?php echo $info_commande['id_utilisateur'];?>&id_commande=<?php echo $id_commande ?>" >Annuler</a>
          </div>
        </fieldset>
      </form>
</div>

<?php
        else:
?>

<?php
       endif;
?>