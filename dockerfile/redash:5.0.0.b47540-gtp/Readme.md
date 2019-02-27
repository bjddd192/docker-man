# redash:5.0.0.b4754-gtp

特殊用途，用于指定 impala 用户 gtp_select，用于 impala 数据源连接，解决以下报错：

```sh
Connection Test Failed:
Metastore Error [AuthorizationException: User 'redash' does not have privileges to access: gtp.*.* ]
```


