<?php
require_once 'home.php';

$caseID = $_SESSION['caseID'];
//echo $caseID;
$stm = $cases_home->getCase($caseID);
$row = $stm->fetch(PDO::FETCH_ASSOC);
//echo  $row['Amount'];		
?>
<!DOCTYPE html>
<html>
<head>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
</head>
<body>
<form name="postForm" action="form_process.php" method="POST" >
<div width="780px" class="hero-unit">
	<div>
		
		<h3 align="center">Submit it for starting the transaction...</h3>
	</div>

<div>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">

	<tr><td>txnid</td><td><input type="text" name="txnid" value="<?php echo $txnid=time().rand(1000,99999); ?>" /></td></tr>
	<tr><td>amount</td><td><input type="text" name="amount" value='<?php echo "{$row['Amount']}"?>' /></td></tr>
	<tr><td>firstname</td><td><input type="text" name="firstname" value='<?php echo "{$row['FirstName']}"?>' /></td></tr>
	<tr><td>email</td><td><input type="text" name="email" value='<?php echo "{$row['Email']}"?>' /></td></tr>
	<tr><td>phone</td><td><input type="text" name="phone" value='<?php echo "{$row['Phone']}"?>' /></td></tr>
	<tr><td>productinfo</td><td><input type="text" name="productinfo" value='<?php echo "{$row['Sickness']}"?>' /></td></tr>
	<tr><td>success url</td><td><input type="text" name="surl" value="http://e-medicall.com/member/psuccess.php" size="64" /></td></tr>
	<tr><td>failure url</td><td><input type="text" name="furl" value="http://e-medicall.com/member/fail.php" size="64" /></td></tr>
	<tr><td><input type="submit" /></td><td><input type="reset" /></td></tr>
	
</table>
</div>
</div>
</form>
</body>
</html>