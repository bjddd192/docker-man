FROM php:7.3.4-zts-alpine3.9

MAINTAINER bjddd192 <bjddd192@163.com>

ARG KODEXPLORER_VERSION=4.40
ARG KODEXPLORER_URL=http://static.kodcloud.com/update/download/kodexplorer${KODEXPLORER_VERSION}.zip

# base镜像内核升级和程序部署
RUN set -x \
  && mkdir -p /usr/src/kodexplorer \
  && apk --update --no-cache add wget bash && rm -rf /var/lib/apt/lists/* \
  && wget -q -O /tmp/kodexplorer.zip $KODEXPLORER_URL \
  && unzip /tmp/kodexplorer.zip -d /usr/src/kodexplorer \
  && rm -rf /var/cache/apk/* \
  && rm -rf /tmp/*

# 编译基础环境
RUN set -x \
  && apk add --no-cache --update freetype libpng libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev \
  && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
  && docker-php-ext-install -j "$(getconf _NPROCESSORS_ONLN)" gd \
  && apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

# 指定工作目录
WORKDIR /var/www/html

# 设置启动项
COPY entrypoint.sh /usr/local/bin/
RUN chmod a+x /usr/local/bin/entrypoint.sh

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
CMD [ "php", "-S", "0000:80", "-t", "/var/www/html" ]
