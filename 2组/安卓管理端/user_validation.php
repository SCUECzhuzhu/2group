<?php
require_once("database.php");
$db = new DB();
$name = $_POST['name'];
$name = iconv("utf-8","gbk",$name);
$passwd = $_POST['passwd'];
$passwd = iconv("utf-8","gbk",$passwd);
//查看用户名和密码是否正确
$sql = "select name from `userdatabase` where name='%s' and password='%s' limit 1";
$sql = sprintf($sql, $name, $passwd);
$result = $db->select($sql);

if (!count($result)){    
    $ret['success'] = "false";
    $json = json_encode($ret);
    echo $json;
    exit;
}

//密码或用户名正确
else{
   	$ret['success']="true";
    $json=json_encode($ret);
    echo $json;
    exit;}
    
	$mysql->closeDb();
?>
