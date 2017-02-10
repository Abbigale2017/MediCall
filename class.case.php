<?php
require_once 'constants.php';
require_once 'dbconfig.php';

class CASES
{	

	private $conn;
	
	public function __construct()
	{	
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
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
		
	public function getWaitingCases()
	{
	  $userId = $_SESSION['userID'];	
	  if ($_SESSION['userType'] == DOCTOR) { 	  
		$stmt = $this->runQuery("SELECT COUNT(*) as total FROM casecommunication , cases WHERE casecommunication.CaseID=cases.CaseID AND cases.CaseStatus ='OPEN' AND cases.DoctorID=:userid AND casecommunication.Remedies is NULL");
	  } else {
		 $stmt = $this->runQuery("SELECT COUNT(*) as total FROM casecommunication, cases WHERE casecommunication.CaseID=cases.CaseID AND cases.CaseStatus ='OPEN' AND cases.PatientID=:userid AND casecommunication.Remedies is not NULL");
	  }
		$stmt->bindparam(":userid",$userId);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['total'];		
	}

	public function isCaseWaiting($caseId)
	{	   	  
		$stmt = $this->runQuery("SELECT COUNT(*) as total FROM casecommunication WHERE CaseID=:caseid  AND Sickness is not NULL AND Remedies is NULL");
		$stmt->bindparam(":caseid",$caseId);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($_SESSION['userType'] == DOCTOR) {return $row['total'];}		
                else if ($row['total'] > 0) {return 0; }else{ return 1;}
	}

	public function isActiveDcotor($caseID)
	{
		$docID = $_SESSION['userID'];	
                if ($_SESSION['userType'] == DOCTOR) {$sql = "SELECT COUNT(*) as total FROM cases WHERE CaseStatus='OPEN' AND DoctorID=:userid AND PatientID = (SELECT PatientID FROM cases WHERE CaseID=:caseid)";}		
                else if ($_SESSION['userType'] == PATIENT) {$sql = "SELECT COUNT(*) as total FROM cases WHERE PatientID=:userid AND CaseID=:caseid";}		

		$stmt = $this->runQuery($sql);

		$stmt->bindparam(":userid",$docID);
		$stmt->bindparam(":caseid",$caseID);
		
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['total'];		
	}
	
	public function getAverageResposeTime($userId)
	{	
		//SELECT AVG(TIMESTAMPDIFF(MINUTE, ReportDate , ResposeDate)) FROM `casecommunication` WHERE 1
		//SSELECT AVG(casecommunication.RespondedIn) as average FROM casecommunication, cases WHERE casecommunication.CaseID=cases.CaseID AND cases.DoctorID=:userid
		//SELECT AVG(TIMESTAMPDIFF(MINUTE, casecommunication.ReportDate , casecommunication.ResposeDate)) as average FROM casecommunication, cases WHERE casecommunication.CaseID=cases.CaseID AND cases.DoctorID=:userid
		$sql = "SELECT AVG(TIMESTAMPDIFF(SECOND, casecommunication.ReportDate , casecommunication.ResposeDate)) as average FROM casecommunication, cases WHERE casecommunication.CaseID=cases.CaseID AND cases.DoctorID=:userid";
		$stmt = $this->runQuery($sql);
		$stmt->bindparam(":userid",$userId);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['average'];				
	}

	public function getCases($userId,$patienthistoryflag=0)
	{
	  	  	
	  if ((($_SESSION['userType'] == DOCTOR) && $patienthistoryflag==1)) { 
		// Patient History
		 $sql = "SELECT * FROM cases, doctor WHERE cases.DoctorID=doctor.DoctorID AND cases.ActiveFlag=true AND cases.PatientID=:uId";
	  } else  if ($_SESSION['userType'] == PATIENT) { 
			$sql = "SELECT * FROM cases, doctor WHERE cases.PatientID=:uId AND cases.DoctorID=doctor.DoctorID";
	  } else if ($_SESSION['userType'] == DOCTOR) {
			$sql = "SELECT * FROM cases, patient WHERE cases.DoctorID=:uId AND cases.PatientID=patient.PatientID";
	  }
          if ($patienthistoryflag==0){ $sql = $sql . " AND cases.CaseStatus='OPEN' AND cases.ActiveFlag=true";}
	  
		$stmt = $this->runQuery($sql);
		$stmt->bindparam(":uId",$userId);
		$stmt->execute();
		return $stmt;
	}

	public function getUrgentCases($userId)
	{	  	  	
		if ($_SESSION['userType'] == PATIENT) { 
			$sql = "SELECT * FROM cases WHERE cases.PatientID=:uId AND cases.DoctorID < 0";	  
			//$sql = "SELECT * FROM cases WHERE cases.PatientID=:uId AND cases.DoctorID < 0";	  
			$stmt = $this->runQuery($sql);
			$stmt->bindparam(":uId",$userId);
		} 
		$stmt->execute();
		return $stmt;
	}

	public function getUrgentCasesDoctor()
	{	  	  	
		$userId = $_SESSION['userID'];
		if ($_SESSION['userType'] == DOCTOR) { 
			//SELECT * FROM cases, doctor WHERE FLOOR(ABS(cases.DoctorID)/100) = doctor.SpecilityID AND cases.DoctorID < 0 AND cases.ActiveFlag=true AND doctor.DoctorID=93 AND doctor.Languages like '%CAST(MOD(ABS(cases.DoctorID),100) as string)%'";
			//SELECT * FROM cases, doctor WHERE FLOOR(ABS(cases.DoctorID)/100) = doctor.SpecilityID AND cases.DoctorID < 0 AND cases.ActiveFlag=true AND doctor.DoctorID=93 AND doctor.Languages like '%CAST(MOD(ABS(cases.DoctorID),100) as CHAR)%'";
			//$sql = "SELECT * FROM cases, doctor WHERE FLOOR(ABS(cases.DoctorID)/100) = doctor.SpecilityID AND MOD(ABS(cases.DoctorID),100) in doctor.Languages AND cases.DoctorID < 0 AND  AND cases.ActiveFlag=true AND doctor.DoctorID=:uId"
			$sql = "SELECT * FROM cases, doctor WHERE FLOOR(ABS(cases.DoctorID)/100) = doctor.SpecilityID AND cases.DoctorID < 0 AND cases.ActiveFlag=true AND MOD(ABS(cases.DoctorID),100) IN (doctor.Languages) AND doctor.DoctorID=:uId";
			$stmt = $this->runQuery($sql);
			$stmt->bindparam(":uId",$userId);
		} 
		$stmt->execute();
		return $stmt;
	}

	public function getCountUrgentCasesDoctor()
	{	  	  	
		$userId = $_SESSION['userID'];
		if ($_SESSION['userType'] == DOCTOR) { 
			$sql = "SELECT COUNT(*) as total FROM cases, doctor WHERE FLOOR(ABS(cases.DoctorID)/100) = doctor.SpecilityID AND cases.DoctorID < 0 AND cases.ActiveFlag=true AND MOD(ABS(cases.DoctorID),100) IN (doctor.Languages) AND doctor.DoctorID=:uId";
			$stmt = $this->runQuery($sql);
			$stmt->bindparam(":uId",$userId);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			return $row['total'];
		} 
		return 0;
	}

	public function createAppointment($caseID,$scheduledate,$description,$duration,$patientid)
	{	  	  	
		$userId = $_SESSION['userID'];
		try
		{						
			$sql="INSERT INTO `appointments`(`ScheduleDate`,`Description`,`DoctorID`, `PatientID`, `CaseID`,`Duration`) VALUES (:scheduledate,:description,:user_id, :patientid, :caseid,:duration)";				
			
			$stmt = $this->runQuery($sql);
			$stmt->bindparam(":user_id",$userId);
			$stmt->bindparam(":caseid",$caseID);		
			$stmt->bindparam(":patientid",$patientid);				
			$stmt->bindparam(":scheduledate",$scheduledate);			
			$stmt->bindparam(":description",$description);
			$stmt->bindparam(":duration",$duration);		
			$stmt->execute();			
			// Update Case Communication with Skype Call schedule details
			$remidy = "Skype call scheduled for " . $description . " on  " . $scheduledate . " for " . $duration . " minutes. Please confirm.";
			$sql = "UPDATE `casecommunication` SET `ResposeDate`=utc_timestamp(),`Remedies`=:remidy WHERE `CaseID`=:caseID AND `Remedies` is NULL";
			$stmt = $this->runQuery($sql);
			$stmt->bindparam(":caseID",$caseID);
			$stmt->bindparam(":remidy",$remidy);
			$stmt->execute();				
		}
		catch(PDOException $ex)
		{
			echo $ex->getMessage();
		}
	}
		
	
	public function assignUrgentCase($caseID)
	{	  	  	
		$userId = $_SESSION['userID'];
		if ($_SESSION['userType'] == DOCTOR) { 
			$stmt = $this->runQuery("UPDATE `cases` SET `DoctorID`=:uid WHERE `CaseID`=:caseid");			
			$stmt->bindparam(":uid",$userId);
			$stmt->bindparam(":caseid",$caseID);
			$stmt->execute();

			$stmt = $this->runQuery("SELECT PatientID FROM cases WHERE `CaseID`=:caseid");			
			$stmt->bindparam(":caseid",$caseID);
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$patientid = $row['PatientID'];
			
 			$date = date('Y-m-d H:i:s');		 
			$currentDate = strtotime($date);	
			$futureDate = $currentDate+(60*5);	
				
			$scheduletime = date("Y-m-d H:i:s", $futureDate);
			
			//echo $scheduletime;
			$description = " Urgent Consultation Call";
			$duration = "30";
			
			$this->createAppointment($caseID,$scheduletime,$description,$duration,$patientid);
			return $stmt;
		} 
		return null;
	}
	
	public function getCase($caseID)
	{
		$stmt = $this->runQuery("SELECT * FROM cases, doctor WHERE cases.DoctorID=doctor.DoctorID AND cases.CaseID =:caseid");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
		return $stmt;
	}

	public function activateCase()
	{
		$caseID = $_SESSION['caseID'];	
		$stmt = $this->runQuery("UPDATE `cases` SET `ActiveFlag`=true WHERE `CaseID`=:caseid");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
		return $stmt;
	}
	
	public function deleteCase()
	{
		$caseID = $_SESSION['caseID'];	
		$stmt = $this->runQuery("DELETE FROM `cases` WHERE `CaseID`=:caseid");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
		return $stmt;
	}

	public function getCaseStatus()
	{
		$caseID = $_SESSION['caseID'];	
		$stmt = $this->runQuery("SELECT CaseStatus FROM cases WHERE CaseID =:caseid");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row['CaseStatus'];
	}
	  
	public function closeCase()
	{
		$caseID = trim($_SESSION['caseID']);	 
		if ($_SESSION['userType'] == PATIENT) { 
		
			$stmt = $this->runQuery("UPDATE `cases` SET `CaseStatus`='CLOSE' WHERE `CaseID`=:caseid");
			$stmt->bindparam(":caseid",$caseID);
			$stmt->execute();
			//Insert into Doctor Payment
			$stmt1 = $this->runQuery("INSERT INTO doctorpayment (DoctorID,CaseID,Amount) SELECT DoctorID,CaseID,Amount FROM cases WHERE CaseID=:caseid");
			$stmt1->bindparam(":caseid",$caseID);
			$stmt1->execute();
			return $stmt1;
		}
	}	
}