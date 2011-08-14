CREATE TABLE `followme`.`fmelgn` (
	`lgnidlgn` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant du login', 
	`lgnidusr` int COMMENT 'Identifiant de l'utilisateur', 
	`lgnlblgn` varchar(50) NOT NULL COMMENT 'Login de connexion', 
	`lgnlbpwd` varchar(50) NOT NULL COMMENT 'Mot de passe', 
	`lgncdprf` char(10) COMMENT 'Profil de connexion', 
	`lgnfgarc` char(1) COMMENT 'Flag d'archivage : 1: archivé'
);
