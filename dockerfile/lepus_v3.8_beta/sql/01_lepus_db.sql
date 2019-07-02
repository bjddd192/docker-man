/*
创建数据库与用户
*/

create database db_lepus_new;
grant all PRIVILEGES on db_lepus_new.* to 'user_lepus'@'%' identified by 'user_lepus';
flush PRIVILEGES;

