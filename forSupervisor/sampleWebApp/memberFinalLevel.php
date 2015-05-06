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
  
  
  <!--THE BEGINNING OF THE SIDEBAR-->
  <div id="sidebar" style="margin-left:20px;">
  <p><a href = "membersView.php" style = "color:blue;text-align:center;font-size:15px;">
	TIMETABLE PAGE</a></p>
  <?php
  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
    echo '<a href="reset.php?id='.$id. '" style="font-size:15px;color:red;border-bottom:dotted 4px #ccc;">Reset Password</a><br>';
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
         
        $raw_results = mysql_query("SELECT * FROM finaltimetable WHERE (`Level` LIKE '%".$query."%') ORDER BY Date") or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
                          				
				echo '<table border = "1" style ="margin-left:90px;width:550px;" >';
				echo
						'<tr>
							<th colspan = "1">Date </th>
							<th            >CourseId  </th>
							<th colspan = "1">Duration      </th>
							<th colspan = "1">Programme  </th>
							<th colspan = "1">VenueCode  </th>

						</tr>';
				
	           while($results = mysql_fetch_array($raw_results)){

				echo
						
							'<tr>
								<td>' . $results['Date'] . '</td>
								<td colspan = "1"><strong>' . $results['CourseId'] . '</strong></td>
								<td colspan = "1">' . $results['Duration'] . '</td>
								<td colspan = "1">' . $results['Programme'] . '</td>
								<td colspan = "1">' . $results['VenueCode'] . '</td>

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
