<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<?php
        define('INCLUDE_CHECK',true);

        require "config/connect_db.php";
        
        if(isset($_GET['modifuser'])):
?>
<?php  
       $id_user = $_GET['modifuser'];
       $Resultat = mysql_query("SELECT * FROM ComptesUtilisateur WHERE id_utilisateur='$id_user'");
       $nb_donnees = mysql_fetch_array($Resultat);
?> 
<div class="container">
<h1>Administrateur</h1>
<div id="ajoute_user" >          
        <form class="form-horizontal" id='modifieform'>
        <fieldset>
          <legend>Modification de l'utilisateur</legend>
          <div class="control-group">
            <label class="control-label" for="nume_user">Numero utilisateur</label>
            <div class="controls">
          <input class="input-xlarge disabled" id="id_user" type="text" placeholder="Disabled input here…" disabled="" value="<?php echo $id_user ?>" name="id_user">
          </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="nom">Nom</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="nom" value="<?php echo $nb_donnees['nom'] ?>" name="nom" minlength="3">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="prenom">Prenom</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="prenom" name="prenom" value="<?php echo $nb_donnees['prenom'] ?>" minlength="3">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="login">Pseudo</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="login" name="login" value="<?php echo $nb_donnees['login'] ?>" minlength="3">
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="pass">Mot de passe</label>
            <div class="controls">
              <input type="password" class="input-xlarge required" id="pass" minlength="3" value="<?php echo $nb_donnees['pass'] ?>" name="pass">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="datenaissance">Date de Naissance</label>
            <div class="controls">
<!--               <input class="required date" id="dateNassance" type="text" data-date-format="mm/dd/yy"  value="01/05/2011"> -->
<!--               <input type="text" data-datepicker="datepicker" class="required date hasDatepicker focusField" id="date1"> -->
                    <input type="text" class="span2" value="<?php echo $nb_donnees['datenaissance'] ?>" data-date-format="yyyy-mm-dd" id="dateNassance" name="datenaissance" >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Droit d'utilisateur</label>
          <div class="controls">
              <select name="type_user" id="type_user">
              
                <option value="2" <?php if($nb_donnees['type_utilisateur']==2){echo  'selected="selected"';} ?> >Utilisateur Normal</option>
              
                <option value="1" <?php if($nb_donnees['type_utilisateur']==1){echo  'selected="selected"';} ?> >Manager</option>
              
              </select>
            </div>
            </div>
           <div class="control-group">
            <label class="control-label" for="pays">Pays</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="pays" value="<?php echo $nb_donnees['pays'] ?>" name="pays" minlength="3" >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="email">Adresse mail</label>
            <div class="controls">
              <input type="text" class="input-xlarge  required email" value="<?php echo $nb_donnees['email'] ?>" id="email" name="email">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label " for="phone">Téléphone</label>
            <div class="controls">
              <input type="text" class="input-xlarge required digits" id="phone" value="<?php echo $nb_donnees['numero'] ?>" name="numero">
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Modifier</button>
            <a class="btn btn-danger" href="travel_expensive.php" class="travel_expensive.php">Cancel</a>
          </div>
        </fieldset>
      </form>
</div>

</div>
<?php
        else :
?>
        <?php header ('Location: travel_expensive.php'); ?>
<?php
endif;
?>