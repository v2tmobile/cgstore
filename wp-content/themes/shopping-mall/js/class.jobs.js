// JavaScript Document
var Jobs = (function() {
	function init(){
		galleries_upload();
		initSelectGallery();
		galleryTags();
		checkAll();
	}
	function checkAll(){
		var checkAll = $('input.check_all');
		var checkboxes = $('input.check_item');
		$('input.check_all, input.check_item').iCheck();

		checkAll.on('ifChecked ifUnchecked', function(event) {        
	        if (event.type == 'ifChecked') {
	            checkboxes.iCheck('check');
	        } else {
	            checkboxes.iCheck('uncheck');
	        }
	    });

	    checkboxes.on('ifChanged', function(event){
	        if(checkboxes.filter(':checked').length == checkboxes.length) {
	            checkAll.prop('checked', 'checked');
	        } else {
	            checkAll.removeProp('checked');
	        }
	        checkAll.iCheck('update');
	    });
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

