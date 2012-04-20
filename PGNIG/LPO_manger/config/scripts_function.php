<?php

if(!defined('INCLUDE_CHECK')) die('Vous n\'avez pas le droit d\'execute ce fichier');

function verificationLogIn($nom,$pass){

                        // Création de la requête SQL                   
                        $sql = mysql_query("SELECT count(*) as nbres FROM ComptesUtilisateur WHERE login='$nom' AND pass='$pass'") ;
                        
                        // Exécution de la requête SQL
                        $row = mysql_fetch_array($sql);         
                        if($row['nbres'] == 1){
                        return TRUE;
                        }else{
                        return FALSE;
                        }
}
function veriflogin($str){
        
        $Resultat = mysql_query("SELECT login FROM ComptesUtilisateur WHERE login LIKE '$str'");
        $nb_donnees = mysql_num_rows($Resultat);
        if($nb_donnees==1){
                return FALSE;
                }else{
                return TRUE;
                }
}
function get_infos_user($str){
        $Resultat = mysql_query("SELECT * FROM ComptesUtilisateur WHERE id_utilisateur='$str'");
        $nb_donnees = mysql_fetch_array($Resultat);
        $info_user['prenom']=$nb_donnees['prenom'];
        $info_user['nom']=$nb_donnees['nom'];
        return $info_user;
}
function last_report_user($id_user){

        $sql = mysql_query("SELECT * FROM Espreport WHERE id_utilisateur='$id_user' ");
        
        while($nb_donnees = mysql_fetch_array($sql)){
               $report['id_report']=$nb_donnees['id_report'];
               $report['id_utilisateur']=$nb_donnees['id_utilisateur'];
               $report['nom']=$nb_donnees['nom'];
               $report['datereport']=$nb_donnees['datereport'];
        } 
        return $report;
}

function get_report($id_repport){
        $sql = mysql_query("SELECT * FROM Espreport WHERE id_report='$id_repport'");
        
        $nb_donnees = mysql_fetch_array($sql);
               $report['id_report']=$nb_donnees['id_report'];
               $report['id_utilisateur']=$nb_donnees['id_utilisateur'];
               $report['nom']=$nb_donnees['nom'];
               $report['datereport']=$nb_donnees['datereport'];
               $report['code_mission']=$nb_donnees['num_mission'];
               $report['justificatif']=$nb_donnees['justificatif'];
               $report['Dateremboursement']=$nb_donnees['Dateremboursement'];
               $report['Datedevalidation']=$nb_donnees['Datedevalidation'];
               $report['commentaires']=$nb_donnees['commentaires'];
               $report['statue_report']=$nb_donnees['statue_report'];
        return $report;

}
function get_liste_exptype(){
        $sql = mysql_query("SELECT * FROM Exptype");
        $i=0;
        while($nb_donnees = mysql_fetch_array($sql)){
                $exptype[$i]['id_exptype'] = $nb_donnees['id_exptype'];
                $exptype[$i]['code'] = $nb_donnees['code'];
                $exptype[$i]['nom'] = $nb_donnees['nom'];
                $i++;
        }
        return $exptype;

}
function get_exptype($str){
        $sql = mysql_query("SELECT * FROM Exptype WHERE id_exptype='$str'");
        
        while($nb_donnees = mysql_fetch_array($sql)){
                $exptype['id_exptype'] = $nb_donnees['id_exptype'];
                $exptype['code'] = $nb_donnees['code'];
                $exptype['nom'] = $nb_donnees['nom'];
                
        }
        return $exptype;

}

