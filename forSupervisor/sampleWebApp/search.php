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
<link rel="stylesheet" href="css/main.css" type="text/css"/>
<link rel="stylesheet" href="css/table.css" type="text/css"/>


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
  
  <div id="sidebar">
		
	<?php
		if (isset($_SESSION['username'])) {
		echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }
	
  ?>
  
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content">

	<?php
		mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
		mysql_select_db("timetable") or die(mysql_error());
	?>

<?php
	$error_msg = "";
    $query = $_GET['query']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysql_real_escape_string($query);
         
        $raw_results = mysql_query("SELECT * FROM finaltimetable
            WHERE (`Programme` LIKE '%".$query."%') OR (`CourseId` LIKE '%".$query."%')") or die(mysql_error());
                     
        if(mysql_num_rows($raw_results) > 0){ 
                          				
				echo '<table border = "1" style="margin-top:-35px;margin-left:50px;" >';
				echo
						'<tr>
							<th colspan = 2>Programme </th>
							<th            >CourseId  </th>
							<th colspan = 2>Date      </th>
							<th colspan = 2>Duration  </th>
							<th colspan = 2>VenueCode </th>

						</tr>';
				
	           while($results = mysql_fetch_array($raw_results)){

				echo
						
							'<tr>
								<td><strong>' . $results['Programme'] . '</strong></td>
								<td colspan = "2">' . $results['CourseId'] . '</td>
								<td colspan = 2>' . $results['Date'] . '</td>
								<td colspan = 2>' . $results['Duration'] . '</td>
								<td colspan = 2>' . $results['VenueCode'] . '</td>

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
	
    echo '<p class="error">' . $error_search . '</p>';
	echo '</table>';
?>
 <!--THE BEGINNING OF THE FOOTER-->
  <div id="footer" style= "margin-top:20px;">
		<?php include 'footer.php'?>
  </div>
  <!--THE END OF THE FOOTER-->

</body>
</html>
