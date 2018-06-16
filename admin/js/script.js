$(document).ready(function(){

	var user_href;
	var user_id;
	var user_split;

	var image_src;
	var image_name;
	var image_split;

	var photo_id;


	$('.modal_thumbnails').on('click', function(){
		$('#set-user-img').removeClass('disabled');
		$('#set-user-img').addClass('inverted green');

		user_href = $('#user-id').prop('href');
		user_split = user_href.split('=');
		user_id = user_split[user_split.length -1];

		image_src = $(this).prop('src');
		image_split = image_src.split('/');
		image_name = image_split[image_split.length -1];

		photo_id = $(this).attr('data');


		$.ajax({

			url: 'includes/ajax.php',
			method: 'POST',
			data: {photo_id: photo_id},
			success: function(data){

				if (!data.error) {
					$('#modal_sidebar').html(data);
				}
			}
		});
	});


	$('#set-user-img').on('click', function(){
		
		$.ajax({

			url: 'includes/ajax.php',
			method: 'POST',
			data: {
				image_name: image_name,
				user_id: user_id
			},
			success: function(data){

				if (!data.error) {

					$('.user-image-box a img').prop('src', data);
				}
			}
		});
	});
});


/* Activate active class */
$(document).ready(function () {

    var url = window.location;

    $('.ui.sidebar a[href="'+ url +'"]').parent().addClass('active');
    $('.ui.sidebar a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
});


/* Calling the Modal */
$(function(){
	$('.user-image-box').on('click', function(){
		$('.ui.modal').modal('show');
	});
});


/* Hiding the Modal */
$(function(){
	$('#set-user-img').on('click', function(){
		$('.ui.modal').modal('hide');
	});
});


/* Image Transition */
$(function(){
	$('.user-image-box a img').hover(function(){
		$(this).transition('pulse');
	});
});


/* Toggle edit photo info sidebar */
$(function(){
	$('.mini-info').on('click', function(){
		$('.slide-info').slideToggle('slow');
	});
});


/* Confirm popup on delete */
$(function(){
	$('.delete-link').on('click', function(){
		return confirm('Are you sure you want to delete this?');
	});
});


/* Return back link */
$(function(){
	$('.back-link').on('click', function(){
		return window.history.go(-1);
	});
});


/* Toggle sidebar on click */
$('#toggle').click(function(){
    $('.ui.sidebar').sidebar('toggle');
});


/* Remove/hide message */
$(function(){
	$('.message .close').on('click', function() {
    	$(this).closest('.message').transition('fade');
  	});

  	$('.message').delay(2000).fadeToggle(900);
});