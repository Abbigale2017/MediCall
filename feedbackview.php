<?php
include "home.php";
$docID = base64_decode($_GET['id']);
?>

<!doctype html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>///
        <![endif]-->
        
    </head>
   <body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
   <form>
   <div width="780px" class="hero-unit">
   <h3 align='center'>Patient's Reviews</h3>
 
   <?php
		$avgreponse = $cases_home->getAverageResposeTime($docID);
      //execute the SQL query and return records
	  //SELECT AVG(casecommunication.RespondedIn) FROM casecommunication, cases WHERE casecommunication.CaseID=cases.CaseID AND cases.DoctorID=:userid
	  
		$stmt = $user_home->runQuery("SELECT * FROM `feedback` WHERE DoctorID=:docid");
		$stmt->bindparam(":docid",$docID);
		$stmt->execute();
      ?>
		<h3 align='center'> Average Response Time : Hrs <?php echo date('H:i', $avgreponse);?> Min </h3>
		
      <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead>
        <tr>
          <th>CreateDate</th>
          <th>DoctorID</th>
		  <th>satiesfaction</th>
          <th>suggestion</th>
        </tr>
      </thead>
      <tbody>
        <?php
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){
			  if($row['Overallsatiesfaction']== 1) { $st = 'Very satisfied'; } 
				else if ($row['Overallsatiesfaction']== 2){ $st = 'Satisfied'; }
				else if ($row['Overallsatiesfaction']== 3){ $st = 'Neutral'; }					
				else if ($row['Overallsatiesfaction']== 4){ $st = 'Unsatisfied'; }
				else if ($row['Overallsatiesfaction']== 5){ $st = 'Very unsatisfied'; };
            echo
            "<tr>
              <td>{$row['CreateDate']}</td>
              <td>{$row['DoctorID']}</td>
			  	<td> $st </td>
              <td> <textarea rows='1' cols='70'  disabled> {$row['Suggestion']} </textarea></td>
			</tr>\n";
          }
        ?>
		</tbody>
		</table>
		</div>
		</form>
    </body>
    </html>'