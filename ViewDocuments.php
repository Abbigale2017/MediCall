<?php

$allDocs = $_SESSION['AllDOC'];
if ($allDocs ==1) {
	$readOnly = 1;
} else $readOnly =  $_SESSION['readOnly'];
?>
 <table border="0" width="780px" cellpadding="0" cellspacing="0" align="center" >
	<tr> <td>Attached Documents </td>
	<td width = "40"> </td>	
	<td ><input type="button" align='left' <?php if ($readOnly == 1) echo "disabled" ?> name="Upload" value="Upload" onClick="window.open('upload.php','Upload files','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=720,height=260'); return false;"></a> </td>
	<td width = "40"> </td>
	<td><a href=''><input type="button" align='right' <?php if ($readOnly == 1) echo "disabled" ?> Value="Refresh"></a></td>
	</tr>
</table>
	  <table border="1" width="780px" cellpadding="0" cellspacing="0" align="center" >
      <thead> 	         
        <tr>
          <th align='left'>File </th>
		  <th align='left'>Uploaded Date</th>
        </tr>				
      </thead>	
        <?php		
		$stmt = $user_home->getDocuments($allDocs);
          while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ){	
			$endocID = base64_encode($row['DocID']);
			//echo $endocID;
            echo
            "<tr>
              <td><a href='displayfile.php?docid={$endocID}' > {$row['FilePath']} </a></td>
              <td>{$row['CreateDate']}</td>
			</tr>\n";
          }
	  ?>
	</table>
	  
