<?php
require_once("index/database.php");
$db = new DB();
$name = $_POST['name'];
$name = iconv("utf-8","gbk",$name);
$password = $_POST['password'];
$password = iconv("utf-8","gbk",$password);
$frequency = $_POST['frequency'];
$frequency = iconv("utf-8","gbk",$frequecny);
//查看用户名和密码是否正确
$sql = "select name from `user_data` where name='%s' and password='%s' limit 1";
$sql = sprintf($sql, $name,$password);
$result = $db->select($sql);


if (!count($result)){    
    $ret['success'] = "false";
    $json = json_encode($ret);
    echo $json;
    exit;
}

//密码或用户名正确
else{
    $sql_test="select user_id from user_data where name='%s'";
	$sql_test=sprintf($sql_test,$name);
	$mysql	=	new SaeMysql();
	$result_test=$mysql->getLine($sql_test);
	foreach ($result_test as $value)
				{	
               $user_id="$value";                    
				}               	
	
    
   	$sql	=	"INSERT INTO `app_raspberrypiphp`.`record` (`user_id`, `name`, `frequency`, `time`, `hour`) VALUES ('$user_id', '$name', '$frequency', '$time', '$hour')";
	
	$mysql->runSql($sql);

	if($mysql->errno() != 0 )
	{
    	die( "Error:" . $mysql->errmsg() );
	}
	else
	{
    	echo "Data inserted successfully!";
	}
    
	$mysql->closeDb();
}

?>