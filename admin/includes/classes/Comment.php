<?php

/**
* Comment Class
*/

class Comment extends Database {


	protected static $db_table = 'comments';
	protected static $columns = ['photo_id','author','body','created'];
	public  $id;
	public  $photo_id;
	public  $photo_title;
	public  $author;
	public  $body;
	public  $created;



	public static function createComment($photo_id,$author,$body){
		
		if (!empty($photo_id) && !empty($author) && !empty($body)) {

			$comment = new Comment();
			$comment->photo_id = (int)$photo_id;
			$comment->author   = strip_tags($author);
			$comment->body     = strip_tags($body);
			$comment->created  = date("Y-m-d H:i:s");

			return $comment;
			
		} else {

			return false;
		}
	}



	public static function fetchComment($photo_id){

		$sql = 'SELECT comments.*, photos.title AS photo_title FROM ' . self::$db_table . ' INNER JOIN photos ON comments.photo_id=photos.id WHERE comments.photo_id=' . $photo_id . ' ORDER BY comments.id DESC';

		return self::findQuery($sql);
	}



	public static function fetchComments(){

		$sql = 'SELECT comments.*, photos.title AS photo_title FROM ' . self::$db_table . ' LEFT JOIN photos ON comments.photo_id=photos.id ORDER BY comments.id DESC';

		return self::findQuery($sql);
	}
}