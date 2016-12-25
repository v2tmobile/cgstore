$('.product-grid-item .content-box').bind({
  mouseenter: function (e) {
    console.log($(this).offset());
  }
});

$('.product-preview-image').slick({
  asNavFor: '.product-thumbs-slider'
});

$('.product-thumbs-slider').slick({
  slidesToShow: 7,
  slidesToScroll: 1,
  asNavFor: '.product-preview-image',
 	focusOnSelect: true
});

// Remove active class from all thumbnail slides
 $('.product-thumbs-slider .slick-slide').removeClass('slick-active');

 // Set active class to first thumbnail slides
 $('.product-thumbs-slider .slick-slide').eq(0).addClass('slick-active');

 // On before slide change match active thumbnail to current slide
 $('.product-preview-image').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
 	var mySlideNumber = nextSlide;
 	$('.product-thumbs-slider .slick-slide').removeClass('slick-active');
 	$('.product-thumbs-slider .slick-slide').eq(mySlideNumber).addClass('slick-active');
});

$('.product-tabs .tabs .tabs-item').bind('click', function (event) {
  event.preventDefault();
  $('.product-tabs .tabs .tabs-item').removeClass('is-active');
  $('.product-tabs .tabs-container .tab-pane').removeClass('is-active');
  $(this).addClass('is-active');
  $($(this).find('a').attr('href')).addClass('is-active');
})


// JavaScript Document
var SiteMain = (function() {
  function init(){
    createRadio(); 
  }
  
  function createRadio(){
    $('input.iCheckRadio').iCheck();
  }
  
  return {
    init:init
  }
  
})();   

$(document).ready( function() {
  SiteMain.init();
});

