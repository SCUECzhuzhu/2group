<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
</head>
        <body>
            
<?php
/**
 * Created by PhpStorm.
 * User: ly
 * Date: 2016/7/18
 * Time: 22:23
 */
$user=$_POST['user'];
$passwd=$_POST['passwd'];
$urgent_tel=$_POST['urgent_tel'];
$personal_tel=$_POST['personal_tel'];  
$address=$_POST['address'];
$mysql	=	new SaeMysql();


$sql	=	"INSERT INTO `app_mysqlphpdb`.`userdatabase` (`user_id`, `name`, `password`, `personal_tel`, `urgent_tel`,'address') VALUES (NULL, '$user', '$passwd', '$personal_tel', '$urgent_tel','$address')";

$mysql->runSql($sql);

if($mysql->errno() != 0 )
{
    echo"<script>alert('注册失败~正在返回登陆页');window.history.back(-1);</script>";
}
else
{
    echo "<script>alert('注册成功~正在返回登陆页');window.history.back(-1);</script>";
    
}
                $mysql->closeDb();
                ?>
           
        </body>
    </html>