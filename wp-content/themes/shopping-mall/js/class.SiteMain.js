// JavaScript Document
var SiteMain = (function() {
	function init(){
		createTooltip();
	}
	
	function createRadio(){
		$('input.iCheckRadio').iCheck();
		$('input.iCheckBox').iCheck();
	}
	
	function createTooltip(){
		$(".tooltip").each(function(){
			
			$(this).tooltipster({
				contentCloning: true,
				side: 'right',
				contentAsHTML: true,
				functionReady: function(){
					$('.tooltipster-box .slick').not('.slick-initialized').slick({
						dots: false,
						    prevArrow: false,
						    nextArrow: false

					});
				}
			});
			
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

