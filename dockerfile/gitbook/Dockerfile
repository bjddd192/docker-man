FROM node:10.16.0-alpine

MAINTAINER bjddd192 <bjddd192@163.com>

# 安装基础组件、设置时区
RUN echo 'http://mirrors.ustc.edu.cn/alpine/v3.9/main' > /etc/apk/repositories \
	&& echo 'http://mirrors.ustc.edu.cn/alpine/v3.9/community' >>/etc/apk/repositories \
	&& apk update && apk add tzdata git \
	&& ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
	&& echo "Asia/Shanghai" > /etc/timezone \
	&& npm config set registry https://registry.npm.taobao.org && \
	&& npm install -g gitbook-cli \
	&& gitbook fetch 3.2.3 \
	&& mkdir /gitbook

EXPOSE 4000

CMD ["sh", "-c", "gitbook install /gitbook; gitbook serve /gitbook"]