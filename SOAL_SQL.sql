DROP DATABASE IF EXISTS soaltestsql_matthew;

CREATE DATABASE soaltestsql_matthew;

CREATE TABLE user(
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(20),
	parent INT
);

INSERT INTO user (username, parent) VALUES("Ali", 2), ("Budi", 0), ("Cecep", 1);

SELECT u.id as Id, u.username as UserName, v.username as ParentUserName
FROM user u LEFT JOIN user v
ON u.parent = v.id;

DROP DATABASE soaltestsql_matthew;