<?php @session_start(); ?>
<meta http-equiv="content-type" content="text/html; charset=utf-8">
<?php
$user_account = md5(trim($_POST['user_account']));
$user_pwd = md5(trim($_POST['user_pwd']));
include('connect.php');
$sql = "select * from user 
           inner join department on user.dep_id=department.dep_id
           inner join department_group on department.main_dep=department_group.main_dep
           where   user_account='$user_account' && user_pwd='$user_pwd'";
mysql_query("SET NAMES 'utf8'", $con);

$result = mysql_query($sql);
$num_row = mysql_num_rows($result);
$result = mysql_fetch_assoc($result);

if (empty($num_row)) {
    echo "<script>alert('ชื่อหรือรหัสผ่านผิด กรุณาตรวจสอบอีกครั้ง!')</script>";
    echo "<meta http-equiv='refresh' content='0;url=./index.php'/>";
    exit();
} else {
    $date_login = date("Y-m-d");
    $time_login = time();
    $sql = mysql_query("update user  set date_login='$date_login' , time_login='$time_login' where   user_account='$user_account' && user_pwd='$user_pwd'");
    $_SESSION['user_id'] = $result[user_id];
    $_SESSION[user_fname] = $result[user_fname];
    $_SESSION[user_lname] = $result[user_lname];
    $_SESSION[user_dep_id] = $result[dep_id];
    $_SESSION[user_main_dep] = $result[main_dep];
    $_SESSION[admin] = $result[admin];

    // require'myfunction/savelog.php';
    //	  echo "<input type='hidden' name='acc_id' value='$acc_username'> ";

    echo "<meta http-equiv='refresh' content='0;url=./' />";
}
?>
 