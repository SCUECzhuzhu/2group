<?php
session_start();
if(isset($_SESSION['admin_id'])){
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
  
<script type="text/javascript" src="javascript/jquery.min.js"></script>
<script type="text/javascript">   
$(function(){
	//setMenuHeight
	$('.menu').height($(window).height()-51-27-26);
	$('.sidebar').height($(window).height()-51-27-26);
	$('.page').height($(window).height()-51-27-26);
	$('.page iframe').width($(window).width()-15-168);
	
	//menu on and off
	$('.btn').click(function(){
		$('.menu').toggle();
		
		if($(".menu").is(":hidden")){
			$('.page iframe').width($(window).width()-15+5);
			}else{
			$('.page iframe').width($(window).width()-15-168);
				}
		});
		
	//
	$('.subMenu a[href="#"]').click(function(){
		$(this).next('ul').toggle();
		return false;
		});
})
</script>
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
<style>
.black_overlay{
    display: none;
    position: absolute;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: black;
    z-index:1001;
    -moz-opacity: 0.8;
    opacity:.80;
    filter: alpha(opacity=80);  
}
.white_content {  display: none;
    position: absolute;
    top: 25%;  left: 25%;
    width: 25%;  height: 60%;
    padding: 16px;  border: 16px solid #0e84b5;
    background-color: white;
    z-index:1002;
    overflow: auto;  
}
    </style>
</head>

<body>
<div id="light" class="white_content">
    
    <form action="/manage/admin_registered.php" method="post"><div class="content">
            <div class="field"><label>用户名：</label><input class="username" name="user" type="text" /></div>
            <div class="field"><label>密　码：</label><input class="password" name="passwd" type="password" /><br /></div>
            <div class="field"><label>私人电话：</label><input class="username" name="urgent_tel" type="text" /></div>
            <div class="field"><label>紧急联系电话：</label><input class="username" name="personal_tel" type="text" /></div>
        <div class="field"><label>家庭住址：</label><input class="username" name="address" type="text" /></div><br><br><br><br>
            <div class="btn"><input name="submit" type="submit" class="login-btn" value="提交" /></div></div>
            
    </form>
    <button onclick="yue()">关闭</button>
    </div>
<div id="fade" class="black_overlay">
</div>
    
<div id="wrap">
	<div id="header">
    <div class="logo fleft"></div>
    <div class="nav fleft">
    	<ul>
        	<div class="nav-left fleft"></div>
            <li class="first"><span><button onclick="li()">
        	添加用户
                </button></span></li>
        	
            <div class="nav-right fleft"></div>
        </ul>
    </div>
        
             
    <a class="logout fright" href="admin_logout.php">
        
        </a>
    <div class="clear"></div>
    <div class="subnav">
    	<div class="subnavLeft fleft"></div>
        <div class="fleft"></div>
        <div class="subnavRight fright">
        </div>
    </div>
        
    </div><!--#header -->
    <div id="content">
    <div class="space"></div>
    <div class="menu fleft">
    	<ul>
        	<li class="subMenuTitle">功能</li>
			
            <li class="subMenu"><a href="user_information.php" target="right">用户信息</a></li>
            <li class="subMenu"><a href="user_frequency.php" target="right">用户告警</a></li>
            <li class="subMenu"><a href="user_24information.php" target="right">用户状态查看</a></li>
            <li class="subMenu"><a href="user_table.php" target="right">用户24小时状态</a></li>
 

            
        </ul>
    </div>
    <div class="sidebar fleft"><div class="btn"></div></div>
    <div class="page">
    <iframe width="100%" scrolling="auto" height="100%" frameborder="false" allowtransparency="true" style="border: medium none;" src="user_information.php" id="rightMain" name="right"></iframe>
    </div>
    </div><!--#content -->
    <div class="clear"></div>
    <div id="footer"></div><!--#footer -->
</div><!--#wrap -->

</body>
</html>
<?php 
                                }
 
?>