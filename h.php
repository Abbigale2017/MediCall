<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
		
		<link href="styles/custom.css" rel="stylesheet" media="screen">
		
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
	
    </head>
<style type="text/css">
div#header-fixed {position:fixed; top:0px; margin:auto; z-index:100000; width:100%;}

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

	<div id="header-fixed">
            <!--div class="navbar-inner"-->
      
				
				<!--div id="divLogo" class="pull-left">
                        <a href="index.html" id="divSiteTitle"><img src="images/mcLogo.png" width="60" height="40"> medicall</a><br />
                  <a href="index.html" id="divTagLine">doctor is always in</a>                    
				</div-->
				
				
				<!--div class="navbar"-->

              
                    <!--a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
					 
                    </a-->
					 <?php
					 if ( $_SESSION['userType'] == ADMIN ) {
					 echo
					"<tr>
						<a class=brand href=adminpatients.php class='footerText' >Patients</a>
						<a class=brand href=admindoctors.php>Doctors</a>
					</tr>\n" ;
					 } if ( $_SESSION['userType'] == APPROVER ) {
					 echo
					"<tr>
						<a class=brand href=admindoctor.php>Doctor</a>
					</tr>\n" ;
					 } if ( $_SESSION['userType'] == DOCTOR ) {
					 echo
					"<tr>
						<a class=brand href=doctor.php?id=>Member Home</a>
						<a class=brand href=cases.php>Cases</a>
					</tr>\n" ;
					 } if ( $_SESSION['userType'] == PATIENT ) {
					 echo
					"<tr>
						<a class=headText href=patient.php?id=>Member Home</a>
						<a class=headText href=cases.php>Cases</a>
					</tr>\n" ;
					 } 
					?>
					                    
					<ul class="nav pull-right">
							
						<li class="dropdown">
							<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i> 
							<?php   echo $row['userEmail'].'('. $_SESSION['userType'].')';?> <i class="caret"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a tabindex="-1" href="logout.php">Logout</a>
								</li>
							</ul>
						</li>
					</ul>
				<!--/.nav-collapse</span> -->

				
				
                <!--/div--> 
                    </div>
                    </div>
			
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
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
  </body>