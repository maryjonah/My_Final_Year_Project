<?php	
	mysql_connect("localhost","root","");
	mysql_select_db("timetable");	
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];
	$deptid = $_POST['deptid'];
	$id = $_POST['id'];
	
	$order = "UPDATE newmembers SET firstname ='$firstname', lastname = '$lastname', email = '$email', deptid = '$deptid' WHERE id = '$id'";
	mysql_query($order);
	header("location:members.php");
?>
