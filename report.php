	
	<?php
		if($_GET[type]=='1'){
		include'dep_report.php';
		}else if($_GET[type]=='2'){
		include'main_report.php';
		}else if($_GET[type]=='3'){
		include'main_report_cateMonth.php';
		}else if($_GET[type]=='4'){
		include'main_report_cateMonth_line.php';
		}else if($_GET[type]=='5'){
		include'main_report_again.php';
		}else if($_GET[type]=='6'){
		include'main_report_dep.php';
		}else if($_GET[type]=='7'){
		include'main_report_cateMonth_dep.php';
		}else if($_GET[type]=='8'){
		include'main_report_cateMonth_line_dep.php';
		}elseif($_GET[type]=='9'){
		include'dep_report2.php';
                }else if($_GET[type]=='10'){
		include'main_report_dep2.php';
		}
		
		
	?>