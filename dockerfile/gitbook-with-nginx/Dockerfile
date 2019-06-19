FROM nginx:1.17.0-alpine

MAINTAINER bjddd192 <bjddd192@163.com>

# 镜像加速
# RUN echo 'http://mirrors.ustc.edu.cn/alpine/v3.9/main' > /etc/apk/repositories \
# 	&& echo 'http://mirrors.ustc.edu.cn/alpine/v3.9/community' >>/etc/apk/repositories

# 安装基础组件、设置时区
RUN apk update && apk add nodejs npm tzdata git curl \
	&& ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
	&& echo "Asia/Shanghai" > /etc/timezone

ARG GITBOOK_VERSION="3.2.3"

# 使用淘宝镜像源加速
# RUN npm config set registry https://registry.npm.taobao.org

# 安装 gitbook	
RUN npm install -g gitbook-cli \
	&& gitbook fetch ${GITBOOK_VERSION} 
