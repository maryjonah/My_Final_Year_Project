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
  // Generate the navigation menu
  if (isset($_SESSION['username'])) {

    echo '<a href="logout.php" style="font-size:15px;color:#0000FF;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>
         
  </div>
  <!--THE END OF THE SIDEBAR--> 
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style ="margin-left:90px;width:500px;>
  
<?php
  require_once('connectTimetable.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$msg = "";
	
  if (isset($_POST['submit'])) {
  
    $coursecode   = mysqli_real_escape_string($dbc, trim($_POST['coursecode']));
    $name         = mysqli_real_escape_string($dbc, trim($_POST['name']));
    $level        = mysqli_real_escape_string($dbc, trim($_POST['level']));
	$studNo       = mysqli_real_escape_string($dbc, trim($_POST['studNo']));
    $programme    = mysqli_real_escape_string($dbc, trim($_POST['programme']));
    $department   = mysqli_real_escape_string($dbc, trim($_POST['department']));

	$coursecode   = strtoupper($coursecode);
	$name         = strtoupper($name);
	$level        = strtoupper($level);
	$studNo       = strtoupper($studNo);
	$programme    = strtoupper($programme);
	$department   = strtoupper($department);
	
    if (!empty($coursecode) && !empty($name) && !empty($level) &&!empty($studNo) && !empty($programme) && !empty($department)) {
			
      $query = "SELECT * FROM course WHERE CourseCode = '$coursecode'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {

	  $query = "INSERT INTO course(CourseCode, Name, Level, Number_Of_Students, Programme, Department) VALUES ('$coursecode','$name','$level','$studNo','$programme','$department')";
       
	   mysqli_query($dbc, $query);

        $msg = "Account has been successfully created";
		header('Location: courses.php?success=1'); die; 

      }
      else {
        $msg = "Course already exists.";
        $username = "";
      }
    }
    else {
      $msg = "Fill out all fields";
    }
  }

  mysqli_close($dbc);
?>

  <form method="post" action="#" id = "newMember">
  
  <div id = "error" style = "margin-left:250px;margin-bottom:10px;color:red;font-weight:bold;">
	<?php echo $msg;?>
  </div>
  
	<table align = "center">
		<tr>
			<td><label for  ="coursecode">CourseCode:</label> </td>
			<td><input type ="text" id="coursecode" name="coursecode" /></td>
		</tr>
		<tr>
			<td><label for  ="text">Name:</label></td>
			<td><input type ="text" id="name" name="name" /></td>
		</tr>
		<tr>
			<td><label for  ="level">Level:</label></td>
			<td>
				<select name = "level">
					<option>100</option>
					<option>200</option>
					<option>300</option>
					<option>400</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for  ="studNo">  Number Of Students:</label></td>
			<td><input type ="text" id="studNo"  name="studNo" /></td>
		</tr>
		<tr>
			<td><label for  ="programme">Programme:</label></td>
			<td><input type ="text" id="programme" name="programme" /></td>
		</tr>
		<tr>
			<td><label for  ="department">Department:</label></td>
			<td>
				<select name = "department" >
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

			</td>
		</tr>
		
	</table>
	  <div id = "addMember" style = "text-align:center;">
			<input type="submit" value="Add" name="submit" />
			<a href = "courses.php">Cancel</a>
	  </div>

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
