
<?php
include "home.php";

if ($_GET['id'])
	$id = base64_decode($_GET['id']);
else
	$id = $_SESSION['userID'];
//echo $id;
$_SESSION['caseID'] = 0;
$_SESSION['userID'] = $id;
$_SESSION['userDir'] = UPLOADS . "\\" . $id;
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>

		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <!-- Bootstrap -->
		
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
		
<script type="text/javascript">
$(document).ready(function() {
    $("#dob").datepicker({maxDate:0});
	dateFormat: 'Y-m-d'
});

function phonenumber(inputtxt)  
{   alert("message");
  var phoneno = /^\d{10}$/;  
  if((inputtxt.value.match(phoneno))  
        {  
      return true;  
        }  
      else  
        {  
        alert("message");  
        return false;  
        }  
}  

function validateform(){
		var phone = document.forms["myForm"]["phone"].value;
        var phoneNum = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/; 
            if(phone.value.match(phoneNum)) {
                return true;
            }
            else {
                document.getElementById("phone").className = document.getElementById("phone").className + " error";
                return false;
            }
		
}	
		
		
		
	









</script>

        
</head>
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">

	<?php
      //execute the SQL query and return records
	  $stmt = $user_home->runQuery("SELECT * FROM `patient` WHERE PatientID=:id");
	  $stmt->execute(array(":id"=>$id));
	  $row = $stmt->fetch(PDO::FETCH_ASSOC);	  
	?>

<Form name="patient" action="patientupdate.php" method="post" >
 <div width="780px" class="hero-unit">	    
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
   
<?php include 'membersubmenu.php'; ?>
<tr>
<td align='center'><h3>PATIENT FORM ( ** <?php echo "{$row['Status']}" ?> ** )</h3></td>
</tr>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr>
    <td align='left'> First Name:</td>
    <td><input type="text" class="input-block-level" name="fname" required  <?php if ($row['Status'] == APPROVED) echo "disabled"; ?> value=<?php echo "{$row['FirstName']}"; ?> ></td>
	<td width = "40"> </td>
    <td align='left'>Last Name:</td>
    <td><input type="text" class="input-block-level" name="lname"  <?php if ($row['Status'] == APPROVED) echo "disabled"; ?> value=<?php echo "{$row['LastName']}" ?> ></td>
</tr>
<tr> <td> </td> </tr>

<tr>
    <td align='left'>ID Card Number:</td>
    <td><input type="text" pattern="[a-zA-Z0-9]+" class="input-block-level" name="idcardnumber" required  <?php if ($row['Status'] == APPROVED) echo "disabled"; ?> value= <?php echo "{$row['IDCardNumber']}" ?> ></td>
	<td width = "40"> </td>
    <td align='left'>Photo ID Uploaded:</td>
    <td><input type="checkbox" class="input-block-level" name="photoidind"  <?php if ($row['Status'] == APPROVED) echo "disabled"; ?> value="1" <?php if ($row['PhotoIDUploaded'] == 1) echo "checked"; ?> ></td>
</tr>
<tr> <td> </td> </tr>
<!-- Hidden Properties    -->
	<td hidden><input type="text"  name="status" value= <?php echo "{$row['Status']}" ?>></td>

<tr>
    <td align='left'>DOB:</td>
    <td><input type="date" class="input-block-level" name="dob" id="dob"  required <?php if ($row['Status'] == APPROVED) echo "disabled"; ?>  value= <?php echo "{$row['DOB']}" ?>></td>	
	<td width = "40"> </td>
	<td align='left'>Gender</td>
    <td>
		<select name="gender" <?php if ($row['Status'] == APPROVED) echo "disabled"; ?> class="input-block-level">
			<option value="male" <?php if(trim($row['Gender']) == 'male') echo "selected";?> >Male</option>
			<option value="female" <?php if(trim($row['Gender']) == 'female') echo("selected");?> >Female</option>
		</select class="input-block-level"  required /> </td>
</tr>

<tr> <td> </td> </tr>

<tr>
    <td align='left'>Email:</td>
    <td><input type="email" class="input-block-level" name="email" disabled value= '<?php echo "{$row['Email']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Phone:</td>
    <td><input type="tel" maxlength="10"  pattern="^\d{10}$" title="Enter your mobile number" class="input-block-level" name="number" value= <?php echo "{$row['Phone']}" ?>></td>
</tr>
<tr> <td> </td> </tr>
<tr>
    <td align='left'>Mobile:</td>
    <td><input type="tel" maxlength="10" pattern="^\d{10}$" class="input-block-level" name="mobile" required value= <?php echo "{$row['Mobile']}" ?>></td>
	<td width = "40"> </td>
    <td align='left'>Fax</td>
    <td><input type="text" maxlength="10" pattern="^\d{10}$" class="input-block-level" name="fax" value= <?php echo "{$row['Fax']}" ?>></td>

</tr>
<tr> <td> </td> </tr>

<tr>
    <td align='left'>Door #</td>
    <td><input type="text" class="input-block-level" name="d_no" required value= <?php echo "{$row['D_No']}" ?>></td>
	<td width = "40"> </td>
    <td align='left'>Street</td>
    <td><input type="text" align="left" class="input-block-level" name="street" required value=<?php echo "{$row['Street']}" ?>></td>
</tr>
<tr> <td> </td> </tr>
<tr>
</tr>
<tr> <td> </td> </tr>
<tr>
    <td align='left'>City</td>
    <td><input type="text" class="input-block-level" name="city"  required value= '<?php echo "{$row['City']}" ?>'></td>
	<td width = "40"> </td>
     <td align='left'>Zip</td>
    <td><input type="text" maxlength="6" pattern="^\d{6}$" class="input-block-level" name="zip" required value= '<?php echo "{$row['ZIP']}" ?>'></td>
</tr>
<tr> <td> </td> </tr>

<tr>
	<td align='left'>Country</td>
		<td><select name="country" id="country-list"  onChange="getState(this.value);">
         <option value="">Select Country</option>
			<?php
			 $stm = $user_home->runQuery("SELECT * FROM `countries`");
					$stm->execute();
					while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
					{
				 
			?>
			<option value=<?php echo $row1['CountryID']; ?> <?php if($row['CountryID'] == $row1['CountryID']) echo "selected";?> ><?php echo $row1["CountryName"]; ?></option>
			<?php
			}
			?>
			</select>
		</td>
		
		<td width = "40"> </td>
	<td align='left'>State</td>
	<td><input type="text" class="input-block-level" name="state" required value= <?php echo "{$row['State']}" ?>></td>
    
</tr>
<tr> <td> </td> </tr>

<tr>
    <td align='left'>Reject Reasons</td>
	<td><input type="text" class="input-block-level" <?php if ($_SESSION['userType'] == PATIENT ) echo "disabled"; ?> name="reasons" value= <?php echo "{$row['RejectReasons']}" ?>></td> 	
	<td width = "40"> </td>
	<td align='left'>Skype ID: <a href="https://www.skype.com/en/"> <img src="images/question-icon.png" border="0"></a></td>
    <td><input type="text" pattern="^@[A-Za-z0-9_]{1,15}$" class="input-block-level" name="skype" value= '<?php echo "{$row['SkypeID']}" ?>'></td>	
</tr>
<tr> <td> </td> </tr>

<tr>
    <td align='left'>Emergency Contact Name</td>
    <td><input type="text" class="input-block-level" name="emergencycontactname" value= '<?php echo "{$row['EmergencyContactName']}" ?>'></td>
	<td width = "40"> </td>
    <td align='left'>Emergency Contact Phone</td>
    <td><input type="tel" maxlength="10" pattern="^\d{10}$" class="input-block-level" name="emergencycontactphone" value= <?php echo "{$row['EmergencyContactPhone']}" ?>></td>
</tr>
<tr> <td> </td> </tr>

</table> </tr>
<?php
	if (($_SESSION['userType'] == PATIENT ) && (($row['Status'] == REGISTERED ) || ($row['Status'] == REJECTED ))) {
?>
<tr><table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">

<tr><tr>
	<td><input type="checkbox" name="checkbox" value="check" id="agree" /> I have read and agree to the <a target= "_blank" href='Termsandconditions.htm'>Terms and Conditions and Privacy Policy </a> </td>
    <td align='center'><input type="submit" name="Apply" value="Apply"  class="btn btn-primary" onclick="if(document.getElementById('agree').checked) { document.forms['patient']['status'].value = 'APPLIED';return true; } else { alert('Please indicate that you have read and agree to the Terms and Conditions and Privacy Policy'); return false; }"> </td>
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
    var x = document.forms["patient"]["reasons"].value;
	var y = document.forms["patient"]["rejectcheck"].checked;
	if (y == true ) {
		document.forms["patient"]["status"].value = "REJECTED";
	} else
		document.forms["patient"]["status"].value = "APPROVED";
    if ((x == "") && (y == true)) {
        alert("Please enter valid the reject reasons");
        return false;
    }
	return true;
}
</script>

<p></p>
<p></p><br>
	<td><input type="checkbox" name="rejectcheck" value="check" id="rejectcheck" />If checked, please enter reject reasons  </td>  
    <td align='center'><input type="submit" name="submit" value="Approve/Reject"  class="btn btn-primary" onclick="return validateRejectReasons()"></td>
</tr>
</table>
</tr>

<?php
	} if (($_SESSION['userType'] == PATIENT )){
?>
	<tr class="blank_row">
		<td >&nbsp;</td>
	</tr>
<tr><table border="0" cellpadding="0" cellspacing="0" width="780px" align="center">

<tr><tr>
    <td align='center'><input type="submit" name="Save" class="btn btn-primary" value="Save" > </td>
	<td width = "40"> </td>
	
</tr></tr>
</table> </tr>

<hr>

<?php } ?>
<?php include 'viewdocuments.php'; ?>
</table>
</div>
</form>
</body></html>