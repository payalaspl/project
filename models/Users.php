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
	public function encrypt_fun($simple_string){
		$encryption = openssl_encrypt($simple_string, 'AES-128-CTR', 
         ENCRYPTION_KEY, 0, ENCRYPTION_IV);
		return $encryption;
	}
	public function decrypt_fun($encryption){
		
		$decryption=openssl_decrypt ($encryption, 'AES-128-CTR',  
        ENCRYPTION_KEY, 0, ENCRYPTION_IV);
		return $decryption;
	}
}


