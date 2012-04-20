<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/scripts_function.php";

?>
<div>
         
         <?php 
         if(($_GET['livreraport']=='success')&&(!empty($_GET['id_report']))&&(!empty($_GET['id_user']))):
         
          ?>
                       
                        <?php
                  
                        $id_user = $_GET['id_user'];
                        $info_user = get_infos_user($id_user);
                        
                        $id_exp = $_GET['id_report'];
                        $inforeport=get_report($id_exp);
                     
                        ?>
        <div id="reportstep2" class="<?php echo $inforeport['id_report'];?>" >
        <div class="span8">
        <div class="page-header">
        <h1>TRAITEMENT DU REPORT</h1>
        </div>
        <div class="page-header well" ">
                <div class="row">
                <div class="span8">
                  <h2>SAGE  SA</h2>
                <div class="row">
                <div class="span4">
                <strong>Code Mission: </strong> <?php echo $inforeport['code_mission']; ?> </br>
                <strong> Date d'envoie au caire: </strong> <?php echo $inforeport['Datedevalidation']; ?> </br>
                <strong> Date de livraison: </strong> <?php echo $inforeport['Dateremboursement']; ?> </br>
                </div> 
                <div class="span4">
                <strong>Nom: </strong> <?php echo $inforeport['nom']; ?> </br>
                
                <strong>Demandeur: </strong> <?php echo $info_user['prenom'].' '.$info_user['nom']; ?> </br>
                <strong> Date de la demande: </strong> <?php echo $inforeport['datereport']; ?>
                </div>
                </div>
                </div>
                </div>
                
        </div>
        <?php
       if($inforeport['justificatif']==''){ 
      
        echo '<p>Absense de justificatif</p>';
      }else{
          
         echo '<p><a class="btn btn-success" href="'.$inforeport['justificatif'].'" target="_blank"><i class="icon-arrow-down icon-white"></i>Télécharger le justilicatif</a></p>';
       }
      ?>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>N</th>
            <th>Date of voucher</th>
            <th>Nature of expense</th>
            <th>Amount</th>
            <th>Currency</th>
            <th style="width : 15%">Modif</th>
          </tr>
        </thead>
        <tbody>
        <?php
              $Resultat = mysql_query("SELECT * FROM Expenses WHERE id_report='$id_exp' AND id_utilisateur='$id_user'");
              $rows= mysql_num_rows($Resultat);
              $i=0;
              if($rows!=0){
              while($array = mysql_fetch_array($Resultat)){
                     
                     $exptype= get_exptype($array['typeexpense']);
                     $currency=get_currency($array['typemonnaie']);
  
                 echo '<tr>'
                    .'<td>'.$i.'</td>'
                    .'<td>'.$array['dateexpense'].'</td>'
                    .'<td>'.$exptype['code'].'-'.$exptype['nom'].'</td>'
                    .'<td>'.$array['amount'].'</td>'
                    .'<td>'.$currency['ISO_Code'].'-'.$currency['currency'].'</td>'
                     .'<td id="'.$inforeport['id_report'].'">'
                .'<div class="btn-group" id="'.$array['id_expenses'].'">';
//                 .'<a class="btn" href="travel_expensive.php?modifexpense&id_report='.$inforeport['id_report'].'&id_expenses='.$array['id_expenses'].'" ><i class="icon-pencil"></i></a>'
                       if($array['statue_item']==3){
                       echo '<span class="label label-success">A été validé</span>';
                        }
                       if($array['statue_item']==2){
                       echo '<span class="label label-important">A été suprimé</span>';
                        }
                        if($array['statue_item']==1){
                       echo '<span class="label label-inverse">En attente</span>';
                        }
                        
                echo '</div>'
             .'</td>'
          .'</tr>';
          $i++;
           }
          }else{
          
          }
          ?>
        </tbody>
      </table>
      <div class="well">
       <strong>Commentaire : </strong> <br>
       <?php
               echo $inforeport['commentaires'];
       ?>
      </div>
        <div class="form-actions">
        <a class="btn btn-primary" id="valid_report_vivre">Livrer</a>
        <a class="btn btn-danger" href="travel_expensive.php?travel_encour=2" >Annuler</a>
        </div>
    </div>
    </div>
          <?php 
          else:
          ?>
                  <h2>Erreur</h2>
                  <a class="btn btn-danger" href="travel_expensive.php" >Quitter</a>
          <?php 
          endif;
          ?>
</div>