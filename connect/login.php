<?php
include 'DB.php';
class login{
	public static function isLoggedIn(){
//This part combinely work with login.php page setcookie() function for time validation
	if(isset($_COOKIE['FBID'])){
		if(DB::query('SELECT user_id FROM `token` WHERE token=:token', array(':token'=>sha1($_COOKIE['FBID'])))){

			$userid=DB::query('SELECT user_id FROM `token` WHERE token=:token', array(':token'=>sha1($_COOKIE['FBID'])))[0]['user_id'];
//2nd cookie
			if(isset($_COOKIE['FBID_'])){
			//Jodi 2ta cookies pawa jai tobe $userid return korbe.	
			return $userid;
			//nahoi notun create korte hobe.
		}	else{
				//creating 2nd cookie if not available in computer or server
			$cstrong = true;
				$token=bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
				DB::query('INSERT INTO `token` VALUES(0, :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
				//Delect old one (cookie)
				DB::query('DELETE FROM `token` WHERE token=:token',array(':token'=>sha1($_COOKIE['FBID'])));
				//after first cookie expired create both cookie

			//set cookie valid for 7 days
			setcookie('FBID', $token, time()+60*60*24*7,'/',NULL, NULL, true);
			//set cookie valid for 3 days and goto index page for config
			setcookie('FBID_', $token, time()+60*60*24*3,'/',NULL, NULL, true);
			//and finally- created new cookies will return $userid to identify user.
			return $userid;
		}
		}


	}


	return false;

}
}


?>
