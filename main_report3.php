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
  <?php   
			$mng_status=$_GET[mng_status];
			$take_dep=$_GET[take_dep];
	        $take_date1=$_GET[take_date1];
 	        $take_date2=$_GET[take_date2];
			$category=$_GET[category];
    

			$sql=mysql_query("select * from department where dep_id='$take_dep'");
			$res=mysql_fetch_assoc($sql);

			$sql=mysql_query("select * from category where category='$category'");
			$resCate=mysql_fetch_assoc($sql);
			  								include_once ('funcDateThai.php');
								$take_rec_date= "$result[take_rec_date]";
								DateThai1($take_date1); //-----แปลงวันที่เป็นภาษาไทย
								DateThai2($take_date2); //-----แปลงวันที่เป็นภาษาไทย 
                        include 'function/function_date.php';
               if($date >= $bdate and $date <= $edate){
                   $y= $Yy;
                   $Y= date("Y");
                   $date_start = "$Y-10-01";
                   $date_end = "$y-09-30";
               }                                         

if($take_date1!='' and $mng_status==''){  
	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category ,t1.level_risk ,t1.subcategory ,t1.take_dep 
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
				 where  t1.take_dep='$take_dep' and t1.category='$category' and  t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by t1.level_risk order by r1.level_risk  ASC");	

}else if($take_date1=='' and $mng_status!=''){ 
	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category ,t1.level_risk,t1.subcategory ,t1.take_dep 
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
 				 where  t1.take_dep='$take_dep' and t1.take_date between '$date_start' and '$date_end' and t1.category='$category' and m1.mng_status='$mng_status' and t1.move_status='N'   group by t1.level_risk  order by r1.level_risk ASC");	

}else if($take_date1!='' and $mng_status!=''){  

	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "ตั้งแต่วันที่ $ex1[2]/$ex1[1]/$ex1[0]";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";

$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category,t1.level_risk,t1.subcategory  
,t1.take_dep   
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
 				 where  t1.take_dep='$take_dep' and t1.category='$category' and m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by t1.level_risk  order by r1.level_risk ASC ");	

}else if($take_date1=='' and $mng_status==''){  
	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "แสดงทั้งหมด<BR>";	
	echo "<p>&nbsp;</p></center>";

			
 				$sql = mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name,c1.name as category_name,c1.category  ,t1.level_risk ,t1.subcategory,t1.take_dep
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
				 where  t1.take_dep='$take_dep' and t1.take_date between '$date_start' and '$date_end' and t1.category='$category' and t1.move_status='N' group by t1.level_risk order by r1.level_risk ASC");
 }		  
  
			 //Iterate through each factory
			//	$result = mysql_query($strQuery) or die(mysql_error()); 
 echo mysql_error();
 					  while($rs = mysql_fetch_assoc($sql)){
 						    $name.="'$rs[level_risk]'".',';
					 	    $countnum.= $rs[number_risk].',';
 				}
 


?>
<script src="report_rm/highcharts.js"></script>
<script src="report_rm/exporting.js"></script>
  <script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'column'
            },
            title: {
                text: 'จำนวนความเสี่ยงแยกตามระดับความรุนแรง'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<? echo $name; ?>
                ],
                labels: {
                    rotation: 0,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'จำนวนเรื่อง',
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }

            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        'ความเสี่ยงของระดับนี้จำนวน: '+ Highcharts.numberFormat(this.y, 0) +
                        ' เรื่อง';
                }
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
		/*		 
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -90,
                y: 0,
                floating: true,
                borderWidth: 1,
                backgroundColor: '#FFFFFF',
                shadow: true
            },
		*/	 
            credits: {
                enabled: false
            },
            series: [{
                name: 'ระดับความรุนแรง',
                data: [<? echo $countnum; ?>],
                 dataLabels: {
                    enabled: true,
                    rotation: 0,
                    color: '#FFFFFF',
                    align: 'right',
                    x: 0,
                    y: 18,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
					}
				}
            }]
        });
    });
    
});
		</script> 
	</head>
	<body>

