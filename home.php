<?php
session_start();
require_once 'class.user.php';
require_once 'class.case.php';



$user_home = new USER();
$cases_home = new CASES();
$_SESSION['AllDOC'] = 0;
error_reporting(0);

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
if ( $_SESSION['userType'] == DOCTOR ) {
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users , doctor WHERE tbl_users.userID=:uid AND doctor.DoctorID =:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION['userStatus'] = trim($row['Status']);
} else if ( $_SESSION['userType'] == PATIENT ){
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users , patient WHERE tbl_users.userID=:uid AND patient.PatientID =:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	$_SESSION['userStatus'] = trim($row['Status']);
} else {
	$stmt = $user_home->runQuery("SELECT * FROM tbl_users  WHERE userID=:uid");
	$stmt->execute(array(":uid"=>$_SESSION['userSession']));
	$row = $stmt->fetch(PDO::FETCH_ASSOC);	
}	

?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="scripts/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="scripts/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="scripts/assets/styles.css" rel="stylesheet" media="screen">
		
		<!--link href="styles/custom.css" rel="stylesheet" media="screen"-->
		
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
	
    </head>
<style type="text/css">

.headBar {
	padding-top: 20px;
	font-size: 14px;
	background-color: #000000;
	padding-right:20px;
	width:100%;
}

.FootBar {
	font-size: 14px;
	background-color: #000000;
	padding-right:20px;
	width:100%;
}

#footer {
  padding-top: 10px;
  position: fixed;
  bottom:0;
  left: 0;
  height: 30px;
}
.headText{
	font-size: 26px;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
	padding-right:20px;
}
.footerText{
	font-size: 14px;
	padding-left: 20px;
	padding-right:20px;
	color: #FFFFFF;
	font-family: Arial, Helvetica, sans-serif;
 }

</style>    
    <body>

	<div class="navbar navbar-fixed-top">
            <!--div class="navbar-inner"-->
        <div class="divPanel topArea notop nobottom">
            <div class="headBar"> 
			<div class="row-fluid">
                <div class="span12">		
							
				<!--div id="" class="">
                        <a href="index.html" id="divSiteTitle"><img src="images/medicallLogo.png" height='40'"></a><br /><span>
                  <a href="index.html" id="divTagLine">doctor is always in</a>                    
				</div-->
                  <div id="divLogo" class="pull-left" height='20' >
					<a href="index.php" id="divSiteTitle"></a><br />			  
				  </div>
				  
				<div id="divMenuRight" class="pull-right">
				<!--div class="navbar"-->
                 <!--div class="navbar">
                        <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                            NAVIGATION <span class="icon-chevron-down icon-white"></span>
                        </button-->
				<div class="nav-collapse collapse">
                <class="container-fluid">
                    <!--a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
					 
                    </a-->
					<ul class="nav pull-right">
					
					 <?php					 
					 if ( $_SESSION['userType'] == ADMIN ) {
						 $_SESSION['readOnly'] = 1;
					 echo
					"<li><a class=brand href=admindoctors.php>Doctors</a></li>
					<li><a class=brand href=adminpatients.php>Patients</a></li>				
					<li><a class=brand href=adminsickness.php>Reference Data</a></li>	
					\n" ;
					 } else if ( $_SESSION['userType'] == APPROVER ) {
						 $_SESSION['readOnly'] = 1;
					 echo
						"<li><a class=brand href=admindoctors.php>Doctors</a></li>
						\n" ;
					 } else if ( $_SESSION['userType'] == DOCTOR ) {
						 if ( $_SESSION['userStatus'] == APPROVED) {
							 $cnt = $cases_home->getWaitingCases();
							 echo
							"<li><a class=brand href=cases.php>Cases($cnt)</a></li>
							<li><a class=brand href=doctor.php>My Account</a></li>
							\n" ;
						 } else {
							 echo
							"<li><a class=brand href=doctor.php>My Account</a></li>
							\n" ;
						 }
					 } else if ( $_SESSION['userType'] == PATIENT ) {
						 if ( $_SESSION['userStatus'] == APPROVED) {
							 $cnt = $cases_home->getWaitingCases();
							 echo
							"<li><a class=headText href=cases.php>Cases</a></li>
							<li><a class=headText href=patient.php>My Account</a></li>
							\n" ;
						 } else {
							 echo
							"<li><a class=headText href=patient.php>My Account</a></li>
							\n" ;
						 }
					 } 
					?>
					                    
						</li>
							
						<li class="dropdown">
							<a href="#" role="button"  class="dropdown-toggle" data-toggle="dropdown" > <i class="icon-user"></i> 
							<?php   echo $row['userEmail'].'('. $_SESSION['userType'].')';?> <i class="caret"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a tabindex="-1" href="logout.php">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
                    </div>

                    <!--/div-->
			
			</div>
            </div>
			
			
                </div>
            </div>
        </div>
        </div>

<div class="FootBar" id="footer"> <div align="center"><span class="footerText"><class="footerText">Copyright © 2016 Jayson & Williams Technologies Inc</div>
</div>
		
		
		
		<!--  
		
		<div align='center' width="100%", height="auto">
		<iframe name='memberbody' align='top' width="100%" height="auto" src="viewfiles.php" frameborder="0" allowfullscreen></iframe>
		</div>
		-->
        <!--/.fluid-container-->
        <script src="scripts/bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="scripts/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
  </body>