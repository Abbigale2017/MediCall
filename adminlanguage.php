
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
			var langid = elm.id.substr(0,i);
			//var j = elm.value.lastIndexOf("|");
			//var specilities = elm.value.substr(i+1,j-i-1);
			var Lang = elm.id.substr(i+1);
	
		document.getElementById("langid").value = langid;	
		//document.getElementById("specilityval").value = specilities;
		document.getElementById("Lang").value = Lang;			
};

</script> 		
	        
	</head>
	<body >

	<?php
	
	$Lang = $_POST['Lang'];
	$langid = $_POST['langid'];
		//$country = null;
		if (isset($_POST['add'])) {	
			$Lang = $_POST['Lang'];
            //$sickness=$_POST['sickness'];			
			//$speciality=implode(",",$_POST['speciality']);
			
			$sql="INSERT INTO `Languages` (`Lang`) VALUES ('$Lang')";		  
			  $stmt = $user_home->runQuery($sql);
			  $stmt->execute();	    
		}  
		else if (isset($_POST['delete'])){		
			  $sql="DELETE FROM `Languages` WHERE `LangID` = '$langid'";		  
			  $stmt = $user_home->runQuery($sql);
			  $stmt->execute();		
		}
		else if (isset($_POST['update'])) {
		//$speciality=implode(",",$_POST['speciality']);
		$Lang=$_POST['Lang'];
		$langid = $_POST['langid'];
			//$sql1="DELETE FROM `Languages` WHERE `LangID` = '$langid'";
			$sql="UPDATE `Languages` SET `Lang`='$Lang' WHERE `LangID` = '$langid'";
			$stmt = $user_home->runQuery($sql);
			$stmt->execute();
			//$stmt1 = $user_home->runQuery($sql1);
			//$stmt1->execute();			
		}		
		
	?>
	

<form  name="language" action="adminlanguage.php" method="post">	
<div class="hero-unit">
	

	<?php include 'reference.php';?>
	</br> </br>
		
		<table border="0" width="780px" align="center">
			

		<tr>
			<td align='center'>Language:</td>
			<td hidden><input type="text"  name="langid" id="langid" value=<?php echo $langid; ?> ></td>
			<td><input type="text" pattern="[a-zA-Z]+" class="input-block-level" name="Lang" id="Lang" value=<?php echo $Lang; required?>></td>
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
	
		<h2 align="center"> Languages List</h2>
	
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
			$stmt = $user_home->runQuery("SELECT * FROM `languages`");
			$stmt->execute();
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){   
			$strsick = $row['LangID']."|".$row['Lang'];
			//echo $strsick;
			//javascript:FillData({$str});
            echo
				"<tr>
				  <td>{$row['LangID']}</td>
				  <td>{$row['Lang']}</td>              
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