<?php include 'header.php';?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php  //แสดงข้อความตามความยาวตัวอักษรที่กำหนด substr("123456789",0,5);?>
        <div class="row">
          <div class="col-lg-12">
            <h1>Change <small>รายการแจ้งย้ายความเสี่ยง</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-wrench"></i> รายการแจ้งย้ายความเสี่ยง</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <b>รายการความเสี่ยงที่รอ RM man มาตรวจสอบและ ส่งต่อให้ฝ่าย/หน่วยงานที่เกี่ยวข้องได้ดำเนินการแก้ไขต่อไป</b>
            </div>
          </div>
        </div><!-- /.row -->
 		  <form role="search" action='session_search.php' method='post'  >
		       <div class="form-group input-group">
		    		<input type='search' name='take_detail' placeholder='ค้นหาความเสี่ยง...' value='' class="form-control" > 
				      <input type='hidden' name='method'  value='change_risk'> 
		                <span class="input-group-btn">
		                  <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
		                  </span>
		              </div>
		  </form>

	    <div class="row">
          <div class="col-lg-12">
          <!-- ค้นหา -->
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-envelope"></span> InBox</h3>
              </div>
              <div class="panel-body">
                   <!---------------------เปิดข่าว---------------------------------------------->

 		 
						<!--   <H1>หมายเหตุ รายการที่มีเครื่องหมายดอกจันทร์  (***) จำเป็นต้องระบุให้ครบ</H1> -->
 						

<!------------------------------------------------------------------>
<!DOCTYPE html>
<html>
<head>
	 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- Add jQuery library -->
	 
</head>
<body>
 
<?php   
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
	global $e_page;
	global $querystr;
	$urlfile="changeRisk.php"; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
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
 
 
 if($_SESSION[searchChangeRisk]!=''){
    $Search=trim($_SESSION[searchChangeRisk]);
 echo "<br><br><br>แสดงคำที่ค้นหา : ".$Search;
//คำสั่งค้นหา
     $q="select  *  from   takerisk t1
         inner join subcategory s1 on t1.subcategory=s1.subcategory
         Where  t1.take_detail like '%$Search%'   and t1.move_status='Y'  and t1.recycle='N'"; 
 }else{
 $q="select  *  from   takerisk t1
     inner join subcategory s1 on t1.subcategory=s1.subcategory
     Where    t1.move_status='Y' and t1.recycle='N' ORDER BY t1.takerisk_id DESC "; 

   }
	
$qr=mysql_query($q);
if($qr==''){exit();}
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
  
<div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">

 <thead>
 <TR> 
					<th width='7%'><CENTER><p>ลำดับที่ <i class="fa fa-sort"></i></p></CENTER></th>
                                        <th width='7%'><CENTER><p>เลขที่ <i class="fa fa-sort"></i></p></CENTER></th>
					<th width='46%'><CENTER><p>รายการ <i class="fa fa-sort"></i></p></CENTER></th>
                                        <th width='10%'><CENTER><p>เกิดขึ้นเมื่อ <i class="fa fa-sort"></i></p></CENTER></th>
					<th width='10%'><CENTER><p>ได้รับเมื่อ <i class="fa fa-sort"></i></p></CENTER></th>
					<th width='15%'><CENTER><p>Status  <i class="fa fa-sort"></i></p></CENTER></th>
			 		 
 </TR></thead>
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
								include_once ('funcDateThai.php');
								$take_rec_date= "$result[take_rec_date]";
								DateThai1($take_rec_date); //-----แปลงวันที่เป็นภาษาไทย
                                                                $take_date= "$result[take_date]";
								DateThai1($take_date); //-----แปลงวันที่เป็นภาษาไทย
								
								$takerisk_id=$result[takerisk_id];
								$sqlRead=mysql_query("select m1.mng_status,t1.move_status from mngrisk m1 
								LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id=m1.takerisk_id
								where m1.takerisk_id='$takerisk_id' ");
								$resultRead=mysql_fetch_assoc($sqlRead);
								if($resultRead[mng_status]=='Y'){
									$class="class='text-muted' ";
									$status= "<span class='fa fa-check-circle'></span>";
								}elseif($resultRead[move_status]=='Y'){
									$class=" ";
									$status='อยู่ระหว่างการพิจารณา';   
								}else{
									$class="";
									$status= "<span class='fa fa-warning'></span>";
								}
								

?>  
 					<TR >	    
                                        <TD height="20" align="center" ><?=($chk_page*$e_page)+$i?></TD>
                                        <TD><center><a href="detailRiskInBox.php?method=remove_risk&takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> ><?=$result[takerisk_id]?> </a></center> </TD>
					<TD><a href="detailRiskInBox.php?method=remove_risk&takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> ><?=substr("$result[name]",0,300); ?> </a> </TD>
                                        <TD ><center><a href="detailRiskInBox.php?takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> > <?php echo DateThai1($take_date);?></a></center></TD>
					<TD ><center><a href="detailRiskInBox.php?method=remove_risk&takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> > <?php echo DateThai1($take_rec_date);?></a></center></TD>
					<TD ><center><a href="detailRiskInBox.php?method=remove_risk&takerisk_id=<?=$result[takerisk_id]?>"  <?=$class?> ><?php echo $status;?></a></center></TD>					 
					</TR> 
 			 
 		 <? $i++; } ?>		 
</CENTER>
</table>

<?php if($total>0){
echo mysql_error();

?> 
<div class="browse_page">
 
 <?php   
 // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
  page_navigator($before_p,$plus_p,$total,$total_p,$chk_page);    

  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size='2'>มีจำนวนทั้งหมด  <B>$total รายการ</B> จำนวนหน้าทั้งหมด ";
  echo  $count=ceil($total/20)."&nbsp;<B>หน้า</B></font>" ;
}
  ?> 
    </div>    
    
<?php include 'footer.php';?>
