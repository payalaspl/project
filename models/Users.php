<?php
class Users extends database {
	public function checkemail($sql){
		$data = $this->selectone($sql);
		return $data;
	}
	public function insert($sql){
		$data = $this->execute($sql);
		return $data;
	}
	public function updatetoken($sql){
		$data = $this->execute($sql);
		return $data;
	}
}


