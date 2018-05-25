
-- object: public.usuario | type: TABLE --
-- DROP TABLE IF EXISTS public.usuario CASCADE;
CREATE TABLE public."usuario"(
	id_usuario serial NOT NULL,
	cpf varchar(11) NOT NULL,
	nome varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	login varchar(13) NOT NULL,
	senha varchar(45) NOT NULL,
	CONSTRAINT usuario_pk PRIMARY KEY (id_usuario),
	CONSTRAINT cpf UNIQUE (cpf) DEFERRABLE INITIALLY IMMEDIATE

);
-- ddl-end --
ALTER TABLE public."usuario" OWNER TO postgres;
-- ddl-end --

-- object: public.funcionario | type: TABLE --
-- DROP TABLE IF EXISTS public.funcionario CASCADE;
CREATE TABLE public."funcionario"(
	id_funcionario serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_usuario_usuario integer,
	CONSTRAINT funcionario_pk PRIMARY KEY (id_funcionario)

);
-- ddl-end --
ALTER TABLE public."funcionario" OWNER TO postgres;
-- ddl-end --

-- object: public.adm_geral | type: TABLE --
-- DROP TABLE IF EXISTS public.adm_geral CASCADE;
CREATE TABLE public."adm_geral"(
	id_adm_agricultura serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_usuario_usuario integer,
	CONSTRAINT adm_agricultura_pk PRIMARY KEY (id_adm_agricultura)

);
-- ddl-end --
ALTER TABLE public."adm_geral" OWNER TO postgres;
-- ddl-end --

-- object: public.adm_pecuaria | type: TABLE --
-- DROP TABLE IF EXISTS public.adm_pecuaria CASCADE;
CREATE TABLE public."adm_pecuaria"(
	id_adm_pecuaria serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_usuario_usuario integer,
	CONSTRAINT adm_pecuaria_pk PRIMARY KEY (id_adm_pecuaria)

);
-- ddl-end --
ALTER TABLE public."adm_pecuaria" OWNER TO postgres;
-- ddl-end --

-- object: public.adm_agricultura | type: TABLE --
-- DROP TABLE IF EXISTS public.adm_agricultura CASCADE;
CREATE TABLE public."adm_agricultura"(
	id_adm_geral serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_usuario_usuario integer,
	CONSTRAINT adm_geral_pk PRIMARY KEY (id_adm_geral)

);
-- ddl-end --
ALTER TABLE public."adm_agricultura" OWNER TO postgres;
-- ddl-end --

-- object: public.funcionario_tem_atividade | type: TABLE --
-- DROP TABLE IF EXISTS public.funcionario_tem_atividade CASCADE;
CREATE TABLE public."funcionario_tem_atividade"(
	id_atividade_atividade integer,
	id_funcionario_funcionario integer
);
-- ddl-end --
ALTER TABLE public."funcionario_tem_atividade" OWNER TO postgres;
-- ddl-end --

-- object: public.requisicao | type: TABLE --
-- DROP TABLE IF EXISTS public.requisicao CASCADE;
CREATE TABLE public."requisicao"(
	id_requisicao serial NOT NULL,
	data date NOT NULL,
	descricao varchar(100),
	descricao_adm_geral varchar(100),
	id_adm_geral_adm_agricultura integer,
	id_adm_pecuaria_adm_pecuaria integer,
	id_adm_agricultura_adm_geral integer,
	id_requisicao_status_requisicao integer,
	CONSTRAINT requisicao_pk PRIMARY KEY (id_requisicao)

);
-- ddl-end --
ALTER TABLE public."requisicao" OWNER TO postgres;
-- ddl-end --

-- object: public.atividade | type: TABLE --
-- DROP TABLE IF EXISTS public.atividade CASCADE;
CREATE TABLE public."atividade"(
	id_atividade serial NOT NULL,
	data date NOT NULL,
	data_registro date NOT NULL,
	descricao varchar(100),
	id_adm_agricultura_adm_geral integer,
	id_tipo_atividade_tipo_atividade integer,
	id_cultivo_cultivo smallint,
	id_requisicao_requisicao integer,
	id_talhao_talhao integer,
	CONSTRAINT atividade_pk PRIMARY KEY (id_atividade)

);
-- ddl-end --
ALTER TABLE public."atividade" OWNER TO postgres;
-- ddl-end --

