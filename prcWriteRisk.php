<?php @session_start(); ?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php  include'jquery.php';?>
<?php  include'header.php';?>
<meta charset="utf-8"><script src="jquery/development-bundle/ui/jquery-ui.js"></script>

 

     

 
<?                       $check_dep=$_SESSION[user_dep_id];
 			 $take_rec_time=date("H:i:s"); 
                         $take_date_conv=$_POST[take_date];
		 	 $hn=$_POST[hn]; 	 
			 $an=$_POST[an];		 
			 $take_date=explode("/",$take_date_conv);
			 $take_date_year=$take_date[2]-543;
			 $take_date="$take_date_year-$take_date[1]-$take_date[0]"; 
                         $take_hour=$_POST['take_hour'];
                         $take_minute=$_POST['take_minute'];
			 $take_time=$take_hour.":".$take_minute;		 
			 $take_place=$_POST[take_place];		 	
			 $take_dep=$_POST[take_dep];		 
			 $category=$_POST[category];		 
			 $subcategory=$_POST[subcategory];		 
			 $take_other=$_POST[take_other];		 
			 $level_risk=$_POST[level_risk];		 
			 $take_detail=$_POST[take_detail];		 
			 $take_user_rec=$_SESSION[user_id];	 
			 $take_rec_time=$take_rec_time;		 
			 $take_rec_date=date("Y-m-d");		
			 $take_first=$_POST[take_first];
                         $take_counsel=$_POST[take_counsel];
 include'connect.php';	

		$sql=mysql_query("select takerisk_id from takerisk where takerisk_id='$takerisk_id' order by takerisk_id desc limit 1");
		$result=mysql_fetch_assoc($sql);
		$takerisk_idFile=$result[takerisk_id];
		$takerisk_idFile2=$takerisk_idFile+1;

							/*
							function seotitle($raw){
										 $raw = preg_replace('#[^-ก-๙a-zA-Z0-9.]#u', '', $raw);
										 $raw =  preg_replace("/-+/i","-",$raw);
										 if(substr($raw,0,1) == '-')
											  $raw = substr($raw,1);
										 if(substr($game_url,-1) == '-')
											  $raw = substr($raw,0,-1);
										 return urlencode($raw);
									} 
							*/

						//===========Convert file name of upload 
							function removespecialchars($raw){
									 return preg_replace('#[^a-zA-Z0-9.-]#u', '', $raw);
								}
 							 
 
 	if(trim($_FILES["filUpload1"]["name"] != ""))
	{
		if(move_uploaded_file($_FILES["filUpload1"]["tmp_name"],"myfile/".removespecialchars(date("d-m-Y/")."1".$takerisk_idFile2.$_FILES["filUpload1"]["name"])))
		{
			$file1=date("d-m-Y/")."1".$takerisk_idFile2.$_FILES["filUpload1"]["name"];							 
			$take_file1=removespecialchars($file1);
 		}
	}
 	if(trim($_FILES["filUpload2"]["name"] != ""))
	{
		if(move_uploaded_file($_FILES["filUpload2"]["tmp_name"],"myfile/".removespecialchars(date("d-m-Y/")."2".$takerisk_idFile2.$_FILES["filUpload2"]["name"])))
		{
			$file2=date("d-m-Y/")."2".$takerisk_idFile2.$_FILES["filUpload2"]["name"];							 
			$take_file2=removespecialchars($file2);
 		}
	} 	
	if(trim($_FILES["filUpload3"]["name"]!= ""))
	{
		if(move_uploaded_file($_FILES["filUpload3"]["tmp_name"],"myfile/".removespecialchars(date("d-m-Y/")."3".$takerisk_idFile2.$_FILES["filUpload3"]["name"])))
		{
			$file3=date("d-m-Y/")."3".$takerisk_idFile2.$_FILES["filUpload3"]["name"];							 
			$take_file3=removespecialchars($file3);
 		}
	}	

