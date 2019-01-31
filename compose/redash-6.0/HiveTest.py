#!/usr/bin/python
#-*- coding: UTF-8 -*-

from impala.dbapi import connect

conn = connect(host='10.240.20.22',port=10001,authMechanism='NOSASL',user='gtp_admin',password='NyLCm9Dt',database='gtp')

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
