# 封装 mysql 监控工具《天兔 lepus》 python 数据采集程序

FROM centos:6.8

#MAINTAINER 格式为 MAINTAINER <name>，指定维护者信息。
MAINTAINER bjddd192 <bjddd192@163.com>

# 安装必备的包
RUN set -x && \
    yum install -y ntp vim-enhanced gcc gcc-c++ flex bison autoconf automake bzip2-devel wget \
                   ncurses-devel zlib-devel libjpeg-devel libpng-devel libtiff-devel freetype-devel libXpm-devel \
                   gettext-devel pam-devel libtool libtool-ltdl openssl openssl-devel fontconfig-devel \
                   libxml2-devel curl-devel libicu libicu-devel libmcrypt libmcrypt-devel libmhash libmhash-devel \
                   python-devel mysql-devel MySQL-python && \
    echo "/lib64" >> /etc/ld.so.conf && /sbin/ldconfig -v

# 安装redis的python驱动
ADD http://10.0.43.24:8066/package/lepus/redis-py-2.10.3.tar.gz /tmp/redis-py-2.10.3.tar.gz
RUN set -x && \
    tar zxvf /tmp/redis-py-2.10.3.tar.gz -C /tmp && cd /tmp/redis-2.10.3 && \
    python setup.py install && rm -rf /tmp/*

# 安装oracle的python驱动
# https://help.ubuntu.com/community/Oracle%20Instant%20Client
# http://blog.csdn.net/u011666720/article/details/41350897
# 验证：sqlplus64 system/oracle@172.20.32.36/xe
RUN set -x && \
    cd /tmp && wget http://10.0.43.24:8066/package/lepus/oracle-instantclient-basic-10.2.0.5-1.x86_64.rpm && \
    wget http://10.0.43.24:8066/package/lepus/oracle-instantclient-devel-10.2.0.5-1.x86_64.rpm && \
    wget http://10.0.43.24:8066/package/lepus/oracle-instantclient-sqlplus-10.2.0.5-1.x86_64.rpm && \
    rpm -ivh oracle-instantclient-basic-10.2.0.5-1.x86_64.rpm && \
    rpm -ivh oracle-instantclient-devel-10.2.0.5-1.x86_64.rpm && \
    rpm -ivh oracle-instantclient-sqlplus-10.2.0.5-1.x86_64.rpm && \
    export LD_LIBRARY_PATH=/usr/lib/oracle/10.2.0.5/client64/lib/:$LD_LIBRARY_PATH && \
    export ORACLE_HOME=/usr/lib/oracle/10.2.0.5/client64 && \
    export PATH=$PATH:$ORACLE_HOME/bin && \
    export PATH=$PATH:$ORACLE_HOME/lib && \
    echo "/usr/lib/oracle/10.2.0.5/client64/lib/" > /etc/ld.so.conf.d/oracle.conf && \
    echo "export ORACLE_HOME=/usr/lib/oracle/10.2.0.5/client64" >> /etc/profile.d/oracle.sh && \
    echo "export PATH=$PATH:$ORACLE_HOME/bin" >> /etc/profile.d/oracle.sh && \
    echo "export PATH=$PATH:$ORACLE_HOME/lib" >> /etc/profile.d/oracle.sh && \
    chmod o+r /etc/ld.so.conf.d/oracle.conf && ldconfig && \
    ln -s /usr/include/oracle/10.2.0.5/client64 $ORACLE_HOME/include && \
    wget http://10.0.43.24:8066/package/lepus/cx_Oracle-5.1.2.tar.gz && \
    tar zxvf cx_Oracle-5.1.2.tar.gz && cd cx_Oracle-5.1.2 && \
    python setup.py build && python setup.py install && rm -rf /tmp/*

# 安装mongodb的python驱动
RUN set -x && \
    cd /tmp && wget http://10.0.43.24:8066/package/lepus/get-pip.py && \
    python get-pip.py && pip install pymongo==3.1.1 && rm -rf /tmp/*

# 安装lepus监控程序
COPY src /tmp/
RUN set -x && \
    cd /tmp && ./install.sh && rm -rf /tmp/*

# 操作系统的监控（使用 snmp 协议），配置繁琐，且用途不大，还是用专业的工具（如 zabbix）来进行监控比较好
# 这里就略过，不做这个功能的处理

ENV LANG="en_US.UTF-8" \
    TZ="Asia/Shanghai" \
    TERM="linux" \ 
    MYSQL_HOST="127.0.0.1" \
    MYSQL_PORT=3306 \
    MYSQL_USER="user_lepus" \
    MYSQL_PASS="user_lepus" \
    MYSQL_DBNAME="user_lepus" \
    LEPUS_WEB_HOST="127.0.0.1:80" \
    MYSQL_SLOW_QUERY_SEND_CRONTAB="00 07 * * *"

# 设置慢查询自动推送
RUN set -x && \
    yum -y install vixie-cron crontabs links

WORKDIR /usr/local/lepus

CMD ["/usr/local/lepus/lepus","start"]

