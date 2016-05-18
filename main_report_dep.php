<?php  @session_start(); ?>
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
<form method="post" action="" enctype="multipart/form-data" class="navbar-form navbar-right">
            <div class="form-group">
             <input type="date"   name='take_date1' class="form-control" value='' >
            </div>
            <div class="form-group">
              <input type="date"   name='take_date2' class="form-control" value='' >
            </div>   
            <div class="form-group">
			<select name='mng_status'  class="form-control" >
			  <option value=''>---เลือกสถานะ---</option>
			  <option value='N'>N ยังไม่แก้ไข</option>
			  <option value='Y'>Y แก้ไขแล้ว</option>
			  </select>   
			  </div>
			<button type="submit" class="btn btn-success">ตกลง</button> 						
</form>

 <?php    
 		    $user_dep_id = $_SESSION[user_dep_id];
 		    $mng_status=$_POST[mng_status];
	        $take_date1=$_POST[take_date1];
	        $take_date2=$_POST[take_date2];
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
	echo "<p>&nbsp;</p><center>";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
	echo "<p>&nbsp;</p></center>";
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category  from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 where   t1.take_dep='$user_dep_id' and  t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by c1.category order by number_risk DESC");	

}else if($take_date1=='' and $mng_status!=''){ 
	echo "<p>&nbsp;</p><center>";
	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category  from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
 				 where    t1.take_dep='$user_dep_id' and t1.take_date between '$date_start' and '$date_end' and  m1.mng_status='$mng_status' and t1.move_status='N'   group by c1.category order by number_risk DESC");	

}else if($take_date1!='' and $mng_status!=''){  

	echo "<p>&nbsp;</p><center>";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";

$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category  from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
 				 where    t1.take_dep='$user_dep_id' and  m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by c1.category order by number_risk DESC");	

}else if($take_date1=='' and $mng_status==''){  
	echo "<p>&nbsp;</p><center>";
	echo "แสดงทั้งหมด<BR>";	
	echo "<p>&nbsp;</p></center>";

			
 				$sql = mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name,c1.name as category_name,c1.category   from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 where    t1.take_dep='$user_dep_id' and t1.move_status='N' and t1.take_date between '$date_start' and '$date_end' group by c1.category order by number_risk DESC");
 			 
 }					 
  
 //Iterate through each factory
			//	$result = mysql_query($strQuery) or die(mysql_error()); 
 
 					  while($rs = mysql_fetch_assoc($sql)){
 						    $name.="'$rs[category_name]'".',';
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
                text: 'จำนวนความเสี่ยงแยกตามหมวดความเสี่ยง'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<? echo $name; ?>
                ],
                labels: {
                    rotation: -45,
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
                        'หมวดความเสี่ยงนี้จำนวน: '+ Highcharts.numberFormat(this.y, 0) +
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
                x: -100,
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
                name: 'หมวดความเสี่ยง',
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

<?php

//include'../connect.php';


															
				
?>
<CENTER>
<!-- <H1>จำนวนการรายงานความเสี่ยงของหน่วยงาน</H1> -->

<div class="table-responsive">
<table class="table table-bordered table-hover table-striped tablesorter">
<TR>
	<TH><CENTER><p>ลำดับ</p></CENTER></TD>
	<TH>หมวดความเสี่ยง</TD>
	<TH><p align="right">เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>
</TR>
 
 </CENTER>
 
 <?php         
 
if($take_date1!='' and $mng_status==''){  
	echo "<p>&nbsp;</p><center>";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name ,c1.category  from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 where     t1.take_dep='$user_dep_id'  and  t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by c1.category order by number_risk DESC");	

}else if($take_date1=='' and $mng_status!=''){ 
	echo "<p>&nbsp;</p><center>";
	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name ,c1.category from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
 				 where   t1.take_dep='$user_dep_id'  and   m1.mng_status='$mng_status' and t1.take_date between '$date_start' and '$date_end' and t1.move_status='N'   group by c1.category order by number_risk DESC");	

}else if($take_date1!='' and $mng_status!=''){  

	echo "<p>&nbsp;</p><center>";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";

$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name ,c1.name as category_name,c1.category  from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
 				 where   t1.take_dep='$user_dep_id'  and   m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by c1.category order by number_risk DESC");	

}else if($take_date1=='' and $mng_status==''){  
	echo "<p>&nbsp;</p><center>";
	echo "แสดงทั้งหมด<BR>";	
	echo "<p>&nbsp;</p></center>";

			
 				$sql = mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name,c1.name as category_name,c1.category   from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.take_dep = d1.dep_id
				 LEFT OUTER JOIN category c1 on c1.category = t1.category
				 where   t1.take_dep='$user_dep_id' and t1.take_date between '$date_start' and '$date_end'  and   t1.move_status='N' group by c1.category order by number_risk DESC");
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
	
 	<a href='main_report3.php?take_dep=<?=$user_dep_id?>&category=<?=$rs[category]?>&&mng_status=<?=$mng_status?>&&take_date1=<?=$take_date1?>&&take_date2=<?=$take_date2?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $i; ?></CENTER></a></TD>
	<TD><a href='main_report3.php?take_dep=<?=$user_dep_id?>&category=<?=$rs[category]?>&&mng_status=<?=$mng_status?>&&take_date1=<?=$take_date1?>&&take_date2=<?=$take_date2?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $rs[category_name];?></a></TD>
	<TD><a href='main_report3.php?take_dep=<?=$user_dep_id?>&category=<?=$rs[category]?>&&mng_status=<?=$mng_status?>&&take_date1=<?=$take_date1?>&&take_date2=<?=$take_date2?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><p align="right"><?php echo $rs[number_risk];?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>
</TR>

<?php 
$i++;
}?>
</TABLE>
</CENTER>
							
 						</section>
