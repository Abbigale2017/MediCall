<?php
session_start();
require_once 'class.user.php';


$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
$id = $_SESSION['userID'];
 
 $number=$_POST['number'];
  $skypeID=$_POST['skype']; 
 $mobile=$_POST['mobile'];
 $fax=$_POST['fax'];
 $reasons = "";

 $emergencycontactname=$_POST['emergencycontactname'];
 $emergencycontactphone=$_POST['emergencycontactphone'];
 $d_no=$_POST['d_no'];
 $street=$_POST['street'];
 $city=$_POST['city'];
 $state=$_POST['state'];
 $zip=$_POST['zip'];
 $country=$_POST['country'];
 $status = $_POST['status'];
 if (( $status == REJECTED ) && (isset($_POST['reasons'])))
	$reasons=$_POST['reasons'];
 else $reasons="";
if ( $status == APPROVED ) {
	 $sql="UPDATE `patient` SET `Status`=:sts,`Phone`=:phone,`SkypeID`=:skype,`Mobile`=:mobile,`Fax`=:fax,`EmergencyContactName`=:emcontactname,`EmergencyContactPhone`=:emcontactnumber,`D_No`=:do_no,`Street`=:street,
 `City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:cuntry, `RejectReasons`=:reasons WHERE `PatientID` = :user_id";

  		$stmt = $user_home->runQuery($sql);

 } else {

$fname=$_POST['fname'];
 $lname=$_POST['lname'];
 $idcardnumber=$_POST['idcardnumber'];
if (isset($_POST['photoidind'])) {
	if ($_POST['photoidind'] == 1)	$photoidind = 1; else $photoidind = 0;
}

$email=$_POST['email'];

 $dob = date('Y-m-d',strtotime($_POST['dob']));
 $gender=$_POST['gender'];

 $sql="UPDATE `patient` SET `FirstName`=:fname,`LastName`=:lname,`IDCardNumber`=:idcardnumber,`PhotoIDUploaded`=:photoidind,`Status`=:sts,`DOB`=:dob,`Gender`=:gender,`Phone`=:phone,`SkypeID`=:skype,`Mobile`=:mobile,`Fax`=:fax,`EmergencyContactName`=:emcontactname,`EmergencyContactPhone`=:emcontactnumber,`D_No`=:do_no,`Street`=:street,
 `City`=:city,`State`=:state,`ZIP`=:zip,`CountryID`=:cuntry, `RejectReasons`=:reasons WHERE `PatientID` = :user_id";

 		$stmt = $user_home->runQuery($sql);
		$stmt->bindparam(":user_id",$id);
		$stmt->bindparam(":fname",$fname);
		$stmt->bindparam(":lname",$lname);
		$stmt->bindparam(":idcardnumber",$idcardnumber);
		$stmt->bindparam(":photoidind",$photoidind);
		$stmt->bindparam(":sts",$status);		
		$stmt->bindparam(":dob",$dob);
		$stmt->bindparam(":gender",$gender); 
 }
 //echo $sql;
 	try {
		$stmt->bindparam(":user_id",$id);
		$stmt->bindparam(":sts",$status);				
		$stmt->bindparam(":reasons",$reasons);
		$stmt->bindparam(":phone",$number);
		$stmt->bindparam(":skype",$skypeID);
		$stmt->bindparam(":mobile",$mobile);
		$stmt->bindparam(":fax",$fax);
		$stmt->bindparam(":emcontactname",$emergencycontactname);
		$stmt->bindparam(":emcontactnumber",$emergencycontactphone);
		$stmt->bindparam(":do_no",$d_no);
		$stmt->bindparam(":street",$street);
		$stmt->bindparam(":city",$city);
		$stmt->bindparam(":state",$state);		
		$stmt->bindparam(":zip",$zip);
		$stmt->bindparam(":cuntry",$country);
		$stmt->execute();
// Send email if Rejected
		if ( $status == APPROVED ) {
			$message = "					
						Hello $fname, $lname
						<br /><br />
						Congratulations !
						Your application to Medicall is Approved<br/>
						
						To complete your application please login into you account and subscribe th eplan to use Medical Doctor consultaion online. just click following login <br/>
						<br /><br />
						<a href='http://e-medicall.com//member//home.php</a>
						<br /><br />
						Thanks,";
						
			$subject = "Approved application";
						
			$user_home->send_mail($email,$message,$subject);	

		} else if ( $status == REJECTED ) 
		{	
			//$key = base64_encode($id);
			$message = "					
						Hello $fname, $lname
						<br /><br />
						Your application to Medical is Rejected to the folowing reasons<br/>

						$reasons

						To complete your application please login into you account and fill up and attach abpove mentioned dpcuments and applied again., just click following login <br/>
						<br /><br />
						<a href='http://e-medicall.com//member//home.php</a>
						<br /><br />
						Thanks,";
						
			$subject = "Rejected application";
						
			$user_home->send_mail($email,$message,$subject);	
		}
		else
		{
			//echo "sorry , Query could no execute...";
		}		

		if ($_SESSION['userType'] == PATIENT ) $user_home->redirect('patient.php');
		else $user_home->redirect('adminpatients.php');		
	}
	catch(PDOException $ex)
	{
			echo $ex->getMessage();
	}
//////////////////////

?>