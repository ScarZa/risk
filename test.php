<?php session_start(); ?> 
<?php include 'header.php';?>
  
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<script type="text/javascript">
function nextbox(e, id) {
    var keycode = e.which || e.keyCode;
    if (keycode == 13) {
        document.getElementById(id).focus();
        return false;
    }
}
</script>
<script type="text/javascript">
		function popup(url,name,windowWidth,windowHeight){    
				myleft=(screen.width)?(screen.width-windowWidth)/2:100;	
				mytop=(screen.height)?(screen.height-windowHeight)/2:100;	
				properties = "width="+windowWidth+",height="+windowHeight;
				properties +=",scrollbars=yes, top="+mytop+",left="+myleft;   
				window.open(url,name,properties);
	}
</script>    

        <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>เขียนความเสี่ยง</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-edit"></i> เขียนความเสี่ยง</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              ระบุเหตุการณ์ <a class="alert-link" target="_blank" href="#">โอกาสที่จะประสบกับความสูญเสีย หรือสิ่งไม่พึงประสงค์ โอกาสความน่าจะเป็นที่จะเกิดอุบัติการณ์</a> 
            </div>
          </div>
        </div><!-- /.row -->

        <div class="row">
          <div class="col-lg-12">
              <form class="navbar-form navbar-left" role="form" action='prcWriteRisk.php' enctype="multipart/form-data" method='post'> 
              <div class="form-group">
               <label>HN &nbsp;</label>
               <input type="text" id='hn'  class="form-control"  placeholder="HN" size=''  name='hn' onkeydown="return nextbox(event, 'an');">           	 
             </div>

              <div class="form-group"> 
              <label>AN &nbsp;</label>
                <input type="text"  id='an'   class="form-control" placeholder="AN" size='' name='an' onkeydown="return nextbox(event, 'take_date');">
			   </div>		
 
			   <div class="form-group"> 
                <?php //include 'datepicker.php';?>      
                <label>วันที่เกิดเหตุ &nbsp;</label>
             	<!--<input type="date" placeholder="วันที่เกิดเหตุ"   class="form-control"  id='take_date'   name="take_date"  required  onkeydown="return nextbox(event, 'take_time');" />-->
		<?php include'DatePicker/index.php'; ?> 
    <input type="text" id="datepicker-th-1" name="take_date"  placeholder='วันที่เกิดเหตุ' class="form-control" required value="<?=$take_date?>"/> 

             	</div>
             	 <div class="form-group">    
             	 <label>เวลาที่เกิดเหตุ &nbsp;</label>
                <input type="text"   placeholder="" id='take_time'  class="form-control"   size='' name='take_time' onkeydown="return nextbox(event, 'combobox1');" style="width: 100px" />
         	    </div>
  				 <br /> <br />
           <div class="form-group">
             	<?php //include 'jquery.php';?>
 				<label>สถานที่เกิดเหตุ &nbsp;</label>
 				<select name="take_place" id="combobox1" required  class="form-control"  onkeydown="return nextbox(event, 'combobox2');"> 
				<?php	$sql = mysql_query("SELECT *  FROM place  ");
				 echo "<option value=''></option>";
				 while( $result = mysql_fetch_assoc( $sql ) ){
				 echo "<option value='$result[place]'>$result[name] </option>";
				 } ?>
			 </select>
			 </div>
  			 <div class="form-group">
  			<label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หน่วยงานที่เกี่ยวข้อง &nbsp;</label>
  			<select name="take_dep" id="combobox2"  class="form-control"  required onkeydown="return nextbox(event, 'category');"> 
			<?php	$sql = mysql_query("SELECT *  FROM department  ");
				echo "<option value=''></option>";
				while( $result = mysql_fetch_array( $sql ) ){
				echo "<option value='$result[dep_id]'>$result[name] </option>";
			} ?>
			</select>	
             <!--   <p class="form-control-static">email@example.com</p> -->
            </div>
                <br /> <br />           
              <div class="form-group"><p class="help-block">เลือกหมวดความเสี่ยงอย่างน้อย 1 รายการ.</p>
             	<?php include 'subcategory.php';?><!-- หมวดความเสี่ยง / รายการความเสี่ยง -->            
              </div>
   				<br />   
              <div class="form-group">
                <label>รายการความเสี่ยงอื่น ๆ</label>
                <input type="text"   placeholder="รายการความเสี่ยงอื่น ๆ" id='take_other'  class="form-control"   size='' name='take_other' onkeydown="return nextbox(event, 'take_detail');" />
              </div>
			<br /> <br />
              <div class="form-group">
                <label>บรรยายเหตุการณ์ความเสี่ยง</label>
   				<textarea class="form-control" COLS="50" required placeholder='บรรยายเหตุการณ์ความเสี่ยง' name='take_detail' id='take_detail' onkeydown="return nextbox(event, 'take_first');"></textarea>
              </div>
