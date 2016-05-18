   
<!-- ค้นหา -->
  <form class="navbar-form navbar-left" role="search" action='session_search.php' method='post'  >
       <div class="form-group">
		<input type='text' name='Search_subcategory' placeholder='รายการความเสี่ยง'  value='' class="form-control"  > 
		<input type='hidden' name='method'  value='search_subcategory'> 
		 </div>
		<button  class="btn btn-default" ><i class="fa fa-search"></i></button >
  </form>
 		 
						<!--   <H1>หมายเหตุ รายการที่มีเครื่องหมายดอกจันทร์  (***) จำเป็นต้องระบุให้ครบ</H1> -->
 						

<!------------------------------------------------------------------>

<?php   
// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p,$plus_p,$total,$total_p,$chk_page){   
	global $e_page;
	global $querystr;
	$urlfile=""; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
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
 

 $Search_subcategory=trim($_SESSION[Search_subcategory]);
 if($Search_subcategory!='' ){
 
  echo "แสดงคำที่ค้นหา : ".$Search_subcategory;
//คำสั่งค้นหา
     $q="select c1.name as cate_name ,s1.subcategory,s1.name as sub_name from subcategory s1 
     LEFT OUTER JOIN category c1 ON s1.category=c1.category  
 	  Where  s1.name like '%$Search_subcategory%'  "; 
 }else{
 $q="select c1.name as cate_name ,s1.subcategory,s1.name as sub_name from subcategory s1 
     LEFT OUTER JOIN category c1 ON s1.category=c1.category   "; 
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
  

 <table width="100%" class='table table-hover table-striped table-bordered'  >  
 <TR bgcolor='#C3C3C3'>
					<th width='5%'><CENTER><p>#</p></CENTER></th>
					<th width='40%'><CENTER>รายการความเสี่ยง</CENTER></th>
					<th width='40%'><CENTER>หมวดความเสี่ยง</CENTER></th>
					<th width='15%'><CENTER>แก้ไข | ลบ</CENTER></th>
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
 					<tr >	    
				    <TD height="20" align="center" ><?=($chk_page*$e_page)+$i?></TD>
					<TD><?=$result[sub_name]; ?></TD>
					<TD><?=$result[cate_name]; ?></TD>
 					<TD><CENTER>
				    <a href='frmSubCategory.php?method=update&subcategory=<?=$result[subcategory]?>' ><i class="fa fa-edit"></i></a> 
				    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					
					<a href='./prcSubCategory.php?method=delete&subcategory=<?=$result[subcategory]?>'  title="confirm" onclick="if(confirm('ยืนยันการลบ <?php  echo  $result[sub_name]; ?>&nbsp;ออกจากรายการ ')) return true; else return false;">   
					<i class="fa fa-trash-o"></i></a>
					</tr> 
 
  			 
 		 <?php $i++; } ?>
 		 
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
  echo  $count=ceil($total/10)."&nbsp;<B>หน้า</B></font>" ;
}
  ?> 
 </div> 
