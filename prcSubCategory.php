<?php @session_start(); ?>
<?php  if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php  include'jquery.php';?>
<?php  include'header.php';?>
<meta charset="utf-8"> 
<?PHP include'connect.php';?>
<?PHP
 echo "<br><br><br><br>";
 	 $category=$_POST[category];	 	
     $sub_name=$_POST[sub_name];	 	  	 
    
 	  
	if($_POST[method]=='update'){
		$subcategory=$_POST[subcategory];	 
		$sqlUpdate=mysql_query("update subcategory  SET name='$sub_name' ,category='$category'
		where subcategory='$subcategory' "); 	
 
	
 							if($sqlUpdate==false){
											 echo "<p>";
											 echo "Update not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

											 echo "	<span class='glyphicon glyphicon-remove'></span>";
											 echo "<a href='frmSubCategory.php' >กลับ</a>";
		
								}else{
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>แก้ไขข้อมูลเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=frmSubCategory.php'>";
								}
   
   }//-----------------------------------------end update
   else if($method=='delete'){	 	 
   $subcategory=$_GET[subcategory];	 	  
		$sqlDelete=mysql_query("delete from subcategory  
		where subcategory='$subcategory' "); 
				
 							if($sqlDelete==false){
											 echo "<p>";
											 echo "Delete not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

											 echo "	<span class='glyphicon glyphicon-remove'></span>";
											 echo "<a href='frmSubCategory.php' >กลับ</a>";
		
								}else{
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>ลบข้อมูลเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=frmSubCategory.php'>";
								}
 				 
   }//-----------------------------------------end delete
   else{
 	 	$sqlInsert=mysql_query("insert into  subcategory  SET name='$sub_name' ,category='$category' "); 
 
 							if($sqlInsert==false){
											 echo "<p>";
											 echo "Insert not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

											 echo "	<span class='glyphicon glyphicon-remove'></span>";
											 echo "<a href='frmSubCategory.php' >กลับ</a>";
		
								}else{
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>เพิ่มข้อมูลเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=frmSubCategory.php'>";
								}  	
   }
 
?>	
	
	
<?php	   //mysql_close($con); ?>
 
	
	
 