<?php
require_once 'home.php';

$caseID = $_SESSION['caseID'];
//echo $caseID;
$stm = $user_home->getCase($caseID);
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
	<div>
		<h2>Payment Failure</h2>
	</div>

	<div>
		<?php 
			if(isset($_POST['status'])){
				if($_POST['status']=="failure"){
					echo "<p>Payment Failed.<br>Details Are Below.</p>";
					echo "<p>Failure Reason: ".$_POST['unmappedstatus']."</p>";
					echo "<p>Txn Id: ".$_POST['txnid']."</p>";
					echo "<p>Name: ".$_POST['firstname']."</p>";
					echo "<p>Email: ".$_POST['email']."</p>";
					echo "<p>Amount: ".$_POST['amount']."</p>";
					echo "<p>Phone No: ".$_POST['phone']."</p>";
					echo "<p>Product Info: ".$_POST['productinfo']."</p>";
				}
			}

			?>
	</div>
</body>
</html>