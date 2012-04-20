<?php
session_start();  
if (!isset($_COOKIE['id_utilisateur'])){
        header ('Location: connexion.php'); 
        exit(); 
}
?>
<div class="container">
<p id="cool" class="<?php echo $_COOKIE['id_utilisateur'];?>"> </p>
        <h1>Expense Report Manager</h1>
        <p> </p>
        <div class="container-fluid">
        <div class="row-fluid">
        <div class="span2" id="lancereport">

        <button class="btn btn-primary" type="button" onclick=" window.location='travel_expensive.php?travel_encour'" >Reports en cours</button>
        <!--<p> </p>
        <button class="btn btn-primary" type="button" onclick=" window.location='travel_expensive.php?option_remb'" >Type Rembourssement</button>
        <p> </p>-->
        </div>
        <div class="span10">
         <section id="carousel">
      <div class="page-header">
        <h1>PGNiG <small>Norways As</small></h1>
      </div>
      <div class="row">
        <div class="span9 ">
          <h3>About</h3>
          <p>Our vision is to be a long term player in the oil and gas industry in North-West Europe and to be a dynamic, challenging and good employer with a high focus on HSEQ.
Our core values describe our relationship with our employees, customers, partners, shareholders and the society:
"We are creative, we are open and honest and we deliver as promised".</p>
          <a href="http://www.pgnig.pl/norway" target="_blank" class="btn">More...</a>
        </div>
        <div class="span9 columns">
          <h2></h2>
          <p></p>
          <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
              <div class="item active">
                <img src="assets/img/bootstrap-mdo-sfmoma-01.jpg" alt="">
                <div class="carousel-caption">
                 
                </div>
              </div>
              <div class="item">
                <img src="assets/img/bootstrap-mdo-sfmoma-02.jpg" alt="">
                <div class="carousel-caption">
                  
                </div>
              </div>
              <div class="item">
                <img src="assets/img/bootstrap-mdo-sfmoma-03.jpg" alt="">
                <div class="carousel-caption">
                  
                </div>
              </div>
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
          </div>
          <div class="alert alert-info">
            
          
          
    </section>
       <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.gritter.min.js"></script>
        <script type="text/javascript">
        $(function(){
                
                $.extend($.gritter.options, {
                    class_name: 'gritter-light', // for light notifications (can be added directly to $.gritter.add too)
                    position: 'bottom-right', // possibilities: bottom-left, bottom-right, top-left, top-right
                        fade_in_speed: 100, // how fast notifications fade in (string or int)
                        fade_out_speed: 100, // how fast the notices fade out
                        time: 3000 // hang on the screen for...
                });
                
                
               var id_user = $('#cool').attr('class');
               
               var Arrays=new Array();
               $.ajax({
                       url: "config/ajax_function.php",
                       type: "POST",
                       data: '&action=notification'+'&id_user='+id_user,
                       success: function(message){
                                      
                                   //console.log(message); 
                                   Arrays = message.split(","); 
                                   //console.log(Arrays.length);
                                   var i=0;
                                   for(i=0;i<Arrays.length;i++){
                                   // console.log(Arrays[i]);

                                $.gritter.add({
                                // (string | mandatory) the heading of the notification
                             
                                title: 'Notification',
                                
                                text: Arrays[i],
                                // (string | optional) the image to display on the left
                                image: 'assets/images/notification3.png',
                                // (bool | optional) if you want it to fade out on its own or just sit there
                                sticky: true,
                                // (int | optional) the time you want it to be alive for before fading out
                                time: '',
                                // (string | optional) the class name you want to apply to that specific message
                                class_name: 'my-sticky-class'
                        });

                                   }
                                             
                               
                       } 
                
                });
                
                $('#gritter-notice-wrapper').find('.gritter-close').live('click', function(){
                        
                      
                       var vue= $(this).next().next('div .gritter-with-image').children('p:eq(1)').attr('id');
                      
                      $.ajax({
                       url: "config/ajax_function.php",
                       type: "POST",
                       data: '&action=notification_vue'+'&id_notification='+vue,
                       success: function(message){
                                console.log(message);
                       }
                     });
                
                });
                 window.setTimeout('location.reload()', 30000);
                  
               
                
        });       
        </script> 
        </div>
        
        
  </div>
</div>
</div>