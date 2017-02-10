
<?php
include 'home.php';


$docID = $_SESSION['userID'];
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
<Form>
<div width="780px" class="hero-unit">	   
<?php include 'membersubmenu.php'; ?>
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<tr><tr>
	<td align='center'><h3>Payment Details</h3></td>
</tr></tr>
	
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead> 	         
        <tr>
          <th align='left'>Case ID</th>
		  <th align='left'>Paid Date</th>
          <th align='left'>Amount</th>		 
  		  <th align='left'>Paid Status</th>

        </tr>				
      </thead>	 
        <?php
	
		
		$stmt = $user_home->getPayment();		
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){	
			  if ($row['PaidFlag'] == 1 ){ $st = NORMAL;} else {$st = BOLD;};			  		  
            echo
            "<tr $st>
              <td>{$row['CaseID']}</td>
              <td>{$row['PaidDate']}</td>
              <td>{$row['Amount']}</td>
			  <td>{$row['PaidFlag']}</td>
			</tr>\n";
          }
	  ?>
	</tr>
	<tr> <td> </td> </tr>
	</table>
		  
	</table>
	</div>
	</Form>
    </body>
    </html>