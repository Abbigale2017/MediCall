<?php 
require_once 'home.php';

$caseid = base64_decode($_GET['caseID']);

//echo $caseID;
$stmt = $cases_home->assignUrgentCase($caseid); 
$user_home->redirect('cases.php');
?>