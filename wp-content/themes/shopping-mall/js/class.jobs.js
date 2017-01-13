// JavaScript Document
var Jobs = (function() {
	function init(){
		galleries_upload();
		initSelectGallery();
		galleryTags();
	}

	function openPopup(idDiv){
		$('.hidepopup').css('display','none')
		$(idDiv).css('display','block');	
	}
	function closePopup(idDiv){
		$(idDiv).css('display','none');
        return false;
	}
	function initSelectGallery(){
		$('select.select').select2({
			minimumResultsForSearch: -1
		});
	}
	function galleries_upload(){
		$('#fileUploadGallery').MultiFile({
	    	accept: 'jpg|png|gif',
	    	list: '#fileGallery',
	    	onFileAppend: function(){
	    		$('#gallery-form-container').show();
	    	},
	    	afterFileRemove: function(){
	    		$('#gallery-form-container').hide();	
	    	}
	    });
	}
	function galleryTags(){
		$('#gallery_tags').tagsInput({width:'auto'});
	}
	return {
		init:init,
		openPopup:openPopup,
		closePopup:closePopup
	}
	
})();		

$(document).ready( function() {
	Jobs.init();
});

