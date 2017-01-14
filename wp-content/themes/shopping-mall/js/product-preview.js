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
    
    addFile: function(id, i, file){
		var template = '<ul class="sortable" id="demo-file' + i + '">' +
		                   '<li class="sortable__item">' +
			                   '<img src="http://placehold.it/48.png" class="demo-image-preview" />' +
			                   '<span class="sortable__item-remove has-tooltip tooltipstered"><i class="fa fa-times fa-12 fa-not-spaced"></i></span>'+			                   
		                   '</li>'+
		               '</ul>';
		var progressbar = '<div class="progress progress-striped active">'+
	                       '<div class="progress-bar" role="progressbar" style="width: 0%;">'+
	                           '<span class="sr-only">0% Complete</span>'+
	                       '</div>'+
	                   '</div>';
		var i = $(id).attr('file-counter');
		if (!i){
			$(id).empty();
			
			i = 0;
		}
		
		i++;
		
		$(id).attr('file-counter', i);
		$('.upload-progress').append(progressbar);
		$(id).prepend(template);
	},
	
	updateFileStatus: function(i, status, message){
		$('#demo-file' + i).find('span.demo-file-status').html(message).addClass('demo-file-status-' + status);
		
		if(status == 'success'){
			console.log(status);
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

