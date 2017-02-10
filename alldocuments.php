<?php
include 'home.php';
$_SESSION['AllDOC'] = 1;
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
<body style='padding: 80px 20px' bgcolor="cyan" font_color="black">
<Form>
<div width="780px" class="hero-unit">	   
<?php include 'membersubmenu.php'; ?>
<h3 align="center" >All Uploaded Documents</h3>

<?php include 'viewdocuments.php'; ?>		
  
</div>
</Form>
</body>
</html>