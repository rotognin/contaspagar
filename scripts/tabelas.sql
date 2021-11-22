CREATE DATABASE `pagar_db` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pagar_db`;

CREATE TABLE `usuarios_tb` (
  `usuID` int NOT NULL AUTO_INCREMENT,
  `usuNome` varchar(50) NOT NULL,
  `usuLogin` varchar(20) NOT NULL,
  `usuSenha` varchar(50) NOT NULL,
  `usuSituacao` int NOT NULL COMMENT '0 - Inativo, 1 - Liberado, 2 - Bloqueado, 3 - Trocar a Senha',
  `usuMes` int NOT NULL DEFAULT 0,
  `usuANO` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`usuID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `fornecedores_tb` (
  `forID` int NOT NULL AUTO_INCREMENT,
  `forIDUsu` int NOT NULL COMMENT 'Cadastro de usuários',
  `forNome` varchar(100) NOT NULL,
  `forDescricao` varchar(200) DEFAULT ' ',
  `forIDTipo` int NOT NULL COMMENT 'Cadastro de Tipos de Fornecedores',
  `forContato` varchar(200) DEFAULT ' ',
  `forAtivo` int NOT NULL DEFAULT 0,
  PRIMARY KEY (`forID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `tipos_tb` (
  `tipID` int NOT NULL AUTO_INCREMENT,
  `tipIDUsu` int NOT NULL COMMENT 'Cadastro de usuários',
  `tipNome` varchar(100) NOT NULL,
  `tipDescricao` varchar(200) NOT NULL,
  `tipAtivo` int NOT NULL COMMENT '1 - Ativo, 0 - Inativo',
  PRIMARY KEY (`tipID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `contas_tb` (
  `conID` int NOT NULL AUTO_INCREMENT,
  `conIDUsu` int NOT NULL COMMENT 'Cadastro de usuários',
  `conNome` varchar(100) NOT NULL,
  `conDiaVencto` int NOT NULL DEFAULT 0,
  `conAtivo` int NOT NULL COMMENT '1 - Ativo, 0 - Inativo',
  `conValorPrevisto` decimal(8,2) NOT NULL DEFAULT 0.00,
  `conRecorrente` int NOT NULL DEFAULT 0 COMMENT '0 - Não, 1 - Sim',
  `conIDFornecedor` int NOT NULL COMMENT 'Cadastro de Fornecedores',
  `conObservacao` varchar(200) NOT NULL DEFAULT ' ',
  PRIMARY KEY (`conID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pagamentos_tb` (
  `pagID` int NOT NULL AUTO_INCREMENT,
  `pagIDUsu` int NOT NULL COMMENT 'Cadastro de usuários',
  `pagAno` int NOT NULL DEFAULT 0,
  `pagMes` int NOT NULL DEFAULT 0,
  `pagIDConta` int NOT NULL COMMENT 'Cadastro de Contas',
  `pagValorReal` decimal(8,2) NOT NULL DEFAULT 0.00,
  `pagValorPago` decimal(8,2) NOT NULL DEFAULT 0.00,
  `pagData` date NOT NULL COMMENT 'Data que foi efetuado o pagamento',
  `pagDataLancto` date NOT NULL COMMENT 'Data de lançamento do Pagamento (atual)',
  `pagDataVencto` date NOT NULL COMMENT 'Data de Vencimento',
  `pagObservacoes` varchar(200) NOT NULL DEFAULT ' ',
  `pagIDForma` int NOT NULL DEFAULT 0 COMMENT 'Cadastro de Formas de Pagamento',
  PRIMARY KEY (`pagID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `meses_tb` (
  `mesID` int NOT NULL AUTO_INCREMENT,
  `mesIDUsu` int NOT NULL COMMENT 'Cadastro de usuários',
  `mesAno` int NOT NULL DEFAULT 0,
  `mesMes` int NOT NULL DEFAULT 0 COMMENT '01 - Janeiro, 02 - Fevereiro, etc',
  `mesStatus` int NOT NULL COMMENT '1 - Em aberto, 2 - Fechado',
  `mesData` date NOT NULL COMMENT 'Data de fechamento do mês',
  `mesObservacoes` varchar(200) NOT NULL DEFAULT ' ',
  `mesValor` decimal(8,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`mesID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `formas_tb` (
  `fpgID` int NOT NULL AUTO_INCREMENT,
  `fpgIDUsu` int NOT NULL COMMENT 'Cadastro de usuários',
  `fpgNome` varchar(100) NOT NULL DEFAULT ' ',
  `fpgAtivo` int NOT NULL COMMENT '1 - Ativo, 0 - Inativo',
  PRIMARY KEY (`fpgID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;