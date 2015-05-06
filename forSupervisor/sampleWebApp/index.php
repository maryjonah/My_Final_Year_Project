<?php
	
	error_reporting(0);
  require_once('connectTimetable.php');

  session_start();

  $error_msg = "";

  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {

	$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
	
		$username = strtoupper($username);
		$password = strtoupper($password);
	
      if (!empty($username) && !empty($password)) {

	  $query = "SELECT id,status, username FROM newmembers WHERE username = '$username' AND password = '$password'";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) 
		{
          $row = mysqli_fetch_array($data);
          $_SESSION['id'] = $row['id'];
          $_SESSION['username'] = $row['username'];
          setcookie('id', $row['id'], time() + (60 * 60 * 24 * 30));    
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30)); 
		  
			  if($row['status']==1)
			  {
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/courses.php';
				header('Location: ' . $home_url);
			  }
			  else
			  {
				$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/reset.php?id='.$row[id].'';
				header('Location: ' . $home_url);
			  }
			  
        }
        else {
          $error_msg = 'SORRY, YOU MUST ENTER A VALID USERNAME AND PASSWORD TO LOG IN.';
        }
      }
      else {
        $error_msg = 'SORRY, YOU MUST ENTER YOUR USERNAMEAND PASSWORD TO LOG IN.';
      }
    }

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Timetable Generator</title>
  <link rel="stylesheet" href="css/main.css" />
</head>
<body>
  
  <div id="container">

						<!--THE BEGINNING OF THE HEADER-->

  <div id="header">
   			
		<?php include 'header.php'?>	
	
  </div>
  <!--THE END OF THE HEADER-->
   
   <div id="content" align="center" style = "width:800px;margin-left:50px;">

<?php
  if (empty($_SESSION['user_id'])) {
    echo '<p class="error" style="text-align:center;color:red;">' . $error_msg . '</p>';
?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <table cellspacing="0" cellpadding="0" style="border:none text-align:center;" align = "center">
  	
  	  <tr>
		<td><label for="username">Username:</label></td>
		<td><input type="text" name="username" value="<?php if (!empty($user_username)) echo $user_username; ?>" /><br /></td>
	  </tr>
	  <tr>
		<td><label for="password">Password:</label></td>
		<td><input type="password" name="password" /></td>
	  </tr>
	  <tr style="margin-top:10px">
		<td>&nbsp;</td>

		<td><input type="submit" value="Log In" name="submit" /></td>
	  </tr>

	</table>

  </form>

<?php
  }
  else {
    
  }
?>

</div>

<div id="footer">
		<?php include 'footer.php'?>
  </div>
  <!--THE END OF THE FOOTER-->
  
</div>
<!---THE END OF THE CONTENT DIV -->

</body>
</html>
