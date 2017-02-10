<?php
$caseid = $_SESSION['caseID'];
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
<div> 
        <ul>
        	<div align="center">
				<?php 
					if ($_SESSION['userType'] == ADMIN ) { ?>					
					<a class=submenu href='admincountry.php'>Countries</a>
					<a class=submenu href='adminsickness.php'>Sickness</a>
					<a class=submenu href='adminlanguage.php'>Languages</a>
					<a class=submenu href='adminspeciality.php'>Specility</a>
				
					
				<?php } 
				 ?>					
      	    </div>
        </ul>         
</div>