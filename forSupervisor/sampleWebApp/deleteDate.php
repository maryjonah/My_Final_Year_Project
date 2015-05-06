<?php	
	$id = $_GET['id'];
	mysql_connect("localhost","root","");
		mysql_select_db("timetable");
	
	$order = "SELECT * FROM date where id = '$id'";
	$result = mysql_query($order);
	$row = mysql_fetch_array($result);	
	
	$date = $row['Date'];
	$day = $row['Day'];
	
	$order = "DELETE FROM date WHERE DateId = '$id'";
	
	mysql_query($order);
	header("location:disDate.php");
?>
