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

CREATE OR REPLACE FUNCTION requisicao_status() RETURNS TRIGGER AS
$body$
		BEGIN
				new.id_requisicao_status_requisicao = 1;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION atividade_data() RETURNS TRIGGER AS
$body$
		BEGIN
				new.data = CURRENT_DATE;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION cultura_data() RETURNS TRIGGER AS
$body$
		BEGIN
				new.data_inicio = CURRENT_DATe;
				new.data_fim = NULL;
				RETURN NEW;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION movimentacao_item() RETURNS TRIGGER AS
$body$
		BEGIN
				IF (SELECT id_item FROM public.item WHERE  (id_item = new.id_item_item) = TRUE) THEN
					IF (new.tipo_movimentacao = 'E') THEN
							UPDATE public.item SET quantidade = quantidade + new.quantidade WHERE id_item = new.id_item_item;
							RETURN NEW	;
					END IF;
					IF (new.tipo_movimentacao = 'S') THEN
							UPDATE public.item SET quantidade = quantidade - new.quantidade WHERE id_item = new.id_item_item;
							RETURN NEW	;
					END IF;
				ELSE
						RAISE EXCEPTION 'É necessário cadastrar o novo itens';
						RETURN NULL;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION cultura_safra() RETURNS TRIGGER AS
$body$
		DECLARE
			 mes_data integer;
		BEGIN
				new.data_inicio = CURRENT_DATE;
				SELECT EXTRACT('Month' FROM data_inicio) INTO mes_data FROM public.cultura WHERE (id_cultura = new.id_cultura);
				IF (mes_data <= 6) THEN
					 UPDATE public.cultura SET tipos_safra = 'I' WHERE (id_cultura = new.id_cultura);
					 RETURN NEW;
				ELSE
					UPDATE public.cultura SET tipos_safra = 'V' WHERE (id_cultura = new.id_cultura);
					RETURN NEW;
				END IF;
		END;
$body$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION cultura_fim() RETURNS TRIGGER AS
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

CREATE OR REPLACE FUNCTION talhao_cultura() RETURNS TRIGGER AS
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

CREATE OR REPLACE FUNCTION public.verifica_adm_talhao(id_func integer) RETURNS boolean AS
$$
	DECLARE
		geral_talhao integer;
	BEGIN
		SELECT id_funcionario_funcionario INTO geral_talhao FROM public.adm_talhao WHERE (id_funcionario_funcionario = id_func);
		IF(geral_talhao = id_func) THEN
			RETURN FALSE;
		ELSE
			RETURN TRUE;
		END IF;
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION public.verifica_adm_geral ( id_func integer) RETURNS boolean AS
$$
	DECLARE
		talhao_geral integer;
	BEGIN
		SELECT id_funcionario_funcionario INTO talhao_geral FROM public.adm_geral WHERE (id_funcionario_funcionario = id_func);
		IF(talhao_geral = id_func) THEN
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

CREATE TABLE public.adm_geral(
	id_adm_geral serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_funcionario_funcionario integer NOT NULL CHECK (verifica_adm_talhao(id_funcionario_funcionario) = true),
	CONSTRAINT adm_geral_pk PRIMARY KEY (id_adm_geral),
	CONSTRAINT adm_geral_fk FOREIGN KEY (id_funcionario_funcionario) REFERENCES public.funcionario (id_funcionario)
);

CREATE TABLE public.adm_talhao(
	id_adm_talhao serial NOT NULL,
	data_inicio date NOT NULL,
	data_fim date,
	id_funcionario_funcionario integer NOT NULL CHECK (verifica_adm_geral(id_funcionario_funcionario) = true),
	CONSTRAINT adm_talhao_pk PRIMARY KEY (id_adm_talhao),
	CONSTRAINT adm_talhao_fk FOREIGN KEY (id_funcionario_funcionario) REFERENCES public.funcionario (id_funcionario)
);

CREATE TABLE public.status_requisicoes(
	id_status_requisicoes serial NOT NULL,
	nome varchar(45) NOT NULL CHECK (valida_nome(nome) = true),
	CONSTRAINT status_requisicoes_pk PRIMARY KEY (id_status_requisicoes)
);


