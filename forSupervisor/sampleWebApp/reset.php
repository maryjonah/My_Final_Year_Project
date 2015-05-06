<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Exam Timetable Generator</title>
  <link rel="stylesheet" type="text/css" href="css/main.css" />
</head>
<body>
 <?php

	session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }

 ?>

 <?php
	$msg = "";
	$redirect = "";
		$id = $_GET['id'];
		mysql_connect("localhost","root","");
		mysql_select_db("timetable");

		$order = "SELECT * FROM newmembers where id = '$id'";
		$result = mysql_query($order);
		$row = mysql_fetch_array($result);

	  if (isset($_POST['submit'])) {

		require('connectTimetable.php');
		$dbc=$database_connect;
		$password = $_POST['password'];
		$newpassword = $_POST['newpassword'];
		$newpassword1 = $_POST['newpassword1'];
		$id = $_POST['id'];

		if(!empty($password)&&(!empty($newpassword))&&(!empty($newpassword1)) ){

				$order = "UPDATE newmembers SET password ='$newpassword' WHERE id = '$id'";
				mysql_query($order,$dbc);
				header("location:membersView.php");
				}
		else{
			$msg = "FILL ALL FIELDS";

		}

}
?>

<div id="container">

						<!--THE BEGINNING OF THE HEADER-->

  <div id="header">

		<?php include 'header.php'?>

  </div>
  <!--THE END OF THE HEADER-->

  <!--THE BEGINNING OF THE SIDEBAR-->
  <div id="sidebar">
  <p><a href = "membersView.php" style = "color:blue;text-align:center;font-size:15px;">
	TIMETABLE PAGE</a>
  </p>


  <?php
  if (isset($_SESSION['username'])) {

    echo '<a href="logout.php" style="font-size:15px;color:#0000FF;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>

  </div>
  <!--THE END OF THE SIDEBAR-->


  <!--THE BEGINNING OF THE CONTENT-->

  <div id="content">
 <table align = "center">
 <div style = "text-align:center;color:red;font-weight:bold"><?php echo $msg;?></div>




  <form method="post" action = "#" id = "newMember">
	<br />
    <input type = "hidden" name = "id" value = "<?php echo "$row[id]"?>">

		<tr>
			<td><label for  ="firstname">  Password:</label></td>
			<td><input type ="password" id="password"  name="password"/></td>
		</tr>
		<tr>
			<td><label for  ="newpassword">New Password:</label></td>
			<td><input type ="password" id="newpassword"  name="newpassword"/></td>
		</tr>
		<tr>
			<td><label for  ="newpassword1">Re-enter New Password:</label></td>
			<td><input type ="password" id="newpassword1"  name="newpassword1"/></td>
		</tr>

	</table>
	  <div id = "addMember" style = "text-align:center;">
			<input type="submit" value="Update" name="submit" />
			<a href = "membersView.php">Cancel</a>
	  </div>

  </form>

  </form>

  </div>
  <!--THE END OF THE CONTENT-->


  <!--THE BEGINNING OF THE FOOTER-->
  <div id="footer">
		<?php include 'footer.php'?>
  </div>
  <!--THE END OF THE FOOTER-->

</div>
<!---THE END OF THE CONTENT DIV -->


</body>
</html>
