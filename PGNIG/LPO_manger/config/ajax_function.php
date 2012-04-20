<?php 
define('INCLUDE_CHECK',true);

require "connect_db.php";
require "scripts_function.php";

require "PHPexcel/Classes/PHPExcel.php";

switch($_POST['action']){
                
                case 'connexion':
                        connexion();
                        break;
                case 'ajouteuser':
                        ajouteuser();
                        break;
                case 'modifuser':
                        modifuser();
                        break;
                case 'effaceuser':
                        effaceuser();
                        break;        
                case 'creerreport':
                        creerreport();
                        break;
                case 'ajoutexpense':
                        ajoutexpense();
                        break;
                case 'modifxpense':
                        modifxpense();
                        break;
                case 'effaceexpenses':
                        effaceexpenses();
                        break;
                case 'effaceexpenses_mg':
                      effaceexpenses_mg();
                      break;
              case 'valideexpenses_mg':
                      valideexpenses_mg();
                      break;
                case 'cancelreport':
                        cancelreport();
                        break;
                case 'valid_report':
                        valid_report();
                        break;
                case 'valid_report_caire':
                        valid_report_caire();
                        break;
                case 'valid_report_vivre':
                        valid_report_vivre();
                        break;
                 case 'extraire_en_excel':
                        extraire_en_excel();
                        break;
                 case 'notification':
                         notification();
                         break;
                case 'notification_vue':
                         notification_vue();
                         break;
                default:
                        echo('Wrong action');
 }
 function connexion(){
        session_start();
        if(isset($_POST['login_champ']) && isset($_POST['pass_champ'])){
        
                        $login = $_POST['login_champ'] ;
                        $pass = $_POST['pass_champ'] ;

        if (verificationLogIn( $login, $pass ) ) {
        //On fait une requete pour chercher les information de notre utilisateur
                $sql = mysql_query("SELECT * ,count(*) as nbres FROM ComptesUtilisateur WHERE login = '$login' AND pass='$pass' ");
                $row = mysql_fetch_array($sql);
                
                if($row['nbres']==1) {
                // Définition du temps d'expiration des cookies (90jours)
                $expiration = time() + 90 * 24 * 60 * 60;

                // Création des cookies
                setcookie("id_utilisateur", $row['id_utilisateur'], $expiration, "/");
                setcookie("prenom", $row['prenom'], $expiration, "/");
                setcookie("nom", $row['nom'], $expiration, "/");      
                setcookie("type_utilisateur", $row['type_utilisateur'], $expiration, "/");         
                   echo 'success';
                  }
          
          
 }
 
 }
 }
function ajouteuser(){
if ( isset( $_POST['nom'] ) && isset ( $_POST['prenom']) &&  isset ( $_POST['email']) && isset ( $_POST['login'])&& isset ( $_POST['pass'])&&isset($_POST['datenaissance'])&&isset($_POST['pays'])&&isset($_POST['type_user'])){
                
         $numero = '';     
         $nom=$_POST['nom'];
         $prenom=$_POST['prenom']; // on recupere les données envoyée par le formulaire et on les stockes
         $email=$_POST['email'];
         if(isset ( $_POST['numero'])){
         $numero=$_POST['numero'];
         }
         $login = $_POST['login'];
         $pass = $_POST['pass'];
        $pays = $_POST['pays'];
         $type_user = $_POST['type_user'];
         $dep_use=0;
         if ($type_user==2) {
                 $dep_use=$_POST['type_departement'];
         }
         $datenaissance = $_POST['datenaissance'];
         if(veriflogin($login)){
                         
 $query=("INSERT INTO `Travel_expensive`.`ComptesUtilisateur` (`id_utilisateur`, `login`, `pass`, `prenom`, `nom`, `email`, `type_utilisateur`, `departement`,`pays`, `datenaissance`, `numero`) VALUES (NULL, '$login', '$pass', '$prenom', '$nom', '$email', '$type_user','$dep_use', '$pays', '$datenaissance', '$numero')");                       
                        $resultat=mysql_query($query);
                        $message = 'success';
                        echo $message;
                        
                }
        }
        

}

