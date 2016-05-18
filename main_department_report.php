<?php  session_start(); ?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php include 'header.php';?>
		<?php 
		 	$user_id = $_SESSION[user_id];
         	$sqlUser = mysql_query("select admin from user where user_id='$user_id' ");
         	$resultUser=mysql_fetch_assoc($sqlUser);    
            if($resultUser[admin]=='Y'){
            echo "<h2>คณะกรรมการบริหารความเสี่ยง</h2>"; 	
            }else{
            echo "<h2>รายงานสำหรับหน่วยงาน</h2>";  	
            }         
         ?>
	 
<H1><small>หน่วยงานที่เขียนความเสี่ยงประจำเดือน</small></H1>

      <div class="col-lg-7">
	      <form method="post" action="" enctype="multipart/form-data"  >
	       ***เลือกวันที่เริ่มต้นและวันที่สิ้นสุดเพื่อดูจำนวนความเสี่ยง
            <div class="form-group">
				วันที่เริ่มต้น <input type='date' id='date_start' name='date_start'  class='form-control' required />
			</div>
			<div class="form-group">	
				วันที่สิ้นสุด <input type='date' name='date_end'  class='form-control' required />	
		   </div>
		   <div class="form-group">
			<button type="submit" class="btn btn-success">ตกลง</button>
                        <a href="staff_report.php" class="btn btn-danger">บุคคลากรที่เขียนความเสี่ยงทั้งหมด</a>
			</div>						
		</form>	
	</div>		
      <div class="col-lg-7">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar"></i> หน่วยงานที่เขียนความเสี่ยงประจำเดือน</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th><center># <i class="fa fa-sort"></i></center></th>
                        <th><center>ฝ่าย/ศูนย์/กลุ่มงาน <i class="fa fa-sort"></i></center></th>
                        <th><center>จำนวนเรื่อง <i class="fa fa-sort"></i></center></th>
			<th><center>รายบุคคล<i class="fa fa-sort"></i></center></th>
                      </tr>
                    </thead>
                    <tbody>
          			<?php 
          						$i=1;
                                                   if(!empty($_POST[date_start])){     
          							$monthlast =$_POST[date_start];					
								$monthnow =$_POST[date_end];
          						$sql=mysql_query("select dep_id,name as dep_name from department");
                                                        
          						while( $result=mysql_fetch_assoc($sql) ){	
          							$dep_id=$result[dep_id];
                                                                if(!empty($_POST[date_start])){
								$sql2=mysql_query("select count(t1.takerisk_id) as count_risk    
								from  user  u1 
								LEFT OUTER JOIN takerisk t1 on u1.user_id = t1.user_id 								
								where t1.take_date between '$monthlast' and  '$monthnow' and u1.dep_id='$dep_id'
                                                                    and t1.move_status='N' and  recycle='N' and subcategory!=''
								 ");	
								}
								echo mysql_error();
										
								  $rs=mysql_fetch_assoc($sql2) ;							
          			?>       
                      <tr>
                        <td><center><?php echo $i; ?></center></td>
                        <td><?php echo $result[dep_name]; ?></td>
                        <td><center><?php if($rs[count_risk]==''){echo "<font color='red'>".$rs[count_risk]."</font>"; }else{echo $rs[count_risk];} ?></center></td>
			<td><center>
			<form action='main_department_report_user.php' method='post'>
			<input type='hidden' name='date_start' value="<?=$monthlast?>">
			<input type='hidden' name='date_end' value="<?=$monthnow?>">
			<input type='hidden' name='dep_id' value="<?=$dep_id?>">
			<button type="submit" class="btn btn-primary">รายชื่อผู้เขียน</button> 
			</form>			
			
			</center></td>
                      </tr>
                      <tr>
                                                   <?php $i++; }} // end while $sql2 ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
<?php include 'footer.php';?>
</section>
