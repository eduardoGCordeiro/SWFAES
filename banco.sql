-- -----------------------------------------------------
-- Table usuarios
-- -----------------------------------------------------
DROP TABLE IF EXISTS usuarios ;

CREATE TABLE IF NOT EXISTS usuarios (
  idusuarios INT NOT NULL,
  nome VARCHAR(45) NOT NULL,
  cpf VARCHAR(11) NOT NULL,
  email VARCHAR(45) NOT NULL,
  login VARCHAR(20) NOT NULL,
  senha VARCHAR(45) NOT NULL,
  PRIMARY KEY (idusuarios))
;


-- -----------------------------------------------------
-- Table adm_agricultura
-- -----------------------------------------------------
DROP TABLE IF EXISTS adm_agricultura ;

CREATE TABLE IF NOT EXISTS adm_agricultura (
  idadm_agricultura INT NOT NULL,
  usuarios_idusuarios INT NOT NULL,
  data_inicio DATE NOT NULL,
  data_fim DATE NULL,
  PRIMARY KEY (idadm_agricultura))
;


-- -----------------------------------------------------
-- Table adm_geral
-- -----------------------------------------------------
DROP TABLE IF EXISTS adm_geral ;

CREATE TABLE IF NOT EXISTS adm_geral (
  idadm_geral INT NOT NULL ,
  usuarios_idusuarios INT NOT NULL,
  data_inicio DATE NOT NULL,
  data_fim DATE NULL,
  PRIMARY KEY (idadm_geral))
;


-- -----------------------------------------------------
-- Table adm_pecuaria
-- -----------------------------------------------------
DROP TABLE IF EXISTS adm_pecuaria ;

CREATE TABLE IF NOT EXISTS adm_pecuaria (
  idadm_pecuaria INT NOT NULL ,
  usuarios_idusuarios INT NOT NULL,
  data_inicio DATE NOT NULL,
  data_fim DATE NULL,
  PRIMARY KEY (idadm_pecuaria))
;


-- -----------------------------------------------------
-- Table funcionarios
-- -----------------------------------------------------
DROP TABLE IF EXISTS funcionarios ;

CREATE TABLE IF NOT EXISTS funcionarios (
  idfuncionarios INT NOT NULL ,
  usuarios_idusuarios INT NOT NULL,
  data_inicio DATE NOT NULL,
  data_fim DATE NULL,
  PRIMARY KEY (idfuncionarios))
;


-- -----------------------------------------------------
-- Table status_requisicoes
-- -----------------------------------------------------
DROP TABLE IF EXISTS status_requisicoes ;

CREATE TABLE IF NOT EXISTS status_requisicoes (
  idstatus_requisicoes INT NOT NULL ,
  nome VARCHAR(45) NULL,
  PRIMARY KEY (idstatus_requisicoes))
;


-- -----------------------------------------------------
-- Table requisicoes
-- -----------------------------------------------------
DROP TABLE IF EXISTS requisicoes ;

CREATE TABLE IF NOT EXISTS requisicoes (
  idrequisicoes INT NOT NULL ,
  adm_geral_idadm_geral INT NOT NULL,
  status_requisicoes_idstatus_requisicoes INT NOT NULL DEFAULT 1,
  adm_agricultura_idadm_agricultura INT NULL,
  adm_pecuaria_idadm_pecuaria INT NULL,
  descricao VARCHAR(45) NULL,
  descricao_adm_geral VARCHAR(45) NULL,
  data DATE NOT NULL,
  PRIMARY KEY (idrequisicoes))
;


-- -----------------------------------------------------
-- Table tipos_atividades
-- -----------------------------------------------------
DROP TABLE IF EXISTS tipos_atividades ;

CREATE TABLE IF NOT EXISTS tipos_atividades (
  idtipos_atividades INT NOT NULL ,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY (idtipos_atividades))
;


-- -----------------------------------------------------
-- Table talhoes
-- -----------------------------------------------------
DROP TABLE IF EXISTS talhoes ;

CREATE TABLE IF NOT EXISTS talhoes (
  idtalhoes INT NOT NULL ,
  descricao VARCHAR(45) NOT NULL,
  PRIMARY KEY (idtalhoes))
;


-- -----------------------------------------------------
-- Table culturas
-- -----------------------------------------------------
DROP TABLE IF EXISTS culturas ;

CREATE TABLE IF NOT EXISTS culturas (
  idculturas INT NOT NULL ,
  talhoes_idtalhoes INT NOT NULL,
  descricao VARCHAR(45) NOT NULL,
  data_inicio DATE NOT NULL,
  data_fim DATE NULL,
  PRIMARY KEY (idculturas))
;


-- -----------------------------------------------------
-- Table atividades
-- -----------------------------------------------------
DROP TABLE IF EXISTS atividades ;

