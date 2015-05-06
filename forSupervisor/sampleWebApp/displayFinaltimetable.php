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
<link rel="stylesheet" href="css/main.css" />
<link rel= "stylesheet" href = "css/table.css"/>
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

	<?php
  if (isset($_SESSION['username'])) {

    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>
          
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style = "margin-top:-20px;margin-right:20px;width:880px;">
    <p id = "intro">
	
	<table border = "1"style = "margin-left:50px;margin-right:10px;">
			<tr>
				<th>Date(M/D/Y)  </th>			
				<th>CourseId  </th>
				<th>Duration  </th>
				<th>Programme </th>
				<th>VenueCode  </th>
				<th>Department  </th>
			</tr>
	
<?php
			include("finalCoursePage.php"); 

			if(isset($res))
				{
						while($result = mysql_fetch_assoc($res))
						{
						
						$date = $result['Date'];
						$courseid = $result['CourseId'];
						$duration  = $result['Duration'];
						$programme = $result['Programme'];
						$venuecode = $result['VenueCode'];
						$department = $result['department'];

						$date   = strtoupper($date);
						$courseid         = strtoupper($courseid);
						$programme    = strtoupper($programme);
						$duration   = strtoupper($duration);
						$programme   = strtoupper($programme);
						$venuecode   = strtoupper($venuecode);
						$department   = strtoupper($department);

																		
						echo 
						'<tr>
							<td>'.$date.'</td>
							<td>'.$courseid.'</td>
							<td>'.$duration . '</td>
							<td>'.$programme . '</td>
							<td>'.$venuecode . '</td>
							<td>'.$department . '</td>';
						}
}
	
	?>
	
	</table>

<div id="pagination">
	
        <div id="pagiCount" style = "width:750px;margin-left:60px;">
            <?php
                if(isset($pages))
                {  
                    if($pages > 1)        
                    {    if($cur_page > $num_links)     // for taking to page 1 //
                        {   $dir = "first";
                            echo '<span id="prev"> <a href="'.$_SERVER['PHP_SELF'].'?page='.(1).'">'.$dir.'</a> </span>';
                        }
                       if($cur_page > 1) 
                        {
                            $dir = "prev";
                            echo '<span id="prev"> <a href="'.$_SERVER['PHP_SELF'].'?page='.($cur_page-1).'">'.$dir.'</a> </span>';
                        }                 
                        
                        for($x=$start ; $x<=$end ;$x++)
                        {
                            
                            echo ($x == $cur_page) ? '<strong>'.$x.'</strong> ':'<a href="'.$_SERVER['PHP_SELF'].'?page='.$x.'">'.$x.'</a> ';
                        }
                        if($cur_page < $pages )
                        {   $dir = "next";
                            echo '<span id="next"> <a href="'.$_SERVER['PHP_SELF'].'?page='.($cur_page+1).'">'.$dir.'</a> </span>';
                        }
                        if($cur_page < ($pages-$num_links) )
                        {   $dir = "last";
                       
                            echo '<a href="'.$_SERVER['PHP_SELF'].'?page='.$pages.'">'.$dir.'</a> '; 
                        }   
                    }
                }
            ?>
        </div>	
</div>
  <!--THE END OF THE CONTENT-->
   
  
  <!--THE BEGINNING OF THE FOOTER-->
  <div id="footer" style="margin-top:20px" width = "1000px">
		Copyright &copy; 2014 
		<img src = "images/headerLogo.gif" />
		<a href="#">Electronic TimeTable Generator</a>
  </div>
  <!--THE END OF THE FOOTER-->
  
</div>
<!---THE END OF THE CONTENT DIV -->


</body>
</html>
