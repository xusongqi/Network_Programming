<?php
# 
# 
# Author:		xusongqi@live.com
# 
# Created Time: 2014年07月10日 星期四 15时40分21秒
# 
# FileName:     update.php
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
$sql="update phonebook set phone_num = '$_POST[new_phone_num]' , user = '$_POST[new_user]' where phone_num = '$_POST[phone_num]';";

//条件控制报错
if(!mysql_query($sql, $connect_fd))
{
	die('ERROR:' . mysql_error());
}
echo "1 record updated";

//关闭数据库连接描述符
mysql_close($connect_fd);

?>
