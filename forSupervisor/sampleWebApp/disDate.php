<?php

  session_start();

  // If the session vars aren't set, try to set them with a cookie
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

  <div id="content" style = "margin-left:200px;">

	<form action = "pageGenerate1.php" style = "margin-left:120px;margin-top:-20px;margin-bottom:10px;">
		<input type = "hidden">
		<input type = "submit" id = "submit" value = "Generate TimeTable" name = "submit">
	</form>
<?php

	require('connectTimetable.php');
	$dbc=$database_connect;

	$query = "SELECT * FROM date";
	$data = mysql_query($query, $dbc);

	  echo '<table align = "center">';

	  echo	'<tr style="color:#0000ff;margin-left:50px;">
					<th>DATE(M/D/YR)</th>
					<th>DAY</th>
		</tr>';
  while ($row = mysql_fetch_array($data)) {
    // Display the score data
    echo '<tr>
			<td>' . strtoupper($row['Date']) .'
			<td>' . strtoupper($row['Day']) . '
			<td><a href = "deleteDate.php?id='.$row['DateId'].'"><img src = "images/delete.png"></a></td>
		</tr>';
  }
  echo '</table>';

  echo '<form action = "pageGenerate1.php" style = "margin-left:250px;margin-top:10px;margin-bottom:10px;">
		<input type = "hidden">
		<input type = "submit" id = "submit" value = "Generate TimeTable" name = "submit" style = "margin-left:-100px">
	</form>';

  mysql_close($dbc);
?>

</div>



<!--THE BEGINNING OF THE FOOTER-->
  <div id="footer">
		<?php include 'footer.php'?>
  </div>
  <!--THE END OF THE FOOTER-->

</div>
<!---THE END OF THE CONTENT DIV -->


</body>
</html>
