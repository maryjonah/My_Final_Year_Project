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
<link rel="stylesheet" href="css/table.css" type="text/css" />
<link rel="stylesheet" href="css/paginationStyle.css" type="text/css" />
<link rel="stylesheet" href="css/paginationStyle.css" type="text/css" />

</head>
<body>


  
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
  <div id="sidebar" style="margin-left:20px;">
  <p><a href = "advancedSearch.php" style = "font-size:15px;color:blue">SEARCH OPTIONS</a></p>
  <p><a href = "courses.php" style = "color:blue;text-align:center;font-size:15px;">
	COURSES PAGE</a></p>
	
  <?php

  if (isset($_SESSION['username'])) {
    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }
	
  ?>
  
 
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  <div id = "content">
		
			<?php
		
		mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
		mysql_select_db("timetable") or die(mysql_error());
	?>

<?php
	$error_msg = "";
    $query = $_GET['levels']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysql_real_escape_string($query);
         
        $raw_results = mysql_query("SELECT * FROM course WHERE (`Level` LIKE '%".$query."%')") or die(mysql_error());
                      
        if(mysql_num_rows($raw_results) > 0){ 
                          				
				echo '<table border = "1" style ="margin-left:90px;width:550px;" >';
				echo
						'<tr>
							<th colspan = "1">CourseCode </th>
							<th            >Name  </th>
							<th colspan = "1">Programme      </th>
							<th colspan = "1">Department  </th>

						</tr>';
				
	           while($results = mysql_fetch_array($raw_results)){

				echo
						
							'<tr>
								<td><strong>' . $results['CourseCode'] . '</strong></td>
								<td colspan = "1">' . $results['Name'] . '</td>
								<td colspan = "1">' . $results['Programme'] . '</td>
								<td colspan = "1">' . $results['Department'] . '</td>
							    <td><a href="delete.php?id=' . $results['CourseId'] . '"><img src = "images/delete.png"></a></td>
								<td><a href="editCourse.php?id='.$results['CourseId']. '"><img src = "images/edit.png"></a></td>

							</tr>';
            }
            
        }
        else{ 
            $error_search = "No results";
        }
         
    }
    else{ 
       $error_search = '<p class = "error" style="text-align:center;">Minimum length of keyword is '.$min_length.'</p>';
    }
	
	echo '</table>';
?>

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
