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
</head>
<?php
$takerisk_id=$_GET[takerisk_id];
            $sqlEdit=mysql_query("select * from takerisk 
                                    where takerisk_id='$takerisk_id'");
            $resultEdit=mysql_fetch_assoc($sqlEdit);
            ?>
    <body>

     
    <div class="col-lg-12">
              <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">ส่งต่อความเสี่ยง</h3>
                    </div>
                  <div class="panel-body">
                      <form class="navbar-form navbar-right" role="form" action='prcPass.php' enctype="multipart/form-data" method='post'>                      
                      <div class="form-group">
  			<label>หน่วยงานที่เกี่ยวข้องที่ต้องการส่งต่อ</label>
  			<select name="res_dep" id="combobox2"  class="form-control"> 
			<?php	$sql = mysql_query("SELECT *  FROM department where  main_dep='$_SESSION[user_main_dep]' ");
				echo "<option value=''></option>";
				while( $result = mysql_fetch_array( $sql ) ){
          if($result[dep_id]==$resultEdit[res_dep]){$selected='selected';}else{$selected='';}
				echo "<option value='$result[dep_id]' $selected>$result[name] </option>";
			} ?>
			</select>	
             <!--   <p class="form-control-static">email@example.com</p> -->
            </div>
                      <input type="hidden" name="takerisk_id" value="<?=$takerisk_id?>">
                      <input type="hidden" name="method" value="pass_risk" >
                      <button type="submit" class="btn btn-warning">ส่งต่อ  </button>
                      </form>
                  </div>
              </div>
    </div>
    

        
    <?php mysql_close($con); ?>


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
