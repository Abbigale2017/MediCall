
<?php
require_once 'home.php';

$id = $_SESSION['userID'];
$_SESSION['userID'] = $id;
$caseID = $_SESSION['caseID'];
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
		<meta charset="utf-8">    
		<title><?php echo $row['userEmail']; ?></title>
		
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
		
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


<script type="text/javascript">

function GMTTime() {
	
	var dt = document.getElementById("scheduledate").value + " " + document.getElementById("timepicker").value;
	var d = new Date(dt)	
	//document.getElementById("scheduletime").value = d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2) + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2) +":"+ ("0" + d.getSeconds()).slice(-2);
	
	document.getElementById("scheduletime").value = d.toISOString();
	//alert(d.toISOString());
};

function LocalTime(lt) 
{	
	//alert(lt);
	var d = new Date(lt);	
	//return d.getFullYear() + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + ("0" + d.getDate()).slice(-2) + " " + ("0" + d.getHours()).slice(-2) + ":" + ("0" + d.getMinutes()).slice(-2) +":"+ ("0" + d.getSeconds()).slice(-2);	
	var rstr = d.toLocaleDateString() + " " + d.toLocaleTimeString();
	document.write(rstr);
};


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

$("#scheduledate").datepicker( 

        {
            maxDate: '0', 
            beforeShow : function()
            {
                jQuery( this ).datepicker('option','minDate', 0 );
            } ,  
            altFormat: "dd/mm/yy", 
            dateFormat: 'dd/mm/yy'

        }

)

$(document).ready(function() {
    $("#scheduledate").datepicker({minDate:0});
}),

$(document).ready(function() {
    $("#timepicker").timepicker({minTime:0});
});

</script>

</head>

<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<Form name="newappointment" action="newappointment.php" method="post" >
<div width="780px" class="hero-unit">
<?php if ($_SESSION['userType'] != PATIENT) {
			if ( $caseID == 0 ) include 'membersubmenu.php';
			else include 'casedetailmenu.php';
		}
?>

<h3 align='center'>Schedule</h3>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<?php if ($_SESSION['userType'] != PATIENT ) { ?>
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<tr>
		<td align='left'>Schedule Date:</td>
		<td><input type="text" class="input-block-level" id="scheduledate"  name="scheduledate" required ></td>
		<td width = "40"> </td>		
		<td align='left'>Time:</td>
		<td><input type="time" class="input-block-level" name="loaclscheduletime" id="timepicker" onChange="javascript:GMTTime()"></td>
		<td hidden ><input type="text" class="input-block-level" name="scheduletime" id="scheduletime" ></td>
		<td align='left'>View:</td>
		<td align='center'><input type="submit" name="View" class="btn btn-primary" value="View" > </td>

	</tr>
	
	<tr>
		<td align='left'>Description:</td>
		<td><input type="text" class="input-block-level" name="description"  ></td>
		<td width = "40"> </td>		
		<td align='left'>Duration:</td>
		<td><input type="text" class="input-block-level" name="duration" value=30  ></td>
		<td align='left'>Add:</td>
		<td align='center'><input type="submit" <?php if ($caseID == 0 ) echo "disabled"; ?>  name="Add" class="btn btn-primary" value="Add" > </td>
</tr>
	<tr> <td> </td> </tr>		
	</table>
	
	<?php 

	if ((isset($_POST['Add'])) && ($_POST['scheduledate']) && ($_POST['scheduletime']) && ($_POST['description'])){
		$scheduledate = $_POST['scheduledate'];
		$scheduletime = $_POST['scheduletime'];
		//echo $scheduletime;
		$d = new DateTime($scheduletime);
		$scheduletime = $d->format('Y-m-d H:i:s');
		$description = $_POST['description'];
		$duration = $_POST['duration'];
		$patientid= $_SESSION['oId'];
		//echo $scheduledate . "-" . $scheduletime . " - " . $description . " - " . $duration;

		$cases_home->createAppointment($caseID,$scheduletime,$description,$duration,$patientid);	
	}// else echo " Please fill all fields";
		
	if (isset($_POST['scheduledate'])){
		$scheduledate = $_POST['scheduledate'];
		$stm = $user_home->runQuery("SELECT * FROM `appointments` WHERE DoctorID=:uId AND ScheduleDate=:scheduledate");
		$stm->execute(array(":uId"=>$id, ":scheduledate"=>$scheduledate));
	} else {
		$stm = $user_home->runQuery("SELECT * FROM `appointments` WHERE DoctorID=:uId ORDER BY `ScheduleDate` ASC");
		$stm->execute(array(":uId"=>$id));
	}	
}  else {
		$stm = $user_home->runQuery("SELECT * FROM `appointments` WHERE PatientID=:uId ORDER BY `ScheduleDate` ASC");
		$stm->execute(array(":uId"=>$id));
}
	?>
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead>
        <tr>
		  <th align='left'>Date Time</th>		  
		  <th align='left'>Duration</th>
		  <th align='left'>Case ID</th>
          <th align='left'>Description</th>
		  <th align='left'>Call Skype</th>
        </tr>		
      </thead>

        <?php
		  $preCaseID = 0;
		  $today = date("Y-m-d H:i:s");
          while( $row = $stm->fetch(PDO::FETCH_ASSOC) ){	
			$newCaseID = $row['CaseID'];
			$d = new DateTime($row['ScheduleDate']);
			$dtstr = $d->format('Y-m-d\TH:i:s.u');
			//echo $dtstr;
			//$dateInLocal = date("Y-m-d H:i:s", strtotime($row['ScheduleDate']));
			//if ($preCaseID != $newCaseID ) { $url = $user_home->getSkypeURL($newCaseID);}
			if ($today > $row['ScheduleDate']){ $st = NORMAL; $url= null;} else { $st = BOLD; $url = $user_home->getSkypeURL($newCaseID);}	
            echo
            "<tr $st>			                
              <td> <script>	LocalTime('$dtstr');	</script> </td>
			  <td>{$row['Duration']}</td>
              <td>{$row['CaseID']}</td>
			  <td>{$row['Description']}</td>	
			  <td>$url</td>			  
			</tr> \n";
			
			$preCaseID = $newCaseID;
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