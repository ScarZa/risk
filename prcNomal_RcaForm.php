<?php @session_start(); ?>
<?php if (empty($_SESSION['user_id'])) {
    echo "<meta http-equiv='refresh' content='0;url=index.php'/>";
    exit();
} ?>
<?php include'jquery.php'; ?>
<?php include'header.php'; 
$status_process=$_REQUEST['status_process']; ?>
<meta charset="utf-8"><script src="jquery/development-bundle/ui/jquery-ui.js"></script>

<?php
$takerisk_id = $_REQUEST[takerisk_id];
$user_idedit=$_POST[user_edit];
$incident_old = $_POST[incident_old];
$check1 = $_POST[check1];
$check2 = $_POST[check2];
$check3 = $_POST[check3];
$check4 = $_POST[check4];
$check5 = $_POST[check5];
$check6 = $_POST[check6];
$check7 = $_POST[check7];
$check8 = $_POST[check8];
$check9 = $_POST[check9];
$incident_differ = "$check1 $check2 $check3 $check4 $check5
           $check6 $check7 $check8 $check9";
$edit_summary = $_POST[edit_summary];
$edit_process = $_POST[edit_process];
$evaluate = $_POST[evaluate];
$mmg_rec_date = date("Y-m-d");
$mng_rec_time = date("H:i:s");
$mng_status = "Y";
$rca_keyman = $_POST[rca_keyman];
$rca_list_user = $_POST[rca_list_user];
$rca_keyman = $_POST[rca_keyman];
if($_POST[mng_date]==''){
    $mng_date=  date('Y-m-d');
}else{
$mng_date = $_POST[mng_date];
}
if ($evaluate == '7 วัน') {
    $check_date = date('Y-m-d', strtotime("+7 days "));
} elseif ($evaluate == '15 วัน') {
    $check_date = date('Y-m-d', strtotime("+15 days "));
} elseif ($evaluate == '1 เดือน') {
    $check_date = date('Y-m-d', strtotime("+1 months "));
} elseif ($evaluate == '3 เดือน') {
    $check_date = date('Y-m-d', strtotime("+3 months "));
} elseif ($evaluate == '6 เดือน') {
    $check_date = date('Y-m-d', strtotime("+6 months "));
} elseif ($evaluate == '1 ปี') {
    $check_date = date('Y-m-d', strtotime("+1 years "));
} elseif ($evaluate == '') {
    $check_date = date('Y-m-d', strtotime("+7 days "));
}

$rca_event = $_POST[rca_event];
$rca_flow_system = $_POST[rca_flow_system];
$rca_differ_system = $_POST[rca_differ_system];
$rca_property_man = $_POST[rca_property_man];
$rca_training_man = $_POST[rca_training_man];
$rca_evaruate_man = $_POST[rca_evaruate_man];
$rca_rate_man = $_POST[rca_rate_man];
$rca_rate_tool = $_POST[rca_rate_tool];
$rca_chk_tool = $_POST[rca_chk_tool];
$rca_defective_tool = $_POST[rca_defective_tool];
$rca_environment = $_POST[rca_environment];
$rca_techno = $_POST[rca_techno];
$rca_communication = $_POST[rca_communication];
$rca_office_yes = $_POST[rca_office_yes];
$rca_head_yes = $_POST[rca_head_yes];
$rca_external_factor = $_POST[rca_external_factor];

$prevent1_improve = $_POST[prevent1_improve];
$prevent1_work_date = $_POST[prevent1_work_date];
$prevent1_sum_date = $_POST[prevent1_sum_date];
$prevent1_man = $_POST[prevent1_man];

$prevent2_improve = $_POST[prevent2_improve];
$prevent2_work_date = $_POST[prevent2_work_date];
$prevent2_sum_date = $_POST[prevent2_sum_date];
$prevent2_man = $_POST[prevent2_man];

$prevent3_improve = $_POST[prevent3_improve];
$prevent3_work_date = $_POST[prevent3_work_date];
$prevent3_sum_date = $_POST[prevent3_sum_date];
$prevent3_man = $_POST[prevent3_man];

$prevent4_improve = $_POST[prevent4_improve];
$prevent4_work_date = $_POST[prevent4_work_date];
$prevent4_sum_date = $_POST[prevent4_sum_date];
$prevent4_man = $_POST[prevent4_man];

