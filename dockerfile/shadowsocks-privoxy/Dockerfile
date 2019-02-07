FROM alpine:latest

MAINTAINER bjddd192 <bjddd192@163.com>

RUN apk add --update py-pip privoxy \
	&& rm /var/cache/apk/*

RUN pip install shadowsocks

#------------------------------------------------------------------------------
# Environment variables:
#------------------------------------------------------------------------------

ENV SERVER_ADDR= \
    SERVER_PORT=8899  \
    METHOD=aes-256-cfb \
    TIMEOUT=300 \
    PASSWORD=

#------------------------------------------------------------------------------
# Populate root file system:
#------------------------------------------------------------------------------

ADD rootfs /

#------------------------------------------------------------------------------
# Expose ports and entrypoint:
#------------------------------------------------------------------------------
EXPOSE 8118 7070

RUN chmod +x /entrypoint.sh

ENTRYPOINT ["/entrypoint.sh"]
