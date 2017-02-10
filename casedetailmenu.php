<?php
$enotherId = base64_encode($_SESSION['oId']);

$encaseid = base64_encode($_SESSION['caseID']);


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
				<a class=submenu href='casedetail.php?caseID=<?php echo $encaseid ?>'?>Case Detail</a>
				<!--a class=submenu href='viewattachments.php'>Attachments</a-->
				<?php 
				 if (($_SESSION['userType'] == DOCTOR) && ($_SESSION['readOnly'] == 0)) { 
				 ?>
					<a class=submenu href='newappointment.php'>Schedules</a>
				<?php } ?>
      	    </div>
        </ul>         
</div>