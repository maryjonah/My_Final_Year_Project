<?php
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
      echo '<a href="members.php" style="font-size:15px;color:#0000ff;margin-bottom:10px;">MEMBERS PAGE</a><br>';
    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }
	
  ?>
  
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style = "width:900px;margin-left:-30px;">

	<?php
		mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());
		mysql_select_db("timetable") or die(mysql_error());
	?>

<?php
	$error_msg = "";
    $query = $_GET['departments']; 
     
    $min_length = 3;
     
    if(strlen($query) >= $min_length){ 
         
        $query = htmlspecialchars($query); 
         
        $query = mysql_real_escape_string($query);
		
         $query = strtoupper($query);
		 
        $raw_results = mysql_query("SELECT * FROM newmembers
            WHERE(`deptid` LIKE '%".$query."%')") or die(mysql_error());
         
        if(mysql_num_rows($raw_results) > 0){ 
                          				
				echo '<table style="margin-top:-35px;margin-left:200px;">';
				
				echo	
				'<tr style="color:#0000ff;margin-left:50px;">
				<th>FIRSTNAME</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>LASTNAME</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>DEPARTMENT</th>
		</tr>';
				
	           while($results = mysql_fetch_array($raw_results)){

				echo
						
							'<tr>
								<td>' . $results['firstname'].' </td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>' . $results['lastname'].' </td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td>' . $results['deptid'].' </td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>
								<td><a href="delete.php?userid=' . $results['id'] . '"><img src = "images/delete.png"></a></td>
								<td>&nbsp;</td>
								<td>&nbsp;</td>								
								<td><a href="editMem.php?firstName=' . $results['firstname'] . '&amp;lastName=' . $results['lastname'] .
									'&amp;email=' . '&amp;userid=' . $results['id'] . '"><img src = "images/edit.png"></a>
								</td>
							</tr>';
            }
            
        }
        else{
            echo "NO RESULTS";
        }
         
    }
    else{
       $error = '<p class = "error">Minimum length is '.$min_length.'</p>';
    }
	
    echo '<p class="error" style = "text-align;center;color=blue">' . $error_msg . '</p>';
	echo '</table>';
?>
<p><a href = "members.php"></a></p>
 <!--THE BEGINNING OF THE FOOTER-->
  <div id="footer" style= "margin-top:20px;width = 700px;" >
		<?php include 'footer.php'?>
  </div>
  <!--THE END OF THE FOOTER-->

</body>
</html>