<div id="container" style="min-width: 700px; height: 500px; margin: 0 auto"></div>



 <SCRIPT language='JavaScript'>
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

 
<CENTER>
<!-- <H1>จำนวนการรายงานความเสี่ยงของหน่วยงาน</H1> -->

<div class="table-responsive">
<table class="table table-bordered table-hover table-striped tablesorter">
<TR>
	<TH><CENTER><p>ลำดับ</p></CENTER></TH>
	<TH>ระดับความรุนแรงของความเสี่ยง</TH>
	<TH><p align="right">เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TH>
</TR>
 
 </CENTER>
 
 <?php         
 
if($take_date1!='' and $mng_status==''){  
	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category ,t1.level_risk ,t1.subcategory ,t1.take_dep 
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
				 where  t1.take_dep='$take_dep' and t1.category='$category' and  t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by t1.level_risk order by r1.level_risk  ASC");	

}else if($take_date1=='' and $mng_status!=''){ 
	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category ,t1.level_risk,t1.subcategory ,t1.take_dep 
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
 				 where  t1.take_dep='$take_dep' and t1.take_date between '$date_start' and '$date_end' and t1.category='$category' and m1.mng_status='$mng_status' and t1.move_status='N'   group by t1.level_risk  order by r1.level_risk ASC");	

}else if($take_date1!='' and $mng_status!=''){  

	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";

$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category,t1.level_risk,t1.subcategory  
,t1.take_dep   
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
 				 where  t1.take_dep='$take_dep' and t1.category='$category' and m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by t1.level_risk  order by r1.level_risk ASC ");	

}else if($take_date1=='' and $mng_status==''){  
	echo "<B>หมวด</B> : $resCate[name]<br /><br /><center>";
	echo "หน่วยงาน : $res[name]&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "แสดงทั้งหมด<BR>";	
	echo "<p>&nbsp;</p></center>";

			
 				$sql = mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name,c1.name as category_name,c1.category  ,t1.level_risk ,t1.subcategory,t1.take_dep
				 from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
				 where  t1.take_dep='$take_dep' and t1.take_date between '$date_start' and '$date_end' and t1.category='$category' and t1.move_status='N' group by t1.level_risk order by r1.level_risk ASC");
 }	
 
$i=1;
while($rs=mysql_fetch_assoc($sql)){
	if($bg == "#F4F4F4") { //ส่วนของการ สลับสี 
		$bg = "#FFFFFF";
		}else{
		$bg = "#F4F4F4";
		}
	
 	?>	

<tr bgcolor=<?=$bg?> onmouseover="mOvr(this,'#DEF8F0');" onclick=mClk(this); onmouseout=mOut(this); >
	<TD><CENTER>
	
 	<a href='main_report4.php?level_risk=<?=$rs[level_risk]?>&take_dep=<?=$rs[take_dep]?>&category=<?=$rs[category]?>&mng_status=<?=$mng_status?>&take_date1=<?=$take_date1?>&take_date2=<?=$take_date2?>&type=1' title='ดูรายงานแยกตามเรื่อง'><?php echo $i; ?></CENTER></a></TD>
	<TD><a href='main_report4.php?level_risk=<?=$rs[level_risk]?>&take_dep=<?=$rs[take_dep]?>&category=<?=$rs[category]?>&mng_status=<?=$mng_status?>&take_date1=<?=$take_date1?>&take_date2=<?=$take_date2?>&type=1' title='ดูรายงานแยกตามเรื่อง'><?php echo $rs[level_risk];?></a></TD>
	<TD><a href='main_report4.php?level_risk=<?=$rs[level_risk]?>&take_dep=<?=$rs[take_dep]?>&category=<?=$rs[category]?>&mng_status=<?=$mng_status?>&take_date1=<?=$take_date1?>&take_date2=<?=$take_date2?>&type=1' title='ดูรายงานแยกตามเรื่อง'><p align="right"><?php echo $rs[number_risk];?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>
</TR>

<?php 
$i++;
}?>
</TABLE>
</CENTER>
							
 						</section>
		
<?php include'footer.php'; ?>
 