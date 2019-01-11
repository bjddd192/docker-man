# 容器板 otter 安装配置说明

## 初始化数据库 otter

导入otter-manager-schema.sql结构，给 otter 库赋权，如：

```sql
grant all privileges on `otter`.* to 'usr_otter'@'%' identified by 'scm_otter';
flush privileges;
```

## 启动 zookeeper

```sh
docker-compose up -d otter_zookeeper
```

## 启动 manager

```sh
docker-compose up -d otter_manager
```

用火狐或者谷歌访问页面如：http://172.20.32.36:40120 ，可以进入web管理控制台，则安装成功。

## 配置 otter

1. 添加 zookeeper 集群
2. 添加数据源
3. 添加 node，活动 node_id 以及 端口
4. 启动 node，并在控制台 node 管理界面看到配置的 node 状态为`已启动`。
   ```sh
   docker-compose up -d otter_node_select
   docker-compose up -d otter_node_load
   ```
5. 添加 canal
   ```sql
   CREATE USER canal IDENTIFIED BY 'Otter2zjlh';  
   GRANT SELECT, REPLICATION SLAVE, REPLICATION CLIENT ON *.* TO 'canal'@'%';
   FLUSH PRIVILEGES;
   ```
6. 添加 Channel
7. 添加 Pipeline
8. 批量添加映射关系
   ```sql
   -- DROP TABLE IF EXISTS otter_trigger;
   CREATE TABLE `otter_trigger` (
	  `line_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '行id(主键)',
	  `modifier` varchar(20) COLLATE utf8_bin DEFAULT NULL COMMENT '修改人',
	  `modify_time` datetime DEFAULT NULL COMMENT '修改时间',
	  `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录更新时间',
	  PRIMARY KEY (`line_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='otter同步自动触发表，用于检测otter同步异常';

   select  
   	concat(a.schema1,',',b.TABLE_NAME,',',a.sourceId1,',',a.schema2,',',b.TABLE_NAME,',',a.sourceId2)
   from 
   (
   	SELECT 'db_uc' schema1,1 sourceId1,'db_uc' schema2,2 sourceId2 
   ) a,
   (
   	select b.* 
   	from information_schema.tables b
   	where b.TABLE_SCHEMA = 'db_uc' and b.TABLE_NAME in
   	(
   		'otter_trigger'
   	) 
   ) b;
   ```
9. 开启同步
10. 修改源端数据，然后检查同步是否OK
11. 配置邮件服务器，在阿里云跟在内网机器不一样，详情请查看：[阿里云 centos7 mailx 发送邮件](https://blog.csdn.net/thinkthewill/article/details/80868442)
    ```sh
	# 安装 mailx
	yum -y install mailx
	
	# 配置发件人信息
	echo 'set ssl-verify=ignore' >> /etc/mail.rc
	echo 'set nss-config-dir=/etc/pki/nssdb' >> /etc/mail.rc
	echo 'set from=data_helper@zorin.xin' >> /etc/mail.rc
	echo 'set smtp=smtps://smtp.mxhichina.com:465' >> /etc/mail.rc
	echo 'set smtp-auth-user=data_helper@zorin.xin' >> /etc/mail.rc
	echo 'set smtp-auth-password=accvMedia8899' >> /etc/mail.rc
	echo 'set smtp-auth=login' >> /etc/mail.rc
	
	# 测试邮件发送
	echo "test" | mailx -v -s test -c 88447836@qq.com 88447836@qq.com
	```
12. 初始化 Pipeline 同步监控
	```sql
	INSERT INTO `otter`.`alarm_rule` (`ID`, `MONITOR_NAME`, `RECEIVER_KEY`, `STATUS`, `PIPELINE_ID`, `DESCRIPTION`, `GMT_CREATE`, `GMT_MODIFIED`, `MATCH_VALUE`, `PARAMETERS`) VALUES ('1', 'EXCEPTION', 'otterteam', 'DISABLE', '1', '同步异常', '2018-07-21 00:28:08', '2018-07-21 00:38:16', 'ERROR,EXCEPTION', '{\"autoRecovery\":false,\"intervalTime\":1800,\"recoveryThresold\":2}');
	INSERT INTO `otter`.`alarm_rule` (`ID`, `MONITOR_NAME`, `RECEIVER_KEY`, `STATUS`, `PIPELINE_ID`, `DESCRIPTION`, `GMT_CREATE`, `GMT_MODIFIED`, `MATCH_VALUE`, `PARAMETERS`) VALUES ('2', 'POSITIONTIMEOUT', 'otterteam', 'DISABLE', '1', '同步Position超时', '2018-07-21 00:28:08', '2018-07-21 00:41:21', '1800', '{\"autoRecovery\":false,\"intervalTime\":1800,\"recoveryThresold\":2}');
	INSERT INTO `otter`.`alarm_rule` (`ID`, `MONITOR_NAME`, `RECEIVER_KEY`, `STATUS`, `PIPELINE_ID`, `DESCRIPTION`, `GMT_CREATE`, `GMT_MODIFIED`, `MATCH_VALUE`, `PARAMETERS`) VALUES ('3', 'DELAYTIME', 'otterteam', 'DISABLE', '1', '同步延迟', '2018-07-21 00:28:08', '2018-07-21 00:38:26', '600', '{\"autoRecovery\":false,\"intervalTime\":1800,\"recoveryThresold\":2}');
	INSERT INTO `otter`.`alarm_rule` (`ID`, `MONITOR_NAME`, `RECEIVER_KEY`, `STATUS`, `PIPELINE_ID`, `DESCRIPTION`, `GMT_CREATE`, `GMT_MODIFIED`, `MATCH_VALUE`, `PARAMETERS`) VALUES ('4', 'PROCESSTIMEOUT', 'otterteam', 'DISABLE', '1', '同步Process超时', '2018-07-21 00:28:08', '2018-07-21 00:42:10', '600', '{\"autoRecovery\":false,\"intervalTime\":1800,\"recoveryThresold\":2}');
	```
13. 启用 Pipeline 同步监控
14. 配置 manager_monitor 监控
15. 配置系统参数

### 异常处理

#### zk发生数据异常

出现过zk异常，异常日志写满磁盘的事件，大约10天左右会写满磁盘。

如zk发生异常，频繁报错，可将zk数据清除，重新启动otter，然后备份channel、pipeline表，再清空channel、pipeline表重新在界面初始化channel、pipeline表即可。
