<?php
require_once 'home.php';
if (isset($_GET['docid'])){
	try {
		$docID = base64_decode($_GET['docid']);
		$stmt = $user_home->runQuery("SELECT * FROM `doctab` WHERE DocID=:uId");
		$stmt->bindparam(":uId",$docID);	
		$stmt->execute();	
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($row['CaseID'] == 0) $displayfile = "uploads/".$row['UserID']."/".$row['FilePath'];
		else $displayfile = "uploads//".$row['UserID']."/".$row['CaseID']."/".$row['FilePath'];

	}
	catch(PDOException $ex)
	{
		echo $ex->getMessage();
	}
} else if (isset($_GET['file'])){
	$displayfile = base64_decode($_GET['file']);
}
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
<script type="text/javascript">
function goBack() {
    window.location.hash = window.location.lasthash[window.location.lasthash.length-1];
    //blah blah blah
    window.location.lasthash.pop();
}
</script>  				
</head>
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<div align='center' width='100%' height='100%'>
		<iframe align='top' width='780px' height='780px' src='<?php echo $displayfile; ?>' frameborder='0' allowfullscreen></iframe>
		<input align='left' type="button" name="Close" value="Close" onclick="javascript:window.history.back();">
</div>
</body>
</html>