<?php
include 'home.php';


	$id = $_SESSION['userID'];

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

 if ( $status == REJECTED ) 
	$reasons=$_POST['reasons'];

if ( trim($status) == APPROVED ) {
	if ($_SESSION['userType']!=DOCTOR) {
		$sql="UPDATE `doctor` SET `Status`=:status,`Profile`=:profile,`SkypeID`=:skypeid,`Languages`=:languages,`PlanID`=:planid,`Phone`=:phone,`Mobile`=:mobile,`Fax`=:fax,
		`SpecilityID`=:specility, `Hospital`=:hospital,`D_No`=:d_no,`Street`=:street,`City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:country, `RejectReasons`=:reasons, `BankName`=:bank_name,`BankAccountNo`=:bank_account, `IFSCCode`=:ifsc_code WHERE `DoctorID` = :user_id";
		$stmt = $user_home->runQuery($sql);
		$stmt->bindparam(":planid",$planid);
		$stmt->bindparam(":reasons",$reasons);
	} else {
		$sql="UPDATE `doctor` SET `Status`=:status,`Profile`=:profile,`SkypeID`=:skypeid,`Languages`=:languages,`Phone`=:phone,`Mobile`=:mobile,`Fax`=:fax,
		`SpecilityID`=:specility, `Hospital`=:hospital,`D_No`=:d_no,`Street`=:street,`City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:country, `BankName`=:bank_name,`BankAccountNo`=:bank_account, `IFSCCode`=:ifsc_code WHERE `DoctorID` = :user_id";		
		$stmt = $user_home->runQuery($sql);
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
		$stmt->bindparam(":refname1",$refname1);
		$stmt->bindparam(":refnumber1",$refnumber1);
		$stmt->bindparam(":refhospital1",$refhospital1);
		$stmt->bindparam(":refspeciality1",$refspeciality1);
		$stmt->bindparam(":refname2",$refname2);		
		$stmt->bindparam(":refnumber2",$refnumber2);
		$stmt->bindparam(":refhospital2",$refhospital2);
		$stmt->bindparam(":refspeciality2",$refspeciality2);
		$stmt->bindparam(":idcardnumber",$idcardnumber);
		$stmt->bindparam(":photoidind",$photoidind);
		$stmt->bindparam(":dob",$dob);
		$stmt->bindparam(":gender",$gender);
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
		$stmt->bindparam(":bank_name",$bank_name);
		$stmt->bindparam(":bank_account",$bank_account);
		$stmt->bindparam(":ifsc_code",$ifsc_code);
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
			$user_home->redirect('home.php');
			echo $ex->getMessage();
	}
	
?>