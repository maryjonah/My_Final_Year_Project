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
	
  <?php
  if (isset($_SESSION['username'])) {
    echo '<a href="logout.php" style="font-size:15px;color:#0000ff;">Log Out (' . $_SESSION['username'] . ')</a>';
  }
	
  ?>
  
  
   <div id = "courseSidebar" style = "margin-top:40px;">
   </div>
  </div>
  <!--THE END OF THE SIDEBAR-->
  
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <?php  
  $msg = "";
	$connect = mysql_connect("localhost","root",""); 
	mysql_select_db("timetable",$connect);

if ($_FILES["csv"]["size"] > 0) { 

    $file = $_FILES["csv"]["tmp_name"]; 	
    $handle = fopen($file,"r"); 
	
	$delete = "TRUNCATE course";
	$execute = mysql_query($delete,$connect);
    do { 
        if ($data[0]) { 
		
            mysql_query("INSERT INTO course (CourseId,CourseCode,Name,Level,Number_Of_Students,Programme,Department) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".addslashes($data[1])."', 
                    '".addslashes($data[2])."',
					'".addslashes($data[3])."',
					'".addslashes($data[4])."',
					'".addslashes($data[5])."',
					'".addslashes($data[6])."'
                ) 
            "); 
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
			$msg = "Upload Successful";

    header('Location: courses.php?success=1');
	
	die; 


} 

?>

  <div id="content">
  <p><?php echo $msg;?></p>
	
	
	<form method = "post" action = "#" enctype = "multipart/form-data" style ="margin-left:90px;width:500px;">
			Upload course file:
			<input type = "file" name = "csv">
			<input type = "submit" name= "submit" value = "Upload">
	</form>


	
	<?php
		
		include("pagination.php"); 
		echo '<table style="margin-top:20px;margin-left:50px;">';
		echo '<tr>
					<th>COURSECODE</th>
					<th>NAME</th>
					<th>PROGRAMME</th>
					<th>DEPARTMENT</th>
					</tr>';
		 
		    if(isset($res))
				{
						while($result = mysql_fetch_assoc($res))
						{
						
						$courseCode = $result['CourseCode'];
						$name       = $result['Name'];
						$programme  = $result['Programme'];
						$department = $result['Department'];

						$courseCode   = strtoupper($courseCode);
						$name         = strtoupper($name);
						$programme    = strtoupper($programme);
						$department   = strtoupper($department);

																		
						echo 
						'<tr>
							<td>'.$courseCode.'</td>
							<td>'.$name.'</td>
							<td>'.$programme . '</td>
							<td>'.$department . '</td>
							
							<td><a href="deleteCourse.php?Courseid=' . $result[CourseId] . '"><img src = "images/delete.png"></a></td>
							<td><a href="editCourse.php?Courseid='.$result[CourseId]. '"><img src = "images/edit.png"></a></td>

						</tr>';
						}
				}
			
	echo '</table>';
	?>
	
	<div id="pagination">
	
        <div id="pagiCount" style = "width:750px;margin-left:30px;">
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
