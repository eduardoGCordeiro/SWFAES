DROP TABLE IF EXISTS public.password_resets CASCADE;
DROP TABLE IF EXISTS public.funcionarios CASCADE;
DROP TABLE IF EXISTS public.adms_geral CASCADE;
DROP TABLE IF EXISTS public.adms_talhoes CASCADE;
DROP TABLE IF EXISTS public.status_requisicoes CASCADE;
DROP TABLE IF EXISTS public.requisicoes CASCADE;
DROP TABLE IF EXISTS public.talhoes CASCADE;
DROP TABLE IF EXISTS public.culturas CASCADE;
DROP TABLE IF EXISTS public.tipo_atividades CASCADE;
DROP TABLE IF EXISTS public.atividades CASCADE;
DROP TABLE IF EXISTS public.funcionarios_tem_atividades CASCADE;
DROP TABLE IF EXISTS public.unidades CASCADE;
DROP TABLE IF EXISTS public.tipos_itens CASCADE;
DROP TABLE IF EXISTS public.itens CASCADE;
DROP TABLE IF EXISTS public.movimentacoes CASCADE;
DROP TABLE IF EXISTS public.moderar_requisicoes CASCADE;


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
				new.data_inicio = CURRENT_DATe;
				new.data_fim = NULL;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION movimentacoes_itens() RETURNS TRIGGER AS
$body$
		BEGIN
				IF (SELECT id_itens FROM public.itens WHERE  (id_itens = new.id_itens_itens) = TRUE) THEN
					IF (new.tipo_movimentacoes = 'E') THEN
							UPDATE public.itens SET quantidade = quantidade + new.quantidade WHERE id_itens = new.id_itens_itens;
							RETURN NEW	;
					END IF;
					IF (new.tipo_movimentacoes = 'S') THEN
							UPDATE public.itens SET quantidade = quantidade - new.quantidade WHERE id_itens = new.id_itens_itens;
							RETURN NEW	;
					END IF;
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
					 UPDATE public.culturas SET tipos_safra = 'I' WHERE (id_culturas = new.id_culturas);
					 RETURN NEW;
				ELSE
					UPDATE public.culturas SET tipos_safra = 'V' WHERE (id_culturas = new.id_culturas);
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
						RAISE EXCEPTION 'Não é possível deletar talhões que ainda possuem uma culturas.';
						RETURN NULL;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION public.verifica_adms_talhoes(id_func integer) RETURNS boolean AS
$$
	DECLARE
		geral_talhoes integer;
	BEGIN
		SELECT id_funcionarios_funcionarios INTO geral_talhoes FROM public.adms_talhoes WHERE (id_funcionarios_funcionarios = id_func);
		IF(geral_talhoes = id_func) THEN
			RETURN FALSE;
		ELSE
			RETURN TRUE;
		END IF;
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION public.verifica_adms_geral ( id_func integer) RETURNS boolean AS
$$
	DECLARE
		talhoes_geral integer;
	BEGIN
		SELECT id_funcionarios_funcionarios INTO talhoes_geral FROM public.adms_geral WHERE (id_funcionarios_funcionarios = id_func);
		IF(talhoes_geral = id_func) THEN
			RETURN FALSE;
		ELSE
			RETURN TRUE;
		END IF;

	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION valida_cpf(cod_cpf bigint) RETURNS boolean AS
$$
  DECLARE
		len_cod integer;
		str_cod text;
		dv      char(2);
		dv1     char(1);
		dv2     char(1);
		dvr     char(2);
		lmod	    integer;
		res     numeric;
	BEGIN
		str_cod = lpad(cod_cpf::text,11,'0');
		len_cod = octet_length(str_cod);
		dv      = substring(str_cod,'..$');
		dv1     = substring(dv,1,1);
		dv2     = substring(dv,2,1);
		dvr     = '';
		IF len_cod != 11 OR str_cod ~ '^([1-9]{11})$' THEN
			RETURN FALSE;
		END IF;
		FOR lmod IN 10..11 LOOP
			SELECT INTO res mod(sum(digit * agg),11) FROM (
				SELECT agg, substring(str_cod,row_number::int,1)::numeric digit FROM (
					SELECT *,row_number() OVER() FROM (
						SELECT agg::numeric agg FROM generate_series(2,lmod) agg ORDER BY 1 DESC
					) A
				) B
			) C;
			IF res < 2 THEN
				res = 0;
			ELSE
				res = 11 - res;
			END IF;
			dvr := dvr||res;
		END LOOP;
		RETURN dvr::integer = dv::integer;
	END;
$$ LANGUAGE 'plpgsql' STRICT IMMUTABLE;

