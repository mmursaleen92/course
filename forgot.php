<?php include "db_connection.php" ?>
<?php include "functions.php" ?>
<?php
 if(isset($_POST['recover']))
 {
 	$email = escape($_POST['email']);
 	if(empty($email))
 	{
 		echo 'Please Enter your Email';
 	}
 	else // Check email exist in our Data base
 	{ 
 		$query = "SELECT * FROM users WHERE user_email = '$email'";
 		$run_query = mysqli_query($conn,$query);
 		$row = mysqli_fetch_array($run_query);
 		if($row) //if mail found send a recovery string
 		{
 			$string = random_string(30);
 			session_start();
 			$_SESSION['recover'] = $string;
 			$_SESSION['id'] = $row['user_id'];
 			$to = $email;
            $subject = 'Recover Your Password';
            $sender = 'mmursaleen92@gmail.com';
         
            $message = "<b>Here is Recover Link</b>";
            $message .= "<h1><a href='localhost/course/new_pass.php?recover=$string'>Recover Password</a></h1>";
         
            $header = "From:$sender; \r\n";
            $header .= "Cc:$email \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
 			
 		}
 		else
 		{
 			echo 'Mail did not exist';
 		}
 		

 		
 	}
 }


?>
<!DOCTYPE html>
<html>
<head>
	<title>Forgot Password</title>
</head>
<body>
<form method="post" action="">
	<label>
		E-mail
	</label>
	<input type="email" name="email" placeholder="example@gmail.com" required><br /><br />
	<input type="submit" name="recover" value="Recover Account">
</form>
</body>
</html>