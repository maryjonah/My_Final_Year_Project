<?php
	$id = $_GET['id'];
	mysql_connect("localhost","root","");
		mysql_select_db("timetable");
	
		$order = "SELECT * FROM newmembers where id = '$id'";
		$result = mysql_query($order);
		$row = mysql_fetch_array($result);	
	
	 $firstname = $row['firstname'];
	 $lastname = $row['lastname'];
	 $email = $row['email'];
	 $deptid = $row['deptid'];
	 $id = $row['id'];
	
	$order = "DELETE FROM newmembers WHERE id = '$id'";
	
	mysql_query($order);
	header("location:members.php");
?>