$prevent5_improve = $_POST[prevent5_improve];
$prevent5_work_date = $_POST[prevent5_work_date];
$prevent5_sum_date = $_POST[prevent5_sum_date];
$prevent5_man = $_POST[prevent5_man];

$prevent6_improve = $_POST[prevent6_improve];
$prevent6_work_date = $_POST[prevent6_work_date];
$prevent6_sum_date = $_POST[prevent6_sum_date];
$prevent6_man = $_POST[prevent6_man];

$prevent7_improve = $_POST[prevent7_improve];
$prevent7_work_date = $_POST[prevent7_work_date];
$prevent7_sum_date = $_POST[prevent7_sum_date];
$prevent7_man = $_POST[prevent7_man];

$prevent8_improve = $_POST[prevent8_improve];
$prevent8_work_date = $_POST[prevent8_work_date];
$prevent8_sum_date = $_POST[prevent8_sum_date];
$prevent8_man = $_POST[prevent8_man];

$prevent9_improve = $_POST[prevent9_improve];
$prevent9_work_date = $_POST[prevent9_work_date];
$prevent9_sum_date = $_POST[prevent9_sum_date];
$prevent9_man = $_POST[prevent9_man];

$prevent10_improve = $_POST[prevent10_improve];
$prevent10_work_date = $_POST[prevent10_work_date];
$prevent10_sum_date = $_POST[prevent10_sum_date];
$prevent10_man = $_POST[prevent10_man];
include'connect.php';

$sql = mysql_query("select takerisk_id from takerisk where takerisk_id='$takerisk_id' order by takerisk_id desc limit 1");
$result = mysql_fetch_assoc($sql);
$takerisk_idFile = $result[takerisk_id];
$takerisk_idFile2 = $takerisk_idFile + 1;

/*
  function seotitle($raw){
  $raw = preg_replace('#[^-ก-๙a-zA-Z0-9.]#u', '', $raw);
  $raw =  preg_replace("/-+/i","-",$raw);
  if(substr($raw,0,1) == '-')
  $raw = substr($raw,1);
  if(substr($game_url,-1) == '-')
  $raw = substr($raw,0,-1);
  return urlencode($raw);
  }
 */

//===========Convert file name of upload 
function removespecialchars($raw) {
    return preg_replace('#[^a-zA-Z0-9.-]#u', '', $raw);
}

if (trim($_FILES["filUpload1"]["name"] != "")) {
    if (move_uploaded_file($_FILES["filUpload1"]["tmp_name"], "myfile/" . removespecialchars(date("d-m-Y/") . "RCA1" . $takerisk_idFile2 . $_FILES["filUpload1"]["name"]))) {
        $file1 = date("d-m-Y/") . "RCA1" . $takerisk_idFile2 . $_FILES["filUpload1"]["name"];
        $take_file1 = removespecialchars($file1);
    }
}
if (trim($_FILES["filUpload2"]["name"] != "")) {
    if (move_uploaded_file($_FILES["filUpload2"]["tmp_name"], "myfile/" . removespecialchars(date("d-m-Y/") . "RCA2" . $takerisk_idFile2 . $_FILES["filUpload2"]["name"]))) {
        $file2 = date("d-m-Y/") . "RCA2" . $takerisk_idFile2 . $_FILES["filUpload2"]["name"];
        $take_file2 = removespecialchars($file2);
    }
}
if (trim($_FILES["filUpload3"]["name"] != "")) {
    if (move_uploaded_file($_FILES["filUpload3"]["tmp_name"], "myfile/" . removespecialchars(date("d-m-Y/") . "RCA3" . $takerisk_idFile2 . $_FILES["filUpload3"]["name"]))) {
        $file3 = date("d-m-Y/") . "RCA3" . $takerisk_idFile2 . $_FILES["filUpload3"]["name"];
        $take_file3 = removespecialchars($file3);
    }
}





