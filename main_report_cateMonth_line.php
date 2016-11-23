<?php @session_start(); ?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php include 'header.php';if(isset($_GET['unset'])){ unset_session();}?>
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
<H1><small>รายงานแสดงจำนวนความเสี่ยงแยกตามหมวดความเสี่ยงทั้งหมดในแต่ละเดือน</small></H1>
<form method="post" action="" enctype="multipart/form-data" class="navbar-form navbar-right">
			<div class="form-group"> 
					  <select name='year'  class="form-control">
                                              <option value=''>เลือกปีงบประมาณ</option>
					  <?php
					   for($i=2557;$i<=2565;$i++){
					  echo "<option value='$i'>$i</option>";
					  }
					  ?>
 					  </select>
			  </div>
			<button type="submit" class="btn btn-success">ตกลง</button> 						
</form>
 <?php         
 		     $category=$_POST[category];
 		     $year=$_POST[year];

		 $sql=mysql_query("select * from category where category='$category'");
		 $resultCate=mysql_fetch_assoc($sql);
include 'function/function_date.php';
                       if($_POST[year]==''){
                       if($date >= $bdate and $date <= $edate){
                        $year = $Yy;
                        $years = $year + 543;   
                        $y= $Yy;
                        $Y= date("Y");

                        }else{
                        $year = date('Y');
                        $years = $year + 543;
                        $y = date("Y");
                        $Y = date("Y") - 1;
                        }
		   }else{  
                        $year = $_POST[year] - 543;
                        $years = $year + 543;
                        $y = $_POST[year] - 543;
                        $Y = $y - 1;
                        
                   }
 echo "<br />"; 
 echo "<br />";   
 echo "<br />";   
 echo "<center>";   



if($category=='' and $year!=''){
	echo "หมวดความเสี่ยง : ทั้งหมด"; echo "&nbsp;&nbsp;"; echo "ปี : $years";
}else if($category+='' and $year!=''){
	echo "หมวดความเสี่ยง : $resultCate[name]"; echo "&nbsp;&nbsp;"; echo "ปี : $years";
}else if($category=='' and $year==''){ 
	echo "หมวดความเสี่ยง : ทั้งหมด"; echo "&nbsp;&nbsp;"; echo "ปี : $years";
}
 echo "</center>";   
 
 $month_start= $month_start1.$i="$year-01-01";							
 $month_end= $month_end.$i="$year-01-31";		
 
 $I = 10;
                    for ($i = -2; $i <= 9; $i++) {

                        $sqlMonth = mysql_query("select * from month where m_id='$i'");
                        $month = mysql_fetch_assoc($sqlMonth);

                        if ($i <= 0) {
                            $month_start = "$Y-$I-01";
                            $month_end = "$Y-$I-31";					
		 
		 } elseif ($i >= 1 and $i <= 9) {
                            $month_start = "$y-0$i-01";
                            $month_end = "$y-0$i-31";
                        } else {
                            $month_start = "$y-$i-01";
                            $month_end = "$y-$i-31";
                        }

		   $month_start; echo "&nbsp;&nbsp;";
		   $month_end;

 for ($c = 1; $c <= 8; $c++) {
                        $sql = mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.category='$c' and    t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' order by number_risk DESC");
                        
                        $rs = mysql_fetch_assoc($sql);

                        
                        $countnum[$c].= $rs[number_risk] . ',';
                        }
                        $name.="'$month[month_short]'" . ',';
                        $I++;
							 

  }	
 		echo mysql_error();					
 
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
                type: 'line'
            },
            title: {
                text: 'จำนวนความเสี่ยงในแต่ละหมวดแยกรายเดือน'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [<? echo $name; ?>
                ]
            },
            yAxis: {
                title: {
                    text: 'จำนวนเรื่อง'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                    return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'';
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'ด้านคลินิก)',
                data: [<? echo $countnum[1]?>]
            }, {
                name: 'ด้านระบบยา',
                data: [<? echo $countnum[2]?>]
            }, {
                name: 'ด้านจริยธรรมและสิทธิผู้ป่วย',
                data: [<? echo $countnum[3]?>]
            }, {
                name: 'ด้านการป้องกันการติดเชื้อ',
                data: [<? echo $countnum[4]?>]
            }, {
                name: 'ด้านสิ่งแวดล้อมและความปลอดภัย',
                data: [<? echo $countnum[5]?>]
            }, {
                name: 'ด้านทรัพยากร',
                data: [<? echo $countnum[6]?>]
            }, {
                name: 'ด้านสารสนเทศและการสื่อสาร',
                data: [<? echo $countnum[7]?>]
            }, {
                name: 'ด้านการบันทึกเวชระเบียน',
                data: [<? echo $countnum[8]?>]
            }
				
				]
        });
    });
    
});
		</script>	</head>
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
 
