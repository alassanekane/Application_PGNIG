<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<div class="container">
<h1>Administrateur</h1>
<div id="ajoute_user" >          
        <form class="form-horizontal" id='ajouteuserform'>
        <fieldset>
          <legend>Ajouter un utilisateur</legend>
          <div class="control-group">
            <label class="control-label" for="nom">Nom</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="nom" name="nom" minlength="3">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="prenom">Prenom</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="prenom" name="prenom" minlength="3">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="login">Pseudo</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="login" name="login" minlength="3">
            </div>
          </div>
            <div class="control-group">
            <label class="control-label" for="pass">Mot de passe</label>
            <div class="controls">
              <input type="password" class="input-xlarge required" id="pass" minlength="3" name="pass">
            </div>
          </div>
           <div class="control-group">
            <label class="control-label" for="datenaissance">Date de Naissance</label>
            <div class="controls">
<!--               <input class="required date" id="dateNassance" type="text" data-date-format="mm/dd/yy"  value="01/05/2011"> -->
<!--               <input type="text" data-datepicker="datepicker" class="required date hasDatepicker focusField" id="date1"> -->
                    <input type="text" class="span2" value="2012-01-01" data-date-format="yyyy-mm-dd" id="dateNassance" name="datenaissance" >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="select01">Droit d'utilisateur</label>
          <div class="controls">
              <select name="type_user" id="type_user">
                <option value="2">Utilisateur Normal</option>
                <option value="1">Manager</option>
              </select>
            </div>
            </div>
           <div class="control-group">
            <label class="control-label" for="pays">Pays</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="pays" name="pays" minlength="3" >
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="email">Adresse mail</label>
            <div class="controls">
              <input type="text" class="input-xlarge required email" id="email" name="email">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label " for="phone">Téléphone</label>
            <div class="controls">
              <input type="text" class="input-xlarge" id="phone" name="numero">
            </div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Ajouter</button>
            <a class="btn btn-danger" href="travel_expensive.php" >Cancel</a>
          </div>
        </fieldset>
      </form>
</div>

</div>