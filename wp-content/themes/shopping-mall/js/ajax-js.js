
function cgs_on_like(key,PID,e){

   if(typeof CGSTORE_VARS.UID !=='undefined' && typeof PID !=='undefined'){
       $.ajax({
             type: "POST",
             url: CGSTORE_VARS.AJAX_URL,
             data:{
               action:'cgs-send-like',
               security:key,
               data:{UID:CGSTORE_VARS.UID,PID:PID}
             },
             dataType: 'json',
            beforeSend:function(){
                
            },
             success: function(res)
            {
                 
                if(res.success === true){
                   $('.total-like').text(res.total_like);
                    $(e).addClass('liked');   
                    $(e).attr('onclick',res.onclick);
                 }else{
                     alert('Error. Please try again!');
                 }
              }
           });
     return false;
   } 

}

function cgs_on_unlike(key,PID,e){

   if(typeof CGSTORE_VARS.UID !=='undefined'){
       $.ajax({
             type: "POST",
             url: CGSTORE_VARS.AJAX_URL,
             data:{
               action:'cgs-send-unlike',
               security:key,
               data:{UID:CGSTORE_VARS.UID,PID:PID}
             },
             dataType: 'json',
            beforeSend:function(){
                
            },
             success: function(res)
            {
                 
                if(res.success === true){
                    $('.total-like').text(res.total_like);
                    $(e).removeClass('liked');   
                    $(e).attr('onclick',res.onclick);
                 }else{
                   alert('Error. Please try again!');
                 }
              }
           });
      return false;
   } 

}