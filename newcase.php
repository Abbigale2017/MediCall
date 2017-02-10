
<?php
require_once 'home.php';

$id = $_SESSION['userID'];
$_SESSION['userID'] = $id;
$_SESSION['userDir'] = UPLOADS . "\\" . $id;

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

function UpdateProfile(elm)
{
	var i = elm.value.indexOf("|");
	var amt = elm.value.substr(0,i);
	var j = elm.value.lastIndexOf("|");
	var id = elm.value.substr(i+1,j-i-1);

	document.getElementById("cost").value = amt;
	document.getElementById("doctorid").value = id;	
};

function OpenProfile()
{
	var elm = document.getElementById("doctors").value;
	var j = elm.lastIndexOf("|");
	var link = elm.substr(j+1,elm.length);
	window.open(link);
};

function OpenFeedback()
{
	var elm = document.getElementById("doctors").value;
	var i = elm.indexOf("|");
	var j = elm.lastIndexOf("|");
	var id = elm.substr(i+1,j-i-1);
	window.open('feedbackview.php?id='+id);
};

function OpenPayment()
{	var sick = document.getElementById('sickness').value;
	if(sick.trim() === "") { alert('Please enter sinckness'); return false; }
	var elm = document.getElementById("paymethod").value;
	window.open(elm);
	return true; 
};

function UpdateSickness(sick) {
	document.getElementById("sickness").value = sick.value;
	return true; 
};

function UrgentCare(care) {
	if (care.checked){		
	document.getElementById("country").disabled = true;	
	document.getElementById("doctors").disabled = true;
	document.getElementById("cost").value = 2000;
	//document.getElementById("profile").disabled = true;
	//document.getElementById("feedback").disabled = true;
	return true; } else {
	document.getElementById("country").disabled = false;	
	document.getElementById("doctors").disabled = false;
	//document.getElementById("profile").disabled = false;
	//document.getElementById("feedback").disabled = false;
	}
};




</script>        
    </head>
<body style='padding: 80px 20px' font_color="black">

     <?php		
		if (isset($_POST['doctorid'])) {	
		    if ((isset($_POST['Add'])) && (isset($_POST['sickness'])) && (trim($_POST['sickness'])!="")){
				try {
					if ((isset($_POST['urgentcare'])) && ($_POST['urgentcare']==0)) {
						$specility = $_POST['specility'] * 100;
						$lang = $_POST['languages'];
						$doctor = ($specility + $lang) * -1;
						//echo $doctor;
					} else {
						$doctor = base64_decode($_POST['doctorid']);
					}
					
					$sickness = $_POST['sickness'];
					$cost = $_POST['cost'];
					$paymethod = $_POST['paymethod'];
					if (isset($_POST['access'])) $access = true;
					else $access = false;
					
					$sql="INSERT INTO `cases`(`PatientID`, `DoctorID`, `Sickness`,`CreateDate`, `AccessFlag`, `Amount`) VALUES (:user_id,:doctor,:sickness,now(), :access, :cost)";	
					$stmt = $user_home->runQuery($sql);
					$stmt->bindparam(":user_id",$id);
					$stmt->bindparam(":sickness",$sickness);
					$stmt->bindparam(":doctor",$doctor);
					$stmt->bindparam(":cost",$cost);
					$stmt->bindparam(":access",$access);
					$stmt->execute();
					$caseID = $user_home->lasdID();
					
					$_SESSION['caseID'] = $caseID;
					
					chdir($_SESSION['userDir']);
					mkdir($caseID);

					$sickness = $_POST['sickness'];
					$sql="INSERT INTO `casecommunication`(`CaseID`, `ReportDate`, `Sickness`) VALUES (:caseID,now(),:sickness)";
					$stmt = $user_home->runQuery($sql);
					$stmt->bindparam(":caseID",$caseID);
					$stmt->bindparam(":sickness",$sickness);
					$stmt->execute();
					
					//echo $paymethod;
					//header('Location: '.$paymethod);
					// Testing Purpose
					if (RUNMODE == TEST)  $cases_home->activateCase();

					$user_home->redirect('cases.php');
					
				}
				catch(PDOException $ex)
				{
						echo $ex->getMessage();
				}
			}
		}
      ?>
<Form name="newcase" action="newcase.php" method="post" >
 <div width="780px" class="hero-unit">	
<?php include 'patientcasesmenu.php'?>
<h3 align='center'> New Case </h3> <h4 align='center'> <input  type="checkbox" name="urgentcare" id="urgentcare" value="0" OnClick="javascript:UrgentCare(this);" />  Urgent Care</h4>

