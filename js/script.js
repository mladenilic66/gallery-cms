$(function(){
	$('.message .close').on('click', function() {
    	$(this).closest('.message').transition('fade');
  	});

  	$('.message').delay(2000).fadeToggle(900);
});


// Add color to comment icon
$(function(){
	$('.comment-icon').hover(function() {
		$(this).toggleClass('teal');
	});
});


// show or hide menu pages / hidden attribute fix
$(document).ready(function() {
    
  var respmenu  = $('#nav-menu-burger');
  var menu      = $('#nav-menu');
  var filter_btn  = $('#filter-button');
  var filter      = $('#options-form');

  $(respmenu).on('click', function(e) {
    e.preventDefault();
    menu.slideToggle('slow');
  });

  $(filter_btn).on('click', function(e) {
    e.preventDefault();
    filter.slideToggle('slow');
  });
  
  $(window).resize(function(){
    var sirina = $(window).width();

    if(sirina > 768) {
      menu.removeAttr('style');
      filter.removeAttr('style');
    } 
  });
});


// Sticky Filter Search
$(document).ready(function(){
  $('.ui.sticky').sticky({
      context: '#example1',
      offset: 51
  });
});