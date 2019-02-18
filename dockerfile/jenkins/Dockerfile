FROM jenkins/jenkins:lts

MAINTAINER bjddd192 <bjddd192@163.com>

USER root

ENV TZ="Asia/Shanghai"

# 安装 maven
RUN set -x && \
    apt-get update && apt-get install -y git curl tar zip net-tools telnet expect vim && rm -rf /var/lib/apt/lists/* && \
    wget -P /tmp --no-check-certificate --no-cookies \
    http://apache.fayea.com/maven/maven-3/3.3.9/binaries/apache-maven-3.3.9-bin.tar.gz && \
    tar -xzf /tmp/apache-maven-3.3.9-bin.tar.gz -C /usr/local/ && \
    rm -rf /tmp/apache-maven-3.3.9-bin.tar.gz && \
    { \
            echo ''; \
            echo 'export MAVEN_HOME=/usr/local/apache-maven-3.3.9'; \
            echo 'export PATH=${PATH}:${MAVEN_HOME}/bin'; \
    } >> /etc/bash.bashrc

ENV MAVEN_HOME /usr/local/apache-maven-3.3.9

