<?php
if(!defined('INCLUDE_CHECK')) die('Vous n\'avez pas le droit d\'execute ce fichier');

function liste_departement(){
					$i=0;
					$reponses= mysql_query("SELECT * FROM departement");
					
					while ($donnees = mysql_fetch_array($reponses)) 
					{ 								
						$message='<option value="'.$donnees[0].'">'.$donnees['nom'].'</option>';
							echo $message;	
					}
					
		
		}
function get_nom_departement($id_departement){
	$query2= mysql_query("SELECT * FROM departement WHERE id_departement='$id_departement'");
	$donnees2=mysql_fetch_array($query2);
	$nom_dep=$donnees2['nom'];
	return $nom_dep;
}
function getunit3 ($id_unit){
					$reponse1= mysql_query("SELECT * FROM unite WHERE id_unit='$id_unit'");
					$rep1 = 'no unit';
					while ($donnee1 = mysql_fetch_array($reponse1)) 
					{
						$rep1 = $donnee1['nom_unit'];
					}
					return $rep1;
}
function get_detail_article($id_article){
		$query= mysql_query("SELECT * FROM article WHERE id_intituler='$id_article'");
		$donnees = mysql_fetch_array($query);
		$detail['titre'] = $donnees['titre'];
		$detail['description'] = $donnees['description'];
		$detail['prix'] = $donnees['prix_article'];
		$detail['unit_mesure'] = $donnees['unit_mesure'];
		
		return $detail;
}

function getlivecommande(){

	$id_utilisateur = $_COOKIE['id_utilisateur'];
	$query= mysql_query("SELECT * FROM livecommande WHERE id_utilisateur= '$id_utilisateur'");
	$i=0;
	while ($donnees=mysql_fetch_array($query)) {
		$info[$i]['id_utilisateur']=$donnees['id_utilisateur'];
		$info[$i]['id_article']=$donnees['id_article'];
		$info[$i]['quantite']=$donnees['quantite'];
		$i++;
	}
	return $info;
}
function getlastcommande($id_utilisateur){
	$sql3=mysql_query("SELECT max(id_commande) AS last_insert_id FROM commande WHERE id_utilisateur = '$id_utilisateur'");
	$a_result = mysql_fetch_array($sql3);
	$id_last = $a_result['last_insert_id'];
	return $id_last;
}
function ajoute_unite($src){
		$requel_unit="INSERT INTO tags VALUES(NULL, '$src')";
		$result=mysql_query($requel_unit);            

}
function getunit2 (){
										
					$reponse1= mysql_query("SELECT * FROM unite");
					while ($donnee1 = mysql_fetch_array($reponse1)) 
					{
						$rep1 = $donnee1['id_unit'];
					}
					return $rep1;
		}
function getlastidarticle(){
                       
    $sql=mysql_query("SELECT max(id_intituler) AS last_insert_id FROM article");
	$a_result = mysql_fetch_array($sql);
	$id_last = $a_result['last_insert_id'];
	
	return $id_last;
}
function getInfocommande($id_commande){
	$sql1 = mysql_query("SELECT * FROM commande WHERE id_commande='$id_commande'");
	$i=0;
	while ($reponse1 = mysql_fetch_array($sql1)) {
		$infocommande['id_utilisateur']=$reponse1['id_utilisateur'];
		$infocommande['numbon']=$reponse1['numbon'];
		$infocommande['datecreer']=$reponse1['datecreer'];
		$infocommande['date_caire']=$reponse1['date_caire'];
		$infocommande['date_livraison']=$reponse1['date_livraison'];
		$infocommande['etat']=$reponse1['etat'];
		$infocommande['raison_modif']=$reponse1['raison_modif'];
		$i++;
	}
	return $infocommande;
}
function getAllArticleCommande($id_commande){

	$sql1 = mysql_query("SELECT * FROM article_commande WHERE id_commande='$id_commande'");
	$i=0;
	while ($reponse1 = mysql_fetch_array($sql1)) {
		$tmp1= $reponse1['id_article'];
		$infoArticleCorrespondant = get_detail_article($tmp1);
		$tmp2 = $infoArticleCorrespondant['unit_mesure'];
		$unitecorrespon = getunit3($tmp2);
		$listeArticleCommande[$i]['id_article']= $tmp1;
		$listeArticleCommande[$i]['intitule']= $infoArticleCorrespondant['titre'];
		$listeArticleCommande[$i]['quantite']=$reponse1['quantite'];
		$listeArticleCommande[$i]['unite']=$unitecorrespon;
		$listeArticleCommande[$i]['prix']=$infoArticleCorrespondant['prix'];
		$listeArticleCommande[$i]['etat']=$reponse1['etat_item'];
		$i++;
	}

	return $listeArticleCommande;

}
function getAllarticlesaveCommande($id_commande){
	$sql1 = mysql_query("SELECT * FROM article_commande_save, article, commande, unite WHERE article_commande_save.id_commande='$id_commande' AND article_commande_save.id_article = article.id_intituler AND article_commande_save.id_commande= commande.id_commande AND article.unit_mesure=unite.id_unit");
	$i = 0;
	while ($reponse1 = mysql_fetch_array($sql1)) {

		$info[$i]['id_article']=$reponse1['id_intituler'].'cool';
		$info[$i]['titre']=$reponse1['titre'];
		$info[$i]['prix']=$reponse1['prix_article'];
		$info[$i]['unite']=$reponse1['nom_unit'];
		$info[$i]['etat']=$reponse1['etat_item'];
		$i++;
	}
	return $info;

}	

function getUnArticleCommande($id_commande,$id_article){

	$sql1 = mysql_query("SELECT * FROM article_commande WHERE id_commande='$id_commande' AND id_article='$id_article'");
	
	while ($reponse1 = mysql_fetch_array($sql1)) {
		$tmp1= $id_article;
		$infoArticleCorrespondant = get_detail_article($tmp1);
		$tmp2 = $infoArticleCorrespondant['unit_mesure'];
		$unitecorrespon = getunit3($tmp2);
		$listeArticleCommande['id_article']= $id_article;
		$listeArticleCommande['intitule']= $infoArticleCorrespondant['titre'];
		$listeArticleCommande['quantite']=$reponse1['quantite'];
		$listeArticleCommande['unite']=$unitecorrespon;
		$listeArticleCommande['prix']=$infoArticleCorrespondant['prix'];

	}

	return $listeArticleCommande;
}
function changeetatitem($id_commande,$id_article,$etat,$quantite){

	$sql = "UPDATE article_commande SET quantite='$quantite',etat_item='$etat' WHERE id_commande='$id_commande' AND id_article='$id_article'";
	$req = mysql_query($sql);
	return $req;
}

function insertitemmodif($id_commande,$id_article,$quantite){
	$sql1 = mysql_query("SELECT * FROM article_commande_save WHERE id_commande='$id_commande' AND id_article='$id_article'");
	$row = mysql_num_rows($sql1);
	if($row==0){
	$etat = 4;
	$requel_unit="INSERT INTO article_commande_save VALUES('$id_commande','$id_article',$etat,'$quantite')";
	$result=mysql_query($requel_unit); 
	}

}

function transferitemmodif($id_commande,$id_article){
	$sql1 = mysql_query("SELECT * FROM article_commande WHERE id_commande='$id_commande' AND id_article='$id_article'");
	while ($reponse1 = mysql_fetch_array($sql1)) {

	}
}



function prix($prix){
	if($prix==0){
		return 'Nom renseigné';
	}else{
		return $prix;
	}
}

?>
