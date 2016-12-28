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
		$('.filterSelect select, .woocommerce-ordering select').select2({
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
		

		$('.tooltip').each(function(){
			$(this).tooltip({
				// tweak the position
 				 position: { 
		            my: 'right+250 bottom', 
		            at: 'left top-20'
		          },
					content: function(){
					var imagelist = $(this).find('.tooltip-data').val();
					console.log(imagelist);
					imagelist = JSON.parse(imagelist);
					var list = "<ul>";
					for (var i = 0; i < imagelist.length; i++) {
					    list += "<li><img src=" + imagelist[i] + " /></li>"
					}
					list += "</ul>";
					return list;
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

