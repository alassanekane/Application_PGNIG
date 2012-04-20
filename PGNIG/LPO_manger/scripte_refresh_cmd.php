<?php
define('INCLUDE_CHECK',true);

require "config/connect_db.php";
require "config/script_lpo.php";
?>
<table class="table" id="verifieSiCommande">
               <tr class = "table-bordered">
                <td>Photo</td>
                <td>Intituté</td>
                <td>quantité</td>
                <td>Unité</td>
                <td>Supp</td>
               </tr>
                <?php

                $i=0;
                $livecommand = getlivecommande();
                for ($i=0; $i < count($livecommand) ; $i++) { 
                  $thisarticle = get_detail_article($livecommand[$i]['id_article']);
                  $thisunit = getunit3($thisarticle['unit_mesure']);
                  echo '<tr id="cmd-'.$livecommand[$i]['id_article'].'">'
                        .'<td>'.$i.'</td>'
                        .'<td>'.$thisarticle['titre'].'</td>'
                        .'<td>'.$livecommand[$i]['quantite'].'</td>'
                        .'<td>'.$thisunit.'</td>'
                        .'<td><a class="btn btn-danger remove" href="#"><i class="icon-trash icon-white"></i></a></td>'
                        .'</tr>';

                }
                ?>
                </table>

