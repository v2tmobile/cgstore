// JavaScript Document
var SiteMain = (function() {
	function init(){
		createTooltip();
		createRadio();
		createSelectBox();
	}
	
	function createRadio(){
		$('input.iCheckRadio').iCheck();
		$('input.iCheckBox').iCheck();
	}
	
	function createSelectBox(){
		$('.filterSelect select').select2();
	}

	function createRangePrice(){
		var range = document.getElementById('rangePrice');

		range.style.height = '400px';
		range.style.margin = '0 auto 30px';

		noUiSlider.create(range, {
			start: [ 1450, 2050, 2350, 3000 ], // 4 handles, starting at...
			margin: 300, // Handles must be at least 300 apart
			limit: 600, // ... but no more than 600
			connect: true, // Display a colored bar between the handles
			direction: 'rtl', // Put '0' at the bottom of the slider
			orientation: 'vertical', // Orient the slider vertically
			behaviour: 'tap-drag', // Move handle on tap, bar is draggable
			step: 150,
			tooltips: true,
			format: wNumb({
				decimals: 0
			}),
			range: {
				'min': 1300,
				'max': 3250
			},
			pips: { // Show a scale with the slider
				mode: 'steps',
				stepped: true,
				density: 4
			}
		});
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

