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
$user_id=$_POST['myid'];


$mysql	=	new SaeMysql();


$sql	=	"DELETE FROM `app_raspberrypiphp`.`user_data` WHERE `user_data`.`user_id` = $user_id";

$mysql->runSql($sql);
$url="/manage/Views/admin_information.php";
if($mysql->errno() != 0 )
{
    echo"<script>alert($sql)</script>";
    echo"<script>alert('删除失败~正在返回登陆页');location.href='$url';</script>";
}
else
{	
    
    echo "<script>alert('删除成功~正在返回登陆页');location.href='$url';</script>";
    
}
                $mysql->closeDb();
                ?>
           
        </body>
    </html>