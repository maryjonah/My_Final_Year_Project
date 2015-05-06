<?php
	  if (isset($_POST['submit'])) {

		require('connectTimetable.php');
		$dbc=$database_connect;
		$password = $_POST['password'];
		$newpassword = $_POST['newpassword'];
		$newpassword1 = $_POST['newpassword1'];
		$id = $_POST['id'];

		if(!empty($password)&&(!empty($newpassword))&&(!empty($newpassword1)) ){

			  $query = "SELECT * FROM newmembers WHERE id = '$id'";
			  $data = mysqli_query($dbc, $query);

				$order = "UPDATE newmembers SET password ='$newpassword' WHERE id = '$id'";
				 mysqli_query($dbc,$order);
			     echo "Password Updated";

		}
		else{
			echo "Fill all fields";
		}

}
?>

