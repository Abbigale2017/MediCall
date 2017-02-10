<?php
include "home.php";

$id = $_SESSION['userID'];
$_SESSION['userID'] = $id;
$otherId = base64_decode($_GET['oid']);
$caseID = $_SESSION['caseID'];
//echo $otherId;
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">

<script type="text/javascript">
    function blockSpecialChar(e){
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || (k >= 48 && k <= 57));
        }
</script
	
    </head>
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">

     <?php
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
<Form name="newcase" action="updatecase.php?oid="<?php echo "$otherId"?> method="post" >
 <div width="780px" class="hero-unit">	   
<?php include 'casedetailmenu.php'?>
<h1 align='center'> Update Case</h1>

<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<tr>	
		<td align='left'>Grant access to Patient history:</td>
		<td><input type="checkbox" class="input-block-level" name="access"  value="1" <?php echo $val; ?> <?php if (($_SESSION['userType'] != PATIENT ) || ($row['Sickness'] != NULL)) echo "disabled";?>></td>
		<td align='right'><input type="submit" <?php if (($_SESSION['userType'] != PATIENT ) || ($row['Sickness'] != NULL)) echo "disabled";?> name="Add" class="btn btn-primary" value="Add" > </td>		
		<td align='right'><input type="submit" <?php if (($_SESSION['userType'] != DOCTOR ) || is_null($row['Sickness'])) echo "disabled";?> name="Update" class="btn btn-primary" value="Update" > </td>
	</tr>
	<tr> <td> </td> </tr>
	</table>
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
	
	</table>
	</div>
	</Form>
    </body>
    </html>