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
        
    			header("Location: /manage/admin_login.php");
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
        
        header("Location: /manage/admin_manage.php");
    	exit;}
    }
else{
    header("Location: /manage/admin_manage.php");}
		$mysql->closeDb();
?>








<?php
session_start();
require_once("database.php");
$error_msg = "";
$mysql=new SaeMysql();
//如果用户未登录，即未设置$_SESSION['user_id']时，执行以下代码
if(!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {//用户提交登录表单时执行如下代码
        //$db = new DB();
        $name = $_POST['root'];
        $name = iconv("utf-8", "gbk", $name);
        $passwd = $_POST['passwd'];
        $passwd = iconv("utf-8", "gbk", $passwd);
        $mysql	=	new SaeMysql();
        if (!empty($name) && !empty($passwd)) {
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT user_id, name FROM userdatabase WHERE name = '$name' AND password = '$passwd'";
            //用用户名和密码进行查询
            $result=$mysql->getLine($query);
            //若查到的记录正好为一条，则设置SESSION，同时进行页面重定向
            if ($result==null) {
                $error_msg = 'sorry  enter is wrong';
            }
            else {
                foreach ($result as $key=>$value)
                {
                    $row[]="$value";
                }
                $_SESSION['user_id'] = $row[0];
                $_SESSION['username'] = $row[1];
            }
        } else {
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
    }
}else{
    header("Location: loged.php");
}
?>