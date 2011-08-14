CREATE TABLE `tmp`.`fmeact` (
	`actidact` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant de l'action', 
	`actidpro` int NOT NULL COMMENT 'Identifiant du proprietaire', 
	`actlbtit` varchar(255) NOT NULL COMMENT 'Titre de l'action', 
	`actnupri` char(1) COMMENT 'Priorité de l'action : 1 (très prioritaire) à 5 (non prioritaire)', 
	`actdtcre` date NOT NULL COMMENT 'Date de création (ou de détection) de l'action', 
	`actdtdem` date COMMENT 'Date de prise en compte de l'action (commencée le)', 
	`actdteci` date COMMENT 'Date d'échéance initiale de l'action (doit être terminée pour le)', 
	`actdtecp` date COMMENT 'Date d'échéance prévue de l'action (devrait être terminée le)', 
	`actdtecr` date COMMENT 'Date d'échéance réelle de l'action (terminée le)', 
	`actfgcac` char(1) COMMENT 'Flag action cachée (Oui ou Non)'
);
