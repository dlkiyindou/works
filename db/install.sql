
CREATE USER 'tornado'@'localhost' IDENTIFIED BY 'knowledge';
CREATE DATABASE IF NOT EXISTS knowledge;
GRANT ALL PRIVILEGES ON knowledge.* TO 'tornado'@'localhost';
FLUSH PRIVILEGES;

USE knowledge;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100),
  firstname VARCHAR(100),
  lastname VARCHAR(100),
  password VARCHAR(100),
  is_connected TINYINT(1) DEFAULT 0
) ENGINE=InnoDB CHARACTER SET=utf8;;

DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  content TEXT,
  user_id INT,
  parent_id INT,
  date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
  date_archived DATETIME,
  FOREIGN KEY (user_id) REFERENCES `user`(id),
  FOREIGN KEY (parent_id) REFERENCES `post`(id)
) ENGINE=InnoDB CHARACTER SET=utf8;