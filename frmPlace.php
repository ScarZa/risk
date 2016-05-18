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
	 if(document.form1.name_place.value=='')
		{
			alert('กรุณากรอกสถานที่');
			document.form1.name_place.focus();		
			return false;
		}else{	
			return true;
			document.form1.submit();
		}
}
</script>
 <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>ตั้งค่าสถานที่</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ตั้งค่าสถานที่</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              ตั้งค่าสถานที่ <a class="alert-link" target="_blank" href="#">  เพื่อใช้งานในระบบบริหารความเสี่ยง</a> 
            </div>
          </div>
        </div><!-- /.row -->
			<?php include 'connect.php';
			 if($_GET[place]!=''){ 
			 $place=$_GET[place];
			 $sqlGet=mysql_query("select * from  place  where place='$place' ");
			 $resultGet=mysql_fetch_assoc($sqlGet);
			 }
			   ?>    
    <div class="row">
    <div class="col-lg-4"> 
        <div class="alert alert-success">
		<form name='form1'   action='prcPlace.php' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
			<div class="form-group">	
			<label>ฝ่าย/ศูนย์/กลุ่มงาน </label>
			<input type='text' name='name'  id='name_place' placeholder='สถานที่' class='form-control'  value='<?php echo $resultGet[name];?>'onkeydown="return nextbox(event, 'save');" required >
			 </div> 
			 
<?PHP 
	if($_GET[place]!=''){
		echo "<input type='hidden' name='place' value='$place'>";
		echo "<input type='hidden' name='method' value='update'>";
	 }
 ?> 
        <p><button  class="btn btn-primary" id='save'> บันทึก </button > <input type='reset' class="btn btn-danger"   > </p>
		</form>
	  </div>
    </div>
    </div>
 
      <!--  row of columns -->
 <div class="row">
          <div class="col-lg-12">
              <div class="alert alert-info">
          <p> <?PHP   include'listPlace.php';?></p>  
        </div>
          </div>
	   </div>
 
 <?PHP include'footer.php';  ?>
