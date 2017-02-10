<?php
session_start();
require_once 'class.user.php';

$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}
	if (($_SESSION['userType'] == DOCTOR) && ($_SESSION['oId'] != 0)) $userID = $_SESSION['oId'];
	else $userID = $_SESSION['userID'];
		
	$caseID = $_SESSION['caseID'];
	if ($caseID != 0) $userDir = $_SESSION['userDir'] . "\\" . $caseID;
	else  $userDir= $_SESSION['userDir'];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $row['userEmail']; ?></title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>		
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<?php

if (isset($_POST["submit"])) {
	$target_dir =$userDir . "\\";
	$basefile = basename($_FILES["fileToUpload"]["name"]);
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . "." . "\n";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 4000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. \n";
					
			$stmt = $user_home->runQuery("INSERT INTO `doctab`(`UserID`, `CaseID`, `CreateDate`, `FilePath`)  
															 VALUES(:user_id,:case_id, now(), :uploadfile)");
			$stmt->bindparam(":user_id",$userID);
			$stmt->bindparam(":case_id",$caseID);
			//$stmt->bindparam(":uploadfile",$target_file);
			$stmt->bindparam(":uploadfile",$basefile);
			$stmt->execute();
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>

 <form action="upload.php" method="post" enctype="multipart/form-data">
<h4>Select image to upload:</h4>
<table border="1" width="600px" cellpadding="0" cellspacing="0" align="center">
<tr> <td> </td> </tr>
<tr>
    <td><input type="file" name="fileToUpload" id="fileToUpload" ></td>
    <td><input type="submit" class="input-block-level" name="submit" class="btn btn-primary" value="Upload Image" ></td>
</tr>
<tr> <td> </td> </tr>
</table>
</form> 
</body>
</html>
