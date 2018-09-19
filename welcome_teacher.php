<?php include "db_connection.php" ?>
<?php
session_start();
if(!isset($_SESSION['email']))
{
    header("location:login.php");
}
?>
<?php 
       if(empty($_GET['id']))
       {
       	die('No Teacher Found');
       }
       else
       {
       	$id = $_GET['id'];
       }

     ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Teacher</title>
</head>
<body>
<center><h1>Welcome</h1></center>
<table width="100%" border="1" align="center">
	<thead>
		<tr>
			<th>Name</th>
			<th>Image</th>
			<th>Add Courses</th>
			<th>Edit Account</th>
			<th>Delete Courses</th>
			<th>LogOut</th>
			<th>Your Courses</th>
						
		</tr>
	</thead>
	<tbody width="100%" border="1" align="center">
		<tr>
		<?php
             $query = "SELECT * FROM users WHERE user_id = '$id'";
             $run_query = mysqli_query($conn,$query);
             $row = mysqli_fetch_assoc($run_query);
             $id = $row['user_id'];
             $name = $row['user_name'];
             $image = $row['user_image'];
             ?>        
			<td><?php echo $name; ?></td>
			<td><img src="images/<?php echo $image; ?>" height="100" width="100"></td>
			<td><a href="add_course.php?id=<?php echo $id; ?>"><button>Add Courses</button></a></td>
			<td><a href="edit_acc.php?edit=<?php echo $id; ?>"><button>edit</button></td>
			<td><a href="delete_course.php?delete=<?php echo $id; ?>"><button>Delete Course</button></a></td>
			<td><a href="logout.php"><button>LogOut</button></a></td>
			<td>
			<?php 
			$course_query = "SELECT * FROM courses WHERE user_id = '$id'";
			$run_course_query = mysqli_query($conn,$course_query);
			$count = mysqli_num_rows($run_course_query);
			//	$row_course = mysqli_fetch_array($run_course_query); 
			if($count)
			{
			  while($row_course = mysqli_fetch_assoc($run_course_query))
				{
					
					$course_teacher = $row_course['course_name'];
					?>
				<?php echo " $course_teacher <br /> "; ?> 
				
		<?php	} }
			else
			{
			  echo "No Course Yet";
			}
			?>
			</td>			
			<!-- <td><?php // echo $course; ?></td> -->
		</tr>
	</tbody>
</table>
</body>
</html>