/*
Page Connexion

*/
$('#connexionform').validate({
      errorLabelContainer: "#errorlogin",
      wrapper: "strong",
      submitHandler: function() {
        $.ajax({      
        url: "config/ajax_function.php",
        type: "POST",           
               data: $('#connexionform').serialize()+'&action=connexion',
        success: function(message){
        if(message == 'success'){    
        window.location = 'travel_expensive.php';
        
        }

        }
        });
      }
 
});

/*
Page admin

*/
$('#connexionform').extend(jQuery.validator.messages, {
        required: "Ce champ est obligatoire.",
                           
});

$('#ajouteuserform').extend(jQuery.validator.messages, {
required: "Ce champ est obligatoire.",
email: "Veuillez saisir un email valide",
date: "Veuillez saisir une date valide",
number: "Veuillez saisir que des numero",
digits: "Veuillez saisir que des numero",
});
                        


$('#ajouteuserform').validate({
       
        submitHandler: function() { console.log('cool');
                $.ajax({      
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: $('#ajouteuserform').serialize()+'&action=ajouteuser',
                       success: function(message){
                               if(message == 'success'){    
                                       window.location = 'travel_expensive.php';
                                       
                               }
                               
                       }
                });
        }
        
});

$('#dateNassance').datepicker();

$('#modifieform').validate({
        
        submitHandler: function() { console.log($('#id_user').val());
        $.ajax({      
                url: "config/ajax_function.php",
               type: "POST",           
               data: $('#modifieform').serialize()+'&id_user='+$('#id_user').val()+'&action=modifuser',
                       success: function(message){
                               
                               if(message == 'success'){    
                                       window.location = 'travel_expensive.php';
                                       
                               }
                                                              
                       }
        });
        }
                
});

var id_clear= '';

$('#supprimeuse').live('click', function() {
        $('#nom_a_supp').html(' ');
        id_clear=$(this).parent('div').attr('id');
        var nom = $('#user-'+id_clear).html();
        $('#nom_a_supp').html(nom);
        $('#myModal').modal('show');     
});

$('#infosaisi').live('click', function() {
        $('#myAide').modal('show');     
});

$('#modal_sup').live('click', function() {
        $('#nom_a_supp').html(' ');
        $.ajax({  
               url: "config/ajax_function.php",
               type: "POST",           
               data: '&id_user='+id_clear+'&action=effaceuser',
               success: function(message){
                       if(message == 'success'){    
                               window.location = 'travel_expensive.php';
                               
                       }
               }
        });
        
});
$('#reportstep1').extend(jQuery.validator.messages, {
        required: "Ce champ est obligatoire.",
                            
});

$('#reportstep1').validate({
        
        submitHandler: function() { 
        $.ajax({      
               url: "config/ajax_function.php",
               type: "POST",           
               data: $('#reportstep1').serialize()+'&action=creerreport',
               success: function(message){
                       if(message == 'error'){  
//                             window.location = 'travel_expensive.php?creer_travelstep1&pass1=success&step2';
                               window.location = 'travel_expensive.php?creer_travel&pass1&step2';
                       }else{
                               window.location = message;
                       }
                                                     
        }
        });
}

});

