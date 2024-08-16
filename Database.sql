CREATE SCHEMA Kanban;


USE Kanban;


CREATE TABLE `projetos` (
  `uid` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `tarefa` varchar(100) NOT NULL,
  `dataHoraCadastro` varchar(50) NOT NULL DEFAULT '',
  `todo` char(1) DEFAULT '0',
  `ongoing` char(1) DEFAULT '0',
  `done` char(1) DEFAULT '0',
  `gone` char(1) DEFAULT '0',
  PRIMARY KEY (`uid`)
) 