function get_liste_currency(){
        $sql = mysql_query("SELECT * FROM Currency");
        $i=0;
        while($nb_donnees = mysql_fetch_array($sql)){
                $currency[$i]['id_currency'] = $nb_donnees['id_currency'];
                $currency[$i]['ISO_Code'] = $nb_donnees['ISO_Code'];
                $currency[$i]['currency'] = $nb_donnees['currency'];
                $currency[$i]['EUR'] = $nb_donnees['EUR'];
                $currency[$i]['USD'] = $nb_donnees['USD'];
                $i++;
        }
        return $currency;

}
function get_currency($str){
        $sql = mysql_query("SELECT * FROM Currency WHERE id_currency='$str'");
        
        while($nb_donnees = mysql_fetch_array($sql)){
                $currency['id_currency'] = $nb_donnees['id_currency'];
                $currency['ISO_Code'] = $nb_donnees['ISO_Code'];
                $currency['currency'] = $nb_donnees['currency'];
                $currency['EUR'] = $nb_donnees['EUR'];
                $currency['USD'] = $nb_donnees['USD'];
               
        }
        return $currency;

}
function get_currency_iso_code($str){
       $sql = mysql_query("SELECT * FROM Currency WHERE ISO_Code='$str'");
       $nb_donnees = mysql_fetch_array($sql);
       while($nb_donnees = mysql_fetch_array($sql)){
                $currency['id_currency'] = $nb_donnees['id_currency'];
                $currency['ISO_Code'] = $nb_donnees['ISO_Code'];
                $currency['currency'] = $nb_donnees['currency'];
                $currency['EUR'] = $nb_donnees['EUR'];
                $currency['USD'] = $nb_donnees['USD'];
               
        }
        return $currency;
               
       
}
function ajoute_notification($str1){
        $info_report=get_report($str1);
        $str2 = $info_report['id_utilisateur'];
        $info_user=get_infos_user($str2);
        $tmp='';
        if($info_report['statue_report']==1){
        $tmp = 'Non Traité';
        }
        if($info_report['statue_report']==2){
        $tmp = 'Au caire';
        }
        if($info_report['statue_report']==3){
        $tmp = 'Livrer';
        }
        $sql=mysql_query("SELECT max(id_notification) AS last_insert_id FROM Notification");
        
        $a_result = mysql_fetch_array($sql);
        
        $id_last = $a_result['last_insert_id'];
        
        $id_last=$id_last+1;
        
        $message='<p id="'.$id_last .'">'
                 .'<strong>Le Report Expense: </strong> <span class=\"label label-info\">'.$info_report['nom'].'</span></br>'
                 .'<strong>Etat: </strong> <span class="label label">'.$tmp.'</span>' 
        .'</p></br>';
        
        $query=("INSERT INTO `Travel_expensive`.`Notification` (`id_notification`,`statu`,`message`,`id_report`,`id_utilisateur`) VALUES (NULL, '0', '$message','$str1', '$str2')");
        $resultat=mysql_query($query);
       
}

function ajoute_notification_mg($str1,$str2){
        $info_report=get_report($str1);
        
        $info_user=get_infos_user($str2);
        $tmp='';
        if($info_report['statue_report']==1){
        $tmp = 'Non Traité';
        }
        if($info_report['statue_report']==2){
        $tmp = 'Au caire';
        }
        if($info_report['statue_report']==3){
        $tmp = 'Livrer';
        }
        $sql=mysql_query("SELECT max(id_notification) AS last_insert_id FROM Notification");
        
        $a_result = mysql_fetch_array($sql);
        
        $id_last = $a_result['last_insert_id'];
        
        $id_last=$id_last+1;
        
        $message='<p id="'.$id_last .'">'
                 .'<strong>Le Report Expense: </strong> <span class=\"label label-info\">'.$info_report['nom'].'</span></br>'
                 .'<strong>Etat: </strong> <span class="label label">'.$tmp.'</span>' 
        .'</p></br>';
        $query=("INSERT INTO `Travel_expensive`.`Notification` (`id_notification`,`statu`,`message`,`id_report`,`id_utilisateur`) VALUES (NULL, '0', '$message','$str1', '$str2')");
        $resultat=mysql_query($query);
       
}

function mise_a_jour_notification($id){
                
       
        $sql = "UPDATE Notification SET statu='1' WHERE id_notification= '$id'";
        $req = mysql_query($sql);
        return $req;
       
}
function get_notification($id_user){
        
        $query = mysql_query("SELECT * FROM Notification WHERE id_utilisateur='$id_user'");
               $i=0;
               while($array = mysql_fetch_array($query)){
               if($array['statu']==0){
               $message[$i]['message'] = $array['message'];
               $i++;
               }
               }
               return $message;
}
function get_detail_article2($id_article){
                $query= mysql_query("SELECT * FROM article WHERE id_intituler='$id_article'");
                $donnees = mysql_fetch_array($query);
                $detail['titre'] = $donnees['titre'];
                $detail['description'] = $donnees['description'];
                $detail['prix'] = $donnees['prix_article'];
                $detail['unit_mesure'] = getunit3($donnees['unit_mesure']);
                $detail['tags'] = $donnees['tag'];
                $detail['photo'] = $donnees['photo'];
                return $detail;
}
?>