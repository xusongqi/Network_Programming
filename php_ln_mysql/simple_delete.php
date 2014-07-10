<?php
# 
# 
# Author:		xusongqi@live.com
# 
# Created Time: 2014年07月10日 星期三 15时33分51秒
# 
# FileName:     delete.php
# 
# Description:  

//建立数据库连接描述符，指定主机，用户名，密码
$connect_fd = mysql_connect("localhost","root","xsq921222");
if(!$connect_fd)
{
	die('Connect Myslq Failed:' . mysql_error() );
}

//选择数据库
mysql_select_db("php", $connect_fd) or die(mysql_error());

//插入数据
$sql="delete from phonebook where user = '$_POST[user]' or phone_num = '$_POST[phone_num]';";

//条件控制报错
if(!mysql_query($sql, $connect_fd))
{
	die('ERROR:' . mysql_error());
}
echo "1 record deleted";

//关闭数据库连接描述符
mysql_close($connect_fd);
?>
