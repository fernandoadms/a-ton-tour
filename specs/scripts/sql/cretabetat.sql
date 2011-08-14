CREATE TABLE `followme`.`fmeeta` (
	`etacdeta` char(10) NOT NULL PRIMARY KEY COMMENT 'Code de l'état', 
	`etalbeta` varchar(255) NOT NULL COMMENT 'Libellé de l'état', 
	`etacdact` char(1) NOT NULL COMMENT 'Activité : R : actif (running) / P : en pause (pause) / T : terminée (terminated) / L : repoussée à plus tard (later) / C : abandonné (canceled)'
);
