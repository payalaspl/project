<?php
class Posts extends database {
	public function select($sql){
		$data = $this->selectAll($sql);
		return $data;
	}
	public function getonerecord($sql){
		$data = $this->selectOne($sql);
		return $data;
	}
}

