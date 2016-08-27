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
    
      
      <th width="25%">用户名</th>
      <th width="20%">频率</th>
      <th width="20%">时间</th>
      <th width="">功能</th>
        </thead>
    <tbody>
<?php    	
$mysql	=	new SaeMysql();
$sql="SELECT name, sum( frequency )
FROM (
SELECT name, frequency
FROM record
WHERE HOUR
BETWEEN 0
AND 9
AND time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
) AS a
GROUP BY name limit 1";
$mysql->runSql($sql);
$row	=	$mysql->getLine($sql);

$sql	=	"SELECT name, sum( frequency )
FROM (
SELECT name, frequency
FROM record
WHERE HOUR
BETWEEN 0
AND 9
AND time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
) AS a
GROUP BY name";

$result	=	$mysql->getData($sql);
$i=1;
foreach ($result as $row) {      
  
       
  echo"<tr id='$i'>"?>
     
  
    <?php
    foreach ($row as $key => $value) {
       
        echo "<td>".$value."</td>";
        $sum=$value;
        
        
    }
    echo "<td>0-9</td>";
    echo"<td><button id='button$i' onclick='demo$i()'>处理</button></td>";
    
    if($sum<=200){
           echo "<script>document.getElementById($i).style.color='red'</script>";
       }   
    
    echo <<<END
    
    <script>
        function demo$i(){document.getElementById('$i').style.color='black';document.getElementById('button$i').innerHTML="已处理";}
    </script>
END;
    $i=$i+1;
      
        echo"</tr>";
}

$mysql	=	new SaeMysql();
$sql="SELECT name, sum( frequency )
FROM (
SELECT name, frequency
FROM record
WHERE HOUR
BETWEEN 9
AND 18
AND time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
) AS a
GROUP BY name limit 1";
$mysql->runSql($sql);
$row	=	$mysql->getLine($sql);

$sql	=	"SELECT name, sum( frequency )
FROM (
SELECT name, frequency
FROM record
WHERE HOUR
BETWEEN 9
AND 18
AND time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
) AS a
GROUP BY name";

$result	=	$mysql->getData($sql);

foreach ($result as $row) {      
  
       
  echo"<tr id='$i'>"?>
     
  
    <?php
    foreach ($row as $key => $value) {
       
        echo "<td>".$value."</td>";
        $sum=$value;
        
        
    }
    echo "<td>9-18</td>";
    echo"<td><button id='button$i' onclick='demo$i()'>处理</button></td>";
    
    if($sum<=200){
           echo "<script>document.getElementById($i).style.color='red'</script>";
       }   
    
    echo <<<END
    
    <script>
        function demo$i(){document.getElementById('$i').style.color='black';document.getElementById('button$i').innerHTML="已处理";}
    </script>
END;
    $i=$i+1;
      
        echo"</tr>";
}


$mysql	=	new SaeMysql();
$sql="SELECT name, sum( frequency )
FROM (
SELECT name, frequency
FROM record
WHERE HOUR
BETWEEN 18
AND 24
AND time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
) AS a
GROUP BY name limit 1";
$mysql->runSql($sql);
$row	=	$mysql->getLine($sql);

$sql	=	"SELECT name, sum( frequency )
FROM (
SELECT name, frequency
FROM record
WHERE HOUR
BETWEEN 18
AND 24
AND time
BETWEEN date_sub( now( ) , INTERVAL 1
DAY )
AND now( )
) AS a
GROUP BY name";

$result	=	$mysql->getData($sql);

foreach ($result as $row) {      
  
       
  echo"<tr id='$i'>"?>
     
  
    <?php
    foreach ($row as $key => $value) {
       
        echo "<td>".$value."</td>";
        $sum=$value;
        
        
    }
    echo "<td>18-24</td>";
    echo"<td><button id='button$i' onclick='demo$i()'>处理</button></td>";
    
    if($sum<=200){
           echo "<script>document.getElementById($i).style.color='red'</script>";
       }   
    
    echo <<<END
    
    <script>
        function demo$i(){document.getElementById('$i').style.color='black';document.getElementById('button$i').innerHTML="已处理";}
    </script>
END;
    $i=$i+1;
      
        echo"</tr>";
}

?>      
        
    </tbody>
  </table>
</div></div>
</body>
</html>