CREATE TABLE IF NOT EXISTS atividades (
  idatividades INT NOT NULL ,
  requisicoes_idrequisicoes INT NOT NULL,
  adm_geral_idadm_geral INT NOT NULL,
  tipos_atividades_idtipos_atividades INT NOT NULL,
  talhoes_idtalhoes INT NOT NULL,
  culturas_idculturas INT NOT NULL,
  descricao VARCHAR(45) NULL,
  data DATE NULL,
  data_registro DATE NOT NULL,
  PRIMARY KEY (idatividades))
;


-- -----------------------------------------------------
-- Table unidades
-- -----------------------------------------------------
DROP TABLE IF EXISTS unidades ;

CREATE TABLE IF NOT EXISTS unidades (
  idunidades INT NOT NULL ,
  nome VARCHAR(15) NOT NULL,
  sigla VARCHAR(15) NULL,
  PRIMARY KEY (idunidades))
;


-- -----------------------------------------------------
-- Table tipos_itens
-- -----------------------------------------------------
DROP TABLE IF EXISTS tipos_itens ;

CREATE TABLE IF NOT EXISTS tipos_itens (
  idtipos_itens INT NOT NULL ,
  nome VARCHAR(45) NULL,
  PRIMARY KEY (idtipos_itens))
;


-- -----------------------------------------------------
-- Table itens
-- -----------------------------------------------------
DROP TABLE IF EXISTS itens ;

CREATE TABLE IF NOT EXISTS itens (
  iditens INT NOT NULL,
  unidades_idunidades INT NOT NULL,
  tipos_itens_idtipos_itens INT NOT NULL,
  nome VARCHAR(45) NOT NULL,
  custo_por_unidade FLOAT NOT NULL,
  PRIMARY KEY (iditens))
;


-- -----------------------------------------------------
-- Table entradas
-- -----------------------------------------------------
DROP TABLE IF EXISTS entradas ;

CREATE TABLE IF NOT EXISTS entradas (
  identradas INT NOT NULL ,
  atividades_idatividades INT NOT NULL,
  itens_iditens INT NOT NULL,
  quantidade FLOAT NOT NULL,
  descricao VARCHAR(45) NULL,
  custo FLOAT NOT NULL,
  PRIMARY KEY (identradas))
;


-- -----------------------------------------------------
-- Table saidas
-- -----------------------------------------------------
DROP TABLE IF EXISTS saidas ;

CREATE TABLE IF NOT EXISTS saidas (
  idsaidas INT NOT NULL ,
  atividades_idatividades INT NOT NULL,
  itens_iditens INT NOT NULL,
  custo FLOAT NOT NULL,
  descricao VARCHAR(45) NULL,
  quantidade FLOAT NOT NULL,
  PRIMARY KEY (idsaidas))
;


-- -----------------------------------------------------
-- Table tipos_animais
-- -----------------------------------------------------
DROP TABLE IF EXISTS tipos_animais ;

CREATE TABLE IF NOT EXISTS tipos_animais (
  idtipos_animais INT NOT NULL ,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY (idtipos_animais))
;


-- -----------------------------------------------------
-- Table especies_animais
-- -----------------------------------------------------
DROP TABLE IF EXISTS especies_animais ;

CREATE TABLE IF NOT EXISTS especies_animais (
  idespecies_animais INT NOT NULL ,
  nome VARCHAR(45) NOT NULL,
  PRIMARY KEY (idespecies_animais))
;


-- -----------------------------------------------------
-- Table animais
-- -----------------------------------------------------
DROP TABLE IF EXISTS animais ;

CREATE TABLE IF NOT EXISTS animais (
  idanimais INT NOT NULL,
  itens_iditens INT NOT NULL,
  tipos_animais_idtipos_animais INT NOT NULL,
  especies_animais_idespecies_animais INT NOT NULL,
  identificacao VARCHAR(45) NULL,
  data_entrada DATE NOT NULL,
  data_saida DATE NULL,
  PRIMARY KEY (idanimais))
;


-- -----------------------------------------------------
-- Table funcionarios_has_atividades
-- -----------------------------------------------------
DROP TABLE IF EXISTS funcionarios_has_atividades ;

CREATE TABLE IF NOT EXISTS funcionarios_has_atividades (
  funcionarios_idfuncionarios INT NOT NULL,
  atividades_idatividades INT NOT NULL,
  PRIMARY KEY (funcionarios_idfuncionarios, atividades_idatividades))
;


-- -----------------------------------------------------
-- Table atividades_has_animais
-- -----------------------------------------------------
DROP TABLE IF EXISTS atividades_has_animais ;

CREATE TABLE IF NOT EXISTS atividades_has_animais (
  atividades_idatividades INT NOT NULL,
  animais_idanimais INT NOT NULL,
  PRIMARY KEY (atividades_idatividades, animais_idanimais))
;