<CENTER>
<!-- <H1>จำนวนการรายงานความเสี่ยงของหน่วยงาน</H1> -->

<div class="table-responsive">
<table class="table table-bordered table-hover table-striped tablesorter">
<TR>
	<TH><CENTER><p>ลำดับ</p></CENTER></TH>
	<TH><CENTER>รายเดือนใน ปี <?php echo $years=$year+543;?></CENTER> </TH>
	<TH><p align="right">จำนวนเรื่อง&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TH>
</TR>
 
 </CENTER>
 
 <?php         
 $I = 10;$c=1;
                    for ($i = -2; $i <= 9; $i++) {
		 $sqlMonth=mysql_query("select * from month where m_id='$i'");
		 $month=mysql_fetch_assoc($sqlMonth);
                 
                 if ($i <= 0) {
                            $month_start = "$Y-$I-01";
                            $month_end = "$Y-$I-31";					
		 
		 } elseif ($i >= 1 and $i <= 9) {
                            $month_start = "$y-0$i-01";
                            $month_end = "$y-0$i-31";
                        } else {
                            $month_start = "$y-$i-01";
                            $month_end = "$y-$i-31";
                        }

		   $month_start;  
		   $month_end;

 
		 if($category!='' and $year==''){
		 $sql=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.category='$category' and t1.move_status='N'   group by c1.category order by number_risk DESC");	
		 }else if($category=='' and $year!=''){
		 $sql=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' order by number_risk DESC");	
		 }else if($category!='' and $year!=''){
		 $sql=mysql_query("select count(takerisk_id) as number_risk ,c1.category
		 from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.category='$category'   and t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' group by c1.category order by number_risk DESC");	
		 }else if($category=='' and $year==''){
		 $sql=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where     t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' order by number_risk DESC");	
		 }
				 
 
$rs = mysql_fetch_assoc($sql);
								
 						  // $name.="'$rs[category_name]'".',';
					 	   // $countnum.= $rs[number_risk].',';

 
			 
  
 	if($bg == "#F4F4F4") { //ส่วนของการ สลับสี 
		$bg = "#FFFFFF";
		}else{
		$bg = "#F4F4F4";
		}
	

 	?>	
<?php

	if($category==''){?>

	
		<tr bgcolor=<?=$bg?> onmouseover="mOvr(this,'#DEF8F0');" onclick=mClk(this); onmouseout=mOut(this); >
			<TD><CENTER><?php echo $c; ?></CENTER></TD>
			<TD><?php echo $month[month_name];?></TD>
			<TD><p align="right"><?php echo $rs[number_risk];?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></TD>
		</TR>


	<?php } //end category null	
	else{?>
		<tr bgcolor=<?=$bg?> onmouseover="mOvr(this,'#DEF8F0');" onclick=mClk(this); onmouseout=mOut(this); >
			<TD><CENTER><?php if($rs[category]==''){ echo "<p>".$c; ?></CENTER><?php }else{?><a href='main_report2.php?category=<?=$rs[category]?>&&mng_status=<?=$mng_status?>&&take_date1=<?=$month_start?>&&take_date2=<?=$month_end?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $c; ?><?php }?></CENTER></a></TD>
			<TD><?php if($rs[category]==''){ echo "<p>".$month[month_name]; ?></CENTER><?php }else{?><a href='main_report2.php?category=<?=$rs[category]?>&&mng_status=<?=$mng_status?>&&take_date1=<?=$month_start?>&&take_date2=<?=$month_end?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $month[month_name];?></a><?php }?></TD>
			<TD><?php if($rs[category]==''){ echo "<p align='right'>".'0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>'; ?><?php }else{?><p align="right"><a href='main_report2.php?category=<?=$rs[category]?>&&mng_status=<?=$mng_status?>&&take_date1=<?=$month_start?>&&take_date2=<?=$month_end?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $rs[number_risk];?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><?php }?></TD>
		</TR>


	<?php }
	
	?>
<?php $I++;$c++; } 	?>
 
</TABLE>
</CENTER>
							
</section>