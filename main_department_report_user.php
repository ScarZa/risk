<?php  session_start(); ?>
<?php if(empty($_SESSION['user_id'])){echo "<meta http-equiv='refresh' content='0;url=index.php'/>";exit();} ?>
<?php include 'header.php';if(isset($_GET['unset'])){ unset_session();}?>
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
<ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-home"></i> หน้าหลัก</a></li>
	 <?php if($resultUser[admin]=='Y'){   echo "<li><a href='main_department_report.php'><i class='fa fa-bar-chart-o'></i> หน่วยงานที่เขียนความเสี่ยง</a></li>"; } ?>
              <li class="active"><i class="fa fa-user"></i> บุคลากรที่เขียนความเสี่ยง</li>
            </ol>
<H1><small>รายชื่อบุคลากรภายในหน่วยงานที่เขียนความเสี่ยง</small></H1>
<?php   $monthlast =$_POST[date_start];					
        $monthnow =$_POST[date_end];

							if($_POST[dep_id]!=''){
								  $dep_ids=$_POST[dep_id];								
							}else{
          							$dep_ids=$_SESSION[user_dep_id];
							} ?>
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
                       <input type="hidden" name="dep_id" value="<?=$dep_ids?>">
			<button type="submit" class="btn btn-success">ตกลง</button> 
			</div>						
		</form>	
	</div>		
      <div class="col-lg-7">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-calendar"></i> รายชื่อบุคลากรภายในหน่วยงานที่เขียนความเสี่ยง</h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover table-striped tablesorter">
                    <thead>
                      <tr>
                        <th><center>ลำดับ <i class="fa fa-sort"></i></center></th>
                        <th><center>รายชื่อ <i class="fa fa-sort"></i></center></th>
                        <th><center>จำนวนเรื่อง <i class="fa fa-sort"></i></center></th>
                      </tr>
                    </thead>
                    <tbody>
          			<?php 
          						$i=1;
          						
 
          						$sql=mysql_query("select * from user where dep_id='$dep_ids'");
          						while( $result=mysql_fetch_assoc($sql) ){
							$RSuser_id=$result[user_id];

          							if(!empty($_POST[date_start])){ 				
								$sql2=mysql_query("select  count(t1.takerisk_id) as  count_risk 
								from   takerisk t1
  								where t1.take_date between '$monthlast' and  '$monthnow' and t1.move_status='N'  and t1.user_id='$RSuser_id'  
								and t1.recycle='N'and t1.subcategory!='' and t1.subcategory!=''");	
								//$count_risk=mysql_num_rows($sql2);
                                                                
								echo mysql_error();
										
								  $count_risk=mysql_fetch_assoc($sql2) ;	
								   	}						
          			?>       
                      <tr>
                        <td><center><?php echo $i; ?></center></td>
                        <td><?php echo $result[user_fname].' '.$result[user_lname]; ?></td>
                        <td><center><?php if($count_risk['count_risk']==0){echo "<font color='red'>".$count_risk['count_risk']."</font>"; }else{echo $count_risk['count_risk'];} ?></center></td>
                      </tr>
                      <tr>
                 <?php $i++; } // end while $sql2 ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.row -->
<?php include 'footer.php';?>
</section>
