
	<?php
	include 'home.php';

	?>

	<!DOCTYPE html>
	<html class="no-js">
		
		<head>
			<title><?php echo $row['userEmail']; ?></title>
			<!-- Bootstrap -->
			<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
			<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
			<link href="assets/styles.css" rel="stylesheet" media="screen">
			<meta http-equiv="refresh" content="15" >
	<script type="text/javascript">

		function FillData(elm)
		{
			//alert(elm.id);
			var i = elm.id.indexOf("|");
			var conid = elm.id.substr(0,i);
			//var j = elm.value.lastIndexOf("|");
			//var specilities = elm.value.substr(i+1,j-i-1);
			var countryname = elm.id.substr(i+1);
	
		document.getElementById("conid").value = conid;	
		//document.getElementById("specilityval").value = specilities;
		document.getElementById("countryname").value = countryname;			
};

</script> 		
	        
	</head>
	<body >

	<?php
	
	$countryname = $_POST['countryname'];
	$conid = $_POST['conid'];
		//$country = null;
		if (isset($_POST['add'])) {	
			$countryname = $_POST['countryname'];
            //$sickness=$_POST['sickness'];			
			//$speciality=implode(",",$_POST['speciality']);
			
			$sql="INSERT INTO `countries` (`CountryName`) VALUES ( '$countryname')";		  
			  $stmt = $user_home->runQuery($sql);
			  $stmt->execute();	    
		}  
		else if (isset($_POST['delete'])){		
			  $sql="DELETE FROM `countries` WHERE `CountryID` = '$conid'";		  
			  $stmt = $user_home->runQuery($sql);
			  $stmt->execute();		
		}
		else if (isset($_POST['update'])) {
		//$speciality=implode(",",$_POST['speciality']);
		$countryname=$_POST['countryname'];
		$conid = $_POST['conid'];
			//$sql1="DELETE FROM `countries` WHERE `CountryID` = '$conid'";
			$sql="UPDATE `countries` SET `CountryName`='$countryname' WHERE `CountryID` = '$conid'";
			$stmt = $user_home->runQuery($sql);
			$stmt->execute();
			//$stmt1 = $user_home->runQuery($sql1);
			//$stmt1->execute();			
		}		
		
	?>
	

<form  name="country" action="admincountry.php" method="post">	
<div class="hero-unit">
	

	<?php include 'reference.php';?>
	</br> </br>
		
		<table border="0" width="780px" align="center">
			

		<tr>
			<td align='left'>Country:</td>
			<td hidden><input type="text"  name="conid" id="conid" value=<?php echo $conid; ?> ></td>
			<td><input type="text" class="input-block-level" name="countryname" id="countryname" value=<?php echo $countryname; required?>></td>
		</tr>			
			
			<tr>			
				
				<td align='center'><input type="submit" name="add" class="btn btn-primary" value="add"></td>
				<td align='center'><input type="submit" name="update" class="btn btn-primary" value="update"></td>
				<td align='center'><input type="submit" name="delete" class="btn btn-primary" value="delete"></td>
			</tr>
			
			<tr></tr>
			<tr></tr>
			<tr></tr>

		</table>	
	
		<h2 align="center"> Countries List</h2>
	
	<table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >

		  <thead>
			<tr>		 
			  <th>Country ID</th>
			  <th>Country</th>
			  <th>Operation</th>
			  
			</tr>
		  </thead>
		  <tbody align="center">
		 
			<?php		
			$stmt = $user_home->runQuery("SELECT * FROM `countries`");
			$stmt->execute();
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){   
			$strsick = $row['CountryID']."|".$row['CountryName'];
			//echo $strsick;
			//javascript:FillData({$str});
            echo
				"<tr>
				  <td>{$row['CountryID']}</td>
				  <td>{$row['CountryName']}</td>              
				  <td><input type='submit' id='{$strsick}' value='Select' onClick='javascript:FillData(this)'></td>			  
				 </tr>\n";			
			  }
			?>
		  </tbody>	  
		</table>
	
	
	
	
	</div>
	</form>	
		
	</body>
	</html>