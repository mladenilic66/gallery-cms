<?php

include("includes/init.php");


if (isset($_REQUEST)) {

	redirect(ADMIN);

	if ($_GET['del_photo']) {
					
		if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

		if (empty($_GET['del_photo'])) { redirect(ADMIN.'photos.php'); } else {

		$photo = Photo::fetchById($_GET['del_photo']);

			if($photo) {
				$photo->deletePhoto();
				redirect(ADMIN.'photos.php');
				Messages::setMsg('Photo ' . $photo->title . ' has been deleted', 'success');

			} else {
				redirect(ADMIN.'photos.php');
			}
		}
	}


	if ($_GET['del_comment']) {

		if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

		if (empty($_GET['del_comment'])) { redirect(ADMIN.'comments.php'); } else {

		$comment = Comment::fetchById($_GET['del_comment']);

			if($comment) {
				$comment->delete();
				redirect(ADMIN.'comments.php');
				Messages::setMsg('Comment with id ' . $_GET['del_comment'] . ' was been deleted', 'success');

			} else {
				redirect(ADMIN.'comments.php');
			}
		}
	}


	if ($_GET['del_p_comm']) {

		if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

		if (empty($_GET['del_p_comm'])) { redirect(ADMIN.'comments_photo.php'); } else {

		$comment = Comment::fetchById($_GET['del_p_comm']);

			if($comment) {
				$comment->delete();
				redirect(ADMIN.'comments_photo.php');
				Messages::setMsg('Comment with id ' . $_GET['del_p_comm'] . ' was been deleted', 'success');

			} else {
				redirect(ADMIN.'comments_photo.php');
			}
		}
	}


	if ($_GET['del_user']) {

		if (!$session->isLoggedIn()) { redirect(ADMIN.'login'); }

		if (empty($_GET['del_user'])) { redirect(ADMIN.'users.php'); } else {

		$user = User::fetchById($_GET['del_user']);

			if($user) {
				$user->deletePhoto();
				redirect(ADMIN.'users.php');
				Messages::setMsg('User ' . $user->username . ' has been deleted', 'success');

			} else {
				redirect(ADMIN.'users.php');
			}
		}
	}
}