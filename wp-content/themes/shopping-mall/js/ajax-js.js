
function ats_on_like(key,PID,e){

   if(typeof CGSTORE_VARS.UID !=='undefined' && typeof PID !=='undefined'){
       $.ajax({
             type: "POST",
             url: CGSTORE_VARS.AJAX_URL,
             data:{
               action:'ats-send-like',
               security:key,
               data:{UID:CGSTORE_VARS.UID,PID:PID}
             },
             dataType: 'json',
            beforeSend:function(){
                
            },
             success: function(res)
            {
                 
                if(res.success === true){
                  console.log(res);
                    //$(e).addClass('liked');   
                   //$(e).attr('onclick',res.onclick); 
                    //$('.my-like-total').html(res.total_like); 
                 }else{
                   alert('Không thể xử lý được. Vui lòng thử lại!');
                 }
              }
           });
     return false;
   } 

}

function ats_on_unlike(key,PID,e){

   if(typeof CGSTORE_VARS.UID !=='undefined'){
       $.ajax({
             type: "POST",
             url: CGSTORE_VARS.AJAX_URL,
             data:{
               action:'ats-send-unlike',
               security:key,
               data:{UID:CGSTORE_VARS.UID,PID:PID}
             },
             dataType: 'json',
            beforeSend:function(){
                
            },
             success: function(res)
            {
                 
                if(res.success === true){
                    console.log(res);  
                 }else{
                   alert('Không thể xử lý được. Vui lòng thử lại!');
                 }
              }
           });
      return false;
   } 

}