CREATE OR REPLACE FUNCTION public.valida_email (email varchar) RETURNS boolean AS
$$
	BEGIN
		IF email !~ '^[a-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-z]+$' THEN
			RETURN FALSE;
		ELSE
			RETURN TRUE;
		END IF;
	END;
$$
LANGUAGE plpgsql;

-- CREATE OR REPLACE FUNCTION public.valida_senha (password varchar) RETURNS boolean AS
-- $$
-- 	BEGIN
-- 		IF (length(password) > 8) THEN
-- 			IF password ~ '[A-Za-z0-9]' THEN
-- 				RETURN TRUE;
-- 			ELSE
-- 				RETURN FAlSE;
-- 			END IF;
-- 		ELSE
-- 			RETURN FALSE;
-- 		END IF;
-- 	END;
-- $$
-- LANGUAGE plpgsql;

-- CREATE OR REPLACE FUNCTION public.valida_login (login varchar) RETURNS boolean AS
-- $$
-- 	BEGIN
-- 			IF login !~ '[A-Za-z0-9]' THEN
-- 				RETURN FALSE;
-- 			ELSE
-- 				RETURN TRUE;
-- 			END IF;
-- 	END;
-- $$
-- LANGUAGE plpgsql;

-- CREATE OR REPLACE FUNCTION public.valida_nome ( nome varchar) RETURNS boolean AS
-- $$
-- 	BEGIN
-- 			IF nome !~ '[a-z]' THEN
-- 				RETURN TRUE;
-- 			ELSE
-- 				RETURN FALSE;
-- 			END IF;
-- 	END;
-- $$
-- LANGUAGE plpgsql;

CREATE TABLE public.password_resets(
	email varchar(45) NOT NULL,
	token varchar(100),
	created_at timestamp
);

CREATE TABLE public.funcionarios(
	id_funcionarios serial NOT NULL,
	cpf bigint NOT NULL UNIQUE CHECK(valida_cpf(cpf) = true),
	nome varchar(45) NOT NULL CHECK (valida_nome(nome) = true),
	email varchar(45) NOT NULL CHECK (valida_email(email) = true),
	acesso_sistema boolean NOT NULL DEFAULT FALSE,
	login varchar(13) NOT NULL UNIQUE CHECK (valida_login(login) = true),
	password varchar(60) NOT NULL CHECK (valida_senha(password) = true),
	CONSTRAINT funcionarios_pk PRIMARY KEY (id_funcionarios)
);

CREATE TABLE public.adms_geral(
	id_adms_geral serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_funcionarios_funcionarios integer NOT NULL CHECK (verifica_adms_talhoes(id_funcionarios_funcionarios) = true),
	CONSTRAINT adms_geral_pk PRIMARY KEY (id_adms_geral),
	CONSTRAINT adms_geral_fk FOREIGN KEY (id_funcionarios_funcionarios) REFERENCES public.funcionarios (id_funcionarios)
);

CREATE TABLE public.adms_talhoes(
	id_adms_talhoes serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_funcionarios_funcionarios integer NOT NULL CHECK (verifica_adms_geral(id_funcionarios_funcionarios) = true),
	CONSTRAINT adms_talhoes_pk PRIMARY KEY (id_adms_talhoes),
	CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_funcionarios_funcionarios) REFERENCES public.funcionarios (id_funcionarios)
);

CREATE TABLE public.status_requisicoes(
	id_status_requisicoes serial NOT NULL,
	nome varchar(45) NOT NULL CHECK (valida_nome(nome) = true),
	CONSTRAINT status_requisicoes_pk PRIMARY KEY (id_status_requisicoes)
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
 	CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_adms_talhoes_adms_talhoes) REFERENCES public.adms_talhoes (id_adms_talhoes)
);

CREATE TABLE public.moderar_requisicoes(
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	descricao varchar(100),
	id_requisicoes_requisicoes integer,
	id_adms_geral_adms_geral integer,
	id_requisicoes_status_requisicoes integer NOT NULL,
	CONSTRAINT moderar_requisicoes_pk PRIMARY KEY (id_requisicoes_requisicoes, id_adms_geral_adms_geral, id_requisicoes_status_requisicoes),
 	CONSTRAINT adms_geral_fk FOREIGN KEY (id_adms_geral_adms_geral) REFERENCES public.adms_geral (id_adms_geral),
 	CONSTRAINT status_requisicoes_fk FOREIGN KEY (id_requisicoes_status_requisicoes) REFERENCES public.status_requisicoes (id_status_requisicoes),
    CONSTRAINT requisicoes_fk FOREIGN KEY (id_requisicoes_requisicoes) REFERENCES public.requisicoes (id_requisicoes)
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
	tipos_safra char(1) CHECK (tipos_safra = 'I' OR tipos_safra = 'V'),
	id_talhoes_talhoes integer,
	CONSTRAINT culturas_pk PRIMARY KEY (id_culturas),
 	CONSTRAINT talhoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes (id_talhoes)
);

