// JavaScript Document
var SiteMain = (function() {
	function init(){
		createTooltip();
		createRadio();
		createSelectBox();
		createRangePrice();
		openCartPopup();
		openRegister();
		imageZoomSinglePage();
		displayFilesUpload();
	}
	
	function displayFilesUpload(){
		$(".button-upload input.file-upload--jobs").change(function(){
		    var names = [];
		    for (var i = 0; i < $(this).get(0).files.length; ++i) {
		        names.push($(this).get(0).files[i].name);
		        console.log($(this).get(0).files[i]);
		        $('#files').append('<div class="file"><div class="js-file-wrap"><p><a href="">'+names[0]+'</a></p></div></div>')
		    }
		})
	}

	function createRadio(){
		$('.jobs-form__category input[type="radio"], .jobs-form__offer input[type="radio"], input.iCheckRadio').iCheck();
		$('input.iCheckBox').iCheck();

		$('input.iCheckBox').on('ifChanged', function (event) { 
			//$(event.target).trigger('change'); 
			$("#woocommerce-filter").submit();
		});
	}

	function imageZoomSinglePage(){
		$('.lightbox').imageLightbox({
			onStart:function(){
				return $("body").append('<div class="product-slideshow-overlay "></div>')
			},
			onEnd:function(){
				return $(".product-slideshow-overlay").fadeOut({duration:800,easing:"easeInOutCirc"})
			}
		});
		$('.overlay-button--zoom').click(function(){
			$('.slick-current.slick-active a').trigger('click');
		});
	}
	
	function createSelectBox(){
		$('.filterSelect select, .woocommerce-ordering select').select2({
			minimumResultsForSearch: -1
		});
		$(".filterSelect select, .woocommerce-ordering select").on('change', function(e) {
		    // Access to full data
		    //console.log($(this).val());
		    $("#woocommerce-filter").submit();
		});
	}

	function createRangePrice(){
		if($('#rangePrice').length > 0){
			var range = document.getElementById('rangePrice');
			var pricemin = $(range).attr('data-min');
			var pricemax = $(range).attr('data-max');

			range.style.width = '120px';
			range.style.margin = '0 auto 30px';
			
			noUiSlider.create(range, {
				format: wNumb({
					decimals: 0,
					thousand: '.',
					postfix: '$ '
				}),
				tooltips: true,
				connect: !0,
		        start: [parseInt(pricemin), parseInt(pricemax)],
		                step: 1,
		                range: {
		                    min: 0,
		                    max: 5000
		                }
			}, true);
			range.noUiSlider.on('update', function( values, handle ) {
				var nummin = values[0].split('$')[0].replace('.','');
				var nummax = values[1].split('$')[0].replace('.','');
			    $(range).attr('data-min', parseFloat(nummin));
			    $(range).attr('data-max', parseFloat(nummax));
			    $('.pricemin').val(parseFloat(nummin));
			    $('.pricemax').val(parseFloat(nummax));
			});
			range.noUiSlider.on('change', function( values, handle ) {
				 $("#woocommerce-filter").submit();
			});
			console.log(pricemax);
		}
		
	}
	function createTooltip(){
		var wElement = $('.content-box-wrapper .product-grid-item').width();
		//var position = { my: 'left top', at: 'right+10 bottom-20' }; 
		//position.collision = 'none';

		var windowHeight = $(window).height();
    	var windowWidth = $(window).width();


		$(function() {
		    $( document ).tooltip();
		});


		$('div.tooltip').each(function(){
			$this='';
			$(document).tooltip({
	        	items: '[data-toggle="tooltip"]',
				offset: [10, 2],
 
			   // use the "slide" effect
			   effect: 'slide',
				tooltipClass: 'right',
				content: function(){
					var imagelist = $(this).find('.tooltip-data').val();
					var productname = $(this).find('.content-box-title').html();
					var extension = $(this).find('.content-box-file-extensions').html();
					var price = $(this).find('.content-box-price .woocommerce-Price-amount').html();

					$this = $(this);
					imagelist = JSON.parse(imagelist);
					var list = "<ul class='slick'>";
					for (var i = 0; i < imagelist.length; i++) {
					    list += "<li><img src=" + imagelist[i] + " /></li>"
					}
					list += "</ul>";
					list += "<div class='product-name'>" + productname + "</div> <div class='extension'>"+ extension +"</div><div class='product-price'>"+price+"</div>";

					return list;
				},
				open: function (elem,ui) {
					var left = $($this).offset().left;
    				var top = $($this).offset().top;
    				var proH = $($this).height();
				    var proW = $($this).width();
				    var bottom = windowHeight - top - proH;
				    var right = windowWidth - left - proW;
				    var topbottom = (top < bottom) ? bottom : top;
				    var leftright = (left < right) ? right : left;

				    var tooltiph = $(ui.tooltip).find('ul.slick').height()/2;
				    var tooltipw = $(ui.tooltip).find('ul.slick').width();
				    if (topbottom == bottom && leftright == right) //done
				    {
				    	console.log(1);
				        var yPos = top;
				        var xPos = left + proW + 10;
				        ui.tooltip.css({ top: yPos , left:  xPos }, "fast" );
				    } else if (topbottom == bottom && leftright == left) //done
				    {
				    	console.log(2);
				        var yPos = top;
				        var xPos = right + proW + 10;
				        ui.tooltip.css({ top: yPos, left:  'auto', right: xPos  }, "fast" );
				    } else if (topbottom == top && leftright == right) //done
				    {
				    	
				        var xPos = left + proW + 10;
				        var yPos = top;
				        ui.tooltip.css({ top: yPos, left: xPos + 25  }, "fast" );
				    } else if (topbottom == top && leftright == left) {
				    	
				        var yPos = top ;
				        var xPos = left - proW - (tooltipw/2);
				        console.log(left- proW- tooltipw);
				        ui.tooltip.css({ top: yPos, left: xPos - 50  }, "fast" );
				    } else {}


					//ui.tooltip.css({ top: $($this).offset().top + 10, left:  $($this).offset().left + $($this).width() + 20 }, "fast" );
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
	

	function openCartPopup(){
		$('a#linkCartPopup').click(function(){
			$('#cart-box-content').toggleClass('opened');
		});
		
	}

	function openRegister(){
		$('a#create-account').on('click', function(){
			openPopup('.register-popup');
		});
		$('a.close').on('click', function(){
			closePopup('.register-popup');
		});
	}
	function openPopup(idDiv){
		$('.popover-box, .register-popup').css('display','none')
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

