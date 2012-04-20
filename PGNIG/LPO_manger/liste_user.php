<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<div class="accordion" id="accordion2">
        <?php
        define('INCLUDE_CHECK',true);

        require "config/connect_db.php";
        require "config/script_lpo.php"; 
        $Resultat = mysql_query("SELECT * FROM ComptesUtilisateur");
        $row = mysql_num_rows($Resultat);
        if($row!=0){
             $nb_donnees = mysql_num_rows($Resultat);
            while($nb_donnees = mysql_fetch_array($Resultat)){
            if($nb_donnees['type_utilisateur']!=0){
            echo '<div class="accordion-group">'
                 .'<div class="accordion-heading">'
                .'<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse-'.$nb_donnees['id_utilisateur'].'" id="user-'.$nb_donnees['id_utilisateur'].'">'
                .$nb_donnees['prenom'].' '.$nb_donnees['nom']
                .'</a>'
              .'</div>'
              .'<div id="collapse-'.$nb_donnees['id_utilisateur'].'" class="accordion-body collapse" style="height: 0px; ">'
                .'<div class="accordion-inner">'
                .'<table class="table table-striped table-bordered table-condensed">'
                        .'<tr>'
                        .'<th><span class="label label-info">Nom</span></th>'
                        .'<th><span class="label label-info">Prenom</span></th>'
                        .'<th><span class="label label-info">Email</span></th>'
                        .'<th><span class="label label-info">Date de naissance</span></th>'
                        .'<th><span class="label label-info">Pays</span></th>'
                        .'<th><span class="label label-info">Numero</span></th>'
                        .'<th><span class="label label-info">Departement</span></th>'
                        .'</tr>'
                        .'<tr>'
                        .'<th>'.$nb_donnees['nom'].'</th>'
                        .'<th>'.$nb_donnees['prenom'].'</th>'
                        .'<th>'.$nb_donnees['email'].'</th>'
                        .'<th>'.$nb_donnees['datenaissance'].'</th>'
                        .'<th>'.$nb_donnees['pays'].'</th>'
                        .'<th>'.$nb_donnees['numero'].'</th>';
                        if($nb_donnees['type_utilisateur']==2){
                         echo '<th>'.get_nom_departement($nb_donnees['departement']).'</th>';
                            }
                        if($nb_donnees['type_utilisateur']==1){
                        echo '<th>Manager</th>';
                            }
                            
                        echo '</tr>'
                .'</table>'
                
                .'</div>'
                .'<div class="btn-group" id="'.$nb_donnees['id_utilisateur'].'">'
.'<a class="btn btn-warning" href="lpo_manager.php?modifuser='.$nb_donnees['id_utilisateur'].'" id="modifuse"><i class="icon-pencil icon-white"></i>Modifier</a>'
.'<a class="btn btn-danger"  data-toggle="modal" href="#" id="supprimeuse"><i class="icon-trash icon-white"></i>Supprimer</a>'
.'</div>'
              .'</div>'
            .'</div>';
            }
            }
           }
           //effacer_user.php='.$nb_donnees['id_utilisateur'].' 
           ?>
 <div class="modal" id="myModal" style="display: none; ">
  <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h3>Effacer un Utilisateur</h3>
  </div>
  <div class="modal-body">
    <p>Voulez vous vraiment supprimer <h4 id="nom_a_supp"> <h4> <?php ?></p>
  </div>
  <div class="modal-footer">
    <a href="#" id="modal_sup" class="btn btn-danger" data-dismiss="modal">Oui</a>
    <a href="travel_expensive.php" class="btn btn-primary">Annuler</a>
  </div>
</div>

</div>