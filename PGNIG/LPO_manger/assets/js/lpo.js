$(document).ready( function() {	
	verif_type_use();

});

function verif_type_use(){
var verif_use;
verif_use=$("#type_user").children("option:selected").val()
	if(verif_use==2) {
			$.ajax({  
                        url: "config/ajax_small_script.php",
                       type: "POST",           
                       data: '&action=liste_departement',
                       success: function(message){
						var st="<label class=\"control-label\" for=\"select01\">Departement</label>"+
						"<div class=\"controls\">"+
						"<select name=\"type_departement\" id=\"type_departement\">"+
						message+
						"</select>"+
						"</div>";
						$("#inser_depart").html(st);
						var id_dep = $("#type_user").parent('div').attr('id');
						console.log(id_dep);
						$("#type_departement option[value="+id_dep+"]").attr("selected", "selected");
												
                       }
                });
	}
}

$("#type_user").change(function () {
          var str;
          str = $(this).children("option:selected").val();
          if(str==2) {
          	
            $.ajax({  
                        url: "config/ajax_small_script.php",
                       type: "POST",           
                       data: '&action=liste_departement',
                       success: function(message){
						var st="<label class=\"control-label\" for=\"select01\">Departement</label>"+
						"<div class=\"controls\">"+
						"<select name=\"type_departement\" id=\"type_departement\">"+
						message+
						"</select>"+
						"</div>";
						$("#inser_depart").html(st);
                       }
                });
          };
           if(str==1) {
          	$("#inser_depart").html(' ');
          };
          console.log(str);
});


$('#rech').keyup( function(){
      $field = $(this);
      console.log($(this).val());
      
      $('#cat').html(''); // on vide les resultats
      //$('#ajax-loader').remove(); // on retire le loader
      
      // on commence à traiter à partir du 2ème caractère saisie
      if( $field.val().length > 1 )
      {
      // on envoie la valeur recherché en GET au fichier de traitement
      $.ajax({
      type : 'POST', // envoi des données en GET ou POST
      url: "config/ajax_lpo_big.php", // url du fichier de traitement
      data : $(this).serialize()+'&action=search', // données à envoyer en  GET ou POST
      // beforeSend : function() { // traitements JS à faire AVANT l'envoi
      // $('#aftersearch').after('<img src="assets/img/loading.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
      // },
      success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
      $('#ajax-loader').remove(); // on enleve le loader
      $('#cat').html(data); // affichage des résultats dans le bloc
      }
      });
      } 
      });


$('#cat').find('.ajout').live('click',function(){
    // //var table = new Array;
    // if(Arrays.length == 0){
    // //console.log($('#basket .cmd_en_cour').find('.basket-item'));
    // $('#basket .cmd_en_cour').find('.basket-item').each(function(){
    //   Arrays.push($(this).attr('id').replace('cmd-', ''));
    // });
    // console.log(Arrays);
    // }
    $('#erroaffiche').html(' ');    
    var thisID = $(this).parent('tr').attr('id');
    console.log(thisID);
    var quantite = $(this).parent('tr').find('td:eq(3) input').val();
    console.log(quantite);

    if (quantite>0) {
      $.ajax({
      type : 'POST', // envoi des données en GET ou POST
      url: "config/ajax_lpo_big.php", // url du fichier de traitement
      data : '&action=addpanier'+'&id_article='+thisID+'&quantite='+quantite, // données à envoyer en  GET ou POST
      // beforeSend : function() { // traitements JS à faire AVANT l'envoi
      // $('#aftersearch').after('<img src="assets/img/loading.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
      // },
      success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
          console.log('add_success');
         $('#actualise').load('scripte_refresh_cmd.php');

         // window.location = 'lpo_manager.php';
      }
      });
    }else{
      $(this).parent('tr').find('td:eq(3) input').val('');
      $(this).parent('tr').find('td:eq(3) input').attr("placeholder","Invalide");
    }

  });

$('#btnsearch').live('click',function(){
     // console.log($('#rech').val());

      $field = $('#rech');
      
      
      $('#cat').html(''); // on vide les resultats
      //$('#ajax-loader').remove(); // on retire le loader
      
      // on commence à traiter à partir du 2ème caractère saisie
      if( $field.val().length > 1 )
      {
      // on envoie la valeur recherché en GET au fichier de traitement
      $.ajax({
      type : 'POST', // envoi des données en GET ou POST
      url: "config/ajax_lpo_big.php", // url du fichier de traitement
      data : $(this).serialize()+'&action=search', // données à envoyer en  GET ou POST
      // beforeSend : function() { // traitements JS à faire AVANT l'envoi
      // $('#aftersearch').after('<img src="assets/img/loading.gif" alt="loader" id="ajax-loader" />'); // ajout d'un loader pour signifier l'action
      // },
      success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
      $('#ajax-loader').remove(); // on enleve le loader
      $('#cat').html(data); // affichage des résultats dans le bloc
      }
      });
      } 

});

$('.remove').live('click', function() {
    var thisID = $(this).parent('td').parent('tr').attr('id').replace('cmd-','');
    console.log(thisID);
    $.ajax({
      type: 'POST',
      url: "config/ajax_lpo_big.php",
      data : '&action=movepanier'+'&id_article='+thisID,
      success : function(data){
        console.log('move_success');
        //window.location = 'lpo_manager.php';
        //$('#actualise').fadeOut("slow").fadeIn("slow");
       $('#actualise').load('scripte_refresh_cmd.php');
      }
    });
    });

