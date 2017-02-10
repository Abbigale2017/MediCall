<?php
include 'home.php';
session_start();
require_once 'class.user.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
?>
<!doctype html>
    <html lang="en">
    <body>
      <?php
      //execute the SQL query and return records
	  $stmt = $user_home->runQuery("SELECT * FROM `patient` WHERE Status=:status");
	  $stmt->execute(array(":status"=>REGISTERED));
      ?>
      <table border="2" style= "background-color: #84ed86; color: #761a9b; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Patient ID</th>
          <th>First Name</th>
		  <th>Last Name</th>
          <th>DOB</th>
          <th>Email</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            echo
            "<tr>
              <td>{$row['PatientID']}</td>
              <td>{$row['FirstName']}</td>
              <td>{$row['LastName']}</td>
              <td>{$row['DOB']}</td>
              <td>{$row['Email']}</td>
			  <td> <a href=patient.php?id={$row['PatientID']}>Open</a> </td>
			</tr>\n";
          }
        ?>
      </tbody>
    </table>
    </body>
    </html>