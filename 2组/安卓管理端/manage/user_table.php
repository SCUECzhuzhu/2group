<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户信息</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background:#FFF
}
</style>
    <script>

    function post(url, params) {
    var temp = document.createElement("form");
    temp.action = url;
    temp.method = "post";
    temp.style.display = "none";
    for (var x in params) {
        var opt = document.createElement("input");
        opt.name = x;
        opt.value = params[x];
        temp.appendChild(opt);
    }
    document.body.appendChild(temp);
    temp.submit();
    return temp;
}  
    </script>
</head>
<?php
$page = $_GET["page"];
function Page($rows,$page_size){
    global $page,$select_from,$select_limit,$pagenav;
    $page_count = ceil($rows/$page_size);
    if($page <= 1 || $page == '') $page = 1;
    if($page >= $page_count) $page = $page_count;
    $select_limit = $page_size;
    $select_from = ($page - 1) * $page_size.',';
    $pre_page = ($page == 1)? 1 : $page - 1;
    $next_page= ($page == $page_count)? $page_count : $page + 1 ;
    $pagenav .= "第 $page/$page_count 页 共 $rows 条记录 ";
    $pagenav .= "<a href='?page=1'>首页</a> ";
    $pagenav .= "<a href='?page=$pre_page'>前一页</a> ";
    $pagenav .= "<a href='?page=$next_page'>后一页</a> ";
    $pagenav .= "<a href='?page=$page_count'>末页</a>";
    $pagenav.="　跳到<select name='topage' size='1' onchange='window.location=\"?page=\"+this.value'>\n";
    for($i=1;$i<=$page_count;$i++){
        if($i==$page) $pagenav.="<option value='$i' selected>$i</option>\n";
        else $pagenav.="<option value='$i'>$i</option>\n";
    }
}

if (!$conn= mysql_connect(SAE_MYSQL_HOST_M . ':' . SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS)) die('数据库选择失败！');
if (!mysql_select_db(SAE_MYSQL_DB, $conn)) die('数据库选择失败！');
mysql_query('set names GBK');
// 用Page函数计算出 $select_from 从哪条记录开始检索、$pagenav 输出分页导航
$rows = mysql_num_rows(mysql_query("SELECT  name,frequency,time
FROM record
WHERE time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
ORDER BY time DESC"));

Page($rows,24);
$sql = "SELECT  name,frequency,time
FROM record
WHERE time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
ORDER BY time DESC limit $select_from $select_limit";
$rst = mysql_query($sql);
?>
<body>
<div id="contentWrap">
<div class="pageTitle"></div>
<div class="pageColumn">
<div class="pageButton"></div>
  <table>
    <thead>
    <th width="3%"></th>
        <th width="30%">用户名</th>
      <th width="20%">频率</th>
      <th width="">时间</th>
       
        </thead>
    <tbody>
    	
        
        <?php

while ($row = mysql_fetch_array($rst)){
    echo "<tr><td></td><td>$row[name]</td><td>$row[frequency]</td><td>$row[time]<td/></tr>";
}
echo $pagenav;
?> 
    
        
        
    </tbody>
  </table>
</div></div>
</body>
</html>