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
	 if(document.form1.user_pwd.value != document.form1.user_pwd2.value)
		{
			alert('การยืนยันรหัสผ่านไม่ตรงกัน กรุณาตรวจสอบ');
			document.form1.user_pwd.focus();		
			return false;
		}else{	
			return true;
			document.form1.submit();
		}
}
</script>
 <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>ตั้งค่าผู้ใช้งาน</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ตั้งค่าผู้ใช้งาน</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              ตั้งค่าผู้ใช้งาน <a class="alert-link" target="_blank" href="#">  เพื่อเข้าใช้งานในระบบบริหารความเสี่ยง</a> 
            </div>
          </div>
        </div><!-- /.row -->
			<?php include 'connect.php';
			 if($_GET[user_id]!=''){ 
			 $user_id=$_GET[user_id];
			 $sqlGet=mysql_query("select * from  user  where user_id='$user_id' ");
			 $resultGet=mysql_fetch_assoc($sqlGet);
			 }
			   ?>    
    <div class="row">
    <div class="col-lg-4">       
		<form name='form1'   action='prcEditUser.php' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
			<div class="form-group">	
			<label>ชื่อ </label>
			<input type='text' disabled name='user_fname'   placeholder='ชื่อ' class='form-control'  value='<?php echo $resultGet[user_fname];?>'onkeydown="return nextbox(event, 'user_lname');" required>
			 </div> 
			<div class="form-group">	
			<label>นามสกุล </label>
			<input type='text' disabled name='user_lname'  id='user_lname'  placeholder='นามสกุล' class='form-control'  value='<?php echo $resultGet[user_lname];?>' onkeydown="return nextbox(event, 'dep_id');"   required>
			 </div> 
			 <br />
	
			<div class="form-group">	
			<label>ชื่อที่ใช้งาน </label>
			<input type='text' name='user_account'  id='user_account' placeholder='ชื่อที่ใช้งาน' class='form-control'  onkeydown="return nextbox(event, 'user_pwd');"   value='<?php echo $resultGet[user_name];?>' required>
			 </div> 
			
			<?PHP 
			if($_GET[user_id]!=''){
			 	$pwd=$resultGet[user_pwd];			
			}else{
				$pwd='';
			}
			?> 
			<?php 	if($_GET[user_id]!=''){?>
			<div class="form-group">
			<label>รหัสผ่าน </label>
			<input type='password' name='user_pwd'  id='user_pwd' placeholder='รหัสผ่าน' class='form-control'  value=''  onkeydown="return nextbox(event, 'user_pwd2');"    >
			 </div>
	 		<div class="form-group">
			<label>ยืนยันรหัสผ่าน </label>
			<input type='password' name='user_pwd2'   id='user_pwd2' placeholder='ยืนยันรหัสผ่าน' class='form-control'  value=''  onkeydown="return nextbox(event, 'save');" >
			 </div>
			 <?php }else{?>
			 			<div class="form-group">
			<label>รหัสผ่าน </label>
			<input type='password' name='user_pwd'  id='user_pwd' placeholder='รหัสผ่าน' class='form-control'  value=''  onkeydown="return nextbox(event, 'user_pwd2');"   required>
			 </div>
	 		<div class="form-group">
			<label>ยืนยันรหัสผ่าน </label>
			<input type='password' name='user_pwd2'   id='user_pwd2' placeholder='ยืนยันรหัสผ่าน' class='form-control'  value=''   onkeydown="return nextbox(event, 'save');"  required>
			 </div>
			 <?php }?>
			 <?php 	if($_GET[user_id]!=''){echo "*หากไม่เปลี่ยนรหัสผ่านไม่ต้องแก้ไข";}?>
<?PHP 
	if($_GET[user_id]!=''){
		echo "<input type='hidden' name='user_id' value='$user_id'>";
		echo "<input type='hidden' name='method' value='update'>";
	 }
 ?> 
        <p><button  class="btn btn-primary btn-lg" id='save'> บันทึก </button > <input type='reset' class="btn btn-default"   > </p>
		</form>
	  </div>
    </div>
  
