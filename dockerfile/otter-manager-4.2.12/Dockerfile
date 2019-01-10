FROM anapsix/alpine-java:jre7

MAINTAINER bjddd192 <bjddd192@163.com>

ARG NODE_VERSION=4.2.12

# ARG INSTALL_URL=http://172.20.32.36/package/otter/manager.deployer-${NODE_VERSION}.tar.gz
ARG INSTALL_URL=https://github.com/alibaba/otter/releases/download/otter-${NODE_VERSION}/manager.deployer-${NODE_VERSION}.tar.gz

ENV TZ="Asia/Shanghai" \
    OTTER_MANAGER_DOMAIN_NAME="127.0.0.1" \ 
    OTTER_MANAGER_PORT=80 \
    OTTER_DATABASE_URL="jdbc:mysql://127.0.0.1:3306/otter" \
    OTTER_DATABASE_USERNAME="user" \
    OTTER_DATABASE_PASSWORD="password" \
    OTTER_ZOOKEEPER_CLUSTER_DEFAULT="127.0.0.1:2181" \
    OTTER_MANAGER_MONITOR_EMAIL_HOST="smtp@163.com" \
    OTTER_MANAGER_MONITOR_EMAIL_USERNAME="user" \
    OTTER_MANAGER_MONITOR_EMAIL_PASSWORD="password" \
    OTTER_MANAGER_MONITOR_EMAIL_STMP_PORT=25 \
    JAVA_XMS="256M" \
    JAVA_XMX="512M" \
    JAVA_XMN="128M"

RUN apk add --update curl bash \
    && mkdir -p /usr/local/otter/manager \
    && curl -SL ${INSTALL_URL} -o manager.deployer.tar.gz \
    && gunzip manager.deployer.tar.gz \
    && tar -xf manager.deployer.tar -C /usr/local/otter/manager \
    && rm manager.deployer.tar \
    && rm /var/cache/apk/*

ADD otter.properties /usr/local/otter/manager/conf/otter.properties 

WORKDIR /usr/local/otter/manager

EXPOSE 1099

ADD startup.sh /usr/local/otter/manager/bin/startup.sh

RUN chmod +x /usr/local/otter/manager/bin/startup.sh

CMD ["/usr/local/otter/manager/bin/startup.sh"]