-- object: public.tipo_atividade | type: TABLE --
-- DROP TABLE IF EXISTS public.tipo_atividade CASCADE;
CREATE TABLE public."tipo_atividade"(
	id_tipo_atividade serial NOT NULL,
	nome varchar(45),
	CONSTRAINT tipo_atividade_pk PRIMARY KEY (id_tipo_atividade)

);
-- ddl-end --
ALTER TABLE public."tipo_atividade" OWNER TO postgres;
-- ddl-end --

-- object: public.status_requisicao | type: TABLE --
-- DROP TABLE IF EXISTS public.status_requisicao CASCADE;
CREATE TABLE public."status_requisicao"(
	id_requisicao serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT status_requisicao_pk PRIMARY KEY (id_requisicao)

);
-- ddl-end --
ALTER TABLE public."status_requisicao" OWNER TO postgres;
-- ddl-end --

-- object: public.saida | type: TABLE --
-- DROP TABLE IF EXISTS public.saida CASCADE;
CREATE TABLE public."saida"(
	id_saida smallint NOT NULL,
	custo float NOT NULL,
	quantidade float NOT NULL,
	descricao varchar(45),
	id_item_item integer,
	CONSTRAINT saida_pk PRIMARY KEY (id_saida)

);
-- ddl-end --
ALTER TABLE public."saida" OWNER TO postgres;
-- ddl-end --

-- object: public.item | type: TABLE --
-- DROP TABLE IF EXISTS public.item CASCADE;
CREATE TABLE public."item"(
	id_item serial NOT NULL,
	nome varchar(46) NOT NULL,
	custo_por_unidade float NOT NULL,
	id_unidade_unidade integer,
	id_tipo_item_tipo_item integer,
	CONSTRAINT item_pk PRIMARY KEY (id_item)

);
-- ddl-end --
ALTER TABLE public."item" OWNER TO postgres;
-- ddl-end --

-- object: public.entrada | type: TABLE --
-- DROP TABLE IF EXISTS public.entrada CASCADE;
CREATE TABLE public."entrada"(
	id_entrada serial NOT NULL,
	quantidade float NOT NULL,
	custo float NOT NULL,
	descricao varchar(45) NOT NULL,
	id_item_item integer,
	id_atividade_atividade integer,
	CONSTRAINT entrada_pk PRIMARY KEY (id_entrada)

);
-- ddl-end --
ALTER TABLE public."entrada" OWNER TO postgres;
-- ddl-end --

-- object: public.atividade_tem_animal | type: TABLE --
-- DROP TABLE IF EXISTS public.atividade_tem_animal CASCADE;
CREATE TABLE public."atividade_tem_animal"(
	id_animal_animal integer,
	id_atividade_atividade integer
);
-- ddl-end --
ALTER TABLE public."atividade_tem_animal" OWNER TO postgres;
-- ddl-end --

-- object: public.animal | type: TABLE --
-- DROP TABLE IF EXISTS public.animal CASCADE;
CREATE TABLE public."animal"(
	id_animal serial NOT NULL,
	data_entrada date NOT NULL,
	identificacao varchar(45) NOT NULL,
	data_saida date,
	id_especie_animal_especie_animal integer,
	id_item_item integer,
	id_tipo_animal_tipo_animal integer,
	CONSTRAINT animal_pk PRIMARY KEY (id_animal)

);
-- ddl-end --
ALTER TABLE public."animal" OWNER TO postgres;
-- ddl-end --

-- object: public.tipo_animal | type: TABLE --
-- DROP TABLE IF EXISTS public.tipo_animal CASCADE;
CREATE TABLE public."tipo_animal"(
	id_tipo_animal serial NOT NULL,
	classificacao varchar(45) NOT NULL,
	CONSTRAINT tipo_animal_pk PRIMARY KEY (id_tipo_animal)

);
-- ddl-end --
ALTER TABLE public."tipo_animal" OWNER TO postgres;
-- ddl-end --

