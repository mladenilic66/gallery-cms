<?php 

/**
* Session Class
*/

class Session {


	private $logged_in = false;
	public  $user_id;
	public  $first_name;
	public  $last_name;
	public  $user_info;
	public  $count;

	
	function __construct() {

		session_start();
		$this->checkLogin();
		$this->countVisits();
	}



	public function isLoggedIn() {

		return $this->logged_in;
	}


	public function login($user) {

		if ($user) {

			$this->user_info = $_SESSION['user_info'] = [
                'id'          =>  $user->id,
                'first_name'  =>  $user->first_name,
                'last_name'   =>  $user->last_name
            ];

			$this->logged_in = true;
		}
	}


	public function logout() {

		unset($_SESSION['user_info']);
		unset($this->user_info);
		$this->logged_in = false;
	}



	private function checkLogin() {

		if (isset($_SESSION['user_info'])) {

			$this->user_info = $_SESSION['user_info'];
			$this->logged_in = true;

		} else {

			unset($this->user_info);
			$this->logged_in = false;
		}
	}


	public function userInfo() {

		return $this->user_info['first_name'] . '&nbsp;' . $this->user_info['last_name'];
	}



	public function countVisits() {

		if (isset($_SESSION['count'])) {
			
			return $this->count = $_SESSION['count']++;

		} else {

			return $_SESSION['count'] = 1;
		}
	}

}

$session = new Session();