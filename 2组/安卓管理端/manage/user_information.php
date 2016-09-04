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

<body>
<div id="contentWrap">
<div class="pageTitle"></div>
<div class="pageColumn">
<div class="pageButton"></div>
  <table>
    <thead>
    <th width="3%"></th>
        <th width="5%">id</th>
      <th width="10%">用户名</th>
      <th width="10%">密码</th>
      <th width="15%">私人电话</th>
      <th width="15%">紧急联系电话</th>
       <th width="20%">家庭住址</th> 
        <th width="15%">功能</th> 
        </thead>
    <tbody>
    	
        
        <?php
$mysql	=	new SaeMysql();

$sql	=	"SELECT * FROM `userdatabase` limit 1";

$row	=	$mysql->getLine($sql);

$sql	=	"SELECT * FROM `userdatabase`";

$result	=	$mysql->getData($sql);
$i=1;
foreach ($result as $row)
{
    echo"<tr id='$i'>";
        ?>
   
      <td class="checkBox"><input name="" type="checkbox" value="s" /></td>
      <?php
    foreach ($row as $key=>$value)
    {
        echo "<td>".$value."</td>";
    }
   	echo"<td><button id='button$i' onclick='change$i()'>修改</button>
      <button id='button$i' onclick='delect$i()'>删除</button></td>";
      
        
    echo"</tr>";
    echo <<<END
    
    <script>
        function delect$i(){var myid = document.getElementById("$i").cells[1].innerHTML;
        var myname=document.getElementById("$i").cells[2].innerHTML;
        post('/manage/admin_delect.php', {'myid':myid});
        
        }	
                            
    </script>
    <script>
    	function change$i(){var myId=document.getElementById("$i").cells[1].innerHTML;
                            var myName=document.getElementById("$i").cells[2].innerHTML;
							var myPasswd=document.getElementById("$i").cells[3].innerHTML;
                            var myPerson_tel=document.getElementById("$i").cells[4].innerHTML;
                            var myUrget_tel=document.getElementById("$i").cells[5].innerHTML;
                            var myAddress=document.getElementById("$i").cells[6].innerHTML;
                            post('/manage/admin_change.php', {'myId':myId,'myName':myName,'myPasswd':myPasswd,'myPerson_tel':myPerson_tel,'myUrget_tel':myUrget_tel,'myAddress':myAddress});}
    </script>
END;
$i=$i+1;     
}
$mysql->closeDb();
?>
        
        
    </tbody>
  </table>
</div></div>
</body>
</html>