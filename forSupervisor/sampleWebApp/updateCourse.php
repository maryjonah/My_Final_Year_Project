<?php	
	$id = $_POST['id'];
	mysql_connect("localhost","root","");
	mysql_select_db("timetable");	
	
	$courseCode = $_POST['courseCode'];
	$name = $_POST['name'];
	$level = $_POST['Level'];
	$studNo = $_POST['studNo'];
	$prg = $_POST['prg'];
	$dept = $_POST['dept'];
	
	$order = "UPDATE course SET CourseCode ='$courseCode', Name = '$name', Level = '$level', Number_Of_Students = '$studNo', Programme = '$prg', Department = '$dept' WHERE CourseId = '$id'";
	mysql_query($order);
	header("location:courses.php");
?>

