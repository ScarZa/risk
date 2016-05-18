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
            <h1>Form <small>ตั้งค่ารายการความเสี่ยง</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ตั้งค่ารายการความเสี่ยง</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              ตั้งค่ารายการความเสี่ยง <a class="alert-link" target="_blank" href="#">  เพื่อเข้าใช้งานในระบบบริหารความเสี่ยง</a> 
            </div>
          </div>
        </div><!-- /.row -->
			<?php include 'connect.php';
			 if($_GET[subcategory]!=''){ 
			 $subcategory=$_GET[subcategory];
			 $sqlGet=mysql_query("select subcategory,name as sub_name,category from  subcategory  where subcategory='$subcategory' ");
			 $resultGet=mysql_fetch_assoc($sqlGet);
			 }
			   ?>    
    <div class="row">
    <div class="col-lg-4"> 
        <div class="alert alert-success">
		<form name='form1'   action='prcSubCategory.php' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
			 <div class="form-group">	
 		 	<label>หมวดความเสี่ยง</<label>
			<select name='category' id='category' class='form-control'  onkeydown="return nextbox(event, 'sub_name');"   required > 	
			   <?php 	 	
				$sql=mysql_query("select  c1.* from category c1 ");	
		 		echo "<option value=''  >------หมวดความเสี่ยง------</option>";	
				while ($ar=mysql_fetch_assoc($sql)){
					if( $resultGet[category]==$ar[category]){$selected='selected';}else{$selected='';}
						echo "<option value='$ar[category]' $selected > $ar[name]</option>";
					}
			?>
			</select>
			 </div>
			<div class="form-group">	
			<label>รายการความเสี่ยง </label>
			<input type='text' name='sub_name'  id='sub_name' placeholder='รายการความเสี่ยง' class='form-control'  onkeydown="return nextbox(event, 'save');"   value='<?php echo $resultGet[sub_name];?>' required>
			 </div> 
<?PHP 
	if($_GET[subcategory]!=''){
		echo "<input type='hidden' name='subcategory' value='$subcategory'>";
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
          <p> <?PHP   include'listSubCategory.php';?></p>  
        </div>
	   </div>
 </div>
 
 <?PHP include'footer.php';  ?>