function modifuser(){

        if ( isset($_POST['id_user'])&&isset( $_POST['nom'] ) && isset ( $_POST['prenom']) &&  isset ( $_POST['email']) && isset ( $_POST['numero'])&& isset ( $_POST['login'])&& isset ( $_POST['pass'])&&isset($_POST['datenaissance'])&&isset($_POST['pays'])&&isset($_POST['type_user'])){
         $id_user=$_POST['id_user'];       
         $nom=$_POST['nom'];
         $prenom=$_POST['prenom']; // on recupere les données envoyée par le formulaire et on les stockes
         $email=$_POST['email'];
         $numero=$_POST['numero'];
         $login = $_POST['login'];
         $pass = $_POST['pass'];
        $pays = $_POST['pays'];
         $type_user = $_POST['type_user'];
         $datenaissance = $_POST['datenaissance'];
                               
                $sql = "UPDATE ComptesUtilisateur SET login='$login',pass='$pass', nom='$nom', prenom='$prenom', email='$email', type_utilisateur='$type_user', pays='$pays', datenaissance = '$datenaissance', numero='$numero' WHERE id_utilisateur = '$id_user'";
                $req = mysql_query($sql);
                 $message = 'success';
                        echo $message;
                
                
                
        }
}

function effaceuser(){
        if ( isset($_POST['id_user'])){
                $id=$_POST['id_user'];
                $query=("DELETE FROM ComptesUtilisateur WHERE id_utilisateur='$id'");
                $result = mysql_query($query);
                echo 'success';
        
        }
}
function creerreport(){
session_start();  
$id_utilisateur = $_COOKIE['id_utilisateur'];

        if(isset($_POST['nomreport'])&&isset($_POST['codemission'])){
        $nomreport = $_POST['nomreport'];
        $codemission = $_POST['codemission'];
        $date_report = date("Y-m-j");
        
        $query = ("INSERT INTO `Travel_expensive`.`Espreport` (`id_report`, `id_utilisateur`, `nom`, `datereport`, `commentaires`, `Datedevalidation`, `Dateremboursement`, `typerambourssement`, `num_mission`, `statue_report`) VALUES (NULL, '$id_utilisateur', '$nomreport', '$date_report',NULL,NULL,NULL,NULL,'$codemission','0')");
        $resultat=mysql_query($query);
        if($resultat){
        $message = 'success';
        $info=last_report_user($id_utilisateur);
        $id=$info['id_report'];
        echo 'travel_expensive.php?creer_travelstep1&pass1=success&step2='.$id; 
                
        }else{
        echo 'error';
        }
        }
}
function ajoutexpense(){
session_start();  
$id_utilisateur = $_COOKIE['id_utilisateur'];
        if(isset($_POST['dateexpense'])&&isset($_POST['type_expense'])&&isset($_POST['amount'])&&isset($_POST['type_currency'])&&isset($_POST['id_report'])){
        $dateexpense=$_POST['dateexpense'];
        $type_expense=$_POST['type_expense'];
        $type_currency=$_POST['type_currency'];
        $amount=$_POST['amount'];
        $id_report=$_POST['id_report'];
        
        $query=("INSERT INTO `Travel_expensive`.`Expenses` (`id_expenses`, `id_report`, `id_utilisateur`, `dateexpense`, `typeexpense`, `amount`, `statue_item`, `typemonnaie`, `justificatif`) VALUES (NULL, '$id_report', '$id_utilisateur', '$dateexpense', '$type_expense', '$amount', '0', '$type_currency', '');");
        $resultat=mysql_query($query);
        if($resultat){
        echo 'travel_expensive.php?creer_travelstep1&pass1=success&step2='.$id_report;
        }else{
         echo 'error';
        }
        }
}
function  modifxpense(){
session_start();  
$id_utilisateur = $_COOKIE['id_utilisateur'];
        if(isset($_POST['id_expenses'])&&isset($_POST['dateexpense'])&&isset($_POST['type_expense'])&&isset($_POST['amount'])&&isset($_POST['type_currency'])&&isset($_POST['id_report'])){
        $dateexpense=$_POST['dateexpense'];
        $type_expense=$_POST['type_expense'];
        $type_currency=$_POST['type_currency'];
        $amount=$_POST['amount'];
        $id_report=$_POST['id_report'];
        $id_expenses = $_POST['id_expenses'];
        
        $query="UPDATE Expenses SET dateexpense='$dateexpense', typeexpense='$type_expense', amount='$amount', typemonnaie='$type_currency' WHERE id_expenses='$id_expenses'";
        
        $resultat=mysql_query($query);
        if($resultat){
        echo 'travel_expensive.php?creer_travelstep1&pass1=success&step2='.$id_report;
        }else{
         echo 'error';
        }
        
 }
}
function effaceexpenses(){
        if (isset($_POST['id_expenses'])&&isset($_POST['id_report'])){
                $id=$_POST['id_expenses'];
                $id_report=$_POST['id_report'];
                $query="DELETE FROM Expenses WHERE id_expenses='$id'";
                $result = mysql_query($query);
                if($result){
                echo 'travel_expensive.php?creer_travelstep1&pass1=success&step2='.$id_report;
                
                }
        
        }
}
function effaceexpenses_mg(){
        if (isset($_POST['id_expenses'])&&isset($_POST['id_report'])){
                $id=$_POST['id_expenses'];
                $id_report=$_POST['id_report'];
                $info_user = get_report($id_report);
                $query="UPDATE Expenses SET statue_item='2' WHERE id_expenses='$id'";
//                 $query="DELETE FROM Expenses WHERE id_expenses='$id'";
                $result = mysql_query($query);
                if($result){
                echo 'travel_expensive.php?traiterraport=success&id_report='.$id_report.'&id_user='.$info_user['id_utilisateur'];
                
                }
        
        }
}
function valideexpenses_mg(){
        if (isset($_POST['id_expenses'])&&isset($_POST['id_report'])){
                $id=$_POST['id_expenses'];
                $id_report=$_POST['id_report'];
                $info_user = get_report($id_report);
                $query="UPDATE Expenses SET statue_item='3' WHERE id_expenses='$id'";
//                 $query="DELETE FROM Expenses WHERE id_expenses='$id'";
                $result = mysql_query($query);
                if($result){
                echo 'travel_expensive.php?traiterraport=success&id_report='.$id_report.'&id_user='.$info_user['id_utilisateur'];
                
                }
        
        }
}
function cancelreport(){
        if(isset($_POST['id_report'])){
                $id_report=$_POST['id_report'];
                
                $query="DELETE FROM Expenses WHERE id_report='$id_report'";
                $result = mysql_query($query);
                
                $query2 = "DELETE FROM Espreport WHERE id_report='$id_report'";
                $result2=  mysql_query($query2);
                
                if($result){
                 if($result2){
                        echo 'success';
                }else{
                echo 'error';
                }       
                }else{
                echo 'error';
                }
        }
}
function valid_report(){
         if(isset($_POST['id_report'])){
         $id_report=$_POST['id_report'];
         
         
         $query="UPDATE Expenses SET statue_item='1' WHERE id_report='$id_report'";
         $resultat=mysql_query($query);
         
         $query2="UPDATE Espreport SET statue_report='1' WHERE id_report='$id_report'";
         $resultat2=mysql_query($query2);
         if($resultat){
                if($resultat2){
                        $str2=2;
                        ajoute_notification_mg($id_report,$str2);
                        echo 'success';
                }else{
                echo 'error';
                }       
                }else{
                echo 'error';
           }
         
         }
}
function valid_report_caire(){
        if(isset($_POST['id_report'])){
         $id_report=$_POST['id_report'];
         
         $date_caire = date("Y-m-j");
         $commentaire='';
         if(isset($_POST['commentaire'])){
         $commentaire = $_POST['commentaire'];
                  }
         /*$query="UPDATE Expenses SET statue_item='1' WHERE id_report='$id_report'";
         $resultat=mysql_query($query);*/
         
         $query2="UPDATE Espreport SET statue_report='2',Datedevalidation='$date_caire', commentaires='$commentaire' WHERE id_report='$id_report'";
         $resultat2=mysql_query($query2);
         
                if($resultat2){
                        ajoute_notification($id_report);
                        echo 'success';
                }else{
                echo 'error';
                }       
                
         
         }
}
function valid_report_vivre(){
        if(isset($_POST['id_report'])){
         $id_report=$_POST['id_report'];
         $date_livrer = date("Y-m-j");
         
         /*$query="UPDATE Expenses SET statue_item='1' WHERE id_report='$id_report'";
         $resultat=mysql_query($query);*/
         
         $query2="UPDATE Espreport SET statue_report='3',Dateremboursement='$date_livrer' WHERE id_report='$id_report'";
         $resultat2=mysql_query($query2);
         
                if($resultat2){
                        ajoute_notification($id_report);
                        echo 'success';
                }else{
                echo 'error';
                }       
                
         
         }
}

