<?php include 'header.php'; ?>
<?php
if (empty($_SESSION['user_id'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'/>";
    exit();
}
 $ID = $_REQUEST[id];
$user_dep = $_SESSION[user_dep_id];
if ($ID == '') {
    ?>
    <h2>คณะกรรมการบริหารความเสี่ยง</h2>
<?php } 
 $main_dep=$_SESSION[user_main_dep];?>
    
<H1><small>รายงานความเสี่ยงที่ได้รับทั้งหมด</small></H1>
<ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
    <li class="active"><i class="fa fa-envelope"></i> รายงานความเสี่ยงที่ได้รับทั้งหมด</li>
</ol>

<div class="alert alert-info alert-dismissable">
<div class="form-group" align="right"> 
    <form method="post" action="session_search.php" class="navbar-form navbar-right">
        <label> เลือกช่วงเวลา : </label>
        <div class="form-group">
            <input type="date"   name='take_date1' class="form-control" value='' > 
        </div>
        <div class="form-group">
            <input type="date"   name='take_date2' class="form-control" value='' >
        </div>
        <label> เลือกหน่วยงาน :</label>
        <div class="form-group">
            <select name="dep" class="form-control listbox1" id="dep" tabindex="1" onChange="buttomevent(0).checked = true;">
                <option value="">...เลือกหน่วยงาน...</option>
                <?php
                $selec_cate = "select * from department d1 inner join department_group d2 on d2.main_dep=d1.main_dep where d1.main_dep='$main_dep'";
                $dbquery = mysql_query($selec_cate);
                $num_rows = mysql_num_rows($dbquery);
                $i = 0;
                while ($i < $num_rows) {
                    $result = mysql_fetch_array($dbquery);
                    $pre_id = $result['dep_id'];
                    $prename = $result['name'];


                    echo"<option value='$pre_id'>$prename</option>";

                    $i++;
                }
                ?>
            </select>
        </div><p><br>
        <input type="hidden" name="check_dater" value="3">
        <button type="submit" class="btn btn-success">ตกลง</button>
    </form>
 </div><br><br><br><br></div>
<form role="search" action='session_search.php' method='post'  >
    <div class="form-group input-group">
        <input type='search' name='take_detail' placeholder='ค้นหาความเสี่ยง...' value='' class="form-control" > 
        <input type='hidden' name='method'  value='take_detail5'> 
        <input type='hidden' name='method3'  value='check_user'>
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
        </span>
    </div>
</form>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-star"></i> รายงานความเสี่ยงที่ได้รับทั้งหมด</h3>
            </div>

            <div class="panel-body">
<?php

// สร้างฟังก์ชั่น สำหรับแสดงการแบ่งหน้า   
function page_navigator($before_p, $plus_p, $total, $total_p, $chk_page) {
    global $e_page;
    global $querystr;

    $ID = $_REQUEST[id];
    $urlfile = "Recurrence2_risk.php"; // ส่วนของไฟล์เรียกใช้งาน ด้วย ajax (ajax_dat.php)
    $per_page = 30;
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
                        <?php
                    }
                    for ($i = $total_start_p; $i < $total_end_p; $i++) {
                        $nClass = ($chk_page == $i) ? "class='selectPage'" : "";
                        if ($e_page * $i <= $total) {
                            ?>
                            <a href="<?= $urlfile; ?>?s_page=<?= $i . $querystr; ?>&&id=<?= $ID; ?>" <?= $nClass; ?>  ><?= intval($i + 1); ?></a>  
                            <?php
                        }
                    }
                    if ($chk_page < $total_p - 1) {
                        ?>
                        <a href="<?= $urlfile ?>?s_page=<?= $pNext . $querystr ?>&&id=<? $ID; ?>"  class="naviPN">Next</a>
                        <?php
                    }
                }
                
                
                        if(!empty($_SESSION[take_date1])){
                            
                        
                            $set_dep=$_SESSION[set_dep];
                if(empty($set_dep)){
                    $code="and d1.main_dep='$main_dep'";
                }else{
                    $code="and d1.dep_id='$set_dep'";
                }
                            
                    if ($_SESSION[take_detail] != '') {
                        $Search = trim($_SESSION[take_detail]);
                        echo "แสดงคำที่ค้นหา : " . $Search;
//คำสั่งค้นหา
                        $take_date1=$_SESSION[take_date1];
                        $take_date2=$_SESSION[take_date2];
                       
                        $q = "select s1.name as sub_name, c1.name AS cate_name, t1.recycle, t1.subcategory as sub,count(t1.takerisk_id) as num_risk,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'A' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') A,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'B' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') B,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'C' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') C,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'D' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') D,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'E' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') E,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'F' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') F,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'G' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') G,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'H' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') H,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'I' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and s1.name like '%$Search%') I
from  subcategory s1
INNER JOIN takerisk t1 on t1.subcategory = s1.subcategory
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
INNER JOIN category c1 ON t1.category = c1.category
where t1.recycle='N' and t1.subcategory=s1.subcategory and s1.name like '%$Search%' and t1.subcategory !=''
and t1.move_status='N' $code and t1.take_date between '$take_date1' and '$take_date2'
group by t1.subcategory order by num_risk desc,sub_name";
                    } else {
                        
                        $take_date1=$_SESSION[take_date1];
                        $take_date2=$_SESSION[take_date2];
                        
                        $q = "select s1.name as sub_name, c1.name AS cate_name, t1.recycle, t1.subcategory as sub,count(t1.takerisk_id) as num_risk,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'A' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') A,
(select COUNT(t1.level_risk) FROM takerisk t1
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'B' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') B,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'C' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') C,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'D' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') D,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'E' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') E,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'F' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') F,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'G' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') G,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'H' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') H,
(select COUNT(t1.level_risk) FROM takerisk t1 
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk = 'I' and t1.recycle =  'N' 
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !='') I
from  takerisk t1
INNER JOIN subcategory s1 on t1.subcategory = s1.subcategory
INNER JOIN department d1 on t1.res_dep = d1.dep_id 
INNER JOIN department_group d2 on d2.main_dep = d1.main_dep 
INNER JOIN category c1 ON t1.category = c1.category 
WHERE t1.subcategory=s1.subcategory and t1.move_status='N' and t1.level_risk != '' and t1.recycle =  'N'
and t1.take_date between '$take_date1' and '$take_date2' $code and t1.subcategory !=''
GROUP BY t1.subcategory order by num_risk desc,sub_name";
                        }
                        
                    }
                
                $qr = mysql_query($q);
                if ($qr == '') {
                    exit();
                }
                $total = mysql_num_rows($qr);

                $e_page = 30; // กำหนด จำนวนรายการที่แสดงในแต่ละหน้า   
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
                    <a class="btn btn-success" download="recurrence_risk.xls" href="#" onClick="return ExcellentExport.excel(this, 'datatable', 'Sheet Name Here');">Export to Excel</a><br><br>
                    <?php 
                    
                    $sql_re="select name  from department
                        where dep_id='$set_dep'";
                    $Sql_re = mysql_query($sql_re);
                    $rep=  mysql_fetch_array($Sql_re);
                    include_once ('funcDateThai.php');
								
								DateThai1($take_date1); //-----แปลงวันที่เป็นภาษาไทย
                                                                
								DateThai1($take_date2); //-----แปลงวันที่เป็นภาษาไทย
                    ?>
                    <table id="datatable" class="table table-bordered table-hover table-striped tablesorter">
                        <?php if($_SESSION[check_date1]=='3'){ ?><tr>
                            <th colspan="13"><center><?php echo "งาน : "  .$rep[name]. " ระหว่างวันที่ : ". DateThai1($take_date1). " ถึง ". DateThai1($take_date2);?></center></th>
                        </tr><?php }?> 
                    <TR> 
                        <th width='7%'><CENTER><p>ลำดับ <i class="fa fa-sort"></i></p></CENTER></th>
                        <th width='25%'><CENTER><p>รายการ <i class="fa fa-sort"></i></p></CENTER></th>
                        <th width='15%'><CENTER><p>ด้าน <i class="fa fa-sort"></i></p></CENTER></th>
                        <th width='5%'><CENTER><p>ครั้ง </p></CENTER></th>
                        <th width='5%'><CENTER><p>A </p></CENTER></th>
                        <th width='5%'><CENTER><p>B </p></CENTER></th>
                        <th width='5%'><CENTER><p>C </p></CENTER></th>
                        <th width='5%'><CENTER><p>D </p></CENTER></th>
                        <th width='5%'><CENTER><p>E </p></CENTER></th>
                        <th width='5%'><CENTER><p>F </p></CENTER></th>
                        <th width='5%'><CENTER><p>G </p></CENTER></th>
                        <th width='5%'><CENTER><p>H </p></CENTER></th>
                        <th width='5%'><CENTER><p>I </p></CENTER></th>
                        </TR>
<?php
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
                            <td><?= $total_risk[sub_name]; ?></td>
                            <td><center><?= $total_risk[cate_name]; ?></center></td>
                            <td><center><?= $total_risk[num_risk]; ?></center></td>
                            <td><center><a href="session_search.php?level_risk=A&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[A]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=B&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[B]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=C&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[C]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=D&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[D]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=E&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[E]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=F&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[F]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=G&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[G]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=H&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[H]; ?></a></center></td>
                            <td><center><a href="session_search.php?level_risk=I&&method=level_risk2&&subname=<?= $total_risk[sub];?>&&dates=<?= $take_date1?>&&datee=<?= $take_date2?>&&dep=<?=$user_dep?>"><?= $total_risk[I]; ?></a></center></td>
                    </tr>

    <?php $i++; } ?>

                    </table>
                </div>
            </div>
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
    echo $count = ceil($total / 30) . "&nbsp;<B>หน้า</B></font>";
}
?> 
        </div>    

<?php include 'footer.php'; ?>