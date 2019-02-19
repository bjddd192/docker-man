FROM redash/redash:5.0.0.b4754

MAINTAINER bjddd192 <bjddd192@163.com>

USER root

# 支持 hive impala
RUN pip install PyHive==0.2.1 thrift==0.9.3 cx_Oracle

RUN set -x && apt-get install -y unzip libaio1 libaio-dev unixodbc wget alien locales && \
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
	
ENV ORACLE_HOME=/usr/local/instantclient \
	LD_LIBRARY_PATH=$LD_LIBRARY_PATH:/usr/local/instantclient

USER redash

#Add REDASH ENV to add Oracle Query Runner 
ENV REDASH_ADDITIONAL_QUERY_RUNNERS=redash.query_runner.oracle
