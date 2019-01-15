# 容器版 otter 4.2.17 安装配置说明

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

用火狐或者谷歌访问页面如：http://10.0.43.52:8099 ，可以进入web管理控制台，则安装成功。

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
   grant select, replication slave, replication client on *.* to 'canal'@'%' identified by 'otter2canal';
   flush privileges;
   ```
6. 添加 Channel
7. 添加 Pipeline
8. 批量添加映射关系
   ```sql
   CREATE TABLE `bm_size` (
     `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '行ID(主键)',
     `size_no` varchar(20) COLLATE utf8_bin NOT NULL COMMENT '尺码编号',
     `size_name` varchar(30) COLLATE utf8_bin NOT NULL COMMENT '尺码名称',
     `sync_data_sign` tinyint(4) NOT NULL DEFAULT '1' COMMENT '数据同步标志(1=同步 0=不同步)',
     `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '记录更新时间',
     PRIMARY KEY (`id`),
     UNIQUE KEY `uk_bm_size_size_no` (`size_no`)
   ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='尺码信息表';

   select  
   	concat(a.schema1,',',b.TABLE_NAME,',',a.sourceId1,',',a.schema2,',',b.TABLE_NAME,',',a.sourceId2)
   from 
   (
   	SELECT 'db_uc' schema1,1 sourceId1,'db_mdm' schema2,1 sourceId2 
   ) a,
   (
   	select b.* 
   	from information_schema.tables b
   	where b.TABLE_SCHEMA = 'db_uc' and b.TABLE_NAME in
   	(
   		'bm_size'
   	) 
   ) b;
   ```
9. 开启同步
10. 修改源端数据，然后检查同步是否OK
11. 启用 Pipeline 同步监控
12. 配置 manager_monitor 监控
13. 配置系统参数

### 异常处理

#### zk发生数据异常

出现过zk异常，异常日志写满磁盘的事件，大约10天左右会写满磁盘。

如zk发生异常，频繁报错，可将zk数据清除，重新启动otter，然后备份channel、pipeline表，再清空channel、pipeline表重新在界面初始化channel、pipeline表即可。