<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<tr>
		<td align='left'>Speciality:</td>
		<td><select name="specility" class="input-block-level" >
	<?php 
		 if (isset($_POST['specility'])){			 
			$specility = $_POST['specility'];
			$lang = $_POST['languages'];
			$country = $_POST['country'];
			$cost = $_POST['cost'];
			$sql = "SELECT * FROM doctor, plan WHERE doctor.PlanID = plan.PlanID AND doctor.Status='APPROVED' AND doctor.SpecilityID=:specility AND doctor.CountryID=:country AND doctor.Languages like '%{$lang}%'";
			$stmt = $user_home->runQuery($sql);
			$stmt->bindparam(":specility",$specility);
			$stmt->bindparam(":country",$country);
			//$stmt->bindparam(":cost",$cost);
			$stmt->execute();	
		 }

		$stm = $user_home->runQuery("SELECT * FROM `specility` WHERE Status=:status");
		$stm->execute(array(":status"=>1));
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{ 	$sel = ''; 
			if($specility == $row1['SpecilityID']) $sel =  "selected";
			echo "<option value='{$row1['SpecilityID']}' {$sel} >{$row1['SpecilityName']}</option>";
		}
	?>
	</select> </td>
		<td width = "40"> </td>
		<td align='left'>Languages:</td>		
		<td><select name="languages" id="languages"  class="input-block-level"  required >
	<?php 
		$stm = $user_home->runQuery("SELECT * FROM `languages`");
		$stm->execute();
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{
			$sel = ''; 
			if($lang == $row1['LangID']) $sel =  "selected";
			echo "<option value='{$row1['LangID']}' {$sel} >{$row1['Lang']}</option>";
		}
      ?>		
		
		</select> </td>
		
	
	</tr>
	<tr>
		<td align='left'>Country:</td>		
		<td><select name="country" id="country" class="input-block-level"  required >
		<?php 
			$stm = $user_home->runQuery("SELECT * FROM `countries`");
			$stm->execute();
			while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
			{			
				$sel = ''; 
				if($country == $row1['CountryID']) $sel =  "selected";
				echo "<option value='{$row1['CountryID']}' {$sel} >{$row1['CountryName']}</option>";
			}
		  ?>		
		
		</select> </td>
		<td width = "40"> </td>		
		<td > </td>		
		<td align='right'><input type="submit" name="Search" id="Search"  class="btn btn-primary" value="Search Dcotors" > </td>
	</tr>
	<tr class="blank_row">
		<td >&nbsp;</td>
	</tr>


	
		
<div id="mycheckboxdiv" style="none:display">	

</div>

<script type="text/javascript">
$('#urgentcare').change(function() {
    $('#mycheckboxdiv').toggle();
});
</script>
		
	
	

	
		<tr>
		<td align='left'>Doctor:</td>
		<td>
		<select name="doctors" id="doctors" class="input-block-level" OnClick="javascript:UpdateProfile(this);">
		
		<?php 
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
			$endocID = base64_encode($row['DoctorID']);
            echo
            "<option value='{$row['Amount']}|{$endocID}|{$row['Profile']}'> {$row['FirstName']}, {$row['LastName']}</option>";
			}			
		?>
 		</select class="input-block-level" /> </td>	
		<td hidden><input type="text" id="doctorid"  name="doctorid" value=''></td>		
		<td width = "40"> </td>
		<td> <a id="profile" href="#" value="Profile" onclick="javascript:OpenProfile()"> Doctor's Profile </a></td>
		<td> <a id="feedback" href="#" value="Feedback" onclick="javascript:OpenFeedback()"> Patient Feedback </a></td>
		</tr>
		
		<tr>
			<td align='left'> Cost (Rs):</td>							
			<td><input type="textarea" name="cost" id="cost" readonly value=<?php echo $cost; ?> ></td>
			<td width = "40"> </td>
			<td align='left'>Grant access to my history:</td>
			<td><input type="checkbox" class="input-block-level" name="access"  value="0"></td>
		</tr>
	</table>		

	
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
	<tr class="blank_row">
		<td >&nbsp;</td>
	</tr>
	
	<tr>
		<td align='left'> Sickness List:</td>
		<td><select name="sicknesslist" class="input-block-level"  OnClick="javascript:UpdateSickness(this)"  >
		<?php 
		
		$stm = $user_home->runQuery("SELECT * FROM `sicknesslist` WHERE Specilities like '%{$specility}%'");
		$stm->execute();
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{
			echo "<option value='{$row1['Sickness']}' >{$row1['Sickness']}</option>";			 
		}
		
		?>		
		
		</select> </td>
			
	</tr>
	<tr>
			<td align='left'> Sickness:</td>
			<td> <textarea name="sickness" id="sickness" class="input-block-level"  onkeypress="return blockSpecialChar(event)" cols="70" rows="2"></textarea></td>
			<!--td align='center'><input type="submit" name="Add" value="Add" onclick="if(document.getElementById('sickness').value == null) { alert('Please enter sinckness'); return false; } else return true;"> </td-->
			</tr>
		<tr> <td> </td> </tr>
	</table>
	
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
		<tr>
			<td align='left'>Payment Method</td>
			
				
				<td><input type="radio" name="mything" checked value="1">Paypal</input></td>
				
				<td><input type="radio" name="mything" value="0">Pay U Money</input></td>
				<td hidden><input type="text" id="paymethod"  name="paymethod" value="paypal.php"></td>	
			           <script>
			$('input:radio[name="mything"]').change(
				function(){
					if ($(this).is(':checked') && $(this).val() == '1') {
						document.getElementById("paymethod").value = "paypal.php";						
					}
					else{
						document.getElementById("paymethod").value = "payuindex.php";						
					}
				});
				</script>
				<td align='center'><input type="submit" name="Add" value="Add" class="btn btn-primary" onclick="javascript:OpenPayment()"> </td>
		</tr>
		
	</table>
		
	</table>
	</div>
	</Form>
    </body>
    </html>