<?php include ('includes/header.php'); ?>

	<aside class="row contact">

		<div class="contact-video">
			<!-- The video -->
			<video autoplay muted loop id="myVideo">
			  	<source src="<?=ROOT?>img/videos/contact-typing.mp4" type="video/mp4">
			</video>

			<div class="video-heading">
				<h1 class="ui massive brown header">Lorem ipsum dolor sit.</h1>
				<p class="large text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Modi facilis vero quo aliquam ducimus, impedit, neque molestias nisi, quam iusto, tenetur officia iure! Et adipisci possimus optio quaerat aperiam recusandae itaque iusto voluptatibus accusantium, quo numquam, debitis, tempore sequi cumque?</p>
			</div>
		</div>

	</aside>

	<section class="ui text container contact-form">
	
		<h2 class="ui header horizontal divider">CONTACT FORM</h2>
		<div class="ui very padded piled segment">
			<form class="ui form" action="" method="post">
				
			    <div class="field">
			    	<label>Name</label>
			    	<input type="text" placeholder="Name">
			  	</div>

			  	<div class="field">
			    	<label>Email</label>
			    	<input type="email" placeholder="Email" multiple>
			  	</div>

			  	<div class="field">
			    	<label>Message</label>
			    	<textarea placeholder="Message"></textarea>
			  	</div>

			  	<button class="ui primary button" type="submit">Submit</button>
			</form>
		</div>

	</section>

<?php include ('includes/footer.php'); ?>