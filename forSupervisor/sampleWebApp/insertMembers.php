<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Exam Timetable Generator</title>
  <link rel="stylesheet" type="text/css" href="css/main.css" />
  
<script type="text/javascript">
	 function validate(inputField){
		 if(alpha(inputField) == false){
			alert ("USERNAME is invalid");
			return false;
		}
		if(alpha(inputField) == false){
			alert("FirstName name is invalid");
			return false;
		}
		if(alpha(inputField) == false){
			alert("LastName name is invalid");
			return false;
		}
		return true;
		}
		
	 function alpha(textField ){
		 if( textField.value.length != 0){
			 for (var i = 0; i < textField.value.length;i++){
			 var ch= textField.value.charAt(i);

			 if((ch < "A" || ch > "Z") && (ch< "a" || ch >"z")){
					return false;
				}
			}
		 }

		else {
			return true;
		}
	}

	function validateLength(minLength,maxLength,inputField,helpText){
		if(inputField.value.length<minLength || inputField.value.length>maxLength){
			if(helpText != null){
				alert("Password length is between " + minLength +" and "+maxLength);
				return false
			}
			else{
				if(helptext != null){
					helpText.innerHTML = "";
					return true;
				}
			}
		}
	}
	</script>
</head>

<body>
 <?php
	
	session_start();
  
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  
 ?>
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

    echo '<a href="logout.php" style="font-size:15px;color:#0000FF;">Log Out (' . $_SESSION['username'] . ')</a>';
  }

  ?>
         
  </div>
  <!--THE END OF THE SIDEBAR--> 
  
  
  <!--THE BEGINNING OF THE CONTENT-->
  
  <div id="content" style = "width:700px;">
  
<?php
  require_once('connectTimetable.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
	
	$msg = "";
	$errName = "";
	
  if (isset($_POST['submit'])) {
    $username   = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password   = mysqli_real_escape_string($dbc, trim($_POST['password']));
    $deptid     = mysqli_real_escape_string($dbc, trim($_POST['deptid']));
	$firstname  = mysqli_real_escape_string($dbc, trim($_POST['firstname']));
    $lastname   = mysqli_real_escape_string($dbc, trim($_POST['lastname']));
	
	$username   = strtoupper($username);
	$password   = strtoupper($password);
	$deptid     = strtoupper($deptid);
	$firstname  = strtoupper($firstname);
	$lastname   = strtoupper($lastname);
	
    if (!empty($username) && !empty($password) && !empty($deptid) &&!empty($firstname) && !empty($lastname)) {
			
      $query = "SELECT * FROM newmembers WHERE deptid = '$deptid'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        $query = "INSERT INTO newmembers(username,password,deptid,firstname,lastname) VALUES ('$username','$password','$deptid','$firstname','$lastname')";
        mysqli_query($dbc, $query);

		header("location:members.php");

      }
      else {
        $msg = "An account already exists for this <b>DEPARTMENT</b>.";
        $username = "";
      }
    }
    else {
      $msg = "Fill out all fields";
    }
  }
  mysqli_close($dbc);
?>

  <form method="post" action="#" id = "newMember" style = "margin-top:-20px;">
	<div style = "text-align:center;margin-bottom:-20px;color:red;"> 
		<?php echo $msg;?>
		<?php echo $errName;?>
	</div>
	  <br /><br />
	<table align = "center">
		<tr>
			<td><label for  ="username">Username:</label> </td>
			<td><input type ="text" id="username" name="username"onBlur = (validate(this)) /></td>
		</tr>
		<tr>
			<td><label for  ="password">Password:</label></td>
			<td><input type ="password" id="password" name="password"
				onblur = (validateLength(6,32,this,document.getElementById("message_help"))) /></td>
				<input type = "hidden" style = "color:red;"id = "message_help" class = "message_help"></span>
		</tr>
		<tr>
			<td><label for  ="deptid">Department:</label></td>
			<td>
				<select name = "deptid" >
					<option>AGRICULTURAL ECONOMICS AND EXT</option>
					<option>AGRICULTURAL ENGINEERING DEPAR</option>
					<option>ANIMAL SCIENCE DEPARTMENT</option>
					<option>CHEMISTRY DEPARTMENT</option>
					<option>COMPUTER SCIENCE DEPARTMENT</option>
					<option>CROP SCIENCE DEPARTMENT</option>
					<option>DEPT. OF SCI. & MATHS EDU.<option>
					<option>DEPARTMENT OF BIOCHEMISTRY</option>
					<option>LABTEC DEPARTMENT</option>
					<option>MATHEMATICS AND STATISTICS DEP</option>
					<option>PHYSICS DEPARTMENT</option>
					<option>SOIL SCIENCE DEPARTMENT</option>

				</select>
			</td>
		</tr>
		<tr>
			<td><label for  ="firtsname">  FirstName:</label></td>
			<td><input type ="text" id="firstname"  name="firstname" onBlur = (validate(this))/></td>
		</tr>
		<tr>
			<td><label for  ="lastname">LastName:</label></td>
			<td><input type ="text" id="lastname" name="lastname" onBlur = (validate(this))/></td>
		</tr>
		
	</table>
	  <div id = "addMember" style = "margin-left:220px;">
			<input type="submit" value="Add" name="submit" />
			<a href = "members.php" style = "margin-left:20px;">Cancel</a>
	  </div>

  </form>
  
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
