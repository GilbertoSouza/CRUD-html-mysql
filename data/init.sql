CREATE DATABASE test;

use test;

CREATE TABLE `users` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`nome` VARCHAR(30) NOT NULL COLLATE 'latin1_swedish_ci',
	`telefone` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`cidade` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	`estado` VARCHAR(30) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`email` VARCHAR(50) NULL DEFAULT NULL COLLATE 'latin1_swedish_ci',
	`complemento` LONGTEXT NOT NULL COLLATE 'latin1_swedish_ci',
	`tipo` VARCHAR(20) NOT NULL COLLATE 'latin1_swedish_ci',
	`cpf_cnpj` VARCHAR(30) NOT NULL COLLATE 'latin1_swedish_ci',
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;