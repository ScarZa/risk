<?php
include 'connect.php';
$sql = mysql_query("select count(takerisk_id) AS countrisk,LEFT(take_detail,20)  AS detail  from takerisk WHERE move_status='Y' and recycle='N' and subcategory!='' group by move_status");
                                    $result = mysql_fetch_assoc($sql);
                                    echo mysql_error();
                                ?>
<a href="JavaScript:doCallAjax('countrisk')" class="dropdown-toggle" data-toggle="dropdown"><img src='images/Bell.ico' width='18'> รายการแจ้งย้าย  
<span class="badge_alert" ><?php echo $result[countrisk]; ?></span><b class="caret"></b></a>

<ul class="dropdown-menu">
    <li align='center' style="color: red"><b>แสดง 20 รายการ (เรียงตามระดับความรุนแรง)</b></li>
    <li class="divider"></li>
                                            <?php
                                            $sql2 = mysql_query("select s1.name, takerisk_id,LEFT(take_detail,20)  AS detail  from takerisk t1 
                    inner join subcategory s1 on t1.subcategory=s1.subcategory
                    WHERE t1.move_status='Y' and t1.recycle='N' order by t1.level_risk DESC limit 20");
                                            while ($result2 = mysql_fetch_assoc($sql2)) {
                                                ?>
                                                <li><a href="detailRiskInBox.php?method=remove_risk&takerisk_id=<?php echo $result2[takerisk_id] ?>"><i class="fa fa-wrench"></i> <?php echo $result2[name]; ?> </a></li>
                                            <?php } ?>
                                            <li class="divider"></li>
                                            <li><a href="changeRisk.php">ดูทั้งหมด</a></li>
                                        </ul>
