# lantern

## Use

```sh
docker stop lantern && docker rm lantern

docker run --name lantern -d -p 8087:8087 -p 8086:8080 --restart=always \
  bjddd192/lantern:latest
```

## 参考资料

[wilon/lantern](https://hub.docker.com/r/wilon/lantern)
