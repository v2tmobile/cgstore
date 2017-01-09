// JavaScript Document
var Popup = (function() {
	function init(){
		
		
		displayFilesUpload();
		createSelectBox();
		createRadio();
		initTags();
		stepPostProduct();
		helperBubble();
	}

	function helperBubble(){
		$('.js-help-trigger').hover(function(){
			var id = $(this).attr('data-target');
			$('.help-bubble').hide();
			$(id).show();
		});
	}
	function stepPostProduct(){
		$('.publishing-steps li a').click(function(){
			var tabid = $(this).attr('href');
			$('.publishing-steps li').removeClass('is-active');
			$(this).parent().addClass('is-active');
			$('.publisher-container .uploads-tab').removeClass('is-active');
			$(tabid).addClass('is-active');
		});
	}
	

	function initTags(){
		$('#tags').tagsInput({width:'auto'});
	}
	function createRadio(){
		$('input[type="checkbox"], input[type="radio"]').iCheck();
	}
	function createSelectBox(){
		$('.site-page--product-publisher select').select2({
			minimumResultsForSearch: -1
		});
	}
	function displayFilesUpload(){
		$('#fileUploadNew').MultiFile({
	    	accept: 'jpg|png|gif',
	    	list: '#messages',
	    	STRING: {
	    		remove: '<span class="sortable__item-remove has-tooltip tooltipstered"><i class="fa fa-times fa-12 fa-not-spaced"></i></span>'
	    	},
	    	onFileAppend: function(){
	    		$('.visuals-panel').show();
	    	}
	    });

	}

	function getMultiFiles(){
		 $("#fileUploadNew").on('change', function () {

             //Get count of selected files
             var countFiles = $(this)[0].files.length;
             console.log(countFiles);
             var imgPath = $(this)[0].value;
             var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
             var image_holder = $("#image-holder");
             image_holder.empty();

             if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
                 if (typeof (FileReader) != "undefined") {

                     //loop for each file selected for uploaded.
                     for (var i = 0; i < countFiles; i++) {

                         var reader = new FileReader();
                         reader.onload = function (e) {
                             $("<img />", {
                                 "src": e.target.result,
                                     "class": "thumb-image"
                             }).appendTo(image_holder);
                         }
                         $('.visuals-panel').show();
                         image_holder.show();
                         reader.readAsDataURL($(this)[0].files[i]);
                     }

                 } else {
                     alert("This browser does not support FileReader.");
                 }
             } else {
                 alert("Pls select only images");
             }
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
	return {
		init:init,
		openPopup:openPopup,
		closePopup:closePopup,
		getMultiFiles:getMultiFiles
	}
	
})();		

$(document).ready( function() {
	Popup.init();
});

