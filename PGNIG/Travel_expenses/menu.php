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
                <a class="brand" href="index.php">Travel Expenses</a>
                <ul class="nav">
                <?php
                if($_COOKIE['type_utilisateur']==0):
                ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrateur <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="travel_expensive.php?admin">Liste utilisateur</a></li>
                      <li><a href="travel_expensive.php?ajouter_user">Ajouter un utilisateur</a></li>
                      
                    </ul>
                  </li>
                <?php
                elseif($_COOKIE['type_utilisateur']==1):
                ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu-Manager<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                              
                      <li><a href="travel_expensive.php?travel_encour">All expenses reports</a></li>
                      <li><a href="travel_expensive.php?travel_encour=1">Reports non traiter</a></li>
                      <li><a href="travel_expensive.php?travel_encour=2">Reports au caire</a></li>
                      <li><a href="travel_expensive.php?travel_encour=3">Reports valider</a></li>
                      
                    </ul>
                  </li>
                       
                <?php
                elseif($_COOKIE['type_utilisateur']==2):
                ?>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu-utilisateur<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="travel_expensive.php?creer_travel">Creer Expense report</a></li>
                      <li><a href="travel_expensive.php?liste_travel">report en cours</a></li>
                      
                    </ul>
                  </li>
                  
                <?php
                endif;
                ?>
                </ul>
                                
                <ul class="nav pull-right">
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