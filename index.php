<?php @session_start(); ?>
<?php include 'header.php'; ?>
<?php
                            $sql = mysql_query("select * from  hospital");
                            $resultHos = mysql_fetch_assoc($sql);
                             if ($resultHos[logo] != '') {
                                    $pic = $resultHos[logo];
                                    $fol = "logo/";
                                } else {
                                    $pic = 'agency.ico';
                                    $fol = "images/";
                                }

?>

<div class="row">
    <div class="col-lg-12">
        <div class="alert alert-success">
            <div class="col-md-1" align="left"><img src='<?= $fol . $pic; ?>' width="80"></div>
            <h1><div class="col-lg-11" valign="top">&nbsp;&nbsp;&nbsp; ระบบบริหารความเสี่ยง <small><br>
                        <b><font color="blue">&nbsp;&nbsp;&nbsp;&nbsp;
                            <?php
//===ชื่อโรงพยาบาล
                            echo $resultHos[name];?></font></b></small>
                </div></h1>

            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ยินดีต้อนรับสู่ <a class="alert-link" href="http://startbootstrap.com"> ระบบบริหารความเสี่ยงโรงพยาบาล</a> เพื่อลดโอกาสที่จะประสบกับความสูญเสีย หรือสิ่งไม่พึงประสงค์ โอกาสความน่าจะเป็นที่จะเกิดอุบัติการณ์.
        </div>
    </div>
</div><!-- /.row -->
<ol class="breadcrumb">
    <li class="active"><i class="fa fa-home"></i> หน้าหลัก</li>
