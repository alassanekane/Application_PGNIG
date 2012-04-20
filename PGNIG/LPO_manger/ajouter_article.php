<div id="ajouter_article">
        <form class="form-horizontal" id="article" method="POST" action="config/ajax_lpo_big.php" >
        <fieldset>
        <h1>Ajouter un article</h1>
        <div id="Info_form">
       <!-- <div class="alert fade in">
            <a class="close" data-dismiss="alert" href="#">×</a>
            <strong>Holy guacamole!</strong> Best check yo self, you're not looking too good.
         </div> -->
        </div>
        <input type="text" id="titre" class="input vert" placeholder="Intitulé">
        <textarea name="description" class="input orange" id="textarea" rows="3" placeholder="Description"></textarea>
        <label>Unité de mesure 
            <select name="unit_mesure" id="unit">
                             
            </select>
        </label>
           <label> 
        		Autre unité <input id="diff_unite" name="autre_unite" type="checkbox" value="Diff_unite">
        	</label>
			<br>
			 <label id="lab_plus_unite"> 
        		
        	</label>
          <br>
        <textarea class="input vert" name='tags' id="tags" rows="3"></textarea>
         
        <label class="control-label" for="fileInput">Charger une photo</label>
        <div id="file-charger">
        <input class="input-file" id="fileInputtof" name="photo" type="file">
        </br>
        </br>
        </div>
       
       <!--  <div id="file-uploader">		
		<noscript>			
			<p>Please enable JavaScript to use file uploader.</p>
			 or put a simple form for upload here
		</noscript>         
	</div> -->

        <button type="submit" name="action" value="ajouteruser" id="ajout_article" class="btn btn-success" > Ajouter l'article</button> 
        <button type="reset" id="Annuler" class="btn btn-danger" > Annuler</button>
        </fieldset>
      </form>
</div>
