<?PHP @session_start(); ?>
<META content="text/html; charset=utf8" http-equiv=Content-Type>
<?php
if ($_POST[method] == 'take_detail') {
    $_SESSION[take_detail] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBox.php' />";
} else if ($_POST[method] == 'take_detail2') {
    $_SESSION[take_detail] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBox2.php' />";
} else if ($_POST[method] == 'take_detail3') {
    $_SESSION[take_detail] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBox3.php' />";
} elseif ($_POST[check_date1] == '1') {
    $_SESSION[check_date1] = $_POST[check_date1];
    $_SESSION[take_date1] = $_POST[take_date1];
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBox3.php' />";
} else if ($_POST[method] == 'take_detail4') {
    $_SESSION[take_detail] = $_POST[take_detail];
    $Id = $_REQUEST[id];
    ?>
    <meta http-equiv='refresh' content='0;url=listRiskInBox4.php?id=<?= $Id ?>' />
    <?php
} else if ($_POST[method] == 'take_detail5') {
    $_SESSION[take_detail] = $_POST[take_detail];
    if($_POST[method2]=='check_user'){
   echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php?id=1' />" ;    
    }elseif($_POST[method3]=='check_user'){
   echo "<meta http-equiv='refresh' content='0;url=Recurrence2_risk.php' />" ;    
    }else{
    echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php' />";
    }
} else if ($_POST[method] == 'take_name') {
    $_SESSION[take_name] = $_POST[take_name];
    echo "<meta http-equiv='refresh' content='0;url=staff_report.php' />";
} else if ($_POST[check_dater] == '1' and $_POST[category]!='' and $_POST[place]!='') {
    $_SESSION[check_date1] = $_POST[check_dater];
    $_SESSION[take_date1] = $_POST[take_date1];
    $_SESSION[take_date2] = $_POST[take_date2];
    $_SESSION[category] = $_POST[category];
    $_SESSION[place] = $_POST[place];
    echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php' />";
}elseif ($_POST[check_dater] == '1' and $_POST[category]!='' and $_POST[place]=='') {
    $_SESSION[check_date1] = $_POST[check_dater];
    $_SESSION[take_date1] = $_POST[take_date1];
    $_SESSION[take_date2] = $_POST[take_date2];
    $_SESSION[category] = $_POST[category];
    echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php' />";
}else if ($_POST[check_dater] == '1' and $_POST[take_date1]!='' and $_POST[place]=='') {
    $_SESSION[check_date1] = $_POST[check_dater];
    $_SESSION[take_date1] = $_POST[take_date1];
    $_SESSION[take_date2] = $_POST[take_date2];
    unset($_SESSION[category]);
    unset($_SESSION[place]);
    echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php' />";
}elseif ($_POST[check_dater] == '1' and $_POST[take_date1]=='') {
    unset($_SESSION[check_date1]);
    unset($_SESSION[take_date1]);
    unset($_SESSION[take_date2]);
    unset($_SESSION[category]);
    unset($_SESSION[place]);
    echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php' />";
}elseif ($_POST[check_dater] == '2' and $_POST[take_date1]!='') {
    $_SESSION[check_date1] = $_POST[check_dater];
    $_SESSION[take_date1] = $_POST[take_date1];
    $_SESSION[take_date2] = $_POST[take_date2];
    echo "<meta http-equiv='refresh' content='0;url=Recurrence_risk.php?id=1' />";
}elseif ($_POST[check_dater] == '2' and $_POST[take_date1]=='') {
    unset($_SESSION[check_date1]);
    unset($_SESSION[take_date1]);
    unset($_SESSION[take_date2]);
    echo "<meta http-equiv='refresh' content='0;url=Recurrence2_risk.php?id=1' />";
}elseif ($_POST[check_dater] == '3') {
    if(!empty($_POST[take_date1])){
    $_SESSION[check_date1] = $_POST[check_dater];
    $_SESSION[take_date1] = $_POST[take_date1];
    $_SESSION[take_date2] = $_POST[take_date2];
    }
    if(!empty($_POST['dep'])){
        $_SESSION[set_dep]=$_POST['dep'];
    }
     if($_POST[take_date1]=='' and $_POST['dep']=='') {
    unset($_SESSION[check_date1]);
    unset($_SESSION[take_date1]);
    unset($_SESSION[take_date2]);
    unset($_SESSION[set_dep]);
     }
    echo "<meta http-equiv='refresh' content='0;url=Recurrence2_risk.php' />";
}else if ($_POST[checkdate] == '1' and $_POST[check_date01]!='') {
    $_SESSION[checkdate] = $_POST[checkdate];
    $_SESSION[check_date01] = $_POST[check_date01];
    $_SESSION[check_date02] = $_POST[check_date02];
    echo "<meta http-equiv='refresh' content='0;url=staff_report.php' />";
}elseif ($_POST[checkdate] == '1' and $_POST[check_date01]=='') {
    $_SESSION[checkdate] = '0';
    echo "<meta http-equiv='refresh' content='0;url=staff_report.php' />";
} else if ($_POST[method] == 'change_risk') {
    $_SESSION[searchChangeRisk] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=changeRisk.php' />";
} elseif ($_GET[method] == 'main_report') {
    $_SESSION[Rmng_status] = $_GET[mng_status];
    $_SESSION[Rtake_date1] = $_GET[take_date1];
    $_SESSION[Rtake_date2] = $_GET[take_date2];
    $_SESSION[Rlevel_risk] = $_GET[level_risk];
    $_SESSION[Rtake_dep] = $_GET[take_dep];
    $_SESSION[Rcategory] = $_GET[category];
    $_SESSION[Rsubcategory] = $_GET[subcategory];
    $id_check = $_GET[id];
    if ($id_check == '1') {
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=main_report5_2.php'>";
    } else {
        echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=main_report5.php'>";
    }
} else if ($_POST[method] == 'search_name') {
    $_SESSION[Search_fname] = $_POST[Search_fname];
    $_SESSION[Search_lname] = $_POST[Search_lname];
    echo "<meta http-equiv='refresh' content='0;url=frmUser.php' />";
} else if ($_POST[method] == 'search_category') {
    $_SESSION[Search_category] = $_POST[Search_category];
    echo "<meta http-equiv='refresh' content='0;url=frmCategory.php' />";
} else if ($_POST[method] == 'search_subcategory') {
    $_SESSION[Search_subcategory] = $_POST[Search_subcategory];
    echo "<meta http-equiv='refresh' content='0;url=frmSubCategory.php' />";
} else if ($_POST[method] == 'search_department') {
    $_SESSION[Search_department] = $_POST[Search_department];
    echo "<meta http-equiv='refresh' content='0;url=frmDepartment.php' />";
} else if ($_POST[method] == 'search_place') {
    $_SESSION[Search_place] = $_POST[Search_place];
    echo "<meta http-equiv='refresh' content='0;url=frmPlace.php' />";
} else if ($_GET[report] == 'report_department1') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[take_date1_report] = $_GET[take_date1];
    $_SESSION[take_date2_report] = $_GET[take_date2];
    $_SESSION[check_teke]='take1';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department2') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[mng_status_report] = $_GET[mng_status];
    $_SESSION[check_teke]='take1';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department3') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[take_date1_report] = $_GET[take_date1];
    $_SESSION[take_date2_report] = $_GET[take_date2];
    $_SESSION[mng_status_report] = $_GET[mng_status];
    $_SESSION[check_teke]='take1';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department4') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[check_teke]='take1';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department5') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[take_date1_report] = $_GET[take_date1];
    $_SESSION[take_date2_report] = $_GET[take_date2];
    $_SESSION[check_teke]='take2';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department6') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[mng_status_report] = $_GET[mng_status];
    $_SESSION[check_teke]='take2';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department7') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[take_date1_report] = $_GET[take_date1];
    $_SESSION[take_date2_report] = $_GET[take_date2];
    $_SESSION[mng_status_report] = $_GET[mng_status];
    $_SESSION[check_teke]='take2';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} else if ($_GET[report] == 'report_department8') {
    $_SESSION[report_dep] = $_GET[report];
    $_SESSION[dep_id_report] = $_GET[dep_id];
    $_SESSION[move_status_report] = 'N';
    $_SESSION[check_teke]='take2';
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} elseif ($_POST[method] == 'take_detail_report') {
    $_SESSION[take_detail_reportdep] = $_POST[take_detail_reportdep];
    echo "<meta http-equiv='refresh' content='0;url=listRiskInBoxAdmin.php' />";
} elseif ($_POST[method] == 'session_take_detail_dep') {
    $_SESSION[take_detail_dep] = $_POST[take_detail_dep];
    echo "<meta http-equiv='refresh' content='0;url=listRiskDepWrite.php' />";
} elseif ($_GET[method] == 'level_risk') {
    $_SESSION[Rmng_status] = $_GET[mng_status];
    $_SESSION[Rtake_date1] = $_GET[take_date1];
    $_SESSION[Rtake_date2] = $_GET[take_date2];
    $_SESSION[Rlevel_risk] = $_GET[level_risk];
    $_SESSION[type]=$_GET[type];
    unset($_SESSION[subname]);
    unset($_SESSION[dates]);
    unset($_SESSION[datee]);
    unset($_SESSION[res_dep]);
    unset($_SESSION[check_user]);
    echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=main_report6.php'>";
} elseif ($_GET[method] == 'level_risk2') {
    $_SESSION[Rlevel_risk] = $_GET[level_risk];
    $_SESSION[subname]=$_GET[subname];
    $_SESSION[dates]=$_GET[dates];
    $_SESSION[datee]=$_GET[datee];
    $_SESSION[res_dep]=$_GET[dep];
    if($_GET[id]=='1'){
        $_SESSION[check_user]=$_GET[id];
        unset($_SESSION[check_date1]);
    }else{
    unset($_SESSION[check_user]); 
    }
    unset($_SESSION[Rmng_status]);
    unset($_SESSION[Rtake_date1]);
    unset($_SESSION[Rtake_date2]);
    unset($_SESSION[type]);
    echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=main_report6.php'>";    
} elseif ($_GET[pct] == 'Y') {
    $_SESSION[pct] = $_GET[pct];
    echo "<meta http-equiv='refresh' content='0;url=listRiskPCT.php' />";
} elseif ($_GET[ic] == 'Y') {
    $_SESSION[ic] = $_GET[ic];
    echo "<meta http-equiv='refresh' content='0;url=listRiskPCT.php' />";
} elseif ($_GET[recycle] == 'Y') {
    $_SESSION[recycle] = $_GET[recycle];
    echo "<meta http-equiv='refresh' content='0;url=listRiskRecycle.php' />";
} elseif ($_POST[method] == 'pct') {
    $_SESSION[pct] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=listRiskPCT.php' />";
} elseif ($_POST[method] == 'ic') {
    $_SESSION[ic] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=listRiskPCT.php' />";
} elseif ($_POST[method] == 'recycle') {
    $_SESSION[recycle] = $_POST[take_detail];
    echo "<meta http-equiv='refresh' content='0;url=listRiskRecycle.php' />";
} elseif ($_POST[method] == 'session_before') {
    $_SESSION[sub_risk] = $_POST[sub_risk];
    echo "<meta http-equiv='refresh' content='0;url=frmBeforeWriteRisk.php' />";
}
?>
