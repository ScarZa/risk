 <?php
$sql2=mysql_query("select * from mngrisk
    inner join takerisk on mngrisk.takerisk_id=takerisk.takerisk_id
    inner join department on takerisk.res_dep=department.dep_id
where  mngrisk.takerisk_id='$takerisk_id'");							
 $result2=mysql_fetch_assoc($sql2);		
   $Y=$result2[mng_status];
   $admin_check=$result2[admin_check];
   
$sql3=mysql_query("select * from mngrisk
    inner join user on mngrisk.user_edit=user.user_id
where  mngrisk.takerisk_id='$takerisk_id'");							
 $result3=mysql_fetch_assoc($sql3);   
 if($Y=="Y"){ 
?>
   <H1><small><font color="#0000ff">การแก้ไขความเสี่ยง</font></small></H1>
   <label>ผู้บันทึกการแก้ไข</label><BR>
<font color="#0000ff"><?=$result3[user_fname] ?> <?=$result3[user_lname] ?></font><BR>
   <label>วันที่วิเคราะห์ความเสี่ยง</label><BR>
<font color="#0000ff"><?php 
								include_once ('funcDateThai.php');
								$mng_date= "$result2[mng_date]";
					 echo	DateThai1($mng_date); //-----แปลงวันที่เป็นภาษาไทย
 ?></font>
 <BR> 

 <label>เหตุการณ์ที่เกิดขึ้นมีผลกระทบต่อบริการหรือหน่วยงาน ใดบ้าง</label> <BR> 
<font color="#0000ff"><?=$result2[incident_old]?></font><BR> 

 <label>วิเคราะห์สาเหตุที่เกิด เช่น ผู้ป่วย, บุคลากร, งานที่มอบหมาย, ทีมงาน, เครื่องมือ, วัฒนธรรม, สิ่งแวดล้อม, การสื่อสาร, ปัจจัยที่ควบคุมไม่ได้</label><BR> 
<font color="#0000ff"><?=$result2[incident_differ]?></font><BR> 

 <label>สาเหตุของปัญหา</label><BR> 
<font color="#0000ff"><?=$result2[edit_summary]?></font><BR> 

<label>มาตรการหรือแนวทางแก้ไข</label><BR> 
<font color="#0000ff"><?=$result2[edit_process]?></font><BR>

 <label>ระยะเวลาในการดำเนินการเพื่อให้กรรมการความเสี่ยงติดตามประเมินผล</label><BR> 
 <font color="#ff0000">***ระยะเวลา  <?=$result2[evaluate]?> *** สามารถให้กรรมการตรวจได้ในวันที่ 
     <?php if($result2[check_date]!='0000-00-00'){
     $check_date=$result2[check_date];
     echo	DateThai1($check_date);}?></font><BR> 
<? if($admin=='Y'){ ?>
 <label>การประเมินผลของคณะกรรมการ</label><BR>
 <?php if($result2['admin_check']=='G'){ echo "<b style='color:blue'>ผ่าน</b>";}else{?>
 <form role="form" action='process_admin_check.php' enctype="multipart/form-data" method='post'> 
     <input name="check" id="check" type="radio" value="G" <?php if($result2['admin_check']=='G'){ echo 'checked';}?> /> ผ่าน<BR>
 <input name="check" id="check" type="radio" value="Y" <?php if($result2['admin_check']=='Y'){ echo 'checked';}?> /> กำลังดำเนินการ<BR>
 <input name="check" id="check" type="radio" value="R" <?php if($result2['admin_check']=='R'){ echo 'checked';}?> /> ไม่ผ่าน<BR><BR>
 <INPUT type="hidden" name="takerisk_id" id="takerisk_id" value="<?=$takerisk_id?>"/>
 <button type="submit" class="btn btn-primary">บันทึก  </button>
 <?php }
}}elseif($admin=='Y' or ($admin=='A' and $result2[main_dep]==$_SESSION[user_main_dep])
        or $result2[res_dep]==$_SESSION[user_dep_id]){
 ?>
 <H1><small><font color="#0000ff">การแก้ไขความเสี่ยง</font></small></H1>
 
<form role="form" action='prcNomal_RcaForm.php' enctype="multipart/form-data" method='post'> 
<label>วันที่วิเคราะห์ความเสี่ยง</label>    
<input type="date" name='mng_date' id="date1" title='กรุณาเลือกวันที่วิเคราะห์ความเสี่ยง' class="form-control" placeholder='<?php echo date('d/m/Y');?>' required  /><BR>  
 <label>เหตุการณ์ที่เกิดขึ้นมีผลกระทบต่อบริการหรือหน่วยงาน ใดบ้าง</label>
 <TEXTAREA NAME="incident_old" class="form-control" required  ></TEXTAREA><BR> 
 <label>วิเคราะห์สาเหตุที่เกิด</label><br>
 <input name="check1" type="checkbox" value="ผู้ป่วย" /> &nbsp;&nbsp;<b>ผู้ป่วย</b> เช่น อาการ,ความรุนแรงของโรค,แนวโน้มของโรค.caseซ้ำซ้อน,ขาดความรู้,ญาติ<BR> 
 <input name="check2" type="checkbox" value="บุคลากร" /> &nbsp;&nbsp;<b>บุคลากร</b> เช่น ความรู้,ความสามารถ,ทักษะ,อ่อนล้า,แรงจูงใจ,ทัศนคติ,สุขภาพกายและจิต,ไม่ปฏิบัติตามแนวทางที่กำหนด<BR>
 <input name="check3" type="checkbox" value="งานที่มอบหมาย" /> &nbsp;&nbsp;<b>งานที่มอบหมาย</b> เช่น ฝึกอบรมเพิ่มเติม,อยากเปลี่ยนงาน,มีข้อจำกัด, แนวทางที่รัดกุด ทันสมัย,อัตราส่วนของบุคลากรต่อปริมาณงาน<BR>
 <input name="check4" type="checkbox" value="ทีมงาน" /> &nbsp;&nbsp;<b>ทีมงาน</b> เช่น ผู้รับผิดชอบหลัก,หัวหน้างานตรวจนิเทศ,ไม่สมัครใจ, การสื่อสาร พูด/เขียน,โครงสร้างของทีมงาน,ลักษณะของผู้นำ,การสนับสนุนจากฝ่ายบริหาร<BR>
 <input name="check5" type="checkbox" value="เครื่องมือ" /> &nbsp;&nbsp;<b>เครื่องมือ</b> เช่น ชำรุด,ใช้ไม่เป็น,บำรุงรักษา,ทิ้ง,ไม่ได้รับการตรวจสอบ,Error บ่อย<BR>
 <input name="check6" type="checkbox" value="วัฒนธรรม" /> &nbsp;&nbsp;<b>วัฒนธรรม</b> เช่น องค์กรเอื้อต่อการแก้ปัญหา,แรงกดดัน,การเงิน,ทิศทาง-นโยบาย<BR>
 <input name="check7" type="checkbox" value="สิ่งแวดล้อม" /> &nbsp;&nbsp;<b>สิ่งแวดล้อม</b> เช่น แสง,เสียง,โต๊ะ-เก้าอี้ไม่เหมาะสม,ความปลอดภัย<BR>
 <input name="check8" type="checkbox" value="การสื่อสาร" /> &nbsp;&nbsp;<b>การสื่อสาร</b> เช่น คู่มือ,การสื่อสารไม่ทั่วถึง,แนวทางการปฏิบัติไม่ชัดเจน,ไม่สื่อสาร,การสื่อสารระหว่างหน่วยงาน<BR>
 <input name="check9" type="checkbox" value="ปัจจัยที่ควบคุมไม่ได้" /> &nbsp;&nbsp;<b>ปัจจัยที่ควบคุมไม่ได้</b> เช่น พายุ,แผ่นดินไหว<BR><br>
  <label>สาเหตุของปัญหา</label>
 <TEXTAREA NAME="edit_summary"   class="form-control" required></TEXTAREA><BR> 
<label>มาตรการหรือแนวทางแก้ไข</label>
 <TEXTAREA NAME="edit_process"   class="form-control" required></TEXTAREA><BR>
  <label>ระยะเวลาในการดำเนินการเพื่อให้กรรมการความเสี่ยงติดตามประเมินผล</label>
 <select NAME="evaluate" id="evaluate"  class="form-control" required >
     <OPTION value="">...เลือกระยะเวลา...</OPTION>
     <OPTION value="7 วัน">7 วัน</OPTION>
     <OPTION value="15 วัน">15 วัน</OPTION>
     <OPTION value="1 เดือน">1 เดือน</OPTION>
     <OPTION value="3 เดือน">3 เดือน</OPTION>
     <OPTION value="6 เดือน">6 เดือน</OPTION>
     <OPTION value="1 ปี">1 ปี</OPTION>
</select><BR> 
 <BR> 
<INPUT TYPE="hidden" NAME="takerisk_id" value="<?=$takerisk_id?>"   >
<input type="hidden" name="user_edit" value="<?=$user_edit?>">
<input type="hidden" name="status_process" value="<?=$status_process?>">

              <button type="submit" class="btn btn-primary">บันทึก  </button>
              <button type="reset" class="btn btn-default">Reset  </button>  
 <?php
 } 
 ?>
  </form> 
 