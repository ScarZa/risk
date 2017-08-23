<?php @session_start(); ?>
<?php include 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>ระบบบริหารความเสี่ยงโรงพยาบาล</title>
        <LINK REL="SHORTCUT ICON" HREF="./images/logo.png">
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">
        <!-- Add custom CSS here -->
        <link href="css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
        <!-- Page Specific CSS -->
        <link rel="stylesheet" href="css/morris-0.4.3.min.css">
        <link rel="stylesheet" href="css/stylelist.css">
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/excellentexport.js"></script>

        <!-- InstanceBeginEditable name="head" -->
        <script language="javascript" src="chart/FusionCharts/FusionCharts.js"></script>
<!--<style type="text/css">
html{
-moz-filter:grayscale(100%);
-webkit-filter:grayscale(100%);
filter:gray;
filter:grayscale(100%);
}
</style>-->
<style type="text/css">
.black-ribbon {   position: fixed;   z-index: 9999;   width: 70px; }
@media only all and (min-width: 768px) { .black-ribbon { width: auto; } }

.stick-left { left: 0; }
.stick-right { right: 0; }
.stick-top { top: 0; }
.stick-bottom { bottom: 0; }
</style>
        <script type="text/javascript">
                        function popup(url,name,windowWidth,windowHeight){    
                                        myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
                                        mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
                                        properties = "width="+windowWidth+",height="+windowHeight;
                                        properties +=",scrollbars=yes,resizable=no,toolbar=no, top="+mytop+",left="+myleft;   
                                        window.open(url,name,properties);
                }
        </script>
        <script type="text/javascript">
            function resizeIframe(obj)// auto height iframe
            {
                {
                    obj.style.height = 0;
                }
                ;
                {
                    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
                }
            }
        </script>
        <script type="text/javascript">
            $(document).ready(function () {

                $('a[id^="chart"]').fancybox({
                    'width': 1000,
                    'height': 1300,
                    'autoScale': false,
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'type': 'iframe',
                    /*afterClose	:	function() {
                     parent.location.reload(true); 
                     }*/
                });
                $('a[id^="chart3"]').fancybox({
                    'width': 1000,
                    'height': 1300,
                    'autoScale': false,
                    'transitionIn': 'fade',
                    'transitionOut': 'fade',
                    'type': 'iframe',
                    /*afterClose	:	function() {
                     parent.location.reload(true); 
                     }*/
                });
            });
        </script>
        <script type="text/javascript">
            function getRefresh() {
                $("#auto").show("slow");
                $("#autoRefresh").load("count_risk.php", '', callback);
            }

            function callback() {
                $("#autoRefresh").fadeIn("slow");
                setTimeout("getRefresh();", 1000);
            }

            $(document).ready(getRefresh);
        </script>
        <script language="JavaScript">
            var HttPRequest = false;
            function doCallAjax(Sort) {
                HttPRequest = false;
                if (window.XMLHttpRequest) { // Mozilla, Safari,...
                    HttPRequest = new XMLHttpRequest();
                    if (HttPRequest.overrideMimeType) {
                        HttPRequest.overrideMimeType('text/html');
                    }
                } else if (window.ActiveXObject) { // IE
                    try {
                        HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                        }
                    }
                }
                if (!HttPRequest) {
                    alert('Cannot create XMLHTTP instance');
                    return false;
                }
                var url = 'count_risk.php';
                var pmeters = 'mySort=' + Sort;
                HttPRequest.open('POST', url, true);
                HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                HttPRequest.setRequestHeader("Content-length", pmeters.length);
                HttPRequest.setRequestHeader("Connection", "close");
                HttPRequest.send(pmeters);
                HttPRequest.onreadystatechange = function ()
                {
                    if (HttPRequest.readyState == 3)  // Loading Request
                    {
                        document.getElementById("mySpan").innerHTML = "Now is Loading...";
                    }
                    if (HttPRequest.readyState == 4) // Return Request
                    {
                        document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
                    }
                }
            }
        </script>
        
    
    </head>

    <body Onload="bodyOnload();">
                <!-- Top Left -->
<img src="https://goo.gl/Yl6KNg" class="black-ribbon stick-top stick-left"/>
        <div id="wrapper">
            <!-- Sidebar -->
            <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
