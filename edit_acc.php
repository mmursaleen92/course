<?php include "db_connection.php" ?>
<?php include "functions.php" ?>
<?php
   if(empty($_GET['edit']))
   {
   	die('Access Denied');
   }
   else
   {
   	$id = $_GET['edit'];
   }
?>
<?php
$query = "SELECT * FROM users WHERE user_id = '$id'";
$run_query = mysqli_query($conn,$query);
$row = mysqli_fetch_assoc($run_query);
    $name = $row['user_name'];
    $password = $row['user_password'];
    $image = $row['user_image'];
    $role = $row['user_role'];

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Teacher Account</title>
</head>
<body>
   <form method="post" action="" enctype="multipart/form-data">
   	<label>Name : </label>
   	<input type="text" name="name" value="<?php echo $name; ?>"><br /><br />
   <!-- 	<label>Password : </label>
   	 <input type="password" name="password" value="<?php // echo $password; ?>"><br /><br /> -->

   	<img src="images/<?php echo $image; ?>" height="100" width="100"><br /><br />

   	<label> Change Image </label>

   	<input type="file" name="image" ><br /><br />

   	<input type="submit" name="update" value="Update Account">
   </form>
   <a href='change_pass.php?id=<?php echo $id; ?>'><button>Change Password</button></a><br /><br />
</body>
</html>
<?php
    if(isset($_POST['update']))
    {
    	$name = escape($_POST['name']);
    //	$password = escape($_POST['password']);
    	$image = $_FILES['image']['name'];
    	$image_loc = $_FILES['image']['tmp_name'];
    	// $password_1 = md5($password);
    	// $password_2 = sha1($password_1);
    	if(empty($image))
    	{
    		$query = "UPDATE users SET user_name = '$name'    		                           
    		                          WHERE user_id = '$id'";
    		     $run_query = mysqli_query($conn,$query);
    		     if($run_query)
    		     {
    		     	echo "<script>
    		     	alert('Update Successfully');
    		     	   	</script>";
    		     	   	if($role == 'Teacher')
    		     	   	{
    		     	   		echo "<script>
    		     	alert('Update Successfully');
    		     	   	</script>";
    		     	   		header("Location:welcome_teacher.php?id=$id");
    		     	   	}
    		     	   	else
    		     	   	{
    		     	   		echo "<script>
    		     	alert('Update Successfully');
    		     	   	</script>";
    		     	   		header("Location:welcome_student.php?id=$id");
    		     	   	}
    		     }
    		     else
    		  {
    		  	echo 'Query Failed '.mysqli_error($conn);
    		  }
    	}
    	else
    	{
    	if(move_uploaded_file($image_loc,"images/$image"))
    	{
    		$query = "UPDATE users SET user_name = '$name',    		             
    		            user_image = '$image' WHERE user_id = '$id'";
    		  $run_query = mysqli_query($conn,$query);
    		  if($run_query)
    		  {
    		  	echo "<script>
    		     	alert('Update Successfully');
    		     	   	</script>";
    		     	   	if($role == 'Teacher')
    		     	   	{
    		     	   		echo "<script>
    		     	alert('Update Successfully');
    		     	   	</script>";
    		     	   		header("Location:welcome_teacher.php?id=$id");
    		     	   	}
    		     	   	else
    		     	   	{
    		     	   		echo "<script>
    		     	alert('Update Successfully');
    		     	   	</script>";
    		     	   		header("Location:welcome_student.php?id=$id");
    		     	   	}
    		  }
    		  else
    		  {
    		  	echo 'Query Failed Image '.mysqli_error($conn);
    		  }
    	}
    	else
    	{
    		echo 'Image Upload Failed '.mysqli_error($conn);
    	}
    }
    }

?>