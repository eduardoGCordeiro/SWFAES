DROP TABLE IF EXISTS public.usuarios CASCADE;
DROP TABLE IF EXISTS public.funcionarios CASCADE;
DROP TABLE IF EXISTS public.adms_geral CASCADE;
DROP TABLE IF EXISTS public.adms_talhoes CASCADE;
DROP TABLE IF EXISTS public.status_requisicoes CASCADE;
DROP TABLE IF EXISTS public.requisicoes CASCADE;
DROP TABLE IF EXISTS public.talhoes CASCADE;
DROP TABLE IF EXISTS public.culturas CASCADE;
DROP TABLE IF EXISTS public.tipos_atividades CASCADE;
DROP TABLE IF EXISTS public.atividades CASCADE;
DROP TABLE IF EXISTS public.funcionarios_tem_atividades CASCADE;
DROP TABLE IF EXISTS public.unidades CASCADE;
DROP TABLE IF EXISTS public.tipos_itens CASCADE;
DROP TABLE IF EXISTS public.itens CASCADE;
DROP TABLE IF EXISTS public.saidas CASCADE;
DROP TABLE IF EXISTS public.entradas CASCADE;
DROP TABLE IF EXISTS public.password_resets CASCADE;



CREATE TABLE public.password_resets(
	email varchar(45) NOT NULL,
	token varchar(100),
	created_at timestamp
);

CREATE TABLE public.usuarios(
	id_usuarios serial NOT NULL,
	cpf varchar(11) NOT NULL,
	nome varchar(45) NOT NULL,
	email varchar(45) NOT NULL,
	login varchar(13) NOT NULL,
	password varchar(60) NOT NULL,
	remember_token varchar(100),
	CONSTRAINT usuarios_pk PRIMARY KEY (id_usuarios)
);

CREATE TABLE public.funcionarios(
	id_funcionarios serial NOT NULL,
	cpf varchar(11),
	nome varchar(45) NOT NULL,
	CONSTRAINT funcionarios_pk PRIMARY KEY (id_funcionarios)
	);

CREATE TABLE public.adms_geral(
	id_adms_geral serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_usuarios_usuarios integer NOT NULL,
	CONSTRAINT adms_geral_pk PRIMARY KEY (id_adms_geral),
	CONSTRAINT adms_geral_fk FOREIGN KEY (id_usuarios_usuarios) REFERENCES public.usuarios (id_usuarios)
);

CREATE TABLE public.adms_talhoes(
	id_adms_talhoes serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_usuarios_usuarios integer NOT NULL,
	CONSTRAINT adms_talhoes_pk PRIMARY KEY (id_adms_talhoes),
	CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_usuarios_usuarios) REFERENCES public.usuarios (id_usuarios)
);

CREATE TABLE public.status_requisicoes(
	id_requisicoes serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT status_requisicoes_pk PRIMARY KEY (id_requisicoes)
);

CREATE TABLE public.requisicoes(
	id_requisicoes serial NOT NULL,
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	descricao varchar(100),
	descricao_adms_geral varchar(100),
	id_adms_talhoes_adms_talhoes integer NOT NULL,
	id_adms_geral_adms_geral integer,
	id_requisicoes_status_requisicoes integer NOT NULL,
	CONSTRAINT requisicoes_pk PRIMARY KEY (id_requisicoes),
 	CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_adms_talhoes_adms_talhoes) REFERENCES public.adms_talhoes (id_adms_talhoes),
 	CONSTRAINT adms_geral_fk FOREIGN KEY (id_adms_geral_adms_geral) REFERENCES public.adms_geral (id_adms_geral),
 	CONSTRAINT status_requisicoes_fk FOREIGN KEY (id_requisicoes_status_requisicoes) REFERENCES public.status_requisicoes (id_requisicoes)
);

CREATE TABLE public.talhoes(
	id_talhoes serial NOT NULL,
	area float NOT NULL,
	descricao varchar(45),
	CONSTRAINT talhoes_pk PRIMARY KEY (id_talhoes)
);

CREATE TABLE public.culturas(
	id_culturas serial NOT NULL,
	data_inicio date NOT NULL DEFAULT CURRENT_DATE CHECK (data_inicio=CURRENT_DATE),
	descricao varchar(100),
	data_fim date,
	tipos_safra boolean,
	id_talhoes_talhoes integer NOT NULL,
	CONSTRAINT culturas_pk PRIMARY KEY (id_culturas),
 	CONSTRAINT talhoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes (id_talhoes)
);

