// JavaScript Document
var Jobs = (function() {
	function init(){
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
		closePopup:closePopup
	}
	
})();		

$(document).ready( function() {
	Jobs.init();
});

