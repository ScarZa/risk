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
 <H1><small>รายงานแสดงจำนวนความเสี่ยงที่เกิดขึ้นซ้ำ</small></H1> 
  
<div class="col-lg-6">
<form method="post" action="" enctype="multipart/form-data">
		<label>ตั้งแต่วันที่</label>
		<input type="date" name='take_date1' id="take_date1" title='กรุณาเลือกวันที่เริ่มต้น'  class="form-control"  placeholder='ตั้งแต่วันที่' required  /> &nbsp;&nbsp;&nbsp;
		 <label>ถึงวันที่</label>
		 <input type="date" name='take_date2' title='กรุณาเลือกวันที่สิ้นสุด'  id="take_date2"  class="form-control"  placeholder='ถึงวันที่'   required />   
    <BR> 
   <?php  include'subcategory.php';?><BR>

 <?php
   for($i=2556;$i<=2560;$i++){
   echo "<option value='$i'>$i</option>";
    }
  ?>
   </select>
   
***สถานที่ : <?php //include 'jquery.php';?>
    <select name="take_place" id='combobox1' class="form-control"  required> 
			<?php	$sql = mysql_query("SELECT *  FROM place  ");
			 echo "<option value=''></option>";
			while( $result = mysql_fetch_assoc( $sql ) ){
					echo "<option value='$result[place]'>$result[name] </option>";
			 } ?>
 </select>
<BR> <BR> 
<button type="submit" class="btn btn-primary">ตกลง  </button>
<button type="reset" class="btn btn-default">Reset  </button>  
</form>
</p> 
</div>
 
