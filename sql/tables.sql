create schema if not exists docebo;
use docebo;

# GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root';
# GRANT ALL PRIVILEGES ON *.* TO 'user'@'%' IDENTIFIED BY 'password';


DROP TABLE IF EXISTS `node_tree`;
create table `node_tree`(
    idNode int not null auto_increment,
    `level` smallint(1),
    iLeft smallint,
    iRight smallint,
    primary key (idNode)
)ENGINE=InnoDB DEFAULT character set UTF8mb4 collate  utf8mb4_general_ci;

drop table if exists `node_tree_names`;
create table `node_tree_names`(
    idNode int not null, 
    language enum('italian','english') not null default 'english',
    nodeName char(50) not null default '',
    unique key(idNode, language, nodeName),
    foreign key (idNode) REFERENCES `node_tree`(idNode) on delete cascade
)ENGINE=InnoDB DEFAULT character set UTF8mb4 collate  utf8mb4_general_ci;
