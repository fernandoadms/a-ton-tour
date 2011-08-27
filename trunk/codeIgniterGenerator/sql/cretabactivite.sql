CREATE TABLE `gaaya`.`gyaact` (
	`actidact` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`actlblib` varchar(255) NOT NULL COMMENT 'Nom', 
	`actidniv` int COMMENT 'Lien vers le niveau de l\'activité', 
	`actidtra` int COMMENT 'Lien vers la tranche d\'age théorique des adhérents', 
	`actidsai` int NOT NULL COMMENT 'Saison de l\'activité', 
	`actidpro` int COMMENT 'professeur qui dirige l\'activité (vide = pas de professeur)', 
	`actlbjou` varchar(50) NOT NULL COMMENT 'créneau horaire  - jour de la semaine', 
	`actlbhdb` varchar(10) NOT NULL COMMENT 'créneau horaire - heure de début', 
	`actlbdfn` varchar(10) NOT NULL COMMENT 'créneau horaire - heure de fin', 
	`actfgmai` char(1) NOT NULL COMMENT 'activité maintenue lors de la saison'
);
