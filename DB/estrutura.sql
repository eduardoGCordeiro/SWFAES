--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.14
-- Dumped by pg_dump version 9.5.14

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: adms_geral_data_inicio(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.adms_geral_data_inicio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
new.data_inicio = CURRENT_DATE;
RETURN NEW;
END;
$$;


ALTER FUNCTION public.adms_geral_data_inicio() OWNER TO postgres;

--
-- Name: adms_talhoes_data_inicio(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.adms_talhoes_data_inicio() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
new.data_inicio = CURRENT_DATE;
RETURN NEW;
END;
$$;


ALTER FUNCTION public.adms_talhoes_data_inicio() OWNER TO postgres;

--
-- Name: atividades_data(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.atividades_data() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
new.data = CURRENT_DATE;
RETURN NEW;
END;
$$;


ALTER FUNCTION public.atividades_data() OWNER TO postgres;

--
-- Name: culturas_data(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.culturas_data() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
new.data_inicio = CURRENT_DATE;
new.data_fim = CURRENT_DATE;
RETURN NEW;
END;
$$;


ALTER FUNCTION public.culturas_data() OWNER TO postgres;

--
-- Name: culturas_fim(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.culturas_fim() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.culturas_fim() OWNER TO postgres;

--
-- Name: culturas_safra(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.culturas_safra() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE 
 mes_data integer;
BEGIN
new.data_inicio = CURRENT_DATE;
SELECT EXTRACT('Month' FROM data_inicio) INTO mes_data FROM public.culturas WHERE (id_culturas = new.id_culturas);
IF (mes_data <= 6) THEN
 UPDATE public.culturas SET tipo_safra = 'I' WHERE (id_culturas = new.id_culturas);
 RETURN NEW;
ELSE
UPDATE public.culturas SET tipo_safra = 'V' WHERE (id_culturas = new.id_culturas);
RETURN NEW;
END IF;
END;
$$;


ALTER FUNCTION public.culturas_safra() OWNER TO postgres;

--
-- Name: data_fim_cultura(date); Type: FUNCTION; Schema: public; Owner: eduardo
--

CREATE FUNCTION public.data_fim_cultura(data_fim date) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
BEGIN
IF (data_fim = CURRENT_DATE) THEN
 RETURN TRUE;
ELSE
RETURN FALSE;
RAISE EXCEPTION 'Data de fim não pode ser menor que de início';
END IF;
END;
$$;


ALTER FUNCTION public.data_fim_cultura(data_fim date) OWNER TO eduardo;

--
-- Name: movimentacoes_itens(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.movimentacoes_itens() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
IF EXISTS(SELECT id_itens FROM public.itens WHERE (id_itens = new.id_itens_itens)) THEN
IF (new.tipo_movimentacoes = 'E') THEN
UPDATE public.itens SET quantidade = quantidade + new.quantidade WHERE id_itens = new.id_itens_itens;
RETURN NEW ;
END IF;
IF (new.tipo_movimentacoes = 'S') THEN
UPDATE public.itens SET quantidade = quantidade - new.quantidade WHERE id_itens = new.id_itens_itens;
RETURN NEW ;
END IF;
ELSE 
RAISE EXCEPTION 'É necessário cadastrar o novo itens';
RETURN NULL;
END IF;
END;
$$;


ALTER FUNCTION public.movimentacoes_itens() OWNER TO postgres;

--
-- Name: requisicoes_data(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.requisicoes_data() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
new.data = CURRENT_DATE;
RETURN NEW;
END;
$$;


ALTER FUNCTION public.requisicoes_data() OWNER TO postgres;

--
-- Name: requisicoes_status(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.requisicoes_status() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN
new.id_requisicoes_status_requisicoes = 1;
RETURN NEW;
END;
$$;


ALTER FUNCTION public.requisicoes_status() OWNER TO postgres;

--
-- Name: talhoes_culturas(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.talhoes_culturas() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
BEGIN 
IF ((SELECT data_fim FROM public.culturas WHERE (id_talhoes_talhoes = old.id_talhoes)) = (SELECT data_inicio FROM public.culturas WHERE (id_talhoes_talhoes = old.id_talhoes))) THEN
RAISE EXCEPTION 'Não é possível deletar talhões que ainda possuem culturas.';
RETURN FALSE;       
ELSE 
DELETE FROM atividades WHERE id_culturas_culturas IN (SELECT id_culturas FROM public.culturas);
DELETE FROM culturas WHERE id_talhoes_talhoes IN (SELECT id_talhoes FROM public.talhoes);
RETURN OLD;
END IF;
END;
$$;


ALTER FUNCTION public.talhoes_culturas() OWNER TO postgres;

--
-- Name: valida_cpf(bigint); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.valida_cpf(cod_cpf bigint) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
DECLARE
        valido boolean := false;
        cpf text;
        cont integer;
        b integer;
       
    BEGIN
        b:=0;
        cont:=11;
        IF(cod_cpf = 11111111111 OR
           cod_cpf = 22222222222 OR
           cod_cpf = 33333333333 OR
           cod_cpf = 44444444444 OR
           cod_cpf = 55555555555 OR
           cod_cpf = 66666666666 OR
           cod_cpf = 77777777777 OR
           cod_cpf = 88888888888 OR
           cod_cpf = 99999999999) THEN
            RETURN valido;
        END IF;
        cpf := CAST(cod_cpf AS TEXT);
        WHILE (length(cpf) < 11) LOOP
                cpf := '0'||cpf;
        END LOOP;

        FOR i IN 1..9 LOOP
            cont := cont - 1;
            b := b + (CAST(substr(cpf,i,1) AS INT) * cont);
        END LOOP;

        IF((b % 11) < 2) THEN
            IF(((b % 11) < 2) AND CAST(substr(cpf,10,1) AS INT) <> 0) THEN       
                RETURN valido;
            ELSE
                valido :=true;
                RETURN valido;
            END IF;
        ELSE
            IF((11-(b % 11)) <> CAST(substr(cpf,10,1) AS INT)) THEN
                RETURN valido;
            ELSE
                valido:=true;
                RETURN valido;
            END IF;
        END IF;

        b:=0;
        cont:=11;
        FOR i IN 1..10 LOOP           
            b := b + (CAST(substr(cpf,i,1) AS INT) * cont);
            cont := cont - 1;
        END LOOP;

        IF((b % 11) < 2) THEN
            IF(((b % 11) < 2) AND CAST(substr(cpf,11,1) AS INT) <> 0) THEN       
                RETURN valido;
            ELSE
                valido :=true;
                RETURN valido;
            END IF;
        ELSE
            IF((11-(b % 11)) <> CAST(substr(cpf,11,1) AS INT)) THEN
                RETURN valido;
            ELSE
                valido:=true;
                RETURN valido;
            END IF;
        END IF;
    END
$$;


ALTER FUNCTION public.valida_cpf(cod_cpf bigint) OWNER TO postgres;

--
-- Name: valida_email(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.valida_email(email character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
BEGIN 
IF email !~ '^[a-z0-9._%-]+@[A-Za-z0-9.-]+[.][a-z]+$' THEN
RETURN FALSE;
ELSE
RETURN TRUE;
END IF;
END;
$_$;


ALTER FUNCTION public.valida_email(email character varying) OWNER TO postgres;

--
-- Name: valida_identificador(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.valida_identificador(identificador character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
BEGIN 
IF identificador ~ '^[a-zA-Z0-9]+$' THEN
RETURN TRUE;
ELSE
RETURN FALSE;
END IF;
END;
$_$;


ALTER FUNCTION public.valida_identificador(identificador character varying) OWNER TO postgres;

--
-- Name: valida_nome(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.valida_nome(nome character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
BEGIN 
IF nome ~ '^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$' THEN
RETURN TRUE;
ELSE
RETURN FALSE;
END IF;
END;
$_$;


ALTER FUNCTION public.valida_nome(nome character varying) OWNER TO postgres;

--
-- Name: valida_tipo(character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.valida_tipo(tipo character varying) RETURNS boolean
    LANGUAGE plpgsql
    AS $_$
BEGIN 
IF tipo ~ '^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$' THEN
RETURN TRUE;
ELSE
RETURN FALSE;
END IF;
END;
$_$;


ALTER FUNCTION public.valida_tipo(tipo character varying) OWNER TO postgres;

--
-- Name: verifica_adms_geral(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.verifica_adms_geral(id_func integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.verifica_adms_geral(id_func integer) OWNER TO postgres;

--
-- Name: verifica_adms_talhoes(integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.verifica_adms_talhoes(id_func integer) RETURNS boolean
    LANGUAGE plpgsql
    AS $$
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
$$;


ALTER FUNCTION public.verifica_adms_talhoes(id_func integer) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: adms_geral; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.adms_geral (
    id_adms_geral integer NOT NULL,
    data_inicio date DEFAULT ('now'::text)::date NOT NULL,
    data_fim date,
    id_funcionarios_funcionarios integer NOT NULL,
    CONSTRAINT adms_geral_id_funcionarios_funcionarios_check CHECK ((public.verifica_adms_geral(id_funcionarios_funcionarios) = true))
);


ALTER TABLE public.adms_geral OWNER TO eduardo;

--
-- Name: adms_geral_id_adms_geral_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.adms_geral_id_adms_geral_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adms_geral_id_adms_geral_seq OWNER TO eduardo;

--
-- Name: adms_geral_id_adms_geral_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.adms_geral_id_adms_geral_seq OWNED BY public.adms_geral.id_adms_geral;


--
-- Name: adms_talhoes; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.adms_talhoes (
    id_adms_talhoes integer NOT NULL,
    data_inicio date DEFAULT ('now'::text)::date NOT NULL,
    data_fim date,
    id_funcionarios_funcionarios integer NOT NULL,
    CONSTRAINT adms_talhoes_id_funcionarios_funcionarios_check CHECK ((public.verifica_adms_geral(id_funcionarios_funcionarios) = true))
);


ALTER TABLE public.adms_talhoes OWNER TO eduardo;

--
-- Name: adms_talhoes_id_adms_talhoes_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.adms_talhoes_id_adms_talhoes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.adms_talhoes_id_adms_talhoes_seq OWNER TO eduardo;

--
-- Name: adms_talhoes_id_adms_talhoes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.adms_talhoes_id_adms_talhoes_seq OWNED BY public.adms_talhoes.id_adms_talhoes;


--
-- Name: atividades; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.atividades (
    id_atividades integer NOT NULL,
    data date NOT NULL,
    data_registro date DEFAULT ('now'::text)::date NOT NULL,
    descricao character varying(100),
    id_adms_geral_adms_geral integer NOT NULL,
    id_tipos_atividades_tipos_atividades integer NOT NULL,
    id_culturas_culturas smallint,
    id_requisicoes_requisicoes integer,
    id_talhoes_talhoes integer
);


ALTER TABLE public.atividades OWNER TO eduardo;

--
-- Name: atividades_id_atividades_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.atividades_id_atividades_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.atividades_id_atividades_seq OWNER TO eduardo;

--
-- Name: atividades_id_atividades_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.atividades_id_atividades_seq OWNED BY public.atividades.id_atividades;


--
-- Name: cultivares; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.cultivares (
    id_cultivares integer NOT NULL,
    nome character varying NOT NULL,
    variedade character varying NOT NULL
);


ALTER TABLE public.cultivares OWNER TO eduardo;

--
-- Name: cultivares_id_cultivares_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.cultivares_id_cultivares_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cultivares_id_cultivares_seq OWNER TO eduardo;

--
-- Name: cultivares_id_cultivares_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.cultivares_id_cultivares_seq OWNED BY public.cultivares.id_cultivares;


--
-- Name: culturas; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.culturas (
    id_culturas integer NOT NULL,
    data_inicio date NOT NULL,
    descricao character varying(100),
    data_fim date,
    tipo_safra character(1) NOT NULL,
    id_talhoes_talhoes integer,
    id_cultivares_cultivares integer,
    CONSTRAINT culturas_check CHECK ((data_fim >= data_inicio)),
    CONSTRAINT culturas_tipo_safra_check CHECK (((tipo_safra = 'I'::bpchar) OR (tipo_safra = 'V'::bpchar)))
);


ALTER TABLE public.culturas OWNER TO eduardo;

--
-- Name: culturas_id_culturas_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.culturas_id_culturas_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.culturas_id_culturas_seq OWNER TO eduardo;

--
-- Name: culturas_id_culturas_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.culturas_id_culturas_seq OWNED BY public.culturas.id_culturas;


--
-- Name: funcionarios; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.funcionarios (
    id_funcionarios integer NOT NULL,
    cpf bigint NOT NULL,
    nome character varying(45) NOT NULL,
    email character varying(45) NOT NULL,
    acesso_sistema boolean DEFAULT false NOT NULL,
    login character varying(45) NOT NULL,
    password character varying(60) NOT NULL,
    remember_token character varying(60),
    CONSTRAINT funcionarios_cpf_check CHECK ((public.valida_cpf(cpf) = true)),
    CONSTRAINT funcionarios_email_check CHECK ((public.valida_email(email) = true)),
    CONSTRAINT funcionarios_nome_check CHECK ((public.valida_nome(nome) = true))
);


ALTER TABLE public.funcionarios OWNER TO eduardo;

--
-- Name: funcionarios_id_funcionarios_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.funcionarios_id_funcionarios_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.funcionarios_id_funcionarios_seq OWNER TO eduardo;

--
-- Name: funcionarios_id_funcionarios_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.funcionarios_id_funcionarios_seq OWNED BY public.funcionarios.id_funcionarios;


--
-- Name: funcionarios_tem_atividades; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.funcionarios_tem_atividades (
    id_atividades_atividades integer NOT NULL,
    id_funcionarios_funcionarios integer NOT NULL
);


ALTER TABLE public.funcionarios_tem_atividades OWNER TO eduardo;

--
-- Name: itens; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.itens (
    id_itens integer NOT NULL,
    nome character varying(46) NOT NULL,
    custo_por_unidades double precision NOT NULL,
    quantidade double precision NOT NULL,
    id_unidades_unidades integer,
    id_tipos_itens_tipos_itens integer,
    CONSTRAINT itens_nome_check CHECK ((public.valida_nome(nome) = true))
);


ALTER TABLE public.itens OWNER TO eduardo;

--
-- Name: itens_id_itens_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.itens_id_itens_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.itens_id_itens_seq OWNER TO eduardo;

--
-- Name: itens_id_itens_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.itens_id_itens_seq OWNED BY public.itens.id_itens;


--
-- Name: moderar_requisicoes; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.moderar_requisicoes (
    data date DEFAULT ('now'::text)::date NOT NULL,
    descricao character varying(100),
    descricao_adms_geral character varying(100),
    id_requisicoes_requisicoes integer NOT NULL,
    id_adms_geral_adms_geral integer NOT NULL,
    id_requisicoes_status_requisicoes integer NOT NULL
);


ALTER TABLE public.moderar_requisicoes OWNER TO eduardo;

--
-- Name: movimentacoes; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.movimentacoes (
    id_movimentacoes integer NOT NULL,
    custo double precision NOT NULL,
    quantidade double precision NOT NULL,
    data date DEFAULT ('now'::text)::date NOT NULL,
    tipo_movimentacoes character(1) NOT NULL,
    id_itens_itens integer NOT NULL,
    id_atividades_atividades integer,
    descricao character varying(100),
    CONSTRAINT movimentacoes_tipo_movimentacoes_check CHECK (((tipo_movimentacoes = 'E'::bpchar) OR (tipo_movimentacoes = 'S'::bpchar)))
);


ALTER TABLE public.movimentacoes OWNER TO eduardo;

--
-- Name: movimentacoes_id_movimentacoes_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.movimentacoes_id_movimentacoes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.movimentacoes_id_movimentacoes_seq OWNER TO eduardo;

--
-- Name: movimentacoes_id_movimentacoes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.movimentacoes_id_movimentacoes_seq OWNED BY public.movimentacoes.id_movimentacoes;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.password_resets (
    email character varying(45) NOT NULL,
    token character varying(100),
    created_at timestamp without time zone
);


ALTER TABLE public.password_resets OWNER TO eduardo;

--
-- Name: requisicoes; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.requisicoes (
    id_requisicoes integer NOT NULL,
    data date DEFAULT ('now'::text)::date NOT NULL,
    descricao character varying(100),
    descricao_adms_gerais character varying(100),
    resposta character varying(100),
    id_adms_talhoes_adms_talhoes integer NOT NULL,
    id_talhoes_talhoes integer,
    id_status_requisicoes_status_requisicoes integer
);


ALTER TABLE public.requisicoes OWNER TO eduardo;

--
-- Name: requisicoes_id_requisicoes_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.requisicoes_id_requisicoes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.requisicoes_id_requisicoes_seq OWNER TO eduardo;

--
-- Name: requisicoes_id_requisicoes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.requisicoes_id_requisicoes_seq OWNED BY public.requisicoes.id_requisicoes;


--
-- Name: status_requisicoes; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.status_requisicoes (
    id_status_requisicoes integer NOT NULL,
    nome character varying(45) NOT NULL,
    CONSTRAINT status_requisicoes_nome_check CHECK ((public.valida_nome(nome) = true))
);


ALTER TABLE public.status_requisicoes OWNER TO eduardo;

--
-- Name: status_requisicoes_id_status_requisicoes_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.status_requisicoes_id_status_requisicoes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.status_requisicoes_id_status_requisicoes_seq OWNER TO eduardo;

--
-- Name: status_requisicoes_id_status_requisicoes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.status_requisicoes_id_status_requisicoes_seq OWNED BY public.status_requisicoes.id_status_requisicoes;


--
-- Name: talhoes; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.talhoes (
    id_talhoes integer NOT NULL,
    area double precision NOT NULL,
    identificador character varying(20) NOT NULL,
    tipo character varying(15) NOT NULL,
    descricao character varying(45),
    id_adms_talhoes_adms_talhoes integer,
    CONSTRAINT talhoes_identificador_check CHECK ((public.valida_identificador(identificador) = true)),
    CONSTRAINT talhoes_tipo_check CHECK ((public.valida_tipo(tipo) = true))
);


ALTER TABLE public.talhoes OWNER TO eduardo;

--
-- Name: talhoes_id_talhoes_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.talhoes_id_talhoes_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.talhoes_id_talhoes_seq OWNER TO eduardo;

--
-- Name: talhoes_id_talhoes_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.talhoes_id_talhoes_seq OWNED BY public.talhoes.id_talhoes;


--
-- Name: tipos_atividades; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.tipos_atividades (
    id_tipos_atividades integer NOT NULL,
    nome character varying(45),
    CONSTRAINT tipos_atividades_nome_check CHECK ((public.valida_nome(nome) = true))
);


ALTER TABLE public.tipos_atividades OWNER TO eduardo;

--
-- Name: tipos_atividades_id_tipos_atividades_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.tipos_atividades_id_tipos_atividades_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_atividades_id_tipos_atividades_seq OWNER TO eduardo;

--
-- Name: tipos_atividades_id_tipos_atividades_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.tipos_atividades_id_tipos_atividades_seq OWNED BY public.tipos_atividades.id_tipos_atividades;


--
-- Name: tipos_itens; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.tipos_itens (
    id_tipos_itens integer NOT NULL,
    nome character varying(45) NOT NULL
);


ALTER TABLE public.tipos_itens OWNER TO eduardo;

--
-- Name: tipos_itens_id_tipos_itens_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.tipos_itens_id_tipos_itens_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tipos_itens_id_tipos_itens_seq OWNER TO eduardo;

--
-- Name: tipos_itens_id_tipos_itens_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.tipos_itens_id_tipos_itens_seq OWNED BY public.tipos_itens.id_tipos_itens;


--
-- Name: unidades; Type: TABLE; Schema: public; Owner: eduardo
--

CREATE TABLE public.unidades (
    id_unidades integer NOT NULL,
    sigla character varying(10) NOT NULL,
    nome character varying(45),
    CONSTRAINT unidades_nome_check CHECK ((public.valida_nome(nome) = true)),
    CONSTRAINT unidades_sigla_check CHECK ((public.valida_nome(sigla) = true))
);


ALTER TABLE public.unidades OWNER TO eduardo;

--
-- Name: unidades_id_unidades_seq; Type: SEQUENCE; Schema: public; Owner: eduardo
--

CREATE SEQUENCE public.unidades_id_unidades_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.unidades_id_unidades_seq OWNER TO eduardo;

--
-- Name: unidades_id_unidades_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: eduardo
--

ALTER SEQUENCE public.unidades_id_unidades_seq OWNED BY public.unidades.id_unidades;


--
-- Name: id_adms_geral; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.adms_geral ALTER COLUMN id_adms_geral SET DEFAULT nextval('public.adms_geral_id_adms_geral_seq'::regclass);


--
-- Name: id_adms_talhoes; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.adms_talhoes ALTER COLUMN id_adms_talhoes SET DEFAULT nextval('public.adms_talhoes_id_adms_talhoes_seq'::regclass);


--
-- Name: id_atividades; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades ALTER COLUMN id_atividades SET DEFAULT nextval('public.atividades_id_atividades_seq'::regclass);


--
-- Name: id_cultivares; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.cultivares ALTER COLUMN id_cultivares SET DEFAULT nextval('public.cultivares_id_cultivares_seq'::regclass);


--
-- Name: id_culturas; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.culturas ALTER COLUMN id_culturas SET DEFAULT nextval('public.culturas_id_culturas_seq'::regclass);


--
-- Name: id_funcionarios; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.funcionarios ALTER COLUMN id_funcionarios SET DEFAULT nextval('public.funcionarios_id_funcionarios_seq'::regclass);


--
-- Name: id_itens; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.itens ALTER COLUMN id_itens SET DEFAULT nextval('public.itens_id_itens_seq'::regclass);


--
-- Name: id_movimentacoes; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.movimentacoes ALTER COLUMN id_movimentacoes SET DEFAULT nextval('public.movimentacoes_id_movimentacoes_seq'::regclass);


--
-- Name: id_requisicoes; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.requisicoes ALTER COLUMN id_requisicoes SET DEFAULT nextval('public.requisicoes_id_requisicoes_seq'::regclass);


--
-- Name: id_status_requisicoes; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.status_requisicoes ALTER COLUMN id_status_requisicoes SET DEFAULT nextval('public.status_requisicoes_id_status_requisicoes_seq'::regclass);


--
-- Name: id_talhoes; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.talhoes ALTER COLUMN id_talhoes SET DEFAULT nextval('public.talhoes_id_talhoes_seq'::regclass);


--
-- Name: id_tipos_atividades; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.tipos_atividades ALTER COLUMN id_tipos_atividades SET DEFAULT nextval('public.tipos_atividades_id_tipos_atividades_seq'::regclass);


--
-- Name: id_tipos_itens; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.tipos_itens ALTER COLUMN id_tipos_itens SET DEFAULT nextval('public.tipos_itens_id_tipos_itens_seq'::regclass);


--
-- Name: id_unidades; Type: DEFAULT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.unidades ALTER COLUMN id_unidades SET DEFAULT nextval('public.unidades_id_unidades_seq'::regclass);


--
-- Name: adms_geral_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.adms_geral
    ADD CONSTRAINT adms_geral_pk PRIMARY KEY (id_adms_geral);


--
-- Name: adms_talhoes_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.adms_talhoes
    ADD CONSTRAINT adms_talhoes_pk PRIMARY KEY (id_adms_talhoes);


--
-- Name: atividades_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades
    ADD CONSTRAINT atividades_pk PRIMARY KEY (id_atividades);


--
-- Name: cultivar_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.cultivares
    ADD CONSTRAINT cultivar_pk PRIMARY KEY (id_cultivares);


--
-- Name: culturas_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.culturas
    ADD CONSTRAINT culturas_pk PRIMARY KEY (id_culturas);


--
-- Name: funcionarios_cpf_key; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.funcionarios
    ADD CONSTRAINT funcionarios_cpf_key UNIQUE (cpf);


--
-- Name: funcionarios_login_key; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.funcionarios
    ADD CONSTRAINT funcionarios_login_key UNIQUE (login);


--
-- Name: funcionarios_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.funcionarios
    ADD CONSTRAINT funcionarios_pk PRIMARY KEY (id_funcionarios);


--
-- Name: funcionarios_tem_atividades_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.funcionarios_tem_atividades
    ADD CONSTRAINT funcionarios_tem_atividades_pk PRIMARY KEY (id_atividades_atividades, id_funcionarios_funcionarios);


--
-- Name: itens_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.itens
    ADD CONSTRAINT itens_pk PRIMARY KEY (id_itens);


--
-- Name: moderar_requisicoes_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.moderar_requisicoes
    ADD CONSTRAINT moderar_requisicoes_pk PRIMARY KEY (id_requisicoes_requisicoes, id_adms_geral_adms_geral);


--
-- Name: movimentacoes_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.movimentacoes
    ADD CONSTRAINT movimentacoes_pk PRIMARY KEY (id_movimentacoes);


--
-- Name: requisicoes_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.requisicoes
    ADD CONSTRAINT requisicoes_pk PRIMARY KEY (id_requisicoes);


--
-- Name: status_requisicoes_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.status_requisicoes
    ADD CONSTRAINT status_requisicoes_pk PRIMARY KEY (id_status_requisicoes);


--
-- Name: talhoes_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.talhoes
    ADD CONSTRAINT talhoes_pk PRIMARY KEY (id_talhoes);


--
-- Name: tipos_atividades_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.tipos_atividades
    ADD CONSTRAINT tipos_atividades_pk PRIMARY KEY (id_tipos_atividades);


--
-- Name: tipos_itens_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.tipos_itens
    ADD CONSTRAINT tipos_itens_pk PRIMARY KEY (id_tipos_itens);


--
-- Name: unidades_pk; Type: CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.unidades
    ADD CONSTRAINT unidades_pk PRIMARY KEY (id_unidades);


--
-- Name: adms_geral_data_inicio; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER adms_geral_data_inicio BEFORE INSERT ON public.adms_geral FOR EACH ROW EXECUTE PROCEDURE public.adms_geral_data_inicio();


--
-- Name: adms_talhoes_data_inicio; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER adms_talhoes_data_inicio BEFORE INSERT ON public.adms_talhoes FOR EACH ROW EXECUTE PROCEDURE public.adms_talhoes_data_inicio();


--
-- Name: atividades_data; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER atividades_data BEFORE INSERT ON public.atividades FOR EACH ROW EXECUTE PROCEDURE public.atividades_data();


--
-- Name: culturas_safra; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER culturas_safra AFTER INSERT ON public.culturas FOR EACH ROW EXECUTE PROCEDURE public.culturas_safra();


--
-- Name: movimentacoes_itens; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER movimentacoes_itens AFTER INSERT ON public.movimentacoes FOR EACH ROW EXECUTE PROCEDURE public.movimentacoes_itens();


--
-- Name: requisicoes_data; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER requisicoes_data BEFORE INSERT ON public.requisicoes FOR EACH ROW EXECUTE PROCEDURE public.requisicoes_data();


--
-- Name: requisicoes_status; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER requisicoes_status BEFORE INSERT ON public.moderar_requisicoes FOR EACH ROW EXECUTE PROCEDURE public.requisicoes_status();


--
-- Name: talhoes_culturas; Type: TRIGGER; Schema: public; Owner: eduardo
--

CREATE TRIGGER talhoes_culturas BEFORE DELETE ON public.talhoes FOR EACH ROW EXECUTE PROCEDURE public.talhoes_culturas();


--
-- Name: adms_geral_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.adms_geral
    ADD CONSTRAINT adms_geral_fk FOREIGN KEY (id_funcionarios_funcionarios) REFERENCES public.funcionarios(id_funcionarios);


--
-- Name: adms_geral_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.moderar_requisicoes
    ADD CONSTRAINT adms_geral_fk FOREIGN KEY (id_adms_geral_adms_geral) REFERENCES public.adms_geral(id_adms_geral);


--
-- Name: adms_geral_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades
    ADD CONSTRAINT adms_geral_fk FOREIGN KEY (id_adms_geral_adms_geral) REFERENCES public.adms_geral(id_adms_geral);


--
-- Name: adms_talhoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.adms_talhoes
    ADD CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_funcionarios_funcionarios) REFERENCES public.funcionarios(id_funcionarios);


--
-- Name: adms_talhoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.talhoes
    ADD CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_adms_talhoes_adms_talhoes) REFERENCES public.adms_talhoes(id_adms_talhoes);


--
-- Name: adms_talhoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.requisicoes
    ADD CONSTRAINT adms_talhoes_fk FOREIGN KEY (id_adms_talhoes_adms_talhoes) REFERENCES public.adms_talhoes(id_adms_talhoes);


--
-- Name: atividades_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.movimentacoes
    ADD CONSTRAINT atividades_fk FOREIGN KEY (id_atividades_atividades) REFERENCES public.atividades(id_atividades) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: cultivares_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.culturas
    ADD CONSTRAINT cultivares_fk FOREIGN KEY (id_cultivares_cultivares) REFERENCES public.cultivares(id_cultivares);


--
-- Name: culturas_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades
    ADD CONSTRAINT culturas_fk FOREIGN KEY (id_culturas_culturas) REFERENCES public.culturas(id_culturas);


--
-- Name: itens_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.movimentacoes
    ADD CONSTRAINT itens_fk FOREIGN KEY (id_itens_itens) REFERENCES public.itens(id_itens) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: requisicoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.requisicoes
    ADD CONSTRAINT requisicoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes(id_talhoes);


--
-- Name: requisicoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.moderar_requisicoes
    ADD CONSTRAINT requisicoes_fk FOREIGN KEY (id_requisicoes_requisicoes) REFERENCES public.requisicoes(id_requisicoes);


--
-- Name: requisicoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades
    ADD CONSTRAINT requisicoes_fk FOREIGN KEY (id_requisicoes_requisicoes) REFERENCES public.requisicoes(id_requisicoes);


--
-- Name: status_requisicoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.requisicoes
    ADD CONSTRAINT status_requisicoes_fk FOREIGN KEY (id_status_requisicoes_status_requisicoes) REFERENCES public.status_requisicoes(id_status_requisicoes);


--
-- Name: status_requisicoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.moderar_requisicoes
    ADD CONSTRAINT status_requisicoes_fk FOREIGN KEY (id_requisicoes_status_requisicoes) REFERENCES public.status_requisicoes(id_status_requisicoes);


--
-- Name: talhoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.culturas
    ADD CONSTRAINT talhoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes(id_talhoes);


--
-- Name: talhoes_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades
    ADD CONSTRAINT talhoes_fk FOREIGN KEY (id_talhoes_talhoes) REFERENCES public.talhoes(id_talhoes);


--
-- Name: tipos_atividades_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.atividades
    ADD CONSTRAINT tipos_atividades_fk FOREIGN KEY (id_tipos_atividades_tipos_atividades) REFERENCES public.tipos_atividades(id_tipos_atividades);


--
-- Name: tipos_itens_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.itens
    ADD CONSTRAINT tipos_itens_fk FOREIGN KEY (id_tipos_itens_tipos_itens) REFERENCES public.tipos_itens(id_tipos_itens);


--
-- Name: unidades_fk; Type: FK CONSTRAINT; Schema: public; Owner: eduardo
--

ALTER TABLE ONLY public.itens
    ADD CONSTRAINT unidades_fk FOREIGN KEY (id_unidades_unidades) REFERENCES public.unidades(id_unidades);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