//===ชื่อโรงพยาบาล
                    $sql = mysql_query("select * from  hospital");
                    $resultHos = mysql_fetch_assoc($sql);
                    ?>
                    <a class="navbar-brand" href="index.php?unset=1"><font color='#fedd00'><b>RM - JV System v.1.3 </b></font><!--ระบบบริหารความเสี่ยง <? echo $resultHos['name']; ?>--></a>
                </div>
                <?php
                if ($_SESSION['user_id'] != '') {
                    $sqlUser = mysql_query("select admin from user where user_id='$user_id' ");
                    $resultUser = mysql_fetch_assoc($sqlUser);
                    $admin = $_SESSION[admin];
                }
                ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">

                    <ul class="nav  navbar-custom navbar-nav side-nav">
                        <li><a href="index.php?unset=1"><i class="fa fa-home"></i> หน้าหลัก</a></li> 		
                        <?php if ($_SESSION['user_id'] != '') { ?>
                            <li><a href="frmBeforeWriteRisk.php?unset=1"><i class="fa fa-edit"></i> เขียนความเสี่ยง</a></li>
                            <?php if ($admin == 'A') { ?>
                                <li><a href="listRiskInBox2.php?unset=1"><i class="fa fa-envelope"></i> ความเสี่ยงของฝ่าย</a></li>
                                <? } ?>
                                <li><a href="listRiskInBox.php?unset=1"><i class="fa fa-envelope"></i> ความเสี่ยงที่ได้รับ</a></li>
                                <li><a href="listRiskDepWrite.php?lookdep=true&unset=1"><i class="fa fa-bookmark-o"></i> ประวัติการรายงานความเสี่ยง</a></li>
                            <?php } //$_SESSION['user_id']!=''  ?>
                            <?php if ($admin == 'Y') { ?>
                                <!--<li><a href="prac_fullcalendar.php"><i class="fa fa-calendar"></i> ปฏิทินความเสี่ยง</a></li>-->
                                <li><a href="listRiskInBox3.php?unset=1"><i class="fa fa-envelope"></i> ความเสี่ยงทั้งหมด/ติดตามประเมินผล</a></li>
                                <li><a href="changeRisk.php?unset=1"><i class="fa fa-bell"></i> รายการแจ้งย้ายความเสี่ยง</a></li>
                                <li><a href="listRiskRecycle.php?unset=1"><i class="fa fa-trash-o"></i> รายการความเสี่ยงในถังขยะ</a></li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> รายงานของคณะกรรมการ <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="report.php?type=1"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>หน่วยงานที่รายงาน</a></li>
                                        <li><a href="report.php?type=9"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>หน่วยงานที่เกี่ยวข้อง</a></li>
                                        <li><a href="report.php?type=2"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>จำแนกด้าน</a></li>
                                        <li><a href="report.php?type=3"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>จำแนกรายเดือน</a></li>
                                        <li><a href="report.php?type=4"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>แยกตามด้านความเสี่ยง<br>แต่ละเดือน</a></li>               
                                        <li><a href="Recurrence_risk.php?unset=1"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>สรุปความเสี่ยงทั้งหมด</a></li> 
                                        <!--<li><a href="report.php?type=5"><i class="fa fa-bar-chart-o"></i> จำนวนความเสี่ยง<br>ที่เกิดขึ้นซ้ำ</a></li>-->
                                        <li><a href="level_report.php?unset=1"><i class="fa fa-bar-chart-o"></i> จำนวนความเสี่ยง<br>ตามระดับความรุนแรง</a></li> 
                                        <li><a href="session_search.php?pct=Y"><i class="fa fa-bar-chart-o"></i> ความเสี่ยงเกี่ยวกับทีม PCT</a></li> 
                                        <li><a href="session_search.php?ic=Y"><i class="fa fa-bar-chart-o"></i> ความเสี่ยงเกี่ยวกับทีม IC</a></li> 
                                        <li><a href="main_department_report.php?type=6&unset=1"><i class="fa fa-bar-chart-o"></i> หน่วยงานที่เขียนความเสี่ยง</a></li>
                                    </ul>            
                                </li>           
                            <?php } //admin = Y 
                            if ($admin == 'A') {?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> รายงานของฝ่ายงาน <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                       <li><a href="Recurrence2_risk.php?unset=1"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>ความเสี่ยงทั้งหมด</a></li> 
                                       <li><a href="main_dep_report.php?unset=1"><i class="fa fa-bar-chart-o"></i> รายงานความเสี่ยง :<br>หน่วยงานที่เกี่ยวข้อง</a></li>
                                    </ul>
                                </li>
                            <?php } 
                            if ($_SESSION['user_id'] != '') { ?>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bar-chart-o"></i> รายงานของหน่วยงาน <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="report.php?type=6"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>ความเสี่ยงที่เขียน</a></li>
                                        <li><a href="report.php?type=10"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>ความเสี่ยงที่เกี่ยวข้อง</a></li>
                                        <li><a href="report.php?type=7"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>ความเสี่ยงที่เขียน<br>จำแนกรายเดือน</a></li>
                                        <li><a href="report.php?type=8"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>แยกตามด้านความเสี่ยง<br>แต่ละเดือน</a></li>
                                        <li><a href="Recurrence_risk.php?id=1&unset=1"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>ความเสี่ยงทั้งหมด</a></li>
                                        <!--<li><a href="report.php?type=5"><i class="fa fa-bar-chart-o"></i> สรุปความเสี่ยง :<br>จำนวนความเสี่ยงซ้ำ</a></li>-->
                                        <li><a href="main_department_report_user.php?unset=1"><i class="fa fa-bar-chart-o"></i> บุคลากรในหน่วยงาน<br>ที่เขียนความเสี่ยง</a></li>
                                    </ul>            
                                </li>
                            <?php } //$_SESSION['user_id']!=''  ?>
         <!--  <li><a href="tables.html"><i class="fa fa-table"></i> Tables</a></li>  -->
        <!--  <li><a href="bootstrap-elements.html"><i class="fa fa-desktop"></i> Bootstrap Elements</a></li> --> 
                            <?php if ($admin == 'Y') { ?>   
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog fa-spin"></i> ตั้งค่า <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="frmHospital.php?unset=1"><i class="fa fa-cog fa-spin"></i> โรงพยาบาล</a></li>
                                        <li><a href="frmDepartment.php?unset=1"><i class="fa fa-cog fa-spin"></i> ฝ่าย/ศูนย์/กลุ่มงาน</a></li>
                                        <li><a href="frmUser.php?unset=1"><i class="fa fa-cog fa-spin"></i> ผู้ใช้งาน</a></li>
                                        <li><a href="frmPlace.php?unset=1"><i class="fa fa-cog fa-spin"></i> สถานที่เกิดเหตุ</a></li>
                                        <li><a href="frmCategory.php?unset=1"><i class="fa fa-cog fa-spin"></i> หมวดความเสี่ยง</a></li>
                                        <li><a href="frmSubCategory.php?unset=1"><i class="fa fa-cog fa-spin"></i> รายการความเสี่ยง</a></li>
                                        <li><a href="backup.php" onclick="return confirm('กรุณายืนยันการสำรองข้อมูลอีกครั้ง !!!')"><i class="fa fa-cog fa-spin"></i> สำรองข้อมูล</a></li>
                                        <li><a href="#" onClick="window.open('openDB.php','','width=400,height=350'); return false;" title="ข้อมูลสำรอง"><i class="fa fa-cog fa-spin"></i> DataBase</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" onclick="window.open('form-format/manual_risk(admin).pdf','','width=750,height=1000'); return false;"><i class="fa fa-book"></i> คู่มือโปรแกรมความเสี่ยง</a></li>
                            <?php } //admin = Y ?> 
                            <?php if ($_SESSION['user_id'] == '') { ?>    
                            <li><a href="knowledge.php"><i class="fa fa-file"></i> ความรู้เกี่ยวกับความเสี่ยง</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-download"></i> ดาวน์โหลดแบบฟอร์ม <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="form-format/RM 1.doc"><i class="fa fa-download"></i> แบบรายงานอุบัติการณ์ความเสี่ยง</a></li>
                                    <li><a href="form-format/RCA.doc"><i class="fa fa-download"></i> แบบฟอร์ม RCA</a></li>
                                </ul>
                            </li>
                            <li><a href="#" onclick="window.open('form-format/manual_risk.pdf','','width=750,height=1000'); return false;"><i class="fa fa-book"></i> คู่มือโปรแกรมความเสี่ยง</a></li>
                            <?php } ?>
                            <li><a href="#">&nbsp;</a></li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right navbar-user">
                            <?php
                            if ($_SESSION[user_id] != '') {
                                ?>
                                <li class="dropdown messages-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> ความเสี่ยงใหม่ <span class="badge" id="autoRefresh">    
                                            <?php
                                            $user_dep = $_SESSION[user_dep_id];
                                            $sql = mysql_query("select count(m1.mngrisk_id) AS inbox from mngrisk m1 
                LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id = m1.takerisk_id 
                WHERE t1.res_dep = '$user_dep' and t1.move_status='N' and m1.mng_status='N' and t1.recycle='N' limit 25");
                                            $result = mysql_fetch_assoc($sql);
                                            echo $inbox = $result[inbox];
                                            ?></span> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"><font color="#333333"><?php echo $inbox; ?> New Messages</font></li>
                                        <?php
                                        $user_dep = $_SESSION[user_dep_id];
                                        $sql = mysql_query("select s1.name  as sub_name , t1.takerisk_id , t1.take_file1 , t1.take_rec_date,LEFT(t1.take_detail,50)  AS detail  from mngrisk m1 
                LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id = m1.takerisk_id 
                LEFT OUTER JOIN subcategory s1 ON t1.subcategory = s1.subcategory 
                WHERE t1.res_dep = '$user_dep' and t1.move_status='N' and m1.mng_status='N' 
                ORDER BY m1.mngrisk_id DESC limit 25");
                                        echo mysql_error();

                                        while ($result = mysql_fetch_assoc($sql)) {
                                            ?> 
                                            <li class="message-preview">
                                                <a href="detailRiskInBox.php?takerisk_id=<?php echo $result[takerisk_id]; ?>" title="New Messages">
                                                    <?php if(!empty($result[take_file1])){?>
                                                    <span class="avatar"><img src="myfile/<?= $result[take_file1]; ?>" width="50" height="50"></span>
                                                    <?php }?>
                                                    <span class="name"><?php echo $result[sub_name]; ?>:</span>
                                                    <span class="message"><?php echo $result[detail]; ?>...</span>
                                                    <span class="time"><i class="fa fa-clock-o"></i> <?php
                                                        include_once ('funcDateThai.php');
                                                        echo DateThai1($result[take_rec_date]); //-----แปลงวันที่เป็นภาษาไทย                   
                                                        ?> 
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <?php
                                        } //end while
                                        ?>       
                                        <li><a href="listRiskInBox.php">ดูทั้งหมด <span class="badge"><?php echo $inbox; ?></span></a></li>
                                    </ul>

                                    <?php
                                } //end if
                                ?></li>

                            <?php
                            if ($admin == 'A') {
                                ?>
                                <li class="dropdown messages-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> ความเสี่ยงใหม่ของฝ่าย <span class="badge">    
                                            <?php
                                            $user_dep = $_SESSION[user_dep_id];
                                            $user_main_dep = $_SESSION[user_main_dep];
                                            $sql = mysql_query("select count(m1.mngrisk_id) AS inbox from mngrisk m1 
                LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id = m1.takerisk_id
                LEFT OUTER JOIN subcategory s1 ON t1.subcategory = s1.subcategory
                LEFT OUTER JOIN department d1 on t1.res_dep=d1.dep_id
                WHERE d1.main_dep='$user_main_dep' and m1.mng_status='N' and t1.recycle='N' and t1.move_status='N' ");
                                            $result = mysql_fetch_assoc($sql);
                                            echo $inbox = $result[inbox];
                                            ?></span> <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header"><?php echo $inbox; ?> New Messages</li>
                                        <?php
                                        $user_dep = $_SESSION[user_dep_id];
                                        $user_main_dep = $_SESSION[user_main_dep];
                                        $sql = mysql_query("select s1.name  as sub_name , t1.takerisk_id , t1.take_file1 , t1.take_rec_date,LEFT(t1.take_detail,50)  
                    AS detail  from mngrisk m1 
                LEFT OUTER JOIN takerisk t1 ON t1.takerisk_id = m1.takerisk_id 
                LEFT OUTER JOIN subcategory s1 ON t1.subcategory = s1.subcategory
                LEFT OUTER JOIN department d1 on t1.res_dep=d1.dep_id
                WHERE d1.main_dep='$user_main_dep' and m1.mng_status='N' and t1.move_status='N' 
                ORDER BY m1.mngrisk_id DESC   ");
                                        echo mysql_error();
                                        while ($result = mysql_fetch_assoc($sql)) {
                                            ?> 
                                            <li class="message-preview">
                                                <a href="detailRiskInBox.php?takerisk_id=<?php echo $result[takerisk_id]; ?>" title="New Messages">
                                                    <span class="avatar"><img src="myfile/<?= $result[take_file1]; ?>" width="50" height="50"></span>
                                                    <span class="name"><?php echo $result[sub_name]; ?>:</span>
                                                    <span class="message"><?php echo $result[detail]; ?>...</span>
                                                    <span class="time"><i class="fa fa-clock-o"></i> <?php
                                                        include_once ('funcDateThai.php');
                                                        echo DateThai1($result[take_rec_date]); //-----แปลงวันที่เป็นภาษาไทย                   
                                                        ?> 
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="divider"></li>
                                            <?php
                                        } //end while
                                        ?>       
                                        <li><a href="listRiskInBox2.php">ดูทั้งหมด <span class="badge"><?php echo $inbox; ?></span></a></li>
                                    </ul>

                                    <?php
                                } //end if
                                ?></li>

                            <?php
                            if ($_SESSION['user_id'] != '') {
                                $sqlUser = mysql_query("select admin from user where user_id='$user_id' ");
                                $resultUser = mysql_fetch_assoc($sqlUser);

                                if ($_SESSION[admin] == 'Y') { ?>
                                    
                                        <script language="JavaScript">
                                            function bodyOnload()
                                            {
                                                doCallAjax('CustomerID')
                                                setTimeout("doLoop();", 2000);
                                            }
                                            function doLoop()
                                            {
                                                bodyOnload();
                                            }
                                        </script>
                                        <li class="dropdown alerts-dropdown" id="mySpan"></li>
                                    <?php
                                }
                            }
                            ?>
                            <?PHP if ($_SESSION['user_id'] == '') { ?>            	
                                <li> 	
                                    <form class="navbar-form navbar-right" action='checkLogin.php' method='post'>
                                        <div class="form-group">
                                            <input type="text" placeholder="User Name" name='user_account' class="form-control" value='' required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" placeholder="Password" name='user_pwd' class="form-control"  value='' required>
                                        </div>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-lock"></i> Sign in</button> 
                                        <div class="form-group">
                                        </div>
                                    </form>
                                </li>
                            <?PHP } else { ?>



                                <li class="dropdown user-dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                                        <?php
                                        $user_id = $_SESSION[user_id];
                                        if ($user_id != '') {
                                            $sql = mysql_query("select concat(user_fname,' ',user_lname) AS name from user WHERE user_id='$user_id'");
                                            $result = mysql_fetch_assoc($sql);
                                            echo $result[name];
                                        }
                                        ?><b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                    <!--  <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                                      <li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">
                                      </span></a></li>
                                      <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>         
                                        --> 
                                        <li><a href="#" onClick="return popup('advert.php', popup, 500, 620);" title="เกี่ยวกับเรา"><img src='images/Paper Mario.ico' width='25'> เกี่ยวกับเรา</a></li>    
                                        <li class="divider"></li>
                                        <?php if ($_SESSION[user_dep_id] != '38') { ?>
                                        <li><a href="frmEditUser.php?user_id=<?= $_SESSION[user_id] ?>"><i class="fa fa-user"></i> แก้ไขข้อมูลส่วนตัว</a></li>
                                        <li class="divider"></li>
                                    <?php } ?>
                                        <li><a href="logout.php"><i class="fa fa-power-off"></i> Log Out</a></li>
                                </ul>
                                </form>
                            <?PHP } ?>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
            <?php include 'function/unset.php';?>
            <script src="js/jquery.min.js"></script>
            <script src="js/bootstrap.js"></script>
            <!--<script langauge="javascript">
                window.location.reload();
            </script>-->
            <div id="page-wrapper">
