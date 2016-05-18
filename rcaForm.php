<?php
$sql2=mysql_query("select * from mngrisk
    inner join takerisk on mngrisk.takerisk_id=takerisk.takerisk_id
where  mngrisk.takerisk_id='$takerisk_id'");							
 $result2=mysql_fetch_assoc($sql2);		
   $Y=$result2[mng_status];
   
   $sql3=mysql_query("select * from mngrisk
    inner join user on mngrisk.user_edit=user.user_id
where  mngrisk.takerisk_id='$takerisk_id'");							
 $result3=mysql_fetch_assoc($sql3); 
 
 if($Y=="Y"){ 
?>
<!-- ผลการแก้ไขความเสี่ยง-->
   <H3>ผลการแก้ไขความเสี่ยง Root Cause Analysis : RCA</H3>
   <label>ผู้บันทึกการแก้ไข :</label>
<font color="#0000ff"><?=$result3[user_fname] ?> <?=$result3[user_lname] ?></font><BR>
		 <FONT SIZE="" COLOR="#007897">วันที่วิเคราะห์ความเสี่ยง :</FONT>    
		<?php 
 
								include_once ('funcDateThai.php');
								$mng_date= "$result2[mng_date]";
						echo		DateThai1($mng_date); //-----แปลงวันที่เป็นภาษาไทย
			?>
		  <BR> 

		 <FONT SIZE="" COLOR="#007897">รายชื่อผู้เข้าร่วม :</FONT>  
		<?php echo $result2[rca_list_user]; ?>
		 <BR> 
		 
		 <FONT SIZE="" COLOR="#007897"> คณะกรรมการ RM ประจำหน่วย :</FONT> 
		 <?php echo $result2[rca_keyman]; ?>
		 <BR> 
<H3>วิเคราะห์อุบัติการณ์ความเสี่ยง</H3>
 <FONT SIZE="" COLOR="#007897">บรรยายสรุปเหตุการณ์ (โดยย่อ) : </FONT>  
		 <?php echo $result2[rca_event]; ?>
		 <BR> 

		<FONT SIZE="" COLOR="#007897"> เหตุการณ์ที่เกิดขึ้นมีการวางระบบไว้อย่างไร(ใส่ Flow Chart,QP,WI ถ้าสามารถทำได้)  : </FONT>  
		 <?php echo $result2[rca_flow_system];?>
		 <BR><BR>
	 <h3>1. ระบบงาน</h3> 
		 <FONT SIZE="" COLOR="#007897"> โปรดระบุสิ่งที่ดำเนินการแตกต่าง ไปจากระบบงานเดิม  ใส่ Flow Chart เปรียบเทียบถ้าสามารถทำได้ : </FONT> 
 		 <?php echo $result2[rca_differ_system]; ?>
		 <BR> 
		 
	 <h3>2. ทรัพยากรมนุษย์</h3> 
		 <FONT SIZE="" COLOR="#007897"> เจ้าหน้าที่มีคุณสมบัติ/ความสามารถเพียงพอหรือไม่ :</FONT> 
 		<?php echo $result2[rca_property_man];?>
		 <BR> 

		  <FONT SIZE="" COLOR="#007897">เจ้าหน้าที่ได้รับการปฐมนิเทศ/ฝึกอบรมในการป้องกันเหตุการณ์ดังกล่าวหรือไม่ : </FONT> 
 		<?php echo $result2[rca_training_man]; ?>
		 <BR> 

		  <FONT SIZE="" COLOR="#007897">เจ้าหน้าที่ได้รับการประเมินผลการปฏิบัติงานดังกล่าวเป็นประจำหรือไม่่ : </FONT> 
 		<?php echo $result2[rca_evaruate_man]; ?>
		 <BR><BR>

		 <FONT SIZE="" COLOR="#007897">อัตรากำลังเพียงพอหรือไม่  มีแผนสำรองกรณีขาดกำลังคนหรือไม่ :</FONT>
 		 <?php echo $result2[rca_rate_man]; ?>
		 <BR> 
		
	 <h3>3. เครื่องมือ/อุปกรณ์</h3> 
		  <FONT SIZE="" COLOR="#007897"> เครื่องมือเพียงพอต่อการใช้งานหรือไม่  มีแผนในการหาให้เพียงพออย่างไร : </FONT>
 		 <?php echo $result2[rca_rate_tool];?>
		 <BR> 
		
		 <FONT SIZE="" COLOR="#007897"> มีการตรวจสอบความพร้อมใช้ของเครื่องมือสม่ำเสมอหรือไม่ :</FONT>
 		<?php echo $result2[rca_chk_tool]; ?>
		 <BR> 
	
		 <FONT SIZE="" COLOR="#007897">ความบกพร่องของเครื่องมือเป็นสาเหตุส่วนหนึ่งของการเกิดเหตุการณ์หรือไม่ : </FONT>
 		 <?php echo $result2[rca_defective_tool]; ?>
		 <BR> 
		
	 <h3>4. สิ่งแวดล้อม</h3> 
		  <FONT SIZE="" COLOR="#007897">สิ่งแวดล้อมอะไรบ้างที่ส่งผลต่อเหตุการณ์ครั้งนี้  เช่น  เสียง การถูกรบกวน แสง โครงสร้างทางกายภาพ อื่นๆ:</FONT> 
 		 <?php echo $result2[rca_environment]; ?>
		 <BR> 
		
	 <h3>5. ระบบสารสนเทศ/การสื่อสาร</h3> 
		  <FONT SIZE="" COLOR="#007897">การเข้าถึงยาก/การไม่มีข้อมูลหรือคู่มือ เป็นสาเหตุของเหตุการณ์หรือไม่ :</FONT> 
 		<?php echo $result2[rca_techno]; ?>
		 <BR> 
		 
		 <FONT SIZE="" COLOR="#007897">การสื่อสารเป็นปัจจัยส่วนหนึ่งที่ทำให้เกิดเหตุการณ์ครั้งนี้หรือไม่ : </FONT> 
 		 <?php echo $result2[rca_communication]; ?>
		 <BR> 
	 <h3>6. การนำองค์กร/วัฒนธรรมองค์กร</h3> 
		 <FONT SIZE="" COLOR="#007897"> บุคลากรที่เกี่ยวข้องกับเหตุการณ์นี้ หัวหน้างาน/หัวหน้าฝ่าย มีส่วนร่วมในการตรวจสอบหรือไม่ :</FONT> 
 		<?php echo $result2[rca_office_yes]; ?>
		 <BR> 
		
	 <h3>7. ปัจจัยภายนอกอื่นๆ</h3>
                <FONT SIZE="" COLOR="#007897">  มีปัจจัยภายนอกที่ควบคุมไม่ได้  ที่อาจเป็นสาเหตุทำให้เกิดเหตุการณ์ครั้งนี้หรือไม่ :  </FONT>
                <?php echo $result2[rca_external_factor]; ?><BR> 
		<FONT SIZE="" COLOR="#007897">  สรุปสาเหตุของความเสี่ยง :  </FONT>
 		<?php echo $result2[rca_head_yes]; ?>
	
	<p>&nbsp;</p>
 <H3>การป้องกันแก้ไขสาเหตุรากเหง้าอุบัติการณ์ความเสี่ยง</H3>
 
<div class="table-responsive">
 <table class="table table-bordered table-hover table-striped tablesorter">
<TR class="ui-widget-header">
	<th><CENTER>ลำดับ</CENTER></th>
	<th><CENTER>วิธีป้องกันแก้ไข</CENTER></th>
	<th><CENTER>วันที่ดำเนินการ</CENTER></th>
	<th><CENTER>วันที่สรุป<br>ผลดำเนินการ</CENTER></th>
	<th><p><CENTER>ผู้รับผิดชอบ</CENTER></p><BR></th>
</TR>


<?php
	 $bdate=date('d/m/Y');
$j=11;
 	for($i=1;$i<=10;$i++){	
	if($bg == "#F4F4F4") { //ส่วนของการ สลับสี 
		$bg = "#FFFFFF";
		}else{
		$bg = "#F4F4F4";
		}
		?>

<?php
	  $prevent_improve="prevent".$i."_improve";
	  $prevent_work_date="prevent".$i."_work_date";
	  $prevent_sum_date="prevent".$i."_sum_date";
	  $prevent_man="prevent".$i."_man";
	   

		   $ex2=explode("-",$result2[$prevent_work_date]);
                   if($result2[$prevent_work_date]!='0000-00-00'){
                   $year_thai =$ex2[0]+543;}else{$year_thai =$ex2[0];}
		   $prevent_work_date="$ex2[2]/$ex2[1]/$year_thai  ";

		   $ex2=explode("-",$result2[$prevent_sum_date]);
                   if($result2[$prevent_sum_date]!='0000-00-00'){
                   $year_thai =$ex2[0]+543;}else{$year_thai =$ex2[0];}
		   $prevent_sum_date="$ex2[2]/$ex2[1]/$year_thai";

echo "<TR bgcolor=$bg>
	<TD><CENTER><p>$i.</p></CENTER></TD>
	<TD> <font size='2'>$result2[$prevent_improve] </font> </TD>
	<TD> <font size='2'>$prevent_work_date</TD>
	<TD><font size='2'>$prevent_sum_date </font></TD>
	<TD><font size='2'>$result2[$prevent_man]</TEXTAREA></TD>
</TR>";

 $j++;
	}//----end for $i ?>
</TABLE>
</fieldset>
<label>ระยะเวลาในการดำเนินการเพื่อให้กรรมการความเสี่ยงติดตามประเมินผล</label><BR> 
 <font color="#ff0000">***ระยะเวลา  <?=$result2[evaluate]?> *** สามารถให้กรรมการตรวจได้ในวันที่ 
     <?php $check_date=$result2[check_date];
            echo	DateThai1($check_date);?></font><BR> 
 
 <?php 

 echo "<H3>ไฟล์ที่เกี่ยวข้อง</H3>"; 

   if($result2[mng_file1]!=''){echo "<a href='myfile/$result2[mng_file1]' ><span class='fa fa-download'></span> Download File1"."<br /></a>";}
               if($result2[mng_file2]!=''){echo "<a href='myfile/$result2[mng_file2]' ><span class='fa fa-download'></span> Download File2"."<br /></a>";}
               if($result2[mng_file3]!=''){echo "<a href='myfile/$result2[mng_file3]' ><span class='fa fa-download'></span> Download File3"."<br /></a>";}

               if($admin=='Y'){ ?>
 <label>การประเมินผลของคณะกรรมการ</label><BR>
 <form role="form" action='process_admin_check.php' enctype="multipart/form-data" method='post'> 
 <input name="check" id="check" type="radio" value="G" /> ผ่าน<BR>
 <input name="check" id="check" type="radio" value="Y" /> กำลังดำเนินการ<BR>
 <input name="check" id="check" type="radio" value="R" /> ไม่ผ่าน<BR><BR>
 <INPUT type="hidden" name="takerisk_id" id="takerisk_id" value="<?=$takerisk_id?>"/>
 <button type="submit" class="btn btn-primary">บันทึก  </button>
<?php
}
 }elseif($admin=='Y' or ($admin=='A' and $result2[main_dep]==$_SESSION[user_main_dep])or $result2[res_dep]==$_SESSION[user_dep_id]){ ?>
 

<H1><small>การแก้ไขความเสี่ยง Root Cause Analysis : RCA</small></H1>
	<form action='prcNomal_RcaForm.php' method="post" enctype="multipart/form-data"><!-- proc_mng_risk2.php -->
		
		 <label>วันที่วิเคราะห์ความเสี่ยง</label>  
		<input type="date" name='mng_date' id="datepicker" title='กรุณาเลือกวันที่วิเคราะห์ความเสี่ยง'  class="form-control" required  />
 
		 <label>รายชื่อผู้เข้าร่วม</label>
		<TEXTAREA NAME="rca_list_user"  class="form-control"></TEXTAREA> 
		 
		 <label>คณะกรรมการ RM ประจำหน่วยงาน</label>
		 <TEXTAREA   NAME="rca_keyman"  class="form-control" ></TEXTAREA>
 
<H4>วิเคราะห์อุบัติการณ์ความเสี่ยง</H4>
 	 <label>บรรยายสรุปเหตุการณ์ (โดยย่อ)</label>
		<TEXTAREA NAME="rca_event" class="form-control" ></TEXTAREA>

		 <label> เหตุการณ์ที่เกิดขึ้นมีการวางระบบไว้อย่างไร(ใส่ Flow Chart,QP,WI ถ้าสามารถทำได้)</label>
		 <TEXTAREA NAME="rca_flow_system" class="form-control"></TEXTAREA>
		 
	 <h4>1. ระบบงาน</h4> 
		 <label> โปรดระบุการปฏิบัติงานหรือแนวทางที่แตกต่างไปจากเดิม(ขณะเกิดความเสี่ยงขึ้น)</label>
 		<TEXTAREA NAME="rca_differ_system" class="form-control"></TEXTAREA>
 
		 
	 <h4>2. ทรัพยากรมนุษย์</h4> 
		 <label>เจ้าหน้าที่มีคุณสมบัติ/ความสามารถเพียงพอหรือไม่</label>
 		  <TEXTAREA NAME="rca_property_man" class="form-control"></TEXTAREA>

		 <label>เจ้าหน้าที่ได้รับการปฐมนิเทศ/ฝึกอบรมในการป้องกันเหตุการณ์ดังกล่าวหรือไม่</label>
 		 <TEXTAREA NAME="rca_training_man" class="form-control" ></TEXTAREA>

		 <label>เจ้าหน้าที่ได้รับการประเมินผลการปฏิบัติงานดังกล่าวเป็นประจำหรือไม่</label>
 		<TEXTAREA NAME="rca_evaruate_man" class="form-control"></TEXTAREA>

		 <label>อัตรากำลังเพียงพอหรือไม่  มีแผนสำรองกรณีขาดกำลังคนหรือไม่</label>
 		<TEXTAREA NAME="rca_rate_man" class="form-control" ></TEXTAREA>
		
	 <h4>3. เครื่องมือ/อุปกรณ์</h4> 
		 <label>เครื่องมือเพียงพอต่อการใช้งานหรือไม่  มีแผนในการหาให้เพียงพออย่างไร</label>
 		  <TEXTAREA NAME="rca_rate_tool" class="form-control"></TEXTAREA>
 		
		 <label>มีการตรวจสอบความพร้อมใช้ของเครื่องมือสม่ำเสมอหรือไม่</label>
 		 <TEXTAREA NAME="rca_chk_tool" class="form-control"></TEXTAREA>
	
		 <label>ความบกพร่องของเครื่องมือเป็นสาเหตุส่วนหนึ่งของการเกิดเหตุการณ์หรือไม่</label> 
 		  <TEXTAREA NAME="rca_defective_tool" class="form-control"></TEXTAREA>
 
		
	 <h4>4. สิ่งแวดล้อม</h4> 
		 <label>สิ่งแวดล้อมอะไรบ้างที่ส่งผลต่อเหตุการณ์ครั้งนี้  เช่น  เสียง การถูกรบกวน แสง โครงสร้างทางกายภาพ อื่นๆ</label>
 		 <TEXTAREA NAME="rca_environment"  class="form-control" ></TEXTAREA>

		
	 <h4>5. ระบบสารสนเทศ/การสื่อสาร</h4> 
		 <label>การเข้าถึงยาก/การไม่มีข้อมูลหรือคู่มือ เป็นสาเหตุของเหตุการณ์หรือไม่</label>
 		 <TEXTAREA NAME="rca_techno" class="form-control"></TEXTAREA>
 
		 
		 <label>การสื่อสารเป็นปัจจัยส่วนหนึ่งที่ทำให้เกิดเหตุการณ์ครั้งนี้หรือไม่</label>
 		 <TEXTAREA NAME="rca_communication"  class="form-control"></TEXTAREA>
 		 
	 <h4>6. การนำองค์กร/วัฒนธรรมองค์กร</h4> 
		 <label>บุคลากรที่เกี่ยวข้องกับเหตุการณ์นี้ หัวหน้างาน/หัวหน้าฝ่าย มีส่วนร่วมในการตรวจสอบหรือไม่</label>
 		<TEXTAREA NAME="rca_office_yes"  class="form-control" ></TEXTAREA>
		                 
	 <h4>7. ปัจจัยภายนอกอื่นๆ</h4> 
                
                <label>มีปัจจัยภายนอกที่ควบคุมไม่ได้  ที่อาจเป็นสาเหตุทำให้เกิดเหตุการณ์ครั้งนี้หรือไม่</label>
 		<TEXTAREA NAME="rca_external_factor"  class="form-control"></TEXTAREA>
                <label>สรุปสาเหตุของความเสี่ยง</label>
 		<TEXTAREA NAME="rca_head_yes"  class="form-control" ></TEXTAREA>

<h3>การป้องกันแก้ไขสาเหตุรากเหง้าอุบัติการณ์ความเสี่ยง</h3>
 
<div class="table-responsive">
 <table class="table table-bordered table-hover table-striped tablesorter">
<TR >
	<th><CENTER>ลำดับ</CENTER></th>
	<th><CENTER>วิธีป้องกันแก้ไข</CENTER></th>
	<th><CENTER>วันที่ดำเนินการ</CENTER></th>
	<th><CENTER>วันที่สรุปผลดำเนินการ</CENTER></th>
	<th><p><CENTER>ผู้รับผิดชอบ</CENTER></p><BR></th>
</TR>


<?php
	 $bdate=date('d/m/Y');
$j=11;
 	for($i=1;$i<=10;$i++){	
	if($bg == "#F4F4F4") { //ส่วนของการ สลับสี 
		$bg = "#FFFFFF";
		}else{
		$bg = "#F4F4F4";
		}
		?>

<?php
	  $prevent_improve="prevent".$i."_improve";
	  $prevent_work_date="prevent".$i."_work_date";
	  $prevent_sum_date="prevent".$i."_sum_date";
	  $prevent_man="prevent".$i."_man";
	   
echo "<TR bgcolor=$bg>
	<TD><CENTER>$i.</CENTER></TD>
	<TD><TEXTAREA NAME='$prevent_improve'   class='form-control'   ></TEXTAREA></TD>
	<TD><input type='date' name='$prevent_work_date' id='datepicker$i'  class='form-control'    placeholder='$bdate'    /></TD>
	<TD><input type='date' name='$prevent_sum_date' id='datepicker$j'  class='form-control'    placeholder='$bdate'    /></TD>
	<TD><TEXTAREA NAME='$prevent_man'  class='form-control'   ></TEXTAREA></TD>
</TR>";

 $j++;
	}//----end for $i ?>
</TABLE>
	 <INPUT TYPE="hidden" NAME="takerisk_id" value="<?=$takerisk_id?>"   >
 
<label>ไฟล์ที่เกี่ยวข้อง เช่น รูปภาพ เอกสารการสรุปผลการป้องกันแก้ไข (หากมี)</label>	
<input type="file" name="filUpload1"><br>
<input type="file" name="filUpload2"><br>
<input type="file" name="filUpload3"><br></p>
<label>ระยะเวลาเพื่อให้กรรมการความเสี่ยงติดตามประเมินผล</label>
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
<input type="hidden" name="user_edit" value="<?=$user_edit?>">
<button type="submit" class="btn btn-primary">บันทึก  </button>
<button type="reset" class="btn btn-default">Reset  </button>  
 
 
  </form> 
 	<?php } //--------------mng_status = N  
  ?>		 