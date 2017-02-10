
<?php
include 'home.php';


$id = $_SESSION['userID'];
$_SESSION['userID'] = $id;
$_SESSION['userDir'] = UPLOADS . "\\" . $id;

$patientflag = 0;
if (isset($_GET['patientid'])) $patient = base64_decode($_GET['patientid']);
else $patient = $id;

if (isset($_GET['patientflag'])) $patientflag = $_GET['patientflag']; 	
else $patientflag = 0;

$_SESSION['readOnly'] = $patientflag;

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
<script type="text/javascript">
function LocalTime(lt) 
{	
	//alert(lt);
	var d = new Date(lt);	
	//return d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2) + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2) +":"+ ("0" + d.getSeconds()).slice(-2);	
	var rstr = d.toLocaleDateString() + " " + d.toLocaleTimeString();
	document.write(rstr);
};
</script>	

<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<Form>

<?php 

	$htm="";
	if ($_SESSION['userType'] == PATIENT) {
		//echo date("Y-m-d H:i:s");
		$stm = $user_home->runQuery("SELECT * FROM `appointments` WHERE PatientID=:uId AND `ScheduleDate` >= utc_timestamp() ORDER BY `ScheduleDate` ASC");
		$stm->execute(array(":uId"=>$id));
			while( $row = $stm->fetch(PDO::FETCH_ASSOC) ){	
		  	$d = new DateTime($row['ScheduleDate']);
			$dtstr = $d->format('Y-m-d\TH:i:s.u');

            $htm = $htm .
            "<tr style=$st>			  
              <td><script>	LocalTime('$dtstr'); </script></td>              
			  <td>{$row['Duration']}</td>
              <td>{$row['CaseID']}</td>
			  <td>{$row['Description']}</td>	
			</tr> \n";			
          }
	}
	
if (trim($htm) !="") {		
?>		
<div width="780px" class="alert-danger" >	 
		<h3 align='center'>Schedule Alert</h3>
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead>
        <tr>
		  <th align='left'>Date</th>
		  <th align='left'>Time</th>
		  <th align='left'>Duration</th>
		  <th align='left'>Case ID</th>
          <th align='left'>Description</th>
        </tr>		
      </thead>
<?php echo $htm; ?>
		</table>
</div>
<?php $htm = "";} else if ($_SESSION['userType'] == DOCTOR) {
		//echo date("Y-m-d H:i:s");
		$stm = $user_home->runQuery("SELECT * FROM `appointments` WHERE PatientID=:uId AND `ScheduleDate` >= utc_timestamp() ORDER BY `ScheduleDate` ASC");
		$stm->execute(array(":uId"=>$id));
          while( $row = $stm->fetch(PDO::FETCH_ASSOC) ){	
		  	$d = new DateTime($row['ScheduleDate']);
			$dtstr = $d->format('Y-m-d\TH:i:s.u');
		  
            $htm = $htm .
            "<tr style=$st>			  
              <td><script>	LocalTime('$dtstr'); </script></td>
			  <td>{$row['Duration']}</td>
              <td>{$row['CaseID']}</td>
			  <td>{$row['Description']}</td>	
			</tr> \n";			
          }
	}
	
if (trim($htm) !="") {		
?>		
<div width="780px" class="alert-danger" >	 
		<h3 align='center'>Schedule Alert</h3>
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead>
        <tr>
		  <th align='left'>Date</th>
		  <th align='left'>Time</th>
		  <th align='left'>Duration</th>
		  <th align='left'>Case ID</th>
          <th align='left'>Description</th>
        </tr>		
      </thead>
<?php echo $htm; ?>
		</table>
</div>
<?php } ?>

<div width="780px" class="hero-unit">	   
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr><tr>
<?php if ($patientflag == 0) { ?>  
	<td align='center'><h3>Cases</h3></td>
<?php } else { ?>   
	<td align='center'><h3>Patient History</h3></td>
<?php } ?> 	
</tr></tr>
	<?php if ($_SESSION['userType'] == PATIENT) {
	include 'patientcasesmenu.php';
	} else if ($_SESSION['userType'] == DOCTOR) {
	include 'doctorcasesmenu.php';
	}?> 
	
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead> 	         
        <tr>
          <th align='left'>Case ID</th>
		  <th align='left'>Created Date</th>
          <th align='left'>Name</th>		 
		  <th align='left'>Sickness</th>
		  <th align='left'>Status</th>
        </tr>				
      </thead>	 
        <?php
		if ($_SESSION['userType'] == PATIENT) {
		$stmt1 = $cases_home->getUrgentCases($patient);
          while( $row1 = $stmt1->fetch(PDO::FETCH_ASSOC) ){
			  $enid = base64_encode($row1['CaseID']);
			  $sick = $row1['Sickness'];
			  $st = BOLD;			  
            echo
            "<tr $st>
              <td>{$row1['CaseID']}</td>
              <td>{$row1['CreateDate']}</td>
              <td>'URGENT'</td>
			  <td> $sick </td>
			<td> <a href='casedetail.php?caseID=$enid'>{$row1['CaseStatus']}</a> </td>
			</tr>\n";
          }
		}
		$stmt = $cases_home->getCases($patient, $patientflag);
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
			  $enid = base64_encode($row['CaseID']);
			  $sick = $row['Sickness'];
			  $cnt = $cases_home->isCaseWaiting($row['CaseID']);
			  if ($cnt == 0 ){ $st = NORMAL;} else {$st = BOLD;};			  
            echo
            "<tr $st>
              <td>{$row['CaseID']}</td>
              <td>{$row['CreateDate']}</td>
              <td>{$row['FirstName']} , {$row['LastName']}</td>
			  <td> $sick </td>
			<td> <a href='casedetail.php?caseID=$enid'>{$row['CaseStatus']}</a> </td>
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