<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: ../connexion.php'); 
        exit(); 
}
?>
<?php
        define('INCLUDE_CHECK',true);

        require "config/connect_db.php";
        require "config/scripts_function.php";
        
        if(!empty($_GET['id_report'])&&!empty($_GET['id_expenses'])):
        
       $id_expenses = $_GET['id_expenses'];
       $Resultat = mysql_query("SELECT * FROM Expenses WHERE id_expenses='$id_expenses'");
       $nb_donnees = mysql_fetch_array($Resultat);
?>
<div class="container">
<h1>Expense Report</h1>
<div id="ajout_expense" class="<?php echo $_GET['id_report'];?>" >          
        <form class="form-horizontal" id='modifxpense'>
        <fieldset>
          <legend>Ajouter Expense</legend>
    
           <div class="control-group">
            <label class="control-label" for="datenaissance">Date of voucher</label>
            <div class="controls">
                    <input type="text" class="span2" value="<?php echo $nb_donnees['dateexpense']; ?>" data-date-format="yyyy-mm-dd" id="dateNassance" name="dateexpense" >
            </div>
          </div>
        
            <div class="control-group">
            <label class="control-label" for="select01">Nature of expense</label>
          <div class="controls">
          <?php 
          $exptype = get_liste_exptype();
          
              echo '<select name="type_expense" id="type_user">';
                       for($i=0;$i<count($exptype);$i++){
                       if($exptype[$i]['id_exptype']==$nb_donnees['typeexpense']){
                echo '<option selected="selected" value="'.$exptype[$i]['id_exptype'].'">'.$exptype[$i]['nom'].'</option>';
                        }else{
                        echo '<option value="'.$exptype[$i]['id_exptype'].'">'.$exptype[$i]['nom'].'</option>';
                        }
              
              }
              echo '</select>';
              
            ?>
            
            </div>
            </div>
            <div class="control-group">
            <label class="control-label " for="phone">Amount</label>
            <div class="controls">
              <input type="text" class="input-xlarge required number" id="amount" value="<?php echo $nb_donnees['amount']; ?>" name="amount">
            </div>
          </div>
          
          
            <div class="control-group">
            <label class="control-label" for="select01">Currency</label>
          <div class="controls">
          <?php $currency = get_liste_currency();
          
              echo '<select name="type_currency" id="type_user">';
                       for($i=0;$i<count($currency);$i++){
                       if($currency[$i]['id_currency']==$nb_donnees['typemonnaie']){
                echo '<option selected="selected" value="'.$currency[$i]['id_currency'].'">'.$currency[$i]['ISO_Code'].'-'.$currency[$i]['currency'].'</option>';
                        }else{
                        echo '<option value="'.$currency[$i]['id_currency'].'">'.$currency[$i]['ISO_Code'].'-'.$currency[$i]['currency'].'</option>';
                        }
              }
              echo '</select>';
              
            ?>
            </div>
            </div>
          <div class="form-actions" id="<?php echo $_GET['id_expenses'];?>">
            <button type="submit" class="btn btn-primary">Modifier</button>
             <a class="btn btn-danger" href="travel_expensive.php?creer_travelstep1&pass1=success&step2=<?php echo $_GET['id_report'];?>" >Annuler</a>
          </div>
        </fieldset>
      </form>
</div>

<?php
        else:
?>

<?php
       endif;
?>