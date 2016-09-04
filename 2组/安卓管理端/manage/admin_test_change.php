<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
</head>
        <body>
            
<?php
$myid=$_POST['myid'];
$myname=$_POST['myname'];
$mypasswd=$_POST['mypasswd'];
$myperson_tel=$_POST['myperson_tel'];
$myurget_tel=$_POST['myurget_tel'];
$myaddress=$_POST['myaddress'];

$mysql	=	new SaeMysql();


$sql	=	"UPDATE `app_mysqlphpdb`.`userdatabase` SET `name` = '$myname',
`password` = '$mypasswd',
`personal_tel` = '$myperson_tel',
`urgent_tel` = '$myurget_tel',
`address` = '$myaddress' WHERE `userdatabase`.`user_id` =$myid;";


$mysql->runSql($sql);
$url="/manage/user_information.php";
if($mysql->errno() != 0 )
{
   
    echo"<script>alert('修改失败~正在返回登陆页');location.href=\"$url\"</script>";
    
}
else
{	
    
    echo "<script>alert('修改成功~正在返回登陆页');location.href='$url'</script>";
    
}
                $mysql->closeDb();
                ?>
           
        </body>
    </html>