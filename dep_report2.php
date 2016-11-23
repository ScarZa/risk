<?php include 'header.php';if(isset($_GET['unset'])){ unset_session();}?>
<h2>คณะกรรมการบริหารความเสี่ยง</h2>
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
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
				 where    t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by d1.dep_id order by number_risk DESC");	

}else if($take_date1=='' and $mng_status!=''){ 
	echo "<p>&nbsp;</p><center>";
	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
 				 where   m1.mng_status='$mng_status' and t1.take_date between '$date_start' and '$date_end' and t1.move_status='N'   group by d1.dep_id order by number_risk DESC");	

}else if($take_date1!='' and $mng_status!=''){  
	echo "<p>&nbsp;</p><center>";
 	echo "ตั้งแต่วันที่ ".DateThai1($take_date1);
	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "ถึงวันที่ ".DateThai2($take_date2);
 	echo "&nbsp;&nbsp;&nbsp;&nbsp;";
 	echo "สถานะ : "; 
	if($mng_status=='Y'){echo "แก้ไขแล้ว";}else{echo "ยังไม่แก้ไข";}
	echo "<p>&nbsp;</p></center>";

$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
 				 where   m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by d1.dep_id order by number_risk DESC");	

}else if($take_date1=='' and $mng_status==''){  
	echo "<p>&nbsp;</p><center>";
	echo "แสดงทั้งหมด<BR>";	
	echo "<p>&nbsp;</p></center>";

			
 				$sql = mysql_query("select count(mngrisk_id) as number_risk,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
				 where   t1.move_status='N' and t1.take_date between '$date_start' and '$date_end' group by d1.dep_id order by number_risk DESC");
 }					 
  
 //Iterate through each factory
			//	$result = mysql_query($strQuery) or die(mysql_error()); 
 
 					  while($rs = mysql_fetch_assoc($sql)){
 						    $name.="'$rs[dep_name]'".',';
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
                text: 'จำนวนความเสี่ยงทั้งหมดของหน่วยงาน'
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
                        'ความเสี่ยงของหน่วยงานจำนวน: '+ Highcharts.numberFormat(this.y, 0) +
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
                y: 100,
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
                name: 'หน่วยงาน',
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
	<TH  ><CENTER><p>ลำดับ</p></CENTER></TH>
	<TH >รายชื่อหน่วยงาน</TH>
	<TH><p align="right">เรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TH>
</TR>
 
 </CENTER>
 
 <?php         
 
if($take_date1!='' and $mng_status==''){  
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.dep_id,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
				 where    t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by d1.dep_id order by number_risk DESC");	
				$i=1;
				while($rs=mysql_fetch_assoc($sql)){
					$dep_id=$rs[dep_id];	
					echo "<tr>"; 
					echo "<TD><CENTER>$i</CENTER></TD>";
					echo "<TD><a href='session_search.php?report=report_department5&dep_id=$rs[dep_id]&move_status=N&take_date1=$take_date&take_date2=$take_date2'>$rs[dep_name] </a></TD>";
					echo "<TD><p align='right'> $rs[number_risk] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>";
					echo "</TR>"; 
				$i++;
				}
}else if($take_date1=='' and $mng_status!=''){  
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.dep_id,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
 				 where   m1.mng_status='$mng_status' and t1.take_date between '$date_start' and '$date_end' and t1.move_status='N'   group by d1.dep_id order by number_risk DESC");	
				$i=1;
				while($rs=mysql_fetch_assoc($sql)){
					$dep_id=$rs[dep_id];	
					echo "<tr>"; 
					echo "<TD><CENTER>$i</CENTER></TD>";
					echo "<TD><a href='session_search.php?report=report_department6&mng_status=$mng_status&dep_id=$rs[dep_id]&move_status=N'>$rs[dep_name] </a></TD>";
					echo "<TD><p align='right'> $rs[number_risk] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>";
					echo "</TR>"; 
				$i++;
				}
}else if($take_date1!='' and $mng_status!=''){ 
$sql=mysql_query("select count(mngrisk_id) as number_risk,d1.dep_id,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
 				 where   m1.mng_status='$mng_status' and t1.move_status='N' and t1.take_date between '$take_date1' and '$take_date2' group by d1.dep_id order by number_risk DESC");	
				$i=1;
				while($rs=mysql_fetch_assoc($sql)){
					$dep_id=$rs[dep_id];		
					echo "<tr>"; 
					echo "<TD><CENTER>$i</CENTER></TD>";
					echo "<TD><a href='session_search.php?report=report_department7&mng_status=$mng_status&dep_id=$dep_id&move_status=N&take_date1=$take_date&take_date2=$take_date2'>$rs[dep_name] </a></TD>";
					echo "<TD><p align='right'> $rs[number_risk] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>";
					echo "</TR>"; 
				$i++;
				}
}else if($take_date1=='' and $mng_status==''){ 			
 				$sql = mysql_query("select count(mngrisk_id) as number_risk,d1.dep_id,d1.name as dep_name from mngrisk m1
				 LEFT OUTER JOIN takerisk t1 on t1.takerisk_id = m1.takerisk_id
				 LEFT OUTER JOIN department d1 on t1.res_dep = d1.dep_id
				 where   t1.move_status='N' and t1.take_date between '$date_start' and '$date_end' group by d1.dep_id order by number_risk DESC");
				$i=1;
				while($rs=mysql_fetch_assoc($sql)){
					$dep_id=$rs[dep_id];
					echo "<tr>"; 
					echo "<TD><CENTER>$i</CENTER></TD>";
					echo "<TD><a href='session_search.php?report=report_department8&dep_id=$dep_id&move_status=N'>$rs[dep_name] </a></TD>";
					echo "<TD><p align='right'> $rs[number_risk] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>";
					echo "</TR>"; 
				$i++;
				}
 }	

?>
</TABLE>
</CENTER>
							
 						</section>