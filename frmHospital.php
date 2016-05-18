<?php include 'header.php';?>
<?php  if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
 <script type="text/javascript">
function nextbox(e, id) {
    var keycode = e.which || e.keyCode;
    if (keycode == 13) {
        document.getElementById(id).focus();
        return false;
    }
}
</script>
  <script language="javascript">
function fncSubmit()
	{
	 if(document.form1.name_hospital.value=='')
		{
			alert('กรุณากรอกสถานที่');
			document.form1.name_hospital.focus();		
			return false;
		}else{	
			return true;
			document.form1.submit();
		}
}
</script>
 <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>ตั้งค่าโรงพยาบาล</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ตั้งค่าโรงพยาบาล</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              ตั้งค่าโรงพยาบาล <a class="alert-link" target="_blank" href="#">  เพื่อใช้งานในระบบบริหารความเสี่ยง</a> 
            </div>
          </div>
        </div><!-- /.row -->
			<?php include 'connect.php';
			  
			  
			 $sqlGet=mysql_query("select * from  hospital   ");
			 $resultGet=mysql_fetch_assoc($sqlGet);
			 
			?>    
    <div class="row">
    <div class="col-lg-4"> 
        <div class="alert alert-success">
		<form name='form1'   action='prcHospital.php' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
			<div class="form-group">	
			<label>ชื่อโรงพยาบาล </label>
			<input type='text' name='name'  id='name_hospital' placeholder='ชื่อโรงพยาบาล' class='form-control'  value='<?php echo $resultGet[name];?>'onkeydown="return nextbox(event, 'save');" required >
			 </div>
                    		       <div class="form-group">	
			<label>ผู้บริหาร </label>
                         	<select name="m_name" id="m_name" required  class="form-control"  onkeydown="return nextbox(event, 'fname');"> 
				<?php	$sql = mysql_query("SELECT user_id,concat(user_fname,' ',user_lname) as fullname  FROM user order by user_fname ");
				 echo "<option value=''>-เลือกผู้บริหาร-</option>";
				 while( $result = mysql_fetch_assoc( $sql ) ){
          if($result[user_id]==$resultGet[manager]){$selected='selected';}else{$selected='';}
				 echo "<option value='$result[user_id]' $selected>$result[fullname] </option>";
				 } ?>
			 </select>

			 </div> 
                                         <div class="form-group">
                <label>สัญลักษณ์องค์กร &nbsp;</label>
                <input type="file" name="image"  id="image" class="form-control"/>
                    </div>
			  
			 
<?PHP 
	 	$hospital=$resultGet[hospital];
		echo "<input type='hidden' name='hospital' value='$hospital'>";
		echo "<input type='hidden' name='method' value='update'>";
	 
 ?> 
        <p><button  class="btn btn-primary" id='save'> บันทึก </button > <input type='reset' class="btn btn-danger"   > </p>
		</form>
	  </div>
    </div>
    </div>
 
 
 
 <?PHP include'footer.php';  ?>
