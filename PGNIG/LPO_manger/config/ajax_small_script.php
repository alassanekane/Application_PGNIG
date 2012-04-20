<?php 
define('INCLUDE_CHECK',true);

require "connect_db.php";
require "scripts_function.php";
require "script_lpo.php";
require "PHPexcel/Classes/PHPExcel.php";

switch($_POST['action']){

                case 'liste_departement':
                         liste_departement();
                         break;
                default:
                        echo('Wrong action');
 }
	