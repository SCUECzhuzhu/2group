<html>
    <head>
        <title>insert</title>
    </head>
        <body>
            <p id="succee">
<?php
	$mysql	=	new SaeMysql();
	$name = $_POST['name'];
	$name = iconv("utf-8","gbk",$name);
	$passwd = $_POST['password'];
	$passwd = iconv("utf-8","gbk",$passwd);
//查看用户名和密码是否正确
	$sql = "select admin_id,root from `admin` where root='%s' and passwd='%s' limit 1";
	
	$result = $mysql->runSql($sql);

	if (!count($result)){
       echo"no";        		
				}
	else{
    	echo "ok";
	}
?>
                </p>            
        </body>
    </html>