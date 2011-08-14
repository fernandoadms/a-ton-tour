CREATE TABLE `specs`.`spechp` (
	`chpidchp` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`chplbcde` char(64) NOT NULL COMMENT 'Code / identifiant SQL', 
	`chplbnom` varchar(255) NOT NULL COMMENT 'Nom', 
	`chpfgnul` char(1) COMMENT 'Flag "peut être NULL"', 
	`chpfgcle` char(1) NOT NULL COMMENT 'Flag "est une clé"', 
	`chpcdtyp` varchar(64) NOT NULL COMMENT 'Type', 
	`chplbdes` varchar(255) NOT NULL COMMENT 'Description', 
	`objidobj` int NOT NULL COMMENT 'Identifiant de l''objet'
);
