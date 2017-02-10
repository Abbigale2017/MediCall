			
<?php
include 'home.php';

$caseID = $_SESSION['caseID'];

$stm = $cases_home->getCase($caseID);
    $row1 = $stm->fetch(PDO::FETCH_ASSOC);
	$docID = $row1['DoctorID']; 
	//echo $docID;
	

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
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<form id="feedback" name="feedback" method="post" action="feedback.php">
<div width="780px" class="hero-unit">
<h2 align='center'>Rate Your Doctor</h2>
	<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
		
	 <tr> <td> </td> </tr>
	 <tr>
	  
	  <td align='left'>Please Rate Your Overall Experience With Us:</td>
		<td>
			<select name="overallsatisfaction" class="input-block-level">
				<option value=1 >Very satisfied</option>
				<option value=2 >Poor</option>
				<option value=3 >Satisfactory</option>
				<option value=4 >Good</option>
				<option value=5 > Excellent</option>
			</select class="input-block-level"  required /> </td><br><br><br>
	  
	  </tr>
	  <tr> <td> </td> </tr>
	  <tr>
	 <td align="left"> Please Tell Us More:</td>
	  <td> <textarea name="suggestion" class="input-block-level"  cols="70" rows="2"></textarea></td>
	 </tr>
	 
	  <tr> <td> </td> </tr>
	 </table> 
	 <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
	  <tr>
	  <td align='center'><input type="submit" name="submit" class="btn btn-primary" value="submit"></td>
	  </tr>
	 </table>
</div>	 
</form>

</body>
</html>
	<?php	
	if (isset($_POST['submit'])) {
	
		$overallsatisfaction=$_POST['overallsatisfaction'];
		$suggestion=$_POST['suggestion'];
			
		$sql="INSERT INTO `feedback`(`CreateDate`,`DoctorID`,`Overallsatiesfaction`,`Suggestion`) VALUES (now(),:user_id,:overallsatisfaction,:suggestion)";  //  (:caseID,now(),:sickness)

		$stmt = $user_home->runQuery($sql);
		$stmt->bindparam(":user_id",$docID);
		$stmt->bindparam(":overallsatisfaction",$overallsatisfaction);
		$stmt->bindparam(":suggestion",$suggestion);	
		$stmt->execute(); 	
		echo "<script>window.location.replace('cases.php');</script>";	
	}
	?>
