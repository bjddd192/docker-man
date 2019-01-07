#!/bin/sh

NODE1_IP=$(docker inspect --format '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' redis_node1)
NODE2_IP=$(docker inspect --format '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' redis_node2)
NODE3_IP=$(docker inspect --format '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' redis_node3)

echo Redis Node1: $NODE1_IP
echo Redis Node2: $NODE2_IP
echo Redis Node3: $NODE3_IP
echo ------------------------------------------------
echo Initial status of sentinel
echo ------------------------------------------------
docker exec -it redissentinel_redis_sentinel_1_1 redis-cli -p 26379 info Sentinel
echo Current master is
docker exec -it redissentinel_redis_sentinel_1_1 redis-cli -p 26379 SENTINEL get-master-addr-by-name redis-master
echo ------------------------------------------------

echo Stop redis master
docker pause redis_node2
echo Wait for 36 seconds
sleep 36
echo Current infomation of sentinel
docker exec -it redissentinel_redis_sentinel_1_1 redis-cli -p 26379 info Sentinel
echo Current master is
docker exec -it redissentinel_redis_sentinel_1_1 redis-cli -p 26379 SENTINEL get-master-addr-by-name redis-master
