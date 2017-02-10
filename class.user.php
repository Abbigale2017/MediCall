<?php
require_once 'constants.php';
require_once 'dbconfig.php';

class USER
{	

	private $conn;
	
	public function __construct()
	{	
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }
	
	public function getDocuments($alldocs=0)
	{
		$userID = $_SESSION['userID'];
		$caseID = $_SESSION['caseID'];
		//echo $userID . $caseID;
		if ($alldocs == 0) {
			if ($caseID == 0 ) {
				$sql = "SELECT * FROM `doctab` WHERE CaseID={$caseID} AND UserID={$userID} ";
				$stmt = $this->runQuery($sql);
				$stmt->execute();	
			} else {
				$sql = "SELECT * FROM `doctab` WHERE CaseID=:caseid";
				$stmt = $this->runQuery($sql);
				$stmt->bindparam(":caseid",$caseID);
				$stmt->execute();
			}
		} else {
				$sql = "SELECT * FROM `doctab` WHERE UserID={$userID} ";
				$stmt = $this->runQuery($sql);
				$stmt->execute();				
		}						
		return $stmt;
	}

	public function getPayment()
	{
		$userID = $_SESSION['userID'];	  	
		$sql = "SELECT * FROM doctorpayment WHERE DoctorID={$userID}";							
		$stmt = $this->runQuery($sql);			
		$stmt->execute();
		return $stmt;
	}
	
	

	public function getName($userID)
	{
		$stmt = $this->runQuery("SELECT firstName, lastName FROM `tbl_users` WHERE userID=:userid");
		$stmt->bindparam(":userid",$userID);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$name = $row['firstName'].", ".$row['lastName'];
		return  $name;
	}

	public function getSkypeURL($caseID)
	{
		//$id = base64_encode($caseID);
                if ($_SESSION['userType'] == PATIENT){ return null;}
		$stmt = $this->runQuery("SELECT * FROM cases, patient WHERE cases.PatientID=patient.PatientID AND cases.CaseID =:caseid");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$patSkypeID = $row['SkypeID'];
		$name = $row['FirstName'] ." ". $row['LastName'];
		$url = "<a href='skype:" . $patSkypeID . "?call'>".$name."</a>"; // <a href='skype:ravisurapati_1?call'></a>
		return $url;
	}
	
	// Attached Documents iframe-div
	public function viewAttachedDocuments($readOnly=0)
	{
		echo "
	<div align='center' width='780px' height='315'>
		<iframe align='top' width='780px' height='315' src='viewfiles.php?patientflag=$readOnly frameborder='0' allowfullscreen></iframe>
	</div> \n";
	}

	// Method for Mobile App
	public function getDoctorsAsJSON($status)
	{
		$stmt = $this->runQuery("SELECT * FROM `doctor` WHERE Status=:status");
		$stmt->execute(array(":status"=>$status));
		$jsonstring = json_encode($stmt);
		return $jsonstring;
	}
	// Method for Mobile App
	public function getPatientsAsJSON($status)
	{
		$stmt = $this->runQuery("SELECT * FROM `patient` WHERE Status=:status");
		$stmt->execute(array(":status"=>$status));
		$jsonstring = json_encode($stmt);
		return $jsonstring;
	}
	
	// Method for Mobile App
	public function getCasesAsJSON($userId,$patienthistoryflag=0)
	{
	  if (((userType == DOCTOR) || $patienthistoryflag==1)) { 
		// Patient History
		$stmt = $this->runQuery("SELECT * FROM cases, doctor WHERE cases.DoctorID=doctor.DoctorID AND cases.PatientID=:uId");
	  } if (((userType == PATIENT) || $patienthistoryflag==0)) { 
			$stmt = $this->runQuery("SELECT * FROM cases, doctor WHERE cases.PatientID=:uId AND cases.CaseStatus='OPEN' AND cases.DoctorID=doctor.DoctorID");
	  }	if ((userType == DOCTOR) && $patienthistoryflag==0) {
			$stmt = $this->runQuery("SELECT * FROM cases, patient WHERE cases.DoctorID=:uId AND cases.CaseStatus='OPEN' AND cases.PatientID=patient.PatientID");
	  }
		$stmt->bindparam(":uId",$userId);
		$stmt->execute();
		$jsonstring = json_encode($stmt);
		return $jsonstring;
	}

	// Method for Mobile App
	public function getCaseHistoryAsJSON($caseID)
	{
		$stmt = $this->runQuery("SELECT * FROM casecommunication WHERE CaseID=:caseid AND Remedies is not NULL");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
		$jsonstring = json_encode($stmt);
		return $jsonstring;
	}

	// Method for Mobile App
	public function getPatientAsJSON($id)
	{
		$stmt = $this->runQuery("SELECT * FROM `patient` WHERE PatientID=:id");
		$stmt->execute(array(":id"=>$id));
		//$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$jsonstring = json_encode($stmt);
		return $jsonstring;		
	}
	  
