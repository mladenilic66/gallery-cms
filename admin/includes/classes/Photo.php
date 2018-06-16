<?php

/**
* Photo Class
*/

class Photo extends Database {


	protected static $db_table = 'photos';
	protected static $columns = ['user_id','title','caption','description','filename','type','size','created'];
	public $id;

	public $user_id;
	public $author_first_name;
	public $author_last_name;

	public $title;
	public $caption;
	public $description;
	public $filename;
	public $type;
	public $size;
	public $created;
	public $tmp_path;
	public $upload_dir = 'images/';
	public $custom_errors = [];




	public function photoPath() {

		return $this->upload_dir . $this->filename;
	}




	private function trimDescription() {
		
		return $this->description = preg_replace('/\s+/', ' ', $this->description);
	}



	public function setFile($file) {

		if (empty($file) || !$file || !is_array($file)) {

			$this->custom_errors[] = 'There is no file uploaded here';
			return false;

		} elseif($file['error'] != 0) {

			self::uploadErrors($file['error'],$this->custom_errors);
			return false;

		} elseif($file['size'] >= 1048576) {

			$this->custom_errors[] = '1MB Maximum Image Size';
			return false;

		} elseif($file['type'] !== 'image/jpeg' && $file['type'] !== 'image/jpg' && $file['type'] !== 'image/png') {

			$this->custom_errors[] = 'Only JPEG,JPG,PNG allowed';
			return false;

		} else {

			$this->filename = rename_img($file['name'],'photo-image-');
			$this->tmp_path = $file['tmp_name'];
			$this->type     = $file['type'];
			$this->size     = $file['size'];
		}
	}




	public static function fetchPhotos($id = 0){

		$sql = 'SELECT photos.*, users.first_name AS author_first_name, users.last_name AS author_last_name FROM ' . self::$db_table . ' INNER JOIN users ON photos.user_id=users.id WHERE photos.id=' . $id . ' ORDER BY photos.id DESC';

		$result = self::findQuery($sql);
		
		return !empty($result) ? array_shift($result) : false;
	}





	public static function countPhotoComments($photo_id){

		$comments = Comment::fetchComment($photo_id);

		return (count($comments) == 1) ? count($comments) . ' comment' : count($comments) . ' comments';
	}
	



	public function save() {

		if ($this->id) {

			$this->update();

		} else {

			$this->created = date("Y-m-d H:i:s");

			if (!empty($this->custom_errors)) {
				return false;
			}

			if (empty($this->filename) || empty($this->tmp_path)) {

				$this->custom_errors[] = 'The file is not available';
				return false;
			}

			// Photo target path
			$target = $this->upload_dir . $this->filename;

			if (file_exists($target)) {

				$this->custom_errors[] = 'File named: ' . $this->filename . ' already exists';
				return false;
			}

			if (move_uploaded_file($this->tmp_path, $target)) {

				if ($this->create()) {
					
					unset($this->tmp_path);
					return true;
				}

			} else {

				$this->custom_errors[] = 'The file directory does not have access permissions';
				return false;
			}
		}
	}



	public function deletePhoto() {

		if ($this->delete()) {

			$photo_path = $this->upload_dir . $this->filename;

			return unlink($photo_path) ? true : false;

		} else {

			return false;
	    }
	}


	public function search($url) {
		
		if (!empty($_GET['search'])) {
			$pe = $_GET['per_page'];
		}
	}


}