-- object: public.especie_animal | type: TABLE --
-- DROP TABLE IF EXISTS public.especie_animal CASCADE;
CREATE TABLE public."especie_animal"(
	id_especie_animal serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT especie_animal_pk PRIMARY KEY (id_especie_animal)

);
-- ddl-end --
ALTER TABLE public."especie_animal" OWNER TO postgres;
-- ddl-end --

-- object: public.talhao | type: TABLE --
-- DROP TABLE IF EXISTS public.talhao CASCADE;
CREATE TABLE public."talhao"(
	id_talhao serial NOT NULL,
	area float NOT NULL,
	descricao varchar(45),
	CONSTRAINT talhao_pk PRIMARY KEY (id_talhao)

);
-- ddl-end --
ALTER TABLE public."talhao" OWNER TO postgres;
-- ddl-end --

-- object: public.cultivo | type: TABLE --
-- DROP TABLE IF EXISTS public.cultivo CASCADE;
CREATE TABLE public."cultivo"(
	id_cultivo smallint NOT NULL,
	data_inicio date NOT NULL,
	descricao varchar(100),
	data_fim date,
	id_talhao_talhao integer,
	CONSTRAINT cultivo_pk PRIMARY KEY (id_cultivo)

);
-- ddl-end --
ALTER TABLE public."cultivo" OWNER TO postgres;
-- ddl-end --

-- object: public.unidade | type: TABLE --
-- DROP TABLE IF EXISTS public.unidade CASCADE;
CREATE TABLE public."unidade"(
	id_unidade serial NOT NULL,
	sigla varchar(10) NOT NULL,
	nome varchar(45),
	CONSTRAINT unidade_pk PRIMARY KEY (id_unidade)

);
-- ddl-end --
ALTER TABLE public."unidade" OWNER TO postgres;
-- ddl-end --

-- object: public.tipo_item | type: TABLE --
-- DROP TABLE IF EXISTS public.tipo_item CASCADE;
CREATE TABLE public."tipo_item"(
	id_tipo_item serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT tipo_item_pk PRIMARY KEY (id_tipo_item)

);
-- ddl-end --
ALTER TABLE public."tipo_item" OWNER TO postgres;
-- ddl-end --

