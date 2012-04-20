<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: ../connexion.php'); 
        exit(); 
}
?>
<h1>New Repport</h1>
<div id="ajoute_user" > 
<form class="form-horizontal" method="POST" id='reportstep1'>
        <fieldset>
           <div class="control-group">
            <label class="control-label" for="nom">Titre</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="nom" name="nomreport" minlength="4">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="nom">Code Mission</label>
            <div class="controls">
              <input type="text" class="input-xlarge required" id="nom" name="codemission" minlength="3">
            </div>
          </div>
          
          <div class="form-actions">
            <button type="submit"  class="btn btn-primary">Ajouter</button>
            <a class="btn btn-danger" href="travel_expensive.php" >Cancel</a>
          </div>
        </fieldset>
</div>
</div>
