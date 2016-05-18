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
        <script src="js/excellentexport.js"></script>
</head>

    <body>
<?php
$dir = "backupDB/"; // Directory name
if (is_dir($dir)) {
	if ($dh = opendir($dir)) {
		$i = 0;
		while (($getfile = readdir($dh)) !== false) {
			$file[$i] = $getfile;
			$i++;
		}
		closedir($dh);
	}
	$filenum = count($file);
        sort($file);
}
?>
<div class="row">
    <div class="col-lg-12">
              <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">สำรองฐานข้อมูล</h3>
                    </div>
                  <div class="panel-body">
<?php
   for ($i=0; $i<$filenum; $i++){
    if(($file[$i]==".")||($file[$i]=="..")){ continue;  }
	echo "<a href=\"".$dir.$file[$i]."\" target='_blank'>".$file[$i]."</a><br />";
}
?>
                    </div></div></div></div>
<?php                        
include 'footer.php';
?>