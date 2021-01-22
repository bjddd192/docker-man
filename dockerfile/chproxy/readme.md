```sh
docker run -it --rm -p 9090:9090 -v /tmp/config.yml:/tmp/config.yml \
bjddd192/chproxy:v1.14.0 -config /tmp/config.yml
```