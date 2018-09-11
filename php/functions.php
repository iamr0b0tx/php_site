<?php
//this imports the database abstraction class and its object:$db;
require_once('database.php');

function encryptText(string $text): string {
	return md5(crypt($text, SALT));
}

function generatePassword($length){
	$chars = 'qwertyuiopasdfghjklzxcvbnm1234567890';
	return substr(str_shuffle(($chars)), 0, $length);
}

function login($db, $id_var, $password, $id_string="email"){
	//encrypt password
	$password = encryptText($password);

	//get matching email and password
	$match_email = $db->selectBy(USERS_TABLE, "id", '"'.$id_var.'"', "$id_string");
	$match_password = $db->selectBy(USERS_TABLE, "id", '"'.$password.'"', "password");
	
	//checkif user is available and unique
	if((count($match_email) == 1 && count($match_password) > 0) && ($match_password[0]['id'] == $match_email[0]['id'])){
		$uid= $match_email[0]['id'];
		return array(True, $uid);

	}else{
		return false;
	}
}

function register($db, $username, $password, $email, $trn_date){
	//prepare values
	$values = array(
		'username'=> $username,
		'password'=> encryptText($password),
		'email'=> $email,
		'trn_date'=> $trn_date
	);

	$match_username = $db->selectBy(USERS_TABLE, "id, username", '"'.$username.'"', "username");
	if(count($match_username) == 0){
		$result = $db->insert(USERS_TABLE, $values);
		return $result;

	}else{
		return false;

	}
}

function sanitizeString($var){
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}

?>