CREATE TABLE public.tipos_atividades(
	id_tipos_atividades serial NOT NULL,
	nome varchar(45),
	CONSTRAINT tipos_atividades_pk PRIMARY KEY (id_tipos_atividades)
);

CREATE TABLE public.atividades(
	id_atividades serial NOT NULL,
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	data_registro date NOT NULL,
	descricao varchar(100),
	id_adms_geral_adms_geral integer NOT NULL,
	id_tipos_atividades_tipos_atividades integer NOT NULL,
	id_culturas_culturas smallint,
	id_requisicoes_requisicoes integer,
	id_talhoes_talhoes integer,
	CONSTRAINT atividades_pk PRIMARY KEY (id_atividades),
 	CONSTRAINT adms_geral_fk FOREIGN KEY (id_adms_geral_adms_geral) REFERENCES public.adms_geral (id_adms_geral),
 	CONSTRAINT tipos_atividades_fk FOREIGN KEY (id_tipos_atividades_tipos_atividades) REFERENCES public.tipos_atividades (id_tipos_atividades),
 	CONSTRAINT culturas_fk FOREIGN KEY (id_culturas_culturas) REFERENCES public.culturas (id_culturas),
 	CONSTRAINT requisicoes_fk FOREIGN KEY (id_requisicoes_requisicoes) REFERENCES public.requisicoes (id_requisicoes),
 	CONSTRAINT talhoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes (id_talhoes)
);

CREATE TABLE public.funcionarios_tem_atividades(
	id_atividades_atividades integer NOT NULL,
	id_funcionarios_funcionarios integer NOT NULL,
 	CONSTRAINT atividades_fk FOREIGN KEY (id_atividades_atividades) REFERENCES public.atividades (id_atividades),
 	CONSTRAINT funcionarios_fk FOREIGN KEY (id_funcionarios_funcionarios) REFERENCES public.funcionarios (id_funcionarios)
);

CREATE TABLE public.unidades(
	id_unidades serial NOT NULL,
	sigla varchar(10) NOT NULL,
	nome varchar(45),
	CONSTRAINT unidades_pk PRIMARY KEY (id_unidades)
);

CREATE TABLE public.tipos_itens(
	id_tipos_itens serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT tipos_itens_pk PRIMARY KEY (id_tipos_itens)
);

CREATE TABLE public.itens(
	id_itens serial NOT NULL,
	nome varchar(46) NOT NULL,
	custo_por_unidades float NOT NULL,
	quantidade float NOT NULL,
	id_unidades_unidades integer NOT NULL,
	id_tipos_itens_tipos_itens integer NOT NULL,
	CONSTRAINT itens_pk PRIMARY KEY (id_itens),
 CONSTRAINT unidades_fk FOREIGN KEY (id_unidades_unidades) REFERENCES public.unidades (id_unidades),
 CONSTRAINT tipos_itens_fk FOREIGN KEY (id_tipos_itens_tipos_itens) REFERENCES public.tipos_itens (id_tipos_itens)
);

CREATE TABLE public.saidas(
	id_saidas serial NOT NULL,
	custo float NOT NULL,
	quantidade float NOT NULL,
	descricao varchar(45),
	id_itens_itens integer NOT NULL,
	id_atividades_atividades integer NOT NULL,
	CONSTRAINT saidas_pk PRIMARY KEY (id_saidas),
 CONSTRAINT itens_fk FOREIGN KEY (id_itens_itens) REFERENCES public.itens (id_itens) ON DELETE	CASCADE ON UPDATE CASCADE,
CONSTRAINT atividades_fk FOREIGN KEY (id_atividades_atividades) REFERENCES public.atividades (id_atividades)ON DELETE	CASCADE ON UPDATE CASCADE
);

CREATE TABLE public.entradas(
	id_entradas serial NOT NULL,
	custo float NOT NULL,
    quantidade float NOT NULL,
	descricao varchar(45) NOT NULL,
	id_itens_itens integer NOT NULL,
	id_atividades_atividades integer NOT NULL,
	CONSTRAINT entradas_pk PRIMARY KEY (id_entradas),
 CONSTRAINT itens_fk FOREIGN KEY (id_itens_itens) REFERENCES public.itens (id_itens) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT atividades_fk FOREIGN KEY (id_atividades_atividades) REFERENCES public.atividades (id_atividades) ON DELETE	CASCADE ON UPDATE CASCADE
);

INSERT INTO public.status_requisicoes VALUES (DEFAULT, 'ABERTA');
INSERT INTO public.status_requisicoes VALUES (DEFAULT, 'PENDENTE');
INSERT INTO public.status_requisicoes VALUES (DEFAULT, 'FECHADA');

