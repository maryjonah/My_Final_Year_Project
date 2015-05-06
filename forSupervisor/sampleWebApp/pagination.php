<?php
	include ("connectTimetable.php");
	if (!$connect)
	{
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("timetable", $connect);
	
	$query = mysql_query("SELECT * FROM course ORDER BY CourseCode ASC"); 
	$total_rows = mysql_num_rows($query);

	$base_url = 'http://localhost/sampleWebApp/courses.php';      
	$per_page = 50;                            
	$num_links = 8;                           
    $total_rows = $total_rows; 
    $cur_page = 1;  

 if(isset($_GET['page']))
    {
      $cur_page = $_GET['page'];
      $cur_page = ($cur_page < 1)? 1 : $cur_page;            
    }
	 $offset = ($cur_page-1)*$per_page;                
   
    $pages = ceil($total_rows/$per_page); 
	
	$start = (($cur_page - $num_links) > 0) ? ($cur_page - ($num_links - 1)) : 1;
    $end   = (($cur_page + $num_links) < $pages) ? ($cur_page + $num_links) : $pages;
	
	$res = mysql_query("SELECT * FROM course ORDER BY CourseCode ASC LIMIT ".$per_page." OFFSET ".$offset);

 mysql_close($connect);
?>