	// Method for Mobile App
	public function getDoctorAsJSON($id)
	{
		$stmt = $this->runQuery("SELECT * FROM `doctor` WHERE DoctorID=:id");
		$stmt->execute(array(":id"=>$id));
		//$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$jsonstring = json_encode($stmt);
		return $jsonstring;		
	}
	  
	
	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function lasdID()
	{
		$stmt = $this->conn->lastInsertId();
		return $stmt;
	}
	
	public function register($fname,$lname,$usertype,$email,$upass,$code)
	{
		try
		{
			$password = md5($upass);
			$stmt = $this->conn->prepare("INSERT INTO tbl_users(firstName,lastName,userType,userEmail,userPass,tokenCode) 
			                                             VALUES(:first_name, :last_name,:user_type, :user_mail, :user_pass, :active_code)");
			$stmt->bindparam(":first_name",$fname);
			$stmt->bindparam(":last_name",$lname);
			$stmt->bindparam(":user_type",$usertype);
			$stmt->bindparam(":user_mail",$email);
			$stmt->bindparam(":user_pass",$password);
			$stmt->bindparam(":active_code",$code);
			$stmt->execute();	
			$userID = $this->lasdID();
			if ( $usertype == 'patient' )
			{
				$stmt = $this->conn->prepare("INSERT INTO patient(PatientID,FirstName,LastName, Email) 
			                                             VALUES(:user_id,:first_name, :last_name, :user_mail)");
				$stmt->bindparam(":user_id",$this->lasdID());
				$stmt->bindparam(":first_name",$fname);
				$stmt->bindparam(":last_name",$lname);
				$stmt->bindparam(":user_mail",$email);
				
			} else {
				$stmt = $this->conn->prepare("INSERT INTO doctor(DoctorID,FirstName,LastName,Email) 
			                                             VALUES(:user_id,:first_name, :last_name,:user_mail)");
				$stmt->bindparam(":user_id",$this->lasdID());
				$stmt->bindparam(":first_name",$fname);
				$stmt->bindparam(":last_name",$lname);
				$stmt->bindparam(":user_mail",$email);
			}
			$stmt->execute();
			chdir(UPLOADS);
			mkdir($userID);
			return $userID;
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	public function login($email,$upass)
	{
		try
		{
			$stmt = $this->conn->prepare("SELECT * FROM tbl_users WHERE userEmail=:email_id");
			$stmt->execute(array(":email_id"=>$email));
			$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($stmt->rowCount() == 1)
			{
				if($userRow['userStatus']=="Y")
				{
					if($userRow['userPass']==md5($upass))
					{						
						$_SESSION['userType'] = trim($userRow['userType']);
						$_SESSION['userSession'] = $userRow['userID'];						
						$_SESSION['userID'] = trim($userRow['userID']);		
						$_SESSION['readOnly'] = 0;
						$_SESSION['caseID'] = 0;	
						$_SESSION['AllDOC'] = 0;
						$_SESSION['oId'] = 0;
						$_SESSION['caseStatus'] = OPEN;						
						return true;
					}
					else
					{
						header("Location: index.php?error");
						exit;
					}
				}
				else
				{
					header("Location: index.php?inactive");
					exit;
				}	
			}
			else
			{
				header("Location: index.php?error");
				exit;
			}		
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
	
	
	public function is_logged_in()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}
	
	public function redirect($url)
	{
		$link = "<script>window.location.replace('$url');</script>";
		echo $link ;
	}
/*
	public function redirect($url)
	{
		header("Location: $url");
	}
*/	
	public function openinwindow($url)
	{
		$link = "<script>window.open('$url'); </script>";
		echo $link ;
	}
	
	public function alertmessage($msg)
	{
		$link = "<script>alert('$msg'); </script>";
		echo $link ;
	}
	
	public function redirectwithjava($url)
	{
		$link = "<script>window.location.replace('$url');</script>";
		echo $link ;
	}
	
	public function logout()
	{
		session_destroy();
		$_SESSION['userSession'] = false;
	}
	
	function send_mail($email,$message,$subject)
	{						
		//require_once('mailer/class.phpmailer.php');
		require_once('PHPMailer/class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->SMTPDebug  = 0;                     
		$mail->SMTPAuth   = true;                  
		//$mail->SMTPSecure = "ssl";                 
		//$mail->Host       = "smtp.gmail.com";      
		//$mail->Port       = 465;  
		//$mail->SetLanguage("en", 'includes/phpMailer/language/');		
		$mail->AddAddress($email);
		//$mail->Username="ManoharPV@gmail.com";  // User User Email
		//$mail->Password="xxxxxx";            // Password
		$mail->SetFrom('medicall@jwtechinc.com','Medicall');  // Email
		$mail->AddReplyTo("medicall@jwtechinc.com","Medicall");  // email
		$mail->Subject    = $subject;
		$mail->MsgHTML($message);
		$mail->Send();
	}	
}