<?php ob_start(); ?>
<?php include "db_connection.php" ?>
<?php include "functions.php" ?>
<?php
   if(isset($_POST['login']))
   {
   	$email = escape($_POST['email']);
   	$password = escape($_POST['password']);
   	 $password_1 = md5($password);
   	 $password_2 = sha1($password_1);
     // Query to get user info
   if(empty($email) || empty($password))
   {
   	echo 'Please enter your email or password';
   }
   else
   {


$query = "SELECT * FROM users WHERE user_email = '$email' AND user_password = '$password_2'";
// print_r($query);break;
   $run_query = mysqli_query($conn,$query);
   if($run_query) // if user found
   {
   $row = mysqli_fetch_assoc($run_query);
   $count = mysqli_num_rows($run_query);

   $id = $row['user_id'];
   $role = $row['user_role'];
   if($count > 0)
   {
   	session_start();
   	$_SESSION['email'] = $row['user_email'];
   	// header("Location:welcome.php");
   	switch($role)
   	{
   		case 'Teacher':
   		header("Location:welcome_teacher.php?id=$id");
   		break;
   		case 'Student':
   		header("Location:welcome_student.php?id=$id");
   		break;
   		default:
   		die('Role Not Found');
   	}
   }
   else
   {
   	echo "<script>
   	       alert('Incorrect Email or Password');
   	      window.location.href='login.php';
   	      </script>";
   }
   }
   
   }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LogIn</title>
</head>
<body>
<form method="post" action="">
	<label>Email </label>
	<input type="email" name="email" placeholder="example@gmail.com" required><br /><br />
	<label>Password</label>
	<input type="password" name="password" placeholder="*******" required><br /><br />
	<input type="submit" name="login" value="LogIn"> &nbsp;

</form>
<a href="forgot.php"><button>Forgot Password</button></a>  

</body>
</html>