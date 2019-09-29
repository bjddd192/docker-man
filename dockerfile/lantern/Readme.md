# dnsmasq

DNSmasq 是一个小巧且方便地用于配置 DNS 和 DHCP 的工具，适用于小型网络，它提供了 DNS 功能和可选择的 DHCP 功能。它服务那些只在本地适用的域名，这些域名是不会在全球的 DNS 服务器中出现的。

## 参考资料

[andyshinn/docker-dnsmasq](https://github.com/andyshinn/docker-dnsmasq)


# lantern

## Use

```sh
docker stop lantern && docker rm lantern

docker run --name lantern -d -p 8087:8087 -p 8086:8080 --restart=always \
  bjddd192/lantern:latest
```

## 参考资料

[wilon/lantern](https://hub.docker.com/r/wilon/lantern)
