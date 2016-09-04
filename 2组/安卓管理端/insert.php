<html>
    <head>
        <title>insert</title>
    </head>
        <body>
            <p id="succee">
<?php
require_once("database.php");
$db = new DB();
$name = $_POST['name'];
$name = iconv("utf-8","gbk",$name);
$passwd = $_POST['passwd'];
$passwd = iconv("utf-8","gbk",$passwd);
$frequency = $_POST['frequency'];
$frequency = iconv("utf-8","gbk",$frequency);

date_default_timezone_set("PRC");
$time=date("Y-m-d H:i:s");
$hour=date("H");


//查看用户名和密码是否正确
$sql = "select name from `userdatabase` where name='%s' limit 1";
$sql = sprintf($sql, $name);
$result = $db->select($sql);

if (!count($result)){    
    $ret['insert'] = "false";
    $json = json_encode($ret);
    echo $json;
    exit;
}

//密码或用户名正确
else{
    $sql_test="select user_id from userdatabase where name='%s'";
	$sql_test=sprintf($sql_test,$name);
	$mysql	=	new SaeMysql();
	$result_test=$mysql->getLine($sql_test);
	foreach ($result_test as $value)
				{	
               $user_id="$value";                    
				}      
    
   	$sql	=	"INSERT INTO `app_mysqlphpdb`.`record` (`user_id`, `name`, `frequency`, `time`, `hour`) VALUES ('$user_id', '$name', '$frequency', '$time', '$hour')";
	
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
</p>            
        </body>
    </html>