$('#annuler').live('click',function(){

$.ajax({
  type: 'POST',
  url: "config/ajax_lpo_big.php",
  data : '&action=moveallpanier',
   success : function(data){
    console.log('move_success');
    $('#actualise').slideUp("normal");
      $('#actualise').slideDown("normal");
     $('#actualise').load('scripte_refresh_cmd.php');

   }

});
});

$('#commander').live('click',function(){

  
  $verifieSiCommande = $('#verifieSiCommande').find('tr').next().html();
  if($verifieSiCommande != null){
  $.ajax({
  type: 'POST',
  url: "config/ajax_lpo_big.php",
  data : '&action=commander',
   success : function(data){
    console.log(data);
    $('#actualise').slideUp("normal");
      $('#actualise').slideDown("normal");
     $('#actualise').load('scripte_refresh_cmd.php');

   }

});}else{
   
    console.log('pas de commander');
    
    
        $texterror='<div class=\"alert alert-error\">'+
        '<a class=\"close\" data-dismiss=\"alert\">×</a>'+
        '<strong>Oh snap!</strong> Il n\'y a pas d\'article dans le panier :).'+
      '</div>';
     // $('#verifieSiCommande').find('tr').next().html($texterror);
        //console.log($('#erroaffiche').text());
        $('#erroaffiche').html($texterror);
        $('#erroaffiche').show();

  }

});

//$('#aftersearch').colorbox({'width' : '560px', 'height': '700px', 'onComplete' : function(){
         function unite(){
        //$('#unit').html('');
        $.ajax({
        type: "POST",
        url: "config/ajax_lpo_big.php", // url du fichier de traitement
        data: '&action=liste_unit',
        success : function(data){ // traitements JS à faire APRES le retour d'ajax-search.php
        //$('#ajax-loader').remove(); // on enleve le loader
        $('#unit').html(data); // affichage des résultats dans le bloc
        }
        })
                                }
        unite();
        
            
        $('#diff_unite').click(function(){
                                if($('#diff_unite').val()=="Diff_unite"){
                                $('#unit').html('');
                                $('#lab_plus_unite').html('<input id="plus_unite" name="unit_sup" type="text" placeholder="Entre Unité">');
                                $('#diff_unite').val('diff_unite');
                                }else{
                                $('#diff_unite').val('Diff_unite');
                                $('#lab_plus_unite').html('');
                                unite();
                                }

        });


        $('#tags').change(function(){
        console.log($('#tags').tagify('serialize'));
        });
        // Gestion des tags
        
        var myTextArea = $('#tags').tagify();
        // Requete ajax pour récupérer les tags pour l'autocomplete
        $.ajax({
        // Url du script PHP
        type :'POST',
        url: "config/ajax_lpo_big.php",
        // On ne passe aucune donnée
        data : '&action=getTag',
        // En cas de succès, on gère un autocomplete
        success : function(list){
        //On transforme la liste avec virgule en tableau
        var temp = new Array();
        temp = list.split(",");
        //Le plugin intégré à Bootstrap : typeahead permet de faire l'autocomplete
        myTextArea.tagify('inputField').addClass('typeahead').typeahead({
        source: temp
        });
        
        }
        });
                     

          $('.tagify-container').keyup( function(){
          console.log($(this).text());
          $('#tags').val($(this).text());
          });

          $('#article').extend(jQuery.validator.messages, {
          required: "Ce champ est obligatoire.",
          email: "Veuillez saisir un email valide",
          date: "Veuillez saisir une date valide",
          number: "Veuillez saisir que des numero",
          digits: "Veuillez saisir que des numero",
          });
            


          $('#article').validate({
                 /* rules: {
                  img_article: {
                  required: true,
                  accept: "jpeg|png|gif"
                  }
                  }*/

          });  



        $('#cat').find('#view').live('click',function(){
               
               $('#myModalview').children('div .modal-body').html('');
                var thisID = $(this).parent('tr').attr('id');
                 console.log(thisID);
                $.ajax({
                url: "config/ajax_lpo_big.php",
                type : 'POST',
                data : '&id_intituler='+thisID+'&action=detail_article',
                dataType:'text',
                success : function(data){
                console.log(data);
                 $('#myModalview').children('div .modal-body').html(data);
                  $('#myModalview').modal('show');
                }
                });
                  
        });

$('#modifitem').extend(jQuery.validator.messages, {
required: "Ce champ est obligatoire.",
number: "Veuillez saisir que des numero",

});
     
$('#modifitem').validate({
       
       submitHandler: function() { 
        var id_commande=$('.form-actions').attr('id');
        var id_article=$('.info_article').attr('id');

                $.ajax({      
                        url: "config/ajax_lpo_big.php",
                       type: "POST",           
                       data: $('#modifitem').serialize()+'&id_commande='+id_commande+'&id_article='+id_article+'&action=modifi_item_commande',
                       success: function(message){
                                       // console.log(message);
                                       window.location = message;
                                       
                               
                               
                       }
                });
        }
        
});

$('#valideItem_mg').live('click',function(){
var id_commande=$('#reportstep2').attr('class');
var id_article = $(this).parent('div').attr('id');

$.ajax({
  type: 'POST',
  url: "config/ajax_lpo_big.php",
  data : '&id_commande='+id_commande+'&id_article='+id_article+'&action=valideItem_mg',
   success : function(data){
    window.location = data;
   }

});
});
$('#effaceItem_mg').live('click',function(){
var id_commande=$('#reportstep2').attr('class');
var id_article = $(this).parent('div').attr('id')
$.ajax({
  type: 'POST',
  url: "config/ajax_lpo_big.php",
  data : '&id_commande='+id_commande+'&id_article='+id_article+'&action=effaceItem_mg',
   success : function(data){
    window.location = data;
   }

});
});

                         // }});
