
(function($){
        
    var ul = $('.visuals-panel ul');

    $('#messages a').click(function(){
        // Simulate a click on the file input button
        // to show the file browser dialog
        $(this).parent().find('input').click();
    });
    var n = 0;
    // Initialize the jQuery File Upload plugin

    $('#printablenew').fileupload({
        //dataType: 'json',      
        // This element will accept file drag/drop uploading
        dropZone: $('#drop'),

        // This function is called when a file is added to the queue;
        // either via the browse button, or via drag/drop:
        add: function (e, data) {
            data.formData = {action: "save_property", action_type: "UploadImg", "profile_id" : $("#profile_id").val(), "cur_post_id" : $("#cur_post_id").val() };
            if(data.files[0]['type'] != 'image/png' && data.files[0]['type'] != 'image/jpg' && data.files[0]['type'] != 'image/jpeg'){ 
                alert("Only .png, .jpg, and .jpeg allowed."); 
                return; 
            }
                        
            // var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
            //     ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
            
            //var tpl = $('<li class="working"><img src="images/loader.gif"></li>');
            var tpl = $('<li class="working"></li>');
            //Preview image by js
            /*var reader = new FileReader();            
            reader.readAsDataURL(data.files[0]);          
            reader.onload = function (ev) {
                //console.log("reader.onload e.target.result: "+ev.target.result);
                data.cntxt.after("<img src='"+ev.target.result+"' width=300 height=auto class='imgUploading'>");                
            }*/
            // Append the file name and file size
            tpl.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.cntxt = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){
                                
                if(tpl.hasClass('working')){
                    jqXHR.abort();
                                        
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                                        
                });
                    tpl.next("img").fadeOut(function(){
                    tpl.next("img").remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit()
            .success(function (result, textStatus, jqXHR) {
                console.log("success");
                console.log(result);
                //console.log(tpl.find("img"));
                //console.log(result.thumb);
                $("#cur_post_id").val(result.cur_post_id);
                
                console.log( $("#cur_post_id").val() );
                tpl.append('<span class="remove" curpostid="'+result.attach_ids+'"></span>');
                tpl.attr("id", result.attach_ids);
                tpl.find("img").attr("src", result.thumb);
                //Listen for clicks on the cancel icon
                tpl.find('span').click(function(){                                
                    if(tpl.hasClass('working')){
                        jqXHR.abort();                                            
                    }
                    tpl.fadeOut(function(){
                        tpl.remove();                                            
                    });
                        tpl.next("img").fadeOut(function(){
                        tpl.next("img").remove();
                    });
                });
                //
            })
            .error(function (jqXHR, textStatus, errorThrown) {
                console.log("Error::" + textStatus + ":" + errorThrown);
            })
            .complete(function (result, textStatus, jqXHR) { 

            });
            
        },

        progress: function(e, data){
            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.cntxt.find('input').val(progress).change();

            if(progress == 100){
                data.cntxt.removeClass('working');
                //change img css opacity once loaded -Should I change the style directly?
                data.cntxt.next("img").removeClass("imgUploading");
                data.cntxt.next("img").addClass("imgUploaded");
                $("#uploadInfo :submit").removeAttr("disabled");
                                
            }
        },        
        fail:function(e, data){
            // Something has gone wrong!
            data.cntxt.addClass('error');
        }

    });

    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    // Helper function that formats the file sizes
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }

        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }

        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }

        return (bytes / 1000).toFixed(2) + ' KB';
    }   
        
    //set active class
    var thisPath = this.location.pathname
    var thisFile = thisPath.substring(thisPath.lastIndexOf('/')+1);
       
})(jQuery);//end function i.e. document.ready

