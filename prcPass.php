<?php @session_start(); ?>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>ระบบบริหารความเสี่ยงโรงพยาบาล</title>
        <LINK REL="SHORTCUT ICON" HREF="./images/logo.png">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
        <link href="css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <!-- Page Specific CSS -->
        <link rel="stylesheet" href="css/morris-0.4.3.min.css">
        <link rel="stylesheet" href="css/stylelist.css">
        <script src="js/jquery-2.1.4.min.js"></script>
        <meta charset="utf-8"><script src="jquery/development-bundle/ui/jquery-ui.js"></script>
<script language="JavaScript" type="text/javascript"> 
var StayAlive = 1; // เวลาเป็นวินาทีที่ต้องการให้ WIndows เปิดออก 
function KillMe()
{ 
setTimeout("self.close()",StayAlive * 1000); 
} 
</script>
</head>

<body onLoad="KillMe();self.focus();window.opener.location.reload();">
    
 <?php
 
     if($_REQUEST['method']=='pass_risk'){
	 
		$takerisk_id= $_POST['takerisk_id'];
                $res_dep=$_POST['res_dep'];
                
                    $pass_risk=  mysql_query("update takerisk set res_dep='$res_dep' where takerisk_id='$takerisk_id'");
                    if($pass_risk==false){
											 echo "<p>";
											 echo "Pass not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

						 	 echo "<a href='index.php' data-role='button' data-icon='back'>กลับ</a>";
							}else{  
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>ส่งต่อความเสี่ยงไปยังหน่วยงานที่เกี่ยวข้องเรียบร้อย</center></a> 
								            </div>";
                
                }
    }
    
mysql_close($con); ?>


    </div><!-- /#wrapper -->
     
    <!-- Bootstrap core JavaScript -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
 	<script type="text/javascript" src="DatePicker/js/jquery-1.4.4.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <!-- Page Specific Plugins -->
    <script src="js/raphael-min.js"></script>
    <script src="js/morris-0.4.3.min.js"></script>
    <script src="js/morris/chart-data-morris.js"></script>
    <script src="js/tablesorter/jquery.tablesorter.js"></script>
    <script src="js/tablesorter/tables.js"></script>
  </body>
</html>