<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/scripts_function.php";
require "config/script_lpo.php";
?>
<div class="container">
<div class="page-header">
        <h1>COMMANDES EN COURS</h1>
</div>
<?php
         
      if(empty($_GET['lpo_encour'])):  
?>

<div class="page-header">
        <h3>TOUT LES COMMANDES</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Numero Commande</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
            <th>Traitement</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  commande ORDER BY   datecreer DESC");
         while($array = mysql_fetch_array($Resultat)){
         if($array['etat']==1){
         $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-error">'
           .' <td> N&ordm '.$array['id_commande'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datecreer'].'</td>'
           .' <td>'.$array['numbon'].'</td>'
            
            .'<td style="text-align: center;">'
             
             .'<span class="label label-inverse" >Non traiter</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-danger" id="'.$array['id_commande'].'" href="lpo_manager.php?traitercommande=success&id_user='.$array['id_utilisateur'].'&id_commande='.$array['id_commande'].'">Traiter</a>'
            .'</td>'
          .'</tr>';
          }
          if($array['etat']==2){
          $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-info">'
           .' <td> N&ordm '.$array['id_commande'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datecreer'].'</td>'
           .' <td>'.$array['numbon'].'</td>'
            
            .'<td style="text-align: center;">'
             
             
             .'<span class="label  label-warning" >Au caire</span>'       
            .'</td>'
            .'<td>'
            .'<a class="btn btn-info" id="'.$array['id_commande'].'" href="lpo_manager.php?livrercommande=success&id_user='.$array['id_utilisateur'].'&id_commande='.$array['id_commande'].'">Livrez</a>'
            .'</td>'
          .'</tr>';
          }
          if($array['etat']==3){
          $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-success">'
           .' <td> N&ordm '.$array['id_commande'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datecreer'].'</td>'
           .' <td>'.$array['numbon'].'</td>'
            
            .'<td style="text-align: center;">'
             
            .'<span class="label label-success">Au caire</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-success" id="'.$array['id_commande'].'" href="lpo_manager.php?viewcommande=success&id_user='.$array['id_utilisateur'].'&id_commande='.$array['id_commande'].'">Voir</a>'
            .'</td>'
          .'</tr>';
          }
          }
          ?>
        </tbody>
      </table>
   </div>
 <?php
         
      elseif($_GET['lpo_encour']==1):  
 ?>

<div class="page-header">
        <h3>COMMANDES NON TRAITER</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Numero Commande</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
            <th>Traitement</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  commande WHERE etat='1' ORDER BY  datecreer DESC");
         while($array = mysql_fetch_array($Resultat)){
         $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-error">'
           .' <td>'.$array['id_commande'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datecreer'].'</td>'
           .' <td>'.$array['numbon'].'</td>'
            
            .'<td style="text-align: center;">'
             
             .'<span class="label label-inverse" >Non traiter</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-danger" id="'.$array['id_commande'].'" href="lpo_manager.php?traitercommande=success&id_user='.$array['id_utilisateur'].'&id_commande='.$array['id_commande'].'">Traiter</a>'
            .'</td>'
          .'</tr>';
          }
          ?>
        </tbody>
      </table>
   </div>

 <?php
         
      elseif($_GET['lpo_encour']==2):  
 ?>
 
<div class="page-header">
        <h3>COMMANDES AU CAIRE</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Numero Commande</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
            <th>Traitement</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  commande WHERE etat='2' ORDER BY  datecreer DESC");
         while($array = mysql_fetch_array($Resultat)){
         $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-info">'
           .' <td>'.$array['id_commande'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datecreer'].'</td>'
           .' <td>'.$array['numbon'].'</td>'
            .'<td style="text-align: center;">'
             
             
             .'<span class="label  label-warning" >Au caire</span>'       
            .'</td>'
            .'<td>'
            .'<a class="btn btn-info" id="'.$array['id_commande'].'" href="lpo_manager.php?livrercommande=success&id_user='.$array['id_utilisateur'].'&id_commande='.$array['id_commande'].'">Livrez</a>'
            .'</td>'
          .'</tr>';
          }
          ?>
        </tbody>
      </table>
   </div>
 
  <?php
         
      elseif($_GET['lpo_encour']==3):  
 ?>
 
<div class="page-header">
        <h3>COMMANDES VALIDER</h3>
</div>

<table class="table table-bordered">
        <thead>
          <tr>
            <th>Numero Commande</th>
            <th>Demander</th>
            <th>Date</th>
            <th>Mission</th>
            <th>Etat</th>
            <th>Traitement</th>
          </tr>
        </thead>
        <tbody>
        <?php
        $Resultat = mysql_query("SELECT * FROM  commande WHERE etat='3' ORDER BY  datecreer DESC");
         while($array = mysql_fetch_array($Resultat)){
        
          $info_user = get_infos_user($array['id_utilisateur']);
          echo '<tr class="alert-success">'
           .' <td>'.$array['id_commande'].'</td>'
           .'<td>'.$info_user['prenom'].' '.$info_user['nom'].'</td>'
            .'<td>'.$array['datecreer'].'</td>'
           .' <td>'.$array['numbon'].'</td>'
            .'<td style="text-align: center;">'

            .'<span class="label label-success">Au caire</span>'
            .'</td>'
             .'<td>'
            .'<a class="btn btn-success" id="'.$array['id_commande'].'" href="lpo_manager.php?viewcommande=success&id_user='.$array['id_utilisateur'].'&id_commande='.$array['id_commande'].'">Voir</a>'
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