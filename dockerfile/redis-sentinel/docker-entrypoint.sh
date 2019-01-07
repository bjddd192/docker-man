#!/bin/sh

# create sentinel.conf
if [ ! -e ${SENTINEL_CONF_PATH} ]; then
    envsubst < /etc/redis/sentinel.conf.template > ${SENTINEL_CONF_PATH}
    chown redis:redis /etc/redis/sentinel.conf
fi

redis-server /etc/redis/sentinel.conf --sentinel
