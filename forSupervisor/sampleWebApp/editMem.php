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
  
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
 ?>
<div id="container">

						<!--THE BEGINNING OF THE HEADER-->

  <div id="header">
   			
		<?php include 'header.php'?>	
	
  </div>
  <!--THE END OF THE HEADER-->
  
  <!--THE BEGINNING OF THE MENUBAR-->
  <div id = "menuPanel">
			<?php include 'menuPanel.php'?>
			
   </div>
   <!--THE END OF THE MENU PANEL-->
  
  <!--THE BEGINNING OF THE SIDEBAR-->
  <div id="sidebar">
  
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

<?php
  error_reporting(0);

		$id = $_GET['id'];
		mysql_connect("localhost","root","");
		mysql_select_db("timetable");
	
		$order = "SELECT * FROM newmembers where id = '$id'";
		$result = mysql_query($order);
		$row = mysql_fetch_array($result);	

?>

  <form method="post" action = "edit.php" id = "newMember">

	  <br /><br />
    <input type = "hidden" name = "id" value = "<?php echo "$row[id]"?>">

		<tr>
			<td><label for  ="firstname">  FirstName:</label></td>
			<td><input type ="text" id="firstname"  name="firstname" value = "<?php echo "$row[firstname]"?>"/></td>
		</tr>
		<tr>
			<td><label for  ="lastname">LastName:</label></td>
			<td><input type ="text" id="lastname"  name="lastname" value = "<?php echo "$row[lastname]"?>"/></td>
		</tr>
		<tr>
			<td><label for  ="deptid">Department:</label></td>
			<td><input type ="text" id="deptid"  name="deptid" value = "<?php echo "$row[deptid]"?>"/></td>
		</tr>
		
	</table>
	  <div id = "addMember" style = "text-align:center;">
			<input type="submit" value="Update" name="submit" />
			<a href = "members.php">Cancel</a>
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
