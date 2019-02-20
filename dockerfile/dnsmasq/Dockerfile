FROM alpine:edge

MAINTAINER bjddd192 <bjddd192@163.com>

RUN apk --no-cache add dnsmasq

EXPOSE 53 53/udp

ENTRYPOINT ["dnsmasq", "-k"]
