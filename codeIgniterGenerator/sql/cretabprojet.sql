CREATE TABLE `test`.`tstprj` (
	`prjidprj` int NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'Identifiant', 
	`prjlbnom` varchar(255) NOT NULL COMMENT 'Libellé du projet', 
	`prjtxdes` varchar(4000) COMMENT 'Description globale de l\'objectif à atteindre'
);
