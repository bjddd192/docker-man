# 说明

## 操作说明

```sh
yum install epel-release
yum ​install pwgen

# setup.sh 脚本用于生成 env 文件
# generate_key.sh 脚本用于更新 env 文件
# 这里我使用 setup.sh 生成了一份 env 文件并将内容复制给了 env_file 文件 

# 初始化系统数据（pg 数据库）
docker-compose run --rm server create_db

# 启动
docker-compose up -d
```
