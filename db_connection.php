<?php
define('db_host','localhost');
define('db_user','root');
define('db_pass','');
define('db_name','course');
 $conn = mysqli_connect(db_host,db_user,db_pass,db_name) or die(mysqli_error());
 if(!$conn)
 {
 	echo 'Connection Failed '.mysqli_error($conn);
 }
?>