if($_POST[method]=='update'){
		$takerisk_id=$_POST[takerisk_id];

 		$sqlUpdate=mysql_query("update takerisk   SET  take_first='$take_first', take_counsel='$take_counsel',hn='$hn',an='$an',take_date='$take_date',take_time='$take_time',take_time2='$take_time',
		level_risk='$level_risk',take_dep='$take_dep',category='$category',subcategory='$subcategory',take_place='$take_place',
		take_other='$take_other',take_detail='$take_detail' where  takerisk_id='$takerisk_id'");
							if($sqlUpdate==false){
											 echo "<p>";
											 echo "Update not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

							 echo "<a href='changeRisk.php' data-role='button' data-icon='back'>กลับ</a>";

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
										echo" <META HTTP-EQUIV='Refresh' CONTENT='1;URL=changeRisk.php'>";

								}		
		}else if($_GET[method]=='delete'){
					$takerisk_id= $_GET[takerisk_id];
				$sqlDelete=mysql_query("delete FROM  takerisk where  takerisk_id='$takerisk_id'");
							if($sqlDelete==false){
											 echo "<p>";
											 echo "Delete not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

							 echo "<a href='index.php' data-role='button' data-icon='back'>กลับ</a>";

								}else{ echo "<H3>ลบข้อมูลเรียบร้อย</H3>";
											 echo "<br />";
											 echo "<br />";
										echo" <META HTTP-EQUIV='Refresh' CONTENT='1;URL=index.php'>";

								}	
			
		}elseif($_GET[method]=='move_risk'){
                    $return_date=date("Y-m-d");
                    $return_user=$_SESSION['user_id'];
                    
		$takerisk_id= $_GET[takerisk_id];
		$sqlMove=mysql_query("update takerisk set move_status='Y', return_risk='Y', return_user='$return_user', return_date='$return_date'  where takerisk_id='$takerisk_id' ");
									if($sqlMove==false){
											 echo "<p>";
											 echo "Move not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

						 	 echo "<a href='listRiskInBox.php' data-role='button' data-icon='back'>กลับ</a>";
							}else{  
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>แจ้งย้ายความเสี่ยงเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=listRiskInBox.php'>";
							}
		}elseif($_GET[method]=='recycle'){
		$takerisk_id= $_GET[takerisk_id];
                $detail_recycle=$_GET[detail_recycle];
		$sqlMove=mysql_query("update takerisk set recycle='Y', detail_recycle='$detail_recycle' where takerisk_id='$takerisk_id' ");
									if($sqlMove==false){
											 echo "<p>";
											 echo "Move not complete".mysql_error();
											 echo "<br />";
											 echo "<br />";

						 	 echo "<a href='changeRisk.php' data-role='button' data-icon='back'>กลับ</a>";
							}else{  
								    echo	 "<p>&nbsp;</p>	";
								    echo	 "<p>&nbsp;</p>	";
									echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
										echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>ย้ายความเสี่ยงลงถังขยะเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=changeRisk.php'>";
							}
		}elseif($_POST[method]=='change_risk'){
	 
		$takerisk_id= $_POST[takerisk_id];
		$take_dep= $_POST[take_dep];
		$level_risk= $_POST[level_risk];
		$pct= $_POST[pct];
		$ic= $_POST[ic];
                $rca=$_POST[rca];
                $receiver=$_SESSION['user_id'];
                $receive_date=date('Y-m-d');
		 
		$sqlMove=mysql_query("update takerisk set move_status='N' ,res_dep='$take_dep' ,level_risk='$level_risk' ,pct='$pct' ,ic='$ic' , rca='$rca', receiver='$receiver',receive_date='$receive_date'   where takerisk_id='$takerisk_id'");
									if($sqlMove==false){
											 echo "<p>";
											 echo "Move not complete".mysql_error();
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
								               <a class='alert-link' target='_blank' href='#'><center>ย้ายความเสี่ยงไปยังหน่วยงานที่เกี่ยวข้องเรียบร้อย</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=changeRisk.php'>";
							}					
		}else{
		$user_id=$_SESSION[user_id];
		$sqlInsert=mysql_query("insert into takerisk   SET  take_first='$take_first', take_counsel='$take_counsel', hn='$hn',an='$an',take_date='$take_date',take_time='$take_time',take_time2='$take_time',
		level_risk='$level_risk',take_dep='$check_dep',res_dep='$take_dep',category='$category',subcategory='$subcategory',take_place='$take_place',
		take_other='$take_other',take_detail='$take_detail',take_rec_date='$take_rec_date',
		take_rec_time='$take_rec_time',take_file1='$take_file1',take_file2='$take_file2',take_file3='$take_file3',user_id='$user_id' ,move_status='Y' ");
		

		$sql=mysql_query("select takerisk_id from takerisk order by takerisk_id desc limit 1");
		$result=mysql_fetch_assoc($sql);
		$takerisk_id=$result[takerisk_id];
		$sqlInsertMngRisk=mysql_query("insert into mngrisk   SET takerisk_id='$takerisk_id' ");
							if($sqlInsert==false){
											 echo "<p>";
											 echo "Insert not complete".mysql_error();
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
								               <a class='alert-link' target='_blank' href='#'><center>บันทึกข้อมูลความเสี่ยงเรียบร้อย ขอขอบคุณครับ</center></a> 
								            </div>";								
							 		 	 echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=index.php'>";

								}
	 }//-------------end process insert update delete
?>	<?php	  mysql_close($con); ?>
	
	
	
	
	
	
 