<br /> <br />
			   <div class="form-group">
                <label>การแก้ไขเบื้องต้น</label><br>
 				<textarea class="form-control"  COLS="80" required  placeholder='การแก้ไขเบื้องต้น' name='take_first' id='take_first' onkeydown="return nextbox(event, 'hide-option1');"></textarea>
     		</div>
              <br /> <br />  
             <div class="form-group">
                <label>ระดับความเสี่ยง </label><br>
 				<?php   $sql = mysql_query("SELECT *  FROM level_risk  ");
				echo "<option value=''></option>";
				$i=1;
				while( $result = mysql_fetch_assoc( $sql ) ){
				echo " <INPUT TYPE='radio' NAME='level_risk' style='width:20px; height:20px;' VALUE='$result[level_risk]'  id='hide-option$i' required >$result[level_risk]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
 				$i++;
				 } ?></select>	
     		</div>


 
<div class="col-lg-12">
				 <ul>
				 <li class="dropdown  alerts-dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-square-o-down"></i> ดูระดับความเสี่ยงในด้านต่าง ๆ  <b class="caret"></b></a>
<ul class="dropdown-menu">
  <strong><i class="fa fa-comments-o"></i> ระดับความเสี่ยง ด้านคลินิก</strong>
  <li ><a href="javascript:popup('knowledge_level_risk.php?no=1','',800,600)"><i class="fa fa-arrow-circle-right"></i> ความคลาดเคลื่อนจากกระบวนการใช้ยา ได้ทั้ง ADR และ  Medication Error</a></li> 
  <li><a href="javascript:popup('knowledge_level_risk.php?no=2','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยได้รับบาดเจ็บจากพฤติกรรมรุนแรง</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=3','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยพฤติกรรมก้าวร้าวรุนแรง</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=4','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยได้รับบาดเจ็บจากอุบัติเหตุ</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=5','',800,600)"><i class="fa fa-arrow-circle-right"></i> การเกิดภาวะแทรกซ้อนจากการจำกัดพฤติกรรม</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=6','',800,600)"><i class="fa fa-arrow-circle-right"></i> การเกิดภาวะแทรกซ้อนจากการการรักษาด้วยไฟฟ้า</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=7','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยมีภาวะแทรกซ้อนทางกาย</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=8','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยฆ่าตัวตาย</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=9','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยหลบหนี</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=10','',800,600)"><i class="fa fa-arrow-circle-right"></i> เจ้าหน้าที่ได้รับบาดเจ็บจากการปฏิบัติงาน </a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=11','',800,600)"><i class="fa fa-arrow-circle-right"></i> ผู้ป่วยติดเชื้อในโรงพยาบาล (NI) และในชุมชน(CI) </a></li>
<li class="divider"></li>
<strong><i class="fa fa-comments-o"></i>  ระดับความเสี่ยง ระบบสนับสนุนบริการ</strong>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=12','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านข้อมูล : การให้บริการข้อมูลข่าวสารคลาดเคลื่อน</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=13','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านข้อมูล : การบันทึกข้อมูลคลาดเคลื่อน</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=14','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านการเงิน :  เอกสารทางด้านการเงินคลาดเคลื่อนหรือไม่ครบถ้วน  </a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=15','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านการเงิน : ส่งเรียกเก็บค่ารักษาพยาบาลไม่ทันภายในเวลาที่กำหนด </a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=16','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านเครื่องมือ : การใช้ Internet, Intranet และอุปกรณ์คอมพิวเตอร์ไม่พร้อมใช้</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=17','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านเครื่องมือ : ความพร้อมใช้ของระบบสำรองไฟ</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=18','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านความปลอดภัย : ความปลอดภัยทางด้านทรัพย์สิน</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=19','',800,600)"><i class="fa fa-arrow-circle-right"></i> ด้านความปลอดภัย : สิ่งแวดล้อมไม่ปลอดภัย(ด้านระบบบำบัดน้ำเสีย) </a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=20','',800,600)"><i class="fa fa-arrow-circle-right"></i> อื่น ๆ : การทิ้งขยะไม่ถูกประเภท</a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=21','',800,600)"><i class="fa fa-arrow-circle-right"></i> อื่น ๆ : การถ่ายรูปผู้ป่วยคลาดเคลื่อน </a></li>
  <li><a href="javascript:popup('knowledge_level_risk.php?no=22','',800,600)"><i class="fa fa-arrow-circle-right"></i> อื่น ๆ : การจัดอาหารไม่ถูกต้อง</a></li>
</ul></li>
<ul></div>
   <br /> <br />
  			<div class="form-group">
				<label> ไฟล์ที่เกี่ยวข้อง เช่น รูปภาพ เอกสาร หลักฐานต่างๆ (หากมี)</label>
			   	<input type="file" name="filUpload1"  id='filUpload1'><br>
				<input type="file" name="filUpload2" id='filUpload2'><br>
			 	<input type="file" name="filUpload3" id='filUpload3'><br></p>
			</div><br />  
              <button type="submit" class="btn btn-primary">บันทึก  </button>
              <button type="reset" class="btn btn-default">Reset  </button>  
  </form> 
 
       </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->


 
 
