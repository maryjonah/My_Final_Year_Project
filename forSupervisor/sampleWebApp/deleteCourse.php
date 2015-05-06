<?php	
	$id = $_GET['Courseid'];
	mysql_connect("localhost","root","");
		mysql_select_db("timetable");
	
	$order = "SELECT * FROM course where id = '$id'";
	$result = mysql_query($order);
		
	$order = "DELETE FROM course WHERE CourseId = '$id'";
	
	mysql_query($order);
	header("location:courses.php");
?>
