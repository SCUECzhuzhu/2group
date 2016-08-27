<?php
session_start();
if(isset($_SESSION['admin_id'])){
?> 
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../bootstrap2.3.2/css/bootstrap.min.css" rel="stylesheet" />
    <title>后台管理</title>
    <link href="../styles/Common.css" rel="stylesheet" />
    <link href="../styles/Index.css" rel="stylesheet" />
    <link href="../styles/add.css" rel="stylesheet" />
    
    <script>
        function li(){
            document.getElementById('light').style.display='block';
            document.getElementById('fade').style.display='block';
        }
    </script>

    <script>
        function yue(){
            document.getElementById('light').style.display='none';
            document.getElementById('fade').style.display='none'
        }
    </script>
    
</head>
<body>
    <div class="header">

        <img class="logo" src="../images/logo.png" />
        <label class="logo-title">后台管理</label>
        <ul class="inline">
            <li>
                <img src="images/userr.png" />&nbsp;&nbsp;admin
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle mymsg" data-toggle="dropdown" href="#"><img src="../images/32/166.png" />&nbsp;&nbsp;修改个人信息<b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="#">修改密码</a></li>
                </ul>

            </li>
            <li>
                <img src="../images/32/200.png" />&nbsp;&nbsp;<a class="loginout" href="/manage/Views/admin_logout.php">退出</a>
            </li>

        </ul>


    </div>


    <div class="nav">

        <ul class="breadcrumb">
            <li>
                <img src="images/pc.png" />
            </li>
            <li><a href="#">首页</a> <span class="divider">>></span></li>
            <li class="active"></li>
            
   	<span>
    	<button onclick="li()">
        	添加用户
    	</button>
		</span>
            
        </ul>
    </div>
	
   
   
   
<div id="light" class="white_content">
    
        <form action="admin_registered.php" method="post"><div class="content">
            <div class="field"><label>用户名：</label><input class="username" name="user" type="text" /></div>
            <div class="field"><label>密　码：</label><input class="password" name="passwd" type="password" /><br /></div>
            <div class="field"><label>私人电话：</label><input class="username" name="urgent_tel" type="text" /></div>
            <div class="field"><label>紧急联系电话：</label><input class="username" name="personal_tel" type="text" /></div>
            <div class="field"><label>家庭住址：</label><input class="username" name="address" type="text" /></div>
            <div class="btn"><input name="submit" type="submit" class="login-btn" value="提交" /></div></div>
            
    </form>
    <button onclick="yue()">关闭</button>
    </div>
<div id="fade" class="black_overlay">
</div>
    
    

    <div class="container-fluid content">
        <div class="row-fluid">
            <div class="span2 content-left">
                <div class="accordion">
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                                <img class="left-icon" src="../images/32/5026_settings.png" /><span class="left-title">系统设置</span>
                            </a>
                        </div>
                        <div id="collapseOne" class="accordion-body collapse in">
                            <div class="accordion-inner">
                                <img class="left-icon-child" src="images/user.png" /><span class="left-body"><a href="admin_information.php" target="right">用户信息</a></span>
                            </div>
                            <div class="accordion-inner">
                                <img class="left-icon-child" src="images/page.png" /><span class="left-body"> <a href="admin_frequency.php" target="right">用户告警</a></span>

                            </div>
                           
                            <div class="accordion-inner">
                                <img class="left-icon-child" src="images/book.png" /><span class="left-body"> <a href="admin_24_table.php" target="right">24小时用户状态</a></span>

                            </div>
                            <div class="accordion-inner">                                
                                <img class="left-icon-child" src="images/heart.png" /><span class="left-body">待定</span>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="span10 content-right">
                <iframe src="admin_information.php" class="iframe" name="right"></iframe>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="foot"></div>
    <script src="../scripts/jquery-1.9.1.min.js"></script>
    <script src="../bootstrap2.3.2/js/bootstrap.min.js"></script>
    <script src="../scripts/Index.js"></script>
	<div style="text-align:center;">

</div>

</body>
</html>
<?php 
                                }
 
?>