<?php
	// Info for encrypt the data
	$methodEncrypt = "AES256";
	// Openssl encrypt method
	$iv_length = openssl_cipher_iv_length($methodEncrypt);
	$options = 0;
	// Non-null initilization vector for encryption
	//$encryption_iv = '1234567891011121';
	$encryption_iv = 'thisisatestencry';
	// Store the encryption key
	$encryption_key = "ProgramacionAvanzada";

	function encrypt_Openssl($data){
		global $methodEncrypt, $encryption_key, $options, $encryption_iv;	
		return openssl_encrypt($data, $methodEncrypt, $encryption_key,
					$options, $encryption_iv);
	}
	
	function decrypt_Openssl($dataE){
		global $methodEncrypt, $encryption_key, $options, $encryption_iv;
		return openssl_decrypt($dataE, $methodEncrypt, $encryption_key,
						$options, $encryption_iv);
	}
?>