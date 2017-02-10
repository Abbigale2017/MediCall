<?php
include "home.php";
$caseID = $_SESSION['caseID'];
?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title><?php echo $row['userEmail']; ?></title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
    </head>
<body bgcolor="cyan" font_color="black">

<Form style='padding: 30px 20px'>
<div width="780px" class="hero-unit">
<?php if ($caseID == 0 ) include 'membersubmenu.php';

else include 'casedetailmenu.php'?>
<h1 align='center'> View Attachments</h1>
<?php include 'viewfiles.php';?>
</div>
</Form>
</body>
</html>