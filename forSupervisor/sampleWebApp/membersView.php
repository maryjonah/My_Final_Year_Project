<?php
	error_reporting(0);
	//set_time_limit(200);
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
<link rel= "stylesheet" href = "css/table.css"/>


</head>
<body>


  
<div id="container">

						<!--THE BEGINNING OF THE HEADER-->

  <div id="header">
   			
		<?php include 'header.php'?>	
	
  </div>
  <!--THE END OF THE HEADER-->
  
  
  <!--THE BEGINNING OF THE SIDEBAR-->
  <div id="sidebar" style = "margin-top:20px;">
  
  <?php
  
  require_once('connectTimetable.php');
  
  $id = $_GET['id'];

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  $query = "SELECT * FROM newmembers";
  $data = mysqli_query($dbc, $query);
  
    while ($row = mysqli_fetch_array($data)) {}

  if (isset($_SESSION['username'])) {  
    echo '<a href="reset.php?id='.$id. '" style="font-size:15px;color:red;border-bottom:dotted 4px #ccc;">Reset Password</a><br>';
    echo '<a href="logout.php" style="font-size:15px;color:#0000FF;">Log Out (' . $_SESSION['username'] . ')</a><br>';
  }

  ?>
 
	<?php include 'memberSearchbar.php'?>
    
	<form action="memberFinalLevel.php" method="GET" id = "levels" name = "levels" style = "margin-top:20px;">
	<p style="font-size:15px;color:#0000FF;">Search By Level</p>
		<select name = "levels" >
			<option>100</option>
			<option>200</option>
			<option>300</option>
			<option>400</option>
		</select><br>
		<input type="submit" value="Search" />
	</form>
	
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style = "margin-top:-15px;">
	  <div id="content" style = "margin-top:-20px;">
    <p id = "intro">
	
	<table border = "1"style = "margin-left:70px;">
			<tr>
				<th>Date(M/D/Y)  </th>			
				<th>CourseId  </th>
				<th>Duration  </th>
				<th>Programme </th>
				<th>VenueCode  </th>
			</tr>
	
<?php
			include("pagination.php"); 

			$con = mysql_connect('localhost','root','',false,65536);
			mysql_select_db('timetable');
	
			$result = mysql_query("SELECT * FROM finaltimetable ORDER by Date");
			$result_num =mysql_num_rows($result);

 ?>
	
	
	
	<?php
		while($row = mysql_fetch_array($result)){
			echo 
				'<tr>
					 <td>'.strtoupper($row['Date']).'</td>				
					 <td>'.strtoupper($row['CourseId']).'</td>
					 <td>'.strtoupper($row['Duration']).'</td>					 
					 <td>'.strtoupper($row['Programme']).'</td> 					 
					 <td>'.strtoupper($row['VenueCode']).'</td>
				</tr>';
		}
	?>
	
	</table>

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
