<?php include 'header.php';?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php include 'jquery.php';
$status_process=$_REQUEST['status_process']; ?>
<script type="text/javascript">
function nextbox(e, id) {
    var keycode = e.which || e.keyCode;
    if (keycode == 13) {
        document.getElementById(id).focus();
        return false;
    }
}
</script>
<!-- ฟังก์ชั่นปริ้นท์ -->
 <script type="text/javascript">
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;
     window.print();

     document.body.innerHTML = originalContents;
}
</script>
        <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>รายละเอียด/ดำเนินการความเสี่ยง</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <?php  if($_SESSION[admin]=='Y' or $_SESSION[admin]=='A'){?>
              <li><a href="listRiskInBox.php"><i class="fa fa-envelope"></i> ความเสี่ยงที่ได้รับ</a></li>
              <?php }?>
              <li class="active"><i class="fa fa-envelope"></i> รายละเอียด/ดำเนินการความเสี่ยง</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              รายละเอียดความเสี่ยง <a class="alert-link" target="_blank" href="#">โอกาสที่จะประสบกับความสูญเสีย หรือสิ่งไม่พึงประสงค์ โอกาสความน่าจะเป็นที่จะเกิดอุบัติการณ์</a> 
            </div>
          </div>
        </div><!-- /.row -->

