<?php

require_once 'includes/header.php';

if ($session->isLoggedIn()) { redirect(ADMIN); }

if (isset($_POST['submit'])) {

	$password = strip_tags($_POST['password']);
	$username = strip_tags($_POST['username']);
	$user_found = User::verifyUser($username,$password);

	if ($user_found) {

		$session->login($user_found);
		redirect(ADMIN);
		
	} else {
		Messages::setMsg('Your Password or Username are incorrect','error');
	}
}

?>

<div class="pusher">
	<div class="ui container">

		<div class="ui text container segments">
			<div class="ui inverted padded segment">
				<h3 class="ui centered header">LOGIN</h3>
			</div>
			<div class="ui very padded piled segment">

				<form class="ui form" id="login-id" action="" method="post">
					
					<?php Messages::display(); ?>

				    <div class="field">
				    	<label>Username</label>
				    	<input type="text" name="username" placeholder="Username">
				  	</div>

				  	<div class="field">
				    	<label>Password</label>
				    	<input type="password" name="password" placeholder="Password">
				  	</div>

				  	<button class="ui primary button" type="submit" name="submit">Submit</button>
				</form>

			</div>
		</div>

	</div>
</div>

<?php require_once 'includes/footer.php'; ?>