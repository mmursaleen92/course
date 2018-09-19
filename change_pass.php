<?php include "db_connection.php"; ?>
<?php include "functions.php"; ?>
<?php $id = $_GET['id']; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Change Your Password</title>
</head>
<body>
   <form method="post" action="">
   	<label>Old Password</label>
   	<input type="password" name="check_password"><br /><br />
   	<label>New Password</label>
   	<input type="password" name="new_pass"><br /><br />
   	<label>Confirm Password</label>
   	<input type="password" name="confrim_pass"><br /><br />
   	<input type="submit" name="change" value="Change Password">
   </form>

</body>
</html>
<?php
      if(isset($_POST['change']))
      {
      	$check_password = escape($_POST['check_password']);
      	$new_pass = escape($_POST['new_pass']);
      	$confrim_pass = escape($_POST['confrim_pass']);
      	if(empty($check_password) || empty($new_pass) || empty($confrim_pass))
      	{
      		echo "You did not enter any data";
      	}
      	elseif($new_pass !== $confrim_pass)
      	{
           die("Password Not Match");
      	}
      	else
      	{
      		if(strlen($new_pass) < 6)
      		{
      			die('Password Must be 6 Character Long');
      		}
      		$check_query = "SELECT * FROM users WHERE user_id = '$id'";
      		$run = mysqli_query($conn,$check_query);
      		$row = mysqli_fetch_assoc($run);
      		// $count = mysqli_num_rows($row);
      		if($row)
      		{
      			$check_password = md5($check_password);
      			$check_password = sha1($check_password);
      			$old_pass = $row['user_password'];
      			if($old_pass == $check_password)
      			{
      				$password_1 = md5($new_pass);
      		        $password_2 = sha1($password_1);
      		        $query = "UPDATE users SET user_password = '$password_2' WHERE user_id = '$id'";
      		         $r = mysqli_query($conn,$query);
      		         if($r)
      		         {
      		         	echo "Password Update Success";
      		         }
      		         else
      		         {
      		         	die("Failed to Update Password");
      		         }
      			}
      			else
      			{
      				die('Incorrect old Password');
      			}
      		}
      		

      	}

     }
?>
