<?php include "db_connection.php" ?>
<?php

    $delete = $_GET['delete'];
    ?>
    <form method="post" action="">
    <label>Your Courses</label>
   <select name="deleteit"> 
    <?php 
       $query = "SELECT * FROM courses WHERE user_id = '$delete'";
       $r = mysqli_query($conn,$query);
       
      // print_r($row);break;
       while($row = mysqli_fetch_array($r))
       {
       	$course_name = $row['course_name'];
      // 	print_r($course_name);break;
       	
       	
       	echo "<option>  $course_name </option>"; 
       	
       } 	?>
   </select>
   
   <input type="submit" name="del" value="Delete">
   </form>
   <?php
           if(isset($_POST['del']))
           {
              $deleteit = $_POST['deleteit'];
              $query_2 = "SELECT * FROM users WHERE user_id = '$delete'";
              $r_2 = mysqli_query($conn,$query_2);
              $row_2 = mysqli_fetch_assoc($r_2);
              $role = $row_2['user_role'];
              $query_1 = "DELETE FROM courses WHERE course_name = '$deleteit'";
          //    print_r($query);break;
              $run = mysqli_query($conn,$query_1);
              if($run)
              {
              	echo "<script>
              	alert('Delete Success');
              	</script>";
              	// header("Location:")
              	Switch($role)
              	{
              		case 'Teacher':
              		header("Location:welcome_teacher.php?id=$delete");
              		break;
              		case 'Student':
              		header("Location:welcome_student.php?id=$delete");
              		break;
              	}
              }
              else
              {
              	echo 'Error delete course'.mysqli_error($conn);
              }
           }

   ?>
    