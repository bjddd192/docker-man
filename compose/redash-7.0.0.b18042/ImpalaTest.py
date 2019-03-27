#!/usr/bin/python
#-*- coding: UTF-8 -*-

from impala.dbapi import connect

conn = connect(host='10.240.114.38',port=21050,timeout=3600)

print(conn)

cursor = conn.cursor()

cursor.execute('select * from test2 limit 10')

for result in cursor.fetchall():
    print( result)
