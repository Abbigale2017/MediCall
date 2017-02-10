<?php 
require_once 'home.php';

//$id = base64_decode($_GET['id']);
//$key = base64_encode($id);
//$caseID = base64_decode($_GET['caseid']);

//echo $caseID;
$stmt = $cases_home->closeCase(); 
$user_home->redirect('feedback.php');
?>