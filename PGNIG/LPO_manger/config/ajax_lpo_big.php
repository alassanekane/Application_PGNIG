<?php 
define('INCLUDE_CHECK',true);

require "connect_db.php";
require "scripts_function.php";
require "script_lpo.php";
require "PHPexcel/Classes/PHPExcel.php";

switch($_POST['action']){
                
                case 'search':
                        search_article();
                        break;
                case 'addpanier':
                         addpanier();
                         break;
                case 'movepanier':
                         movepanier();
                         break;
                case 'moveallpanier':
                		moveallpanier();
                	break;
                case 'commander':
                	commander();
                	break;
				case 'getTag':
					getTag();
					break;
				case 'liste_unit':
					liste_unit();
					break;
				case 'ajouteruser':
					ajouteruser();
					break;
				case 'detail_article':
					detail_article();
					break;
				case 'modifi_item_commande':
					modifi_item_commande();
					break;
				case 'valideItem_mg':
					valideItem_mg();
					break;
				case 'effaceItem_mg':
					effaceItem_mg();
					break;
                default:
                        echo('Wrong action');
 }


function search_article(){
			$critere = htmlspecialchars($_POST['search']);
			$query= mysql_query("SELECT * FROM article WHERE titre LIKE  '%$critere%' OR description LIKE  '%$critere%' OR tag LIKE  '%$critere%'");
			$nb_donnees = mysql_num_rows($query);
			if($nb_donnees != 0){
				$taill = 0;
			while($donnees=mysql_fetch_array($query)){
						
   							   	$message = '<tr id="'.$donnees['id_intituler'].'">'
											.'<td class="titre">'.$donnees['titre'].'</td>'
											.'<td class="description">'.$donnees['description'].'</td>'
											.'<td class="tags">'.$donnees['tag'].'</td>'
											.'<td class="quantite"><input class="input-small" type="text" placeholder="Quantité" ></td>'
                                            .'<td class="Unité">'.getunit3($donnees['unit_mesure']).'</td>'
                                            .'<td id="view"><a class="btn" id="viewArticle" href="#" data-toggle="modal"><i class="icon-search"></i></a></td>'   
											.'<td class="ajout"><a type="submit" id="viewAjout" class="addToBasket btn"><i class="icon-plus-sign"></i></a></td>'
										  .'</tr>';
							
					echo $message;
					}
					
			}else{
				
			$message= '<tr>'
										  .'<td>Pas de r&eacute;sultats pour cette recherche</td>'
										  .'</tr>';
			echo $message;	
			}
}

function addpanier(){
if (isset($_POST['id_article'])&&isset($_POST['quantite'])) {

	$id_article = $_POST['id_article'];
	$id_utilisateur = $_COOKIE['id_utilisateur'];
	$quantite = $_POST['quantite'];

	$query= mysql_query("SELECT * FROM livecommande WHERE id_utilisateur= '$id_utilisateur' and id_article='$id_article'");
	$row = mysql_num_rows($query);
	if($row==1){
		$donnees=mysql_fetch_array($query);
		$quantite = $quantite + $donnees['quantite'];

		$sql = "UPDATE livecommande SET quantite = '$quantite' WHERE id_utilisateur= '$id_utilisateur' and id_article='$id_article'";
		$req = mysql_query($sql);
	}else{
		$sql2 = "INSERT INTO livecommande VALUES ('$id_utilisateur', '$id_article', '$quantite')";  
		$req2 = mysql_query ($sql2) ;
	}
	}
}

function movepanier(){
	if(isset($_POST[id_article])){

	$id_article = $_POST['id_article'];
	$id_utilisateur = $_COOKIE['id_utilisateur'];
	$query= mysql_query("SELECT * FROM livecommande WHERE id_utilisateur= '$id_utilisateur' and id_article='$id_article'");
	$row = mysql_num_rows($query);
	if($row==1){

		$sql ="DELETE from livecommande WHERE id_utilisateur= '$id_utilisateur' and id_article='$id_article'";
		$rep = mysql_query($sql);  
	}

	}
}

function moveallpanier(){

	$id_utilisateur = $_COOKIE['id_utilisateur'];
	$sql ="DELETE from livecommande WHERE id_utilisateur= '$id_utilisateur'" ;
	$rep = mysql_query($sql);

}
function transfercommande($id_cmd,$id_utilisateur){
		$query= mysql_query("SELECT * FROM livecommande WHERE id_utilisateur= '$id_utilisateur'");
		
		while ($rep = mysql_fetch_array($query)) {
			$id_article = $rep['id_article'];
			$quantite = $rep['quantite'];
			$sql2 = "INSERT INTO  article_commande VALUES ('$id_cmd','$id_article','0','$quantite')";
			$rep2 = mysql_query($sql2);
		}
		moveallpanier();
	}
