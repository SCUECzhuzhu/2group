<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>用户频率</title>
<link href="images/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background:#FFF
}
</style>
</head>

<body>
<div id="contentWrap">
<div class="pageTitle"></div>
<div class="pageColumn">
<div class="pageButton"></div>
  <table>
    <thead>
    
      
      <th width="30%">用户名</th>
      <th width="25%">频率</th>
      <th width="">上传时间</th>
      
        </thead>
    <tbody>
<?php    	
$mysql	=	new SaeMysql();
$sql="SELECT name,frequency,time
FROM record
WHERE time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
ORDER BY time DESC limit 1";
$mysql->runSql($sql);
$row	=	$mysql->getLine($sql);

$sql	=	"SELECT  name,frequency,time
FROM record
WHERE time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
ORDER BY time DESC";

$result	=	$mysql->getData($sql);
foreach ($result as $row)
{?>
  <tr>
     
      <?php
    foreach ($row as $key=>$value)
    {
        echo "<td>".$value."</td>";
    }?>
   
        </tr>
        <?php
     }
$mysql->closeDb();
?>
        
    </tbody>
  </table>
</div></div>
</body>
</html>