
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
         if(($_GET['pass1']=='success')&&(!empty($_GET['step2']))):
         
          ?>
                       
                        <?php
                  
                        $id_user = $_COOKIE['id_utilisateur'];
                        $info_user = get_infos_user($id_user);
                        $id_exp = $_GET['step2'];
                        $inforeport=get_report($id_exp);
                     
                        ?>
         <div id="reportstep2" class="<?php echo $inforeport['id_report'];?>" >
         <div class="span8">
        <div class="page-header">
        <h1>NEW EXPENSE REPORT</h1>
        </div>
        <a class="btn btn-info" data-toggle="modal" href="#" id="infosaisi" ><i class=" icon-info-sign icon-white"></i>Info</a>
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
      <p><a class="btn btn-success" href="travel_expensive.php?reportencours&id_report=<?php echo $inforeport['id_report'];?>"><i class="icon-plus icon-white"></i>Add Expense</a></p>
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
              $i=1;
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
                .'<div class="btn-group" id="'.$array['id_expenses'].'">'
                .'<a class="btn" href="travel_expensive.php?modifexpense&id_report='.$inforeport['id_report'].'&id_expenses='.$array['id_expenses'].'" ><i class="icon-pencil"></i></a>'
               .' <a class="btn" id="effaceexpenses" ><i class="icon-trash"></i></a>'
                .'</div>'
             .'</td>'
          .'</tr>';
          $i++;
           }
          }else{
          
          }
          ?>
        </tbody>
      </table>
        <?php
                if($inforeport['justificatif']==''){
                echo '<p><a class="btn btn-success" href="travel_expensive.php?justificatif&just=0&id_report='.$inforeport['id_report'].'"><i class=" icon-arrow-up icon-white"></i>Charger le justificatif</a></p>';
                  }else{
                  echo 'Fichier bien charger';
                  echo '<p><a class="btn btn-success" href="travel_expensive.php?justificatif&just=0&id_report='.$inforeport['id_report'].'"><i class=" icon-arrow-up icon-white"></i>Remplacer</a></p>';
                  }
          ?>
        <div class="form-actions">
        <a type="submit" class="btn btn-primary" id="valid_report">Valider le report</a>
        <a class="btn btn-danger" id="cancelreport" >Annuler</a>
        </div>
        <!--<form id="justificatif" enctype="multipart/form-data">
            -->
    </div>
 
 <div class="modal" id="myAide" style="display: none; ">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Info </h3>
  </div>
  <div class="modal-body">
  <strong>How to fill in your expense report </strong>
    <p>
                                                                                                                                         
       <ol>
        <li>File your justificatives in chronological order </li>
        <li>Give them a chronological number </li>
        <li>Fill in the expense note, indicating the exact date and nature and put the amount in the appropriate currency column</li>
        <li>Add up each currency</li>
        <li>Have it signed and dated by your supervisor</li>
        <li>Indicate the company to be reinvoiced </li>
        <li>Send the expense report and vouchers forms </li>
        <li>Keep a copy for your files</li>
      </ol>                                                                                                                                                                                                                                                                    
     </p>                                                                                                                               
<strong>Comment remplir votre note de frais  </strong>
                                                                                                                                    
       <p> 
        <ol>                                                                                                                                
<li>Classer vos justificatifs par date croissante </li>                                                                                                                                                              
<li>Les numéroter chronologiquement</li>                                                                                      
<li>Remplir la note de frais en indiquant la date du justificatif et sa nature.   </li>                                                                                                                          
<li>Indiquer le montant de la dépense dans la colonne correspondant à la devise de la dépense</li>                                                                                                                               
<li>Faire le total par devise  </li>                                                                                                                             
<li>Signer et dater la note de frais    </li>                                                                                                                            
<li>Faire signer et dater par le supérieur </li>                                                                                                                         
<li>Indiquer la société qui doit être refacturée </li>                                                                                                                           
<li>Envoyer la note de frais    </li>                                                                                                                            
<li>Garder une copie pour vos dossiers </li> 
    </ol> 
    </p>
  
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