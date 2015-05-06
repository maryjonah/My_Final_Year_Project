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
<head>
<title>Exam TimeTable Generator</title>
<meta charset=utf-8" />
<link rel="stylesheet" href="css/main.css" type="text/css" />
<link rel="stylesheet" href="css/table.css" type="text/css" />

</script>

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
  // Generate the navigation menu
  if (isset($_SESSION['username'])) {

    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>
         
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  <div>
  <div id="content" style = "margin-left:200px;">
	<div><?echo $msg;?></div>
	<div><?echo $dateError;?></div>
	<form action = "dates.php" method = "post" style ="width:400px;margin-top:-25px;">
		<p style = "margin-left:120px;margin-bottom:-20px;color:blue;font-weight:bold;">DATES</p>
		<p>
			<label>Start Date</label>
			<input type = "date" id = "t1" name = "date_from">
		</p>
		<p>
			<label>End Date</label>&nbsp;
			<input type = "date" id = "t2" name = "date_to">
		</p>		
	
		<p style = "margin-left:120px;margin-bottom:-20px;color:blue;font-weight:bold;">TIMES</p>

		<p>
			<label>Morning</label>&nbsp;&nbsp;
			<input type = "time" id = "t1" name = "mstym"> - 
			<input type = "time" id = "t1" name = "metym">
		</p>
		<p>
			<label>Afternoon</label>
			<input type = "time" id = "t1" name = "astym"> - 
			<input type = "time" id = "t1" name = "aetym">
		</p>
		<p>
			<label>Evening</label>&nbsp;&nbsp;
			<input type = "time" id = "t1" name = "estym"> - 
			<input type = "time" id = "t1" name = "eetym">
		</p>
		
		<input type = "submit" id = "btnViewDates" value = "View Dates"style = "margin-left:100px;">

	</form>
	
	</div>

	<!--THE END OF THE CONTENT-->
  
  
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
