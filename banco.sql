DROP TABLE IF EXISTS public.password_resets CASCADE;
DROP TABLE IF EXISTS public.funcionario CASCADE;
DROP TABLE IF EXISTS public.adm_geral CASCADE;
DROP TABLE IF EXISTS public.adm_talhao CASCADE;
DROP TABLE IF EXISTS public.status_requisicao CASCADE;
DROP TABLE IF EXISTS public.requisicao CASCADE;
DROP TABLE IF EXISTS public.talhao CASCADE;
DROP TABLE IF EXISTS public.cultura CASCADE;
DROP TABLE IF EXISTS public.tipo_atividade CASCADE;
DROP TABLE IF EXISTS public.atividade CASCADE;
DROP TABLE IF EXISTS public.funcionario_tem_atividade CASCADE;
DROP TABLE IF EXISTS public.unidade CASCADE;
DROP TABLE IF EXISTS public.tipos_item CASCADE;
DROP TABLE IF EXISTS public.item CASCADE;
DROP TABLE IF EXISTS public.movimentacao CASCADE;
DROP TABLE IF EXISTS public.moderar_requisicao CASCADE;


CREATE OR REPLACE FUNCTION requisicao_data() RETURNS TRIGGER AS
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
						RAISE EXCEPTION 'É necessário cadastrar o novo item';
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
				IF (SELECT data_fim FROM public.cultura WHERE  (id_tahao_talhao = old.id_talhao) = TRUE) THEN
						DELETE FROM public.talhao WHERE (id_talhao = old.id_talhao);
				ELSE 
						RAISE EXCEPTION 'Não é possível deletar talhões que ainda possuem uma cultura.';
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

CREATE OR REPLACE FUNCTION public.valida_senha (password varchar) RETURNS boolean AS 
$$
	BEGIN	
		IF (length(password) > 8) THEN
			IF password ~ '[A-Za-z0-9]' THEN
				RETURN TRUE;
			ELSE
				RETURN FAlSE;
			END IF;
		ELSE
			RETURN FALSE;
		END IF;
	END;
$$ 
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION public.valida_login (login varchar) RETURNS boolean AS 
$$
	BEGIN	
			IF login !~ '[A-Za-z0-9]' THEN
				RETURN FALSE;
			ELSE
				RETURN TRUE;
			END IF;
	END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION public.valida_nome ( nome varchar) RETURNS boolean AS 
$$
	BEGIN	
			IF nome !~ '[a-z]' THEN
				RETURN TRUE;
			ELSE
				RETURN FALSE;
			END IF;
	END;
$$
LANGUAGE plpgsql;

CREATE TABLE public.password_resets(
	email varchar(45) NOT NULL,
	token varchar(100),
	created_at timestamp
);

