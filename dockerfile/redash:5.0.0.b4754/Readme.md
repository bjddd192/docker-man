# redash:5.0.0.b4754

1. redash:5.0.0.b4754 官方镜像的对 Impala 支持有 Bug，故处理相关的依赖包：`thrift = 0.9.3, pyhive = 0.2.1`;
2. redash:5.0.0.b4754 官方镜像的对 Oracle 不支持，增加支持。

## 参考资料

[Impala and Hive connection issues](https://github.com/getredash/redash/issues/2986)

[python连接impala报错](https://www.smwenku.com/a/5b820d7b2b71772165af6763/zh-cn)

[Oracle Instant Client Downloads for Linux x86-64 (64-bit)](https://www.oracle.com/technetwork/topics/linuxx86-64soft-092277.html)

[joaoleite/redash_oracle](https://github.com/joaoleite/redash_oracle)

[Redash で Oracle 接続の Docker を作ってみた](https://qiita.com/sutoh/items/d19c787069ff43aeebcf)

[Linux oracle中文乱码的问题解决](https://www.cnblogs.com/leolzi/p/9796316.html)


