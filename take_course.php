<?php include "db_connection.php" ?>
<?php if(empty($_GET['id']))
{
	echo "Something Went Wrong";
}
else
{
	$id = $_GET['id'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Take Course</title>
</head>
<body>
<form method="post" action="">
	<label>
		We Offer Courses :
	</label>
	
           <select name="course_name">
           <?php 
          $query = "SELECT * FROM courses";
          $run_query = mysqli_query($conn,$query);
          while($row = mysqli_fetch_array($run_query))
          {
          	$course = $row['course_name'];
          	if(!empty($course))
          	{
          	echo "<option>
          	       $course
          	       </option>";
          	       }
          	       else
          	       	{continue;}
          	

          }  ?>

           
            
           </select>
           
	
	<input type="submit" name="take" value="Take Course">
</form>
</body>
</html>
<?php
    if(isset($_POST['take']))
    {
    	$course = $_POST['course_name'];
    	// print_r($course);break;
    	$query = "INSERT INTO courses (take_course,user_id) VALUES ('$course','$id')";
    	// print_r($query);break;
    	$run_query = mysqli_query($conn,$query);
    	if($run_query)
    	{
    		echo "<script>
    		alert('Register for course Successfully');
    		window.location.href='welcome_student.php?id=$id';
    		</script>";
    		// header("Location:welcome_student.php?id=$id");
    	}
    	else
    	{
    		echo 'Query Error '.mysqli_error($conn);
    	}
    }

?>