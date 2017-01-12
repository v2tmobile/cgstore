
// (function($){
        
//     var ul = $('#upload ul');

//     $('#drop a').click(function(){
//         // Simulate a click on the file input button
//         // to show the file browser dialog
//         $(this).parent().find('input').click();
//     });
//     var n = 0;
//     // Initialize the jQuery File Upload plugin

//     $('#upload').fileupload({
//         dataType: 'json',      
//         // This element will accept file drag/drop uploading
//         dropZone: $('#drop'),

//         // This function is called when a file is added to the queue;
//         // either via the browse button, or via drag/drop:
//         add: function (e, data) {
//             data.formData = {action: "save_property", action_type: "UploadImg", "profile_id" : $("#profile_id").val() };
//             if(data.files[0]['type'] != 'image/png' && data.files[0]['type'] != 'image/jpg' && data.files[0]['type'] != 'image/jpeg'){ 
//                 alert("Only .png, .jpg, and .jpeg allowed."); 
//                 return; 
//             }
                        
//             // var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
//             //     ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
            
//             var tpl = $('<li class="working"><img src="images/loader.gif"></li>');

//             //Preview image by js
//             /*var reader = new FileReader();            
//             reader.readAsDataURL(data.files[0]);          
//             reader.onload = function (ev) {
//                 //console.log("reader.onload e.target.result: "+ev.target.result);
//                 data.cntxt.after("<img src='"+ev.target.result+"' width=300 height=auto class='imgUploading'>");                
//             }*/
//             // Append the file name and file size
//             tpl.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');

//             // Add the HTML to the UL element
//             data.cntxt = tpl.appendTo(ul);

//             // Initialize the knob plugin
//             tpl.find('input').knob();

//             // Listen for clicks on the cancel icon
//             tpl.find('span').click(function(){
                                
//                 if(tpl.hasClass('working')){
//                     jqXHR.abort();
                                        
//                 }

//                 tpl.fadeOut(function(){
//                     tpl.remove();
                                        
//                 });
//                     tpl.next("img").fadeOut(function(){
//                     tpl.next("img").remove();
//                 });

//             });

//             // Automatically upload the file once it is added to the queue
//             var jqXHR = data.submit()
//             .success(function (result, textStatus, jqXHR) {
//                 console.log("success");

//                 //console.log(tpl.find("img"));
//                 //console.log(result.thumb);

//                 tpl.attr("id", result.attach_ids);
//                 tpl.find("img").attr("src", result.thumb);
//             })
//             .error(function (jqXHR, textStatus, errorThrown) {
//                 console.log("Error::" + textStatus + ":" + errorThrown);
//             })
//             .complete(function (result, textStatus, jqXHR) { 

//             });
            
//         },

//         progress: function(e, data){
//             // Calculate the completion percentage of the upload
//             var progress = parseInt(data.loaded / data.total * 100, 10);

//             // Update the hidden input field and trigger a change
//             // so that the jQuery knob plugin knows to update the dial
//             data.cntxt.find('input').val(progress).change();

//             if(progress == 100){
//                 data.cntxt.removeClass('working');
//                 //change img css opacity once loaded -Should I change the style directly?
//                 data.cntxt.next("img").removeClass("imgUploading");
//                 data.cntxt.next("img").addClass("imgUploaded");
//                 $("#uploadInfo :submit").removeAttr("disabled");
                                
//             }
//         },        
//         fail:function(e, data){
//             // Something has gone wrong!
//             data.cntxt.addClass('error');
//         }

//     });

//     // Prevent the default action when a file is dropped on the window
//     $(document).on('drop dragover', function (e) {
//         e.preventDefault();
//     });

//     // Helper function that formats the file sizes
//     function formatFileSize(bytes) {
//         if (typeof bytes !== 'number') {
//             return '';
//         }

//         if (bytes >= 1000000000) {
//             return (bytes / 1000000000).toFixed(2) + ' GB';
//         }

//         if (bytes >= 1000000) {
//             return (bytes / 1000000).toFixed(2) + ' MB';
//         }

//         return (bytes / 1000).toFixed(2) + ' KB';
//     }   
        
//     //set active class
//     var thisPath = this.location.pathname
//     var thisFile = thisPath.substring(thisPath.lastIndexOf('/')+1);
       
// })(jQuery);//end function i.e. document.ready