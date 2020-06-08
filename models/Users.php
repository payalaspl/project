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
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0;  
		$encryption_iv = '1234567891011121';  
		$encryption_key = "PayalTalaviya"; 
		$encryption = openssl_encrypt($simple_string, $ciphering, 
            $encryption_key, $options, $encryption_iv);
		return $encryption;
	}
	public function decrypt_fun($encryption){
		$ciphering = "AES-128-CTR";
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		$decryption_iv = '1234567891011121'; 
		$decryption_key = "PayalTalaviya";
		$decryption=openssl_decrypt ($encryption, $ciphering,  
        $decryption_key, $options, $decryption_iv);
		return $decryption;
	}
}


