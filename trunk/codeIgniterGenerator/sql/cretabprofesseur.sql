CREATE TABLE `gaaya`.`gyapro` (
	`proidpro` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`prolbnom` varchar(255) NOT NULL COMMENT 'Nom du professeur', 
	`prolbprn` varchar(255) NOT NULL COMMENT 'Prénom du professeur', 
	`prolbtel` varchar(50) COMMENT 'Téléphone fixe et/ou mobile', 
	`prolbmai` varchar(255) COMMENT 'Adresse e-mail du professeur', 
	`protxcmp` varchar(4000) COMMENT 'Compétences techniques, résultats, diplomes, etc. (mini CV)'
);
