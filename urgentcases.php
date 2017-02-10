
<?php
include 'home.php';


$id = $_SESSION['userID'];
$_SESSION['userID'] = $id;

 //echo $patientflag;
?>
<!DOCTYPE html>
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
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<Form>


<div width="780px" class="hero-unit">	   
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr><tr>
	<td align='center'><h3>Urgent Care Cases</h3></td>
	<?php include 'doctorcasesmenu.php';?>
</tr></tr>
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead> 	         
        <tr>
          <th align='left'>Case ID</th>
		  <th align='left'>Created Date</th>
		  <th align='left'>Sickness</th>
		  <th align='left'>Status</th>
        </tr>				
      </thead>	 
        <?php
		$stmt = $cases_home->getUrgentCasesDoctor();
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
			  $enid = base64_encode($row['CaseID']);
			  $sick = $row['Sickness'];
			  $st = BOLD;
            echo
            "<tr $st>
			  <td>
				<div class='radio'>
                      <input type='radio' name='optradio'>
                 </div>
				</td>
              <td>{$row['CaseID']}</td>
              <td>{$row['CreateDate']}</td>
			  <td> $sick </td>
			<td> <a href='assigntome.php?caseID=$enid'>Assign</a> </td>
			</tr>\n";
          }
	  ?>
	</tr>
	<tr> <td> </td> </tr>
	</table>
		  
	</table>
	</div>
	</Form>
    </body>
    </html>