CREATE TABLE public.tipo_atividades(
	id_tipo_atividades serial NOT NULL,
	nome varchar(45) CHECK (valida_nome(nome) = true),
	CONSTRAINT tipo_atividades_pk PRIMARY KEY (id_tipo_atividades)
);

CREATE TABLE public.atividades(
	id_atividades serial NOT NULL,
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	data_registro date NOT NULL,
	descricao varchar(100),
	id_adms_geral_adms_geral integer NOT NULL,
	id_tipo_atividades_tipo_atividades integer NOT NULL,
	id_culturas_culturas smallint,
	id_requisicoes_requisicoes integer,
	id_talhoes_talhoes integer,
	CONSTRAINT atividades_pk PRIMARY KEY (id_atividades),
 	CONSTRAINT adms_geral_fk FOREIGN KEY (id_adms_geral_adms_geral) REFERENCES public.adms_geral (id_adms_geral),
 	CONSTRAINT tipo_atividades_fk FOREIGN KEY (id_tipo_atividades_tipo_atividades) REFERENCES public.tipo_atividades (id_tipo_atividades),
 	CONSTRAINT culturas_fk FOREIGN KEY (id_culturas_culturas) REFERENCES public.culturas (id_culturas),
 	CONSTRAINT requisicoes_fk FOREIGN KEY (id_requisicoes_requisicoes) REFERENCES public.requisicoes (id_requisicoes),
 	CONSTRAINT talhoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes (id_talhoes)
);

CREATE TABLE public.funcionarios_tem_atividades(
	id_atividades_atividades integer NOT NULL,
	id_funcionarios_funcionarios integer NOT NULL,
 	CONSTRAINT funcionarios_tem_atividades_pk PRIMARY KEY (id_atividades_atividades, id_funcionarios_funcionarios)
);

CREATE TABLE public.unidades(
	id_unidades serial NOT NULL,
	sigla varchar(10) NOT NULL CHECK (valida_nome(sigla) = true),
	nome varchar(45) CHECK (valida_nome(nome) = true),
	CONSTRAINT unidades_pk PRIMARY KEY (id_unidades)
);

CREATE TABLE public.tipos_itens(
	id_tipos_itens serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT tipos_itens_pk PRIMARY KEY (id_tipos_itens)
);

CREATE TABLE public.itens(
	id_itens serial NOT NULL,
	nome varchar(46) NOT NULL CHECK (valida_nome(nome) = true),
	custo_por_unidades float NOT NULL,
	quantidade float NOT NULL,
	id_unidades_unidades integer,
	id_tipos_itens_tipos_itens integer,
	CONSTRAINT itens_pk PRIMARY KEY (id_itens),
 CONSTRAINT unidades_fk FOREIGN KEY (id_unidades_unidades) REFERENCES public.unidades (id_unidades),
 CONSTRAINT tipos_itens_fk FOREIGN KEY (id_tipos_itens_tipos_itens) REFERENCES public.tipos_itens (id_tipos_itens)
);

CREATE TABLE public.movimentacoes(
	id_movimentacoes serial NOT NULL,
	custo float NOT NULL,
	quantidade float NOT NULL,
	tipo_movimentacoes char(1) NOT NULL CHECK (tipo_movimentacoes = 'E' OR tipo_movimentacoes = 'S'),
	id_itens_itens integer NOT NULL,
	id_atividades_atividades integer NOT NULL,
	descricao varchar(45),
	CONSTRAINT movimentacoes_pk PRIMARY KEY (id_movimentacoes),
 	CONSTRAINT itens_fk FOREIGN KEY (id_itens_itens) REFERENCES public.itens (id_itens) ON DELETE	CASCADE ON UPDATE CASCADE,
	CONSTRAINT atividades_fk FOREIGN KEY (id_atividades_atividades) REFERENCES public.atividades (id_atividades)ON DELETE	CASCADE ON UPDATE CASCADE
);

INSERT INTO public.status_requisicoes VALUES (DEFAULT, 'ABERTA');
INSERT INTO public.status_requisicoes VALUES (DEFAULT, 'PENDENTE');
INSERT INTO public.status_requisicoes VALUES (DEFAULT, 'FECHADA');

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

CREATE TRIGGER movimentacoes_itens
		AFTER INSERT ON public.movimentacoes
		FOR EACH ROW
		EXECUTE PROCEDURE  movimentacoes_itens();

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

INSERT INTO public.funcionarios VALUES (DEFAULT, '10456436960', 'EDUARDO','eduardoguilhermecordeiro@hotmail.com', TRUE, 'eduardo987', 'eduardo334958');
SELECT * FROM public.funcionarios;