function commander(){
	

	$id_utilisateur = $_COOKIE['id_utilisateur'];
	$date_commande = date("Y-m-j");
	$etat = 1;

	$sql2 = "INSERT INTO commande VALUES (NULL, '$id_utilisateur', NULL, '$date_commande', NULL, NULL, '$etat', NULL)"; 
	$rep2 = mysql_query($sql2);

	$id_last=getlastcommande($id_utilisateur);
	echo $id_last;
	transfercommande($id_last,$id_utilisateur);


}


function getTag(){
                       $reponse=mysql_query("SELECT * FROM tags");
                        $taill=0;
                        while($donnees = mysql_fetch_array($reponse)){
                                        $tag[$taill] = $donnees['nom_tags'];
                                        $taill++;                                       
                        }
                        $all_tag= $tag[0];      
                        for($i=1;$i<$taill;$i++){
                                $all_tag = $all_tag.','.$tag[$i];       
                        }
                        echo $all_tag ; 

}
function liste_unit (){
					
					$reponses= mysql_query("SELECT * FROM unite");
					while ($donnees = mysql_fetch_array($reponses)) 
					{ 								
						$message='<option value="'.$donnees[0].'">'.$donnees['nom_unit'].'</option>';
						echo $message;			
					}
		
		}
function ajouteruser(){
		header('Location: ../lpo_manager.php');
		exit();
}
function detail_article(){
        if(isset($_POST['id_intituler'])){
                $id_article = $_POST['id_intituler'];
                
                $detail = get_detail_article2($id_article);
                $liste_tags2 = str_replace("]x["," , ",$detail['tags']);
                $liste_tags3 = str_replace("]x","]",$liste_tags2);
 
        echo '<h4>Intituler</h4>'
              .'<p>'.$detail['titre'].'</p>'

              .'<h4>Description</h4>'
              .'<p>'.$detail['description'].'</p>'

              .'<h4>Unité</h4>'
              .'<p>'.$detail['unit_mesure'].'</p>'
               
              .'<h4>Tags associés</h4>'
              .'<p>'.$liste_tags3.'</p>'
               
               .'<h4>Prix</h4>';
               if($detail['prix']==0){
        echo '<p>Non renseigné</p>';
               }else{
echo '<p>'.$detail['prix'].'</p>';           
               }
echo '<hr>'

                            .'<h4>Images</h4>'
                            .'<p> <img src="'.$detail['photo'].'" height="100px" width="100px" ></p>';
                    
     
          
                }else{
                  echo "error";
                }
}

function modifi_item_commande(){
	 
	 if (isset($_POST['id_commande'])&&isset($_POST['id_article'])&&isset($_POST['newquantite'])) {

		$etat = 4;
		$id_article =  $_POST['id_article'];
		$id_commande = $_POST['id_commande'];
		$newquantite = $_POST['newquantite'];

		$info_commande=getInfocommande($id_commande);

		$sql1 = mysql_query("SELECT * FROM article_commande WHERE id_commande='$id_commande' AND id_article='$id_article'");
		$reponse1 = mysql_fetch_array($sql1);

		$info_save_article=$reponse1['quantite'];

		insertitemmodif($id_commande,$id_article,$info_save_article);

		if ($resultat=changeetatitem($id_commande,$id_article,$etat,$newquantite)) {
			if (!empty($_POST['newprix'])) {
				$newprix = $_POST['newprix'];
				$sql_prix = "UPDATE article SET prix_article='$newprix' WHERE id_intituler='$id_article'";
				$req_prix = mysql_query($sql_prix);
			}
			echo 'lpo_manager.php?traitercommande=success&id_user='.$info_commande['id_utilisateur'].'&id_commande='.$id_commande;
		}

	}
	
}
function valideItem_mg(){
 if (isset($_POST['id_commande'])&&isset($_POST['id_article'])){
	    $etat = 3;
		$id_article =  $_POST['id_article'];
		$id_commande = $_POST['id_commande'];
		$info_commande=getInfocommande($id_commande);
		
		$sql = "UPDATE article_commande SET etat_item='$etat' WHERE id_commande='$id_commande' AND id_article='$id_article'";
	    $req = mysql_query($sql);
	    echo 'lpo_manager.php?traitercommande=success&id_user='.$info_commande['id_utilisateur'].'&id_commande='.$id_commande;
}
}
function effaceItem_mg(){
 if (isset($_POST['id_commande'])&&isset($_POST['id_article'])){

	    $etat = 2;
		$id_article =  $_POST['id_article'];
		$id_commande = $_POST['id_commande'];
		$info_commande=getInfocommande($id_commande);	
		$sql = "UPDATE article_commande SET etat_item='$etat' WHERE id_commande='$id_commande' AND id_article='$id_article'";
	    $req = mysql_query($sql);

	    echo 'lpo_manager.php?traitercommande=success&id_user='.$info_commande['id_utilisateur'].'&id_commande='.$id_commande;
}
}
?>