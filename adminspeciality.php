
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
			<meta http-equiv="refresh" content="30" >
<script type="text/javascript">

function FillData(elm)
{
			//alert(elm.id);
			var i = elm.id.indexOf("|");
			var SpecilityID = elm.id.substr(0,i);
			//var j = elm.value.lastIndexOf("|");
			//var specilities = elm.value.substr(i+1,j-i-1);
			var SpecilityName = elm.id.substr(i+1);
	
		document.getElementById("SpecilityID").value = SpecilityID;	
		//document.getElementById("specilityval").value = specilities;
		document.getElementById("SpecilityName").value =SpecilityName;			
};
</script> 		
	        
	</head>
	<body >

	<?php
	
	$SpecilityName = $_POST['SpecilityName'];
	$SpecilityID = $_POST['SpecilityID'];
		//$country = null;
		if (isset($_POST['add'])) {	
			$SpecilityName = $_POST['SpecilityName'];
			
			$sql="INSERT INTO `specility` (`SpecilityName`) VALUES ( '$SpecilityName')";		  
			  $stmt = $user_home->runQuery($sql);
			  $stmt->execute();	    
		} else if (isset($_POST['delete'])){		
			  $sql="DELETE FROM `specility` WHERE `SpecilityID` = '$SpecilityID'";		  
			  $stmt = $user_home->runQuery($sql);
			  $stmt->execute();		
		} else if (isset($_POST['update'])) {
		//$speciality=implode(",",$_POST['speciality']);
		$SpecilityName=$_POST['SpecilityName'];
		$SpecilityID = $_POST['SpecilityID'];
			//$sql1="DELETE FROM `Languages` WHERE `LangID` = '$SpecilityID'";
			$sql="UPDATE `specility` SET `SpecilityName`='$SpecilityName' WHERE `SpecilityID` = '$SpecilityID'";
			$stmt = $user_home->runQuery($sql);
			$stmt->execute();
			//$stmt1 = $user_home->runQuery($sql1);
			//$stmt1->execute();			
		}		
		
	?>
	

<form  name="specility" action="adminspeciality.php" method="post">	
<div class="hero-unit">
	

	<?php include 'reference.php';?>
	</br> </br>
		
		<table border="0" width="780px" align="center">
			

		<tr>
			<td align='center'>Speciality:</td>
			<td hidden><input type="text"  name="SpecilityID" id="SpecilityID" value=<?php echo $SpecilityID; ?> ></td>
			<td><input type="text" class="input-block-level" name="SpecilityName" id="SpecilityName" required value='<?php echo $SpecilityName;?>'></td>
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
	
		<h2 align="center">specility List</h2>
	
	<table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >

		  <thead>
			<tr>		 
			  <th>speciality ID </th>
			  <th>speciality</th>
			  <th>Operation</th>
			  
			</tr>
		  </thead>
		  <tbody align="center">
		 
			<?php		
			$stmt = $user_home->runQuery("SELECT * FROM `specility`");
			$stmt->execute();
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){   
			$strsick = $row['SpecilityID']."|".$row['SpecilityName'];
			//echo $strsick;
			//javascript:FillData({$str});
            echo
				"<tr>
				  <td>{$row['SpecilityID']}</td>
				  <td>{$row['SpecilityName']}</td>              
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