$('#ajoutexpense').validate({      
        submitHandler: function() {
                var id_report = $('#ajout_expense').attr('class');
                $.ajax({      
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: $('#ajoutexpense').serialize()+'&action=ajoutexpense'+'&id_report='+id_report,
                           success: function(message){
                                   if(message == 'error'){  
        //                             window.location = 'travel_expensive.php?creer_travelstep1&pass1=success&step2';
                        window.location = 'travel_expensive.php?creer_travel&pass1&step2';
                                        }else{
                         window.location = message;
}
                                                     
                           }
                });
        }
        
});
$('#modifxpense').validate({      
        submitHandler: function() {
                var id_report = $('#ajout_expense').attr('class');
                var id_expenses = $('.form-actions').attr('id');
                $.ajax({      
                       url: "config/ajax_function.php",
                       type: "POST",           
                       data: $('#modifxpense').serialize()+'&action=modifxpense'+'&id_report='+id_report+'&id_expenses='+id_expenses,
                       success: function(message){
                               if(message == 'error'){  
                                       
                                       window.location = 'travel_expensive.php?creer_travel&pass1&step2';
                       }else{
                               window.location = message;
                       }
                                                                            
                }
        });
}
        
        });
        $('#effaceexpenses').live('click', function() {
               
                var id_expenses=$(this).parent('div').attr('id');
                var id_report = $(this).parent('div').parent('td').attr('id');
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_expenses='+id_expenses+'&id_report='+id_report+'&action=effaceexpenses',
                       success: function(message){
                               if(message == 'error'){  
                                       
                                       window.location = 'travel_expensive.php?creer_travel&pass1&step2';
                               }else{
                                       window.location = message;
                               }
                       }
                });
                
        });
        $('#effaceexpenses_mg').live('click', function() {
                
                var id_expenses=$(this).parent('div').attr('id');
                var id_report = $(this).parent('div').parent('td').attr('id');
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_expenses='+id_expenses+'&id_report='+id_report+'&action=effaceexpenses_mg',
                       success: function(message){
                               if(message == 'error'){  
                                       
                                       window.location = 'travel_expensive.php?creer_travel&pass1&step2';
                               }else{
                                       window.location = message;
                               }
                       }
                });
                
        });
        $('#valideexpenses_mg').live('click', function() {
                
                var id_expenses=$(this).parent('div').attr('id');
                var id_report = $(this).parent('div').parent('td').attr('id');
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_expenses='+id_expenses+'&id_report='+id_report+'&action=valideexpenses_mg',
                       success: function(message){
                               if(message == 'error'){  
                                       
                                       window.location = 'travel_expensive.php?creer_travel&pass1&step2';
                               }else{
                                       window.location = message;
                               }
                       }
                });
                
        });
        $('#cancelreport').live('click', function() {
                var id_report = $('#reportstep2').attr('class');
                console.log(id_report);
                
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_report='+id_report+'&action=cancelreport',
                       success: function(message){
                               if(message == 'success'){  
                                       
                                       window.location = 'travel_expensive.php';
                               }
                       }
                });
                
        });
        
        $('#cancelreport').live('click', function() {
                var id_report = $('#reportstep2').attr('class');
                
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_report='+id_report+'&action=cancelreport',
                       success: function(message){
                               if(message == 'success'){  
                                       
                                       window.location = 'travel_expensive.php';
                               }
                       }
                });
                
        });
        
        $('#valid_report').live('click', function() {
                var id_report = $('#reportstep2').attr('class');
                $.ajax({  
                       url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_report='+id_report+'&action=valid_report',
                       success: function(message){
                               if(message == 'success'){  
                                       
                                       window.location = 'travel_expensive.php?sendreport=success';
                               }
                       }
                });
                
        });
        $('#valid_report_caire').live('click', function() {
                var id_report = $('#reportstep2').attr('class');
                var commentaire = $('#commentaire').val();
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_report='+id_report+'&action=valid_report_caire'+'&commentaire='+commentaire,
                       success: function(message){
                               if(message == 'success'){  
                                       
                                       window.location = 'travel_expensive.php?travel_encour=2';
                               }
                       }
                });
                
        });
        $('#valid_report_vivre').live('click', function() {
                var id_report = $('#reportstep2').attr('class');
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_report='+id_report+'&action=valid_report_vivre',
                       success: function(message){
                               if(message == 'success'){  
                                       
                                       window.location = 'travel_expensive.php?travel_encour=3';
                               }
                       }
                });
                
        });
        
        $('#Extrare_excel').live('click', function() {
                var id_report = $(this).parent('p').attr('id');   
                console.log(id_report);
                
                $.ajax({  
                        url: "config/ajax_function.php",
                       type: "POST",           
                       data: '&id_report='+id_report+'&action=extraire_en_excel',
                       success: function(message){
								var url='file_excel/'+message; 
								window.open(url,'Download'); 
                               //window.location = 'file_excel/'+message;
                       
                       }
                });
                
        });
        
        $('.carousel').carousel({
                interval: 4000
        })

             



