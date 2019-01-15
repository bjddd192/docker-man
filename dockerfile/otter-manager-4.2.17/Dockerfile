FROM anapsix/alpine-java:8u192b12_server-jre

MAINTAINER bjddd192 <bjddd192@163.com>

ARG NODE_VERSION=4.2.17

# ARG INSTALL_URL=http://10.0.43.24:8066/otter/manager.deployer-${NODE_VERSION}.tar.gz
ARG INSTALL_URL=https://github.com/alibaba/otter/releases/download/otter-${NODE_VERSION}/manager.deployer-${NODE_VERSION}.tar.gz

ENV TZ="Asia/Shanghai" \
    OTTER_MANAGER_DOMAIN_NAME="127.0.0.1" \
    OTTER_MANAGER_PORT=80 \
    OTTER_DATABASE_URL="jdbc:mysql://127.0.0.1:3306/otter" \
    OTTER_DATABASE_USERNAME="user" \
    OTTER_DATABASE_PASSWORD="password" \
    OTTER_ZOOKEEPER_CLUSTER_DEFAULT="127.0.0.1:2181" \
    OTTER_ZOOKEEPER_SESSIONTIMEOUT=60000 \ 
    OTTER_MANAGER_MONITOR_EMAIL_HOST="smtp@163.com" \
    OTTER_MANAGER_MONITOR_EMAIL_USERNAME="user" \
    OTTER_MANAGER_MONITOR_EMAIL_PASSWORD="password" \
    OTTER_MANAGER_MONITOR_EMAIL_STMP_PORT=25 \
    LOG_LEVEL="INFO" \
    LOG_APPENDER="STDOUT" \
    JAVA_XMS="256M" \
    JAVA_XMX="512M" \
    JAVA_XMN="128M"

RUN apk add --update curl bash aria2 file tzdata \
    && ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \ 
	&& echo "Asia/Shanghai" > /etc/timezone \
    && mkdir -p /usr/local/otter/manager \
    && curl -SL ${INSTALL_URL} -o manager.deployer.tar.gz \
    && gunzip manager.deployer.tar.gz \
    && tar -xf manager.deployer.tar -C /usr/local/otter/manager \
    && rm manager.deployer.tar \
    && rm /var/cache/apk/*
    
WORKDIR /usr/local/otter/manager

ADD otter.properties /usr/local/otter/manager/conf/otter.properties 

ADD logback.xml /usr/local/otter/manager/conf/logback.xml

ADD startup.sh /usr/local/otter/manager/bin/startup.sh

RUN chmod +x /usr/local/otter/manager/bin/startup.sh

EXPOSE 1099

CMD ["/usr/local/otter/manager/bin/startup.sh"]

