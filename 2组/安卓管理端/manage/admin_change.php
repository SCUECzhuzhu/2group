<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>注册</title>
</head>
        <body>
            
<?php
$myid=$_POST['myId'];
$myname=$_POST['myName'];
$mypasswd=$_POST['myPasswd'];
$myperson_tel=$_POST['myPerson_tel'];
$myurget_tel=$_POST['myUrget_tel'];
$myaddress=$_POST['myAddress'];

echo"
<form action='/manage/admin_test_change.php' method='post'>
	<label>用　户：<select name='myid'>
		  					<option value='$myid'>$myid</option>		  					
		  				</select></label><br>
    姓名  <input type='text' name='myname' class='text' value='$myname' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'null';}' >
    <div class='key'>
        密码  <input type='text' name='mypasswd' value='$mypasswd' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'null';}'>
    </div>
    <div class='persontel'>
        私人电话  <input type='text' name='myperson_tel' value='$myperson_tel' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'null';}'>
    </div>
    <div class='urgettel'>
        紧急联系电话<input type='text' name='myurget_tel' value='$myurget_tel' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'null';}'>
    </div>
    <div class='address'>
        家庭住址<input type='address' name='myaddress' value='$myaddress' onfocus='this.value = '';' onblur='if (this.value == '') {this.value = 'null';}'>
    </div>
    <div class='signin'>
        <input type='submit' value='修改' >

    </div></form>
   "
            ?>
            