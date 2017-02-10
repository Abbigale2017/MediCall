
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
	var sickid = elm.id.substr(0,i);
	var j = elm.id.lastIndexOf("|");
	var specilities = elm.id.substr(i+1,j-i-1);
	var sickness = elm.id.substr(j+1);
	
	document.getElementById("sickid").value = sickid;	
	document.getElementById("specilityval").value = specilities;
	document.getElementById("sickness").value = sickness;			
};

</script>        
</head>
<body style='padding: 80px 20px'>

<?php
	$specialityVal = $_POST['specilityval'];
	$sickness = $_POST['sickness'];
	$sickid = $_POST['sickid'];
	if (isset($_POST['add'])) {			  		 
		$speciality=implode(",",$_POST['speciality']);
		$sickness=$_POST['sickness'];
		$sql="INSERT INTO `sicknesslist` (`Specilities`, `Sickness`) VALUES ('$speciality', '$sickness')";		  
		  $stmt = $user_home->runQuery($sql);
		  $stmt->execute();	    
	} else if (isset($_POST['update'])) {
		$speciality=implode(",",$_POST['speciality']);
		$sickness=$_POST['sickness'];
		$sickid = $_POST['sickid'];
			$sql="UPDATE `sicknesslist` SET `Specilities`='$speciality',`Sickness`='$sickness' WHERE `SickID` = '$sickid'";
			$stmt = $user_home->runQuery($sql);
			$stmt->execute();				
	} else if (isset($_POST['delete'])){		
		  $sql="DELETE FROM `sicknesslist` WHERE `SickID` = '$sickid'";		  
		  $stmt = $user_home->runQuery($sql);
		  $stmt->execute();		
	}	 
	
?>

	
<form  name="sickness" action="adminsickness.php" method="post">	
<div class="hero-unit">

<?php include 'reference.php';?>
	</br> </br>
	<table border="0" width="780px" align="center">
		
		<tr>
			<td align='left'>Speciality:</td>
			<td><select name="speciality[]" class="input-block-level" size="3" multiple="multiple" >
			<?php 
				$stm = $user_home->runQuery("SELECT * FROM `specility` WHERE Status=:status");
				$stm->execute(array(":status"=>1));
				while($row1 = $stm->fetch(PDO::FETCH_ASSOC))
				{
			  ?>		
					<option value=<?php echo $row1['SpecilityID'];?> <?php if(strstr($specialityVal,$row1['SpecilityID'])) echo "selected";?> ><?php echo $row1["SpecilityName"]; ?></option>							
			<?php } ?>
				
			</select> </td>	
		</tr>			
		<tr>
			<td align='left'>Sickness:</td>
			<td hidden><input type="text"  name="specilityval" id="specilityval" value=<?php echo $specialityVal; ?> ></td>
			<td hidden><input type="text"  name="sickid" id="sickid" value=<?php echo $sickid; ?> ></td>
			<td><input type="textarea" class="input-block-level" name="sickness" id="sickness" value='<?php echo $sickness; ?>'></td>
		</tr>
		
		<tr>			
			
			<td align='center'><input type="submit" name="add" class="btn btn-primary" value="Add"></td>
			<td align='center'><input type="submit" name="update" class="btn btn-primary" value="Update"></td>
			<td align='center'><input type="submit" name="delete" class="btn btn-primary" value="Delete"></td>
		</tr>
	</table>

	<h3 align="center"> Sickness List</h3>

	<table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >

      <thead>
        <tr>		 
          <th>Sick ID</th>
          <th>Specility</th>
		  <th>Sickness</th>
		  <th>Select</th>
        </tr>
      </thead>
      <tbody align="center">
	 
        <?php		
		   $stmt = $user_home->runQuery("SELECT * FROM `sicknesslist`");
		  $stmt->execute();
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){   
		  $strsick = $row['SickID']."|".$row['Specilities']."|".$row['Sickness'];
			//echo $strsick;  value={$strsick}
			//javascript:FillData({$str});
            echo
            "<tr>
              <td>{$row['SickID']}</td>
              <td>{$row['Specilities']}</td>
              <td>{$row['Sickness']}</td>              
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