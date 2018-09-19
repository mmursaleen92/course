<?php include "db_connection.php"; ?>
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
     	die('User Not Exist');
     }
     else
     {
     $id = $_GET['id'];	
     }
     ?>
<!DOCTYPE html>
<html>
<head>
	<title>Welcome Student</title>
</head>
<body>
<center><h1>Welcome</h1></center>
<table width="100%" align="center" border="1">
<thead>
   <tr>
	<th>Name</th>
	<th>Image</th>
	<th>Take Course</th>
	<th>Update</th>
    <th>LogOut</th>
    <th>Delete Course</th> 
	<!-- <th>Your Instructor Name</th> -->
	<th>Your Course</th>
    
	</tr>
</thead>
    <tbody width="100%" align="center" border="1">
    	<tr>
    	<?php 
    	$query = "SELECT * FROM users WHERE user_id = '$id'";
    	// print_r($query);break;
    	$run_query = mysqli_query($conn,$query);
    	if($run_query)
    	{
    	$row = mysqli_fetch_assoc($run_query);
    	$name = $row['user_name'];
    	$image = $row['user_image'];
    	  }

    	?>
    		<td><?php echo $name; ?></td>
    		<td><img src="images/<?php echo $image; ?>" height="100" width="100"></td>
    		<td><a href="take_course.php?id=<?php echo $id; ?>"><button>Take Course</button></a></td>
    		<td><a href="edit_acc.php?edit=<?php echo $id; ?>"><button>edit</button></a></td>
            <td><a href="logout.php"><button>LogOut</button></a></td>
             <td><a href="delete_course.php?delete=<?php echo $id; ?>"><button>Delete Course</button></a></td> 

    		

    		<!-- <td></td> --><td>
            <?php 
             $course_query = "SELECT * FROM courses WHERE user_id = '$id'";

             $run_course_query = mysqli_query($conn,$course_query);

             $count = mysqli_num_rows($run_course_query);
             if($count)
             {
                while($row_course = mysqli_fetch_assoc($run_course_query))
                {
                    $course_name = $row_course['take_course'];
                    // print_r($course_name);break;
                  echo " $course_name <br />"; 
                }
             }
             else
             {
                echo " No Course Selected  ";
             }
             
             
             // else
             //    echo 'Query Failed Badely'.mysqli_error($conn);

             ?></td>

    		
    	</tr>
    </tbody>
</table>
</body>
</html>