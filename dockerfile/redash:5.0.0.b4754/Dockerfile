FROM redash/redash:5.0.0.b4754

MAINTAINER bjddd192 <bjddd192@163.com>

USER root

# 支持 hive impala
RUN pip install PyHive==0.2.1 thrift==0.9.3

RUN apt-get update  -y
RUN apt-get install -y unzip

# Oracle instantclient
# ADD instantclient-basic-linux.x64-11.2.0.4.0.zip /tmp/instantclient-basic-linux.x64-11.2.0.4.0.zip
# ADD instantclient-sdk-linux.x64-11.2.0.4.0.zip /tmp/instantclient-sdk-linux.x64-11.2.0.4.0.zip
# ADD instantclient-sqlplus-linux.x64-11.2.0.4.0.zip /tmp/instantclient-sqlplus-linux.x64-11.2.0.4.0.zip

RUN set -x && apt-get -y update&& apt-get install -y unzip && \
	wget -P /tmp --no-check-certificate --no-cookies \
	https://github.com/joaoleite/redash_oracle/raw/master/oracle/instantclient-basic-linux.x64-11.2.0.4.0.zip && \
	wget -P /tmp --no-check-certificate --no-cookies \
	https://github.com/joaoleite/redash_oracle/raw/master/oracle/instantclient-sdk-linux.x64-11.2.0.4.0.zip && \
	wget -P /tmp --no-check-certificate --no-cookies \
	https://github.com/joaoleite/redash_oracle/raw/master/oracle/instantclient-sqlplus-linux.x64-11.2.0.4.0.zip && \
	unzip /tmp/instantclient-basic-linux.x64-11.2.0.4.0.zip -d /usr/local/ && \
	unzip /tmp/instantclient-sdk-linux.x64-11.2.0.4.0.zip -d /usr/local/ && \
	unzip /tmp/instantclient-sqlplus-linux.x64-11.2.0.4.0.zip -d /usr/local/ && \
	ln -s /usr/local/instantclient_11_2 /usr/local/instantclient && \
	ln -s /usr/local/instantclient/libclntsh.so.11.1 /usr/local/instantclient/libclntsh.so && \
	ln -s /usr/local/instantclient/sqlplus /usr/bin/sqlplus 

RUN apt-get -y install libaio-dev vim
RUN apt-get -y clean 
	
ENV ORACLE_HOME=/usr/local/instantclient \
	LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/instantclient \
	TNS_ADMIN=$ORACLE_HOME/network/admin \
	NLS_LANG=AMERICAN_AMERICA.AL32UTF8
	
RUN pip install cx_Oracle==5.2.1

USER redash

# Add REDASH ENV to add Oracle Query Runner 
ENV REDASH_ADDITIONAL_QUERY_RUNNERS=redash.query_runner.oracle

# 解决 impala 查询语句包含中文时的报错：
# Error running query: 'ascii' codec can't encode characters in position 190-192: ordinal not in range(128)
ADD sitecustomize.py /usr/local/lib/python2.7/site-packages/sitecustomize.py
ADD impala_ds.py /app/redash/query_runner/impala_ds.py
