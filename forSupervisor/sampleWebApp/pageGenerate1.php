<?php
			include("pagination.php"); 
			include ("connectTimetable.php");

				$deleteFinal = "TRUNCATE finaltimetable";
				$executeFinal = mysql_query($deleteFinal,$database_connect);

				$result = mysql_query("CALL Course_Insert();");
				$result_num =mysql_num_rows($result,$connect);

				header("location:displayFinaltimetable.php");
			
?>
