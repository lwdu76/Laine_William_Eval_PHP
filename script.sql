-- Sélection de la base de données links_manager_dev

USE `links_manager_dev`;

-- Création de la table links

CREATE TABLE IF NOT EXISTS `links`  (
    `link_id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(50) NOT NULL,
    `url` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`link_id`)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE='utf8_general_ci';


-- Insertion du jeux de données

INSERT INTO `links` (`title`, `url`) 
VALUES ('MDN Web docs', 'https://developer.mozilla.org/fr'),
        ('CSS tricks', 'https://css-tricks.com'),
        ('AWWARDS', 'https://www.awwwards.com'),
        ('PHP the right way', 'https://eilgin.github.io/php-the-right-way'),
        ('React.JS New doc', 'https://beta.reactjs.org');