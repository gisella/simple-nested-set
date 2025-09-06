-- Crea il database se non esiste
CREATE SCHEMA IF NOT EXISTS `nestedset`;

-- Usa il database
USE `nestedset`;

-- Crea le tabelle con IF NOT EXISTS
CREATE TABLE IF NOT EXISTS `node_tree`(
    idNode int not null auto_increment,
    `level` smallint(1),
    iLeft smallint,
    iRight smallint,
    primary key (idNode)
    ) ENGINE=InnoDB DEFAULT character set UTF8mb4 collate utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `node_tree_names`(
    idNode int not null,
    language enum('italian','english') not null default 'english',
    nodeName char(50) not null default '',
    unique key(idNode, language, nodeName),
    foreign key (idNode) REFERENCES `node_tree`(idNode) on delete cascade
    ) ENGINE=InnoDB DEFAULT character set UTF8mb4 collate utf8mb4_general_ci;