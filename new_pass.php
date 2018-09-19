<?php include "db_connection.php" ?>
<?php include "functions.php" ?>
<?php
      session_start();
      if(empty($_SESSION['recover']))
     {
        die("String used already");
      }
     else
         {
	       $url_string = $_GET['recover'];
           $id = $_SESSION['id'];
           $our_string = $_SESSION['recover'];
         //  print_r($url_string); echo "<br />"; print_r($our_string);break;

               if($url_string !== $our_string)
                  {
   	                 die('ERROR Strings NOT MATCH');
                         }
		}
?>

<?php
 if(isset($_POST['recover_acc']))  //Recover user account if every thing all right
 {
 	$password = escape($_POST['password']);
 	$confirm_password = escape($_POST['confirm_password']);
 	if($password !== $confirm_password)
 	{
 		session_destroy();
 		die('Password not match');
 	}
 	if(strlen($password) < 6)
 	{
 		die('Password must be 6 character long');
 	}
 	 $password_1 = md5($password);
 	 $password_2 = sha1($password_1);
 	$query = "UPDATE users SET user_password = '$password_2' WHERE user_id = '$id'";
 	$run_query = mysqli_query($conn,$query);
 	if($run_query)
 	{
 		echo "<script>
 		alert('Password Update Successfully');
 		window.location.href='login.php';
 		      </script>";
 		      session_destroy();
 		     // $_SESSION['recover'] = null;
 	}
 	else
 	{
 		echo 'Password Update Failed '.mysqli_error($conn);
 	}

 }

?>


<!DOCTYPE html>
<html>
<head>
	<title>
		Recover You Password
	</title>
</head>
<body>
<form method="post" action="">
<label>Enter New Password :</label>
<input type="password" name="password" required placeholder="*******"><br /><br />
<label>Confirm Password : </label>
<input type="password" name="confirm_password" required placeholder="******"><br /><br />
<input type="submit" name="recover_acc" value="Change">

</form>

</body>
</html>