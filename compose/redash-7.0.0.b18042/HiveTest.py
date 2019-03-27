#!/usr/bin/python
#-*- coding: UTF-8 -*-

from pyhive import hive

conn = hive.Connection(host='10.240.114.34',port=10000,username='user_cdh6',database='default')

print(conn)

cursor = conn.cursor()

cursor.execute('select * from test2 limit 10')

for result in cursor.fetchall():
    print( result)
