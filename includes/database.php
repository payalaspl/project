<?php
require_once __DIR__ . '/DB_Interface.php';
require_once __DIR__ . '/config.php';
class database implements DB_interface
{
 public function __construct(){
     $this->conn = mysqli_connect(DB_HOST_NAME, DB_USERNAME, DB_PASSWORD,DB_DATABASE_NAME);
     if (mysqli_connect_errno()) {
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		  exit();
  }
  }
  public function selectAll($sql){
  	  $result = mysqli_query($this->conn,$sql);
  	  	// echo $sql;exit();
  	  if(mysqli_num_rows($result) > 0){
  	  	$data = array();
    	while ($row = mysqli_fetch_array($result) )
        {
        	$data[] = $row;
        }
        // print_r($data);exit();
    	return $data;
  	  }else{
  	  	return false;
  	  }
  }
  public function selectOne($sql){
  	$result = mysqli_query($this->conn,$sql);
	  if(mysqli_num_rows($result) > 0){
	  	$row = mysqli_fetch_assoc($result);
	  	return $row;
	  }else{
	  	return false;
	  }
  }
  public function execute($sql){
  	$result = mysqli_query($this->conn,$sql);
	if(mysqli_affected_rows($result) > 0){
		return true;
	}else{
		return false;
	}
  }
}