</ol>
<?php include 'function/function_date.php';
if ($_REQUEST[year] == '') {
    
    
    if($date >= $bdate and $date <= $edate){
                             $y= $Yy;
                             $Y= date("Y");
                            }else{
                            $y = date("Y");
                            $Y = date("Y") - 1;
                            }
                        } else {
                            $YeaR=$_REQUEST[year];
                            $y = $_REQUEST[year] - 543;
                            $Y = $y - 1;
                        }
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                            $sql_sum = mysql_query("select count(t1.takerisk_id) as sum from takerisk t1
                                                    inner join mngrisk m1 on t1.takerisk_id=m1.takerisk_id
                                                    Where   recycle='N' and subcategory!='' and t1.move_status='N'
                                                    and t1.take_date between '$date_start' and '$date_end'");
                            $sum_rm = mysql_fetch_assoc($sql_sum);
                            $sql_D = mysql_query("select count(t1.takerisk_id) as sumD from takerisk t1
                                                    inner join mngrisk m1 on t1.takerisk_id=m1.takerisk_id
                                                    where m1.admin_check='' and t1.recycle='N' and m1.mng_status='N' and t1.subcategory!='' and t1.move_status='N'
                                                    and t1.take_date between '$date_start' and '$date_end'");
                            $sum_rmD = mysql_fetch_assoc($sql_D);
                            $sql_D2 = mysql_query("select count(t1.takerisk_id) as sumD2 from takerisk t1
                                                    inner join mngrisk m1 on m1.takerisk_id=t1.takerisk_id
                                                    where m1.admin_check='' and t1.recycle='N' and m1.mng_status='Y' and t1.subcategory!='' and t1.move_status='N'
                                                    and t1.take_date between '$date_start' and '$date_end'");
                            $sum_rmD2 = mysql_fetch_assoc($sql_D2);
                            $sql_G = mysql_query("select count(t1.takerisk_id) as sumG from mngrisk m1
                                            inner join takerisk t1 on t1.takerisk_id=m1.takerisk_id
                                        where admin_check='G' and t1.recycle='N' 
                                    and t1.take_date between '$date_start' and '$date_end' and mng_status='Y'");
                            $sum_rmG = mysql_fetch_assoc($sql_G);
                            $sql_Y = mysql_query("select count(t1.takerisk_id) as sumY from mngrisk m1
                                            inner join takerisk t1 on t1.takerisk_id=m1.takerisk_id
                                            where admin_check='Y' and t1.recycle='N'
                                    and t1.take_date between '$date_start' and '$date_end' and mng_status='Y'");
                            $sum_rmY = mysql_fetch_assoc($sql_Y);
                            $sql_R = mysql_query("select count(t1.takerisk_id) as sumR from mngrisk m1
                                            inner join takerisk t1 on t1.takerisk_id=m1.takerisk_id
                                            where admin_check='R' and t1.recycle='N'
                                    and t1.take_date between '$date_start' and '$date_end' and mng_status='Y'");
                            $sum_rmR = mysql_fetch_assoc($sql_R);
                            ?>
<?php if ($_SESSION['user_id'] != '') { ?>
    <div class="row">
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src='images/riskassist_icon.png' width="100">
                        </div><br>
                        <div class="col-xs-9 text-right">
                            <p class="announcement-heading"><b><font color="ffff00"><?= $sum_rm[sum]; ?></font></b></p>
                            
                        </div>
                        <div class="col-lg-12 text-right">
                        <p class="announcement-text"><font size="3">ความเสี่ยงทั้งหมด</font></p>
                        </div>
                    </div>
                </div>
                <a href="listRiskInBox4.php?id=1&year=<?= $YeaR ?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-9">
                                ดูรายละเอียด
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src='images/9c4eze7ni.png' width="80">
                        </div><br>
                        <div class="col-xs-9 text-right">
                            <p class="announcement-heading"><b><font color="fff109"><?= $sum_rmD[sumD]; ?></font></b></p>
                            <p class="announcement-text">
                                <font size="3">รอทบทวน</font></p>
                        </div>
                    </div>
                </div>
                <a href="listRiskInBox4.php?id=2&year=<?= $YeaR?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-9">
                                ดูรายละเอียด
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src='images/risk-icon.png' width="80">
                        </div><br>
                        <div class="col-xs-9 text-right">
                            <p class="announcement-heading"><b><font color="fff109"><?= $sum_rmD2[sumD2]; ?></font></b></p>
                            <p class="announcement-text">
                                <font size="3">รอประเมิน</font>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="listRiskInBox4.php?id=6&year=<?= $YeaR?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-9">
                                ดูรายละเอียด
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src='images/RepairIcon.png' width="80">
                        </div><br>
                        <div class="col-xs-9 text-right">
                            <p class="announcement-heading"><b><font color="fff109"><?= $sum_rmY[sumY]; ?></font></b></p>
                            <p class="announcement-text">
                                <font size="3">กำลังดำเนินการ</font>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="listRiskInBox4.php?id=3&year=<?= $YeaR?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-9">
                                ดูรายละเอียด
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src='images/close.ico' width="80">
                        </div><br>
                        <div class="col-xs-9 text-right">
                            <p class="announcement-heading"><b><font color="fff109"><?= $sum_rmR[sumR]; ?></font></b></p>
                            <p class="announcement-text">
                                <font size="3">ทบทวนซ้ำ</font>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="listRiskInBox4.php?id=4&year=<?= $YeaR?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-9">
                                ดูรายละเอียด
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <img src='images/tick.png' width="80">
                        </div><br>
                        <div class="col-xs-9 text-right">
                            <p class="announcement-heading"><b><font color="ffff00"><?= $sum_rmG[sumG]; ?></font></b></p>
                            <p class="announcement-text">
                                <font size="3">ผ่านประเมิน</font>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="listRiskInBox4.php?id=5&year=<?= $YeaR?>">
                    <div class="panel-footer announcement-bottom">
                        <div class="row">
                            <div class="col-xs-9">
                                ดูรายละเอียด
                            </div>
                            <div class="col-xs-3 text-right">
                                <i class="fa fa-arrow-circle-right"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div><!-- /.row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Traffic Statistics:                 
                        <?php
                        include_once ('funcDateThai.php');
                        
                        $d_start = 01;
                        $m_start = 01;
                        $d = date("d");
                        if ($_POST[year] == '') {
                            if($date >= $bdate and $date <= $edate){
                             $y= $Yy;
                             $Y= date("Y");
                            }else{
                            $y = date("Y");
                            $Y = date("Y") - 1;
                            }
                        } else {
                            $y = $_POST[year] - 543;
                            $Y = $y - 1;
                        }
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                        echo $date_start = DateThai1($date_start); //-----แปลงวันที่เป็นภาษาไทย
                        echo " ถึง ";
                        echo $date_end = DateThai2($date_end); //-----แปลงวันที่เป็นภาษาไทย
                        ?>	</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="" enctype="multipart/form-data" class="navbar-form navbar-right">
                        <div class="form-group"> 
                            <select name='year'  class="form-control">
                                <option value=''>กรุณาเลือกปีงบประมาณ</option>
                                <?php
                                for ($i = 2557; $i <= 2565; $i++) {
                                    echo "<option value='$i'>$i</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">ตกลง</button> 						
                    </form>
                    <?php
                    if ($_POST[year] == '') {
                        if($date >= $bdate and $date <= $edate){
                          $year = $Yy;
                        $years = $year + 543;      
                            }else{
                        $year = date('Y');
                        $years = $year + 543;
                        
                            }
                    } else {
                        $year = $_POST[year] - 543;
                        $years = $year + 543;
                    }

                    echo "<center>";



                    echo "รายงานความเสี่ยง : ทั้งหมด";
                    echo "&nbsp;&nbsp;";
                    echo "ปีงบประมาณ : $years";
                    echo "</center>";

                    $month_start = "$Y-10-01";
                    
                    $month_end = "$y-09-30";
                    $I = 10;
                    
                    $num_category = mysql_query("select count(category) as count_cate from category");
                        $count_cate = mysql_fetch_assoc($num_category);
                        $count_categ = $count_cate['count_cate'];
                        
                        for ($c = 1; $c <= $count_categ; $c++) {
                            $sql_name = mysql_query("select name from category where category='$c'");
                        $cat_name = mysql_fetch_assoc($sql_name);
                            $cate_name[$c].= $cat_name['name'];
                        }
                     
                    for ($i = -2; $i <= 9; $i++) {

                        $sqlMonth = mysql_query("select * from month where m_id='$i'");
                        $month = mysql_fetch_assoc($sqlMonth);

                        if ($i <= 0) {
                            $month_start = "$Y-$I-01";
                            $month_end = "$Y-$I-31";
                            /* if(date("Y-m-d")=="$y-$I-$d"){
                              $month_start = "$y-$I-01";
                              $month_end = "$y-$I-31";
                              } */
                        } elseif ($i >= 1 and $i <= 9) {
                            $month_start = "$year-0$i-01";
                            $month_end = "$year-0$i-31";
                        } else {
                            $month_start = "$year-$i-01";
                            $month_end = "$year-$i-31";
                        }

                        $month_start;
                        echo "&nbsp;&nbsp;";
                        $month_end;
                        
                        $sql_name = mysql_query("select name from category");
                        
                        
                        for ($c = 1; $c <= $count_categ; $c++) {
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
                        $(function() {
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
                                        enabled: true,
                                        formatter: function() {
                                            return '<b>' + this.series.name + '</b><br/>' +
                                                    this.x + ': ' + this.y + '';
                                        }
                                    },
                                    plotOptions: {
                                        line: {
                                            dataLabels: {
                                                enabled: true
                                            },
                                            enableMouseTracking: true
                                        }
                                    },
                                    series: [
                                    <?php for ($c = 1; $c <= $count_categ; $c++) {?>
                                    {
                                        
                                            name: '<?= $cate_name[$c]?>',
                                            data: [<? echo $countnum[$c] ?>]
                                        },
                                    <?php }?>
                                    ]
                                });
                            });

                        });


                    </script>
                    </head>
                    <body>

                        <div id="container" style="margin: 0 auto"></div>



                        <SCRIPT language=JavaScript>
                            var OldColor;
                            function popNewWin(strDest, strWidth, strHeight) {
                                newWin = window.open(strDest, "popup", "toolbar=no,scrollbars=yes,resizable=yes,width=" + strWidth + ",height=" + strHeight);
                            }
                            function mOvr(src, clrOver) {
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
                                if (event.srcElement.tagName == 'TD') {
                                    src.children.tags('A')[0].click();
                                }
                            }
                        </SCRIPT>
                
            <div class="row clearfix">
				
			<div class="row clearfix">
            <!-- InstanceBeginEditable name="EditRegion1" -->
				<div class="col-md-12 column">
                <?PHP
                        if ($_POST[year] == '') {
                            if($date >= $bdate and $date <= $edate){
                             $y= $Yy;
                             $Y= date("Y");
                            }else{
                            $y = date("Y");
                            $Y = date("Y") - 1;
                            }
                        } else {
                            $y = $_POST[year] - 543;
                            $Y = $y - 1;
                        }
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                    $sql = mysql_query("select count(t1.takerisk_id) as pp, c1.name as dd from takerisk t1
inner join category c1 on t1.category=c1.category
where t1.category=c1.category and t1.recycle='N' and   t1.take_date between '$date_start' and '$date_end' and t1.move_status='N' 
group by t1.category ORDER BY pp DESC");
                    ?>
                    <script type="text/javascript" src="report_rm/jquery.js"></script>
                    <script type="text/javascript">
                        $(function () {
                            var chart;
                            $(document).ready(function () {
                                chart = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'contain',
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                    },
                                    title: {
                                        text: 'ความเสี่ยงแยกตามด้านในปีงบประมาณ <?= $years ?>'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                                        percentageDecimals: 1
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                color: '#000000',
                                                connectorColor: '#000000',
                                                formatter: function () {
                                                    return '<b>' + this.point.name + '</b>: ' + this.y + ' ครั้ง';
                                                }
                                            }
                                        }
                                    },
                                    series: [{
                                            type: 'pie',
                                            name: 'เกิดขึ้น',
                                            data: [<?php
                while ($row = mysql_fetch_array($sql)) {
                    $depnamex = $row[dd];
                    $countx = $row[pp];
                    $sss = "['" . $depnamex . "'," . $countx . "],";
                    echo $sss;
                }
                ?>
                                            ]
                                        }]
                                });
                            });

                        });
                    </script>


                    <div class="col-lg-7 well-sm" id="contain" style="margin: 0 auto"></div></div>
                                    <div class="col-md-12 column">
                <?PHP
                if ($_POST[year] == '') {
                    if($date >= $bdate and $date <= $edate){
                             $y= $Yy;
                             $Y= date("Y");
                            }else{
                            $y = date("Y");
                            $Y = date("Y") - 1;
                            }
                        } else {
                            $y = $_POST[year] - 543;
                            $Y = $y - 1;
                        }
                        $date_start = "$Y-10-01";
                        $date_end = "$y-09-30";
                    $sql = mysql_query("SELECT COUNT( takerisk_id ) AS pp, level_risk AS dd
FROM takerisk 
WHERE recycle =  'N' and  level_risk!='' and take_date between '$date_start' and '$date_end' and move_status='N'
GROUP BY level_risk
ORDER BY pp DESC");
                    ?>
                    <script type="text/javascript" src="report_rm/jquery.js"></script>
                    <script type="text/javascript">
                        $(function () {
                            var chart;
                            $(document).ready(function () {
                                chart = new Highcharts.Chart({
                                    chart: {
                                        renderTo: 'cont',
                                        plotBackgroundColor: null,
                                        plotBorderWidth: null,
                                        plotShadow: false,
                                    },
                                    title: {
                                        text: 'ความเสี่ยงแยกตามระดับความรุนแรงในปีงบประมาณ <?= $years ?>'
                                    },
                                    tooltip: {
                                        pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                                        percentageDecimals: 1
                                    },
                                    plotOptions: {
                                        pie: {
                                            allowPointSelect: true,
                                            cursor: 'pointer',
                                            dataLabels: {
                                                enabled: true,
                                                color: '#000000',
                                                connectorColor: '#000000',
                                                formatter: function () {
                                                    return '<b>' + this.point.name + '</b>: ' + this.y + ' ครั้ง';
                                                }
                                            }
                                        }
                                    },
                                    series: [{
                                            type: 'pie',
                                            name: 'เกิดขึ้น',
                                            data: [<?php
                while ($row = mysql_fetch_array($sql)) {
                    $depnamex = $row[dd];
                    $countx = $row[pp];
                    $sss = "['" . $depnamex . "'," . $countx . "],";
                    echo $sss;
                }
                ?>
                                            ]
                                        }]
                                });
                            });

                        });
                    </script>


                    <div class="col-lg-5 well-sm" id="cont" style="margin: 0 auto"></div></div>
                        </div>
            </div>
                        </div>
            </div>
        </div>
    </div><!-- /.row -->
    <p></p>
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-calendar"></i>  Statistics :
                        <?php
                        echo DateThai1($date_start); //-----แปลงวันที่เป็นภาษาไทย
                        echo " ถึง ";
                        echo DateThai1($date_end); //-----แปลงวันที่เป็นภาษาไทย
                        ?>								
                    </h3>					 
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped tablesorter">
                            <thead>
                                <tr>
                                    <TH><CENTER>ลำดับ <i class="fa fa-sort"></i></CENTER></TH>
                            <TH><CENTER>เดือน <i class="fa fa-sort"></i></CENTER> </TH>
                            <TH><CENTER>จำนวนเรื่อง <i class="fa fa-sort"></i></CENTER></TH>
                            </tr> 
                            </thead>

                            <?php
                            $c=1;
                            $I = 10;
                    for ($i = -2; $i <= 9; $i++) {

                        $sqlMonth = mysql_query("select * from month where m_id='$i' order by m_id desc");
                        $month = mysql_fetch_assoc($sqlMonth);

                        if ($i <= 0) {
                            $month_start = "$Y-$I-01";
                            $month_end = "$Y-$I-31";
                            /* if(date("Y-m-d")=="$y-$I-$d"){
                              $month_start = "$y-$I-01";
                              $month_end = "$y-$I-31";
                              } */
                        } elseif ($i >= 1 and $i <= 9) {
                            $month_start = "$year-0$i-01";
                            $month_end = "$year-0$i-31";
                        } else {
                            $month_start = "$year-$i-01";
                            $month_end = "$year-$i-31";
                        }


                                if ($category != '' and $year == '') {
                                    $sql = mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.category='$category' and t1.move_status='N'   group by c1.category order by number_risk DESC");
                                } else if ($category == '' and $year != '') {
                                    $sql = mysql_query("select count(takerisk_id) as number_risk
		 from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' order by number_risk DESC");
                                } else if ($category != '' and $year != '') {
                                    $sql = mysql_query("select count(takerisk_id) as number_risk ,c1.category
		 from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where  t1.category='$category'   and t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' group by c1.category order by number_risk DESC");
                                } else if ($category == '' and $year == '') {
                                    $sql = mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 where     t1.take_date between '$month_start' and '$month_end' and t1.move_status='N' order by number_risk DESC");
                                }


                                $rs = mysql_fetch_assoc($sql);
                                ?>	
                                <?php if ($category == '') { ?>


                                    <tr> 
                                        <TD><CENTER><?php echo $c; ?></CENTER></TD>
                        <?if($i <= 0){?>
                                    <TD><?php echo $month[month_name]; ?></TD>
                                    <TD> <CENTER><?php echo $rs[number_risk]; ?></a></CENTER></TD>
                        <?}else{?>
                                    <TD><?php echo $month[month_name]; ?></TD>
                                    <TD> <CENTER><?php echo $rs[number_risk]; ?></a></CENTER></TD>
                        <?}?>
                                    </TR>


                                    <?php
                                } //end category null	
                                else {
                                    ?>
                                    <tr bgcolor=<?= $bg ?> onMouseOver="mOvr(this,'#DEF8F0');" onclick=mClk(this); onmouseout=mOut(this); >
                                        <TD><CENTER><?php
                                        if ($rs[category] == '') {
                                            echo "<p>" . $i;
                                            ?></CENTER><?php } else { ?><a href='main_report2.php?category=<?= $rs[category] ?>&&mng_status=<?= $mng_status ?>&&take_date1=<?= $month_start ?>&&take_date2=<?= $month_end ?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $i; ?><?php } ?></CENTER></a></TD>
                                    <TD><?php
                                        if ($rs[category] == '') {
                                            echo "<p>" . $month[month_name];
                                            ?></CENTER><?php } else { ?><a href='main_report2.php?category=<?= $rs[category] ?>&&mng_status=<?= $mng_status ?>&&take_date1=<?= $month_start ?>&&take_date2=<?= $month_end ?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $month[month_name]; ?></a><?php } ?></TD>
                                    <TD><?php
                            if ($rs[category] == '') {
                                echo "<p align='right'>" . '0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>';
                                            ?><?php } else { ?><p align="right"><a href='main_report2.php?category=<?= $rs[category] ?>&&mng_status=<?= $mng_status ?>&&take_date1=<?= $month_start ?>&&take_date2=<?= $month_end ?>&&type=1' title='ดูรายงานแยกหน่วยงาน'><?php echo $rs[number_risk]; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p><?php } ?></TD>
                                    </TR>
        <?php } ?>
                                   
    <?php  $c++;$I++; } ?>
                        </TABLE>
                        <!--<div class="text-right">
                          <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div> 
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o"></i> User Online</h3>
                </div>
                <div class="panel-body">
                    <div class="list-group">
                        <?php
                        include'timeLoginFacebook.php';
                        $user_id = $_SESSION[user_id];
                        $sql = mysql_query("select * from user   order by time_login  DESC LIMIT 12");
                        while ($result = mysql_fetch_assoc($sql)) {
                            $result[date_login];
                            $result[time_login];
                            $Format = date("d M Y H:i");
                            $Timestamp = $result[time_login];
                            $Language = "th";
                            $TimeText = "true";
                            $time = generate_date_today("d M Y H:i", ($Timestamp), "th", true);
                            ?>
                            <a href="#" class="list-group-item">
                                <span class="badge"><?php echo $time; ?></span>
                                <i class="fa fa-user"></i> <?php echo $result[user_fname] . ' ' . $result[user_lname]; ?>
                            </a>
    <?php } // end time login    ?>   
                    </div>
                    <!-- <div class="text-right">
                       <a href="#">View All <i class="fa fa-arrow-circle-right"></i></a>
                     </div> -->
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-star"></i> ผู้เขียนความเสี่ยงสูงสุด TOP 10 </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table>
                            <form action='' name='person' method='post'>
                                <tr><td width=10%>ตั้งแต่</td><td><input type='date' name='date1'></td><td>&nbsp;</td> </tr><tr><td>ถึง</td><td><input type='date' name='date2'></td> <td><input type=submit value='ตกลง'></td> </tr>	
                            </form name='person'>	
                        </table>
                        <table class="table table-bordered table-hover table-striped tablesorter">
                            <thead>
                                <tr>
                                    <th># <i class="fa fa-sort"></i></th>
                                    <th>ชื่อ - นามสกุล <i class="fa fa-sort"></i></th>
                                    <th>จำนวนเรื่อง <i class="fa fa-sort"></i></th>
                                </tr>

                            </thead>
                            <tbody>
                                <?php
                                $monthlast = $_POST[date1];
                                $monthnow = $_POST[date2];
                                //$ex2=explode("-",$monthlast); 
                                //$monthlast="$ex2[0]-$ex2[1]-01";							
                                if ($monthlast == '' and $monthnow == '') {
                                    echo "แสดงทั้งหมด";
                                    $sql2 = mysql_query("select count(t2.takerisk_id) as count_risk  ,concat(u1.user_fname,'  ',u1.user_lname) AS user
								from user  u1 
								LEFT OUTER JOIN takerisk t2 on u1.user_id = t2.user_id
                                                                where  recycle='N' and subcategory!='' and subcategory!='' and t2.move_status='N' and t2.take_date between '$date_start' and '$date_end'
								group by u1.user_id order by count_risk desc limit 10");
                                } else {
                                    echo "$monthlast ถึง $monthnow";
                                    $sql2 = mysql_query("select count(t2.takerisk_id) as count_risk  ,concat(u1.user_fname,'  ',u1.user_lname) AS user
								from user  u1 
								LEFT OUTER JOIN takerisk t2 on u1.user_id = t2.user_id 
								where recycle='N' and subcategory!='' and subcategory!='' and t2.move_status='N' and t2.take_date between '$monthlast' and  '$monthnow'
								group by u1.user_id order by count_risk desc limit 10");
                                }//======== end check date=null 
                                $i = 1;
                                while ($rs = mysql_fetch_assoc($sql2)) {
                                    ?>       
                                    <tr>
                                        <td><center><?php echo $i; ?></center></td>
                                <td><?php echo $rs[user]; ?></td>
                                <td><center><?php echo $rs[count_risk]; ?></center></td>
                                </tr>
                                <tr>
        <?php
        $i++;
    } // end while $sql2 
    ?>
                                </tbody>
                        </table>
                    </div>
                    <!--  <div class="text-right">
                        <a href="#">View All <i class="fa fa-arrow-circle-right"></i></a>
                      </div> -->
                </div>
            </div>
        </div>
    </div><!-- /.row -->
<? } else { ?>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="images/king1.jpg" width="100%" alt="...">
                <div class="carousel-caption">
                    โรงพยาบาลจิตเวชเลยราชนครินทร์
                </div>
            </div>
            <div class="item">
                <img src="images/king2.jpg" width="100%" alt="...">
                <div class="carousel-caption">
                    โรงพยาบาลจิตเวชเลยราชนครินทร์
                </div>
            </div>
            <div class="item">
                <img src="images/king3.jpg" width="100%" alt="...">
                <div class="carousel-caption">
                    โรงพยาบาลจิตเวชเลยราชนครินทร์
                </div>
            </div>
            <div class="item">
                <img src="images/king4.jpg" width="100%" alt="...">
                <div class="carousel-caption">
                    โรงพยาบาลจิตเวชเลยราชนครินทร์
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
         <!-- <span class="fa fa-chevron-left" aria-hidden="true"></span>-->
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
          <!--<span class="fa fa-chevron-right" aria-hidden="true"></span>-->
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php } ?>
<?php include 'footer.php'; ?>


