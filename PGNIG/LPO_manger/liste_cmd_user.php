<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/scripts_function.php";
require "config/script_lpo.php"
?>
<div class="container">
<h1>Tout les Commandes</h1>
        <p> </p>

  <div class="row-fluid">
    <div class="span4">
        <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
        <?php
        $id_user = $_COOKIE['id_utilisateur'];
        $info_user = get_infos_user($id_user);
        $Resultat = mysql_query("SELECT * FROM  commande WHERE id_utilisateur='$id_user' ORDER BY  datecreer DESC ");
        
        $rows= mysql_num_rows($Resultat);
        $i=$rows;
        if($rows!=0){
                 while($array = mysql_fetch_array($Resultat)){
                 
                 if($array['etat']==1){
                  echo '<li class="span4 alert-error"><a href="#R'.$array['id_commande'].'" data-toggle="tab"><span class="label label-important"> Non Traiter</span>'.$array['datecreer'].'<em id="nomListecommande">Cmd N&ordm; :'.$array['id_commande'].'</em></a></li>';
                  }
                  if($array['etat']==2){
                  echo '<li class="span4 alert-info"><a href="#R'.$array['id_commande'].'" data-toggle="tab"><span class="label label-warning">Au caire</span>'.$array['datecreer'].'<em id="nomListecommande">Cmd N&ordm; :'.$array['id_commande'].'</em></a></li>';
                  }
                  if($array['etat']==3){
                  echo '<li class="span4 alert-success"><a href="#R'.$array['id_commande'].'" data-toggle="tab"><span class="label label-success">Valider</span>'.$array['datecreer'].'<em id="nomListecommande">Cmd N&ordm; :'.$array['id_commande'].'</em></a></li>';
                  }
                $i--;
                }
             }
        ?>
        </ul>
        </div>
    </div>
     <div class="span8">
      <div class="tab-content">
          <?php
        $id_user = $_COOKIE['id_utilisateur'];
        $Resultat = mysql_query("SELECT * FROM  commande WHERE id_utilisateur='$id_user' ORDER BY  datecreer DESC");
        
        $rows= mysql_num_rows($Resultat);
        $i=0;
        if($rows!=0){
        while($array = mysql_fetch_array($Resultat)){
        
          echo '<div class="tab-pane" id="R'.$array['id_commande'].'">';
          
          echo '<div class="page-header well" ">'
                .'<div class="row">'
                .'<div class="span8">'
                  .'<h2>Compagnie Generale de Geophysique</h2>'
                .'<div class="row">'
                .'<div class="span4">'
                .'<strong> Numero Commande: </strong> '.$array['id_commande'].'</br>'
                .'<strong> Date d\'envoie au caire: </strong>'.$array['date_caire'].'</br>'
                .'<strong> Date de livraison: </strong>'.$array['date_livraison'].'</br>'
                .'</div> '
                .'<div class="span4">'
                .'<strong> Code Mission </strong>'.$array['numbon'].' </br>'
                .'<strong>Demandeur: </strong>'.$info_user['prenom'].' '.$info_user['nom'].' </br>'
                .'<strong> Date : </strong>'.$array['datecreer'].' </br>'
                .'</div>'
                .'</div>'
                .'</div>'
                .'</div>'
                
        .'</div>';
     // if($array['justificatif']==''){ 
       // echo '<p>Absence de justificatif!</p>';
      //}else{
          
       //  echo '<p id="'.$array['id_report'].'"><a class="btn btn-success" href="'.$array['justificatif'].'" target="_blank"><i class=" icon-arrow-down icon-white"></i>Télécharger le justilicatif</a><a class="btn btn-info" href="#" id="Extrare_excel"><i class=" icon-arrow-down icon-white"></i>Report En EXCEL</a></p>';
      // }
      echo '<table class="table table-bordered">'
        .'<thead>'
          .'<tr>'
            .'<th>Item</th>'
            .'<th>Intitulé</th>'
            .'<th>Quantité</th>'
            .'<th>Unité</th>'
            .'<th>Prix</th>'
            .'<th>Etat item</th>'
          .'</tr>'
       .' </thead>'
        .'<tbody>';
              $id_tmp =$array['id_commande'];
              $NumItem = 1;
              $ItemCommande = getAllArticleCommande($id_tmp);
               
                for ($i=0; $i <count($ItemCommande) ; $i++) { 
                   echo '<tr>'
                    .'<td>'.$NumItem.'</td>'
                    .'<td>'.$ItemCommande[$i]['intitule'].'</td>'
                    .'<td>'.$ItemCommande[$i]['quantite'].'</td>'
                    .'<td>'.$ItemCommande[$i]['unite'].'</td>'
                    .'<td>'.prix($ItemCommande[$i]['prix']).'</td>'
                     .'<td>';
                     
                     if($array['etat']==2 || $array['etat']==3){
                        if($ItemCommande[$i]['etat']==3){
                        echo '<span class="label label-success">Valider</span>';
                             }
                          if($ItemCommande[$i]['etat']==2){
                        echo '<span class="label label-important">Supprimer</span>';
                             }
                           if($ItemCommande[$i]['etat']==1){
                        echo '<span class="label label-inverse">En attente</span>';
                             }
                           }
                           else{
                           echo '<span class="label">Expenses en attente</span>';
                           }
                     echo '</td>'
                  .'</tr>';
                    $NumItem++;
                }
              
             
          echo '</tbody>'
      .'</table>'
      .'<div class="well">'
       .'<strong>Commentaire : </strong> <br>'.
       
           $array['raison_modif']
       
      .'</div>'
      
      
      
  .'</div>';
  
  
           } 
           }
           ?> 
      </div>
  </div>
    </div>
  </div>
</div>


