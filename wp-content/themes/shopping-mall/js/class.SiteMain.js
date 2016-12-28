// JavaScript Document
var SiteMain = (function() {
	function init(){
		createTooltip();
		createRadio();
		createSelectBox();
		createRangePrice();
		
	}
	
	function createRadio(){
		$('input.iCheckRadio').iCheck();
		$('input.iCheckBox').iCheck();
	}
	
	function createSelectBox(){
		$('.filterSelect select').select2({
			minimumResultsForSearch: -1
		});
	}

	function createRangePrice(){
		if($('#rangePrice').length > 0){
			var range = document.getElementById('rangePrice');

			range.style.width = '120px';
			range.style.margin = '0 auto 30px';
			$(range).tooltipster({
	            theme: "tooltip--light",
	            animation: "grow",
	            tooltips: true
	        })
			noUiSlider.create(range, {
				format: wNumb({
					decimals: 0,
					thousand: '.',
					postfix: '$ '
				}),
				tooltips: true,
				connect: !0,
		        start: [0, 5000],
		                step: 1,
		                range: {
		                    min: 0,
		                    max: 5000
		                }
			});
		}
		
	}
	function createTooltip(){
		
		var gallery_arr = [];
		$(".tooltip").each(function(){
			
			$(this).tooltipster({
				contentCloning: true,
				side: 'right',
				contentAsHTML: true,
				functionBefore: function(origin,continueTooltip){
					var $ul = $( '<ul>' );
					console.log($(this).find(('.tooltip-data')));
					var clsdata = $(this).find('.tooltip-data').selector;
					gallery_arr = $(clsdata).val().split(',');
					

					for ( var i = 0; i < gallery_arr.length ; i++ ) {
					    $ul.append( '<li>' + gallery_arr[i] + '</li>' );
					}
					console.log($ul );
			        //origin.tooltipster('content',origin.find('.tooltip-data'));
			        //continueTooltip();
			    },
				functionReady: function(){
					
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

