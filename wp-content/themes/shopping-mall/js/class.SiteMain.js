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
		var wElement = $('.content-box-wrapper .product-grid-item').width();
		var position = { my: 'left center', at: 'right+10 bottom-20' }; 
		position.collision = 'none';

		$(function() {
		    $( document ).tooltip();
		});

		$('#test-input').hover(function(){
		    $( "#label" ).tooltip( "open" );
		});

		$('div.tooltip').each(function(){
			$(document).tooltip({
	        	items: '[data-toggle="tooltip"]',
				position: position,
				tooltipClass: 'right',
				content: function(){
					var imagelist = $(this).find('.tooltip-data').val();
					imagelist = JSON.parse(imagelist);
					var list = "<ul class='slick'>";
					for (var i = 0; i < imagelist.length; i++) {
					    list += "<li><img src=" + imagelist[i] + " /></li>"
					}
					list += "</ul>";
					
					return list;
				},
				open: function () {
					
					$('ul.slick').not('.slick-initialized').slick({
						dots: false,
						    prevArrow: $('.prev'),
							nextArrow: $('.next')


					});

					$(this).find('.content-box-controls .action .fa-chevron-left ')
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

