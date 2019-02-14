#!/usr/bin/python
#-*- coding: UTF-8 -*-

from impala.dbapi import connect

conn = connect(host='110.240.114.34',port=10000,authMechanism='NOSASL',user='user_cdh6',password='123456',database='default')

print(conn)

cursor = conn.cursor()

cursor.execute('show databases')

print cursor.description  # prints the result set's schema

results = cursor.fetchall()

print(results)

cursor.execute('select * from dc_ods.bi_mdm_pro_product_ods limit 10')

print cursor.description  # prints the result set's schema

results = cursor.fetchall()

print(results)
