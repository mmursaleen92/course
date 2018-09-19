<?php
function escape($string)  // Clear the input String
{
	global $conn;
	$string = mysqli_real_escape_string($conn,$string);
	// print_r($string);break;
	return $string;
}
function random_string($length) // Generate Random string Use in recover Password
{
	global $conn;
	$str = "";
	$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'), ['!','@','%','^']);
	$max = count($characters) - 1;
	for($i = 0; $i < $length; $i++)
	{
		$rand = mt_rand(0,$max);
		$str .= $characters[$rand];
		// $str .= $str;
	}
	return $str;
}

?>