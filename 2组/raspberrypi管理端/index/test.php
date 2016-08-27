<?php
session_start();
require_once("database.php");
$db = new DB();
if(!isset($_SESSION['admin_id'])){
	$name = $_POST['root'];
	$name = iconv("utf-8","gbk",$name);
	$passwd = $_POST['passwd'];
	$passwd = iconv("utf-8","gbk",$passwd);
//查看用户名和密码是否正确
	$sql = "select admin_id,root from `admin` where root='%s' and passwd='%s' limit 1";
	$sql = sprintf($sql, $name, $passwd);
	$result = $db->select($sql);

	if (!count($result)){
        
        header("Location: /index/index.html");
    			exit;
        		
				}

//密码或用户名正确
	else{
    	foreach ($result as $key=>$value)
                {
                    $row[]="$value";
                }
                $_SESSION['admin_id'] = $row[0];
                $_SESSION['adminname'] = $row[1];    			
        
        header("Location: /manage/Views/admin_manage.php");
    	exit;}
    }
else{
    header("Location: /manage/Views/admin_manage.php");}
		$mysql->closeDb();
?>