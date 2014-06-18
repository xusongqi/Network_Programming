/* 
* Author:		xusongqi@live.com
* 
* Created Time: 2014年03月20日 星期四 18时42分19秒
* 
* FileName:     sock_client.c
* 
* Description:  
*
*/

#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <linux/in.h>
#include <sys/socket.h>
#include <sys/types.h>

#define LENGTH 1024

int main(void)
{
	int cfd;//句柄，文件描述符
	int recbytes;//计数器，计算接收到的字节数
	int sin_size;
	char buffer[LENGTH]={0};//存储read()收到的数据
	char client_msg[LENGTH];//存储write()发送的数据
	struct sockaddr_in server_addr,client_addr;//服务器信息，客户端信息
	unsigned short portnum=8086;//服务端使用的通信端口，可更改，但必须与服务端保持一致

	printf("here's a socket client\n");
	//建立socket，使用tcp流传输
	cfd = socket(AF_INET,SOCK_STREAM,0);
	if(cfd == -1)
	{
		printf("SOCKET FAILED\n");
		exit(1);
	}
	printf("SOCKET SUCCESS\n");

	//构造服务器端的ip及端口信息
	bzero(&server_addr,sizeof(struct sockaddr_in));
	server_addr.sin_family = AF_INET;
	server_addr.sin_addr.s_addr = inet_addr("127.0.0.1");//ip转换为4字节整型，使用时需要根据服务器端ip进行更改
	server_addr.sin_port = htons(portnum);//htons将short转化为网络型，即：将小端数据转化为大端数据(以两字节为单位，首尾交换)
										//一般来说网络为大端，PPC的cpu为大端，x86的cpu为小端，arm可以配置大小端、

	printf("server_addr = %#x, port: %#x\n",server_addr.sin_addr.s_addr,server_addr.sin_port);//打印出小端

	//connect连接函数，客户端连接服务端，参数顺序为socket描述符，地址信息，地址结构大小
	if(-1 == connect(cfd,(struct sockaddr *)(&server_addr),sizeof(server_addr)))
	{
		printf("CONNECT FAILED\n");
		exit(1);
	}
	printf("CONNECT SUCCESS\n");

	//分裂进程，分别进行读read()和写write()
	if(fork() == 0)
	{
		//while(strcmp(buffer, "end")!=0)
		while(1)
		{
			if((recbytes = read(cfd,buffer,LENGTH)) <= 0)
			{
				//break;
				exit(0);
			}
			buffer[recbytes]='\0';
			printf("%s\n",buffer);
			printf("    【READ SUCCESS】\n");
		}
		close(cfd);//关闭连接
	}
	else
	{
		//write() 发送消息
		while(1)
		{
			gets(client_msg);
			if(-1 == write(cfd,client_msg,strlen(client_msg)))
			{
				printf("WRITE FAILED\n");
				exit(1);
			}
			memset(client_msg,0,strlen(client_msg));
			//while(((sock_flush = getchar()) != '\n') && (sock_flush != EOF));//flush cache
			printf("    【SEND SUCCESS】\n");
		}
		close(cfd);
	}
	close(cfd);//同步关闭read()与write()
	return 0;
}
