CREATE TABLE `followme`.`fmeusr` (
	`usridusr` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifant de l'utilisateur', 
	`usrcdusr` char(10) COMMENT 'Code de l'utilisateur (nom court)', 
	`usrlbnom` varchar(255) COMMENT 'Nom de l'utilisateur', 
	`usrlbprn` varchar(255) COMMENT 'Prénom de l'utilisateur', 
	`usridser` int COMMENT 'Identifiant du service de l'utilisateur', 
	`usridres` int COMMENT 'Identifiant du responsable de l'utilisateur'
);
