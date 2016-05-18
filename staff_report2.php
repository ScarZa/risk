<?php include 'header.php'; ?>
<?
if (empty($_SESSION['user_id'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'/>";
    exit();
}
$ID = $_REQUEST[id];
$user_dep = $_SESSION[user_dep_id];
if ($ID == '') {
    ?>
    <h2>คณะกรรมการบริหารความเสี่ยง</h2>
<? } ?>
<H1><small>รายงานบุคคลากรที่เขียนความเสี่ยงทั้งหมด</small></H1>
<ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
    <li class="active"><a href="main_department_report.php"><i class="fa fa-envelope"></i> รายงานบุคคลากรที่เขียนความเสี่ยงทั้งหมด</a></li>
    <li class="active"><i class="fa fa-envelope"></i> รายงานบุคคลากรที่เขียนความเสี่ยงทั้งหมด</li>
</ol>
<?// if ($ID == '') {?>
<div class="alert alert-info alert-dismissable">
<div class="form-group" align="right"> 
    <form method="post" action="session_search.php" class="navbar-form navbar-right">
        <label> เลือกช่วงเวลา : </label>
        <div class="form-group">
            <input type="date"   name='check_date01' class="form-control" value='' > 
        </div>
        <div class="form-group">
            <input type="date"   name='check_date02' class="form-control" value='' >
        </div>
        <input type="hidden" name="checkdate" value="1">
        <button type="submit" class="btn btn-success">ตกลง</button>
    </form>
</div>
<br><? //}?><br></div>
<form role="search" action='session_search.php' method='post'  >
    <div class="form-group input-group">
        <input type='search' name='take_name' placeholder='ค้นหารายชื่อ...' value='' class="form-control" > 
        <input type='hidden' name='method'  value='take_name'> 
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-star"></i> รายงานผู้เขียนความเสี่ยงทั้งหมด</h3>
            </div>

            <div class="panel-body">
<?php

// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p, $plus_p, $total, $total_p, $chk_page) {
    global $e_page;
    global $querystr;

    $ID = $_REQUEST[id];
    $urlfile = "staff_report.php"; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
    $per_page = 10;
    $num_per_page = floor($chk_page / $per_page);
    $total_end_p = ($num_per_page + 1) * $per_page;
    $total_start_p = $total_end_p - $per_page;
    $pPrev = $chk_page - 1;
    $pPrev = ($pPrev >= 0) ? $pPrev : 0;
    $pNext = $chk_page + 1;
    $pNext = ($pNext >= $total_p) ? $total_p - 1 : $pNext;
    $lt_page = $total_p - 4;
    if ($chk_page > 0) {
        ?>  
                        <a  href="<?= $urlfile ?>?s_page=<?= $pPrev . $querystr ?>&&id=<?= $ID; ?>" class="naviPN">Prev</a>
                        <?
                    }
                    for ($i = $total_start_p; $i < $total_end_p; $i++) {
                        $nClass = ($chk_page == $i) ? "class='selectPage'" : "";
                        if ($e_page * $i <= $total) {
                            ?>
                            <a href="<?= $urlfile; ?>?s_page=<?= $i . $querystr; ?>&&id=<?= $ID; ?>" <?= $nClass; ?>  ><?= intval($i + 1); ?></a>  
                            <?
                        }
                    }
                    if ($chk_page < $total_p - 1) {
                        ?>
                        <a href="<?= $urlfile ?>?s_page=<?= $pNext . $querystr ?>&&id=<? $ID; ?>"  class="naviPN">Next</a>
                        <?
                    }
                }

                if ($ID == '') {
                    if($_SESSION[checkdate]!='1'){
                    if ($_SESSION[take_name] != '') {
                        $Search = trim($_SESSION[take_name]);
                        echo "แสดงคำที่ค้นหา : " . $Search;
//คำสั่งค้นหา
                        $q = "select concat(u1.user_fname,' ',u1.user_lname) as user,d1.name as dname,count(t1.takerisk_id) as numrisk
                            from takerisk t1 inner join user u1 on t1.user_id=u1.user_id
                            inner join department d1 on t1.take_dep=d1.dep_id
                            where t1.move_status='N' and t1.recycle='N' and u1.user_fname like '%$Search%'
                            group by t1.user_id order by t1.take_dep,numrisk desc ";
                    } else {
                        $q = "select concat(u1.user_fname,' ',u1.user_lname) as user,d1.name as dname,count(t1.takerisk_id) as numrisk
                            from takerisk t1 inner join user u1 on t1.user_id=u1.user_id
                            inner join department d1 on t1.take_dep=d1.dep_id
                            where t1.move_status='N' and t1.recycle='N'
                            group by t1.user_id order by t1.take_dep,numrisk desc";
                    }
             
                    }else{  
                        $date01=$_SESSION[check_date01];
                        $date02=$_SESSION[check_date02];
                        if ($_SESSION[take_name] != '') {
                        
                        $Search = trim($_SESSION[take_name]);
                        echo "แสดงคำที่ค้นหา : " . $Search;
                        
//คำสั่งค้นหา
                        $q = "select concat(u1.user_fname,' ',u1.user_lname) as user,d1.name as dname,count(t1.takerisk_id) as numrisk
                            from takerisk t1 inner join user u1 on t1.user_id=u1.user_id
                            inner join department d1 on t1.take_dep=d1.dep_id
                            where t1.move_status='N' and t1.recycle='N' and u1.user_fname like '%$Search%'
                            and t1.take_rec_date between '$date01' and '$date02'
                            group by t1.user_id order by t1.take_dep,numrisk desc";
                    } else {
                        
                        $q = "select concat(u1.user_fname,' ',u1.user_lname) as user,d1.name as dname,count(t1.takerisk_id) as numrisk
                            from takerisk t1 inner join user u1 on t1.user_id=u1.user_id
                            inner join department d1 on t1.take_dep=d1.dep_id
                            where t1.move_status='N' and t1.recycle='N'
                            and t1.take_rec_date between '$date01' and '$date02'
                            group by t1.user_id order by t1.take_dep,numrisk desc";
                    }}
                    
             
                }
                $qr = mysql_query($q);
                if ($qr == '') {
                    exit();
                }
                $total = mysql_num_rows($qr);

                $e_page = 10; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
                if (!isset($_GET['s_page'])) {
                    $_GET['s_page'] = 0;
                } else {
                    $chk_page = $_GET['s_page'];
                    $_GET['s_page'] = $_GET['s_page'] * $e_page;
                }
                $q.=" LIMIT " . $_GET['s_page'] . ",$e_page";
                $qr = mysql_query($q);
                if (mysql_num_rows($qr) >= 1) {
                    $plus_p = ($chk_page * $e_page) + mysql_num_rows($qr);
                } else {
                    $plus_p = ($chk_page * $e_page);
                }
                $total_p = ceil($total / $e_page);
                $before_p = ($chk_page * $e_page) + 1;
                echo mysql_error();
                ?>
                <div class="table-responsive">
                    <a class="btn btn-success" download="staff_report.xls" href="#" onClick="return ExcellentExport.excel(this, 'datatable', 'Sheet Name Here');">Export to Excel</a><br><br>
                    <? include_once ('funcDateThai.php');?>
                    <table id="datatable" class="table table-bordered table-hover table-striped tablesorter">
                        <? if($_SESSION[checkdate]=='1'){ ?>
                        <tr>
                            <th colspan="13"><center><? echo " ระยะเวลาระหว่างวันที่ : ". DateThai1($date01). " ถึง ". DateThai1($date02);?></center></th>
                        </tr>
                            <? }?>
                        <TR> 
                        <th width='7%'><CENTER><p>ลำดับ <i class="fa fa-sort"></i></p></CENTER></th>
                        <th width='25%'><CENTER><p>ชื่อบุคคลากร <i class="fa fa-sort"></i></p></CENTER></th>
                        <th width='15%'><CENTER><p>ฝ่ายงาน <i class="fa fa-sort"></i></p></CENTER></th>
                        <th width='5%'><CENTER><p>จำนวนเรื่อง </p></CENTER></th>
                        </TR>
<?
$i = 1;
while ($total_risk = mysql_fetch_assoc($qr)) {
    if ($bg == "#F4F4F4") { //ส่วนของการ สลับสี 
        $bg = "#FFFFFF";
    } else {
        $bg = "#F4F4F4";
    }
    ?>
                            <tr>
                                <td><center><?= ($chk_page * $e_page) + $i ?></center></td>
                            <td><?= $total_risk[user]; ?></td>
                            <td><center><?= $total_risk[dname]; ?></center></td>
                            <td><center><?= $total_risk[numrisk]; ?></center></td>
                            </tr>

    <?
    $i++;
}
?>

                    </table>
                </div>
            </div>
        </div>
<?php
if ($total > 0) {
    echo mysql_error();
    ?> 
            <div class="browse_page">

    <?php
    // เรียกใช้งานฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
    page_navigator($before_p, $plus_p, $total, $total_p, $chk_page);

    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size='2'>มีจำนวนทั้งหมด  <B>$total รายการ</B> จำนวนหน้าทั้งหมด ";
    echo $count = ceil($total / 10) . "&nbsp;<B>หน้า</B></font>";
}
?> 
        </div>    

<?php include 'footer.php'; ?>