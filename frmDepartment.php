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
	 if(document.form1.name_dep.value=='')
		{
			alert('กรุณากรอกชื่อฝ่าย/ศูนย์/กลุ่มงาน');
			document.form1.name_dep.focus();		
			return false;
		}else{	
			return true;
			document.form1.submit();
		}
}
</script>
 <div class="row">
          <div class="col-lg-12">
            <h1>Form <small>ตั้งค่าฝ่าย/ศูนย์/กลุ่มงาน</small></h1>
            <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
              <li class="active"><i class="fa fa-gear"></i> ตั้งค่าฝ่าย/ศูนย์/กลุ่มงาน</li>
            </ol>
            <div class="alert alert-info alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              ตั้งค่าฝ่าย/ศูนย์/กลุ่มงาน <a class="alert-link" target="_blank" href="#">  เพื่อใช้งานในระบบบริหารความเสี่ยง</a> 
            </div>
          </div>
        </div><!-- /.row -->
			<?php include 'connect.php';
			 if($_REQUEST[method]=='update_dep'){ 
			 $dep_id=$_GET[dep_id];
                         $mdep_id=$_REQUEST[mdep_id];
			 $sqlGet=mysql_query("select d1.*,d2.dep_name as dep_name from department d1 
         left outer join department_group d2 on d2.main_dep=d1.main_dep  where dep_id='$dep_id' ");
			 $resultGet=mysql_fetch_assoc($sqlGet);
			 }
			   ?>    
    <div class="row">
        
     
       
    <div class="col-lg-6">
        <div class="alert alert-success">
   <form name='form1'   action='prcDepartment.php' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">     
			<div class="form-group">	
			<label>ฝ่าย </label>
			<input type='text' name='name_mdep'  id='name_mdep' placeholder='ฝ่าย' class='form-control'  value='<?php echo $resultGet[dep_name];?>'onkeydown="return nextbox(event, 'save');" required>
			 </div> 
			 
<?PHP 
	if($_REQUEST[method]=='update_dep'){
		echo "<input type='hidden' name='mdep_id' value='$mdep_id'>";
		echo "<input type='hidden' name='method' value='update_mdep'>";
	 }else{
         ?>         <input type="hidden" name="method" value="insert_mdep">
         <?php }?>
        <p><button  class="btn btn-primary" id='save'> บันทึก </button > <input type='reset' class="btn btn-danger"   > </p>
        </form></div>
    </div>
        
        
        
        <div class="col-lg-6">
        <div class="alert alert-success">
		<form name='form1'   action='prcDepartment.php' method='post' enctype="multipart/form-data" OnSubmit="return fncSubmit();">
                    <div class="form-group">	
			<label>เลือกฝ่ายงาน </label>
                         	<select name="name_mdep" id="name_mdep" required  class="form-control"  onkeydown="return nextbox(event, 'fname');"> 
				<?php	$sql = mysql_query("SELECT * FROM department_group order by main_dep ");
				 echo "<option value=''>-ฝ่ายงาน-</option>";
				 while( $result = mysql_fetch_assoc( $sql ) ){
          if($result[main_dep]==$resultGet[main_dep]){$selected='selected';}else{$selected='';}
				 echo "<option value='$result[main_dep]' $selected>$result[dep_name] </option>";
				 } ?>
			 </select>

			 </div>
        
			<div class="form-group">	
			<label>ฝ่าย/ศูนย์/กลุ่มงาน </label>
			<input type='text' name='name'  id='name' placeholder='ฝ่าย/ศูนย์/กลุ่มงาน' class='form-control'  value='<?php echo $resultGet[name];?>'onkeydown="return nextbox(event, 'save');" required>
			 </div>
       
    
			 
<?PHP 
	if($_REQUEST[method]=='update_dep'){
		echo "<input type='hidden' name='dep_id' value='$dep_id'>";
		echo "<input type='hidden' name='method' value='update_dep'>";
	 }else{
 ?> <input type="hidden" name="method" value="insert_dep">
         <?php }?>
        <p><button  class="btn btn-primary" id='save'> บันทึก </button > <input type='reset' class="btn btn-danger"   > </p>
                </form></div></div></div>
 
      <!--  row of columns -->
 <div class="alert alert-info">
          <div class="col-lg-12">
          <p> <?PHP   include'listDepartment.php';?></p>  
        </div>
	   </div>
 
 <?PHP include'footer.php';  ?>
