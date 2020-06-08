<?php
class Categories extends database {
	public function select($sql){
		$data = $this->selectAll($sql);
		return $data;
	}
	public function insert($sql){
		$data = $this->execute($sql);
		return $data;
	}
	public function selectId($sql){
		$data = $this->selectOne($sql);
		return $data;
	}
}
?>