CREATE TABLE public.moderar_requisicao(
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

CREATE TABLE public.talhao(
	id_talhao serial NOT NULL,
	area float NOT NULL,
	descricao varchar(45),
	CONSTRAINT talhao_pk PRIMARY KEY (id_talhao)
);

CREATE TABLE public.cultura(
	id_cultura serial NOT NULL,
	data_inicio date NOT NULL DEFAULT CURRENT_DATE CHECK (data_inicio=CURRENT_DATE),
	descricao varchar(100),
	data_fim date,
	tipos_safra char(1) CHECK (tipos_safra = 'I' OR tipos_safra = 'V'),
	id_talhao_talhao integer,
	CONSTRAINT cultura_pk PRIMARY KEY (id_cultura),
 	CONSTRAINT talhao_fk FOREIGN KEY (id_talhao_talhao) REFERENCES public.talhao (id_talhao)
);

CREATE TABLE public.tipo_atividades(
	id_tipo_atividades serial NOT NULL,
	nome varchar(45) CHECK (valida_nome(nome) = true),
	CONSTRAINT tipo_atividades_pk PRIMARY KEY (id_tipo_atividades)

);

CREATE TABLE public.atividade(
	id_atividade serial NOT NULL,
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

CREATE TABLE public.tipos_item(
	id_tipos_item serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT tipos_item_pk PRIMARY KEY (id_tipos_item)
);


CREATE TABLE public.itens(
	id_itens serial NOT NULL,
	nome varchar(46) NOT NULL CHECK (valida_nome(nome) = true),
	custo_por_unidades float NOT NULL,
	quantidade float NOT NULL,
	id_unidade_unidade integer,
	id_tipos_item_tipos_item integer,
	CONSTRAINT item_pk PRIMARY KEY (id_item),
 CONSTRAINT unidade_fk FOREIGN KEY (id_unidade_unidade) REFERENCES public.unidade (id_unidade),
 CONSTRAINT tipos_item_fk FOREIGN KEY (id_tipos_item_tipos_item) REFERENCES public.tipos_item (id_tipos_item)
);

CREATE TABLE public.movimentacao(
	id_movimentacao serial NOT NULL,
	custo float NOT NULL,
	quantidade float NOT NULL,
	tipo_movimentacao char(1) NOT NULL CHECK (tipo_movimentacao = 'E' OR tipo_movimentacao = 'S'),
	id_item_item integer NOT NULL,
	id_atividade_atividade integer NOT NULL,
	descricao varchar(45),
	CONSTRAINT movimentacao_pk PRIMARY KEY (id_movimentacao),
 	CONSTRAINT item_fk FOREIGN KEY (id_item_item) REFERENCES public.item (id_item) ON DELETE	CASCADE ON UPDATE CASCADE,
	CONSTRAINT atividade_fk FOREIGN KEY (id_atividade_atividade) REFERENCES public.atividade (id_atividade)ON DELETE	CASCADE ON UPDATE CASCADE
);

INSERT INTO public.status_requisicao VALUES (DEFAULT, 'ABERTA');
INSERT INTO public.status_requisicao VALUES (DEFAULT, 'PENDENTE');
INSERT INTO public.status_requisicao VALUES (DEFAULT, 'FECHADA');


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


CREATE TRIGGER movimentacao_item
		AFTER INSERT ON public.movimentacao
		FOR EACH ROW
		EXECUTE PROCEDURE  movimentacao_item();


CREATE TRIGGER culturas_safra
		AFTER INSERT ON public.culturas
		FOR EACH ROW
		EXECUTE PROCEDURE culturas_safra();

CREATE TRIGGER culturas_fim
		BEFORE UPDATE ON public.culturas
		FOR EACH ROW
		EXECUTE PROCEDURE culturas_fim();


CREATE TRIGGER talhao_cultura
		BEFORE DELETE ON public.talhao
		FOR EACH ROW
		EXECUTE PROCEDURE talhao_cultura();


INSERT INTO public.funcionarios VALUES (DEFAULT, '10456436960', 'EDUARDO','eduardoguilhermecordeiro@hotmail.com', TRUE, 'eduardo987', 'eduardo334958');
SELECT * FROM public.funcionarios;