CREATE TABLE public.funcionario(
	id_funcionario serial NOT NULL,
	cpf bigint NOT NULL UNIQUE CHECK(valida_cpf(cpf) = true),
	nome varchar(45) NOT NULL CHECK (valida_nome(nome) = true),
	email varchar(45) NOT NULL CHECK (valida_email(email) = true),
	acesso_sistema boolean NOT NULL DEFAULT FALSE,
	login varchar(13) NOT NULL UNIQUE CHECK (valida_login(login) = true),
	password varchar(60) NOT NULL CHECK (valida_senha(password) = true),
	CONSTRAINT funcionario_pk PRIMARY KEY (id_funcionario)
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

CREATE TABLE public.status_requisicao(
	id_status_requisicao serial NOT NULL,
	nome varchar(45) NOT NULL CHECK (valida_nome(nome) = true),
	CONSTRAINT status_requisicao_pk PRIMARY KEY (id_status_requisicao)
);

CREATE TABLE public.requisicao(
	id_requisicao serial NOT NULL,
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	descricao varchar(100),
	descricao_adm_geral varchar(100),
	id_adm_talhao_adm_talhao integer NOT NULL,
	id_adm_geral_adm_geral integer,
	id_requisicao_status_requisicao integer NOT NULL,
	CONSTRAINT requisicao_pk PRIMARY KEY (id_requisicao),
 	CONSTRAINT adm_talhao_fk FOREIGN KEY (id_adm_talhao_adm_talhao) REFERENCES public.adm_talhao (id_adm_talhao)
);

CREATE TABLE public.moderar_requisicao(
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	descricao varchar(100),
	id_requisicao_requisicao integer,
	id_adm_geral_adm_geral integer,
	id_requisicao_status_requisicao integer NOT NULL,
	CONSTRAINT moderar_requisicao_pk PRIMARY KEY (id_requisicao_requisicao, id_adm_geral_adm_geral, id_requisicao_status_requisicao),
 	CONSTRAINT adm_geral_fk FOREIGN KEY (id_adm_geral_adm_geral) REFERENCES public.adm_geral (id_adm_geral),
 	CONSTRAINT status_requisicao_fk FOREIGN KEY (id_requisicao_status_requisicao) REFERENCES public.status_requisicao (id_status_requisicao),
    CONSTRAINT requisicao_fk FOREIGN KEY (id_requisicao_requisicao) REFERENCES public.requisicao (id_requisicao)
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

CREATE TABLE public.tipo_atividade(
	id_tipo_atividade serial NOT NULL,
	nome varchar(45) CHECK (valida_nome(nome) = true),
	CONSTRAINT tipo_atividade_pk PRIMARY KEY (id_tipo_atividade)
);

CREATE TABLE public.atividade(
	id_atividade serial NOT NULL,
	data date NOT NULL DEFAULT CURRENT_DATE CHECK (data=CURRENT_DATE),
	data_registro date NOT NULL,
	descricao varchar(100),
	id_adm_geral_adm_geral integer NOT NULL,
	id_tipo_atividade_tipo_atividade integer NOT NULL,
	id_cultura_cultura smallint,
	id_requisicao_requisicao integer,
	id_talhao_talhao integer,
	CONSTRAINT atividade_pk PRIMARY KEY (id_atividade),
 	CONSTRAINT adm_geral_fk FOREIGN KEY (id_adm_geral_adm_geral) REFERENCES public.adm_geral (id_adm_geral),
 	CONSTRAINT tipo_atividade_fk FOREIGN KEY (id_tipo_atividade_tipo_atividade) REFERENCES public.tipo_atividade (id_tipo_atividade),
 	CONSTRAINT cultura_fk FOREIGN KEY (id_cultura_cultura) REFERENCES public.cultura (id_cultura),
 	CONSTRAINT requisicao_fk FOREIGN KEY (id_requisicao_requisicao) REFERENCES public.requisicao (id_requisicao),
 	CONSTRAINT talhao_fk FOREIGN KEY (id_talhao_talhao) REFERENCES public.talhao (id_talhao)
);

CREATE TABLE public.funcionario_tem_atividade(
	id_atividade_atividade integer NOT NULL,
	id_funcionario_funcionario integer NOT NULL,
 	CONSTRAINT funcionario_tem_atividade_pk PRIMARY KEY (id_atividade_atividade, id_funcionario_funcionario)
);

CREATE TABLE public.unidade(
	id_unidade serial NOT NULL,
	sigla varchar(10) NOT NULL CHECK (valida_nome(sigla) = true),
	nome varchar(45) CHECK (valida_nome(nome) = true),
	CONSTRAINT unidade_pk PRIMARY KEY (id_unidade)
);

CREATE TABLE public.tipos_item(
	id_tipos_item serial NOT NULL,
	nome varchar(45) NOT NULL,
	CONSTRAINT tipos_item_pk PRIMARY KEY (id_tipos_item)
);

CREATE TABLE public.item(
	id_item serial NOT NULL,
	nome varchar(46) NOT NULL CHECK (valida_nome(nome) = true),
	custo_por_unidade float NOT NULL,
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

CREATE TRIGGER requisicao_data
		BEFORE INSERT ON public.requisicao
		FOR EACH ROW 
		EXECUTE PROCEDURE requisicao_data();

CREATE TRIGGER requisicao_status
		BEFORE INSERT ON public.requisicao
		FOR EACH ROW 
		EXECUTE PROCEDURE requisicao_status();

CREATE TRIGGER atividade_data
		BEFORE INSERT ON public.atividade
		FOR EACH ROW 
		EXECUTE PROCEDURE atividade_data();

CREATE TRIGGER cultura_data
		BEFORE INSERT ON public.cultura
		FOR EACH ROW 
		EXECUTE PROCEDURE cultura_data();

CREATE TRIGGER movimentacao_item
		AFTER INSERT ON public.movimentacao
		FOR EACH ROW
		EXECUTE PROCEDURE  movimentacao_item();

CREATE TRIGGER cultura_safra
		AFTER INSERT ON public.cultura
		FOR EACH ROW 
		EXECUTE PROCEDURE cultura_safra();

CREATE TRIGGER cultura_fim
		BEFORE UPDATE ON public.cultura
		FOR EACH ROW 
		EXECUTE PROCEDURE cultura_fim();

CREATE TRIGGER talhao_cultura
		BEFORE DELETE ON public.talhao
		FOR EACH ROW
		EXECUTE PROCEDURE talhao_cultura();

INSERT INTO public.funcionario VALUES (DEFAULT, '10456436960', 'EDUARDO','eduardoguilhermecordeiro@hotmail.com', TRUE, 'eduardo987', 'eduardo334958');
SELECT * FROM public.funcionario;