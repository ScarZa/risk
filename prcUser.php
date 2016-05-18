<?php @session_start(); ?>
<?php  if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php   include'jquery.php';?>
<?php   include'header.php';?>
<meta charset="utf-8"> 
<?PHP include'connect.php';?>
<?PHP
 echo "<br><br><br><br>";
 
      $user_fname=$_POST[user_fname];	 	  	 
      $user_lname=$_POST[user_lname];	
      $dep_id=$_POST[dep_id];
      $sql_mdep=  mysql_query("select d1.main_dep from department_group d1 inner join department d2 on d2.main_dep=d1.main_dep where dep_id='$dep_id'");
      $mdep=  mysql_fetch_assoc($sql_mdep);
      $main_dep=$mdep[main_dep];
      $admin=$_POST[admin];
      $user_name=trim($_POST[user_account]);
      $user_account=md5(trim($_POST[user_account]));	 
      $user_pwd=md5(trim($_POST[user_pwd]));
 	 

 	  
	if($_POST[method]=='update'){
	$user_idPOST=$_POST[user_id];	
 
		if($_POST[user_pwd]!=''){
 		$sqlUpdate=mysql_query("update user  SET  user_fname='$user_fname' , user_name='$user_name', 
 		user_lname='$user_lname' , dep_id='$dep_id' , main_dep='$main_dep', admin='$admin'  , 	user_account='$user_account' , user_pwd='$user_pwd'  
		where user_id='$user_idPOST' "); 
		}else{ 
		$sqlUpdate=mysql_query("update user  SET user_fname='$user_fname' , user_name='$user_name', 
 		user_lname='$user_lname' , dep_id='$dep_id' , main_dep='$main_dep' , admin='$admin'  , 	user_account='$user_account'   
		where user_id='$user_idPOST' "); 	
		}
	
 							if($sqlUpdate==false){
											 echo "<p>";
											 echo "Update not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

											 echo "	<span class='glyphicon glyphicon-remove'></span>";
											 echo "<a href='frmUser.php' >กลับ</a>";
		
								}else{
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
									echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>แก้ไขข้อมูลผู้ใช้งานเรียบร้อย</center></a> 
								            </div>";					
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=frmUser.php'>";
								}
   
   }//-----------------------------------------end update
   else if($_REQUEST['method']=='delete'){	 	 
   $user_idGet=$_GET[user_id];	 	  
		$sqlDelete=mysql_query("delete from user  
		where user_id='$user_idGet' "); 
				
 							if($sqlDelete==false){
											 echo "<p>";
											 echo "Delete not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

											 echo "	<span class='glyphicon glyphicon-remove'></span>";
											 echo "<a href='frmUser.php' >กลับ</a>";
		
								}else{
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
									echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>ลบผู้ใช้งานเรียบร้อย</center></a> 
								            </div>";								
							 		 	echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=frmUser.php'>";
								}
 				 
   }//-----------------------------------------end delete
   else{
 	 	$sqlInsert=mysql_query("insert into user  SET    user_fname='$user_fname' , user_name='$user_name', 
 		user_lname='$user_lname' , dep_id='$dep_id' ,main_dep='$main_dep' , admin='$admin'  , 	user_account='$user_account' , user_pwd='$user_pwd'  "); 

	
 							if($sqlInsert==false){
											 echo "<p>";
											 echo "Insert not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

											 echo "	<span class='glyphicon glyphicon-remove'></span>";
											 echo "<a href='frmUser.php' >กลับ</a>";
		
								}else{
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>เพิ่มผู้ใช้งานเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=frmUser.php'>";
								}  	
   }
?>		
<?php	  mysql_close($con); ?>
 
	
	
 