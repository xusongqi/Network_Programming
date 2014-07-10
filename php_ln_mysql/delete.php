<!--
# 
# 
# Author:		xusongqi@live.com
# 
# Created Time: 2014年07月09日 星期三 16时06分39秒
# 
# FileName:     delete.php
# 
# Description:  
-->

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="../docs-assets/ico/favicon.png">

	<title>Delete</title>

	<link href="css/bootstrap.css" rel="stylesheet">

	<link href="css/my_css.css" rel="stylesheet">

  </head>

<body>
	<div class="container">
		<br>
		<h1>通讯录目录</h1>
		<hr>

		<div class="panel panel-default">

			<div class="panel-body">
				<table class="table table-hover table-striped table-bordered table-responsive">
					<thead>
						<tr>
							<th class="index">选择</th>
							<th class="name">联系人姓名</th>
							<th class="phone">电话号码</th>
						</tr>

					</thead>
					<tbody>

						<?php
						//建立数据库连接描述符，指定主机，用户名，密码
						$connect_fd = mysql_connect("localhost","root","xsq921222");
						if(!$connect_fd)
						{
						die('Connect Mysql Failed:' . mysql_error() );
						}

						//选择数据库
						mysql_select_db("php", $connect_fd) /*or die(mysql_error())*/;
						
 
						//查询语句
						$result = mysql_query( "select * from phonebook where user='$_POST[user]' or phone_num='$_POST[phone_num]';");

						if(is_resource($result)){
						while($row = mysql_fetch_array($result))
						{
							echo "<tr>";
							echo "<td > <input type='checkbox' name='checkbox1' value='checkbox'></td>";
							echo "<td >" . $row['user'] . "</td>";
							echo "<td >" . $row['phone_num'] . "</td>";
							echo "</tr>";
						}
						}
						//关闭数据库连接描述符
						mysql_close($connect_fd);
						?>

					</tbody>
				</table>
			</div>
		</div>

		<br>
		<br>
		<br>
		<br>
	</div>

<script>
var oRet = document.querySelector('#ret');
var auto = function() {
	oRet.innerHTML = '浏览器像素宽度为：<b>' + window.innerWidth + 'px</b>';
}
auto();
window.onresize = auto;
</script>
	<script src="http://cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



</body>

<?php
//建立数据库连接描述符，指定主机，用户名，密码
/*$connect_fd = mysql_connect("localhost","root","xsq921222");
if(!$connect_fd)
{
	die('Connect Myslq Failed:' . mysql_error() );
}

//选择数据库
mysql_select_db("php", $connect_fd) or die(mysql_error());

//插入数据
$sql="select * from phonebook where user = '$_POST[user]' or phone_num = '$_POST[phone_num]';";

//条件控制报错
if(!mysql_query($sql, $connect_fd))
{
	die('ERROR:' . mysql_error());
}
echo "1 record added";

//关闭数据库连接描述符
mysql_close($connect_fd);
*/?>

