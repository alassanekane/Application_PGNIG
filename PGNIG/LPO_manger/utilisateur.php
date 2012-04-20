<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
        
}
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/script_lpo.php";
?>

   <div id="main" class="row">

        <div id="search" class="span8">
      <div id="catalogue-search" class="input-append">
        <div class="form-search">
        <input type="text" id="rech" name="search" class="input-medium search-query" placeholder="Chercher un item dans le catalogue" >
        
        <button class="btn btn-large" id="btnsearch">Search</button>
        <button class="btn btn-success btn-large" onClick="location.href='lpo_manager.php?creer_article&pass1&step=0'" id="aftersearch">Add Article</button>
        
      </div>
       <!--  <input type="text" name="search" id="rech" placeholder="Chercher un item dans le catalogue" >
                <span class="add-on" ><i class="icon-search"></i><a href="#"> Search</a></span>
                <a class="btn btn-success" href="ajouter_article.php" id="aftersearch"><i class="icon-shopping-cart icon-white"></i>Ajouter un article</a>
           -->      
      </div>

      <div class="catalogue  row" id="resultat_serch">
          <div class="span8"> 
                    <table id="cat" class="catalogue-item table">
            <!--Affichage des resultats de la recherche -->    
                    </table>
          </div>  
                   
   
      </div>
      
            </div>
           
            <div id="basket" class="span4">
            <div class="label label-info labelcmd well"><h3>Commande en cours</h3></div>
            <div class="cmd_en_cour" id="actualise">
               <table class="table" id="verifieSiCommande">
               <tr class = "table-bordered">
                <td>Photo</td>
                <td>Intituté</td>
                <td>quantité</td>
                <td>Unité</td>
                <td>Supp</td>
               </tr>
                <?php
                $i=0;
                $livecommand = getlivecommande();
                for ($i=0; $i < count($livecommand) ; $i++) { 
                  $thisarticle = get_detail_article($livecommand[$i]['id_article']);
                  $thisunit = getunit3($thisarticle['unit_mesure']);
                  echo '<tr id="cmd-'.$livecommand[$i]['id_article'].'">'
                        .'<td>'.$i.'</td>'
                        .'<td>'.$thisarticle['titre'].'</td>'
                        .'<td>'.$livecommand[$i]['quantite'].'</td>'
                        .'<td>'.$thisunit.'</td>'
                        .'<td><a class="btn btn-danger remove" href="#"><i class="icon-trash icon-white"></i></a></td>'
                        .'</tr>';

                }
                ?>
                </table>
            </div>
             <div class="validation well"> 
             <a class="btn btn-success" href="#" id="commander" data-toggle="modal"><i class="icon-shopping-cart icon-white"></i>Valider</a>
             <a class="btn btn-danger" href="#" id="annuler"><i class="icon-remove icon-white"></i>Annuler</a>
             </div>
             <div id="erroaffiche" style="display:none;">

             </div>
               
    </div>     
                
  </div>

<div class="modal" id="myModal" style="display: none; ">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Commande Envoyée</h3>
  </div>
  <div class="modal-body">
    <p>Votre commande a bien été enrégistrer! Vous pouvez aller dans les commandes ou passer une autre commande</p>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal">Continuez a commandé</a>
    <a href="commandes.php?c=true" class="btn btn-primary">Commande en cours</a>
  </div>
</div>


        <div id="myModalview" class="modal" style="display: none; ">
             <div class="modal-header">
             <a class="close" data-dismiss="modal">x</a>
             <h3>Detail de l'article</h3>
            </div>'
              <div class="modal-body">

             </div>
            <div class="modal-footer">
            <a href="#" class="btn" data-dismiss="modal">Close</a>
            </div>'
         




    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.gritter.min.js"></script>
        <script type="text/javascript">
        $(function(){
                
                $.extend($.gritter.options, {
                    class_name: 'gritter-light', // for light notifications (can be added directly to $.gritter.add too)
                    position: 'bottom-right', // possibilities: bottom-left, bottom-right, top-left, top-right
                        fade_in_speed: 100, // how fast notifications fade in (string or int)
                        fade_out_speed: 100, // how fast the notices fade out
                        time: 3000 // hang on the screen for...
                });
                
               var id_user = $('#cool').attr('class');
               
               var Arrays=new Array();
               $.ajax({
                       url: "config/ajax_function.php",
                       type: "POST",
                       data: '&action=notification'+'&id_user='+id_user,
                       success: function(message){
                                      
                                   //console.log(message); 
                                   Arrays = message.split(","); 
                                   //console.log(Arrays.length);
                                   var i=0;
                                   for(i=0;i<Arrays.length;i++){
                                   // console.log(Arrays[i]);

                                $.gritter.add({
                                // (string | mandatory) the heading of the notification
                             
                                title: 'Notification',
                                
                                text: Arrays[i],
                                // (string | optional) the image to display on the left
                                image: 'assets/images/notification3.png',
                                // (bool | optional) if you want it to fade out on its own or just sit there
                                sticky: true,
                                // (int | optional) the time you want it to be alive for before fading out
                                time: '',
                                // (string | optional) the class name you want to apply to that specific message
                                class_name: 'my-sticky-class'
                                  });

                                   }
                       
                               
                       } 
                
                });
                 
               
                
                $('#gritter-notice-wrapper').find('.gritter-close').live('click', function(){
                        
                      
                       var vue= $(this).next().next('div .gritter-with-image').children('p:eq(1)').attr('id');
                      
                      $.ajax({
                       url: "config/ajax_function.php",
                       type: "POST",
                       data: '&action=notification_vue'+'&id_notification='+vue,
                       success: function(message){
                                console.log(message);
                       }
                     });
                
                });
                 window.setTimeout('location.reload()', 300000);
               
                
        });       
        </script>
        

        </div>
        
        
  </div>
</div>
</div>