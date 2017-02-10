
<?php
include 'home.php';

$caseID = $_GET['caseid'];
$name = $_GET['name'];
$doctorid = $_GET['doctorid'];
$patientid = $_GET['patientid'];

$_SESSION['caseID'] = $caseID;
$id = $_SESSION['userID'];
$_SESSION['userID'] = $id;
//$_SESSION['userDir'] = UPLOADS . "\\" . $id . "\\" . $caseID;
if ($_SESSION['userType'] == DOCTOR) $_SESSION['userDir'] = UPLOADS . "\\" . $patientid;
else $_SESSION['userDir'] = UPLOADS . "\\" . $id;

if (isset($_GET['patientflag'])) $patientflag = $_GET['patientflag']; 
else $patientflag = 0;

if ($_SESSION['userType'] == PATIENT ) $name_label = "Doctor Name";  else $name_label = "<a href=cases.php?patientid=$patientid&patientflag=1>Patient History</a> Patient Name";
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
    <script type="text/javascript">

    function submitAction(act) {
         document.sample.action = act;
         document.sample.submit();

    }
    </script>
    
<body bgcolor="cyan" font_color="black">

<div class="container-fluid"> 
	<tr>
		<a class="brand" href="updatecase.php?oid="<?php if ($_SESSION['userType'] == PATIENT )echo "$doctorid"; else echo "$patientid"; ?>>New Case</a>
		<a class="brand" href="viewfiles.php?patientflag="<?php echo $patientflag; ?>>New Case</a>
		
</div>
	
<Form name="patient" action="caseclose.php?caseid=<?php echo "$caseID"?>'"method="post" >
<h1 align='center'>Case Detail</h1>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr><tr>
   <td align='center'><h4> <?php echo "Case : $caseID"?></h4></td>
   <td align='center'><h4> <?php echo "$name_label :   $name "?></h4></td>  
   <?php if ($_SESSION['userType'] == PATIENT ) { ?>
   <td align='center'><input type="submit" name="Close" value="Close"> </td>	
   <?php } ?>
</tr></tr>
	<table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<tr>
	
	<?php
		$stmt = $user_home->runQuery("SELECT * FROM casecommunication WHERE CaseID=:caseid AND Remedies is not NULL");
		$stmt->bindparam(":caseid",$caseID);
		$stmt->execute();
      if ($patientflag == 0) {   
	  ?>
	  
		<div align='center' width="780px" height="315">
		<iframe align='top' width="780px" height="315" name="newcase" src="updatecase.php?oid="<?php if ($_SESSION['userType'] == PATIENT )echo "$doctorid"; else echo "$patientid"; ?> frameborder="" allowfullscreen></iframe>
		</div>
	  <?php } ?>
	</tr>
	<tr> <td> </td> </tr>
	</table>
	  
      <table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead>
        <tr>
		  <th>Repoted Date</th>
          <th>Sickness</th>
		  <th>ResposeDate</th>
          <th>Remedies</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
            echo
            "<tr>
              <td>{$row['ReportDate']}</td>
              <td><textarea class='input-block-level'  disabled cols='30' rows='1' value=>{$row['Sickness']}</textarea></td>
			  <td>{$row['ResposeDate']}</td>
              <td><textarea class='input-block-level'  disabled cols='30' rows='1' value=>{$row['Remedies']}</textarea></td>
			</tr>\n";
          }
        ?>
      </tbody>
    </table>
	
	<?php $user_home->viewAttachedDocuments($patientflag); ?>

	</table>
	</form>
    </body>
    </html>