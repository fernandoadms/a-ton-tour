CREATE TABLE `tmp`.`fmedet` (
	`detiddet` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifant du détail', 
	`detlbdes` text NOT NULL COMMENT 'Texte de la description du détail de l'action', 
	`actidact` int NOT NULL COMMENT 'Identifiant de l'action', 
	`usridres` int COMMENT 'Identifiant de l'utilisateur responsable', 
	`detdteci` date COMMENT 'Date d'échéance (doit être terminée pour le)', 
	`detdtecp` date COMMENT 'Date d'échéance prévue (devrait être terminée le)', 
	`detdtecr` date COMMENT 'Date d'échéance réelle (terminée le)', 
	`etacdeta` char(10) COMMENT 'Code état du détail'
);
