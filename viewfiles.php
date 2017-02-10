<?php
	$userID = $_SESSION['userID'];
	$caseID = $_SESSION['caseID'];
	$readOnly =  $_SESSION['readOnly'];
	if ($caseID != 0) $userDir = $_SESSION['userDir'] . "\\" . $caseID;
	else  $userDir= $_SESSION['userDir'];

?>

<! doctype html>
<html>
<head>
   <meta charset="UTF-8">
   <link rel="shortcut icon" href="./.favicon.ico">
   <title>Attached Documents</title>
   
   <link rel="stylesheet" href="./.style.css">
   <script src="./.sorttable.js"></script>
</head>
<body> 

<form bgcolor="cyan" >
<div width="780px" class="hero-unit">
<table border="0" width="780px" cellpadding="0" cellspacing="0" align="center">
<div bgcolor="cyan" font_color="black" id="container">
	<tr> <td>Attached Documents </td>
	<td width = "40"> </td>	
	<td ><input type="button" align='left' <?php if ($readOnly == 1) echo "disabled" ?> name="Upload" value="Upload" onClick="window.open('upload.php','Upload files','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=720,height=260'); return false;"></a> </td>
	<td width = "40"> </td>
	<td><a href=''><input type="button" align='right' <?php if ($readOnly == 1) echo "disabled" ?> Value="Refresh"></a></td>
	</tr>
	<table class="sortable">
	    <thead>
		<tr>
			<th>Filename</th>
			<th>Type</th>
			<th>Size</th>
			<th>Date Uploaded</th>
		</tr>
	    </thead>
	    <tbody><?php

	// Adds pretty filesizes
	function pretty_filesize($file) {
		$size=filesize($file);
		if($size<1024){$size=$size." Bytes";}
		elseif(($size<1048576)&&($size>1023)){$size=round($size/1024, 1)." KB";}
		elseif(($size<1073741824)&&($size>1048575)){$size=round($size/1048576, 1)." MB";}
		else{$size=round($size/1073741824, 1)." GB";}
		return $size;
	}

 	// Checks to see if veiwing hidden files is enabled
	if($_SERVER['QUERY_STRING']=="hidden")
	{$hide="";
	 $ahref="./";
	 $atext="Hide";}
	else
	{$hide=".";
	 $ahref="./?hidden";
	 $atext="Show";}
	chdir($userDir);
	 // Opens directory
	 $myDirectory=opendir(".");

	// Gets each entry
	while($entryName=readdir($myDirectory)) {
	   $dirArray[]=$entryName;
	}

	// Closes directory
	closedir($myDirectory);

	// Counts elements in array
	$indexCount=count($dirArray);

	// Sorts files
	sort($dirArray);

	// Loops through the array of files
	for($index=0; $index < $indexCount; $index++) {

	// Decides if hidden files should be displayed, based on query above.
	    if(substr("$dirArray[$index]", 0, 1)!=$hide) {

	// Resets Variables
		$favicon="";
		$class="file";

	// Gets File Names
		$name=$dirArray[$index];
		$namehref=$userDir . "\\" . $dirArray[$index];

	// Gets Date Modified
		$modtime=date("M j Y g:i A", filemtime($dirArray[$index]));
		$timekey=date("YmdHis", filemtime($dirArray[$index]));


	// Separates directories, and performs operations on those directories
		if(is_dir($dirArray[$index]))
		{	//continue;
				$extn="&lt;Directory&gt;";
				$size="&lt;Directory&gt;";
				$sizekey="0";
				$class="dir";

			// Gets favicon.ico, and displays it, only if it exists.
				if(file_exists("$namehref/favicon.ico"))
					{
						$favicon=" style='background-image:url($namehref/favicon.ico);'";
						$extn="&lt;Website&gt;";
					}

			// Cleans up . and .. directories
				if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;"; $favicon=" style='background-image:url($namehref/.favicon.ico);'";}
				if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
		}

	// File-only operations
		else{
			$namehref = "displayfile.php?file=".base64_encode($namehref);
			// Gets file extension
			$extn=pathinfo($dirArray[$index], PATHINFO_EXTENSION);

			// Prettifies file type
			switch ($extn){
				case "png": $extn="PNG Image"; break;
				case "jpg": $extn="JPEG Image"; break;
				case "jpeg": $extn="JPEG Image"; break;
				case "svg": $extn="SVG Image"; break;
				case "gif": $extn="GIF Image"; break;
				case "ico": $extn="Windows Icon"; break;

				case "txt": $extn="Text File"; break;
				case "log": $extn="Log File"; break;
				case "htm": $extn="HTML File"; break;
				case "html": $extn="HTML File"; break;
				case "xhtml": $extn="HTML File"; break;
				case "shtml": $extn="HTML File"; break;
				case "php": $extn="PHP Script"; break;
				case "js": $extn="Javascript File"; break;
				case "css": $extn="Stylesheet"; break;

				case "pdf": $extn="PDF Document"; break;
				case "xls": $extn="Spreadsheet"; break;
				case "xlsx": $extn="Spreadsheet"; break;
				case "doc": $extn="Microsoft Word Document"; break;
				case "docx": $extn="Microsoft Word Document"; break;

				case "zip": $extn="ZIP Archive"; break;
				case "htaccess": $extn="Apache Config File"; break;
				case "exe": $extn="Windows Executable"; break;

				default: if($extn!=""){$extn=strtoupper($extn)." File";} else{$extn="Unknown";} break;
			}

			// Gets and cleans up file size
				$size=pretty_filesize($dirArray[$index]);
				$sizekey=filesize($dirArray[$index]);
		}
		
		$filehref = base64_encode($namehref);
		
	// Output
	 echo("
		<tr class='$class'>
			<td><a href='./$namehref' $favicon class='name'>$name</a></td>
			<td><a href=displayfile.php?file='$filehref target='_blank'>$extn</a></td>
			<td sorttable_customkey='$sizekey'><a href=displayfile.php?file=$filehref target='_blank'>$size</a></td>
			<td sorttable_customkey='$timekey'><a href=displayfile.php?file=$filehref target='_blank'>$modtime</a></td>		
		</tr>");
	   }
	}
	?>

	    </tbody>
	</table>
</div>
</table>
</div>
</form>
</body>
</html>
