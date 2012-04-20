<?php
function ajoutArticle (){
 if ( isset( $_POST['titre'] ) && isset ( $_POST['description']) ){
 if(isset($_FILES['img_article'])){
  if (($_FILES['img_article']['type'] == "image/jpeg")||($_FILES['img_article']['type'] == "image/jpg")||($_FILES['img_article']['type'] == "image/png")||($_FILES['img_article']['type'] == "image/gif")){
               $titre=$_POST['titre'];
                $description=$_POST['description'];
                $liste_tags=$_POST['tags'];

              if (isset($_POST['unit_sup'])) {
                
                $nom_unit = $_POST['unit_sup'];
                ajoute_unite($nom_unit);
                $unit_mesure = getunit2 ();


              }elseif(isset($_POST['unit_mesure'])) {
                
                $unit_mesure=$_POST['unit_mesure'];

              }

                if ($liste_tags!='') {                  
                $liste_tags2 = str_replace("]x["," , ",$liste_tags);
                $liste_tags3 = str_replace("]x","]",$liste_tags2);
                }
                
                $sql = "INSERT INTO article VALUES(NULL, '$titre', '$description', '$liste_tags3', '$unit_mesure', NULL, NULL) ";
                $resultat=mysql_query($sql);
                $lastid= getlastidarticle();
                $nametof='photo-'.$lastid.$_FILES['img_article']['img_article'];
                $fichier = $_FILES['img_article']['name'];
                $dossier = './imgarticle/';
                if(move_uploaded_file($_FILES['img_article']['tmp_name'], $dossier . $nametof)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
                {
                  $chemin = $dossier . $nametof;
                  $query2="UPDATE article SET photo='$chemin' WHERE id_intituler='$lastid'";
                  $resultat2=mysql_query($query2);
                  header('Location:lpo_manager.php');
                  exit();
                }else{
                  $sql ="DELETE from article WHERE id_intituler= '$lastid'" ;
                  $rep = mysql_query($sql);
                  
                  echo "Ajoute impossible cause fichier non transferer";

                }
            }else{
              echo "Ajoute impossible cause fichier non JPEG";

            }

}else{
          
           echo "Ajoute impossible car pas de photo";

}
}else{

   echo "Pas de variable de champs";
}
}
                ?>