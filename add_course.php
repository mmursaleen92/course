<?php include "db_connection.php" ?>
<?php include "functions.php" ?>
<?php $id = $_GET['id']; 
     // print_r($id);break;
     ?>
<?php
   if(isset($_POST['add']))
   {
   	$course = escape($_POST['course']);
   //	$name = escape($_POST['name']);
   	if(empty($course))
   	{
   		die('No Course Added');
   	}
   	else
   	{
      $check = "SELECT * FROM courses";
      $course_check = mysqli_query($conn,$check);
      while($course_row = mysqli_fetch_assoc($course_check))
      {
        $table_course = $course_row['course_name'];
        if($table_course == $course)
        {
          echo "SOMEONE Already Taken This Please Try Another One.";
          header("Locahion:welcome_teacher.php?id=$id");
          die();
        }
      }
   		$query = "INSERT INTO courses (course_name,user_id) VALUES ('$course','$id') ";
   		$run_query = mysqli_query($conn,$query);
   		if($run_query)
   		{
   			echo "<script>
                     alert('Course Added');
                     window.location.href='welcome_teacher.php?id=$id';
   			    </script>";
   		}
   		else
   		{
   			echo 'Query Failed to add course '.mysqli_error($conn);
   		}
   	}
   }

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Course</title>
</head>
<body>
<form method="post" action="">
    <label>Add Course </label>
    <input type="text" name="course" placeholder=" Course Name">      
  <!-- <label>Your Name</label>
     <input type="text" name="name"><br /> -->
    <input type="submit" name="add" value="Add Course">

</form>

</body>
</html>