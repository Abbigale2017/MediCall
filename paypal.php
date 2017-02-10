<?php
require_once 'home.php';

$caseID = $_SESSION['caseID'];
//echo $caseID;
$stm = $cases_home->getCase($caseID);
$row = $stm->fetch(PDO::FETCH_ASSOC);
//echo $row['Amount'];		
?>
<!DOCTYPE html>
<html class="no-js">
    
<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>INTEGRATE PAYPAL PAYMENT GATEWAY IN PHP</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
                
</head>
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">

<div class="panel panel-primary" style="width:50%;margin:0 auto; margin-top:2%">
<div class="panel-heading"><h3>Paypal Payment Gateway in PHP</h3></div>
<div class="panel-body" style="height:40%; text-align:center;" >
<p class="bg-info" id="msg"></p>
 <form class="form-horizontal" role="form" id="paypalForm" method="post" action="<?php echo PAYPAL_URL; ?>">
    <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="credits" value="510">
    <input type="hidden" name="userid" value="1">
    <input type="hidden" name="cpp_header_image" value="">
    <input type="hidden" name="no_shipping" value="1">
    <input type="hidden" name="handling" value="0">
    <input type="hidden" name="cancel_return" value="paypalrequest.php?type=cancel">
    <input type="hidden" name="return" value="paypalrequest.php?type=success">
  <div class="form-group">
    <label class="control-label col-sm-2" for="amount">Amount:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="amount" placeholder="Enter Amount" required="required" value='<?php echo "{$row['Amount']}"?>'>
    </div>
  </div>
     <div class="form-group">
    <label class="control-label col-sm-2" for="currency">Quantity:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="quantity" placeholder="Enter Quantity" value="1" required="required">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="currency">Currency:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="currency" placeholder="Enter Currency Type" value="<?php echo CURRENCY; ?>" required="required">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="description">Description:</label>
    <div class="col-sm-10">
      <textarea class="form-control" name="item_name" placeholder="Enter Description">'<?php echo "{$row['Sickness']}"?>'</textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="image" src="images/paypal.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
    <img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
    </div>
  </div>
</form>
</div>
</div>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