<div class="col-lg-6">
 <?php         
			  $take_place=$_POST[take_place];
			 $ex1=explode("-",$_POST[take_date1]);
	         $month_start="$ex1[0]-$ex1[1]-$ex1[2]";
			 $fx1=explode("-",$_POST[take_date2]);
	          $month_end="$fx1[0]-$fx1[1]-$fx1[2]";
 			// ----------------------------------------------Year= $ex1[2];
			 $category=$_POST[category];
			 $subcategory=$_POST[subcategory];
 if($category!=''){ 
			 $sql=mysql_query("select * from category where category=$category");
			 $rsCate = mysql_fetch_assoc($sql);
			
			 $sql=mysql_query("select * from subcategory where subcategory=$subcategory");
			 $rsSubCate = mysql_fetch_assoc($sql);
		
			 $sql=mysql_query("select * from place where place=$take_place");
			 $rsPlace = mysql_fetch_assoc($sql);


 echo "<br />";   
 echo "<center>";   

   $CaseYear= $fx1[0]-$ex1[0];
 	

 	 	
 		//-----------------1
		 $sqlAB=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
						 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
						 where t1.take_place='$take_place' and r1.num between '1' and '2' and t1.category='$category' and t1.subcategory='$subcategory' and t1.take_date between '$month_start' and '$month_end'  ");	
 	 
		 $rsAB = mysql_fetch_assoc($sqlAB);
 		//-----------------2
		 $sqlCD=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
						 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
						 where t1.take_place='$take_place' and r1.num between '3' and '4' and t1.category='$category' and t1.subcategory='$subcategory' and t1.take_date between '$month_start' and '$month_end'   ");	
 	 
		 $rsCD = mysql_fetch_assoc($sqlCD);
 		//-----------------3
		 $sqlEF=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
						 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
						 where t1.take_place='$take_place' and r1.num between '5' and '6' and t1.category='$category' and t1.subcategory='$subcategory' and t1.take_date between '$month_start' and '$month_end'   ");	
 	 
		 $rsEF = mysql_fetch_assoc($sqlEF);
 		//-----------------4
		 $sqlGHI=mysql_query("select count(takerisk_id) as number_risk from takerisk t1  
						 LEFT OUTER JOIN category c1 on c1.category = t1.category
						 LEFT OUTER JOIN subcategory s1 on s1.subcategory = t1.subcategory
						 LEFT OUTER JOIN level_risk r1 on r1.level_risk = t1.level_risk
						 where t1.take_place='$take_place' and r1.num between '7' and '9' and t1.category='$category' and t1.subcategory='$subcategory' and t1.take_date between '$month_start' and '$month_end'   ");	

		 $rsGHI = mysql_fetch_assoc($sqlGHI);
		 
		 // end category not null
				 
				
 
 
  echo mysql_error();		
		
  	
//เกิดบ่อย  เกิดขึ้นหลายครั้งในรอบปี

//เกิดเป็นครั้งคราวเกิดขึ้น 2 – 3 ครั้งในรอบปี

//เกิดขึ้นน้อย  2 – 3  ครั้งในรอบ  2 – 3  ปี

//เกิดน้อยมาก  เกิด1 – 2  ครั้งในรอบ 3 – 5ปี เกิดขึ้นที่  รพ.อื่น
  echo "<H3>ระดับความสำคัญของความเสี่ยง  (Risk  Matrix)</H3>";
	   $data1=$rsAB[number_risk];  
	   $data2=$rsCD[number_risk];  
	   $data3=$rsEF[number_risk]; 
	   $data4=$rsGHI[number_risk];  

function showAvaliable(){
	global $data1,$data2,$data3,$data4;
       echo "<br>";echo "<br>";
	   echo "ระดับ AB = ".$data1; echo "<br>";
	   echo "ระดับ CD = ".$data2; echo "<br>";
	   echo "ระดับ EF = ".$data3; echo "<br>";
	   echo "ระดับ GHI = ".$data4; echo "<br>";
	}
 /* 
 ===test function if Level : High Medium Low
	   echo "ค่า GHI ".$data4=1; echo "<br>";

       echo "<br>";
	   echo "ค่า AB ".$data1=8; echo "<br>";
	   echo "ค่า CD ".$data2=8; echo "<br>";
	   echo "ค่า EF ".$data3=1; echo "<br>";
	   echo "ค่า GHI ".$data4=0; echo "<br>";
 */

  	if($CaseYear==0 ){ // echo "//case----------1";
		echo "โอกาสเกิดขึ้นซ้ำภายในรอบปี";
		echo "<BR><BR>";
		echo "หมวด : ".$rsCate[name].'<BR>&nbsp;&nbsp;รายการความเสี่ยง : '.$rsSubCate[name].'&nbsp;&nbsp;สถานที่ : '.$rsPlace[name];
		echo "<BR>.................................................................";
		showAvaliable();
		if($data4>=2){
		$case = "case1H"; 
		$data=$data4;
		}else if($data3>=2){
		$case = "case1H";
		$data=$data3;
		}else if( $data2>=2 ){
		$case = "case1M";
		$data=$data2;
		}else if($data1>=2 ){
		$case = "case1L";
		$data=$data1;
		}
		
		if($case=="case1H"){
			$data=5;  $level='สูง';
			}else if($case=="case1M"){
			$data=3;  $level='ปานกลาง';
			}else if($case=="case1L"){
			$data=2;  $level='ต่ำ';
		}

	} 
	else if($CaseYear==1 || $CaseYear<=3){ //echo "//case----------2";
		echo "โอกาสเกิดขึ้นซ้ำภายใน $CaseYear ปี";
		echo "<BR><BR>";
		echo "หมวด : ".$rsCate[name].'<BR>&nbsp;&nbsp;รายการความเสี่ยง : '.$rsSubCate[name].'&nbsp;&nbsp;สถานที่ : '.$rsPlace[name];
		echo "<BR>.................................................................";
		showAvaliable();
		if($data4>=2){
			$case = "case2H"; 
			$data=$data4;  
		}else if($data3>=2){
			$case = "case2M"; 
			$data=$data3;  
		}else if( $data2>=2 ){
			$case = "case2L"; 
			$data=$data2; 
		}else if($data1>=2){
			$case = "case2LL"; 
			$data=$data1;  
		}

		if($case=="case2H"){
			$data=5; $level='สูง';
			}else if($case=="case2M"){
			$data=3; $level='ปานกลาง';
			}else if($case=="case2L"){
			$data=2; $level='ต่ำ';
			}else if($case=="case2LL"){
			$data=1; $level='ต่ำมาก';
		}
	}

	else if($CaseYear>=4){ // echo "//case--------------3";
		echo "โอกาสเกิดขึ้นซ้ำภายใน $CaseYear ปี";
		echo "<BR><BR>";
		echo "หมวด : ".$rsCate[name].'<BR>&nbsp;&nbsp;รายการความเสี่ยง : '.$rsSubCate[name].'&nbsp;&nbsp;สถานที่ : '.$rsPlace[name];
		echo "<BR>.................................................................";
		showAvaliable();
		if($data4>=1){
		$case = "case3H"; 
		$data=$data4;
		}else if($data3>=1){
		$case = "case3M"; 
		$data=$data3;
		}else if( $data2>=1 ){
		$case = "case3L"; 
		$data=$data2;
		}else if($data1>=1){
		$case = "case3LL"; 
		$data=$data1;
		}

		if($case=="case3H"){
			$data=5;$level='สูง';
			}else if($case=="case3M"){
			$data=3; $level='ปานกลาง';
			}else if($case=="case3L"){
			$data=2;$level='ต่ำ';
			}else if($case=="case3LL"){
			$data=1; $level='ต่ำมาก';
		}
 }
		 

 		?>
		 <script type="text/javascript">
		$(function () {
	
       var chart = new Highcharts.Chart({
	
	    chart: {
	        renderTo: 'container',
	        type: 'gauge',
	        plotBackgroundColor: null,
	        plotBackgroundImage: null,
	        plotBorderWidth: 0,
	        plotShadow: false
	    },
	    
	    title: {
	       text: ''
	    },
	    
	    pane: {
	        startAngle: -150,
	        endAngle: 150,
	        background: [{
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#FFF'],
	                    [1, '#333']
	                ]
	            },
	            borderWidth: 0,
	            outerRadius: '109%'
	        }, {
	            backgroundColor: {
	                linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
	                stops: [
	                    [0, '#333'],
	                    [1, '#FFF']
	                ]
	            },
	            borderWidth: 1,
	            outerRadius: '107%'
	        }, {
	            // default background
	        }, {
	            backgroundColor: '#DDD',
	            borderWidth: 0,
	            outerRadius: '105%',
	            innerRadius: '103%'
	        }]
	    },
	       
	    // the value axis
	    yAxis: {
	        min: 0,
	        max: 5,
	        
	        minorTickInterval: 'auto',
	        minorTickWidth: 1,
	        minorTickLength: 10,
	        minorTickPosition: 'inside',
	        minorTickColor: '#666',
	
	        tickPixelInterval: 30,
	        tickWidth: 2,
	        tickPosition: 'inside',
	        tickLength: 10,
	        tickColor: '#666',
	        labels: {
	            step: 5,
	            rotation: 'auto'
	        },
	        title: {
	           text: 'ระดับความสำคัญ : <? echo $level?>'
	        },
	        plotBands: [{
	            from: 0,
	            to: 1,
	            color: '#EEF9F5' // green
	        }, {
	            from: 1,
	            to: 2,
	            color: '#55BF3B' // yellow
	        }, {
	            from: 2,
	            to: 4,
	            color: '#DDDF0D' // red DDDF0D
	        }, {
	            from: 4,
	            to: 5,
	            color: '#DF5353' // red
	        }]        
	    },
	
	    series: [{
	        name: 'ระดับความสำคัญ',
	        data: [<? echo $data ?>],
	        tooltip: {
	            valueSuffix: ' <? echo $level?>'
	        }
	    }]
	
	}, 
	// Add some life
	function (chart) {
	    setInterval(function () {
	        var point = chart.series[0].points[0],
	            newVal,
	          //  inc = Math.round((Math.random() - 0.5) * 20);   รันออโต้
	          //  inc = Math.round((Math.random() - 0.5) * 20);
	        
	        newVal = point.y + inc;
	        if (newVal < 0 || newVal > 100) {
	            newVal = point.y - inc;
	        }
	        
	        point.update(newVal);
	        
	    },3000);
	});
});
		</script>	

 <? }?>
<script src="report_rm/highcharts.js"></script>
<script src="report_rm/highcharts-more.js"></script>
<script src="report_rm/exporting.js"></script>

<div id="container" style="width: 550px; height: 450px; margin: 0 auto"></div>
</div>
</div>
<?php include 'footer.php';?>

 