CREATE TABLE `gaaya`.`gyasai` (
	`saiidsai` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`sailbnom` varchar(50) NOT NULL COMMENT 'Nom donné à la saison', 
	`saidtdeb` date NOT NULL COMMENT 'Date de début de la saison', 
	`saidtfin` date NOT NULL COMMENT 'Date de fin de la saison'
);
