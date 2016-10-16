 SET foreign_key_checks = 0;

CREATE DATABASE IF NOT EXISTS`u845380189_sint`;
USE `u845380189_sint`;

DROP TABLE IF EXISTS `u845380189_sint`.`usuario`;
CREATE TABLE `u845380189_sint`.`usuario`(
	usuID		INT AUTO_INCREMENT,
    usuNome     VARCHAR(255) NOT NULL,
    usuSenha   VARCHAR(16) NOT NULL,
    PRIMARY KEY (usuID)
);



SELECT * FROM `u845380189_sint`.`usuario`;

