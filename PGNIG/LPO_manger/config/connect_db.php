<?php

if(!defined('INCLUDE_CHECK')) die('Vous n\'avez pas le droit d\'execute ce fichier');

$db_host                = 'localhost';
$db_user                = 'root';
$db_pass                = 'root';
$db_database    = 'Travel_expensive';

/*
$db_host                = 'mysql10.000webhost.com';
$db_user                = 'a5270792_Kane';
$db_pass                = 'Kane1400';
$db_database    = 'a5270792_lpofdr';
*/

/* Connection à la base */

$lien = mysql_connect($db_host,$db_user,$db_pass) or die('Impossible de ce connecté à la base');

mysql_select_db($db_database,$lien);

mysql_query("SET names UTF8");

?>
