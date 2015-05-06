  	<?php	
	require('connectTimetable.php');
	$dbc=$database_connect;
	
	$date_from = $_POST['date_from'];
	$date_to = $_POST['date_to'];

	$fdate = strtotime($date_from);
	$tdate = strtotime($date_to);

	$mstym = $_POST['mstym'];
	$metym = $_POST['metym'];
	$aetym = $_POST['aetym'];
	$astym = $_POST['astym'];
	$estym = $_POST['estym'];
	$eetym = $_POST['eetym'];

	$mstym = strtotime($mstym);
	$metym = strtotime($metym);
	$astym = strtotime($astym);
	$aetym = strtotime($aetym);
	$estym = strtotime($estym);
	$eetym = strtotime($eetym);


	if(($mstym < $metym)&&($astym < $aetym)&&($estym < $eetym))
	{
		$query = "TRUNCATE Duration";
		mysql_query($query, $dbc);

		$mdate =  gmdate("H:i", $mstym).'-'.gmdate("H:i", $metym);
		$mquery = "INSERT INTO duration(Duration) VALUES ('$mdate')";
		mysql_query($mquery, $dbc);

		$adate =  gmdate("H:i", $astym).'-'.gmdate("H:i", $aetym);
		$aquery = "INSERT INTO duration(Duration) VALUES ('$adate')";
		mysql_query($aquery, $dbc);

		$edate =  gmdate("H:i", $estym).'-'.gmdate("H:i", $eetym);
		$equery = "INSERT INTO duration(Duration) VALUES ('$edate')";
		mysql_query($equery, $dbc);

		echo "Successful";
	}

	if($fdate < $tdate)
	{
		$delquery = "TRUNCATE date";
		mysql_query($delquery, $dbc);

		for($i =$fdate;$i<=$tdate;$i+=86400){

			$strInsertdate =date("m/d/Y",$i);
			$strInsertday = date("l",$i);

			$dquery = "INSERT INTO date(Date,Day) VALUES ('$strInsertdate','$strInsertday')";
			mysql_query($dquery, $dbc);
		}
	}
	header("location:disDate.php");

?>