//Submit data
(function($){

    $(document).ready(function() {
        $("#upload").validate({
                rules: {                                    
                    street: {
                        required: true,
                        minlength: 1
                    },
                    no: {
                        required: true,
                        minlength: 1
                    },
                    place: {
                        required: true,
                        minlength: 1
                    },
                    code: {
                        required: true,
                        minlength: 1                                        
                    },
                    how_did_you_find_this_building: {
                        required: true,   
                        minlength: 1                                  
                    },
                    tell_us_more_about_the_property: {
                        required: true,
                        minlength: 1
                    },
                    property_code: {
                        required: true
                    },
                    reg_agree: "required"
                },
                messages: {
                    street: {
                        required: "Please enter your street",
                        minlength: "Please enter at least 2 characters"
                    },
                    no: {
                        required: "Please enter your No",
                        minlength: "Please enter at least 2 characters"
                    },
                    place: {
                        required: "Please enter your Place",
                        minlength: "Please enter at least 2 characters"
                    },
                    code: {
                        required: "Please enter your Code",
                        minlength: "Please enter at least 2 characters"
                    },
                    how_did_you_find_this_building: {
                        required: "Please enter 'how did you find this building?'",
                        minlength: "Please enter at least 2 characters"
                    },
                    tell_us_more_about_the_property: {
                        required: "Please enter more about the property",
                        minlength: "Please enter at least 2 characters"
                    },
                    reg_agree: "Please accept our policy",
                    property_code:{
                        required: "Please enter property_code"
                    }
                },                            
                
                errorPlacement: function(error, element) {
                    //element.val(error[0].outerText);     
                    //element.attr("placeholder", error.text());
                }, //Puts errors as placeholders                            
                submitHandler: function (form) {
                    //debugger;
                    console.log("submitHandler");
                    var fd = new FormData();
                    fd.append("action", "save_property");
                    fd.append("action_type", "UpdateTextFields");
                    var c = 0;
                    /*var file_data;
                    $('input[type="file"]').each(function(){                                        
                        file_data = $('input[type="file"]')[c].files; // for multiple files
                        for(var i = 0;i<file_data.length;i++){
                             fd.append("file_"+c, file_data[i]);
                        }
                        c++;
                    });*/
                    var other_data = $('#upload').serializeArray();
                    $.each(other_data,function(key,input){
                        fd.append(input.name,input.value);
                    });
                    
                    $attach_ids = "";
                    $( "#gallery_list li" ).each(function( index ) {
                        if($attach_ids != "") $attach_ids += ",";
                        $attach_ids += $(this).attr('id');
                    });
                    console.log( $attach_ids );
                    fd.append("attach_ids", $attach_ids);

                    var ajax_loader;
                    $.ajax({
                        url: property_object.ajax_url,
                        type: 'post',
                        data: fd,
                        //data: { action: "save_property",  field_name : 1, field_value: 2 },
                        contentType: false,
                        processData: false,
                        dataType: "json",
                        beforeSend: function(){
                            ajax_loader = new ajaxLoader($('#upload'));    
                            //$("#bt_submit_text_fields :submit").attr("disabled", "disabled");
                        },
                        success: function( data ) { 
                            ajax_loader.remove();                                    
                            console.log(data);
                            $("#cur_post_id").val(data.cur_post_id);
                            if(data.status == 1) //success
                            {
                                location.href = property_object.siteurl + '/add-property-success';
                            }
                            else if(data.status == 2) //property code already exists 
                            {
                                location.href = property_object.siteurl + '/add-property-fail';
                            }
                        },
                        complete: function(){
                            
                        }
                    });
                                                        
                }

            }) //add rules
        $(this).find("input[type=text]").each(function() {
                if ($(this).attr("placeholder") == $(this).val())
                    $(this).val("");
            }) //validate everything

        $('#EmailAddress').on('click', function() {
            $('#EmailAddress .error').removeClass('error');
            $(this).addClass('success');
        }); //I tried this!
        $("#EmailAddress").click(function(e) {

            var email = $("#EmailAddress");
            var emailaddressVal = $("#EmailAddress").val();
            var emailReg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

            if (!emailReg.test(email.val())) {
                email.addClass("error").focus();

            } else {

                email.removeClass("error");
            } //

            return false;
        });

    }); //MAIN VALIDATION
    //http://stackoverflow.com/questions/21060247/send-formdata-and-string-data-together-through-jquery-ajax                    

})(jQuery);