<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<?php if(isset($_COOKIE["id_utilisateur"])):
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Travel EXPENSES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="assets/css/datepicker.css" rel="stylesheet">
    <link href="assets/css/jquery.gritter.css" rel="stylesheet">
    <link href="assets/css/colorbox.css" rel="stylesheet">
    <link href="assets/css/travel.css" rel="stylesheet">
    <link href="assets/css/lpo.css" rel="stylesheet">
      
   <style>#errorlogin { display: none }</style>
  </head>
  <body data-spy="scroll" data-target=".subnav" data-offset="50">
  
          <?php
          include 'menu.php';
          ?>
          <?php
          include 'content.php';
          ?>
        <script type="text/javascript" src="assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="assets/js/additional-methods.min.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="assets/js/jquery.gritter.min.js"></script>
        <script type="text/javascript" src="assets/js/jquery.tagify.js"></script>
        <script type="text/javascript" src="assets/js/travel.js"></script>
        <script type="text/javascript" src="assets/js/lpo.js"></script>
        
  </body>
    
  </html>
<?php 
      endif;
?>