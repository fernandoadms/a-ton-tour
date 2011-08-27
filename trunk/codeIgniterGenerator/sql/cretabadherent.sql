CREATE TABLE `gaaya`.`gyaadh` (
	`adhidadh` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`adhlbnom` varchar(255) NOT NULL COMMENT 'Nom de l\'adhérent', 
	`adhlbprn` varchar(255) NOT NULL COMMENT 'Prénom de l\'adhérent', 
	`adhtxadr` varchar(4000) NOT NULL COMMENT 'Adresse complète, avec code postal et ville', 
	`adhlbtel` varchar(50) COMMENT 'Téléphone fixe et/ou mobile', 
	`adhlbmai` varchar(255) COMMENT 'Adresse e-mail de l\'adhérent', 
	`adhblpho` blob COMMENT 'Photo de l\'adhérent'
);
