<?php
include 'home.php';

if ( $_SESSION['userType'] != DOCTOR ) {
	if (isset($_GET['id'])) $id = base64_decode($_GET['id']);
	else $id = $_SESSION['userID'];
} else
	$id = $_SESSION['userID'];

$_SESSION['userID'] = $id;
$_SESSION['caseID'] = 0;
$_SESSION['userDir'] = UPLOADS . "\\" . $id;

if ((isset($_POST['Save'])) || (isset($_POST['Apply'])) || (isset($_POST['submit']))){  

	$languages=implode(",",$_POST['languages']);  

	$email=$_POST['email'];

	$profile=$_POST['profile'];  
	$skypeID=$_POST['skypeid'];  
	$number=$_POST['number'];
			 

	$planid=$_POST['category'];

	$mobile=$_POST['mobile'];

	$fax=$_POST['fax'];
	$reasons = "";
	$specility=$_POST['specility'];

	$hospital=$_POST['hospital'];

	$d_no=$_POST['d_no'];
	$street=$_POST['street'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$zip=$_POST['zip'];
	$country=$_POST['country'];
	$status = $_POST['status'];
 	if (isset($_POST['bank_name'])) $bank_name=$_POST['bank_name']; else $bank_name="";
	if (isset($_POST['ifsc_code'])) $ifsc_code=$_POST['ifsc_code']; else $ifsc_code="";
	if (isset($_POST['bank_account'])) $bank_account=$_POST['bank_account']; else $bank_account="";

	if (isset($_POST['reasons'])) $reasons=$_POST['reasons']; else $reasons="";
 if ( trim($status) != REJECTED ) $reasons="";

	echo $languages . $planid . $specility . $reasons;
	
if ( trim($status) == APPROVED ) {
	if ($_SESSION['userType']!=DOCTOR) {
		$sql="UPDATE `doctor` SET `Status`=:status,`Profile`=:profile,`SkypeID`=:skypeid,`Languages`=:languages,`PlanID`=:planid,`Phone`=:phone,`Mobile`=:mobile,`Fax`=:fax,
		`SpecilityID`=:specility, `Hospital`=:hospital,`D_No`=:d_no,`Street`=:street,`City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:country, `RejectReasons`=:reasons WHERE `DoctorID` = :user_id";		
		$stmt = $user_home->runQuery($sql);
		$stmt->bindparam(":planid",$planid);
		$stmt->bindparam(":reasons",$reasons);
		echo $sql;
	} else {
		$sql="UPDATE `doctor` SET `Status`=:status,`Profile`=:profile,`SkypeID`=:skypeid,`Languages`=:languages,`Phone`=:phone,`Mobile`=:mobile,`Fax`=:fax,
		`SpecilityID`=:specility, `Hospital`=:hospital,`D_No`=:d_no,`Street`=:street,`City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:country, `BankName`=:bank_name,`BankAccountNo`=:bank_account, `IFSCCode`=:ifsc_code WHERE `DoctorID` = :user_id";		
		$stmt = $user_home->runQuery($sql);
		$stmt->bindparam(":bank_name",$bank_name);
		$stmt->bindparam(":bank_account",$bank_account);
		$stmt->bindparam(":ifsc_code",$ifsc_code);		
	}
 } else  {

	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$refname1=$_POST['refname1'];
	$refnumber1=$_POST['refnumber1'];
	$refhospital1=$_POST['refhospital1'];
	$refspeciality1=$_POST['refspeciality1'];
	$refname2=$_POST['refname2'];
	$refnumber2=$_POST['refnumber2'];
	$refhospital2=$_POST['refhospital2'];
	$refspeciality2=$_POST['refspeciality2'];
 

	$idcardnumber=$_POST['idcardnumber'];
	if ((isset($_POST['photoidind'])) && ($_POST['photoidind'] == 1))
	$photoidind = 1;
	else $photoidind = 0;
	$dob = date('Y-m-d',strtotime($_POST['dob']));
	$gender=$_POST['gender'];
 
	$sql="UPDATE `doctor` SET `FirstName`=:fname,`LastName`=:lname,`IDCardNumber`=:idcardnumber,`PhotoIDUploaded`=:photoidind,`Gender`=:gender,`Status`=:status,`DOB`=:dob,`Profile`=:profile,`SkypeID`=:skypeid,`Languages`=:languages,
	`ReferralName1`=:refname1,`ReferralContact1`=:refnumber1,`ReferralHospital1`=:refhospital1,`ReferralSpeciality1`=:refspeciality1,
	`ReferralName2`=:refname2,`ReferralContact2`=:refnumber2,`ReferralHospital2`=:refhospital2,`ReferralSpeciality2`=:refspeciality2,`Phone`=:phone,`Mobile`=:mobile,`Fax`=:fax,
	`SpecilityID`=:specility, `Hospital`=:hospital,`D_No`=:d_no,`Street`=:street,`City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:country WHERE `DoctorID` = :user_id";

		$stmt = $user_home->runQuery($sql); 
		$stmt->bindparam(":fname",$fname);
		$stmt->bindparam(":lname",$lname);
		$stmt->bindparam(":idcardnumber",$idcardnumber);
		$stmt->bindparam(":photoidind",$photoidind);
		$stmt->bindparam(":gender",$gender);
		$stmt->bindparam(":dob",$dob);
		$stmt->bindparam(":refname1",$refname1);
		$stmt->bindparam(":refnumber1",$refnumber1);
		$stmt->bindparam(":refhospital1",$refhospital1);
		$stmt->bindparam(":refspeciality1",$refspeciality1);
		$stmt->bindparam(":refname2",$refname2);		
		$stmt->bindparam(":refnumber2",$refnumber2);
		$stmt->bindparam(":refhospital2",$refhospital2);
		$stmt->bindparam(":refspeciality2",$refspeciality2);
		
}
 //echo $sql;
	try {
		$stmt->bindparam(":user_id",$id);		
		$stmt->bindparam(":status",$status);		
		$stmt->bindparam(":profile",$profile);
		$stmt->bindparam(":skypeid",$skypeID);		
		$stmt->bindparam(":languages",$languages);	
		$stmt->bindparam(":phone",$number);
		$stmt->bindparam(":mobile",$mobile);
		$stmt->bindparam(":fax",$fax);		
		$stmt->bindparam(":specility",$specility);
		$stmt->bindparam(":hospital",$hospital);
		$stmt->bindparam(":d_no",$d_no);
		$stmt->bindparam(":street",$street);
		$stmt->bindparam(":city",$city);
		$stmt->bindparam(":state",$state);		
		$stmt->bindparam(":zip",$zip);
		$stmt->bindparam(":country",$country);			
		$stmt->execute();
// Send email if Rejected
		if ( $status == APPROVED ) {
			$message = "					
						Hello Applicant,
						<br /><br />
						Congratulations !
						Your application to Medicall is Approved<br/>
						
						To complete your application please login into you account and subscribe the plan to use Medicall Doctor consultaion online. just click following login <br/>
						<br /><br />
						<a href='http://e-medicall.com//member//index.php</a>
						<br /><br />
						Thanks,";
						
			$subject = "Approved application";
			$user_home->send_mail($email,$message,$subject);	

		} else if ( $status == REJECTED ) 
		{	
			//$key = base64_encode($id);
			$message = "					
						Hello Applicant,
						<br /><br />
						Your application to Medicall is Rejected to the folowing reasons<br/>

						$reasons

						To complete your application please login into you account and fill up and attach above mentioned documents and apply again., just click following login <br/>
						<br /><br />
						<a href='http://e-medicall.com//member//index.php</a>
						<br /><br />
						Thanks,";
						
			$subject = "Rejected application";
						
			$user_home->send_mail($email,$message,$subject);	
		}	
		if ($_SESSION['userType']==DOCTOR) $user_home->redirect('doctor.php');
		else $user_home->redirect('admindoctors.php');
		
//////////////////////
	}
	catch(PDOException $ex)
	{
			//$user_home->redirect('home.php');
			echo $ex->getMessage();
	}
}	
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
		
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">

 <script type="text/javascript">
$( "#start_date" ).datepicker(

        { 
            maxDate: '0', 
            beforeShow : function()
            {
                jQuery( this ).datepicker('option','maxDate', jQuery('#end_date').val() );
            },
            altFormat: "dd/mm/yy", 
            dateFormat: 'dd/mm/yy'

        }

);

$( "#end_date" ).datepicker( 

        {
            maxDate: '0', 
            beforeShow : function()
            {
                jQuery( this ).datepicker('option','minDate', jQuery('#start_date').val() );
            } ,  
            altFormat: "dd/mm/yy", 
            dateFormat: 'dd/mm/yy'

        }

);

$(document).ready(function() {
    $("#dob").datepicker({maxDate:0});
});

function getState(val) {
	$.ajax({
	type: "POST",
	url: "get_state.php",
	data:'countryID='+val,
	success: function(data){
		$("#state-list").html(data);
	}
	});
}

function selectCountry(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}

</script>        
       
    </head>
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">

	<?php
      //execute the SQL query and return records
	  $stmt = $user_home->runQuery("SELECT * FROM `doctor` WHERE DoctorID=:id");
	  $stmt->execute(array(":id"=>$id));
	  $row = $stmt->fetch(PDO::FETCH_ASSOC);
	?>

<Form name="doctor" action="doctor.php" method="post" >
<div width="780px" class="hero-unit">
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr><tr>
<?php include 'membersubmenu.php'; ?>

   <td align='center'><h3>DOCTOR FORM ( ** <?php echo $row['Status'] ?> ** ) </h3> </td>
</tr></tr>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">

<tr>
    <td align='left'> First Name: *</td>
    <td><input type="text" class="input-block-level" name="fname" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value=<?php echo "{$row['FirstName']}" ?> ></td>
	<td width = "40"> </td>
    <td align='left'>Last Name: *</td>
    <td><input type="text" class="input-block-level" name="lname" <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value= <?php echo "{$row['LastName']}" ?> ></td>
</tr>
<tr> <td> </td> </tr>

<tr>
    <td align='left'>ID Card Number: *</td>
    <td><input type="text" pattern="[a-zA-Z0-9]+" class="input-block-level" pattern="^\d{12}$" name="idcardnumber" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value= <?php echo "{$row['IDCardNumber']}" ?> ></td>
	<td width = "40"> </td>
    <td align='left'>Photo ID Uploaded: *</td>
    <td><input type="checkbox" class="input-block-level" name="photoidind" <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value="1" <?php if ($row['PhotoIDUploaded'] == 1) echo "checked" ?>></td>
</tr>
<tr> <td> </td> </tr>
<!-- Hidden Properties    -->
	<td hidden><input type="text"  name="status" value='<?php echo "{$row['Status']}" ?>'></td>
	<td hidden><input type="text"  name="email" value='<?php echo "{$row['Email']}" ?>'></td>
	<?php if (trim($row['Status']) == APPROVED) { ?>
		<td hidden><input type="text"  name="fname" value='<?php echo "{$row['FirstName']}" ?>'></td>
		<td hidden><input type="text"  name="lname" value='<?php echo "{$row['LastName']}" ?>'></td>
	<?php } ?>
<tr>
    <td align='left'>DOB: *</td>
    <td><input type="date" class="input-block-level" name="dob" id="dob"  required  <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value= '<?php echo "{$row['DOB']}" ?>'></td>
	<td width = "40"> </td>
	<td align='left'>Gender : *</td>
    <td>
		<select name="gender"  <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> class="input-block-level">
			<option value="male" <?php if($row['Gender'] == 'male') echo "selected";?> >Male</option>
			<option value="female" <?php if($row['Gender'] == 'female') echo("selected");?> >Female</option>
		</select class="input-block-level"  required /> </td>
</tr>

<tr> <td> </td> </tr>

<tr>
    <td align='left'>Profile: *<a href="https://www.linkedin.com/" target="_blank"> <img src="images/question-icon.png" border="0"> </a></td>
    <td><input type="text" class="input-block-level" name="profile" value= '<?php echo "{$row['Profile']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Phone:</td>
      <td><input type="tel" maxlength="10"  pattern="[0-9]{10}" title="Enter your mobile number" class="input-block-level" name="number" value= <?php echo "{$row['Phone']}" ?>></td>
</tr>
<tr> <td> </td> </tr>
<tr>
	<td align='left'>Hospital: *</td>
	<td><input type="text" class="input-block-level" name="hospital" required  value='<?php echo "{$row['Hospital']}" ?>' ></td>	
	<td width = "40"> </td>
    <td align='left'>Mobile: *</td>
    <td><input type="tel" class="input-block-level" pattern="^\d{10}$" name="mobile" required value='<?php echo "{$row['Mobile']}" ?>'></td>
</tr>
<tr> <td> </td> </tr>
<tr>
    <td align='left'>Skype ID : *<a href="https://www.skype.com/en/" target="_blank"> <img src="images/question-icon.png" border="0"></a> </td>
    <td><input type="text" pattern="^@[A-Za-z0-9_]{1,15}$" class="input-block-level" name="skypeid" required value= '<?php echo "{$row['SkypeID']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Fax</td>
    <td><input type="text"  pattern="^\d{10}$" class="input-block-level" name="fax" value= '<?php echo "{$row['Fax']}" ?>'></td>

</tr>
<tr> <td> </td> </tr>

<tr>

    <td align='left'>Speciality: *</td>
		<td><select name="specility" class="input-block-level" required >
	<?php 
		$stm = $user_home->runQuery("SELECT * FROM `specility` WHERE Status=:status");
		$stm->execute(array(":status"=>1));
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{
      ?>		
			<option value=<?php echo $row1['SpecilityID'];?> <?php if($row['SpecilityID'] == $row1['SpecilityID']) echo "selected";?> ><?php echo $row1["SpecilityName"]; ?></option>		
	<?php } ?>
		
	</select> </td>
	<td width = "40"> </td>
    <td align='left'>Languages: *</td>
		<td><select name="languages[]" class="input-block-level" size="3" multiple="multiple"  required >
	<?php 
		$stm = $user_home->runQuery("SELECT * FROM `languages`");
		$stm->execute();
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{
      ?>		
			<option value=<?php echo $row1['LangID'];?> <?php if(strstr($row['Languages'],$row1['LangID'])) echo "selected";?> ><?php echo $row1["Lang"]; ?></option>		
	<?php } ?>
		
	</select> </td>
	
	</tr>
<tr> <td> </td> </tr>
<tr>
    <td align='left'>Door Number: *</td>
    <td><input type="text" class="input-block-level" name="d_no" required value= <?php echo "{$row['D_No']}" ?>></td>
	<td width = "40"> </td>
    <td align='left'>Street: *</td>
    <td><input type="text" class="input-block-level" name="street" required value='<?php echo "{$row['Street']}" ?>'></td>
</tr>
<tr> <td> </td> </tr>

<tr>
    <td align='left'>City: *</td>
    <td><input type="text" class="input-block-level" name="city"  required value='<?php echo "{$row['City']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Zip: *</td>
    <td><input type="text" class="input-block-level" pattern="^\d{6}$" name="zip" required value= '<?php echo "{$row['ZIP']}" ?>'></td>
</tr>
<tr> <td> </td> </tr>

<tr>
	<td align='left'>Country: *</td>
		<td><select name="country" id="country-list"  title="Select County" onChange="getState(this.value);">
			<?php
			 $stm = $user_home->runQuery("SELECT * FROM `countries`");
					$stm->execute();
					while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
					{
				 
			?>
				<option value=<?php echo $row1["CountryID"]; ?> <?php if($row['CountryID'] == $row1['CountryID']) echo "selected";?> ><?php echo $row1["CountryName"]; ?></option>
			<?php
			}
			?>
			</select>
		</td>
		
		<td width = "40"> </td>
		<td align='left'>State: *</td>
		 <td><input type="text" class="input-block-level" name="state" required value= '<?php echo "{$row['State']}" ?>'></td>
</tr>

<tr> <td> </td> </tr>

<tr>
    <td align='left'>Reject Reasons</td>
	<td><input type="text" class="input-block-level" <?php if ($_SESSION['userType'] == DOCTOR ) echo "disabled"; ?> name="reasons" value= '<?php echo "{$row['RejectReasons']}" ?>'></td> 
	<td width = "40"> </td>

    <td align='left'>Category:</td>
		<td><select name="category"  <?php if ($_SESSION['userType'] == DOCTOR ) echo "disabled"; ?> class="input-block-level" required >
	<?php 
		$stmc = $user_home->runQuery("SELECT * FROM `plan`");
		$stmc->execute();
		while($row2 = $stmc->fetch(PDO::FETCH_ASSOC))
		{
      ?>		
			<option value=<?php echo $row2['PlanID'];?> <?php if($row['PlanID'] == $row2['PlanID']) echo "selected";?> ><?php echo $row2["Category"]; ?></option>		
	<?php } ?>
		
	</select> </td>

</tr>
<tr> <td> </td> </tr>

</table> 
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr> <td align="left"><h5>Doctor Referrals</h5> </td> </tr>

<tr>
    <td align='left'>Referral Name(1): *</td>
    <td><input type="text" class="input-block-level" name="refname1" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value= '<?php echo "{$row['ReferralName1']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Referral Contact#(1): *</td>
    <td><input type="text" class="input-block-level" pattern="^\d{10}$" name="refnumber1" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value='<?php echo "{$row['ReferralContact1']}" ?>'></td>
</tr>
<tr> <td> </td> </tr>
<tr>
	<td align='left'>Referral Hospital:(1) *</td>
	<td><input type="text" class="input-block-level" name="refhospital1" required  <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value='<?php echo "{$row['ReferralHospital1']}" ?>' ></td>	
	<td width = "40"> </td>
    <td align='left'>Referral Speciality:(1) *</td>
	<td><select name="refspeciality1" class="input-block-level" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> >
	<?php 
		$stm = $user_home->runQuery("SELECT * FROM `specility` WHERE Status=:status");
		$stm->execute(array(":status"=>1));
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{
      ?>		
			<option value=<?php echo $row1['SpecilityID'];?> <?php if($row['ReferralSpeciality1'] == $row1['SpecilityID']) echo "selected";?> ><?php echo $row1["SpecilityName"]; ?></option>		
	<?php } ?>
		
	</select> </td>	
</tr>
<tr> <td> </td> </tr>



<tr>
    <td align='left'>Referral Name(2): *</td>
    <td><input type="text" class="input-block-level" name="refname2" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value= '<?php echo "{$row['ReferralName2']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Referral Contact#(2):*</td>
    <td><input type="text" class="input-block-level" pattern="^\d{10}$" name="refnumber2" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value='<?php echo "{$row['ReferralContact2']}" ?>'></td>
</tr>
<tr> <td> </td> </tr>
<tr>
	<td align='left'>Referral Hospital(2): *</td>	
	<td><input type="text" class="input-block-level" name="refhospital2" required  <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> value='<?php echo "{$row['ReferralHospital2']}" ?>' ></td>	
	<td width = "40"> </td>
    <td align='left'>Referral Speciality(2): *</td>
	<td><select name="refspeciality2" class="input-block-level" required <?php if (trim($row['Status']) == APPROVED) echo "disabled"; ?> >
	<?php 
		$stm = $user_home->runQuery("SELECT * FROM `specility` WHERE Status=:status");
		$stm->execute(array(":status"=>1));
		while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
		{
      ?>		
			<option value=<?php echo $row1['SpecilityID'];?> <?php if($row['ReferralSpeciality2'] == $row1['SpecilityID']) echo "selected";?> ><?php echo $row1["SpecilityName"]; ?></option>		
	<?php } ?>
		
	</select> </td>	
	
</tr>
<tr> <td> </td> </tr>

</table>
<?php if ( trim($row['Status']) == APPROVED ) { ?>
<table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">
<tr> <td align="left"><h5>Doctor Bank Account</h5> </td> </tr>
<tr><tr>
     <td align='left'>Bank Name : *</td>
    <td><input type="text" class="input-block-level" name="bank_name" required value= <?php echo "{$row['BankName']}" ?>></td>
	<td width = "40"> </td>
    <td align='left'>Account# *</td>
    <td><input type="text" class="input-block-level" pattern="^\d{11}$" name="bank_account" required value='<?php echo  "{$row['BankAccountNo']}" ?>'></td>
	<td width = "40"> </td>
	 <td align='left'>IFSC# *</td>
    <td><input type="text"  pattern="[a-zA-Z0-9]+" maxlength="11"  class="input-block-level" name="ifsc_code" required value='<?php echo "{$row['IFSCCode']}" ?>'></td>
</tr></tr>
<tr><tr> 
</tr></tr>
</table> 

<?php
}
	if ((trim($row['Status']) == REGISTERED ) || (trim($row['Status']) == REJECTED )) {
?>
<tr><table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">
<tr><tr>
	<td><input type="checkbox" name="checkbox" value="check" id="agree" /> I have read and agree to the <a href='Termsandconditions.htm'>Terms and Conditions and Privacy Policy </a> </td>
    <td align='center'><input type="submit" name="Apply" value="Apply"  class="btn btn-primary" onclick="if(document.getElementById('agree').checked) { document.forms['doctor']['status'].value = 'APPLIED';return true; } else { alert('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'); return false; }"> </td>
</tr></tr>
<tr><tr>
</tr></tr>
</table> </tr>

<?php
	} if ($_SESSION['userType'] == ADMIN ){
?>
<tr><table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">
<tr>
<script type="text/javascript">
function validateRejectReasons() {
    var x = document.forms["doctor"]["reasons"].value;
	var y = document.forms["doctor"]["rejectcheck"].checked;
	if (y == true ) {
		document.forms["doctor"]["status"].value = "REJECTED";
	} else
		document.forms["doctor"]["status"].value = "APPROVED";
    if ((x == "") && (y == true)) {
        alert("Please enter valid the reject reasons");
        return false;
    }
	return true;
}

function validateRequiredData() {
	$err = "";
	if (!document.forms["doctor"]["fname"].value.trim()) $err = $err + " First Name, ";
	alert($err);
}

</script>

<p></p>
<p></p>
	<td><input type="checkbox" name="rejectcheck" value="check" id="rejectcheck" />If checked, please enter reject reasons  </td>  
	<!--td><input type="text" name="reasons" value = ""></td-->
    <td align='center'><input type="submit" name="submit" value="Approve/Reject" class="btn btn-primary" onClick="javascript:validateRejectReasons()"></td>
</tr>
</table>
</tr>

<tr><table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">

<tr><tr> 
</tr></tr>
</table> </tr>

<?php
	} if (($_SESSION['userType'] == DOCTOR )){
?>
	<tr class="blank_row">
		<td >&nbsp;</td>
	</tr>
<tr><table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">

<tr><tr>
    <td align='center'><input type="submit" name="Save" class="btn btn-primary" value="Save" > </td>
</tr></tr>
<tr><tr> 
</tr></tr>
</table> </tr>

<?php 
}
?>
<tr>
</tr>
</table>
<hr>
<?php include 'ViewDocuments.php'; ?>

</table>
</div>
</form>
</body></html>
