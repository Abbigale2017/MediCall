<?php
$caseid = $_SESSION['caseID'];
?>
<style type="text/css">
<!--
.submenu {
    background-color:  ;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 24px;
}
.submenu :hover {
    background-color: #FF0000;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 24px;
}
-->
        </style>
<div> 
        <ul>
        	<div align="center">
				<?php if (($_SESSION['userType'] == DOCTOR ) || ($_SESSION['userType'] == PATIENT )) {
					if ($_SESSION['userType'] == DOCTOR ) { ?>
					<a class=submenu href='doctor.php?id='>My Account</a>
					<a class=submenu href='newappointment.php'>Schedules</a>
					<a class=submenu href='doctorpayment.php'>Payment</a>
				<?php }  else { ?>
					<a class=submenu href='patient.php?id='>My Account</a>
					<a class=submenu href='alldocuments.php'>Attachements</a>
				<?php } 
				} ?>					
      	    </div>
        </ul>         
</div>