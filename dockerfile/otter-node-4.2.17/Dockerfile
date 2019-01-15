# 因为 node 节点有需要动态编译 java 代码的可能，故使用 jdk 镜像。
FROM anapsix/alpine-java:8u192b12_jdk

MAINTAINER bjddd192 <bjddd192@163.com>

ARG NODE_VERSION=4.2.17

# ARG INSTALL_URL=http://10.0.43.24:8066/otter/node.deployer-${NODE_VERSION}.tar.gz
ARG INSTALL_URL=https://github.com/alibaba/otter/releases/download/otter-${NODE_VERSION}/node.deployer-${NODE_VERSION}.tar.gz

ENV TZ="Asia/Shanghai" \
    NODE_ID=1 \ 
    OTTER_MANAGER_ADDRESS="127.0.0.1:1099" \
    OTTER_ZOOKEEPER_SESSIONTIMEOUT=60000 \
    OTTER_COMMUNICATION_POOL_SIZE=10 \
    LOG_LEVEL="INFO" \
    LOG_APPENDER="STDOUT" \
    JAVA_XMS="256M" \
    JAVA_XMX="512M" \
    JAVA_XMN="128M"

RUN apk add --update curl bash aria2 file tzdata \
    && ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \ 
	&& echo "Asia/Shanghai" > /etc/timezone \
    && mkdir -p /usr/local/otter/node \
    && curl -SL ${INSTALL_URL} -o node.deployer.tar.gz \
    && gunzip node.deployer.tar.gz \
    && tar -xf node.deployer.tar -C /usr/local/otter/node \
    && rm node.deployer.tar \
    && rm /var/cache/apk/*

WORKDIR /usr/local/otter/node

ADD otter.properties /usr/local/otter/node/conf/otter.properties

ADD startup.sh /usr/local/otter/node/bin/startup.sh

ADD logback.xml /usr/local/otter/node/conf/logback.xml

RUN chmod +x /usr/local/otter/node/bin/startup.sh

CMD ["/usr/local/otter/node/bin/startup.sh"]

