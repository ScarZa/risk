<?php  session_start(); ?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php include 'header.php';?>
		<?php 
		 	$user_id = $_SESSION[user_id];
         	$sqlUser = mysql_query("select admin from user where user_id='$user_id' ");
         	$resultUser=mysql_fetch_assoc($sqlUser);    
            if($resultUser[admin]=='Y'){
            echo "<h2>คณะกรรมการบริหารความเสี่ยง</h2>"; 	
            }else{
            echo "<h2>รายงานสำหรับหน่วยงาน</h2>";  	
            }         
         ?>
 <H1><small>รายงานแสดงภาพรวมของความเสี่ยงทั้งหมด</small></H1>
<SCRIPT language=JavaScript>
var OldColor;
function popNewWin (strDest,strWidth,strHeight) {
newWin = window.open(strDest,"popup","toolbar=no,scrollbars=yes,resizable=yes,width=" + strWidth + ",height=" + strHeight);
}
function mOvr(src,clrOver) {
if (!src.contains(event.fromElement)) {
src.style.cursor = 'hand';
OldColor = src.bgColor;
src.bgColor = clrOver;
}
}
function mOut(src) {
if (!src.contains(event.toElement)) {
src.style.cursor = 'default';
src.bgColor = OldColor;
}
}
function mClk(src) {
if(event.srcElement.tagName=='TD') {
src.children.tags('A')[0].click();
}
}
 </SCRIPT>
    <script>
  $(function() {
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>
 
							<h2>ทบทวนความเสี่ยง</h2>
						<!--   <H1>หมายเหตุ รายการที่มีเครื่องหมายดอกจันทร์  (***) จำเป็นต้องระบุให้ครบ</H1> -->
 						

<!------------------------------------------------------------------>

<?php   
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
	global $e_page;
	global $querystr;
	$urlfile="main_report5.php"; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
	$per_page=10;
	$num_per_page=floor($chk_page/$per_page);
	$total_end_p=($num_per_page+1)*$per_page;
	$total_start_p=$total_end_p-$per_page;
	$pPrev=$chk_page-1;
	$pPrev=($pPrev>=0)?$pPrev:0;
	$pNext=$chk_page+1;
	$pNext=($pNext>=$total_p)?$total_p-1:$pNext;		
	$lt_page=$total_p-4;
	if($chk_page>0){  
		echo "<a  href='$urlfile?s_page=$pPrev".$querystr."' class='naviPN'>Prev</a>";
	}
	for($i=$total_start_p;$i<$total_end_p;$i++){  
		$nClass=($chk_page==$i)?"class='selectPage'":"";
		if($e_page*$i<=$total){
		echo "<a href='$urlfile?s_page=$i".$querystr."' $nClass  >".intval($i+1)."</a> ";   
		}
	}		
	if($chk_page<$total_p-1){
		echo "<a href='$urlfile?s_page=$pNext".$querystr."'  class='naviPN'>Next</a>";
	}
}   
?>
<?php
 	mysql_query($q);	
	?>
 <?php
//////////////////////////////////////// เริ่มต้น ส่วนเนื้อหาที่จะนำไปใช้ในไฟล์ ที่เรียกใช้ด้วย ajax
?>

<?php
$mng_status=$_SESSION[Rmng_status];
$take_date1=$_SESSION[Rtake_date1];
$take_date2=$_SESSION[Rtake_date2];
$level_risk=$_SESSION[Rlevel_risk];
$take_dep=$_SESSION[Rtake_dep];
$category=$_SESSION[Rcategory];
$subcategory=$_SESSION[Rsubcategory];
 
	        $take_date1=$take_date1;
	        $take_date2=$take_date2;

			
			$sql=mysql_query("select * from department where dep_id='$take_dep'");
			$res=mysql_fetch_assoc($sql);

			$sql=mysql_query("select * from category where category='$category'");
			$resCate=mysql_fetch_assoc($sql);

			$sql=mysql_query("select * from subcategory where subcategory='$subcategory'");
			$resSubCate=mysql_fetch_assoc($sql);
       									include_once ('funcDateThai.php');
								$take_rec_date= "$result[take_rec_date]";
								DateThai1($take_date1); //-----แปลงวันที่เป็นภาษาไทย
								DateThai2($take_date2); //-----แปลงวันที่เป็นภาษาไทย
								
if($take_date1!='' and $mng_status==''){  
	echo "<B>หมวด :</B> $resCate[name]&nbsp;&nbsp;&nbsp;&nbsp; <BR><BR><b>เรื่อง :</b> $resSubCate[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR><b>ระดับความรุนแรง :</b> $level_risk<br /><br />";
 	echo "<b>หน่วยงาน :</b> $res[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR>";
 	echo "<b>ตั้งแต่วันที่</b> ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<b>ถึงวันที่</b> ".DateThai2($take_date2);
	echo "<p>&nbsp;</p>";
	$q="select t1.move_status,t1.take_rec_date,t1.takerisk_id,t1.take_date,d1.name as dep_name,c1.name as cate_name,s1.name as subct_name,t1.level_risk,m1.mng_status,t1.takerisk_id,t1.take_detail
		from takerisk t1 
		LEFT OUTER JOIN mngrisk m1 on m1.takerisk_id = t1.takerisk_id
		LEFT OUTER JOIN department d1 on d1.dep_id =  t1.take_dep
		LEFT OUTER JOIN category c1 on c1.category = t1.category
		LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
		LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
				 where  t1.subcategory='$subcategory' and t1.level_risk='$level_risk' and t1.take_dep='$take_dep' and t1.category='$category' and  t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2'  order by t1.takerisk_id desc";	

}else if($take_date1=='' and $mng_status!=''){ 
	echo "<B>หมวด :</B> $resCate[name]&nbsp;&nbsp;&nbsp;&nbsp; <BR><BR><b>เรื่อง :</b> $resSubCate[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR><b>ระดับความรุนแรง :</b> $level_risk<br /><br />";
	echo "<b>หน่วยงาน :</b> $res[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR>";
	echo "<BR><BR><b>สถานะ :</b> "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";
	$q="select t1.move_status,t1.take_rec_date,t1.takerisk_id,t1.take_date,d1.name as dep_name,c1.name as cate_name,s1.name as subct_name,t1.level_risk,m1.mng_status,t1.takerisk_id, t1.take_detail
		from takerisk t1 
		LEFT OUTER JOIN mngrisk m1 on m1.takerisk_id = t1.takerisk_id
		LEFT OUTER JOIN department d1 on d1.dep_id =  t1.take_dep
		LEFT OUTER JOIN category c1 on c1.category = t1.category
		LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
		LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
 				 where  t1.subcategory='$subcategory' and t1.level_risk='$level_risk' and t1.take_dep='$take_dep' and t1.category='$category' and m1.mng_status='$mng_status' and t1.move_status='N'     order by t1.takerisk_id desc";	

}else if($take_date1!='' and $mng_status!=''){  

	echo "<B>หมวด :</B> $resCate[name]&nbsp;&nbsp;&nbsp;&nbsp; <BR><BR><b>เรื่อง :</b> $resSubCate[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR><b>ระดับความรุนแรง :</b> $level_risk<br /><br />";
	echo "<b>หน่วยงาน :</b> $res[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR>";
 	echo "<b>ตั้งแต่วันที่</b> ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<b>ถึงวันที่</> ".DateThai2($take_date2);
 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "<BR><BR><b>สถานะ :</b> "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p> ";

	$q="select t1.move_status,t1.take_rec_date,t1.takerisk_id,t1.take_date,d1.name as dep_name,c1.name as cate_name,s1.name as subct_name,t1.level_risk,m1.mng_status,t1.takerisk_id,t1.take_detail
		from takerisk t1 
		LEFT OUTER JOIN mngrisk m1 on m1.takerisk_id = t1.takerisk_id
		LEFT OUTER JOIN department d1 on d1.dep_id =  t1.take_dep
		LEFT OUTER JOIN category c1 on c1.category = t1.category
		LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
		LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk			 
				 where t1.subcategory='$subcategory' and t1.level_risk='$level_risk' and t1.take_dep='$take_dep' and t1.category='$category' and m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2'    order by t1.takerisk_id desc ";	

}else if($take_date1=='' and $mng_status==''){  
	echo "<B>หมวด :</B> $resCate[name]&nbsp;&nbsp;&nbsp;&nbsp; <BR><BR><b>เรื่อง :</b> $resSubCate[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR><b>ระดับความรุนแรง :</b> $level_risk<br /><br />";
	echo "<b>หน่วยงาน :</b> $res[name]&nbsp;&nbsp;&nbsp;&nbsp;<BR><BR>";
	echo "<b>สถานะ :</b> แสดงทั้งหมด<BR>";	
	echo "<p>&nbsp;</p>";

			
	$q="select t1.move_status,t1.take_rec_date,t1.takerisk_id,t1.take_date,d1.name as dep_name,c1.name as cate_name,s1.name as subct_name,t1.level_risk,m1.mng_status,t1.takerisk_id,t1.take_detail
		from takerisk t1 
		LEFT OUTER JOIN mngrisk m1 on m1.takerisk_id = t1.takerisk_id
		LEFT OUTER JOIN department d1 on d1.dep_id =  t1.take_dep
		LEFT OUTER JOIN category c1 on c1.category = t1.category
		LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
		LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
				 where t1.subcategory='$subcategory' and t1.level_risk='$level_risk' and t1.take_dep='$take_dep' and t1.category='$category' and t1.move_status='N'   order by t1.takerisk_id desc";
 	
	}//--------------close search


$qr=mysql_query($q);
$total=mysql_num_rows($qr);
 
$e_page=10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
if(!isset($_GET['s_page'])){   
	$_GET['s_page']=0;   
}else{   
	$chk_page=$_GET['s_page'];     
	$_GET['s_page']=$_GET['s_page']*$e_page;   
}   
$q.=" LIMIT ".$_GET['s_page'].",$e_page";
$qr=mysql_query($q);
if(mysql_num_rows($qr)>=1){   
	$plus_p=($chk_page*$e_page)+mysql_num_rows($qr);   
}else{   
	$plus_p=($chk_page*$e_page);       
}   
$total_p=ceil($total/$e_page);   
$before_p=($chk_page*$e_page)+1;  
echo mysql_error();
?>
 </head>
<body>
 
  


  <form action='change.php' method='get'>
<table class="table table-bordered table-hover table-striped tablesorter">
<TR>
	 
					<th width='7%'><CENTER><p>ลำดับ <i class="fa fa-sort"></i></p></CENTER></th>
                                        <th width='7%'><CENTER><p>เลขที่ <i class="fa fa-sort"></i></p></CENTER></th>
					<th width='66%'><CENTER><p>รายการ <i class="fa fa-sort"></i></p></CENTER></th>
					<th width='10%'><CENTER><p>ได้รับเมื่อ <i class="fa fa-sort"></i></p></CENTER></th>
					<th width='10%'><CENTER><p>Status  <i class="fa fa-sort"></i></p></CENTER></th>
</TR>
<?php  

 $i=1;
while($result=mysql_fetch_assoc($qr)){
/*	if($bg == "#F9F9F9") { //ส่วนของการ สลับสี 
		$bg = "#FFFFFF";
		}else{
		$bg = "#F9F9F9";
		}
*/
	if($bg == "#F4F4F4") { //ส่วนของการ สลับสี 
		$bg = "#FFFFFF";
		}else{
		$bg = "#F4F4F4";
		}
 
?>  
<?php  
 
				$takerisk_id=$result[takerisk_id];
								$sqlRead=mysql_query("select m1.mng_status,m1.mng_status,t1.move_status from mngrisk m1 
								LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id=m1.takerisk_id
								where m1.takerisk_id='$takerisk_id' ");
								$resultRead=mysql_fetch_assoc($sqlRead);
								if($resultRead[mng_status]=='Y'){
									$class="class='text-muted' ";
									if($resultRead[admin_check]=='G'){
									$status= "<font color='#158d06'><span class='fa fa-check-circle'></span></font>";
                                                                        }elseif ($resultRead[admin_check]=='Y') {
                                                                            $status= "<font color='#e9b603'><span class='fa fa-exclamation-circle'></span></font>";
                                                                        }elseif ($resultRead[admin_check]=='R') {
                                                                            $status= "<font color='#ff0000'><span class='fa fa-times-circle'></span></font>";
                                                                        }  else {
                                                                            $status= "<span class='fa fa-question-circle'></span>";
                                                                        }
            
                                                                       
                                                                        
								}elseif($resultRead[move_status]=='Y'){
									$class=" ";
									$status='อยู่ระหว่างการพิจารณา';   
								}else{
									$class="";
									$status= "<span class='fa fa-question-circle'></span>";
								}
									
?>
 					<TR >	    
				    <TD height="20" align="center" ><?=($chk_page*$e_page)+$i?></TD>
                                    <TD><a href="detailRiskInBox.php?takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> ><?=$result[takerisk_id]; ?> </a> </TD>
					<TD><a href="detailRiskInBox.php?takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> ><?=substr("$result[take_detail]",0,300); ?> </a> </TD>
					<TD ><center><a href="detailRiskInBox.php?takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> > <?php echo DateThai1($result[take_rec_date]);?></a></center></TD>
					<TD ><center><a href="detailRiskInBox.php?takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> ><?php echo $status;?></a></center></TD>					 
					</TR> 
 			 

					<?php $i++; } ?> 
</table>

<?php if($total>0){ ?>
<div class="browse_page">
 <?php   
 // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
  page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);    
  ?> 
</div>
<?php } 
   ?>


<!------------------------------------------------------------------->

 
				 
							</p>
						</section>
					
					</div>
				</div>
			</div>
		</div>
		
<?php include'footer.php'; ?>
 