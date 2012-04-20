<?php
//session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<div id="navbar-example" class="navbar navbar-static">
            <div class="navbar-inner">
              <div class="container" style="width: auto;">
                <a class="brand active" href="index.php">LPO Manager</a>
                <ul class="nav">
                <?php
                if($_COOKIE['type_utilisateur']==0):
                ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrateur <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="lpo_manager.php?admin">Liste utilisateur</a></li>
                      <li><a href="lpo_manager.php?ajouter_user">Ajouter un utilisateur</a></li>
                      
                    </ul>
                  </li>
                <?php
                elseif($_COOKIE['type_utilisateur']==1):
                ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu-Manager<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                              
                      <li><a href="lpo_manager.php?lpo_encour">Tout les commandes</a></li>
                      <li><a href="lpo_manager.php?lpo_encour=1">Commandes non traiter</a></li>
                      <li><a href="lpo_manager.php?lpo_encour=2">Commandes au caire</a></li>
                      <li><a href="lpo_manager.php?lpo_encour=3">Commandes valider</a></li>
                      
                    </ul>
                  </li>
                       
                <?php
                elseif($_COOKIE['type_utilisateur']==2):
                ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu-utilisateur<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="lpo_manager.php?creer_lpo">Faire une commande</a></li>
                      <li><a href="lpo_manager.php?liste_lpo">Mes commandes</a></li>
                      
                    </ul>
                  </li>
                  
                <?php
                endif;
                ?>
                </ul>
                                
                <ul class="nav pull-right">
                  <li class="active"><a href="#">LPO Manager</a></li>
                  <li class=""><a href="#">Travel Expenses</a></li>
                  <li class=""><a href="#">Annuaire</a></li>
                  <li class="divider-vertical"></li>
                  <li id="fat-menu" class="dropdown"> 
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Bienvenue <?php echo $_COOKIE['prenom'].' '.$_COOKIE['nom'];?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="config/deconnexion.php">Deconnexion</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
          </div>