-- object: usuario_fk | type: CONSTRAINT --
-- ALTER TABLE public.adm_agricultura DROP CONSTRAINT IF EXISTS usuario_fk CASCADE;
ALTER TABLE public."adm_agricultura" ADD CONSTRAINT usuario_fk FOREIGN KEY (id_usuario_usuario)
REFERENCES public."usuario" (id_usuario) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: usuario_fk | type: CONSTRAINT --
-- ALTER TABLE public.adm_pecuaria DROP CONSTRAINT IF EXISTS usuario_fk CASCADE;
ALTER TABLE public."adm_pecuaria" ADD CONSTRAINT usuario_fk FOREIGN KEY (id_usuario_usuario)
REFERENCES public."usuario" (id_usuario) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: usuario_fk | type: CONSTRAINT --
-- ALTER TABLE public.adm_geral DROP CONSTRAINT IF EXISTS usuario_fk CASCADE;
ALTER TABLE public."adm_geral" ADD CONSTRAINT usuario_fk FOREIGN KEY (id_usuario_usuario)
REFERENCES public."usuario" (id_usuario) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: adm_agricultura_fk | type: CONSTRAINT --
-- ALTER TABLE public.requisicao DROP CONSTRAINT IF EXISTS adm_agricultura_fk CASCADE;
ALTER TABLE public."requisicao" ADD CONSTRAINT adm_agricultura_fk FOREIGN KEY (id_adm_geral_adm_agricultura)
REFERENCES public."adm_agricultura" (id_adm_geral) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: adm_pecuaria_fk | type: CONSTRAINT --
-- ALTER TABLE public.requisicao DROP CONSTRAINT IF EXISTS adm_pecuaria_fk CASCADE;
ALTER TABLE public."requisicao" ADD CONSTRAINT adm_pecuaria_fk FOREIGN KEY (id_adm_pecuaria_adm_pecuaria)
REFERENCES public."adm_pecuaria" (id_adm_pecuaria) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: adm_geral_fk | type: CONSTRAINT --
-- ALTER TABLE public.requisicao DROP CONSTRAINT IF EXISTS adm_geral_fk CASCADE;
ALTER TABLE public."requisicao" ADD CONSTRAINT adm_geral_fk FOREIGN KEY (id_adm_agricultura_adm_geral)
REFERENCES public."adm_geral" (id_adm_agricultura) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: atividade_fk | type: CONSTRAINT --
-- ALTER TABLE public.funcionario_tem_atividade DROP CONSTRAINT IF EXISTS atividade_fk CASCADE;
ALTER TABLE public."funcionario_tem_atividade" ADD CONSTRAINT atividade_fk FOREIGN KEY (id_atividade_atividade)
REFERENCES public."atividade" (id_atividade) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: talhao_fk | type: CONSTRAINT --
-- ALTER TABLE public.cultivo DROP CONSTRAINT IF EXISTS talhao_fk CASCADE;
ALTER TABLE public."cultivo" ADD CONSTRAINT talhao_fk FOREIGN KEY (id_talhao_talhao)
REFERENCES public."talhao" (id_talhao) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: status_requisicao_fk | type: CONSTRAINT --
-- ALTER TABLE public.requisicao DROP CONSTRAINT IF EXISTS status_requisicao_fk CASCADE;
ALTER TABLE public."requisicao" ADD CONSTRAINT status_requisicao_fk FOREIGN KEY (id_requisicao_status_requisicao)
REFERENCES public."status_requisicao" (id_requisicao) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: animal_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade_tem_animal DROP CONSTRAINT IF EXISTS animal_fk CASCADE;
ALTER TABLE public."atividade_tem_animal" ADD CONSTRAINT animal_fk FOREIGN KEY (id_animal_animal)
REFERENCES public."animal" (id_animal) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: unidade_fk | type: CONSTRAINT --
-- ALTER TABLE public.item DROP CONSTRAINT IF EXISTS unidade_fk CASCADE;
ALTER TABLE public."item" ADD CONSTRAINT unidade_fk FOREIGN KEY (id_unidade_unidade)
REFERENCES public."unidade" (id_unidade) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: tipo_item_fk | type: CONSTRAINT --
-- ALTER TABLE public.item DROP CONSTRAINT IF EXISTS tipo_item_fk CASCADE;
ALTER TABLE public."item" ADD CONSTRAINT tipo_item_fk FOREIGN KEY (id_tipo_item_tipo_item)
REFERENCES public."tipo_item" (id_tipo_item) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: especie_animal_fk | type: CONSTRAINT --
-- ALTER TABLE public.animal DROP CONSTRAINT IF EXISTS especie_animal_fk CASCADE;
ALTER TABLE public."animal" ADD CONSTRAINT especie_animal_fk FOREIGN KEY (id_especie_animal_especie_animal)
REFERENCES public."especie_animal" (id_especie_animal) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: item_fk | type: CONSTRAINT --
-- ALTER TABLE public.saida DROP CONSTRAINT IF EXISTS item_fk CASCADE;
ALTER TABLE public."saida" ADD CONSTRAINT item_fk FOREIGN KEY (id_item_item)
REFERENCES public."item" (id_item) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: item_fk | type: CONSTRAINT --
-- ALTER TABLE public.entrada DROP CONSTRAINT IF EXISTS item_fk CASCADE;
ALTER TABLE public."entrada" ADD CONSTRAINT item_fk FOREIGN KEY (id_item_item)
REFERENCES public."item" (id_item) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: usuario_fk | type: CONSTRAINT --
-- ALTER TABLE public.funcionario DROP CONSTRAINT IF EXISTS usuario_fk CASCADE;
ALTER TABLE public."funcionario" ADD CONSTRAINT usuario_fk FOREIGN KEY (id_usuario_usuario)
REFERENCES public."usuario" (id_usuario) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: funcionario_fk | type: CONSTRAINT --
-- ALTER TABLE public.funcionario_tem_atividade DROP CONSTRAINT IF EXISTS funcionario_fk CASCADE;
ALTER TABLE public."funcionario_tem_atividade" ADD CONSTRAINT funcionario_fk FOREIGN KEY (id_funcionario_funcionario)
REFERENCES public."funcionario" (id_funcionario) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: adm_geral_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade DROP CONSTRAINT IF EXISTS adm_geral_fk CASCADE;
ALTER TABLE public."atividade" ADD CONSTRAINT adm_geral_fk FOREIGN KEY (id_adm_agricultura_adm_geral)
REFERENCES public."adm_geral" (id_adm_agricultura) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: tipo_atividade_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade DROP CONSTRAINT IF EXISTS tipo_atividade_fk CASCADE;
ALTER TABLE public."atividade" ADD CONSTRAINT tipo_atividade_fk FOREIGN KEY (id_tipo_atividade_tipo_atividade)
REFERENCES public."tipo_atividade" (id_tipo_atividade) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: item_fk | type: CONSTRAINT --
-- ALTER TABLE public.animal DROP CONSTRAINT IF EXISTS item_fk CASCADE;
ALTER TABLE public."animal" ADD CONSTRAINT item_fk FOREIGN KEY (id_item_item)
REFERENCES public."item" (id_item) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: tipo_animal_fk | type: CONSTRAINT --
-- ALTER TABLE public.animal DROP CONSTRAINT IF EXISTS tipo_animal_fk CASCADE;
ALTER TABLE public."animal" ADD CONSTRAINT tipo_animal_fk FOREIGN KEY (id_tipo_animal_tipo_animal)
REFERENCES public."tipo_animal" (id_tipo_animal) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: cultivo_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade DROP CONSTRAINT IF EXISTS cultivo_fk CASCADE;
ALTER TABLE public."atividade" ADD CONSTRAINT cultivo_fk FOREIGN KEY (id_cultivo_cultivo)
REFERENCES public."cultivo" (id_cultivo) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: atividade_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade_tem_animal DROP CONSTRAINT IF EXISTS atividade_fk CASCADE;
ALTER TABLE public."atividade_tem_animal" ADD CONSTRAINT atividade_fk FOREIGN KEY (id_atividade_atividade)
REFERENCES public."atividade" (id_atividade) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: requisicao_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade DROP CONSTRAINT IF EXISTS requisicao_fk CASCADE;
ALTER TABLE public."atividade" ADD CONSTRAINT requisicao_fk FOREIGN KEY (id_requisicao_requisicao)
REFERENCES public."requisicao" (id_requisicao) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: atividade_uq | type: CONSTRAINT --
-- ALTER TABLE public.atividade DROP CONSTRAINT IF EXISTS atividade_uq CASCADE;
ALTER TABLE public."atividade" ADD CONSTRAINT atividade_uq UNIQUE (id_requisicao_requisicao);
-- ddl-end --

-- object: talhao_fk | type: CONSTRAINT --
-- ALTER TABLE public.atividade DROP CONSTRAINT IF EXISTS talhao_fk CASCADE;
ALTER TABLE public."atividade" ADD CONSTRAINT talhao_fk FOREIGN KEY (id_talhao_talhao)
REFERENCES public."talhao" (id_talhao) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --

-- object: atividade_fk | type: CONSTRAINT --
-- ALTER TABLE public.entrada DROP CONSTRAINT IF EXISTS atividade_fk CASCADE;
ALTER TABLE public."entrada" ADD CONSTRAINT atividade_fk FOREIGN KEY (id_atividade_atividade)
REFERENCES public."atividade" (id_atividade) MATCH FULL
ON DELETE SET NULL ON UPDATE CASCADE;
-- ddl-end --