<?php
$user_edit=$_SESSION['user_id'];
$takerisk_id=$_GET[takerisk_id];
include 'connect.php';
$sql=mysql_query("select concat(u1.user_fname,' ',u1.user_lname) as user_write_name,t1.*,d1.name as department_name ,p1.name as place_name  ,c1.name as category_name ,s1.name as subcategory_name,t1.detail_recycle,t1.recycle 
,t1.move_status,t1.receive_date,
(select concat(u1.user_fname,' ',u1.user_lname) from takerisk t1 LEFT OUTER JOIN user u1 ON u1.user_id=t1.receiver where t1.takerisk_id='$takerisk_id') user_receiver,
(select concat(u1.user_fname,' ',u1.user_lname) from takerisk t1 LEFT OUTER JOIN user u1 ON u1.user_id=t1.return_user where t1.takerisk_id='$takerisk_id') return_user    
from takerisk t1
LEFT OUTER JOIN department d1 ON d1.dep_id=t1.res_dep
LEFT OUTER JOIN place p1 ON p1.place=t1.take_place
LEFT OUTER JOIN category c1 ON c1.category=t1.category
LEFT OUTER JOIN user u1 ON u1.user_id=t1.user_id
LEFT OUTER JOIN subcategory s1 ON s1.subcategory=t1.subcategory
where t1.takerisk_id='$takerisk_id' " );
$result=mysql_fetch_assoc($sql);
echo mysql_error();
								include_once ('funcDateThai.php');
								$take_date= "$result[take_date]";
								DateThai1($take_date); //-----แปลงวันที่เป็นภาษาไทย
?>
    <div class="row">
          <div class="col-lg-12">
          <!-- ค้นหา -->
          <a href="#" onClick="window.open('detailRiskInBox_PDF.php?takerisk_id=<?= $takerisk_id?>','','width=700,height=900'); return false;" title="ปริ้นท์หน้านี้">
              <input type="image" src='images/printer.png' onclick="" align="right" title='ปริ้นท์หน้านี้'></a>
           <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><span class="fa fa-envelope"></span> Detail</h3>
              </div>
              <div class="panel-body">
              <table width='auto'>
              <thead>
              <tr><th width='30%' valign="top">HN : </th><td  width='70%'><?php echo $result[hn];?></td></tr>    
              <tr><th valign="top">AN : </th> <td><?php echo $result[an];?></td></tr>
              <tr><th valign="top">บุคลากรที่ประสบเหตุการณ์ : </th> <td><?php echo $result[take_other];?></td></tr>  
              <tr><th valign="top">วันที่เกิดเหตุ : </th> <td><?php echo DateThai1($take_date);?></td></tr> 
               <tr><th valign="top">เวลา : </th> <td><?php echo $result[take_time];?></td></tr>
               <tr><th valign="top">วันที่บันทึกความเสี่ยง : </th> <td><?php echo DateThai1($result[take_rec_date]);?></td></tr>
               <tr><th valign="top">สถานที่เกิดเหตุ : </th> <td><?php echo $result[place_name];?></td></tr> 
               <tr><th valign="top">หน่วยงานที่เกี่ยวข้อง : </th> <td><?php echo $result[department_name]; $take_dep=$result[res_dep];?></td></tr> 
               <tr><th valign="top">หมวดความเสี่ยง : </th> <td><?php echo $result[category_name];?></td></tr>
               <tr><th valign="top">รายการความเสี่ยง : </th> <td><?php echo $result[subcategory_name];?></td></tr>
               <tr><th valign="top">ระดับ : </th> <td><?php echo $level_risk=$result[level_risk];?></td></tr>  
               <tr><th valign="top">รายละเอียดเหตุการณ์ความเสี่ยง : </th> <td><?php echo $result[take_detail];?></td></tr> 
	       <tr><th valign="top">การแก้ไขเบื้องต้น : </th> <td><?php echo $result[take_first];?></td></tr> 
               <tr><th valign="top">ข้อเสนอแนะ : </th> <td><?php echo $result[take_counsel];?></td></tr>
               <tr><th valign="top">ไฟล์แนบ : </th> <td>
               <?php 
               if($result[take_file1]!=''){echo "<a href='myfile/$result[take_file1]' target='_blank'><span class='fa fa-download'></span> Download File1"."<br />";}
               if($result[take_file2]!=''){echo "<a href='myfile/$result[take_file2]' target='_blank'><span class='fa fa-download'></span> Download File2"."<br />";}
               if($result[take_file3]!=''){echo "<a href='myfile/$result[take_file3]' target='_blank'><span class='fa fa-download'></span> Download File3"."<br />";}
               ?></td></tr>  
             <?php if($_GET[lookdep]!=''){  echo "<tr><th>ผู้เขียน : </th><td> $result[user_write_name] </td></tr>"; }            ?>  
               
	     <?php 		
		$sqlUser = mysql_query("select admin from user where user_id='$user_id' ");
         	$resultUser=mysql_fetch_assoc($sqlUser);    
            	$admin = $resultUser[admin]; 
		if($admin=='Y'){ echo "<tr><th>ผู้เขียน : </th><td> $result[user_write_name] <font color='red'>(ดูได้เฉพาะคณะกรรมการบริหารความเสี่ยง)</font></td></tr>"; ?>
                                 <tr><th>ผู้แจ้งย้าย : </th><td> <?= $result[user_receiver]?>  &nbsp;&nbsp;<b>วันที่ :</b> <?php if($result[receive_date]!='0000-00-00'){ echo DateThai1($result[receive_date]);}?><font color='red'>(ดูได้เฉพาะคณะกรรมการบริหารความเสี่ยง)</font></td></tr>
               <?php } 
               if($result[return_risk]=='Y'){?>
               <tr><th>ผู้ส่งคืน : </th><td> <?= $result[return_user]?>  &nbsp;&nbsp;<b>วันที่ :</b> <?php if($result[return_date]!=NULL){ echo DateThai1($result[return_date]);}?><font color='red'>(ดูได้เฉพาะคณะกรรมการบริหารความเสี่ยง)</font></td></tr>   
                                            
               <?php }
               if($result[recycle]=='Y'){ ?>
               <tr><th valign="top">เหตุผลที่ย้ายลงถังขยะ : </th> <td><?php echo $result[detail_recycle];?></td></tr>
               <?php }?>
              </thead>

               <div class="text-right" style="float: right;width: auto">
               <?php 
               $takerisk=$result[takerisk_id];
               $sqlCheckMove=mysql_query("select mng_status from mngrisk where takerisk_id='$takerisk' ");
               $resultCheckMove=mysql_fetch_assoc($sqlCheckMove);
               if(($resultCheckMove[mng_status]=='N' and $result['res_dep']==$_SESSION[user_dep_id]) or $admin=='A'){
               ?>
                   <a href='prcWriteRisk.php?method=move_risk&takerisk_id=<?=$result[takerisk_id]?>'>ส่งคืนความเสี่ยง <i class="fa fa-arrow-circle-left"></i></a><br><br>
                <?php } 
                if(($admin=='Y' or $admin=='A') and $result[recycle]=='N'){?>
                 <a href="#" onclick="return popup('pass_risk.php?takerisk_id=<?=$result[takerisk_id]?>',popup,400,300);">ส่งต่อความเสี่ยง <i class="fa fa-arrow-circle-right"></i></a>
                <?php } if($admin=='Y' and $result[recycle]=='N'){?>
            <br><br><a href='frmWriteRisk.php?method=edit&takerisk_id=<?=$result[takerisk_id]?>'>แก้ไขข้อความไม่เหมาะสม <i class="fa fa-edit"></i></a>
            <br><br><a href='frmWriteRisk.php?check=1&method=edit&&takerisk_id=<?=$result[takerisk_id]?>'>แก้ไขหมวดและรายการความเสี่ยง <i class="fa fa-edit"></i></a>
            <br><br><a href='detail_recycle.php?takerisk_id=<?=$result[takerisk_id]?>'>ย้ายเข้าถังขยะ <i class="fa fa-trash-o"></i></a>
            <br><br><a href='prcNomal_RcaForm.php?takerisk_id=<?=$result[takerisk_id]?>'>ย้ายไปประเมิน <i class="fa fa-bolt"></i></a>
                <?php } ?>
		
                </div>
              </table>
            	  		</div>
             		 </div>
              <div class="row">
          <div class="col-lg-12">
             	<?php 
             	
             	 if(($_GET[method]=='remove_risk' or $result[move_status]=='Y')and $result[recycle]=='N' and $admin=='Y'){
             	 	echo " <form role='form' action='prcWriteRisk.php' enctype='multipart/form-data' method='post'> ";
             	 		echo "<h1><small>เลือกหน่วยงานที่ต้องการย้ายความเสี่ยงไป</small></h1>";
						echo		"<div class='form-group'>";
				  		echo		"<label>หน่วยงานที่เกี่ยวข้อง &nbsp;</label>";
				  		echo		"<select name='take_dep' id='combobox1' required onkeydown='return nextbox(event, 'combobox2');'>";
						 			$sql = mysql_query("SELECT *  FROM department  ");						 			
									echo "<option value=''></option>";
									while( $result = mysql_fetch_array( $sql ) ){
									if($result[dep_id]==$take_dep){$selected='selected';}else {$selected='';}
									echo "<option value='$result[dep_id]' $selected>$result[name] </option>";
							}  
						echo  "</select>";	
				    //    echo "<p class='form-control-static'>*ตรวจสอบหน่วยงานก่อนคลิกบันทึก</p> ";		     
				      
				       
                                       echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				       echo		"<label>ระดับ &nbsp;</label>";
				       echo		"<select name='level_risk' id='combobox2' required onkeydown='return nextbox(event, 'submit');'>";
				       $sql = mysql_query("SELECT *  FROM level_risk  ");
				       echo "<option value=''></option>";
				       while( $result = mysql_fetch_array( $sql ) ){
							if($result[level_risk]==$level_risk){$selected='selected';}else {$selected='';}
				       	echo "<option value='$result[level_risk]' $selected>$result[level_risk] </option>";
				       }
				       echo  "</select>";
				       //    echo "<p class='form-control-static'>*ตรวจสอบหน่วยงานก่อนคลิกบันทึก</p> ";
				       echo "</div>";
				       echo "<label>เกี่ยวข้องกับทีม&nbsp;</label>";
				       echo " <INPUT TYPE='checkbox' NAME='pct' style='width:20px; height:20px;' VALUE='Y'  id=''  > PCT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
				       echo " <INPUT TYPE='checkbox' NAME='ic' style='width:20px; height:20px;' VALUE='Y'  id=''  > IC <br>";
                                       echo "<label>ทำRCA&nbsp;</label>";
				       echo " <INPUT TYPE='checkbox' NAME='rca' style='width:20px; height:20px;' VALUE='Y'  id=''  > RCA <br><br>";
				       
                                       echo "<input type='hidden' name='takerisk_id' value='$takerisk_id'>";
				       echo "<input type='hidden' name='method' value='change_risk'>";
				       echo "<button type='submit' class='btn btn-primary' id='submit'>บันทึก  </button>"; 
				       echo "</form>";
				exit();
             	 }
								
             	if($result[recycle]=='N'){
             	if($result[rca]=='Y'){
				include'rcaForm.php';
				}else{
 				 include'normalForm.php';		 
				}//end else Level F-I ---------------------------  
				
                }
			?>
               
             		 
            	  </div>
              </div>
          </div></div>

 
 <?php include 'footer.php';?>
