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
docker run -d --name shadowsocks-privoxy -p 8118:8118 -p 7070:7070 --restart=always \
  -e SERVER_ADDR=xxx \
  -e SERVER_PORT=xxx \
  -e PASSWORD=xxx \
  bjddd192/shadowsocks-privoxy:latest
```