$sqlUpdate = mysql_query("update mngrisk   SET
                                user_edit='$user_idedit',
				incident_old='$incident_old',
				incident_old='$incident_old',
				incident_differ='$incident_differ',
				edit_summary='$edit_summary',
                                edit_process='$edit_process',    
				evaluate='$evaluate',
				mmg_rec_date='$mmg_rec_date',
				mng_rec_time='$mng_rec_time',
				mng_status='$mng_status' ,
				rca_list_user='$rca_list_user',
				rca_keyman='$rca_keyman',
				mng_date='$mng_date',
                                check_date='$check_date',    
				rca_event='$rca_event',
				rca_flow_system='$rca_flow_system',
				rca_differ_system='$rca_differ_system',
				rca_property_man='$rca_property_man',
				rca_training_man='$rca_training_man',
				rca_evaruate_man='$rca_evaruate_man',
				rca_rate_man='$rca_rate_man',
				rca_rate_tool='$rca_rate_tool',
				rca_chk_tool='$rca_chk_tool',
				rca_defective_tool='$rca_defective_tool',
				rca_environment='$rca_environment',
				rca_techno='$rca_techno',
				rca_communication='$rca_communication',
				rca_office_yes='$rca_office_yes',
				rca_head_yes='$rca_head_yes',
				rca_external_factor='$rca_external_factor',
				prevent1_improve='$prevent1_improve',
				prevent1_work_date='$prevent1_work_date',
				prevent1_sum_date='$prevent1_sum_date',
				prevent1_man='$prevent1_man',
				prevent2_improve='$prevent2_improve',
				prevent2_work_date='$prevent2_work_date',
				prevent2_sum_date='$prevent2_sum_date',
				prevent2_man='$prevent2_man',
				prevent3_improve='$prevent3_improve',
				prevent3_work_date='$prevent3_work_date',
				prevent3_sum_date='$prevent3_sum_date',
				prevent3_man='$prevent3_man',
				prevent4_improve='$prevent4_improve',
				prevent4_work_date='$prevent4_work_date',
				prevent4_sum_date='$prevent4_sum_date',
				prevent4_man='$prevent4_man',
				prevent5_improve='$prevent5_improve',
				prevent5_work_date='$prevent5_work_date',
				prevent5_sum_date='$prevent5_sum_date',
				prevent5_man='$prevent5_man',
				prevent6_improve='$prevent6_improve',
				prevent6_work_date='$prevent6_work_date',
				prevent6_sum_date='$prevent6_sum_date',
				prevent6_man='$prevent6_man',
				prevent7_improve='$prevent7_improve',
				prevent7_work_date='$prevent7_work_date',
				prevent7_sum_date='$prevent7_sum_date',
				prevent7_man='$prevent7_man',
				prevent8_improve='$prevent8_improve',
				prevent8_work_date='$prevent8_work_date',
				prevent8_sum_date='$prevent8_sum_date',
				prevent8_man='$prevent8_man',
				prevent9_improve='$prevent9_improve',
				prevent9_work_date='$prevent9_work_date',
				prevent9_sum_date='$prevent9_sum_date',
				prevent9_man='$prevent9_man',
				prevent10_improve='$prevent10_improve',
				prevent10_work_date='$prevent10_work_date',
				prevent10_sum_date='$prevent10_sum_date',
				prevent10_man='$prevent10_man',
				mng_file1='$take_file1',
				mng_file2='$take_file2',
				mng_file3='$take_file3'
				where takerisk_id='$takerisk_id'");
$sqlUpdate2=mysql_query("update takerisk set move_status='N' where takerisk_id='$takerisk_id'");
if ($sqlUpdate == false) {
    echo "<p>";
    echo "Update not complete" . mysql_error();
    echo "<br />";
    echo "<br />";

    echo "<a href='listRiskInBox.php?status_process=$status_process' data-role='button' data-icon='back'>กลับ</a>";
} else {
    echo "<p>&nbsp;</p>	";
    echo "<p>&nbsp;</p>	";
    echo " <div class='bs-example'>
									              <div class='progress progress-striped active'>
									                <div class='progress-bar' style='width: 100%'></div>
									              </div>";
    echo "<div class='alert alert-info alert-dismissable'>
								              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
								               <a class='alert-link' target='_blank' href='#'><center>บันทึกข้อมูลเรียบร้อย</center></a> 
								            </div>";
    echo" <META HTTP-EQUIV='Refresh' CONTENT='2;URL=listRiskInBox.php?status_process=$status_process'>";
}
//-------------end process  update  
echo mysql_error();
?>	
<?php mysql_close($con); ?>






