<?php

/**
* Pagination class
*/

class Paginate {
	

	public $page;
	public $per_page;
	public $total;


	public function __construct($page = 1, $per_page = 9, $total = 0) {
		$this->page = (int)$page;
		$this->per_page = $per_page;
		$this->total = $total;
	}



	public function next() {

		return $this->page + 1;
	}



	public function prev() {

		return $this->page - 1;
	}



	public function totalPages() {

		return ceil($this->total / $this->per_page);
	}



	public function hasPrev() {

		return $this->prev() >= 1 ? true : false;
	}



	public function hasNext() {

		return $this->next() <= $this->totalPages() ? true : false;
	}



	public function offset() {

		return ($this->page - 1) * $this->per_page;
	}

}