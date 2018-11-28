CREATE DATABASE coreproject12pm;

CREATE TABLE tbl_user_privilege(
id int AUTO_INCREMENT PRIMARY KEY,
privilege_name varchar(100) unique ,
created_at datetime,
updated_at datetime
);

CREATE TABLE tbl_users(
id int AUTO_INCREMENT PRIMARY KEY,
name varchar(100) not null,
username varchar(100) UNIQUE,
email varchar(100) UNIQUE,
password varchar(100),
status boolean DEFAULT 0,
image varchar(100) not null,
created_at datetime,
updated_at datetime
);

CREATE TABLE tbl_manage_privilege(
id int AUTO_INCREMENT PRIMARY KEY,
user_id int,
privilege_id int,
FOREIGN KEY(user_id) REFERENCES tbl_users(id) on DELETE RESTRICT on UPDATE CASCADE,
FOREIGN KEY(privilege_id) REFERENCES tbl_user_privilege(id) on DELETE RESTRICT on UPDATE CASCADE
);

CREATE TABLE tbl_slider(
id int AUTO_INCREMENT PRIMARY KEY,
title varchar(255)UNIQUE,
image varchar(100),
status boolean DEFAULT 0,
description text
);

