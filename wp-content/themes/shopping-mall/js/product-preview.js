(function( $, window, undefined ) {
  $.danidemo = $.extend( {}, {
    
    addLog: function(id, status, str){
      var d = new Date();
      var li = $('<li />', {'class': 'demo-' + status});
       
      var message = '[' + d.getHours() + ':' + d.getMinutes() + ':' + d.getSeconds() + '] ';
      
      message += str;
     
      li.html(message);
      
      $(id).prepend(li);
    },
    addProgressBar: function(){
    	var progressbar = '<div class="progress progress-striped active"><div class="progress-bar" role="progressbar" style="width: 0%;"><span class="sr-only">0% Complete</span></div></div>';
    	$('.upload-progress').html(progressbar);
    },
    addImageFile: function(id, i, data){
		var template = '<li class="sortable__item" id="gallery-'+data.data.attachmentID+'">' +
			                   '<img src="'+data.data.url+'" class="demo-image-preview" />' +
			                   '<span onClick="$.danidemo.removeImage('+data.data.attachmentID+')" class="sortable__item-remove has-tooltip tooltipstered"><i class="fa fa-times fa-12 fa-not-spaced"></i></span>'+			                   
		                   '</li>';
		
		var i = $(id).attr('file-counter');
		if (!i){
			$(id).empty();
			
			i = 0;
		}
		
		i++;
		
		$(id).attr('file-counter', i);
		$(id).prepend(template);
	},
	addFile: function(id, i, data){
		var input_name ='<input type="hidden" name="_wc_file_names[]" value="'+data.data.name+'">';
		var input_file_id = '<input type="hidden" name="_wc_file_ids[]" value="'+data.data.attachmentID +'">';
		var input_file_url ='<input type="hidden" name="_wc_file_urls[]" value="'+data.data.url+'">';
		var template = '<div class="file__info" id="file-'+data.data.attachmentID+'"> ' +
				          'Uploaded file: <span class="file__filename">'+data.data.name+ '.'+data.data.type+'</span> ' +
				          '<a href="javascript:;" onClick="$.danidemo.removeFile('+data.data.attachmentID+')" class="file__remove remove-file js-remove-file">'+
				            '<i class="fa fa-trash fa-24"></i>Remove'+
				          '</a>'+ input_name + input_file_id + input_file_url +
				          '</div>';
		
		var i = $(id).attr('file-counter');
		if (!i){
			$(id).empty();
			
			i = 0;
		}
		
		i++;
		$(id).attr('file-counter', i);
		$(id).prepend(template);
	},
	removeFile: function(fileid){
		$('#file-'+fileid).remove();
		var filecount = $('#file-display .file__info').length;
		$('#file-display').attr('file-counter', filecount);
		if(filecount < 1){
			$('.files-panel').hide();
			$('.files-count-label').show();
		}else{
			$('.files-panel').show();
			$('.files-count-label').hide();
		}
	},
	removeImage: function(gallery){
		var product_image_gallery = $('#product_image_gallery').val();
		product_image_gallery = JSON.parse(product_image_gallery);
		var i = product_image_gallery.indexOf(gallery);
		$('#gallery-' + gallery).remove();
        if(i>-1) {
        	product_image_gallery.splice(i, 1);
        }else{
        	product_image_gallery = [];
        }
        $('#product_image_gallery').val(JSON.stringify(product_image_gallery));
        var filecount = $('#demo-files .sortable__item').length;
        if(filecount < 1){
			$('.visuals-panel').hide();
			$('.images-count-label').show();
		}else{
			$('.visuals-panel').show();
			$('.images-count-label').hide();
		}

	},
	updateFileStatus: function(i, status, message){
		$('#demo-file' + i).find('span.demo-file-status').html(message).addClass('demo-file-status-' + status);
		if(status == 'success'){
			$('.upload-progress div.progress ').remove();
		}
	},
	
	updateFileProgress: function(i, percent){
		//$('#demo-file' + i).find('div.progress-bar').width(percent);
		
		//$('#demo-file' + i).find('span.sr-only').html(percent + ' Complete');
		$('.upload-progress').find('div.progress-bar').width(percent);
	},
	
	humanizeSize: function(size) {
      var i = Math.floor( Math.log(size) / Math.log(1024) );
      return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
    }

  }, $.danidemo);
})(jQuery, this);

