
<?php
include 'home.php';

?>
<!doctype html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
<body bgcolor="cyan" font_color="black">
<Form name="admindoctors" action="admindoctors.php" method="post" >
<div width="780px" class="hero-unit">
      <?php
	  
	  if (isset($_POST['search'])) {		  
		  $fname = null;
		  $lname = null;
		  $idcard = null;
		  $mobile = null;
		  $cnt = 0;
		  $sql="SELECT * FROM `doctor` WHERE " ; 

		if (!empty($_POST['fname'])) { 
				$cnt = $cnt + 1;
				$fname = $_POST['fname'];
				$sql = $sql . " FirstName like '%{$fname}%'";
		}
		if (!empty($_POST['lname'])) { 
				$lname = $_POST['lname'];				
				if ($cnt == 0) { $sql = $sql . " LastName like '%{$lname}%'"; $cnt = $cnt + 1;}
				else { $sql = $sql . " AND  LastName like '%{$lname}%'";} 
		}
		if (!empty($_POST['idcardnumber'])) { 
				$idcard = $_POST['idcardnumber'];
				if ($cnt == 0) { $sql = $sql . " IDCardNumber like '%{$idcard}%'"; $cnt = $cnt + 1; }
				else { $sql = $sql . " AND IDCardNumber like '%{$idcard}%'"; }
		}		

		if (!empty($_POST['mobile'])) { 
				$mobile = $_POST['mobile'];
				if ($cnt == 0) { $sql = $sql . " Mobile like '%{$mobile}%'"; $cnt = $cnt + 1; }
				else { $sql = $sql . " AND Mobile like '%{$mobile}%'"; }
		}
		try {		
			$stmt = $user_home->runQuery($sql);
			$stmt->execute();
		}
		catch(PDOException $ex)
		{
				echo $ex->getMessage();
		}
		  
	  } else {
      //execute the SQL query and return records
		  $stmt = $user_home->runQuery("SELECT * FROM `doctor` WHERE Status=:status");
		  $stmt->execute(array(":status"=>APPLIED));
      }
	  ?>	  	  
	 <h3 align='center'>Doctors </h3>
     <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td align='left'> FirstName:</td>
			<td><input type="text" class="input-block-level" name="fname"></td>
			<td width = "40"> </td>
			<td align='left'>LastName:</td>
			<td><input type="text" class="input-block-level" name="lname" ></td>
		</tr>
		<tr> <td> </td> </tr>

		<tr>
			<td align='left'>ID Card Number:</td>
			<td><input type="text" class="input-block-level" name="idcardnumber" ></td>
			<td width = "40"> </td>
			<td align='left'>Mobile :</td>
			<td><input type="text" class="input-block-level" name="mobile" ></td>
			<td align='center'><input type="submit" name="search" class="btn btn-primary" value="Search"></td>
		</tr>


	  <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >

      <thead>
        <tr>
          <th>Doctor ID</th>
          <th>First Name</th>
		  <th>Last Name</th>
          <th>DOB</th>
          <th>Specility</th>
		  <th>Status</th>
		  <th>Payment Status</th>
        </tr>
      </thead>
      <tbody>
	 
        <?php		
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$enDocID = base64_encode($row['DoctorID']);   
            echo
            "<tr>
              <td align='center' >{$row['DoctorID']}</td>
              <td align='center' >{$row['FirstName']}</td>
              <td align='center' >{$row['LastName']}</td>
              <td align='center' >{$row['DOB']}</td>
              <td align='center' >{$row['SpecilityID']}</td>
			 <td align='center' > <a href=doctor.php?id=$enDocID>Open</a> </td>
			   <td align='center' >{$row['Payment Status']}</td>
			</tr>\n";
          }
        ?>
      </tbody>
	  <tr> <td> </td> </tr>
	</table>
    </table>
	</div>
	</form>
    </body>
    </html>