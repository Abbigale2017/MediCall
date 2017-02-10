<?php
require_once 'home.php';

$type = $_GET['type'] ;
$caseID = $_SESSION['caseID'];
if ($type == 'success') $cnt = $cases_home->activateCase();
if ($type == 'cancel') $cnt = $cases_home->deleteCase();
?>