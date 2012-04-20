<?php
session_start();
ini_set("« url_rewriter.tags », »" );
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/scripts_function.php";
require "config/script_lpo.php";

?>
<div>
         
         <?php 
         if(($_GET['traitercommande']=='success')&&(!empty($_GET['id_commande']))&&(!empty($_GET['id_user']))):
         
          ?>
                       
                        <?php
                  
                        $id_user = $_GET['id_user'];
                        $info_user = get_infos_user($id_user);
                        
                        $id_exp = $_GET['id_commande'];
                        $inforeport=getInfocommande($id_exp);
                     
                        ?>
        <div id="reportstep2" class="<?php echo $id_exp;?>" >
        <div class="span8">
        <div class="page-header">
        <h1>TRAITEMENT DU REPORT</h1>
        </div>
        <div class="page-header well">
                <div class="row">
                <div class="span8">
                  <h2>Compagnie Generale de Geophysique</h2>
                <div class="row">
                <div class="span4">
                <strong>Code Mission: </strong> <?php echo $inforeport['numbon']; ?> </br>
                <strong> Date d'envoie au caire: </strong> <?php echo $inforeport['date_caire']; ?> </br>
                <strong> Date de livraison: </strong> <?php echo $inforeport['date_livraison']; ?> </br>
                </div> 
                <div class="span4">
                <strong>Numero Commande: </strong> <?php echo $id_exp; ?> </br>
                
                <strong>Demandeur: </strong> <?php echo $info_user['prenom'].' '.$info_user['nom']; ?> </br>
                <strong> Date de la demande: </strong> <?php echo $inforeport['datecreer']; ?>
                </div>
                </div>
                </div>
                </div>
                
        </div>
        <?php
       if($inforeport['justificatif']==''){ 
      
        echo '<p>Absense de justificatif</p>';
      }else{
          
         echo '<p><a class="btn btn-success" href="'.$inforeport['justificatif'].'" target="_blank"><i class=" icon-arrow-down icon-white"></i>Télécharger le justilicatif</a></p>';
       }
      ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Item</th>
            <th>Intitulé</th>
            <th>Quantité</th>
            <th>Unité</th>
            <th>Prix</th>
            <th style="width : 15%">Modif</th>
          </tr>
        </thead>
        <tbody>
        <?php
              $id_tmp =$id_exp;
              $gere_item;
              $NumItem = 1;
              $ItemCommande = getAllArticleCommande($id_tmp);
               
                for ($i=0; $i <count($ItemCommande) ; $i++) { 
                  $gere_item[$i]['id_article']=$ItemCommande[$i]['id_article'];
                  $gere_item[$i]['item']=$NumItem;
                   echo '<tr>'
                    .'<td>'.$NumItem.'</td>'
                    .'<td>'.$ItemCommande[$i]['intitule'].'</td>'
                    .'<td>'.$ItemCommande[$i]['quantite'].'</td>'
                    .'<td>'.$ItemCommande[$i]['unite'].'</td>'
                    .'<td >'.prix($ItemCommande[$i]['prix']).'</td>'
                     .'<td width="20%">'
                     .'<div class="btn-group" id="'.$ItemCommande[$i]['id_article'].'">';
                       if($ItemCommande[$i]['etat']==4){
                       echo '<span class="label label-warning">A été modifié</span>';
                        } 
                       if($ItemCommande[$i]['etat']==3){
                       echo '<span class="label label-success">A été validé</span>';
                        }
                       if($ItemCommande[$i]['etat']==2){
                       echo '<span class="label label-important">A été suprimé</span>';
                        }
                      if($ItemCommande[$i]['etat']==0){
                        echo ' <a class="btn btn-success" id="valideItem_mg" ><i class="icon-ok"></i></a>';
                        echo '<a class="btn" href="lpo_manager.php?modifcomande&id_commande='.$id_tmp.'&id_article='.$ItemCommande[$i]['id_article'].'" ><i class="icon-pencil"></i></a>';
                        echo ' <a class="btn btn-danger" id="effaceItem_mg" ><i class="icon-trash"></i></a>';

                        }


                     echo '</td>'
                  .'</tr>';
                    $NumItem++;
                   }

          ?>
        </tbody>
      </table>
      <div class="page-header">
        <h4>Anciens valeur des items modifié</h4>
      </div>
      <div id="saveitem" class="well">
        <table class="table table-bordered">
          <thead>
          <tr>
            <th>Item</th>
            <th>Intitulé</th>
            <th>Quantité</th>
            <th>Unité</th>
            <th>Prix</th>
            <th style="width : 15%">Information</th>
          </tr>
        </thead>
            <?php
              
              $sql1 = mysql_query("SELECT * FROM article_commande_save, article, commande, unite WHERE article_commande_save.id_commande='$id_exp' AND article_commande_save.id_article = article.id_intituler AND article_commande_save.id_commande= commande.id_commande AND article.unit_mesure=unite.id_unit");
              $i = 0;
            while ($reponse1 = mysql_fetch_array($sql1)) {

              for ($i=0; $i <count($gere_item) ; $i++) { 
                if ($gere_item[$i]['id_article']==$reponse1['id_intituler']) {
                  $Itemsave = $gere_item[$i]['item'];
                }
              }
                

              echo '<tr><td> <span class="badge badge-warning">'.$Itemsave.'</span></td>'.
                    '<td>'.$reponse1['titre'].'</td>'.
                   '<td>'. $reponse1['quantite'].'</td>'.
                    '<td>'.$reponse1['nom_unit'].'</td>'.
                    '<td>'.prix($reponse1['prix_article']).'</td>';
                    if($reponse1['etat_item']==4){
                       echo '<td><span class="label label-inverse">Version modifiaction</span></td>';
                        } 
                      echo '</tr>';            
            }
             
            

            ?>
          
        </table>
      </div>

      <div class="control-group">
            <label class="control-label" for="textarea">Commentaire</label>
            <div class="controls">
              <textarea class="input-xlarge" id="commentaire" rows="3" style="margin-left: 0px; margin-right: 0px; width: 269px; margin-top: 0px; margin-bottom: 0px; height: 59px; "></textarea>
            </div>
          </div>
      
        <div class="form-actions">
        <a class="btn btn-primary" id="valid_report_caire">Envoyer au Caire</a>
        <a class="btn btn-danger" href="lpo_manager.php?travel_encour=1" >Annuler</a>
        </div>
    </div>
    </div>
          <?php 
          else:
          ?>
                  <h2>Erreur</h2>
                  <a class="btn btn-danger" href="lpo_manager.php" >Quitter</a>
          <?php 
          endif;
          ?>
</div>