/*
创建数据库与用户
*/

create database db_lepus;
grant all PRIVILEGES on db_lepus.* to 'user_lepus'@'%' identified by 'user_lepus';
flush PRIVILEGES;