function extraire_en_excel(){

        if(isset($_POST['id_report'])){
       $id_report=$_POST['id_report'];
        $info_report=get_report($id_report);
        $id_info_user=get_infos_user($info_report['id_utilisateur']);
        $id_user = $info_report['id_utilisateur'];
        

        //Chargement du modele de fichier à remplire
        $inputFileName = 'Expense_Report_SAGE_model.xlsx';
        //Choix de la version d'excel
        $objPHPExcel = new PHPExcel_Reader_Excel2007(); 
        $objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
        
        
        //Info entête
                $objPHPExcel->setActiveSheetIndex(0) 
                                        ->setCellValue('B61', $info_report['datereport']) 
                                        ->setCellValue('N1', $id_info_user['prenom'].' '.$id_info_user['nom']); 
//                                         ->setCellValue('G9'$info_report['datereport']);
//                                         ->setCellValue('G11',$date_cmd)
//                                         ->setCellValue('G13',$etat);

      
      $Resultat2= mysql_query("SELECT * FROM Expenses WHERE id_report='$id_report' AND id_utilisateur='$id_user'");
      $rows1= mysql_num_rows($Resultat2);
      $i=14;
      $item=1;
       if($rows1!=0){
              while($array2 = mysql_fetch_array($Resultat2)){
              if($array2['statue_item']==3){
              $exptype2= get_exptype($array2['typeexpense']);
              $currency2=get_currency($array2['typemonnaie']);
              $USD = $array2['amount'] * $currency2['USD'];
              $EUR = $array2['amount'] * $currency2['EUR'];
             
              $objPHPExcel->setActiveSheetIndex(0) 
                                        ->setCellValue('B'.$i, $array2['dateexpense']) 
                                        ->setCellValue('F'.$i, $exptype2['code'].'-'.$exptype2['nom'])
                                        ->setCellValue('M'.$i, $USD)
                                        ->setCellValue('P'.$i, $EUR);
                                        
                
                $i=$i+3;
              }
              }
              }
             $objPHPExcel->getActiveSheet()->setCellValue('M51', '=SUM(M14:M47)');
             $objPHPExcel->getActiveSheet()->setCellValue('P51', '=SUM(P14:P47)');
             $objPHPExcel->getActiveSheet()->setCellValue('M65', '=SUM(M14:M47)');
             $objPHPExcel->getActiveSheet()->setCellValue('M61', '=SUM(P14:P47)');
			 
             $nom_bon = 'Expense_Report_SAGE_'.$id_report;
             $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
             $objWriter->save('../file_excel/'.$nom_bon.'.xlsx');
             echo $nom_bon.'.xlsx';

}
}
function notification(){
       if(isset($_POST['id_user'])){
        $id_user = $_POST['id_user'];
        $message = get_notification($id_user);
        
        if(count($message)!=0){
                $arret=count($message)-1;
               
        for($i=0;$i<count($message);$i++){
                
                echo $message[$i]['message'];
                 if($i!=$arret){
                echo ',';
                
                }
                }
                
                } else{
        echo 'Pas de notification pour l\'instant!';
        }
        
}
}
function notification_vue(){
        if (isset($_POST['id_notification'])) {
                $id = $_POST['id_notification'];
             $reponse = mise_a_jour_notification($id);
             if ($reponse) {
                     echo "success";
             }
                # code...
        }

}