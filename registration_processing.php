<?php
/*-------------------------------------------------------------
  The generateSalt function was gotten from http://code.activestate.com/recipes/576894-generate-a-salt/
  @author AfroSoft
-------------------------------------------------------------*/

function generateSalt($max = 64) {
	$characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
	$i = 0;
	$salt = "";
	while ($i < $max) {
	    $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
	    $i++;
	}
	return $salt;
}

/*-------------------------------------------------------------
 Form data
-------------------------------------------------------------*/
$uuid = $_POST['uuid'];
$username = mysql_escape_string($_POST['username']);
$password = $_POST['password'];

/*-------------------------------------------------------------
 Salting and Hashing
-------------------------------------------------------------*/

$user_salt = generateSalt(); // Generates a salt from the function above
$combo = $user_salt . $password; // Appending user password to the salt
$hashed_pwd = hash('sha512',$combo); // Using SHA512 to hash the salt+password combo string

/*-------------------------------------------------------------
 Database stuff starts from here,
 MySQL Server Info is gotten from the $_SERVER variable
 (assuming we have the path to the file containing the
 DB credentials in our .htaccess file)
-------------------------------------------------------------*/

/*$db_host = $_SERVER['localhost'];
$db_user = $_SERVER['avierp'];
$db_pass = $_SERVER['tY9ATecuws6NVxJO'];
$db_name = $_SERVER['avierp'];*/

$db_host = "localhost";
$db_user = "avierp";
$db_pass = "tY9ATecuws6NVxJO'";
$db_name = "avierp";
/*-------------------------------------------------------------
 Checks the connection to the DB has been made.
 If successful selects the database to be used, else exits
-------------------------------------------------------------*/

$link = mysql_connect($db_host,$db_user,$db_pass);
if(!$link)
{
	die("Could Not Connect:".mysql_error());
}
mysql_select_db($db_name, $link) or die('Can\'t use db:'. mysql_error());

/*-------------------------------------------------------------
 Inserting Data
-------------------------------------------------------------*/
$insert="INSERT INTO `avierp`.`webportal` (`sl_uuid`, `username`, `salt`, `hashed_pwd`, `isBanned`) VALUES ('$uuid', '$username', '$user_salt', '$hashed_pwd', '0');";
mysql_query($insert, $link) or die('Error while trying to insert data'.mysql_error());mysql_close(); //Closing the connection to the database
echo $password;
 ?>
