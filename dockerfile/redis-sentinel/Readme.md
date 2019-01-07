## Redis Sentinel

镜像使用 `Dockerfile-sentinel` 构建，运行时根据环境变量生成 `sentinel.conf` 文件，详细配置说明请查看 `sentinel.conf` 内容。

#### docker-entrypoint.sh

使用 Reids 官方镜像中的 `docker-entrypoint.sh` 脚本修改而来，添加了生成 `sentienl.conf` 语句。

```shell
...
# create sentinel.conf
if [ ! -e ${SENTINEL_CONF_PATH} ]; then
    envsubst < /etc/redis/sentinel.conf> ${SENTINEL_CONF_PATH}
    chown redis:redis /etc/redis/sentinel.conf
fi
...
```

修改配置 Sentinel 的环境变量后需要重新创建容器才能生效。

#### 可用环境变量

```shell
SENTINEL_CONF_PATH=/etc/redis/sentinel.conf
SENTINEL_PORT=26379
SENTINEL_MASTER_NAME=redis-master
SENTINEL_REDIS_IP=127.0.0.1
SENTINEL_REDIS_PORT=6379
SENTINEL_REDIS_PWD=
SENTINEL_QUORUM=2
SENTINEL_DOWN_AFTER=30000
SENTINEL_PARALLEL_SYNCS=1
SENTINEL_FAILOVER_TIMEOUT=180000
```