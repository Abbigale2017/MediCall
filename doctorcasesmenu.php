<?php
require_once 'home.php';
?>

<style type="text/css">
<!--
.submenu {
    background-color: #c4e3f3 ;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 24px;
}
.submenu :hover {
    background-color: #FF0000;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    font-size: 24px;
}
-->
        </style>
<?php
		$stmt = $cases_home->getCountUrgentCasesDoctor();
?>
<div> 
        <ul>
        	<div align="center">				
        	    <a class=submenu href="cases.php">Open Cases</a>
				<a class=submenu href="urgentcases.php">Urgent Cases (<?php echo $stmt; ?>) </a> 
			</div>
        </ul>         
</div>