/* 
* Author:		xusongqi@live.com
* 
* Created Time: 2014年05月15日 星期四 10时35分38秒
* 
* FileName:     EC_include.h
* 
* Description: include all inuse head-files and the functions' declarations
*
*/

#ifndef _EC_INCLUDE_
#define _EC_INCLUDE_

#include <errno.h>
#include <fcntl.h>
#include <libgen.h>
//#include <linux/in.h>
#include <libxml/parser.h>  
#include <libxml/tree.h> 
#include <mysql/mysql.h>
#include <netinet/in.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <sys/types.h>
#include <sys/epoll.h>
#include <sys/socket.h>
#include <time.h>

#define true 1
#define false 0

typedef int Status;

char *	server_time();					//返回服务器的本地时间
int		set_non_blocking(int sockfd);	//将传入的描述符设置为非阻塞
int		client_request(int client_fd);	//处理客户请求

#endif
