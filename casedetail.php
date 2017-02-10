
<?php
require_once 'home.php';

$cnt = 1;

$caseID = base64_decode($_GET['caseID']) ;
$id = $_SESSION['userID'];
if ($_SESSION['userType'] == DOCTOR) $cnt = $cases_home->isActiveDcotor($caseID);
//if ((( $cnt > 0 ) && ($_SESSION['userType'] == DOCTOR)) || ($_SESSION['userType'] == ADMIN) || ($_SESSION['userType'] == PATIENT)){
if ( $cnt > 0 ){
	$_SESSION['caseID'] = $caseID;

	$id = $_SESSION['userID'];
	$_SESSION['userID'] = $id;
		$stm = $cases_home->getCase($caseID);
		$row1 = $stm->fetch(PDO::FETCH_ASSOC);
		$_SESSION['caseStatus'] = trim($row1['CaseStatus']);
		//$name = $row1['FirstName'] . "  " . $row1['LastName'];
		if ($_SESSION['userType'] == PATIENT ) $_SESSION['oId'] = $row1['DoctorID']; 
		else $_SESSION['oId'] = $row1['PatientID']; 
		
		$name = $user_home->getName($_SESSION['oId']);
		
		$patientid = $row1['PatientID'];
		
		if ($_SESSION['userType'] == DOCTOR) $_SESSION['userDir'] = UPLOADS . "\\" . $patientid;
		else $_SESSION['userDir'] = UPLOADS . "\\" . $id;

	//$_SESSION['userDir'] = UPLOADS . "\\" . $id . "\\" . $caseID;
//onclick="window.open('feedback.php'); return false;"

	$enpatientid = base64_encode($patientid);
	$encaseID = base64_encode($caseID);

	if ($_SESSION['userType'] == PATIENT ) $name_label = "Doctor Name";  
	else { if ($row1['AccessFlag'] == true) $name_label = "<a href=cases.php?patientid=$enpatientid&patientflag=1>Patient History</a> Patient Name"; else $name_label = "Patient Name"; }
	
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
                
</head>
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<?php
	if ((isset($_POST['Add'])) || (isset($_POST['Update']))){
		 if ($_SESSION['userType'] == PATIENT ){
			if ((isset($_POST['sickness'])) && ($_POST['sickness'] != '' )){
				$sickness = $_POST['sickness'];
				$sql="INSERT INTO `casecommunication`(`CaseID`, `ReportDate`, `Sickness`) VALUES (:caseID,now(),:sickness)";
				$stmt = $user_home->runQuery($sql);
				$stmt->bindparam(":caseID",$caseID);
				$stmt->bindparam(":sickness",$sickness);
				$stmt->execute();
			};
			if (isset($_POST['access'])){
				if (isset($_POST['access'])) $access = true;
					else $access = false;			
				$sql= "UPDATE `cases` SET `AccessFlag`=:access WHERE `CaseID`=:caseID";
				$stmt = $user_home->runQuery($sql);
				$stmt->bindparam(":caseID",$caseID);
				$stmt->bindparam(":access",$access);
				$stmt->execute();
			};		
		 } else {
			if (isset($_POST['remidy'])){			
				$remidy = $_POST['remidy'];
				//$duration = now() - ReportDate
				$sql = "UPDATE `casecommunication` SET `ResposeDate`=now(),`Remedies`=:remidy WHERE `CaseID`=:caseID AND `Remedies` is NULL";
				//$sql="INSERT INTO `casecommunication`(`CaseID`, `ReportDate`, `Sickness`) VALUES (:caseID,now(),:remidy)";
				$stmt = $user_home->runQuery($sql);
				$stmt->bindparam(":caseID",$caseID);
				$stmt->bindparam(":remidy",$remidy);
				$stmt->execute();
			}
		 }
		 $user_home->redirect('cases.php');
	} else if (isset($_POST['Close'])) {
		$stmt = $cases_home->closeCase(); 
		$user_home->redirect('feedback.php');
	}

	$stmt = $user_home->runQuery("SELECT * FROM cases WHERE CaseID=:caseid");
	$stmt->bindparam(":caseid",$caseID);
	$stmt->execute();
	$row2 = $stmt->fetch(PDO::FETCH_ASSOC);
	if ($row2['AccessFlag'] == true ) $val="checked"; else $val = "unchecked";
				
	$stmt = $user_home->runQuery("SELECT * FROM casecommunication WHERE CaseID=:caseid AND Remedies is NULL");
	$stmt->bindparam(":caseid",$caseID);
	$stmt->execute();
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	
?>
<Form name="patient" action="casedetail.php?caseID=<?php echo $encaseID;?>" method="post" >
 <div width="780px" class="hero-unit">	   
<?php 
	include 'casedetailmenu.php';
	?>
<h3 align='center'>Case Detail</h3>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr><tr>
   <td align='center'><h4> <?php echo "Case : $caseID"?></h4></td>
   <td align='center'><h4> <?php echo "$name_label :   $name "?></h4></td>  
</tr></tr>

	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<hr>
	<tr>	
		<td align='left'> Grant access to Patient history  : <input type="checkbox" name="access"  value="1" <?php echo $val; ?> <?php if (($_SESSION['userType'] != PATIENT ) || ($row['Sickness'] != NULL)) echo "disabled";?>></td>
		<td align='center' <?php if (($_SESSION['userType'] != PATIENT ) ||$_SESSION['caseStatus'] != OPEN || ($row['Sickness'] != NULL)) echo "hidden";?>><input type="submit" name="Add" class="btn btn-primary" value="Add" > </td>		
		<td align='center' <?php if (($_SESSION['userType'] != DOCTOR ) || $_SESSION['caseStatus'] != OPEN|| is_null($row['Sickness'])) echo "hidden";?> ><input type="submit" name="Update" class="btn btn-primary" value="Update" > </td>
		<?php if (($_SESSION['userType'] == PATIENT ) && $_SESSION['caseStatus'] == OPEN ) { ?>
		<td align='center'><input type="submit" name="Close" class="btn btn-primary" value="Case Close" onclick="if(confirm('Do you want to Close Case?') == true ) return true; else return false;"> </td>	
		<?php } ?>
	</tr>
	<tr> <td> </td> </tr>
	</table>
	<hr>
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
		<tr> <td> </td> </tr>
		<tr>
			<td align='left'> Sickness:</td>
			<td> <textarea name="sickness" class="input-block-level"  onkeypress="return blockSpecialChar(event)" <?php if ($_SESSION['userType'] == DOCTOR ) echo "disabled";?>  cols="70" rows="1"> <?php echo "{$row['Sickness']}" ?></textarea></td>
			</tr>
		<tr> <td> </td> </tr>
		<tr> <td> </td> </tr>
		<tr>
			<td align='left'> Remidy:</td>
			<td> <textarea name="remidy" class="input-block-level" onkeypress="return blockSpecialChar(event)" <?php if ($_SESSION['userType'] == PATIENT ) echo "disabled";?> cols="70" rows="1"></textarea></td>
			</tr>
		<tr> <td> </td> </tr>

	</table>
	<hr>
	<table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<tr>
	
	<?php
		$stmt = $user_home->runQuery("SELECT * FROM casecommunication WHERE CaseID=:caseid AND Remedies is not NULL ORDER BY ReportDate DESC");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
	?>
	</tr>
	<tr> <td> </td> </tr>
	</table>
	  
      <table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead>
        <tr>
		  <th>Repoted Date</th>
          <th>Sickness</th>
		  <th>ResposeDate</th>
          <th>Remedies</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            echo
            "<tr>
              <td>{$row['ReportDate']}</td>
              <td><textarea class='input-block-level'  disabled cols='30' rows='1' value=>{$row['Sickness']}</textarea></td>
			  <td>{$row['ResposeDate']}</td>
              <td><textarea class='input-block-level'  disabled cols='30' rows='1' value=>{$row['Remedies']}</textarea></td>
			</tr>\n";
          }
        ?>
      </tbody>	  
    </table>
	<tr class="blank_row">
		<td >&nbsp;</td>
	</tr>	
	<tr class="blank_row">
		<td >&nbsp;</td>
	</tr>
<hr>
	<?php include 'viewdocuments.php'; ?>
	</table>
	</form>
	<div>
    </body>
    </html>
 <?php } else {
	$user_home->redirect('cases.php');
 } 
 ?>