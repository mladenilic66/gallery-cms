<?php

/**
* User Class
*/

class User extends Database {


	protected static $db_table = 'users';
	protected static $columns = ['username','avatar','password','first_name','last_name'];
	public $id;
	public $username;
	public $avatar;
	public $first_name;
	public $last_name;
	public $password;
	public $tmp_path;
	public $upload_dir = 'images/user/';
	public $custom_errors = [];
	public $placeholder_img = 'https://ui-avatars.com/api/?name=';



	public function imageSwitch() {

		return empty($this->avatar) ? $this->placeholder_img.$this->first_name.' '.$this->last_name : ADMIN . $this->upload_dir . $this->avatar;
	}



	public function passwordHash($password) {

		return password_hash($password, PASSWORD_DEFAULT, ["cost" => 12]);
	}



	public static function verifyUser($username,$password){

		global $database;

		$username = $database->escape_string($username);
		$password = $database->escape_string($password);

		$sql = "SELECT * FROM " . self::$db_table . " WHERE username='{$username}'";
		$result = self::findQuery($sql);

		if (!empty($result)) {

			if (password_verify($password, $result[0]->password)) {
			
				return !empty($result) ? array_shift($result) : false;
			}
		}

		$database->connection->close();
	}



	public function avatarPath() {

		return $this->upload_dir . $this->avatar;
	}



	public function setFile($file) {

		if (empty($file) || !$file || !is_array($file)) {

			$this->custom_errors[] = 'There is no file uploaded here';
			return false;

		} elseif($file['error'] != 0) {

			self::uploadErrors($file['error'],$this->custom_errors);
			return false;

		} else {
			$this->avatar = rename_img($file['name'],'avatar-image-');
			$this->tmp_path = $file['tmp_name'];
		}
	}



	public function saveUser() {


		if (!empty($this->custom_errors)) {
			return false;
		}

		if (preg_match('/[^a-z_\-0-9]/i', $this->username)) {

	        Messages::setMsg('Only alphanumeric characters allowed','error');
	        die(redirect(ADMIN.'add_user.php'));
	    }

		// Avatar target path
		// $target = $this->upload_dir . $this->avatar;


		if (file_exists($this->avatarPath())) {

			$this->custom_errors[] = 'File named: ' . $this->avatar . ' already exists';
			return false;
		}


		if (move_uploaded_file($this->tmp_path, $this->avatarPath())) {

			$cropped_image = img_crop_resize(400,400,$this->avatarPath(),$this->avatarPath(),100);
			unset($this->tmp_path);
			return true;

		} else {

			$this->custom_errors[] = 'The file directory does not have access permissions';
			return false;
		}
	}




	public function deletePhoto() {

		if ($this->delete()) {

			$photo_path = $this->upload_dir . $this->avatar;

			return unlink($photo_path) ? true : false;

		} else {

			return false;
	    }
	}




	public function updateUserAjax($user_image,$user_id) {

		global $database;

		$this->avatar = $user_image;
		$this->id = $user_id;

		$sql = "UPDATE " . self::$db_table . " SET avatar = '{$this->avatar}' WHERE id = '{$this->id}'";
		$update = $database->query($sql);
		
		echo $this->imageSwitch();
	}




	public static function displaySidebar($photo_id) {

		$photo_info = self::fetchById($photo_id);

		echo "<a class='thumbanil' href='#'><img class='ui avatar image' src='{$photo_info->avatarPath()}' alt=''></a>";
	}



}