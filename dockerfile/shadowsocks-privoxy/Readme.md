## shadowsocks-privoxy

容器化 shadowsocks + privoxy 实现 linux 的快速翻墙。

#### 可用环境变量

```sh
# 环境变量
SERVER_ADDR=
SERVER_PORT=8899
METHOD=aes-256-cfb
TIMEOUT=300
PASSWORD=
```

### 启动命令

```sh
docker stop shadowsocks-privoxy && docker rm shadowsocks-privoxy

docker run -d --name shadowsocks-privoxy -p 8118:8118 --restart=always \
  -e SERVER_ADDR=x.x.x.x \
  -e SERVER_PORT=xxx \
  -e PASSWORD=xxx \
  bjddd192/shadowsocks-privoxy:2.9.1
```

### 验证代理

```sh
export all_proxy=http://127.0.0.1:8118
export ftp_proxy=http://127.0.0.1:8118
export http_proxy=http://127.0.0.1:8118
export https_proxy=http://127.0.0.1:8118
export no_proxy=localhost,172.17.0.0/16,192.168.0.0/16.,127.0.0.1,10.10.0.0/16
curl -I www.google.com
```

### 取消使用代理

```sh
while read var; do unset $var; done < <(env | grep -i proxy | awk -F= '{print $1}')
```

### 参考资料

[bluebu/shadowsocks-privoxy](https://hub.docker.com/r/bluebu/shadowsocks-privoxy)

[shadowsocks-libev](https://hub.docker.com/r/shadowsocks/shadowsocks-libev)
