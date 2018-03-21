<?php
session_start();

  /*-------------------------------------------------------------
       Username and password gotten from the login form
   -------------------------------------------------------------*/

   $form_username = $_POST['username'];
   $form_password = $_POST['password'];

   /*-------------------------------------------------------------
      Database connection and selection of the database to be used
   -------------------------------------------------------------*/

   //MySQL Server Info
   $db_host = "localhost";
   $db_user = "avierp";
   $db_pass = "tY9ATecuws6NVxJO'";
   $db_name = "avierp";

   //MySQL Server Connection
   $link = mysql_connect($db_host,$db_user,$db_pass);
   if(!$link)
   {
       die("Could Not Connect:".mysql_error());
   }
   mysql_select_db($db_name, $link) or die('Can\'t use db:'. mysql_error());

   /*-------------------------------------------------------------
 The query to the database and getting the value from it
   -------------------------------------------------------------*/

   $find_user = "SELECT sl_uuid, salt, hashed_pwd, isAdmin FROM webportal WHERE username = '$form_username'";
   $result = mysql_query($find_user, $link) or die('Error while trying to find salt'.mysql_error());
   $row = mysql_fetch_assoc($result);

   /*-------------------------------------------------------------
     Getting the value from the database
     &
     salting,hashing of the password from the form
   -------------------------------------------------------------*/
   $uuid = $row['sl_uuid'];
   $isadmin = $row['isAdmin'];
   $isbanned = $row['isBanned'];

   $stored_salt = $row['salt'];
   $stored_hash = $row['hashed_pwd'];
   $check_pass = $stored_salt . $form_password;
   $check_hash = hash('sha512',$check_pass);

   /*-------------------------------------------------------------
     Comparing the two hashed values
   -------------------------------------------------------------*/

   if($check_hash == $stored_hash){

       $_SESSION['uuid']=$uuid;
       $_SESSION['user']=$form_username;
       $_SESSION['auth']="True";
       $_SESSION['isadmin']=$isadmin;

       echo "Valid User";
       header( 'Location: index.php' ) ;
       exit;
   }
   else{
       echo "Invalid Username/Password";
       session_unset();
       // destroy the session
       session_destroy();
   }    mysql_close(); //Close the connection to the DB
?>
