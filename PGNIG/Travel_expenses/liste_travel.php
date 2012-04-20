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
<div class="page-header">
        <h1>EXPENSE REPORT EN COURS</h1>
</div>
<?php
         
      if(empty($_GET['travel_encour'])):  
?>

<div class="page-header">
        <h3>TOUT LES EXPENSE REPORT</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
            <th>Traitement</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  Espreport ORDER BY   datereport, id_report DESC");
         while($array = mysql_fetch_array($Resultat)){
         if($array['statue_report']==1){
         $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-error">'
           .' <td>'.$array['nom'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datereport'].'</td>'
           .' <td>'.$array['num_mission'].'</td>'
            
            .'<td style="text-align: center;">'
             
             .'<span class="label label-inverse" >Non traiter</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-danger" id="'.$array['id_report'].'" href="travel_expensive.php?traiterraport=success&id_user='.$array['id_utilisateur'].'&id_report='.$array['id_report'].'">Traiter</a>'
            .'</td>'
          .'</tr>';
          }
          if($array['statue_report']==2){
          $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-info">'
           .' <td>'.$array['nom'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datereport'].'</td>'
           .' <td>'.$array['num_mission'].'</td>'
            
            .'<td style="text-align: center;">'
             
             
             .'<span class="label  label-warning" >Au caire</span>'       
            .'</td>'
            .'<td>'
            .'<a class="btn btn-info" id="'.$array['id_report'].'" href="travel_expensive.php?livreraport=success&id_user='.$array['id_utilisateur'].'&id_report='.$array['id_report'].'">Livrez</a>'
            .'</td>'
          .'</tr>';
          }
          if($array['statue_report']==3){
          $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-success">'
           .' <td>'.$array['nom'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datereport'].'</td>'
           .' <td>'.$array['num_mission'].'</td>'
            
            .'<td style="text-align: center;">'
             
            .'<span class="label label-success">Au caire</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-success" id="'.$array['id_report'].'" href="travel_expensive.php?viewreport=success&id_user='.$array['id_utilisateur'].'&id_report='.$array['id_report'].'">Voir</a>'
            .'</td>'
          .'</tr>';
          }
          }
          ?>
        </tbody>
      </table>
   </div>
 <?php
         
      elseif($_GET['travel_encour']==1):  
 ?>

<div class="page-header">
        <h3>EXPENSE REPORT NON TRAITER</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Titre</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
             <th>Traitement</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  Espreport WHERE statue_report='1' ORDER BY  datereport, id_report DESC");
         while($array = mysql_fetch_array($Resultat)){
         $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-error">'
           .' <td>'.$array['nom'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datereport'].'</td>'
           .' <td>'.$array['num_mission'].'</td>'
            
            .'<td style="text-align: center;">'
             
             .'<span class="label label-inverse" >Non traiter</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-danger" id="'.$array['id_report'].'" href="travel_expensive.php?traiterraport=success&id_user='.$array['id_utilisateur'].'&id_report='.$array['id_report'].'">Traiter</a>'
            .'</td>'
          .'</tr>';
          }
          ?>
        </tbody>
      </table>
   </div>

 <?php
         
      elseif($_GET['travel_encour']==2):  
 ?>
 
<div class="page-header">
        <h3>EXPENSE REPORT AU CAIRE</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  Espreport WHERE statue_report='2' ORDER BY  datereport DESC");
         while($array = mysql_fetch_array($Resultat)){
         $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-info">'
           .' <td>'.$array['nom'].'</td>'
            .'<td>'.$array['datereport'].'</td>'
           .' <td>'.$array['num_mission'].'</td>'
            .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td style="text-align: center;">'
             
             
             .'<span class="label  label-warning" >Au caire</span>'       
            .'</td>'
            .'<td>'
            .'<a class="btn btn-info" id="'.$array['id_report'].'" href="travel_expensive.php?livreraport=success&id_user='.$array['id_utilisateur'].'&id_report='.$array['id_report'].'">Livrez</a>'
            .'</td>'
          .'</tr>';
          }
          ?>
        </tbody>
      </table>
   </div>
 
  <?php
         
      elseif($_GET['travel_encour']==3):  
 ?>
 
<div class="page-header">
        <h3>EXPENSE REPORT VALIDER</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  Espreport WHERE statue_report='3' ORDER BY  datereport DESC");
         while($array = mysql_fetch_array($Resultat)){
         $info_user = get_infos_user($array['id_utilisateur']);
          $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-success">'
           .' <td>'.$array['nom'].'</td>'
            .'<td>'.$array['datereport'].'</td>'
           .' <td>'.$array['num_mission'].'</td>'
            .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td style="text-align: center;">'
             
            .'<span class="label label-success">Au caire</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-success" id="'.$array['id_report'].'" href="travel_expensive.php?viewreport=success&id_user='.$array['id_utilisateur'].'&id_report='.$array['id_report'].'">Voir</a>'
            .'</td>'
          .'</tr>';
          }
          ?>
        </tbody>
      </table>
   </div>
<?php
         
      elseif(isset($_GET['travel_encour'])):  
?>

<?php
         
     endif; 
?>