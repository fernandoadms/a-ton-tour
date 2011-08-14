CREATE TABLE `specs`.`speobj` (
	`objidobj` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`objcdtri` char(3) NOT NULL COMMENT 'Trigramme', 
	`prjidprj` int NOT NULL COMMENT 'Identifiant du projet', 
	`objlblib` varchar(255) NOT NULL COMMENT 'Libellé', 
	`objlbcde` varchar(64) COMMENT 'Code', 
	`objlbdes` varchar(255) NOT NULL COMMENT 'Description'
);
