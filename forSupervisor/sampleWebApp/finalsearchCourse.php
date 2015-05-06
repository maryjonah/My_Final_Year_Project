<?php
    session_start();

	 if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
?>

<?php
		
		mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
		mysql_select_db("timetable") or die(mysql_error());
	?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Exam TimeTable Generator</title>
<meta charset=utf-8" />
<link rel="stylesheet" href="css/main.css" type="text/css"/>
<link rel="stylesheet" href="css/table.css" type="text/css"/>
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
  
  <div id="sidebar" style = "margin-left:10px;">
    <p><a href = "finaladvancedSearch.php" style = "font-size:15px;color:blue">SEARCH OPTIONS</a></p>
   <p><a href = "displayfinaltimetable.php" style = "color:blue;text-align:center;font-size:15px;">
	TIMETABLE PAGE</a></p>
	
<?php
  if (isset($_SESSION['username'])) {
    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>
  
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style ="width:700px;" >
  
  <?php
	$error_search = "";
    $query = $_GET['query']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysql_real_escape_string($query);
         
        $raw_results = mysql_query("SELECT * FROM finaltimetable WHERE(`CourseId` LIKE '%".$query."%') ORDER BY Date") or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
                          				
				echo '<table border = "1" style ="margin-left:90px;width:550px;" >';
				echo
						'<tr>
							<th colspan = "1">Date(M/Y/D) </th>
							<th            >CourseId  </th>
							<th colspan = "1">Duration      </th>
							<th colspan = "1">Programme  </th>
							<th colspan = "1">VenueCode  </th>
							<th colspan = "1">Department  </th>

						</tr>';
				
	           while($results = mysql_fetch_array($raw_results)){

				echo
						
							'<tr>
								<td>' . $results['Date'] . '</td>
								<td colspan = "1"><strong>' . $results['CourseId'] . '</strong></td>
								<td colspan = "1">' . $results['Duration'] . '</td>
								<td colspan = "1">' . $results['Programme'] . '</td>
								<td colspan = "1">' . $results['VenueCode'] . '</td>
								<td colspan = "1">' . $results['department'] . '</td>


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
	<div style = "color:red; text-align:center;margin-left:70px;FONT-WEIGHT:BOLD;" ><?php echo $error_search?></div>
	
</div>
 <!--THE BEGINNING OF THE FOOTER-->
  <div id="footer" style= "margin-top:40px;width:900px;">
		<?php include 'footer.php'?>
  </div>
  <!--THE END OF THE FOOTER-->

</body>
</html>
