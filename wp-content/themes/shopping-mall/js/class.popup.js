// JavaScript Document
var Popup = (function() {
	function init(){
		
		
		//displayFilesUpload();
		//createSelectBox();
		createRadio();
		//initTags();
		stepPostProduct();
		helperBubble();
		openLienceOption();
		openUVW();
	}

	function helperBubble(){
		$('.js-help-trigger').hover(function(){
			var id = $(this).attr('data-target');
			var offsetTop = $(this).offset().top;
			
			$('.help-bubble').hide();
			$(id).css('top', offsetTop - 100).show();
		});

	}
	function openUVW(){
		$('.uvw-mapping .icheckbox').click(function(){
			$('#uvw-mapping-block').toggleClass('opened');
		});
	}
	function stepPostProduct(){
		$('.publishing-steps li a').click(function(){
			var tabid = $(this).attr('href');
			$('.publishing-steps li').removeClass('is-active');
			$(this).parent().addClass('is-active');
			$('.publisher-container .uploads-tab').removeClass('is-active');
			$(tabid).addClass('is-active');
			$('input[type="checkbox"]').iCheck();
			$('input[type="checkbox"]').on('ifChanged', function (event) { 
				var parent = $(this).parent().parent();
				if($(parent).hasClass('uvw-mapping')){
					$('#uvw-mapping-block').addClass('opened');
				}
				console.log(parent);
			});
			$('input[type="checkbox"]').on('ifUnchecked', function (event) { 
				var parent = $(this).parent().parent();
				if($(parent).hasClass('uvw-mapping')){
					$('#uvw-mapping-block').removeClass('opened');
				}
				console.log(parent);
			});
		});
	}
	
	function openLienceOption(){
		$('.license-options input[type="radio"]').change(function(){
			if($(this).val()== 'custom'){
				$('.custom-license-container').show();
			}else{
				$('.custom-license-container').hide();
			}
		});
	}

	function initTags(){
		$('#tags').tagsInput({width:'auto'});

	}
	function createRadio(){
		$('input[name="_downloadable"]').iCheck();
		$('input[name="_downloadable"]').on('ifChanged', function (event) { 
			//$(event.target).trigger('change'); 
			$(".show_if_downloadable").show();
		});
		$('input[name="_downloadable"]').on('ifUnchecked', function (event) { 
			//$(event.target).trigger('change'); 
			$(".show_if_downloadable").hide();
		});

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
	
	function validYT(url) {
	  var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
	   return (url.match(p)) ? RegExp.$1 : false;
	}
	function validViMeo(url) {
	  var p = /^(?:https?:\/\/)?(?:www\.)?vimeo\.com\/watch\?(?=.*((\w|-){11}))(?:\S+)?$/;
	   return (url.match(p)) ? RegExp.$1 : false;
	}

	function reviewVideoUrl(){
		var src="";
		$('#external_url').bind("blur", function() {
		    var url = $(this).val();
		    if (validYT(url) !== false) {
		    	$('.preview-container').show();
		    	yid = url.split('v=')[1];
		        src = "//www.youtube.com/embed/" + yid;
		        $('.preview-container iframe').attr('src',src);
		    } else {
		        var id = false;
				  $.ajax({
				    url: 'https://vimeo.com/api/oembed.json?url='+url,
				    type: 'GET',
				    async: false,
				    success: function(response) {
				      if(response.video_id) {
				      	$('.preview-container').show();
				        id = response.video_id;
				        src = "//player.vimeo.com/video/"+id+"?title=0&byline=0&portrait=0&color=ffffff&autoplay=1";
	        			$('.preview-container iframe').attr('src',src);
				      }
				    }
				});
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
		getMultiFiles:getMultiFiles,
		reviewVideoUrl: reviewVideoUrl
	}
	
})();		

$(document).ready( function() {
	Popup.init();
});

