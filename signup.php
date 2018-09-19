<?php include "db_connection.php" ?>
<?php include "functions.php" ?>
<?php
 if(isset($_POST['register']))
 {
 	$name = escape($_POST['user_name']);
 	$email = escape($_POST['user_email']);
 	$password = escape($_POST['user_password']);
 	$confirm_password = escape($_POST['confirm_password']);
 	$gender = escape($_POST['user_gender']);
 	$role = escape($_POST['user_role']);
 	 $password_1 = md5($password);
   $password_2 = sha1($password_1);
    $min = 6; 
    if(strlen($password) < $min)
    {
    	die('Your Password must be greater than 6 character');
    }
    if($password !== $confirm_password)
    {
    	die('Password Not Match');
    }
    // $password_3 = crypt($password_2,'st');

 // echo $name."<br>".$email."<br>".$password."<br>".$gender."<br>".$role;
 // echo "<br>".$password_2;
      if(empty($name) || empty($email) || empty($password) || empty($gender) || empty($role))
      {
      	echo 'Form Not fill correctly';
      }
      else
      {    // Create new user insert data in data base
      	$query = "INSERT INTO users (user_name,user_email,user_password,user_gender,user_role) ";
        $query .= "VALUES ('$name','$email','$password_2','$gender','$role')";
       // print_r($query);break;
      	$run_query = mysqli_query($conn,$query);
      	// print_r($query);break;
      	if($run_query){
      		echo "<script>
      		alert('Registered Successfully');
      		window.location.href='login.php';
      		</script>";
      	}
      	else
      	{
      		echo 'Registration Failed'.mysqli_error($conn);
      	}
      }
 }





?>
<!DOCTYPE html>
<html>
<head>
	<title>SignUp</title>
</head>
<body>
<form method="post" action="">
	<label>
	   User Name : 
	    </label>
	<input type="text" name="user_name" required ><br /><br />
	<label>
		Email : 
	</label>
	<input type="email" name="user_email" required ><br /><br />
	<label> 
	Password : 
	</label>
	<input type="password" name="user_password" required ><br /><br />
	<label>
	<label>
		Confirm Password 
	</label>
	<input type="password" name="confirm_password" required><br /><br />
	Gender 
	</label>
	<input type="radio" name="user_gender" value="Male">Male <input type="radio" name="user_gender" value="Female">Female <br /> <br />
	<label>
	Role
	</label>
	<select name="user_role">
		<option>Student</option>
		<option>Teacher</option>
	</select><br /><br />
	<input type="submit" name="register" value="Register">

</form>
</body>
</html>