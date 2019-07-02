# 封装 mysql 监控工具《天兔 lepus》前端 php 管理控制台
# 验证：curl http://127.0.0.1/index.php/login?return_url=http://127.0.0.1/index.php

FROM registry.eyd.com:5000/library/php:5.3.29-apache

MAINTAINER yanglei <yang.l@wonhigh.cn>

ADD http://down.belle.cn/package/lepus/lepus_v3.7_php.tar.gz /tmp/lepus_v3.7_php.tar.gz
RUN set -x && \
    tar xvf /tmp/lepus_v3.7_php.tar.gz -C /var/www/html && rm -rf /tmp/lepus_v3.7_php.tar.gz

ENV LANG="C.UTF-8" \
    TZ="Asia/Shanghai" \
    TERM="linux" \
    MYSQL_HOST="127.0.0.1" \
    MYSQL_PORT=3306 \
    MYSQL_USER="user_lepus" \
    MYSQL_PASS="user_lepus" \
    MYSQL_DBNAME="user_lepus" \
    MYSQL_CHARSET="utf8" \
    MYSQL_COLLATE="utf8_bin" \
    SMTP_HOST="smtp.163.com" \
    SMTP_PORT=25 \
    SMTP_USER="smtp_user" \
    SMTP_PASS="smtp_pass" \
    SMTP_TIMEOUT=10

# 自定义 php 配置文件，这个版本一定要命名为php.ini，放在/usr/local/lib/路径下
# 因为遇到 PHP Warning: Missing argument 的错误，原因是需要关闭 php 的 safe 模式。
# 将safe_mode = On 改成 safe_mode = Off 即可
ADD php.ini /usr/local/lib/php.ini
