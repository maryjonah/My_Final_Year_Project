<?php
  error_reporting(0);
  session_start();
  
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Exam TimeTable Generator</title>
<meta charset=utf-8" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
</head>
<body>


<div id="container">

						<!--THE BEGINNING OF THE HEADER-->

  <div id="header">
   			
		<?php include 'header.php';?>
	
  </div>
  <!--THE END OF THE HEADER-->
  
  <!--THE BEGINNING OF THE MENUBAR-->
  <div id = "menuPanel">
			<?php include 'menuPanel.php';?>
			
   </div>
   <!--THE END OF THE MENU PANEL-->
  
  <!--THE BEGINNING OF THE SIDEBAR-->
  
  <div id="sidebar" style = "margin-left:-30px;">
  
  <?php

  if (isset($_SESSION['username'])) {

    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>
 
  <form action="searchMem.php" method="GET" >
	<select name = "departments" >
			<option>AGRICULTURAL ECONOMICS AND EXT</option>
					<option>AGRICULTURAL ENGINEERING DEPAR</option>
					<option>ANIMAL SCIENCE DEPARTMENT</option>
					<option>CHEMISTRY DEPARTMENT</option>
					<option>COMPUTER SCIENCE DEPARTMENT</option>
					<option>CROP SCIENCE DEPARTMENT</option>
					<option>DEPT. OF SCI. & MATHS EDU.<option>
					<option>DEPARTMENT OF BIOCHEMISTRY</option>
					<option>LABTEC DEPARTMENT</option>
					<option>MATHEMATICS AND STATISTICS DEP</option>
					<option>PHYSICS DEPARTMENT</option>
					<option>SOIL SCIENCE DEPARTMENT</option>
	</select>
			<br />
		<input type="submit" value="Search" />
	</form>
        
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style="margin-left:150px">
	
	<?php include 'displayMem.php';?>
	<div id = "addNew">
		<a href = "insertMembers.php">Add New Member</a>
	</div>
  </div>
  <!--THE END OF THE CONTENT-->
  
  
  <!--THE BEGINNING OF THE FOOTER-->
  <div id="footer">
		<?php include 'footer.php';?>
  </div>
  <!--THE END OF THE FOOTER-->
  
</div>
<!---THE END OF THE CONTENT DIV -->


</body>
</html>
