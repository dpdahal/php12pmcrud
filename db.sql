CREATE DATABASE php12pm;

CREATE TABLE tbl_students(
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(100),
    email varchar(100) UNIQUE,
    password varchar(100),
    gender ENUM ('male','female'),
    language set ('nepali','chinese','english'),
    country varchar(100)

    );