CREATE OR REPLACE FUNCTION requisicoes_data() RETURNS TRIGGER AS
$body$
		BEGIN
				new.data = CURRENT_DATE;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION requisicoes_status() RETURNS TRIGGER AS
$body$
		BEGIN
				new.id_requisicoes_status_requisicoes = 1;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION atividades_data() RETURNS TRIGGER AS
$body$
		BEGIN
				new.data = CURRENT_DATE;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION culturas_data() RETURNS TRIGGER AS
$body$
		BEGIN
				new.data_inicio = CURRENT_DATE;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION saidas_itens() RETURNS TRIGGER AS
$body$
		BEGIN
				IF (SELECT id_itens FROM public.itens WHERE  (id_itens = new.id_itens_itens) = TRUE) THEN
						UPDATE public.itens SET quantidade = quantidade - new.quantidade WHERE (id_itens = new.id_itens_itens);
						RETURN NEW	;
				ELSE 
						RAISE EXCEPTION 'Não é possível dar saída de um itens que não está cadastrado';
						RETURN NULL;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION entradas_itens() RETURNS TRIGGER AS
$body$
		BEGIN
				IF (SELECT id_itens FROM public.itens WHERE  (id_itens = new.id_itens_itens) = TRUE) THEN
						UPDATE public.itens SET quantidade = quantidade + new.quantidade WHERE id_itens = new.id_itens_itens;
						RETURN NEW	;
				ELSE 
						RAISE EXCEPTION 'É necessário cadastrar o novo itens';
						RETURN NULL;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION culturas_safra() RETURNS TRIGGER AS
$body$
		DECLARE 
			 mes_data integer;
		BEGIN
				new.data_inicio = CURRENT_DATE;
				SELECT EXTRACT('Month' FROM data_inicio) INTO mes_data FROM public.culturas WHERE (id_culturas = new.id_culturas);
				IF (mes_data <= 6) THEN
					 UPDATE public.culturas SET tipos_safra = FALSE WHERE (id_culturas = new.id_culturas);
					 RETURN NEW;
				ELSE
					UPDATE public.culturas SET tipos_safra = TRUE WHERE (id_culturas = new.id_culturas);
					RETURN NEW;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION culturas_fim() RETURNS TRIGGER AS
$body$
		DECLARE 
			res_fim_inicio integer;
		BEGIN	
					res_fim_inicio = new.data_fim - old.data_inicio;
					IF (res_fim_inicio <= 0) THEN
						new.data_fim = CURRENT_DATE;
					 	RETURN NEW;
					ELSE
						RETURN NEW;
					END IF;
				RETURN NULL;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION talhoes_culturas() RETURNS TRIGGER AS
$body$
		BEGIN
				IF (SELECT data_fim FROM public.culturas WHERE  (id_tahao_talhoes = old.id_talhoes) = TRUE) THEN
						DELETE FROM public.talhoes WHERE (id_talhoes = old.id_talhoes);
				ELSE 
						RAISE EXCEPTION 'Não é possível dar saída de um itens que não está cadastrado';
						RETURN NULL;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE TRIGGER requisicoes_data
		BEFORE INSERT ON public.requisicoes
		FOR EACH ROW 
		EXECUTE PROCEDURE requisicoes_data();

CREATE TRIGGER requisicoes_status
		BEFORE INSERT ON public.requisicoes
		FOR EACH ROW 
		EXECUTE PROCEDURE requisicoes_status();

CREATE TRIGGER atividades_data
		BEFORE INSERT ON public.atividades
		FOR EACH ROW 
		EXECUTE PROCEDURE atividades_data();

CREATE TRIGGER culturas_data
		BEFORE INSERT ON public.culturas
		FOR EACH ROW 
		EXECUTE PROCEDURE culturas_data();

CREATE TRIGGER saidas_itens
		AFTER INSERT ON public.saidas
		FOR EACH ROW
		EXECUTE PROCEDURE  saidas_itens();

CREATE TRIGGER entradas_itens
		AFTER INSERT ON public.entradas
		FOR EACH ROW 
		EXECUTE PROCEDURE  entradas_itens();

CREATE TRIGGER culturas_safra
		AFTER INSERT ON public.culturas
		FOR EACH ROW 
		EXECUTE PROCEDURE culturas_safra();

CREATE TRIGGER culturas_fim
		BEFORE UPDATE ON public.culturas
		FOR EACH ROW 
		EXECUTE PROCEDURE culturas_fim();

CREATE TRIGGER talhoes_culturas
		BEFORE DELETE ON public.talhoes
		FOR EACH ROW
		EXECUTE PROCEDURE talhoes_culturas();

