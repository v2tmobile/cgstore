// JavaScript Document
var SiteMain = (function() {
	function init(){
		createTooltip();
	}
	
	function createRadio(){
		$('input.iCheckRadio').iCheck();
	}
	
	function createTooltip(){
		$('.tooltip').tooltipster({
			contentCloning: true,
			side: 'right',
			contentAsHTML: true
			
		}).on( 'hover', function() {
		  console.log($( this ).attr('class'));
		});
	}
	
	function openPopup(idDiv){
		$('.result_question').css('display','none')
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
	SiteMain.init();
});

