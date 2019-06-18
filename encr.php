<?php

class Enc {

	public static $privKey;

	public static $pubKey;

	public static function get_keys() {
		if ( !file_exists(__DIR__.'/private.txt') || !file_exists(__DIR__.'/public.txt')){
			
			$config = array(
				"private_key_type" => OPENSSL_KEYTYPE_RSA,
				"private_key_bits" => 512,
			);
			
			$res = openssl_pkey_new( $config );
			
			$privKey = '';
			
			openssl_pkey_export( $res,$privKey );
			
			$fpr = fopen(__DIR__."/private.txt",'w');
			fwrite( $fpr, $privKey );
			fclose( $fpr );

			$arr = array(
				"countryName" => "UA",
				"stateOrProvinceName" => "Zaporizska Oblast",
				"localityName" => "Zaporizhia",
				"organizationName" => "weket2434",
				"organizationalUnitName" => "Test",
				"commonName" => "localhost",
				"emailAddress" => "weket2434@gmail.com"
			);
			
			$csr = openssl_csr_new( $arr,$privKey );
			
			$cert = openssl_csr_sign( $csr,NULL, $privKey,10 );
			
			openssl_x509_export( $cert,$str_cert );
			
			$public_key = openssl_pkey_get_public( $str_cert );
			
			$public_key_details = openssl_pkey_get_details( $public_key );
			$public_key_string = $public_key_details['key'];
			
			$fpr1 = fopen(__DIR__.'/public.txt','w');
			fwrite($fpr1, $public_key_string);
			fclose($fpr1);
		}else{
			self::$pubKey = self::getFromFile("public.txt");
			self::$privKey = self::getFromFile("private.txt");
		}
		
		return array( 'private' => $privKey, 'public' => $public_key_string );
	}

	public static function my_enc( $str ) {
		
		openssl_public_encrypt( $str,$result, self::$pubKey );
		return $result;
	}
	
	public static function my_dec( $str ) {
		openssl_private_decrypt( $str,$result, self::$privKey);
		return $result;
	}

	public static function getFromFile($filename){
		$fpr = fopen( $filename,"r" );
		$pub_key = fread( $fpr,1024 );
		fclose( $fpr );
	}
}
