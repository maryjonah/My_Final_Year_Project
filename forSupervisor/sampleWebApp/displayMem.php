<?php
  require_once('connectTimetable.php');

  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  $query = "SELECT * FROM newmembers ORDER BY firstName ASC";
  $data = mysqli_query($dbc, $query);

  echo '<table style = "width = "800px;"">';
  
  echo	'<tr style="color:#0000ff;margin-left:50px;">
				<th>FIRSTNAME</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>LASTNAME</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>DEPARTMENT</th>
		</tr>';
  while ($row = mysqli_fetch_array($data)) { 

  echo '<tr class="memberAuth" style = "border-bottom:dotted 1px #000">
			
			<td style = "border-bottom:dotted 1px #000;">' . strtoupper($row['firstname']).'
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<td style = "border-bottom:dotted 1px #000;">' . strtoupper($row['lastname']) . '
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<td style = "border-bottom:dotted 1px #000;">' . strtoupper($row['deptid']) . '</td>';

		echo '
			  
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  <td>&nbsp;</td>
			  
			  <td><a href="delete.php?id=' . $row[id] . '"><img src = "images/delete.png"></a></td>
			  <td>&nbsp;</td>
			  
			  <td>&nbsp;</td>
			  <td><a href="editMem.php?id='.$row[id]. '"><img src = "images/edit.png"></a></td>


		</tr>';
  }
  echo '</table>';

  mysqli_close($dbc);
?>