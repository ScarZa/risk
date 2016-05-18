<?php include 'header.php';?>
<?php include 'connect.php';?><br>
<?php
$admin_check=$_POST['check'];
$takerisk_id=$_POST['takerisk_id'];

$sql_check="update mngrisk set admin_check='$admin_check' where takerisk_id='$takerisk_id' ";
$sql_query=  mysql_query($sql_check)or die(mysql_error());
echo "<meta http-equiv='refresh' content='2;URL=listRiskInBox3.php' />";	


?>
