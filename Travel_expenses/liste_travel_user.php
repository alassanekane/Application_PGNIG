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
<div class="container">
<h1>Reports en cours</h1>
        <p> </p>

  <div class="row-fluid">
    <div class="span4">
        <div class="tabbable tabs-left">
        <ul class="nav nav-tabs">
        <?php
        $id_user = $_COOKIE['id_utilisateur'];
        $info_user = get_infos_user($id_user);
        $Resultat = mysql_query("SELECT * FROM  Espreport WHERE id_utilisateur='$id_user' ORDER BY  datereport DESC ");
        
        $rows= mysql_num_rows($Resultat);
        $i=0;
        if($rows!=0){
                 while($array = mysql_fetch_array($Resultat)){
                 
                 if($array['statue_report']==1){
                  echo '<li class="span4 alert-error"><a href="#R'.$array['id_report'].'" data-toggle="tab"><span class="label label-important"> Non Traiter</span>'.' '.$array['nom'].' '.$array['datereport'].'</a></li>';
                  }
                  if($array['statue_report']==2){
                  echo '<li class="span4 alert-info"><a href="#R'.$array['id_report'].'" data-toggle="tab"><span class="label label-warning">Au caire</span>'.' '.$array['nom'].' '.$array['datereport'].'</a></li>';
                  }
                  if($array['statue_report']==3){
                  echo '<li class="span4 alert-success"><a href="#R'.$array['id_report'].'" data-toggle="tab"><span class="label label-success">Valider</span>'.' '.$array['nom'].' '.$array['datereport'].'</a></li>';
                  }
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
        $Resultat = mysql_query("SELECT * FROM  Espreport WHERE id_utilisateur='$id_user' ORDER BY  datereport DESC");
        
        $rows= mysql_num_rows($Resultat);
        $i=0;
        if($rows!=0){
        while($array = mysql_fetch_array($Resultat)){
        
          echo '<div class="tab-pane" id="R'.$array['id_report'].'">';
          
          echo '<div class="page-header well" ">'
                .'<div class="row">'
                .'<div class="span8">'
                  .'<h2>SAGE  SA</h2>'
                .'<div class="row">'
                .'<div class="span4">'
                .'<strong>Code Mission: </strong> '.$array['num_mission'].'</br>'
                .'<strong> Date d\'envoie au caire: </strong>'.$array['Datedevalidation'].'</br>'
                .'<strong> Date de livraison: </strong>'.$array['Dateremboursement'].'</br>'
                .'</div> '
                .'<div class="span4">'
                .'<strong>Nom: </strong> '.$array['nom'].'</br>'
                .'<strong>Demandeur: </strong>'.$info_user['prenom'].' '.$info_user['nom'].' </br>'
                .'<strong> Date : </strong>'.$array['datereport'].' </br>'
                .'</div>'
                .'</div>'
                .'</div>'
                .'</div>'
                
        .'</div>';
      if($array['justificatif']==''){ 
        echo '<p>Absence de justificatif!</p>';
      }else{
          
         echo '<p id="'.$array['id_report'].'"><a class="btn btn-success" href="'.$array['justificatif'].'" target="_blank"><i class=" icon-arrow-down icon-white"></i>Télécharger le justilicatif</a><a class="btn btn-info" href="#" id="Extrare_excel"><i class=" icon-arrow-down icon-white"></i>Report En EXCEL</a></p>';
       }
      echo '<table class="table table-bordered">'
        .'<thead>'
          .'<tr>'
            .'<th>N</th>'
            .'<th>Date of voucher</th>'
            .'<th>Nature of expense</th>'
            .'<th>Amount</th>'
            .'<th>Currency</th>'
            .'<th >Etat item</th>'
          .'</tr>'
       .' </thead>'
        .'<tbody>';
             $id_tmp =$array['id_report'];
              $Resultat2= mysql_query("SELECT * FROM Expenses WHERE id_report='$id_tmp' AND id_utilisateur='$id_user'");
              $rows1= mysql_num_rows($Resultat2);
              $i=1;
              if($rows1!=0){
              while($array2 = mysql_fetch_array($Resultat2)){
                     
                     $exptype2= get_exptype($array2['typeexpense']);
                     $currency2=get_currency($array2['typemonnaie']);
  
                 echo '<tr>'
                    .'<td>'.$i.'</td>'
                    .'<td>'.$array2['dateexpense'].'</td>'
                    .'<td>'.$exptype2['code'].'-'.$exptype2['nom'].'</td>'
                    .'<td>'.$array2['amount'].'</td>'
                    .'<td>'.$currency2['ISO_Code'].'-'.$currency2['currency'].'</td>'
                     .'<td>';
                     
                     if($array['statue_report']==2 || $array['statue_report']==3){
                        if($array2['statue_item']==3){
                        echo '<span class="label label-success">Valider</span>';
                             }
                          if($array2['statue_item']==2){
                        echo '<span class="label label-important">Supprimer</span>';
                             }
                           if($array2['statue_item']==1){
                        echo '<span class="label label-inverse">En attente</span>';
                             }
                           }
                           else{
                           echo '<span class="label">Expenses en attente</span>';
                           }
                     echo '</td>'
                  .'</tr>';
          $i++;
           }
            
            
           }
          echo '</tbody>'
      .'</table>'
      .'<div class="well">'
       .'<strong>Commentaire : </strong> <br>'.
       
           $array['commentaires']
       
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


