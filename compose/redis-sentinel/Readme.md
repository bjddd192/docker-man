# 说明

使用 Docker Compose 本地部署基于 Sentinel 的高可用 Redis 集群。

根据官方文档 [Redis Sentinel Documentation](https://redis.io/topics/sentinel) 中的 [Example 2: basic setup with three boxes](https://redis.io/topics/sentinel#example-2-basic-setup-with-three-boxes) 示例创建的实例，但因为是单机部署，所以不满足 Redis 实例与 Sentinel 实例分别处于 3 台机器的要求，因此仅用于开发环境测试与学习。

## 使用方法

使用 `docker-compose up -d` 部署运行。

使用 `docker-compose pause master` 可以模拟对应的 Redis 实例不可用。

使用 `docker-compose pause sentinel-1` 可以模拟对应的 Sentinel 实例不可用。

使用 `docker-compose unpause service_name` 将暂停的容器恢复运行。

注：Windows 和 Mac 可能需要修改 `Volumes` 挂载参数。

## 注意事项

[Sentinel, Docker, NAT, and possible issues](https://redis.io/topics/sentinel#sentinel-docker-nat-and-possible-issues)

将容器端口 `EXPOSE` 时，Sentinel 所发现的 master/slave 连接信息（IP 和 端口）对客户端来说不一定可用。

例如：将 Reids 实例端口 `6379` `EXPOSE` 为 `16379`, Sentinel 容器使用 `LINK` 的方式访问 Redis 容器，那么对于 Sentinel 容器 `6379` 端口是可用的，但对于外部客户端是不可用的。

解决方法是 `EXPOSE` 端口时保持内外端口一致，或者使用 `host` 网络运行容器。如果你想使用本项目中的编排文件部署的集群对外部可用，那么只能将 Redis 容器运行在 `host` 网络之上。

注：实际上 `bridge` 模式下 Redis 性能也会受到影响。
