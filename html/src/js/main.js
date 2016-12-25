$('.menu').click(function (event) {
  event.stopPropagation();
  $('body').addClass('is-pushed');
});
$('body').click( function (event) {
  if (event.target !== this)
    return;
  $('body').removeClass('is-pushed');
})
