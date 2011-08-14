CREATE TABLE `specs`.`spesch` (
`schidsch` INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'identifiant',
`schnuver` INT NOT NULL COMMENT 'version',
`schdtcre` DATE NOT NULL COMMENT 'date de creation',
`schlbtit` VARCHAR( 255 ) NOT NULL COMMENT 'titre',
`schlbdes` TEXT NOT NULL COMMENT 'description',
`schlbimg` VARCHAR( 500 ) NOT NULL COMMENT 'chemin de l''image',
`schlbsrc` VARCHAR( 500 ) NOT NULL COMMENT 'chemin de la source',
`schidvpr` INT NOT NULL COMMENT 'identifiant de la version precedente'
) ENGINE = MYISAM COMMENT = 'Table des schemas';

