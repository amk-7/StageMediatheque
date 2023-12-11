--
-- PostgreSQL database dump
--

-- Dumped from database version 14.10 (Ubuntu 14.10-0ubuntu0.22.04.1)
-- Dumped by pg_dump version 14.10 (Ubuntu 14.10-0ubuntu0.22.04.1)

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: abonnes; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.abonnes (
    id_abonne bigint NOT NULL,
    date_naissance date,
    niveau_etude character varying(255) NOT NULL,
    profession character varying(255) NOT NULL,
    contact_a_prevenir character varying(255) DEFAULT ''::character varying,
    numero_carte character varying(255),
    type_de_carte character varying(255) NOT NULL,
    profil_valider character varying(255) DEFAULT '0'::character varying NOT NULL,
    id_utilisateur bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT abonnes_profil_valider_check CHECK (((profil_valider)::text = ANY ((ARRAY['0'::character varying, '1'::character varying])::text[]))),
    CONSTRAINT abonnes_type_de_carte_check CHECK (((type_de_carte)::text = ANY ((ARRAY['0'::character varying, '1'::character varying])::text[])))
);


ALTER TABLE public.abonnes OWNER TO amk;

--
-- Name: abonnes_id_abonne_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.abonnes_id_abonne_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.abonnes_id_abonne_seq OWNER TO amk;

--
-- Name: abonnes_id_abonne_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.abonnes_id_abonne_seq OWNED BY public.abonnes.id_abonne;


--
-- Name: activites; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.activites (
    id_activite bigint NOT NULL,
    ouvrages text NOT NULL,
    sugestions text NOT NULL,
    id_abonne bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.activites OWNER TO amk;

--
-- Name: activites_id_activite_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.activites_id_activite_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.activites_id_activite_seq OWNER TO amk;

--
-- Name: activites_id_activite_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.activites_id_activite_seq OWNED BY public.activites.id_activite;


--
-- Name: approvisionnements; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.approvisionnements (
    id_approvisionnement bigint NOT NULL,
    nombre_exemplaire integer NOT NULL,
    date_approvisioement timestamp(0) without time zone DEFAULT '2023-12-11 11:19:18.620525'::timestamp without time zone NOT NULL,
    id_ouvrage bigint,
    id_personnel bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.approvisionnements OWNER TO amk;

--
-- Name: approvisionnements_id_approvisionnement_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.approvisionnements_id_approvisionnement_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.approvisionnements_id_approvisionnement_seq OWNER TO amk;

--
-- Name: approvisionnements_id_approvisionnement_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.approvisionnements_id_approvisionnement_seq OWNED BY public.approvisionnements.id_approvisionnement;


--
-- Name: auteurs; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.auteurs (
    id_auteur bigint NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.auteurs OWNER TO amk;

--
-- Name: auteurs_id_auteur_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.auteurs_id_auteur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auteurs_id_auteur_seq OWNER TO amk;

--
-- Name: auteurs_id_auteur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.auteurs_id_auteur_seq OWNED BY public.auteurs.id_auteur;


--
-- Name: auteurs_ouvrages; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.auteurs_ouvrages (
    id_auteur bigint NOT NULL,
    id_ouvrage bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.auteurs_ouvrages OWNER TO amk;

--
-- Name: classification_dewey_centaines; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.classification_dewey_centaines (
    id_classification_dewey_centaine bigint NOT NULL,
    section bigint NOT NULL,
    theme character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.classification_dewey_centaines OWNER TO amk;

--
-- Name: classification_dewey_centaine_id_classification_dewey_centa_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.classification_dewey_centaine_id_classification_dewey_centa_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.classification_dewey_centaine_id_classification_dewey_centa_seq OWNER TO amk;

--
-- Name: classification_dewey_centaine_id_classification_dewey_centa_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.classification_dewey_centaine_id_classification_dewey_centa_seq OWNED BY public.classification_dewey_centaines.id_classification_dewey_centaine;


--
-- Name: classification_dewey_dizaines; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.classification_dewey_dizaines (
    id_classification_dewey_dizaine bigint NOT NULL,
    classe integer NOT NULL,
    matiere character varying(255) NOT NULL,
    id_classification_dewey_centaine bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.classification_dewey_dizaines OWNER TO amk;

--
-- Name: classification_dewey_dizaines_id_classification_dewey_dizai_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.classification_dewey_dizaines_id_classification_dewey_dizai_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.classification_dewey_dizaines_id_classification_dewey_dizai_seq OWNER TO amk;

--
-- Name: classification_dewey_dizaines_id_classification_dewey_dizai_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.classification_dewey_dizaines_id_classification_dewey_dizai_seq OWNED BY public.classification_dewey_dizaines.id_classification_dewey_dizaine;


--
-- Name: domaines; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.domaines (
    id_domaine bigint NOT NULL,
    libelle character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.domaines OWNER TO amk;

--
-- Name: domaines_id_domaine_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.domaines_id_domaine_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.domaines_id_domaine_seq OWNER TO amk;

--
-- Name: domaines_id_domaine_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.domaines_id_domaine_seq OWNED BY public.domaines.id_domaine;


--
-- Name: domaines_ouvrages; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.domaines_ouvrages (
    id bigint NOT NULL,
    id_ouvrage bigint,
    id_domaine bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.domaines_ouvrages OWNER TO amk;

--
-- Name: domaines_ouvrages_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.domaines_ouvrages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.domaines_ouvrages_id_seq OWNER TO amk;

--
-- Name: domaines_ouvrages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.domaines_ouvrages_id_seq OWNED BY public.domaines_ouvrages.id;


--
-- Name: emprunts; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.emprunts (
    id_emprunt bigint NOT NULL,
    date_emprunt date DEFAULT '2023-12-11'::date NOT NULL,
    date_retour date NOT NULL,
    id_abonne bigint,
    id_personnel bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.emprunts OWNER TO amk;

--
-- Name: emprunts_id_emprunt_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.emprunts_id_emprunt_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.emprunts_id_emprunt_seq OWNER TO amk;

--
-- Name: emprunts_id_emprunt_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.emprunts_id_emprunt_seq OWNED BY public.emprunts.id_emprunt;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO amk;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO amk;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: floozs; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.floozs (
    id_flooz bigint NOT NULL,
    id_registration bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.floozs OWNER TO amk;

--
-- Name: floozs_id_flooz_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.floozs_id_flooz_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.floozs_id_flooz_seq OWNER TO amk;

--
-- Name: floozs_id_flooz_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.floozs_id_flooz_seq OWNED BY public.floozs.id_flooz;


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO amk;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jobs_id_seq OWNER TO amk;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: langues; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.langues (
    id_langue bigint NOT NULL,
    libelle character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.langues OWNER TO amk;

--
-- Name: langues_id_langue_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.langues_id_langue_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.langues_id_langue_seq OWNER TO amk;

--
-- Name: langues_id_langue_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.langues_id_langue_seq OWNED BY public.langues.id_langue;


--
-- Name: langues_ouvrages; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.langues_ouvrages (
    id_langue bigint NOT NULL,
    id_ouvrage bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.langues_ouvrages OWNER TO amk;

--
-- Name: lignes_emprunts; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.lignes_emprunts (
    id_ligne_emprunt bigint NOT NULL,
    id_ouvrage bigint,
    id_emprunt bigint,
    etat_sortie character varying(255) NOT NULL,
    disponibilite boolean NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT lignes_emprunts_etat_sortie_check CHECK (((etat_sortie)::text = ANY ((ARRAY['1'::character varying, '2'::character varying, '3'::character varying, '4'::character varying, '5'::character varying])::text[])))
);


ALTER TABLE public.lignes_emprunts OWNER TO amk;

--
-- Name: lignes_emprunts_id_ligne_emprunt_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.lignes_emprunts_id_ligne_emprunt_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lignes_emprunts_id_ligne_emprunt_seq OWNER TO amk;

--
-- Name: lignes_emprunts_id_ligne_emprunt_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.lignes_emprunts_id_ligne_emprunt_seq OWNED BY public.lignes_emprunts.id_ligne_emprunt;


--
-- Name: lignes_restitutions; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.lignes_restitutions (
    id_ligne_restitution bigint NOT NULL,
    id_ouvrage bigint,
    id_restitution bigint,
    etat_entree character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT lignes_restitutions_etat_entree_check CHECK (((etat_entree)::text = ANY ((ARRAY['1'::character varying, '2'::character varying, '3'::character varying, '4'::character varying, '5'::character varying])::text[])))
);


ALTER TABLE public.lignes_restitutions OWNER TO amk;

--
-- Name: lignes_restitutions_id_ligne_restitution_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.lignes_restitutions_id_ligne_restitution_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.lignes_restitutions_id_ligne_restitution_seq OWNER TO amk;

--
-- Name: lignes_restitutions_id_ligne_restitution_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.lignes_restitutions_id_ligne_restitution_seq OWNED BY public.lignes_restitutions.id_ligne_restitution;


--
-- Name: liquides; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.liquides (
    id_liquide bigint NOT NULL,
    id_registration bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.liquides OWNER TO amk;

--
-- Name: liquides_id_liquide_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.liquides_id_liquide_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.liquides_id_liquide_seq OWNER TO amk;

--
-- Name: liquides_id_liquide_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.liquides_id_liquide_seq OWNED BY public.liquides.id_liquide;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO amk;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO amk;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: model_has_permissions; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.model_has_permissions (
    permission_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_permissions OWNER TO amk;

--
-- Name: model_has_roles; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.model_has_roles (
    role_id bigint NOT NULL,
    model_type character varying(255) NOT NULL,
    model_id bigint NOT NULL
);


ALTER TABLE public.model_has_roles OWNER TO amk;

--
-- Name: natures; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.natures (
    id_nature bigint NOT NULL,
    libelle character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.natures OWNER TO amk;

--
-- Name: natures_id_nature_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.natures_id_nature_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.natures_id_nature_seq OWNER TO amk;

--
-- Name: natures_id_nature_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.natures_id_nature_seq OWNED BY public.natures.id_nature;


--
-- Name: niveaux; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.niveaux (
    id_niveau bigint NOT NULL,
    libelle character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.niveaux OWNER TO amk;

--
-- Name: niveaux_id_niveau_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.niveaux_id_niveau_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.niveaux_id_niveau_seq OWNER TO amk;

--
-- Name: niveaux_id_niveau_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.niveaux_id_niveau_seq OWNED BY public.niveaux.id_niveau;


--
-- Name: ouvrage_reservation; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.ouvrage_reservation (
    ouvrage_physique_id_ouvrage_physique bigint NOT NULL,
    reservation_id_reservation bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.ouvrage_reservation OWNER TO amk;

--
-- Name: ouvrages; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.ouvrages (
    id_ouvrage bigint NOT NULL,
    cote text NOT NULL,
    titre text NOT NULL,
    mot_cle json,
    resume text,
    annee_apparution integer,
    lieu_edition character varying(255),
    id_niveau bigint,
    id_type bigint,
    image text,
    id_langue bigint,
    ressources_externe text,
    isbn character varying(255),
    nombre_exemplaire integer,
    documents text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.ouvrages OWNER TO amk;

--
-- Name: ouvrages_id_ouvrage_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.ouvrages_id_ouvrage_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.ouvrages_id_ouvrage_seq OWNER TO amk;

--
-- Name: ouvrages_id_ouvrage_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.ouvrages_id_ouvrage_seq OWNED BY public.ouvrages.id_ouvrage;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO amk;

--
-- Name: permissions; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.permissions (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.permissions OWNER TO amk;

--
-- Name: permissions_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.permissions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permissions_id_seq OWNER TO amk;

--
-- Name: permissions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.permissions_id_seq OWNED BY public.permissions.id;


--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    expires_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO amk;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO amk;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: personnels; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.personnels (
    id_personnel bigint NOT NULL,
    statut character varying(255) NOT NULL,
    id_utilisateur bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.personnels OWNER TO amk;

--
-- Name: personnels_id_personnel_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.personnels_id_personnel_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personnels_id_personnel_seq OWNER TO amk;

--
-- Name: personnels_id_personnel_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.personnels_id_personnel_seq OWNED BY public.personnels.id_personnel;


--
-- Name: registrations; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.registrations (
    id_registration bigint NOT NULL,
    date_debut date NOT NULL,
    date_fin date NOT NULL,
    etat character varying(255) DEFAULT '1'::character varying NOT NULL,
    id_abonne bigint NOT NULL,
    id_tarif_abonnement bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT registrations_etat_check CHECK (((etat)::text = ANY ((ARRAY['0'::character varying, '1'::character varying])::text[])))
);


ALTER TABLE public.registrations OWNER TO amk;

--
-- Name: registrations_id_registration_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.registrations_id_registration_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.registrations_id_registration_seq OWNER TO amk;

--
-- Name: registrations_id_registration_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.registrations_id_registration_seq OWNED BY public.registrations.id_registration;


--
-- Name: reservations; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.reservations (
    id_reservation bigint NOT NULL,
    date_reservation timestamp(0) without time zone DEFAULT '2023-12-11 11:19:18.609039'::timestamp without time zone NOT NULL,
    etat character varying(255) DEFAULT '1'::character varying NOT NULL,
    durre integer DEFAULT 24 NOT NULL,
    id_abonne bigint NOT NULL,
    id_ouvrage bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone,
    CONSTRAINT reservations_etat_check CHECK (((etat)::text = ANY ((ARRAY['0'::character varying, '1'::character varying])::text[])))
);


ALTER TABLE public.reservations OWNER TO amk;

--
-- Name: reservations_id_reservation_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.reservations_id_reservation_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reservations_id_reservation_seq OWNER TO amk;

--
-- Name: reservations_id_reservation_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.reservations_id_reservation_seq OWNED BY public.reservations.id_reservation;


--
-- Name: restitutions; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.restitutions (
    id_restitution bigint NOT NULL,
    etat boolean NOT NULL,
    date_restitution date DEFAULT '2023-12-11'::date NOT NULL,
    id_abonne bigint,
    id_personnel bigint,
    id_emprunt bigint,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.restitutions OWNER TO amk;

--
-- Name: restitutions_id_restitution_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.restitutions_id_restitution_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.restitutions_id_restitution_seq OWNER TO amk;

--
-- Name: restitutions_id_restitution_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.restitutions_id_restitution_seq OWNED BY public.restitutions.id_restitution;


--
-- Name: role_has_permissions; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.role_has_permissions (
    permission_id bigint NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.role_has_permissions OWNER TO amk;

--
-- Name: roles; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    guard_name character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.roles OWNER TO amk;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO amk;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: tarif_abonnements; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.tarif_abonnements (
    id_tarif_abonnement bigint NOT NULL,
    tarif character varying(255) NOT NULL,
    duree_validite bigint NOT NULL,
    designation character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tarif_abonnements OWNER TO amk;

--
-- Name: tarif_abonnements_id_tarif_abonnement_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.tarif_abonnements_id_tarif_abonnement_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tarif_abonnements_id_tarif_abonnement_seq OWNER TO amk;

--
-- Name: tarif_abonnements_id_tarif_abonnement_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.tarif_abonnements_id_tarif_abonnement_seq OWNED BY public.tarif_abonnements.id_tarif_abonnement;


--
-- Name: tmoneys; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.tmoneys (
    id_tmoney bigint NOT NULL,
    id_registration bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tmoneys OWNER TO amk;

--
-- Name: tmoneys_id_tmoney_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.tmoneys_id_tmoney_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.tmoneys_id_tmoney_seq OWNER TO amk;

--
-- Name: tmoneys_id_tmoney_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.tmoneys_id_tmoney_seq OWNED BY public.tmoneys.id_tmoney;


--
-- Name: types_ouvrages; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.types_ouvrages (
    id_type_ouvrage bigint NOT NULL,
    libelle character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.types_ouvrages OWNER TO amk;

--
-- Name: types_ouvrages_id_type_ouvrage_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.types_ouvrages_id_type_ouvrage_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.types_ouvrages_id_type_ouvrage_seq OWNER TO amk;

--
-- Name: types_ouvrages_id_type_ouvrage_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.types_ouvrages_id_type_ouvrage_seq OWNED BY public.types_ouvrages.id_type_ouvrage;


--
-- Name: users; Type: TABLE; Schema: public; Owner: amk
--

CREATE TABLE public.users (
    id_utilisateur bigint NOT NULL,
    nom character varying(255) NOT NULL,
    prenom character varying(255) NOT NULL,
    nom_utilisateur character varying(255) NOT NULL,
    email character varying(255),
    password character varying(255) NOT NULL,
    contact character varying(255),
    photo_profil character varying(255) NOT NULL,
    adresse json NOT NULL,
    sexe character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO amk;

--
-- Name: users_id_utilisateur_seq; Type: SEQUENCE; Schema: public; Owner: amk
--

CREATE SEQUENCE public.users_id_utilisateur_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_utilisateur_seq OWNER TO amk;

--
-- Name: users_id_utilisateur_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: amk
--

ALTER SEQUENCE public.users_id_utilisateur_seq OWNED BY public.users.id_utilisateur;


--
-- Name: abonnes id_abonne; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.abonnes ALTER COLUMN id_abonne SET DEFAULT nextval('public.abonnes_id_abonne_seq'::regclass);


--
-- Name: activites id_activite; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.activites ALTER COLUMN id_activite SET DEFAULT nextval('public.activites_id_activite_seq'::regclass);


--
-- Name: approvisionnements id_approvisionnement; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.approvisionnements ALTER COLUMN id_approvisionnement SET DEFAULT nextval('public.approvisionnements_id_approvisionnement_seq'::regclass);


--
-- Name: auteurs id_auteur; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.auteurs ALTER COLUMN id_auteur SET DEFAULT nextval('public.auteurs_id_auteur_seq'::regclass);


--
-- Name: classification_dewey_centaines id_classification_dewey_centaine; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_centaines ALTER COLUMN id_classification_dewey_centaine SET DEFAULT nextval('public.classification_dewey_centaine_id_classification_dewey_centa_seq'::regclass);


--
-- Name: classification_dewey_dizaines id_classification_dewey_dizaine; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_dizaines ALTER COLUMN id_classification_dewey_dizaine SET DEFAULT nextval('public.classification_dewey_dizaines_id_classification_dewey_dizai_seq'::regclass);


--
-- Name: domaines id_domaine; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.domaines ALTER COLUMN id_domaine SET DEFAULT nextval('public.domaines_id_domaine_seq'::regclass);


--
-- Name: domaines_ouvrages id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.domaines_ouvrages ALTER COLUMN id SET DEFAULT nextval('public.domaines_ouvrages_id_seq'::regclass);


--
-- Name: emprunts id_emprunt; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.emprunts ALTER COLUMN id_emprunt SET DEFAULT nextval('public.emprunts_id_emprunt_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: floozs id_flooz; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.floozs ALTER COLUMN id_flooz SET DEFAULT nextval('public.floozs_id_flooz_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: langues id_langue; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.langues ALTER COLUMN id_langue SET DEFAULT nextval('public.langues_id_langue_seq'::regclass);


--
-- Name: lignes_emprunts id_ligne_emprunt; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_emprunts ALTER COLUMN id_ligne_emprunt SET DEFAULT nextval('public.lignes_emprunts_id_ligne_emprunt_seq'::regclass);


--
-- Name: lignes_restitutions id_ligne_restitution; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_restitutions ALTER COLUMN id_ligne_restitution SET DEFAULT nextval('public.lignes_restitutions_id_ligne_restitution_seq'::regclass);


--
-- Name: liquides id_liquide; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.liquides ALTER COLUMN id_liquide SET DEFAULT nextval('public.liquides_id_liquide_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: natures id_nature; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.natures ALTER COLUMN id_nature SET DEFAULT nextval('public.natures_id_nature_seq'::regclass);


--
-- Name: niveaux id_niveau; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.niveaux ALTER COLUMN id_niveau SET DEFAULT nextval('public.niveaux_id_niveau_seq'::regclass);


--
-- Name: ouvrages id_ouvrage; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.ouvrages ALTER COLUMN id_ouvrage SET DEFAULT nextval('public.ouvrages_id_ouvrage_seq'::regclass);


--
-- Name: permissions id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.permissions ALTER COLUMN id SET DEFAULT nextval('public.permissions_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Name: personnels id_personnel; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.personnels ALTER COLUMN id_personnel SET DEFAULT nextval('public.personnels_id_personnel_seq'::regclass);


--
-- Name: registrations id_registration; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.registrations ALTER COLUMN id_registration SET DEFAULT nextval('public.registrations_id_registration_seq'::regclass);


--
-- Name: reservations id_reservation; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.reservations ALTER COLUMN id_reservation SET DEFAULT nextval('public.reservations_id_reservation_seq'::regclass);


--
-- Name: restitutions id_restitution; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.restitutions ALTER COLUMN id_restitution SET DEFAULT nextval('public.restitutions_id_restitution_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: tarif_abonnements id_tarif_abonnement; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.tarif_abonnements ALTER COLUMN id_tarif_abonnement SET DEFAULT nextval('public.tarif_abonnements_id_tarif_abonnement_seq'::regclass);


--
-- Name: tmoneys id_tmoney; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.tmoneys ALTER COLUMN id_tmoney SET DEFAULT nextval('public.tmoneys_id_tmoney_seq'::regclass);


--
-- Name: types_ouvrages id_type_ouvrage; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.types_ouvrages ALTER COLUMN id_type_ouvrage SET DEFAULT nextval('public.types_ouvrages_id_type_ouvrage_seq'::regclass);


--
-- Name: users id_utilisateur; Type: DEFAULT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.users ALTER COLUMN id_utilisateur SET DEFAULT nextval('public.users_id_utilisateur_seq'::regclass);


--
-- Data for Name: abonnes; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.abonnes (id_abonne, date_naissance, niveau_etude, profession, contact_a_prevenir, numero_carte, type_de_carte, profil_valider, id_utilisateur, created_at, updated_at, deleted_at) FROM stdin;
1	1996-01-01	Université	Etudiant	92817907	123456789	1	1	3	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
2	1996-01-01	Université	Etudiant	90303030	912345678	1	1	4	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
3	2003-04-11	Université	Etudiant	92353698	932345678	1	0	5	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
\.


--
-- Data for Name: activites; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.activites (id_activite, ouvrages, sugestions, id_abonne, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: approvisionnements; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.approvisionnements (id_approvisionnement, nombre_exemplaire, date_approvisioement, id_ouvrage, id_personnel, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: auteurs; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.auteurs (id_auteur, nom, prenom, created_at, updated_at) FROM stdin;
1	ERNEST   SCOOT		2023-12-11 11:23:26	2023-12-11 11:23:26
2	SERGE  SAEZ		2023-12-11 11:23:26	2023-12-11 11:23:26
3	MICHEL  MORAD		2023-12-11 11:23:26	2023-12-11 11:23:26
4	HENRI  RENAUD		2023-12-11 11:23:26	2023-12-11 11:23:26
5	FRANCIS  ESNAULT		2023-12-11 11:23:26	2023-12-11 11:23:26
6	R.  DELEBRECQUE		2023-12-11 11:23:26	2023-12-11 11:23:26
7	R .DELEBRECQUE		2023-12-11 11:23:26	2023-12-11 11:23:26
8	PIERRE  GAROT		2023-12-11 11:23:26	2023-12-11 11:23:26
9	PIERRE  BOYER		2023-12-11 11:23:26	2023-12-11 11:23:26
10	YVON  GEORGES		2023-12-11 11:23:26	2023-12-11 11:23:26
11	JEAN-PIERRE  URSO		2023-12-11 11:23:26	2023-12-11 11:23:26
12	FRANçOIS  BENIELLI		2023-12-11 11:23:26	2023-12-11 11:23:26
13	PHILPPE  BARRET		2023-12-11 11:23:26	2023-12-11 11:23:26
14	JULIUS  NATTERER		2023-12-11 11:23:26	2023-12-11 11:23:26
15	JACQUES  LAFARGUE		2023-12-11 11:23:26	2023-12-11 11:23:26
16	G. BARUSSAUD		2023-12-11 11:23:26	2023-12-11 11:23:26
17	MATINE  HOUY		2023-12-11 11:23:26	2023-12-11 11:23:26
18	ANNE -MARIE   BONNET		2023-12-11 11:23:26	2023-12-11 11:23:26
19	ARAM  SAMIKIAN		2023-12-11 11:23:26	2023-12-11 11:23:26
20	S. MORENO		2023-12-11 11:23:26	2023-12-11 11:23:26
21	JEAN CLAUDE GALLOIS		2023-12-11 11:23:26	2023-12-11 11:23:26
22	JEAN PAUL BLUGEON		2023-12-11 11:23:26	2023-12-11 11:23:26
23	C. CIMELLI		2023-12-11 11:23:26	2023-12-11 11:23:26
24	RENE BASQUIN		2023-12-11 11:23:26	2023-12-11 11:23:26
25	JACQUES DIGOUT		2023-12-11 11:23:26	2023-12-11 11:23:26
26	LAURENT LALO		2023-12-11 11:23:26	2023-12-11 11:23:26
27	ISABELLE CALIN		2023-12-11 11:23:26	2023-12-11 11:23:26
28	MARGUéRITE MASSAL		2023-12-11 11:23:26	2023-12-11 11:23:26
29	ALAIN GASTINEAU		2023-12-11 11:23:26	2023-12-11 11:23:26
30	CLAUDE COHEN -TANNOUDJI		2023-12-11 11:23:26	2023-12-11 11:23:26
31	TERRIE NOLL		2023-12-11 11:23:26	2023-12-11 11:23:26
32	APCE GUIDE MéTIER		2023-12-11 11:23:26	2023-12-11 11:23:26
33	JEAN - CLAUDE  JOVET		2023-12-11 11:23:26	2023-12-11 11:23:26
34	MME C. BLANQUET		2023-12-11 11:23:26	2023-12-11 11:23:26
35	CATHERINE   CARON		2023-12-11 11:23:26	2023-12-11 11:23:26
36	HABIBA OUSLIMANI		2023-12-11 11:23:26	2023-12-11 11:23:26
37	FALK ANTONY		2023-12-11 11:23:26	2023-12-11 11:23:26
38	NICK JENKINS		2023-12-11 11:23:26	2023-12-11 11:23:26
39	COLL		2023-12-11 11:23:26	2023-12-11 11:23:26
40	F. POGGI		2023-12-11 11:23:26	2023-12-11 11:23:26
41			2023-12-11 11:23:26	2023-12-11 11:23:26
42	MANUEL		2023-12-11 11:23:26	2023-12-11 11:23:26
43	D. HARKER		2023-12-11 11:23:26	2023-12-11 11:23:26
44	HAROUN TAZIEF		2023-12-11 11:23:26	2023-12-11 11:23:26
45	J.M. DELVA		2023-12-11 11:23:26	2023-12-11 11:23:26
46	EMMANUEL   RIOLET		2023-12-11 11:23:26	2023-12-11 11:23:26
47	MANUEL   SOLAIRE		2023-12-11 11:23:26	2023-12-11 11:23:26
48	U.E.  STEMPEL		2023-12-11 11:23:26	2023-12-11 11:23:26
49	ABOUBACAR  NAMODA		2023-12-11 11:23:26	2023-12-11 11:23:26
50	FRANCIS  NASSIET		2023-12-11 11:23:26	2023-12-11 11:23:26
51	ALAIN  ROSSIGNOL		2023-12-11 11:23:26	2023-12-11 11:23:26
52	COLLECTION   ILETOU    YAOVI		2023-12-11 11:23:27	2023-12-11 11:23:27
53	EDITH     ARCHAMBAULT		2023-12-11 11:23:27	2023-12-11 11:23:27
54	PATRICK    PIGET		2023-12-11 11:23:27	2023-12-11 11:23:27
55	CLAUDE    PEROCHON		2023-12-11 11:23:27	2023-12-11 11:23:27
56	HYPPOLYTE A. AGBONON		2023-12-11 11:23:27	2023-12-11 11:23:27
57	ETIENNE   KOMLAN   DENAKPO		2023-12-11 11:23:27	2023-12-11 11:23:27
58	AKAKPO  AYAOVI  DANIEL		2023-12-11 11:23:27	2023-12-11 11:23:27
59	ILETOU    YAOVI		2023-12-11 11:23:27	2023-12-11 11:23:27
60	JACQUES  CALVET		2023-12-11 11:23:27	2023-12-11 11:23:27
61	ANICK  ANNEQUIN -BRILLANT		2023-12-11 11:23:27	2023-12-11 11:23:27
62	INNOCENT  KOSSI  NUNYABU		2023-12-11 11:23:27	2023-12-11 11:23:27
63	ADOHOUN  FOFO VITUS		2023-12-11 11:23:27	2023-12-11 11:23:27
64	MAURICE  COZIAN		2023-12-11 11:23:27	2023-12-11 11:23:27
65	CHARLOTTE   DISLE		2023-12-11 11:23:27	2023-12-11 11:23:27
66	ALAIN  HAUSSAIRE		2023-12-11 11:23:27	2023-12-11 11:23:27
67	JEAN-FRANçOIS BOCQUILLON		2023-12-11 11:23:27	2023-12-11 11:23:27
68	ANNE -MARIE  BRéMOND		2023-12-11 11:23:27	2023-12-11 11:23:27
69	MOISE  AGBODJOGBE		2023-12-11 11:23:27	2023-12-11 11:23:27
70	SYLVIE   BARON		2023-12-11 11:23:27	2023-12-11 11:23:27
71	BRIGITTE  DORIATH		2023-12-11 11:23:27	2023-12-11 11:23:27
72	MARIE -JOSE  CHACON		2023-12-11 11:23:27	2023-12-11 11:23:27
73	MARIE -JOSE   CHACON		2023-12-11 11:23:27	2023-12-11 11:23:27
74	SYLVIE  BENOIT		2023-12-11 11:23:27	2023-12-11 11:23:27
75	SYLVIE   BENOIT		2023-12-11 11:23:27	2023-12-11 11:23:27
76	JEAN -PAUL  MARGERIN		2023-12-11 11:23:27	2023-12-11 11:23:27
77	DEROCHE  LOUIS		2023-12-11 11:23:27	2023-12-11 11:23:27
78	JEAN -PAUL   MARGERIN		2023-12-11 11:23:27	2023-12-11 11:23:27
79	BIZE  VéRONIQUE		2023-12-11 11:23:27	2023-12-11 11:23:27
80	JEAN - PIERRE		2023-12-11 11:23:27	2023-12-11 11:23:27
81	SALIOU TOURé		2023-12-11 11:23:27	2023-12-11 11:23:27
82	JEAN - PAUL  BELTRAMONE		2023-12-11 11:23:27	2023-12-11 11:23:27
83	JEAN  -PAUL  BOUVIER		2023-12-11 11:23:27	2023-12-11 11:23:27
84	JEAN  PIERRE  BOUVIER		2023-12-11 11:23:27	2023-12-11 11:23:27
85	SERGE GOUIN		2023-12-11 11:23:27	2023-12-11 11:23:27
86	PIERRE   BRAMAND		2023-12-11 11:23:27	2023-12-11 11:23:27
87	SALAHOU  SIKIROU		2023-12-11 11:23:27	2023-12-11 11:23:27
88	PIERRE  BRAMAND		2023-12-11 11:23:27	2023-12-11 11:23:27
89	A.DURUPTHY		2023-12-11 11:23:27	2023-12-11 11:23:27
90	A. DURUPTHY		2023-12-11 11:23:27	2023-12-11 11:23:27
91	R.  BAUTRANT		2023-12-11 11:23:27	2023-12-11 11:23:27
92	NANZOUAN SILUE  PATRICE		2023-12-11 11:23:27	2023-12-11 11:23:27
93	RENE   GENTRIC		2023-12-11 11:23:27	2023-12-11 11:23:27
94	BERNARD  VERLANT		2023-12-11 11:23:27	2023-12-11 11:23:27
95	R.KELANI		2023-12-11 11:23:27	2023-12-11 11:23:27
96	I.GADO		2023-12-11 11:23:27	2023-12-11 11:23:27
97	PH.D.		2023-12-11 11:23:27	2023-12-11 11:23:27
98	MARC  M.AHOUNOU		2023-12-11 11:23:27	2023-12-11 11:23:27
99	GRACE  DOSSA		2023-12-11 11:23:27	2023-12-11 11:23:27
100	GRACE DOSSA		2023-12-11 11:23:27	2023-12-11 11:23:27
101	SAîDOU   BOLARIWA		2023-12-11 11:23:27	2023-12-11 11:23:27
102	SYLVAIN ATOHOUN		2023-12-11 11:23:27	2023-12-11 11:23:27
103	NOEL   PADONOU		2023-12-11 11:23:27	2023-12-11 11:23:27
104	NOEL PADONOU		2023-12-11 11:23:27	2023-12-11 11:23:27
105	A. T. GéRARD		2023-12-11 11:23:27	2023-12-11 11:23:27
106	SOPHIE PAILLOUX-RIGGI		2023-12-11 11:23:27	2023-12-11 11:23:27
107	RAYMOND FLEURAT-LESSARD		2023-12-11 11:23:27	2023-12-11 11:23:27
108	M. NOUTSOHO DANDO		2023-12-11 11:23:27	2023-12-11 11:23:27
109	M. IRENéE DANTON		2023-12-11 11:23:27	2023-12-11 11:23:27
110	HOUNTO-ADA NAZAIRE		2023-12-11 11:23:27	2023-12-11 11:23:27
111	GRACE  DOSSOU		2023-12-11 11:23:27	2023-12-11 11:23:27
112	MESSA - GAVO  KOFFI ENYONAM		2023-12-11 11:23:27	2023-12-11 11:23:27
113	VINCENT DOSSEY ADDORH		2023-12-11 11:23:27	2023-12-11 11:23:27
114	VINCENT  DOSSEY ADDORH		2023-12-11 11:23:28	2023-12-11 11:23:28
115	A.T.GéRARD		2023-12-11 11:23:28	2023-12-11 11:23:28
116	JOHN   SMITH		2023-12-11 11:23:28	2023-12-11 11:23:28
117	GERARD  HARDING		2023-12-11 11:23:28	2023-12-11 11:23:28
118	JéROME GRENOUX		2023-12-11 11:23:28	2023-12-11 11:23:28
119	MOUSSA  ANOUMATACKY		2023-12-11 11:23:28	2023-12-11 11:23:28
120	H.W.KLEN		2023-12-11 11:23:28	2023-12-11 11:23:28
121	KOUAME   BENOIT		2023-12-11 11:23:28	2023-12-11 11:23:28
122	SEYNI DIAGNE DIOP		2023-12-11 11:23:28	2023-12-11 11:23:28
123	MONIKA BEUTTER		2023-12-11 11:23:28	2023-12-11 11:23:28
124	HANS G.BAUER		2023-12-11 11:23:28	2023-12-11 11:23:28
125	CHRISTIAN   MEUNIER		2023-12-11 11:23:28	2023-12-11 11:23:28
126	WOLFGANG  ADER		2023-12-11 11:23:28	2023-12-11 11:23:28
127	MANZ -LERNHILFEN		2023-12-11 11:23:28	2023-12-11 11:23:28
128	SCHUMANN  ADELHEID		2023-12-11 11:23:28	2023-12-11 11:23:28
129	GHISLAINE WARDAVOIR		2023-12-11 11:23:28	2023-12-11 11:23:28
130	ALOIS MAYER		2023-12-11 11:23:28	2023-12-11 11:23:28
131	WALTER SPIEGELBERG		2023-12-11 11:23:28	2023-12-11 11:23:28
132	RUDOLF HILDEBRANDT		2023-12-11 11:23:28	2023-12-11 11:23:28
133	BERND  GRUNWALD		2023-12-11 11:23:28	2023-12-11 11:23:28
134	ERNST KEMMNER		2023-12-11 11:23:28	2023-12-11 11:23:28
135	ALFRED GOLLER		2023-12-11 11:23:28	2023-12-11 11:23:28
136	WOLFGANG SPENGLER		2023-12-11 11:23:28	2023-12-11 11:23:28
137	CATHERINE JAULGEY		2023-12-11 11:23:28	2023-12-11 11:23:28
138	CHRISTIAN MAUNIER		2023-12-11 11:23:28	2023-12-11 11:23:28
139	DIETER KUNERT		2023-12-11 11:23:28	2023-12-11 11:23:28
140	ULRIKE KUNERT		2023-12-11 11:23:28	2023-12-11 11:23:28
141	SUSANNE SCHWARZ		2023-12-11 11:23:28	2023-12-11 11:23:28
142	ULRIKE FEZER		2023-12-11 11:23:28	2023-12-11 11:23:28
143	METZINGEN		2023-12-11 11:23:28	2023-12-11 11:23:28
144	PETER BAYER		2023-12-11 11:23:28	2023-12-11 11:23:28
145	SCHWALMTAL		2023-12-11 11:23:28	2023-12-11 11:23:28
146	WOLFGANG  SPENGLER		2023-12-11 11:23:28	2023-12-11 11:23:28
147	HELGA HERRMAN		2023-12-11 11:23:28	2023-12-11 11:23:28
148	RéNé TANTCHOU DJAKOU		2023-12-11 11:23:28	2023-12-11 11:23:28
149	NOELLE GIDON		2023-12-11 11:23:28	2023-12-11 11:23:28
150	LAURO CAPDEVILA		2023-12-11 11:23:28	2023-12-11 11:23:28
151	GEORGES ULYSSE		2023-12-11 11:23:28	2023-12-11 11:23:28
152	NICOUé.LODJOU. GAYIBOR		2023-12-11 11:23:28	2023-12-11 11:23:28
153	NICOUé LODJOU GAYIBOR		2023-12-11 11:23:28	2023-12-11 11:23:28
154	RENé DJAKOU   TANTCHOU		2023-12-11 11:23:28	2023-12-11 11:23:28
155	RENé DJAKOU  TANTCHOU		2023-12-11 11:23:28	2023-12-11 11:23:28
156	RéNé  DJAKOU  TANTCHOU		2023-12-11 11:23:28	2023-12-11 11:23:28
157	IPAM		2023-12-11 11:23:28	2023-12-11 11:23:28
158	STéPHAN ARIAS		2023-12-11 11:23:28	2023-12-11 11:23:28
159	ERIC CHAUDRON		2023-12-11 11:23:28	2023-12-11 11:23:28
160	MARTIN IVERNEL		2023-12-11 11:23:28	2023-12-11 11:23:28
161	ABOUDERMANE  S.GNON-KONDE		2023-12-11 11:23:28	2023-12-11 11:23:28
162	GISèLE CHAPIRON		2023-12-11 11:23:28	2023-12-11 11:23:28
163	M.MORY DOUMBIA		2023-12-11 11:23:28	2023-12-11 11:23:28
164	J.P.DURANDEAU		2023-12-11 11:23:28	2023-12-11 11:23:28
165	JACQUES JOURDAN		2023-12-11 11:23:28	2023-12-11 11:23:28
166	EKPAKPO  AGBEKO		2023-12-11 11:23:28	2023-12-11 11:23:28
167	EKPAKPO AGBéKO		2023-12-11 11:23:28	2023-12-11 11:23:28
168	EKPAKPO  AGBéKO		2023-12-11 11:23:28	2023-12-11 11:23:28
169	EKPAKPO   AGBéKO		2023-12-11 11:23:29	2023-12-11 11:23:29
170	MEZODE  O. AGBA		2023-12-11 11:23:29	2023-12-11 11:23:29
171	MEZODE O. AGBA		2023-12-11 11:23:29	2023-12-11 11:23:29
172	CHANTAL   BERTAGNA		2023-12-11 11:23:29	2023-12-11 11:23:29
173	PHILIPPE   DOMINIQUE		2023-12-11 11:23:29	2023-12-11 11:23:29
174	MICHEL DEGUY		2023-12-11 11:23:29	2023-12-11 11:23:29
175	ROBERT DAVREU		2023-12-11 11:23:29	2023-12-11 11:23:29
176	JACQUEY MARIE-CLOTILDE		2023-12-11 11:23:29	2023-12-11 11:23:29
177	DAVID  MILLS		2023-12-11 11:23:29	2023-12-11 11:23:29
178	DAVID   MILLS		2023-12-11 11:23:29	2023-12-11 11:23:29
179	DAVID MILLS		2023-12-11 11:23:29	2023-12-11 11:23:29
180	BESCHERELLE		2023-12-11 11:23:29	2023-12-11 11:23:29
181	MESSA -GAVO		2023-12-11 11:23:29	2023-12-11 11:23:29
182	KOFFI ENYONAM MARC-J.		2023-12-11 11:23:29	2023-12-11 11:23:29
183	EDOOUARD BLED		2023-12-11 11:23:29	2023-12-11 11:23:29
184	GISèLE PRESTAT		2023-12-11 11:23:29	2023-12-11 11:23:29
185	ALAN DAVIES		2023-12-11 11:23:29	2023-12-11 11:23:29
186	YVES FURET		2023-12-11 11:23:29	2023-12-11 11:23:29
187	GéRARD GUTLE		2023-12-11 11:23:29	2023-12-11 11:23:29
188	GISèLE		2023-12-11 11:23:29	2023-12-11 11:23:29
189	ROBERT PREFONTAINE		2023-12-11 11:23:29	2023-12-11 11:23:29
190	ALBIN MICHEL  COLLèCTION		2023-12-11 11:23:29	2023-12-11 11:23:29
191	MONIQUE CALLAMAND		2023-12-11 11:23:29	2023-12-11 11:23:29
192	MICHèLE BOULARES		2023-12-11 11:23:29	2023-12-11 11:23:29
193	ODETTE DELORME		2023-12-11 11:23:29	2023-12-11 11:23:29
194	GUY CAPELLE		2023-12-11 11:23:29	2023-12-11 11:23:29
195	NOELLE  GIDON		2023-12-11 11:23:29	2023-12-11 11:23:29
196	SYLVIE  PONS		2023-12-11 11:23:29	2023-12-11 11:23:29
197	CHARLES  PERRAULT		2023-12-11 11:23:29	2023-12-11 11:23:29
198	YAMINA KACIMI		2023-12-11 11:23:29	2023-12-11 11:23:29
199	CHRISTOPHE LONGUET		2023-12-11 11:23:29	2023-12-11 11:23:29
200	UNICEF		2023-12-11 11:23:29	2023-12-11 11:23:29
201	HCDH		2023-12-11 11:23:29	2023-12-11 11:23:29
202	BRUNO FRANçOIS		2023-12-11 11:23:29	2023-12-11 11:23:29
203	PASCAL GARREAU		2023-12-11 11:23:29	2023-12-11 11:23:29
204	WERNER KRAFT		2023-12-11 11:23:29	2023-12-11 11:23:29
205	BRIGITTE MIKLITZ-KRAFT		2023-12-11 11:23:29	2023-12-11 11:23:29
206	CHRISTIAN  LABROUSSE		2023-12-11 11:23:30	2023-12-11 11:23:30
207	JEAN-MICHEL ROYER		2023-12-11 11:23:30	2023-12-11 11:23:30
208	DENIS LANGLOIS		2023-12-11 11:23:30	2023-12-11 11:23:30
209	FRéDéRIC CHAUSSOY		2023-12-11 11:23:30	2023-12-11 11:23:30
210	CLAUDE NJIKE -BERGERET		2023-12-11 11:23:30	2023-12-11 11:23:30
211	PTRICK   DILS		2023-12-11 11:23:30	2023-12-11 11:23:30
212	JEAN -PAUL  VERMES		2023-12-11 11:23:30	2023-12-11 11:23:30
213	ROBERT T.KIYOSAKI		2023-12-11 11:23:30	2023-12-11 11:23:30
214	ERGUN CAPAN		2023-12-11 11:23:30	2023-12-11 11:23:30
215	M.FETHULLAH GULEN		2023-12-11 11:23:30	2023-12-11 11:23:30
216	V.S.NAIPAUL		2023-12-11 11:23:30	2023-12-11 11:23:30
217	DOMINIQUE   LAPIERRE		2023-12-11 11:23:30	2023-12-11 11:23:30
218	ALFRED  METRAUX		2023-12-11 11:23:30	2023-12-11 11:23:30
219	MAREL  MAUSS		2023-12-11 11:23:30	2023-12-11 11:23:30
220	L.WALRAS		2023-12-11 11:23:30	2023-12-11 11:23:30
221	V. PARETO		2023-12-11 11:23:30	2023-12-11 11:23:30
222	PIERRE-BERNARD  COUSTE		2023-12-11 11:23:30	2023-12-11 11:23:30
223	ANNICK OGER-STEFANINK		2023-12-11 11:23:30	2023-12-11 11:23:30
224	ROSELYNE MESSAGER ET MARIE-JEANNE MINISCLOUX		2023-12-11 11:23:30	2023-12-11 11:23:30
225	DOMMINIQUE  LAPPIERRE		2023-12-11 11:23:30	2023-12-11 11:23:30
226	ANDRé  PAITRIER		2023-12-11 11:23:30	2023-12-11 11:23:30
227	NICOLAS  DOMENACH		2023-12-11 11:23:30	2023-12-11 11:23:30
228	MAURICE  SZANFRAN		2023-12-11 11:23:30	2023-12-11 11:23:30
229	TIPHAINE  PELé		2023-12-11 11:23:30	2023-12-11 11:23:30
230	BERNARD  LESCOT		2023-12-11 11:23:30	2023-12-11 11:23:30
231	JEAN -JACQUES		2023-12-11 11:23:30	2023-12-11 11:23:30
232	SERVAN -SCHREIBER		2023-12-11 11:23:30	2023-12-11 11:23:30
233	GEORGE  RUDé		2023-12-11 11:23:30	2023-12-11 11:23:30
234	DIDIER  DUMAS		2023-12-11 11:23:30	2023-12-11 11:23:30
235	FRANçOISE  DOLTO		2023-12-11 11:23:30	2023-12-11 11:23:30
236	ROBERT SHNEIDER		2023-12-11 11:23:30	2023-12-11 11:23:30
237	GUY DE MAUPASSANT		2023-12-11 11:23:30	2023-12-11 11:23:30
238	BESTY  HAYNES		2023-12-11 11:23:30	2023-12-11 11:23:30
239	CHRISTIPHE  HONORE		2023-12-11 11:23:30	2023-12-11 11:23:30
240	ANDRé   BARBIER		2023-12-11 11:23:30	2023-12-11 11:23:30
241	PIERRE  ANTILOGUS		2023-12-11 11:23:30	2023-12-11 11:23:30
242	JEAN -LOUIS  FESTJENS		2023-12-11 11:23:30	2023-12-11 11:23:30
243	LAURENT   RUQUIER		2023-12-11 11:23:30	2023-12-11 11:23:30
244	ALAIN   MINC		2023-12-11 11:23:30	2023-12-11 11:23:30
245	MICHEL  ALBERT		2023-12-11 11:23:30	2023-12-11 11:23:30
246	JEAN  BOISSONNA		2023-12-11 11:23:30	2023-12-11 11:23:30
247	KOUDOUFIO   COMLAVI   PASCAL		2023-12-11 11:23:30	2023-12-11 11:23:30
248	KOUDOUFIO  COMLAVI   PASCAL		2023-12-11 11:23:30	2023-12-11 11:23:30
249	KOUDOUFIO   COMLAVI  PASCAL		2023-12-11 11:23:30	2023-12-11 11:23:30
250	SIMONE  SIGNORET		2023-12-11 11:23:30	2023-12-11 11:23:30
251	SIGMUND  FREUD		2023-12-11 11:23:30	2023-12-11 11:23:30
252	RAYMOND  ARON		2023-12-11 11:23:30	2023-12-11 11:23:30
253	EMMANUEL  KANT		2023-12-11 11:23:30	2023-12-11 11:23:30
254	A.MAYER		2023-12-11 11:23:30	2023-12-11 11:23:30
255	ANTOINE DE SAINT-EXUPéRY		2023-12-11 11:23:30	2023-12-11 11:23:30
256	JEAN-PAUL  SARTRE		2023-12-11 11:23:30	2023-12-11 11:23:30
257	HANNAH  GREEN		2023-12-11 11:23:30	2023-12-11 11:23:30
258	GEORGES   PASCAL		2023-12-11 11:23:30	2023-12-11 11:23:30
259	YVES DE SAINT -AGNES		2023-12-11 11:23:30	2023-12-11 11:23:30
260	BACHAGA  BOUALAM		2023-12-11 11:23:30	2023-12-11 11:23:30
261	ALAIN   PEYREFITTE		2023-12-11 11:23:30	2023-12-11 11:23:30
262	ARSèNE CHASSANG		2023-12-11 11:23:30	2023-12-11 11:23:30
263	CHARLES SENNINGER		2023-12-11 11:23:30	2023-12-11 11:23:30
264	JOSTEIN GAARDER		2023-12-11 11:23:30	2023-12-11 11:23:30
265	DENIS DE ROUGEMONT		2023-12-11 11:23:30	2023-12-11 11:23:30
266	ALAIN		2023-12-11 11:23:31	2023-12-11 11:23:31
267	MIRCEA  ELIADE		2023-12-11 11:23:31	2023-12-11 11:23:31
268	GéRARD  NOIRIEL		2023-12-11 11:23:31	2023-12-11 11:23:31
269	PLATON		2023-12-11 11:23:31	2023-12-11 11:23:31
270	KARL   JASPERS		2023-12-11 11:23:31	2023-12-11 11:23:31
271	THERRY   FABRE		2023-12-11 11:23:31	2023-12-11 11:23:31
272	DESCARTES		2023-12-11 11:23:31	2023-12-11 11:23:31
273	FELIX  GUIRAND		2023-12-11 11:23:31	2023-12-11 11:23:31
274	LEON  LEJEALLE		2023-12-11 11:23:31	2023-12-11 11:23:31
275	LEON LEJEALLE		2023-12-11 11:23:31	2023-12-11 11:23:31
276	DOCTEUR  ANNE  CABAU		2023-12-11 11:23:31	2023-12-11 11:23:31
277	SELENE YEAGER		2023-12-11 11:23:31	2023-12-11 11:23:31
278	JEAN  PLIYA		2023-12-11 11:23:31	2023-12-11 11:23:31
279	JANE  SULLIVAN		2023-12-11 11:23:31	2023-12-11 11:23:31
280	ELLEN G.WHITE		2023-12-11 11:23:31	2023-12-11 11:23:31
281	GEORGES D.PAMPLONA-ROGGER		2023-12-11 11:23:31	2023-12-11 11:23:31
282	DR ERNST SCHNEIDER		2023-12-11 11:23:31	2023-12-11 11:23:31
283	JULIAN    MELGOSA		2023-12-11 11:23:31	2023-12-11 11:23:31
284	JULIAN  MELGOSA		2023-12-11 11:23:31	2023-12-11 11:23:31
285	LIDIA LA MARCA		2023-12-11 11:23:31	2023-12-11 11:23:31
286	LAURENCE   PERNOUD		2023-12-11 11:23:31	2023-12-11 11:23:31
287	LAROUSSE		2023-12-11 11:23:31	2023-12-11 11:23:31
288	CLAUDE   AVELINE		2023-12-11 11:23:31	2023-12-11 11:23:31
289	SAINT  FRANçOIS  DE SALES		2023-12-11 11:23:31	2023-12-11 11:23:31
290	DIRECTOIR		2023-12-11 11:23:31	2023-12-11 11:23:31
291	SAINT  JEAN DE LA CROIX		2023-12-11 11:23:31	2023-12-11 11:23:31
292	ROMAIN   GARY		2023-12-11 11:23:31	2023-12-11 11:23:31
293	EMILE  AJAR		2023-12-11 11:23:31	2023-12-11 11:23:31
294	PAR   LAGERKVIST		2023-12-11 11:23:31	2023-12-11 11:23:31
295	TRUE   HAPPINES		2023-12-11 11:23:31	2023-12-11 11:23:31
296	CAN  BE YOURS		2023-12-11 11:23:31	2023-12-11 11:23:31
297	RUDI   LACK		2023-12-11 11:23:31	2023-12-11 11:23:31
298	kondi	kondi	2023-12-11 11:42:41	2023-12-11 11:42:41
299	kondi	kondi	2023-12-11 11:44:22	2023-12-11 11:44:22
300	kondi	kondi	2023-12-11 11:44:47	2023-12-11 11:44:47
\.


--
-- Data for Name: auteurs_ouvrages; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.auteurs_ouvrages (id_auteur, id_ouvrage, created_at, updated_at) FROM stdin;
2	1	2023-12-11 11:23:26	2023-12-11 11:23:26
2	2	2023-12-11 11:23:26	2023-12-11 11:23:26
4	3	2023-12-11 11:23:26	2023-12-11 11:23:26
5	4	2023-12-11 11:23:26	2023-12-11 11:23:26
5	5	2023-12-11 11:23:26	2023-12-11 11:23:26
5	6	2023-12-11 11:23:26	2023-12-11 11:23:26
6	7	2023-12-11 11:23:26	2023-12-11 11:23:26
6	8	2023-12-11 11:23:26	2023-12-11 11:23:26
7	9	2023-12-11 11:23:26	2023-12-11 11:23:26
4	10	2023-12-11 11:23:26	2023-12-11 11:23:26
8	11	2023-12-11 11:23:26	2023-12-11 11:23:26
8	12	2023-12-11 11:23:26	2023-12-11 11:23:26
9	13	2023-12-11 11:23:26	2023-12-11 11:23:26
10	14	2023-12-11 11:23:26	2023-12-11 11:23:26
11	15	2023-12-11 11:23:26	2023-12-11 11:23:26
12	16	2023-12-11 11:23:26	2023-12-11 11:23:26
13	17	2023-12-11 11:23:26	2023-12-11 11:23:26
14	18	2023-12-11 11:23:26	2023-12-11 11:23:26
15	19	2023-12-11 11:23:26	2023-12-11 11:23:26
16	20	2023-12-11 11:23:26	2023-12-11 11:23:26
17	21	2023-12-11 11:23:26	2023-12-11 11:23:26
18	22	2023-12-11 11:23:26	2023-12-11 11:23:26
19	23	2023-12-11 11:23:26	2023-12-11 11:23:26
20	24	2023-12-11 11:23:26	2023-12-11 11:23:26
21	25	2023-12-11 11:23:26	2023-12-11 11:23:26
22	26	2023-12-11 11:23:26	2023-12-11 11:23:26
23	27	2023-12-11 11:23:26	2023-12-11 11:23:26
24	28	2023-12-11 11:23:26	2023-12-11 11:23:26
25	29	2023-12-11 11:23:26	2023-12-11 11:23:26
26	30	2023-12-11 11:23:26	2023-12-11 11:23:26
27	31	2023-12-11 11:23:26	2023-12-11 11:23:26
28	32	2023-12-11 11:23:26	2023-12-11 11:23:26
29	33	2023-12-11 11:23:26	2023-12-11 11:23:26
30	34	2023-12-11 11:23:26	2023-12-11 11:23:26
31	35	2023-12-11 11:23:26	2023-12-11 11:23:26
32	36	2023-12-11 11:23:26	2023-12-11 11:23:26
33	37	2023-12-11 11:23:26	2023-12-11 11:23:26
34	38	2023-12-11 11:23:26	2023-12-11 11:23:26
35	39	2023-12-11 11:23:26	2023-12-11 11:23:26
36	40	2023-12-11 11:23:26	2023-12-11 11:23:26
37	41	2023-12-11 11:23:26	2023-12-11 11:23:26
39	42	2023-12-11 11:23:26	2023-12-11 11:23:26
40	43	2023-12-11 11:23:26	2023-12-11 11:23:26
41	44	2023-12-11 11:23:26	2023-12-11 11:23:26
41	45	2023-12-11 11:23:26	2023-12-11 11:23:26
41	46	2023-12-11 11:23:26	2023-12-11 11:23:26
41	47	2023-12-11 11:23:26	2023-12-11 11:23:26
42	48	2023-12-11 11:23:26	2023-12-11 11:23:26
43	49	2023-12-11 11:23:26	2023-12-11 11:23:26
44	50	2023-12-11 11:23:26	2023-12-11 11:23:26
42	51	2023-12-11 11:23:26	2023-12-11 11:23:26
45	52	2023-12-11 11:23:26	2023-12-11 11:23:26
46	53	2023-12-11 11:23:26	2023-12-11 11:23:26
47	54	2023-12-11 11:23:26	2023-12-11 11:23:26
48	55	2023-12-11 11:23:26	2023-12-11 11:23:26
49	56	2023-12-11 11:23:26	2023-12-11 11:23:26
42	57	2023-12-11 11:23:26	2023-12-11 11:23:26
50	58	2023-12-11 11:23:26	2023-12-11 11:23:26
51	59	2023-12-11 11:23:27	2023-12-11 11:23:27
52	60	2023-12-11 11:23:27	2023-12-11 11:23:27
53	61	2023-12-11 11:23:27	2023-12-11 11:23:27
54	62	2023-12-11 11:23:27	2023-12-11 11:23:27
55	63	2023-12-11 11:23:27	2023-12-11 11:23:27
56	64	2023-12-11 11:23:27	2023-12-11 11:23:27
56	65	2023-12-11 11:23:27	2023-12-11 11:23:27
57	66	2023-12-11 11:23:27	2023-12-11 11:23:27
57	67	2023-12-11 11:23:27	2023-12-11 11:23:27
58	68	2023-12-11 11:23:27	2023-12-11 11:23:27
58	69	2023-12-11 11:23:27	2023-12-11 11:23:27
58	70	2023-12-11 11:23:27	2023-12-11 11:23:27
59	71	2023-12-11 11:23:27	2023-12-11 11:23:27
60	72	2023-12-11 11:23:27	2023-12-11 11:23:27
61	73	2023-12-11 11:23:27	2023-12-11 11:23:27
61	74	2023-12-11 11:23:27	2023-12-11 11:23:27
61	75	2023-12-11 11:23:27	2023-12-11 11:23:27
62	76	2023-12-11 11:23:27	2023-12-11 11:23:27
62	77	2023-12-11 11:23:27	2023-12-11 11:23:27
63	78	2023-12-11 11:23:27	2023-12-11 11:23:27
64	79	2023-12-11 11:23:27	2023-12-11 11:23:27
56	80	2023-12-11 11:23:27	2023-12-11 11:23:27
65	81	2023-12-11 11:23:27	2023-12-11 11:23:27
66	82	2023-12-11 11:23:27	2023-12-11 11:23:27
67	83	2023-12-11 11:23:27	2023-12-11 11:23:27
68	84	2023-12-11 11:23:27	2023-12-11 11:23:27
69	85	2023-12-11 11:23:27	2023-12-11 11:23:27
70	86	2023-12-11 11:23:27	2023-12-11 11:23:27
71	87	2023-12-11 11:23:27	2023-12-11 11:23:27
72	88	2023-12-11 11:23:27	2023-12-11 11:23:27
73	89	2023-12-11 11:23:27	2023-12-11 11:23:27
74	90	2023-12-11 11:23:27	2023-12-11 11:23:27
75	91	2023-12-11 11:23:27	2023-12-11 11:23:27
76	92	2023-12-11 11:23:27	2023-12-11 11:23:27
77	93	2023-12-11 11:23:27	2023-12-11 11:23:27
78	94	2023-12-11 11:23:27	2023-12-11 11:23:27
79	95	2023-12-11 11:23:27	2023-12-11 11:23:27
80	96	2023-12-11 11:23:27	2023-12-11 11:23:27
81	97	2023-12-11 11:23:27	2023-12-11 11:23:27
81	98	2023-12-11 11:23:27	2023-12-11 11:23:27
82	99	2023-12-11 11:23:27	2023-12-11 11:23:27
83	100	2023-12-11 11:23:27	2023-12-11 11:23:27
84	101	2023-12-11 11:23:27	2023-12-11 11:23:27
81	102	2023-12-11 11:23:27	2023-12-11 11:23:27
50	103	2023-12-11 11:23:27	2023-12-11 11:23:27
85	104	2023-12-11 11:23:27	2023-12-11 11:23:27
81	105	2023-12-11 11:23:27	2023-12-11 11:23:27
81	106	2023-12-11 11:23:27	2023-12-11 11:23:27
81	107	2023-12-11 11:23:27	2023-12-11 11:23:27
81	108	2023-12-11 11:23:27	2023-12-11 11:23:27
81	109	2023-12-11 11:23:27	2023-12-11 11:23:27
81	110	2023-12-11 11:23:27	2023-12-11 11:23:27
81	111	2023-12-11 11:23:27	2023-12-11 11:23:27
81	112	2023-12-11 11:23:27	2023-12-11 11:23:27
86	113	2023-12-11 11:23:27	2023-12-11 11:23:27
87	114	2023-12-11 11:23:27	2023-12-11 11:23:27
87	115	2023-12-11 11:23:27	2023-12-11 11:23:27
88	116	2023-12-11 11:23:27	2023-12-11 11:23:27
89	117	2023-12-11 11:23:27	2023-12-11 11:23:27
90	118	2023-12-11 11:23:27	2023-12-11 11:23:27
91	119	2023-12-11 11:23:27	2023-12-11 11:23:27
92	120	2023-12-11 11:23:27	2023-12-11 11:23:27
93	121	2023-12-11 11:23:27	2023-12-11 11:23:27
94	122	2023-12-11 11:23:27	2023-12-11 11:23:27
95	123	2023-12-11 11:23:27	2023-12-11 11:23:27
97	124	2023-12-11 11:23:27	2023-12-11 11:23:27
98	125	2023-12-11 11:23:27	2023-12-11 11:23:27
99	126	2023-12-11 11:23:27	2023-12-11 11:23:27
100	127	2023-12-11 11:23:27	2023-12-11 11:23:27
101	128	2023-12-11 11:23:27	2023-12-11 11:23:27
101	129	2023-12-11 11:23:27	2023-12-11 11:23:27
102	130	2023-12-11 11:23:27	2023-12-11 11:23:27
103	131	2023-12-11 11:23:27	2023-12-11 11:23:27
103	132	2023-12-11 11:23:27	2023-12-11 11:23:27
97	133	2023-12-11 11:23:27	2023-12-11 11:23:27
104	134	2023-12-11 11:23:27	2023-12-11 11:23:27
41	135	2023-12-11 11:23:27	2023-12-11 11:23:27
105	136	2023-12-11 11:23:27	2023-12-11 11:23:27
106	137	2023-12-11 11:23:27	2023-12-11 11:23:27
106	138	2023-12-11 11:23:27	2023-12-11 11:23:27
107	139	2023-12-11 11:23:27	2023-12-11 11:23:27
108	140	2023-12-11 11:23:27	2023-12-11 11:23:27
109	141	2023-12-11 11:23:27	2023-12-11 11:23:27
110	142	2023-12-11 11:23:27	2023-12-11 11:23:27
110	143	2023-12-11 11:23:27	2023-12-11 11:23:27
111	144	2023-12-11 11:23:27	2023-12-11 11:23:27
112	145	2023-12-11 11:23:27	2023-12-11 11:23:27
113	146	2023-12-11 11:23:27	2023-12-11 11:23:27
113	147	2023-12-11 11:23:27	2023-12-11 11:23:27
113	148	2023-12-11 11:23:27	2023-12-11 11:23:27
41	149	2023-12-11 11:23:27	2023-12-11 11:23:27
113	150	2023-12-11 11:23:27	2023-12-11 11:23:27
114	151	2023-12-11 11:23:28	2023-12-11 11:23:28
115	152	2023-12-11 11:23:28	2023-12-11 11:23:28
116	153	2023-12-11 11:23:28	2023-12-11 11:23:28
117	154	2023-12-11 11:23:28	2023-12-11 11:23:28
118	155	2023-12-11 11:23:28	2023-12-11 11:23:28
119	156	2023-12-11 11:23:28	2023-12-11 11:23:28
120	157	2023-12-11 11:23:28	2023-12-11 11:23:28
121	158	2023-12-11 11:23:28	2023-12-11 11:23:28
122	159	2023-12-11 11:23:28	2023-12-11 11:23:28
123	160	2023-12-11 11:23:28	2023-12-11 11:23:28
124	161	2023-12-11 11:23:28	2023-12-11 11:23:28
124	162	2023-12-11 11:23:28	2023-12-11 11:23:28
125	163	2023-12-11 11:23:28	2023-12-11 11:23:28
126	164	2023-12-11 11:23:28	2023-12-11 11:23:28
127	165	2023-12-11 11:23:28	2023-12-11 11:23:28
128	166	2023-12-11 11:23:28	2023-12-11 11:23:28
129	167	2023-12-11 11:23:28	2023-12-11 11:23:28
130	168	2023-12-11 11:23:28	2023-12-11 11:23:28
132	170	2023-12-11 11:23:28	2023-12-11 11:23:28
133	171	2023-12-11 11:23:28	2023-12-11 11:23:28
134	172	2023-12-11 11:23:28	2023-12-11 11:23:28
136	173	2023-12-11 11:23:28	2023-12-11 11:23:28
136	174	2023-12-11 11:23:28	2023-12-11 11:23:28
137	175	2023-12-11 11:23:28	2023-12-11 11:23:28
138	176	2023-12-11 11:23:28	2023-12-11 11:23:28
136	177	2023-12-11 11:23:28	2023-12-11 11:23:28
140	178	2023-12-11 11:23:28	2023-12-11 11:23:28
140	179	2023-12-11 11:23:28	2023-12-11 11:23:28
141	180	2023-12-11 11:23:28	2023-12-11 11:23:28
143	181	2023-12-11 11:23:28	2023-12-11 11:23:28
140	182	2023-12-11 11:23:28	2023-12-11 11:23:28
145	183	2023-12-11 11:23:28	2023-12-11 11:23:28
123	184	2023-12-11 11:23:28	2023-12-11 11:23:28
146	185	2023-12-11 11:23:28	2023-12-11 11:23:28
147	186	2023-12-11 11:23:28	2023-12-11 11:23:28
148	187	2023-12-11 11:23:28	2023-12-11 11:23:28
149	188	2023-12-11 11:23:28	2023-12-11 11:23:28
150	189	2023-12-11 11:23:28	2023-12-11 11:23:28
151	190	2023-12-11 11:23:28	2023-12-11 11:23:28
152	191	2023-12-11 11:23:28	2023-12-11 11:23:28
153	192	2023-12-11 11:23:28	2023-12-11 11:23:28
154	193	2023-12-11 11:23:28	2023-12-11 11:23:28
155	194	2023-12-11 11:23:28	2023-12-11 11:23:28
156	195	2023-12-11 11:23:28	2023-12-11 11:23:28
156	196	2023-12-11 11:23:28	2023-12-11 11:23:28
157	197	2023-12-11 11:23:28	2023-12-11 11:23:28
157	198	2023-12-11 11:23:28	2023-12-11 11:23:28
157	199	2023-12-11 11:23:28	2023-12-11 11:23:28
157	200	2023-12-11 11:23:28	2023-12-11 11:23:28
157	201	2023-12-11 11:23:28	2023-12-11 11:23:28
157	202	2023-12-11 11:23:28	2023-12-11 11:23:28
159	203	2023-12-11 11:23:28	2023-12-11 11:23:28
160	204	2023-12-11 11:23:28	2023-12-11 11:23:28
160	205	2023-12-11 11:23:28	2023-12-11 11:23:28
161	206	2023-12-11 11:23:28	2023-12-11 11:23:28
81	207	2023-12-11 11:23:28	2023-12-11 11:23:28
81	208	2023-12-11 11:23:28	2023-12-11 11:23:28
162	209	2023-12-11 11:23:28	2023-12-11 11:23:28
81	210	2023-12-11 11:23:28	2023-12-11 11:23:28
81	211	2023-12-11 11:23:28	2023-12-11 11:23:28
81	212	2023-12-11 11:23:28	2023-12-11 11:23:28
81	213	2023-12-11 11:23:28	2023-12-11 11:23:28
81	214	2023-12-11 11:23:28	2023-12-11 11:23:28
81	215	2023-12-11 11:23:28	2023-12-11 11:23:28
163	216	2023-12-11 11:23:28	2023-12-11 11:23:28
163	217	2023-12-11 11:23:28	2023-12-11 11:23:28
163	218	2023-12-11 11:23:28	2023-12-11 11:23:28
163	219	2023-12-11 11:23:28	2023-12-11 11:23:28
164	220	2023-12-11 11:23:28	2023-12-11 11:23:28
164	221	2023-12-11 11:23:28	2023-12-11 11:23:28
97	222	2023-12-11 11:23:28	2023-12-11 11:23:28
165	223	2023-12-11 11:23:28	2023-12-11 11:23:28
164	224	2023-12-11 11:23:28	2023-12-11 11:23:28
164	225	2023-12-11 11:23:28	2023-12-11 11:23:28
166	226	2023-12-11 11:23:28	2023-12-11 11:23:28
167	227	2023-12-11 11:23:28	2023-12-11 11:23:28
168	228	2023-12-11 11:23:28	2023-12-11 11:23:28
168	229	2023-12-11 11:23:29	2023-12-11 11:23:29
168	230	2023-12-11 11:23:29	2023-12-11 11:23:29
168	231	2023-12-11 11:23:29	2023-12-11 11:23:29
169	232	2023-12-11 11:23:29	2023-12-11 11:23:29
167	233	2023-12-11 11:23:29	2023-12-11 11:23:29
170	234	2023-12-11 11:23:29	2023-12-11 11:23:29
171	235	2023-12-11 11:23:29	2023-12-11 11:23:29
172	236	2023-12-11 11:23:29	2023-12-11 11:23:29
170	237	2023-12-11 11:23:29	2023-12-11 11:23:29
173	238	2023-12-11 11:23:29	2023-12-11 11:23:29
175	239	2023-12-11 11:23:29	2023-12-11 11:23:29
176	240	2023-12-11 11:23:29	2023-12-11 11:23:29
176	241	2023-12-11 11:23:29	2023-12-11 11:23:29
176	242	2023-12-11 11:23:29	2023-12-11 11:23:29
176	243	2023-12-11 11:23:29	2023-12-11 11:23:29
176	244	2023-12-11 11:23:29	2023-12-11 11:23:29
176	245	2023-12-11 11:23:29	2023-12-11 11:23:29
177	246	2023-12-11 11:23:29	2023-12-11 11:23:29
178	247	2023-12-11 11:23:29	2023-12-11 11:23:29
177	248	2023-12-11 11:23:29	2023-12-11 11:23:29
179	249	2023-12-11 11:23:29	2023-12-11 11:23:29
180	250	2023-12-11 11:23:29	2023-12-11 11:23:29
182	251	2023-12-11 11:23:29	2023-12-11 11:23:29
41	252	2023-12-11 11:23:29	2023-12-11 11:23:29
41	253	2023-12-11 11:23:29	2023-12-11 11:23:29
41	254	2023-12-11 11:23:29	2023-12-11 11:23:29
41	255	2023-12-11 11:23:29	2023-12-11 11:23:29
183	256	2023-12-11 11:23:29	2023-12-11 11:23:29
183	257	2023-12-11 11:23:29	2023-12-11 11:23:29
185	258	2023-12-11 11:23:29	2023-12-11 11:23:29
185	259	2023-12-11 11:23:29	2023-12-11 11:23:29
25	260	2023-12-11 11:23:29	2023-12-11 11:23:29
25	261	2023-12-11 11:23:29	2023-12-11 11:23:29
25	262	2023-12-11 11:23:29	2023-12-11 11:23:29
186	263	2023-12-11 11:23:29	2023-12-11 11:23:29
187	264	2023-12-11 11:23:29	2023-12-11 11:23:29
189	265	2023-12-11 11:23:29	2023-12-11 11:23:29
190	266	2023-12-11 11:23:29	2023-12-11 11:23:29
192	267	2023-12-11 11:23:29	2023-12-11 11:23:29
192	268	2023-12-11 11:23:29	2023-12-11 11:23:29
192	269	2023-12-11 11:23:29	2023-12-11 11:23:29
193	270	2023-12-11 11:23:29	2023-12-11 11:23:29
196	271	2023-12-11 11:23:29	2023-12-11 11:23:29
197	272	2023-12-11 11:23:29	2023-12-11 11:23:29
198	273	2023-12-11 11:23:29	2023-12-11 11:23:29
199	274	2023-12-11 11:23:29	2023-12-11 11:23:29
200	275	2023-12-11 11:23:29	2023-12-11 11:23:29
201	276	2023-12-11 11:23:29	2023-12-11 11:23:29
201	277	2023-12-11 11:23:29	2023-12-11 11:23:29
203	278	2023-12-11 11:23:29	2023-12-11 11:23:29
201	279	2023-12-11 11:23:29	2023-12-11 11:23:29
201	280	2023-12-11 11:23:29	2023-12-11 11:23:29
201	281	2023-12-11 11:23:29	2023-12-11 11:23:29
201	282	2023-12-11 11:23:29	2023-12-11 11:23:29
201	283	2023-12-11 11:23:29	2023-12-11 11:23:29
201	284	2023-12-11 11:23:29	2023-12-11 11:23:29
201	285	2023-12-11 11:23:29	2023-12-11 11:23:29
201	286	2023-12-11 11:23:29	2023-12-11 11:23:29
201	287	2023-12-11 11:23:29	2023-12-11 11:23:29
201	288	2023-12-11 11:23:29	2023-12-11 11:23:29
201	289	2023-12-11 11:23:29	2023-12-11 11:23:29
201	290	2023-12-11 11:23:29	2023-12-11 11:23:29
201	291	2023-12-11 11:23:29	2023-12-11 11:23:29
201	292	2023-12-11 11:23:29	2023-12-11 11:23:29
201	293	2023-12-11 11:23:29	2023-12-11 11:23:29
201	294	2023-12-11 11:23:29	2023-12-11 11:23:29
201	295	2023-12-11 11:23:29	2023-12-11 11:23:29
205	296	2023-12-11 11:23:29	2023-12-11 11:23:29
205	297	2023-12-11 11:23:30	2023-12-11 11:23:30
201	298	2023-12-11 11:23:30	2023-12-11 11:23:30
201	299	2023-12-11 11:23:30	2023-12-11 11:23:30
206	300	2023-12-11 11:23:30	2023-12-11 11:23:30
207	301	2023-12-11 11:23:30	2023-12-11 11:23:30
208	302	2023-12-11 11:23:30	2023-12-11 11:23:30
209	303	2023-12-11 11:23:30	2023-12-11 11:23:30
210	304	2023-12-11 11:23:30	2023-12-11 11:23:30
211	305	2023-12-11 11:23:30	2023-12-11 11:23:30
60	306	2023-12-11 11:23:30	2023-12-11 11:23:30
212	307	2023-12-11 11:23:30	2023-12-11 11:23:30
213	308	2023-12-11 11:23:30	2023-12-11 11:23:30
213	309	2023-12-11 11:23:30	2023-12-11 11:23:30
213	310	2023-12-11 11:23:30	2023-12-11 11:23:30
214	311	2023-12-11 11:23:30	2023-12-11 11:23:30
215	312	2023-12-11 11:23:30	2023-12-11 11:23:30
215	313	2023-12-11 11:23:30	2023-12-11 11:23:30
215	314	2023-12-11 11:23:30	2023-12-11 11:23:30
216	315	2023-12-11 11:23:30	2023-12-11 11:23:30
217	316	2023-12-11 11:23:30	2023-12-11 11:23:30
218	317	2023-12-11 11:23:30	2023-12-11 11:23:30
219	318	2023-12-11 11:23:30	2023-12-11 11:23:30
221	319	2023-12-11 11:23:30	2023-12-11 11:23:30
222	320	2023-12-11 11:23:30	2023-12-11 11:23:30
223	321	2023-12-11 11:23:30	2023-12-11 11:23:30
224	322	2023-12-11 11:23:30	2023-12-11 11:23:30
225	323	2023-12-11 11:23:30	2023-12-11 11:23:30
226	324	2023-12-11 11:23:30	2023-12-11 11:23:30
228	325	2023-12-11 11:23:30	2023-12-11 11:23:30
229	326	2023-12-11 11:23:30	2023-12-11 11:23:30
230	327	2023-12-11 11:23:30	2023-12-11 11:23:30
232	328	2023-12-11 11:23:30	2023-12-11 11:23:30
233	329	2023-12-11 11:23:30	2023-12-11 11:23:30
234	330	2023-12-11 11:23:30	2023-12-11 11:23:30
235	331	2023-12-11 11:23:30	2023-12-11 11:23:30
235	332	2023-12-11 11:23:30	2023-12-11 11:23:30
235	333	2023-12-11 11:23:30	2023-12-11 11:23:30
236	334	2023-12-11 11:23:30	2023-12-11 11:23:30
237	335	2023-12-11 11:23:30	2023-12-11 11:23:30
238	336	2023-12-11 11:23:30	2023-12-11 11:23:30
239	337	2023-12-11 11:23:30	2023-12-11 11:23:30
240	338	2023-12-11 11:23:30	2023-12-11 11:23:30
242	339	2023-12-11 11:23:30	2023-12-11 11:23:30
243	340	2023-12-11 11:23:30	2023-12-11 11:23:30
244	341	2023-12-11 11:23:30	2023-12-11 11:23:30
246	342	2023-12-11 11:23:30	2023-12-11 11:23:30
247	343	2023-12-11 11:23:30	2023-12-11 11:23:30
248	344	2023-12-11 11:23:30	2023-12-11 11:23:30
249	345	2023-12-11 11:23:30	2023-12-11 11:23:30
250	346	2023-12-11 11:23:30	2023-12-11 11:23:30
251	347	2023-12-11 11:23:30	2023-12-11 11:23:30
252	348	2023-12-11 11:23:30	2023-12-11 11:23:30
253	349	2023-12-11 11:23:30	2023-12-11 11:23:30
254	350	2023-12-11 11:23:30	2023-12-11 11:23:30
255	351	2023-12-11 11:23:30	2023-12-11 11:23:30
256	352	2023-12-11 11:23:30	2023-12-11 11:23:30
257	353	2023-12-11 11:23:30	2023-12-11 11:23:30
258	354	2023-12-11 11:23:30	2023-12-11 11:23:30
259	355	2023-12-11 11:23:30	2023-12-11 11:23:30
260	356	2023-12-11 11:23:30	2023-12-11 11:23:30
261	357	2023-12-11 11:23:30	2023-12-11 11:23:30
263	358	2023-12-11 11:23:30	2023-12-11 11:23:30
264	359	2023-12-11 11:23:30	2023-12-11 11:23:30
265	360	2023-12-11 11:23:31	2023-12-11 11:23:31
266	361	2023-12-11 11:23:31	2023-12-11 11:23:31
267	362	2023-12-11 11:23:31	2023-12-11 11:23:31
268	363	2023-12-11 11:23:31	2023-12-11 11:23:31
269	364	2023-12-11 11:23:31	2023-12-11 11:23:31
270	365	2023-12-11 11:23:31	2023-12-11 11:23:31
271	366	2023-12-11 11:23:31	2023-12-11 11:23:31
272	367	2023-12-11 11:23:31	2023-12-11 11:23:31
274	368	2023-12-11 11:23:31	2023-12-11 11:23:31
274	369	2023-12-11 11:23:31	2023-12-11 11:23:31
275	370	2023-12-11 11:23:31	2023-12-11 11:23:31
276	371	2023-12-11 11:23:31	2023-12-11 11:23:31
277	372	2023-12-11 11:23:31	2023-12-11 11:23:31
278	373	2023-12-11 11:23:31	2023-12-11 11:23:31
278	374	2023-12-11 11:23:31	2023-12-11 11:23:31
278	375	2023-12-11 11:23:31	2023-12-11 11:23:31
279	376	2023-12-11 11:23:31	2023-12-11 11:23:31
280	377	2023-12-11 11:23:31	2023-12-11 11:23:31
281	378	2023-12-11 11:23:31	2023-12-11 11:23:31
282	379	2023-12-11 11:23:31	2023-12-11 11:23:31
281	380	2023-12-11 11:23:31	2023-12-11 11:23:31
281	381	2023-12-11 11:23:31	2023-12-11 11:23:31
283	382	2023-12-11 11:23:31	2023-12-11 11:23:31
283	383	2023-12-11 11:23:31	2023-12-11 11:23:31
284	384	2023-12-11 11:23:31	2023-12-11 11:23:31
281	385	2023-12-11 11:23:31	2023-12-11 11:23:31
284	386	2023-12-11 11:23:31	2023-12-11 11:23:31
285	387	2023-12-11 11:23:31	2023-12-11 11:23:31
286	388	2023-12-11 11:23:31	2023-12-11 11:23:31
287	389	2023-12-11 11:23:31	2023-12-11 11:23:31
286	390	2023-12-11 11:23:31	2023-12-11 11:23:31
41	391	2023-12-11 11:23:31	2023-12-11 11:23:31
288	392	2023-12-11 11:23:31	2023-12-11 11:23:31
289	393	2023-12-11 11:23:31	2023-12-11 11:23:31
290	394	2023-12-11 11:23:31	2023-12-11 11:23:31
291	395	2023-12-11 11:23:31	2023-12-11 11:23:31
293	396	2023-12-11 11:23:31	2023-12-11 11:23:31
294	397	2023-12-11 11:23:31	2023-12-11 11:23:31
296	398	2023-12-11 11:23:31	2023-12-11 11:23:31
297	399	2023-12-11 11:23:31	2023-12-11 11:23:31
\.


--
-- Data for Name: classification_dewey_centaines; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.classification_dewey_centaines (id_classification_dewey_centaine, section, theme, created_at, updated_at) FROM stdin;
1	0	Informatique, information générale et œuvres de référence	2023-12-11 11:19:19	2023-12-11 11:19:19
2	100	Phylosophie et pyschologie	2023-12-11 11:19:19	2023-12-11 11:19:19
3	200	Religion	2023-12-11 11:19:19	2023-12-11 11:19:19
4	300	Sciences sociales	2023-12-11 11:19:19	2023-12-11 11:19:19
5	400	Langues	2023-12-11 11:19:19	2023-12-11 11:19:19
6	500	Science naturelles et mathématiques	2023-12-11 11:19:19	2023-12-11 11:19:19
7	600	Technologie (sciences appliquées)	2023-12-11 11:19:19	2023-12-11 11:19:19
8	700	Arts et loisirs	2023-12-11 11:19:19	2023-12-11 11:19:19
9	800	Littérature (belles-lettres) et rhétorique	2023-12-11 11:19:19	2023-12-11 11:19:19
10	900	Histoire, géographie et biographies	2023-12-11 11:19:19	2023-12-11 11:19:19
\.


--
-- Data for Name: classification_dewey_dizaines; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.classification_dewey_dizaines (id_classification_dewey_dizaine, classe, matiere, id_classification_dewey_centaine, created_at, updated_at) FROM stdin;
1	10	bibliographie	1	2023-12-11 11:19:19	2023-12-11 11:19:19
2	20	bibliothéconomie et sciences de l'information	1	2023-12-11 11:19:19	2023-12-11 11:19:19
3	30	encyclopedies générales	1	2023-12-11 11:19:19	2023-12-11 11:19:19
4	40	non attribue	1	2023-12-11 11:19:19	2023-12-11 11:19:19
5	50	publication en série d'ordre general	1	2023-12-11 11:19:19	2023-12-11 11:19:19
6	60	organisation générales et muséologie	1	2023-12-11 11:19:19	2023-12-11 11:19:19
7	70	média d'information, journalisme, edition	1	2023-12-11 11:19:19	2023-12-11 11:19:19
8	80	receuils généraux	1	2023-12-11 11:19:19	2023-12-11 11:19:19
9	90	manuscrits et livre rares	1	2023-12-11 11:19:19	2023-12-11 11:19:19
10	110	métaphysique	2	2023-12-11 11:19:19	2023-12-11 11:19:19
11	120	théorie de la connaissance, causalité, genre humain	2	2023-12-11 11:19:19	2023-12-11 11:19:19
12	130	phénoménes paranormaux	2	2023-12-11 11:19:19	2023-12-11 11:19:19
13	140	écoles philosophiques particulières	2	2023-12-11 11:19:19	2023-12-11 11:19:19
14	150	psycologie	2	2023-12-11 11:19:19	2023-12-11 11:19:19
15	160	logique	2	2023-12-11 11:19:19	2023-12-11 11:19:19
16	170	morale	2	2023-12-11 11:19:19	2023-12-11 11:19:19
17	180	philosophie ancienne, médiévale, orientale	2	2023-12-11 11:19:19	2023-12-11 11:19:19
18	190	philosophie occidentale moderne	2	2023-12-11 11:19:19	2023-12-11 11:19:19
19	210	philosophie et théorie de la religion	3	2023-12-11 11:19:19	2023-12-11 11:19:19
20	220	bible	3	2023-12-11 11:19:19	2023-12-11 11:19:19
21	230	christianisme théorie chrétienne	3	2023-12-11 11:19:19	2023-12-11 11:19:19
22	240	théologie morale et spirituelle chrétienne2	3	2023-12-11 11:19:19	2023-12-11 11:19:19
23	250	église locales et ordres religieux chrétiens	3	2023-12-11 11:19:19	2023-12-11 11:19:19
24	260	théologie chrétienne et société et eco----	3	2023-12-11 11:19:19	2023-12-11 11:19:19
25	270	histoire du chritianisme et de l'Eglise	3	2023-12-11 11:19:19	2023-12-11 11:19:19
26	280	confessions et sectes chrétiennes	3	2023-12-11 11:19:19	2023-12-11 11:19:19
27	290	religions comparées et autres religions	3	2023-12-11 11:19:19	2023-12-11 11:19:19
28	310	statistiques générales	4	2023-12-11 11:19:19	2023-12-11 11:19:19
29	320	science politique	4	2023-12-11 11:19:19	2023-12-11 11:19:19
30	330	économie politique	4	2023-12-11 11:19:19	2023-12-11 11:19:19
31	340	droit	4	2023-12-11 11:19:19	2023-12-11 11:19:19
32	350	administration publique et science millitaire	4	2023-12-11 11:19:19	2023-12-11 11:19:19
33	360	problèmes et service sociaux, associations	4	2023-12-11 11:19:19	2023-12-11 11:19:19
34	370	éducation	4	2023-12-11 11:19:19	2023-12-11 11:19:19
35	380	commerce, communication, transports	4	2023-12-11 11:19:19	2023-12-11 11:19:19
36	390	coutumes, étiquette, f---	4	2023-12-11 11:19:19	2023-12-11 11:19:19
37	410	linguistique	5	2023-12-11 11:19:19	2023-12-11 11:19:19
38	420	anglais et veill anglais	5	2023-12-11 11:19:19	2023-12-11 11:19:19
39	430	langues germaniques Allemand	5	2023-12-11 11:19:19	2023-12-11 11:19:19
40	440	langues romanes Français	5	2023-12-11 11:19:19	2023-12-11 11:19:19
41	450	italien, roumaines, méto-roma4	5	2023-12-11 11:19:19	2023-12-11 11:19:19
42	460	espagnol et Portugais	5	2023-12-11 11:19:19	2023-12-11 11:19:19
43	470	langues Italiques Latin	5	2023-12-11 11:19:19	2023-12-11 11:19:19
44	480	langues helléniques Grec classique	5	2023-12-11 11:19:19	2023-12-11 11:19:19
45	490	autre langues	5	2023-12-11 11:19:19	2023-12-11 11:19:19
46	510	mathématiques	6	2023-12-11 11:19:19	2023-12-11 11:19:19
47	520	astronomie et sciences connexes	6	2023-12-11 11:19:19	2023-12-11 11:19:19
48	530	physique	6	2023-12-11 11:19:19	2023-12-11 11:19:19
49	540	chimie et sciences connexes	6	2023-12-11 11:19:19	2023-12-11 11:19:19
50	550	sciences de la terre	6	2023-12-11 11:19:19	2023-12-11 11:19:19
51	560	paléontologie plaléozoologie	6	2023-12-11 11:19:19	2023-12-11 11:19:19
52	570	science de la vie biologie	6	2023-12-11 11:19:19	2023-12-11 11:19:19
53	580	plantes	6	2023-12-11 11:19:19	2023-12-11 11:19:19
54	590	animaux	6	2023-12-11 11:19:19	2023-12-11 11:19:19
55	610	médecine	7	2023-12-11 11:19:19	2023-12-11 11:19:19
56	620	ingénierie	7	2023-12-11 11:19:19	2023-12-11 11:19:19
57	630	agriculture	7	2023-12-11 11:19:19	2023-12-11 11:19:19
58	640	économie domestique	7	2023-12-11 11:19:19	2023-12-11 11:19:19
59	650	gestion	7	2023-12-11 11:19:19	2023-12-11 11:19:19
60	660	chimie	7	2023-12-11 11:19:19	2023-12-11 11:19:19
61	670	fabrication	7	2023-12-11 11:19:19	2023-12-11 11:19:19
62	680	fabrication de produits	7	2023-12-11 11:19:19	2023-12-11 11:19:19
63	690	construction	7	2023-12-11 11:19:19	2023-12-11 11:19:19
64	710	urbanisme	8	2023-12-11 11:19:19	2023-12-11 11:19:19
65	720	architecture	8	2023-12-11 11:19:19	2023-12-11 11:19:19
66	730	sculpture, céramique, et autres arts décoratifs	8	2023-12-11 11:19:19	2023-12-11 11:19:19
67	740	arts graphiques et arts décoratifs	8	2023-12-11 11:19:19	2023-12-11 11:19:19
68	750	peinture et arts de la peinture	8	2023-12-11 11:19:19	2023-12-11 11:19:19
69	760	gravure et impression	8	2023-12-11 11:19:19	2023-12-11 11:19:19
70	770	photographie et photographies	8	2023-12-11 11:19:19	2023-12-11 11:19:19
71	780	musique	8	2023-12-11 11:19:19	2023-12-11 11:19:19
72	790	loisirs et divertissements	8	2023-12-11 11:19:19	2023-12-11 11:19:19
73	810	littérature	9	2023-12-11 11:19:19	2023-12-11 11:19:19
74	820	langue anglaise et littératures	9	2023-12-11 11:19:19	2023-12-11 11:19:19
75	830	littératures des littératures germaniques	9	2023-12-11 11:19:19	2023-12-11 11:19:19
76	840	littératures des littératures romanes	9	2023-12-11 11:19:19	2023-12-11 11:19:19
77	850	littératures italiques, littératures néo-latines	9	2023-12-11 11:19:19	2023-12-11 11:19:19
78	860	littératures espagnole et portugaise	9	2023-12-11 11:19:19	2023-12-11 11:19:19
79	870	littératures des littératures italiques	9	2023-12-11 11:19:19	2023-12-11 11:19:19
80	880	littératures helléniques	9	2023-12-11 11:19:19	2023-12-11 11:19:19
81	890	littératures des autres littératures	9	2023-12-11 11:19:19	2023-12-11 11:19:19
82	910	géographie et voyages	10	2023-12-11 11:19:19	2023-12-11 11:19:19
83	920	biographies et généalogie	10	2023-12-11 11:19:19	2023-12-11 11:19:19
84	930	histoire ancienne	10	2023-12-11 11:19:19	2023-12-11 11:19:19
85	940	histoire de l'Europe	10	2023-12-11 11:19:19	2023-12-11 11:19:19
86	950	histoire de l'Asie	10	2023-12-11 11:19:19	2023-12-11 11:19:19
87	960	histoire de l'Afrique	10	2023-12-11 11:19:19	2023-12-11 11:19:19
88	970	histoire de l'Amérique du Nord	10	2023-12-11 11:19:19	2023-12-11 11:19:19
89	980	histoire de l'Amérique du Sud	10	2023-12-11 11:19:19	2023-12-11 11:19:19
90	990	histoire des autres parties du monde	10	2023-12-11 11:19:19	2023-12-11 11:19:19
\.


--
-- Data for Name: domaines; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.domaines (id_domaine, libelle, created_at, updated_at) FROM stdin;
1	littérature classique	\N	\N
2	philosophie	\N	\N
3	psychologie	\N	\N
4	science	\N	\N
5	histoire	\N	\N
6	politique	\N	\N
7	religion	\N	\N
8	art	\N	\N
9	Économie	\N	\N
10	sociologie	\N	\N
11	sciences humaines	\N	\N
12	sciences naturelles	\N	\N
13	technologie	\N	\N
14	Éducation	\N	\N
15	santé	\N	\N
16	physique	\N	\N
17	mathématique générale	\N	\N
18	technique	\N	\N
19	energie solaire	\N	\N
20	géologie	\N	\N
21	comptabilité	\N	\N
22	education	\N	\N
23	anglais	\N	\N
24	français	\N	\N
25	allemand	\N	\N
26	droit	\N	\N
27	théologie	\N	\N
28	médecine	\N	\N
\.


--
-- Data for Name: domaines_ouvrages; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.domaines_ouvrages (id, id_ouvrage, id_domaine, created_at, updated_at) FROM stdin;
1	1	16	\N	\N
2	2	16	\N	\N
3	3	16	\N	\N
4	4	16	\N	\N
5	5	16	\N	\N
6	6	16	\N	\N
7	7	16	\N	\N
8	8	16	\N	\N
9	9	16	\N	\N
10	10	16	\N	\N
11	11	16	\N	\N
12	12	16	\N	\N
13	13	16	\N	\N
14	14	16	\N	\N
15	15	16	\N	\N
16	16	16	\N	\N
17	17	16	\N	\N
18	18	16	\N	\N
19	19	16	\N	\N
20	20	16	\N	\N
21	21	16	\N	\N
22	22	16	\N	\N
23	23	16	\N	\N
24	24	16	\N	\N
25	25	16	\N	\N
26	26	16	\N	\N
27	27	16	\N	\N
28	28	16	\N	\N
29	29	16	\N	\N
30	30	16	\N	\N
31	31	16	\N	\N
32	32	17	\N	\N
33	33	17	\N	\N
34	34	17	\N	\N
35	35	18	\N	\N
36	36	18	\N	\N
37	37	18	\N	\N
38	38	18	\N	\N
39	39	18	\N	\N
40	40	18	\N	\N
41	41	16	\N	\N
42	42	16	\N	\N
43	43	16	\N	\N
44	44	16	\N	\N
45	45	19	\N	\N
46	46	19	\N	\N
47	47	16	\N	\N
48	48	16	\N	\N
49	49	16	\N	\N
50	50	20	\N	\N
51	51	16	\N	\N
52	52	16	\N	\N
53	53	16	\N	\N
54	54	16	\N	\N
55	55	16	\N	\N
56	56	16	\N	\N
57	57	18	\N	\N
58	58	21	\N	\N
59	59	21	\N	\N
60	60	21	\N	\N
61	61	21	\N	\N
62	62	21	\N	\N
63	63	21	\N	\N
64	64	21	\N	\N
65	65	21	\N	\N
66	66	21	\N	\N
67	67	21	\N	\N
68	68	21	\N	\N
69	69	21	\N	\N
70	70	21	\N	\N
71	71	21	\N	\N
72	72	21	\N	\N
73	73	21	\N	\N
74	74	21	\N	\N
75	75	21	\N	\N
76	76	21	\N	\N
77	77	21	\N	\N
78	78	21	\N	\N
79	79	21	\N	\N
80	80	21	\N	\N
81	81	21	\N	\N
82	82	21	\N	\N
83	83	21	\N	\N
84	84	21	\N	\N
85	85	21	\N	\N
86	86	21	\N	\N
87	87	21	\N	\N
88	88	21	\N	\N
89	89	21	\N	\N
90	90	21	\N	\N
91	91	21	\N	\N
92	92	21	\N	\N
93	93	21	\N	\N
94	94	21	\N	\N
95	95	21	\N	\N
96	96	16	\N	\N
97	97	17	\N	\N
98	98	17	\N	\N
99	99	17	\N	\N
100	100	17	\N	\N
101	101	17	\N	\N
102	102	17	\N	\N
103	103	17	\N	\N
104	104	17	\N	\N
105	105	17	\N	\N
106	106	17	\N	\N
107	107	17	\N	\N
108	108	17	\N	\N
109	109	17	\N	\N
110	110	17	\N	\N
111	111	17	\N	\N
112	112	17	\N	\N
113	113	16	\N	\N
114	114	16	\N	\N
115	115	16	\N	\N
116	116	16	\N	\N
117	117	16	\N	\N
118	118	16	\N	\N
119	119	16	\N	\N
120	120	16	\N	\N
121	121	16	\N	\N
122	122	17	\N	\N
123	123	16	\N	\N
124	124	16	\N	\N
125	125	16	\N	\N
126	126	16	\N	\N
127	127	16	\N	\N
128	128	16	\N	\N
129	129	16	\N	\N
130	130	16	\N	\N
131	131	16	\N	\N
132	132	16	\N	\N
133	133	16	\N	\N
134	134	16	\N	\N
135	135	22	\N	\N
136	136	22	\N	\N
137	137	22	\N	\N
138	138	22	\N	\N
139	139	22	\N	\N
140	140	23	\N	\N
141	141	24	\N	\N
142	142	23	\N	\N
143	143	24	\N	\N
144	144	17	\N	\N
145	145	22	\N	\N
146	146	16	\N	\N
147	147	23	\N	\N
148	148	22	\N	\N
149	149	22	\N	\N
150	150	22	\N	\N
151	151	22	\N	\N
152	152	22	\N	\N
153	153	22	\N	\N
154	154	22	\N	\N
155	155	22	\N	\N
156	156	22	\N	\N
157	157	22	\N	\N
158	158	22	\N	\N
159	159	22	\N	\N
160	160	22	\N	\N
161	161	22	\N	\N
162	162	22	\N	\N
163	163	22	\N	\N
164	164	22	\N	\N
165	165	22	\N	\N
166	166	22	\N	\N
167	167	22	\N	\N
168	168	22	\N	\N
170	170	22	\N	\N
171	171	22	\N	\N
172	172	22	\N	\N
173	173	22	\N	\N
174	174	22	\N	\N
175	175	22	\N	\N
176	176	22	\N	\N
177	177	22	\N	\N
178	178	22	\N	\N
179	179	22	\N	\N
180	180	22	\N	\N
181	181	22	\N	\N
182	182	22	\N	\N
183	183	22	\N	\N
184	184	22	\N	\N
185	185	22	\N	\N
186	186	22	\N	\N
187	187	22	\N	\N
188	188	22	\N	\N
189	189	22	\N	\N
190	190	22	\N	\N
191	191	22	\N	\N
192	192	22	\N	\N
193	193	22	\N	\N
194	194	22	\N	\N
195	195	22	\N	\N
196	196	22	\N	\N
197	197	22	\N	\N
198	198	22	\N	\N
199	199	22	\N	\N
200	200	22	\N	\N
201	201	22	\N	\N
202	202	22	\N	\N
203	203	22	\N	\N
204	204	22	\N	\N
205	205	22	\N	\N
206	206	22	\N	\N
207	207	22	\N	\N
208	208	17	\N	\N
209	209	17	\N	\N
210	210	17	\N	\N
211	211	17	\N	\N
212	212	17	\N	\N
213	213	17	\N	\N
214	214	17	\N	\N
215	215	17	\N	\N
216	216	17	\N	\N
217	217	16	\N	\N
218	218	16	\N	\N
219	219	16	\N	\N
220	220	16	\N	\N
221	221	16	\N	\N
222	222	16	\N	\N
223	223	16	\N	\N
224	224	16	\N	\N
225	225	16	\N	\N
226	226	22	\N	\N
227	227	22	\N	\N
228	228	22	\N	\N
229	229	22	\N	\N
230	230	22	\N	\N
231	231	22	\N	\N
232	232	22	\N	\N
233	233	22	\N	\N
234	234	22	\N	\N
235	235	22	\N	\N
236	236	22	\N	\N
237	237	22	\N	\N
238	238	22	\N	\N
239	239	22	\N	\N
240	240	22	\N	\N
241	241	22	\N	\N
242	242	22	\N	\N
243	243	22	\N	\N
244	244	22	\N	\N
245	245	22	\N	\N
246	246	23	\N	\N
247	247	23	\N	\N
248	248	23	\N	\N
249	249	23	\N	\N
250	250	22	\N	\N
251	251	22	\N	\N
252	252	22	\N	\N
253	253	22	\N	\N
254	254	22	\N	\N
255	255	22	\N	\N
256	256	22	\N	\N
257	257	22	\N	\N
258	258	17	\N	\N
259	259	17	\N	\N
260	260	17	\N	\N
261	261	17	\N	\N
262	262	17	\N	\N
263	263	22	\N	\N
264	264	22	\N	\N
265	265	22	\N	\N
266	266	22	\N	\N
267	267	22	\N	\N
268	268	22	\N	\N
269	269	22	\N	\N
270	270	22	\N	\N
271	271	22	\N	\N
272	272	22	\N	\N
273	273	26	\N	\N
274	274	26	\N	\N
275	275	26	\N	\N
276	276	26	\N	\N
277	277	26	\N	\N
278	278	26	\N	\N
279	279	26	\N	\N
280	280	26	\N	\N
281	281	26	\N	\N
282	282	26	\N	\N
283	283	26	\N	\N
284	284	26	\N	\N
285	285	26	\N	\N
286	286	26	\N	\N
287	287	26	\N	\N
288	288	26	\N	\N
289	289	26	\N	\N
290	290	26	\N	\N
291	291	26	\N	\N
292	292	26	\N	\N
293	293	26	\N	\N
294	294	26	\N	\N
295	295	26	\N	\N
296	296	26	\N	\N
297	297	26	\N	\N
298	298	26	\N	\N
299	299	26	\N	\N
300	300	26	\N	\N
301	301	26	\N	\N
302	302	26	\N	\N
303	303	26	\N	\N
304	304	26	\N	\N
305	305	26	\N	\N
306	306	26	\N	\N
307	307	26	\N	\N
308	308	26	\N	\N
309	309	26	\N	\N
310	310	26	\N	\N
311	311	27	\N	\N
312	312	27	\N	\N
313	313	27	\N	\N
314	314	27	\N	\N
315	315	26	\N	\N
316	316	26	\N	\N
317	317	26	\N	\N
318	318	26	\N	\N
319	319	26	\N	\N
320	320	26	\N	\N
321	321	26	\N	\N
322	322	26	\N	\N
323	323	26	\N	\N
324	324	26	\N	\N
325	325	26	\N	\N
326	326	26	\N	\N
327	327	26	\N	\N
328	328	26	\N	\N
329	329	26	\N	\N
330	330	26	\N	\N
331	331	26	\N	\N
332	332	26	\N	\N
333	333	26	\N	\N
334	334	26	\N	\N
335	335	26	\N	\N
336	336	26	\N	\N
337	337	26	\N	\N
338	338	26	\N	\N
339	339	26	\N	\N
340	340	26	\N	\N
341	341	26	\N	\N
342	342	26	\N	\N
343	343	2	\N	\N
344	344	2	\N	\N
345	345	2	\N	\N
346	346	24	\N	\N
347	347	24	\N	\N
348	348	24	\N	\N
349	349	24	\N	\N
350	350	24	\N	\N
351	351	24	\N	\N
352	352	24	\N	\N
353	353	24	\N	\N
354	354	24	\N	\N
355	355	24	\N	\N
356	356	24	\N	\N
357	357	24	\N	\N
358	358	24	\N	\N
359	359	24	\N	\N
360	360	24	\N	\N
361	361	24	\N	\N
362	362	24	\N	\N
363	363	24	\N	\N
364	364	24	\N	\N
365	365	24	\N	\N
366	366	24	\N	\N
367	367	24	\N	\N
368	368	24	\N	\N
369	369	24	\N	\N
370	370	24	\N	\N
371	371	28	\N	\N
372	372	28	\N	\N
373	373	28	\N	\N
374	374	28	\N	\N
375	375	28	\N	\N
376	376	28	\N	\N
377	377	28	\N	\N
378	378	28	\N	\N
379	379	28	\N	\N
380	380	28	\N	\N
381	381	28	\N	\N
382	382	28	\N	\N
383	383	28	\N	\N
384	384	28	\N	\N
385	385	28	\N	\N
386	386	28	\N	\N
387	387	28	\N	\N
388	388	28	\N	\N
389	389	28	\N	\N
390	390	28	\N	\N
391	391	28	\N	\N
392	392	27	\N	\N
393	393	27	\N	\N
394	394	27	\N	\N
395	395	27	\N	\N
396	396	27	\N	\N
397	397	27	\N	\N
398	398	27	\N	\N
399	399	27	\N	\N
423	169	22	\N	\N
\.


--
-- Data for Name: emprunts; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.emprunts (id_emprunt, date_emprunt, date_retour, id_abonne, id_personnel, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: floozs; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.floozs (id_flooz, id_registration, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: langues; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.langues (id_langue, libelle, created_at, updated_at) FROM stdin;
1	français	\N	\N
2	anglais	\N	\N
3	allemend	\N	\N
\.


--
-- Data for Name: langues_ouvrages; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.langues_ouvrages (id_langue, id_ouvrage, created_at, updated_at) FROM stdin;
1	1	2023-12-11 11:23:26	2023-12-11 11:23:26
2	1	2023-12-11 11:23:26	2023-12-11 11:23:26
3	1	2023-12-11 11:23:26	2023-12-11 11:23:26
4	1	2023-12-11 11:23:26	2023-12-11 11:23:26
5	1	2023-12-11 11:23:26	2023-12-11 11:23:26
6	1	2023-12-11 11:23:26	2023-12-11 11:23:26
7	1	2023-12-11 11:23:26	2023-12-11 11:23:26
8	1	2023-12-11 11:23:26	2023-12-11 11:23:26
9	1	2023-12-11 11:23:26	2023-12-11 11:23:26
10	1	2023-12-11 11:23:26	2023-12-11 11:23:26
11	1	2023-12-11 11:23:26	2023-12-11 11:23:26
12	1	2023-12-11 11:23:26	2023-12-11 11:23:26
13	1	2023-12-11 11:23:26	2023-12-11 11:23:26
14	1	2023-12-11 11:23:26	2023-12-11 11:23:26
15	1	2023-12-11 11:23:26	2023-12-11 11:23:26
16	1	2023-12-11 11:23:26	2023-12-11 11:23:26
17	1	2023-12-11 11:23:26	2023-12-11 11:23:26
18	1	2023-12-11 11:23:26	2023-12-11 11:23:26
19	1	2023-12-11 11:23:26	2023-12-11 11:23:26
20	1	2023-12-11 11:23:26	2023-12-11 11:23:26
21	1	2023-12-11 11:23:26	2023-12-11 11:23:26
22	1	2023-12-11 11:23:26	2023-12-11 11:23:26
23	1	2023-12-11 11:23:26	2023-12-11 11:23:26
24	1	2023-12-11 11:23:26	2023-12-11 11:23:26
25	1	2023-12-11 11:23:26	2023-12-11 11:23:26
26	1	2023-12-11 11:23:26	2023-12-11 11:23:26
27	1	2023-12-11 11:23:26	2023-12-11 11:23:26
28	1	2023-12-11 11:23:26	2023-12-11 11:23:26
29	1	2023-12-11 11:23:26	2023-12-11 11:23:26
30	1	2023-12-11 11:23:26	2023-12-11 11:23:26
31	1	2023-12-11 11:23:26	2023-12-11 11:23:26
32	1	2023-12-11 11:23:26	2023-12-11 11:23:26
33	1	2023-12-11 11:23:26	2023-12-11 11:23:26
34	1	2023-12-11 11:23:26	2023-12-11 11:23:26
35	1	2023-12-11 11:23:26	2023-12-11 11:23:26
36	1	2023-12-11 11:23:26	2023-12-11 11:23:26
37	1	2023-12-11 11:23:26	2023-12-11 11:23:26
38	1	2023-12-11 11:23:26	2023-12-11 11:23:26
39	1	2023-12-11 11:23:26	2023-12-11 11:23:26
40	1	2023-12-11 11:23:26	2023-12-11 11:23:26
41	1	2023-12-11 11:23:26	2023-12-11 11:23:26
42	1	2023-12-11 11:23:26	2023-12-11 11:23:26
43	1	2023-12-11 11:23:26	2023-12-11 11:23:26
44	1	2023-12-11 11:23:26	2023-12-11 11:23:26
45	1	2023-12-11 11:23:26	2023-12-11 11:23:26
46	1	2023-12-11 11:23:26	2023-12-11 11:23:26
47	1	2023-12-11 11:23:26	2023-12-11 11:23:26
48	1	2023-12-11 11:23:26	2023-12-11 11:23:26
49	1	2023-12-11 11:23:26	2023-12-11 11:23:26
50	1	2023-12-11 11:23:26	2023-12-11 11:23:26
51	1	2023-12-11 11:23:26	2023-12-11 11:23:26
52	1	2023-12-11 11:23:26	2023-12-11 11:23:26
53	1	2023-12-11 11:23:26	2023-12-11 11:23:26
54	1	2023-12-11 11:23:26	2023-12-11 11:23:26
55	1	2023-12-11 11:23:26	2023-12-11 11:23:26
56	1	2023-12-11 11:23:26	2023-12-11 11:23:26
57	1	2023-12-11 11:23:26	2023-12-11 11:23:26
58	1	2023-12-11 11:23:26	2023-12-11 11:23:26
59	1	2023-12-11 11:23:27	2023-12-11 11:23:27
60	1	2023-12-11 11:23:27	2023-12-11 11:23:27
61	1	2023-12-11 11:23:27	2023-12-11 11:23:27
62	1	2023-12-11 11:23:27	2023-12-11 11:23:27
63	1	2023-12-11 11:23:27	2023-12-11 11:23:27
64	1	2023-12-11 11:23:27	2023-12-11 11:23:27
65	1	2023-12-11 11:23:27	2023-12-11 11:23:27
66	1	2023-12-11 11:23:27	2023-12-11 11:23:27
67	1	2023-12-11 11:23:27	2023-12-11 11:23:27
68	1	2023-12-11 11:23:27	2023-12-11 11:23:27
69	1	2023-12-11 11:23:27	2023-12-11 11:23:27
70	1	2023-12-11 11:23:27	2023-12-11 11:23:27
71	1	2023-12-11 11:23:27	2023-12-11 11:23:27
72	1	2023-12-11 11:23:27	2023-12-11 11:23:27
73	1	2023-12-11 11:23:27	2023-12-11 11:23:27
74	1	2023-12-11 11:23:27	2023-12-11 11:23:27
75	1	2023-12-11 11:23:27	2023-12-11 11:23:27
76	1	2023-12-11 11:23:27	2023-12-11 11:23:27
77	1	2023-12-11 11:23:27	2023-12-11 11:23:27
78	1	2023-12-11 11:23:27	2023-12-11 11:23:27
79	1	2023-12-11 11:23:27	2023-12-11 11:23:27
80	1	2023-12-11 11:23:27	2023-12-11 11:23:27
81	1	2023-12-11 11:23:27	2023-12-11 11:23:27
82	1	2023-12-11 11:23:27	2023-12-11 11:23:27
83	1	2023-12-11 11:23:27	2023-12-11 11:23:27
84	1	2023-12-11 11:23:27	2023-12-11 11:23:27
85	1	2023-12-11 11:23:27	2023-12-11 11:23:27
86	1	2023-12-11 11:23:27	2023-12-11 11:23:27
87	1	2023-12-11 11:23:27	2023-12-11 11:23:27
88	1	2023-12-11 11:23:27	2023-12-11 11:23:27
89	1	2023-12-11 11:23:27	2023-12-11 11:23:27
90	1	2023-12-11 11:23:27	2023-12-11 11:23:27
91	1	2023-12-11 11:23:27	2023-12-11 11:23:27
92	1	2023-12-11 11:23:27	2023-12-11 11:23:27
93	1	2023-12-11 11:23:27	2023-12-11 11:23:27
94	1	2023-12-11 11:23:27	2023-12-11 11:23:27
95	1	2023-12-11 11:23:27	2023-12-11 11:23:27
96	1	2023-12-11 11:23:27	2023-12-11 11:23:27
97	1	2023-12-11 11:23:27	2023-12-11 11:23:27
98	1	2023-12-11 11:23:27	2023-12-11 11:23:27
99	1	2023-12-11 11:23:27	2023-12-11 11:23:27
100	1	2023-12-11 11:23:27	2023-12-11 11:23:27
101	1	2023-12-11 11:23:27	2023-12-11 11:23:27
102	1	2023-12-11 11:23:27	2023-12-11 11:23:27
103	1	2023-12-11 11:23:27	2023-12-11 11:23:27
104	1	2023-12-11 11:23:27	2023-12-11 11:23:27
105	1	2023-12-11 11:23:27	2023-12-11 11:23:27
106	1	2023-12-11 11:23:27	2023-12-11 11:23:27
107	1	2023-12-11 11:23:27	2023-12-11 11:23:27
108	1	2023-12-11 11:23:27	2023-12-11 11:23:27
109	1	2023-12-11 11:23:27	2023-12-11 11:23:27
110	1	2023-12-11 11:23:27	2023-12-11 11:23:27
111	1	2023-12-11 11:23:27	2023-12-11 11:23:27
112	1	2023-12-11 11:23:27	2023-12-11 11:23:27
113	1	2023-12-11 11:23:27	2023-12-11 11:23:27
114	1	2023-12-11 11:23:27	2023-12-11 11:23:27
115	1	2023-12-11 11:23:27	2023-12-11 11:23:27
116	1	2023-12-11 11:23:27	2023-12-11 11:23:27
117	1	2023-12-11 11:23:27	2023-12-11 11:23:27
118	1	2023-12-11 11:23:27	2023-12-11 11:23:27
119	1	2023-12-11 11:23:27	2023-12-11 11:23:27
120	1	2023-12-11 11:23:27	2023-12-11 11:23:27
121	1	2023-12-11 11:23:27	2023-12-11 11:23:27
122	1	2023-12-11 11:23:27	2023-12-11 11:23:27
123	1	2023-12-11 11:23:27	2023-12-11 11:23:27
124	1	2023-12-11 11:23:27	2023-12-11 11:23:27
125	1	2023-12-11 11:23:27	2023-12-11 11:23:27
126	1	2023-12-11 11:23:27	2023-12-11 11:23:27
127	1	2023-12-11 11:23:27	2023-12-11 11:23:27
128	1	2023-12-11 11:23:27	2023-12-11 11:23:27
129	1	2023-12-11 11:23:27	2023-12-11 11:23:27
130	1	2023-12-11 11:23:27	2023-12-11 11:23:27
131	1	2023-12-11 11:23:27	2023-12-11 11:23:27
132	1	2023-12-11 11:23:27	2023-12-11 11:23:27
133	1	2023-12-11 11:23:27	2023-12-11 11:23:27
134	1	2023-12-11 11:23:27	2023-12-11 11:23:27
135	1	2023-12-11 11:23:27	2023-12-11 11:23:27
136	1	2023-12-11 11:23:27	2023-12-11 11:23:27
137	1	2023-12-11 11:23:27	2023-12-11 11:23:27
138	1	2023-12-11 11:23:27	2023-12-11 11:23:27
139	1	2023-12-11 11:23:27	2023-12-11 11:23:27
140	1	2023-12-11 11:23:27	2023-12-11 11:23:27
141	1	2023-12-11 11:23:27	2023-12-11 11:23:27
142	1	2023-12-11 11:23:27	2023-12-11 11:23:27
143	1	2023-12-11 11:23:27	2023-12-11 11:23:27
144	1	2023-12-11 11:23:27	2023-12-11 11:23:27
145	1	2023-12-11 11:23:27	2023-12-11 11:23:27
146	1	2023-12-11 11:23:27	2023-12-11 11:23:27
147	1	2023-12-11 11:23:27	2023-12-11 11:23:27
148	1	2023-12-11 11:23:27	2023-12-11 11:23:27
149	1	2023-12-11 11:23:27	2023-12-11 11:23:27
150	1	2023-12-11 11:23:27	2023-12-11 11:23:27
151	1	2023-12-11 11:23:28	2023-12-11 11:23:28
152	1	2023-12-11 11:23:28	2023-12-11 11:23:28
153	2	2023-12-11 11:23:28	2023-12-11 11:23:28
154	2	2023-12-11 11:23:28	2023-12-11 11:23:28
155	1	2023-12-11 11:23:28	2023-12-11 11:23:28
167	1	2023-12-11 11:23:28	2023-12-11 11:23:28
170	1	2023-12-11 11:23:28	2023-12-11 11:23:28
172	1	2023-12-11 11:23:28	2023-12-11 11:23:28
176	1	2023-12-11 11:23:28	2023-12-11 11:23:28
186	1	2023-12-11 11:23:28	2023-12-11 11:23:28
188	1	2023-12-11 11:23:28	2023-12-11 11:23:28
192	1	2023-12-11 11:23:28	2023-12-11 11:23:28
193	1	2023-12-11 11:23:28	2023-12-11 11:23:28
194	1	2023-12-11 11:23:28	2023-12-11 11:23:28
195	1	2023-12-11 11:23:28	2023-12-11 11:23:28
196	1	2023-12-11 11:23:28	2023-12-11 11:23:28
197	1	2023-12-11 11:23:28	2023-12-11 11:23:28
198	1	2023-12-11 11:23:28	2023-12-11 11:23:28
199	1	2023-12-11 11:23:28	2023-12-11 11:23:28
200	1	2023-12-11 11:23:28	2023-12-11 11:23:28
201	1	2023-12-11 11:23:28	2023-12-11 11:23:28
202	1	2023-12-11 11:23:28	2023-12-11 11:23:28
203	1	2023-12-11 11:23:28	2023-12-11 11:23:28
204	1	2023-12-11 11:23:28	2023-12-11 11:23:28
205	1	2023-12-11 11:23:28	2023-12-11 11:23:28
206	1	2023-12-11 11:23:28	2023-12-11 11:23:28
207	1	2023-12-11 11:23:28	2023-12-11 11:23:28
208	1	2023-12-11 11:23:28	2023-12-11 11:23:28
209	1	2023-12-11 11:23:28	2023-12-11 11:23:28
210	1	2023-12-11 11:23:28	2023-12-11 11:23:28
211	1	2023-12-11 11:23:28	2023-12-11 11:23:28
212	1	2023-12-11 11:23:28	2023-12-11 11:23:28
213	1	2023-12-11 11:23:28	2023-12-11 11:23:28
214	1	2023-12-11 11:23:28	2023-12-11 11:23:28
215	1	2023-12-11 11:23:28	2023-12-11 11:23:28
216	1	2023-12-11 11:23:28	2023-12-11 11:23:28
217	1	2023-12-11 11:23:28	2023-12-11 11:23:28
218	1	2023-12-11 11:23:28	2023-12-11 11:23:28
219	1	2023-12-11 11:23:28	2023-12-11 11:23:28
220	1	2023-12-11 11:23:28	2023-12-11 11:23:28
221	1	2023-12-11 11:23:28	2023-12-11 11:23:28
222	1	2023-12-11 11:23:28	2023-12-11 11:23:28
223	1	2023-12-11 11:23:28	2023-12-11 11:23:28
224	1	2023-12-11 11:23:28	2023-12-11 11:23:28
225	1	2023-12-11 11:23:28	2023-12-11 11:23:28
226	1	2023-12-11 11:23:28	2023-12-11 11:23:28
227	1	2023-12-11 11:23:28	2023-12-11 11:23:28
228	1	2023-12-11 11:23:28	2023-12-11 11:23:28
229	1	2023-12-11 11:23:29	2023-12-11 11:23:29
230	1	2023-12-11 11:23:29	2023-12-11 11:23:29
231	1	2023-12-11 11:23:29	2023-12-11 11:23:29
232	1	2023-12-11 11:23:29	2023-12-11 11:23:29
233	1	2023-12-11 11:23:29	2023-12-11 11:23:29
234	1	2023-12-11 11:23:29	2023-12-11 11:23:29
235	1	2023-12-11 11:23:29	2023-12-11 11:23:29
236	1	2023-12-11 11:23:29	2023-12-11 11:23:29
237	1	2023-12-11 11:23:29	2023-12-11 11:23:29
238	1	2023-12-11 11:23:29	2023-12-11 11:23:29
239	1	2023-12-11 11:23:29	2023-12-11 11:23:29
240	1	2023-12-11 11:23:29	2023-12-11 11:23:29
241	1	2023-12-11 11:23:29	2023-12-11 11:23:29
242	1	2023-12-11 11:23:29	2023-12-11 11:23:29
243	1	2023-12-11 11:23:29	2023-12-11 11:23:29
244	1	2023-12-11 11:23:29	2023-12-11 11:23:29
245	1	2023-12-11 11:23:29	2023-12-11 11:23:29
246	2	2023-12-11 11:23:29	2023-12-11 11:23:29
247	2	2023-12-11 11:23:29	2023-12-11 11:23:29
248	2	2023-12-11 11:23:29	2023-12-11 11:23:29
249	2	2023-12-11 11:23:29	2023-12-11 11:23:29
250	1	2023-12-11 11:23:29	2023-12-11 11:23:29
251	1	2023-12-11 11:23:29	2023-12-11 11:23:29
252	1	2023-12-11 11:23:29	2023-12-11 11:23:29
253	1	2023-12-11 11:23:29	2023-12-11 11:23:29
254	1	2023-12-11 11:23:29	2023-12-11 11:23:29
255	1	2023-12-11 11:23:29	2023-12-11 11:23:29
256	1	2023-12-11 11:23:29	2023-12-11 11:23:29
257	1	2023-12-11 11:23:29	2023-12-11 11:23:29
258	1	2023-12-11 11:23:29	2023-12-11 11:23:29
259	1	2023-12-11 11:23:29	2023-12-11 11:23:29
260	1	2023-12-11 11:23:29	2023-12-11 11:23:29
261	1	2023-12-11 11:23:29	2023-12-11 11:23:29
262	1	2023-12-11 11:23:29	2023-12-11 11:23:29
263	1	2023-12-11 11:23:29	2023-12-11 11:23:29
264	1	2023-12-11 11:23:29	2023-12-11 11:23:29
265	1	2023-12-11 11:23:29	2023-12-11 11:23:29
266	1	2023-12-11 11:23:29	2023-12-11 11:23:29
267	1	2023-12-11 11:23:29	2023-12-11 11:23:29
268	1	2023-12-11 11:23:29	2023-12-11 11:23:29
269	1	2023-12-11 11:23:29	2023-12-11 11:23:29
270	1	2023-12-11 11:23:29	2023-12-11 11:23:29
271	1	2023-12-11 11:23:29	2023-12-11 11:23:29
272	1	2023-12-11 11:23:29	2023-12-11 11:23:29
273	1	2023-12-11 11:23:29	2023-12-11 11:23:29
274	1	2023-12-11 11:23:29	2023-12-11 11:23:29
275	1	2023-12-11 11:23:29	2023-12-11 11:23:29
276	1	2023-12-11 11:23:29	2023-12-11 11:23:29
277	1	2023-12-11 11:23:29	2023-12-11 11:23:29
278	1	2023-12-11 11:23:29	2023-12-11 11:23:29
280	1	2023-12-11 11:23:29	2023-12-11 11:23:29
281	1	2023-12-11 11:23:29	2023-12-11 11:23:29
282	1	2023-12-11 11:23:29	2023-12-11 11:23:29
283	1	2023-12-11 11:23:29	2023-12-11 11:23:29
284	1	2023-12-11 11:23:29	2023-12-11 11:23:29
285	1	2023-12-11 11:23:29	2023-12-11 11:23:29
286	1	2023-12-11 11:23:29	2023-12-11 11:23:29
287	1	2023-12-11 11:23:29	2023-12-11 11:23:29
288	1	2023-12-11 11:23:29	2023-12-11 11:23:29
289	1	2023-12-11 11:23:29	2023-12-11 11:23:29
290	1	2023-12-11 11:23:29	2023-12-11 11:23:29
291	1	2023-12-11 11:23:29	2023-12-11 11:23:29
292	1	2023-12-11 11:23:29	2023-12-11 11:23:29
293	1	2023-12-11 11:23:29	2023-12-11 11:23:29
294	1	2023-12-11 11:23:29	2023-12-11 11:23:29
295	1	2023-12-11 11:23:29	2023-12-11 11:23:29
296	1	2023-12-11 11:23:29	2023-12-11 11:23:29
298	1	2023-12-11 11:23:30	2023-12-11 11:23:30
299	1	2023-12-11 11:23:30	2023-12-11 11:23:30
300	1	2023-12-11 11:23:30	2023-12-11 11:23:30
301	1	2023-12-11 11:23:30	2023-12-11 11:23:30
302	1	2023-12-11 11:23:30	2023-12-11 11:23:30
303	1	2023-12-11 11:23:30	2023-12-11 11:23:30
304	1	2023-12-11 11:23:30	2023-12-11 11:23:30
305	1	2023-12-11 11:23:30	2023-12-11 11:23:30
306	1	2023-12-11 11:23:30	2023-12-11 11:23:30
307	1	2023-12-11 11:23:30	2023-12-11 11:23:30
308	1	2023-12-11 11:23:30	2023-12-11 11:23:30
309	1	2023-12-11 11:23:30	2023-12-11 11:23:30
310	1	2023-12-11 11:23:30	2023-12-11 11:23:30
311	1	2023-12-11 11:23:30	2023-12-11 11:23:30
312	1	2023-12-11 11:23:30	2023-12-11 11:23:30
313	1	2023-12-11 11:23:30	2023-12-11 11:23:30
314	1	2023-12-11 11:23:30	2023-12-11 11:23:30
315	1	2023-12-11 11:23:30	2023-12-11 11:23:30
316	1	2023-12-11 11:23:30	2023-12-11 11:23:30
317	1	2023-12-11 11:23:30	2023-12-11 11:23:30
318	1	2023-12-11 11:23:30	2023-12-11 11:23:30
319	1	2023-12-11 11:23:30	2023-12-11 11:23:30
320	1	2023-12-11 11:23:30	2023-12-11 11:23:30
321	1	2023-12-11 11:23:30	2023-12-11 11:23:30
322	1	2023-12-11 11:23:30	2023-12-11 11:23:30
323	1	2023-12-11 11:23:30	2023-12-11 11:23:30
324	1	2023-12-11 11:23:30	2023-12-11 11:23:30
325	1	2023-12-11 11:23:30	2023-12-11 11:23:30
326	1	2023-12-11 11:23:30	2023-12-11 11:23:30
327	1	2023-12-11 11:23:30	2023-12-11 11:23:30
328	1	2023-12-11 11:23:30	2023-12-11 11:23:30
329	1	2023-12-11 11:23:30	2023-12-11 11:23:30
330	1	2023-12-11 11:23:30	2023-12-11 11:23:30
331	1	2023-12-11 11:23:30	2023-12-11 11:23:30
332	1	2023-12-11 11:23:30	2023-12-11 11:23:30
333	1	2023-12-11 11:23:30	2023-12-11 11:23:30
334	1	2023-12-11 11:23:30	2023-12-11 11:23:30
335	1	2023-12-11 11:23:30	2023-12-11 11:23:30
336	1	2023-12-11 11:23:30	2023-12-11 11:23:30
337	1	2023-12-11 11:23:30	2023-12-11 11:23:30
338	1	2023-12-11 11:23:30	2023-12-11 11:23:30
339	1	2023-12-11 11:23:30	2023-12-11 11:23:30
340	1	2023-12-11 11:23:30	2023-12-11 11:23:30
341	1	2023-12-11 11:23:30	2023-12-11 11:23:30
342	1	2023-12-11 11:23:30	2023-12-11 11:23:30
343	1	2023-12-11 11:23:30	2023-12-11 11:23:30
344	1	2023-12-11 11:23:30	2023-12-11 11:23:30
345	1	2023-12-11 11:23:30	2023-12-11 11:23:30
346	1	2023-12-11 11:23:30	2023-12-11 11:23:30
347	1	2023-12-11 11:23:30	2023-12-11 11:23:30
348	1	2023-12-11 11:23:30	2023-12-11 11:23:30
349	1	2023-12-11 11:23:30	2023-12-11 11:23:30
350	1	2023-12-11 11:23:30	2023-12-11 11:23:30
351	1	2023-12-11 11:23:30	2023-12-11 11:23:30
352	1	2023-12-11 11:23:30	2023-12-11 11:23:30
353	1	2023-12-11 11:23:30	2023-12-11 11:23:30
354	1	2023-12-11 11:23:30	2023-12-11 11:23:30
355	1	2023-12-11 11:23:30	2023-12-11 11:23:30
356	1	2023-12-11 11:23:30	2023-12-11 11:23:30
357	1	2023-12-11 11:23:30	2023-12-11 11:23:30
358	1	2023-12-11 11:23:30	2023-12-11 11:23:30
359	1	2023-12-11 11:23:30	2023-12-11 11:23:30
360	1	2023-12-11 11:23:31	2023-12-11 11:23:31
361	1	2023-12-11 11:23:31	2023-12-11 11:23:31
362	1	2023-12-11 11:23:31	2023-12-11 11:23:31
363	1	2023-12-11 11:23:31	2023-12-11 11:23:31
364	1	2023-12-11 11:23:31	2023-12-11 11:23:31
365	1	2023-12-11 11:23:31	2023-12-11 11:23:31
366	1	2023-12-11 11:23:31	2023-12-11 11:23:31
367	1	2023-12-11 11:23:31	2023-12-11 11:23:31
368	1	2023-12-11 11:23:31	2023-12-11 11:23:31
369	1	2023-12-11 11:23:31	2023-12-11 11:23:31
370	1	2023-12-11 11:23:31	2023-12-11 11:23:31
371	1	2023-12-11 11:23:31	2023-12-11 11:23:31
372	1	2023-12-11 11:23:31	2023-12-11 11:23:31
373	1	2023-12-11 11:23:31	2023-12-11 11:23:31
374	1	2023-12-11 11:23:31	2023-12-11 11:23:31
375	1	2023-12-11 11:23:31	2023-12-11 11:23:31
376	1	2023-12-11 11:23:31	2023-12-11 11:23:31
377	1	2023-12-11 11:23:31	2023-12-11 11:23:31
378	1	2023-12-11 11:23:31	2023-12-11 11:23:31
379	1	2023-12-11 11:23:31	2023-12-11 11:23:31
380	1	2023-12-11 11:23:31	2023-12-11 11:23:31
381	1	2023-12-11 11:23:31	2023-12-11 11:23:31
382	1	2023-12-11 11:23:31	2023-12-11 11:23:31
383	1	2023-12-11 11:23:31	2023-12-11 11:23:31
384	1	2023-12-11 11:23:31	2023-12-11 11:23:31
385	1	2023-12-11 11:23:31	2023-12-11 11:23:31
386	1	2023-12-11 11:23:31	2023-12-11 11:23:31
387	1	2023-12-11 11:23:31	2023-12-11 11:23:31
388	1	2023-12-11 11:23:31	2023-12-11 11:23:31
389	1	2023-12-11 11:23:31	2023-12-11 11:23:31
390	1	2023-12-11 11:23:31	2023-12-11 11:23:31
391	1	2023-12-11 11:23:31	2023-12-11 11:23:31
392	1	2023-12-11 11:23:31	2023-12-11 11:23:31
393	1	2023-12-11 11:23:31	2023-12-11 11:23:31
394	1	2023-12-11 11:23:31	2023-12-11 11:23:31
395	1	2023-12-11 11:23:31	2023-12-11 11:23:31
396	1	2023-12-11 11:23:31	2023-12-11 11:23:31
397	1	2023-12-11 11:23:31	2023-12-11 11:23:31
398	1	2023-12-11 11:23:31	2023-12-11 11:23:31
399	1	2023-12-11 11:23:31	2023-12-11 11:23:31
169	1	2023-12-11 11:56:45	2023-12-11 11:56:45
\.


--
-- Data for Name: lignes_emprunts; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.lignes_emprunts (id_ligne_emprunt, id_ouvrage, id_emprunt, etat_sortie, disponibilite, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: lignes_restitutions; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.lignes_restitutions (id_ligne_restitution, id_ouvrage, id_restitution, etat_entree, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: liquides; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.liquides (id_liquide, id_registration, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2014_10_12_000000_create_users_table	1
2	2014_10_12_100000_create_password_reset_tokens_table	1
3	2019_08_19_000000_create_failed_jobs_table	1
4	2019_12_14_000001_create_personal_access_tokens_table	1
5	2022_08_16_111201_create_auteurs_table	1
6	2022_08_16_111338_create_abonnes_table	1
7	2022_08_16_112251_create_personnels_table	1
8	2022_08_16_113936_create_classification_dewey_centaines_table	1
9	2022_08_16_113937_create_classification_dewey_dizaines_table	1
10	2022_08_16_114055_create_tarif_abonnements_table	1
11	2022_08_16_114359_create_registrations_table	1
12	2022_08_16_114948_create_tmoneys_table	1
13	2022_08_16_115103_create_floozs_table	1
14	2022_08_16_115151_create_liquides_table	1
15	2022_08_16_115309_create_emprunts_table	1
16	2022_08_18_152504_create_restitutions_table	1
17	2022_08_19_105055_create_ouvrage_reservation_table	1
18	2022_12_03_182439_create_jobs_table	1
19	2023_03_07_144508_create_activites_table	1
20	2023_12_08_074741_create_types_ouvrages_table	1
21	2023_12_08_074914_create_langues_table	1
22	2023_12_08_074938_create_natures_table	1
23	2023_12_08_075435_create_niveaux_table	1
24	2023_12_09_105124_create_permission_tables	1
25	2023_12_09_165620_create_ouvrages_table	1
26	2023_12_10_074927_create_domaines_table	1
27	2023_12_10_154133_create_domaines_ouvrages_table	1
28	2023_12_11_082705_create_langues_ouvrages_table	1
29	2023_12_11_094255_create_auteurs_ouvrages_table	1
30	2023_12_11_115852_create_reservations_table	1
31	2023_12_11_120207_create_approvisionnements_table	1
32	2023_12_11_200849_create_lignes_emprunts_table	1
33	2023_12_12_210425_create_lignes_restitutions_table	1
\.


--
-- Data for Name: model_has_permissions; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.model_has_permissions (permission_id, model_type, model_id) FROM stdin;
\.


--
-- Data for Name: model_has_roles; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.model_has_roles (role_id, model_type, model_id) FROM stdin;
2	App\\Models\\User	1
1	App\\Models\\User	1
2	App\\Models\\User	2
3	App\\Models\\User	3
3	App\\Models\\User	4
3	App\\Models\\User	5
\.


--
-- Data for Name: natures; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.natures (id_nature, libelle, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: niveaux; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.niveaux (id_niveau, libelle, created_at, updated_at) FROM stdin;
1	primaire	\N	\N
2	collège	\N	\N
3	lycée	\N	\N
4	université	\N	\N
\.


--
-- Data for Name: ouvrage_reservation; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.ouvrage_reservation (ouvrage_physique_id_ouvrage_physique, reservation_id_reservation, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: ouvrages; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.ouvrages (id_ouvrage, cote, titre, mot_cle, resume, annee_apparution, lieu_edition, id_niveau, id_type, image, id_langue, ressources_externe, isbn, nombre_exemplaire, documents, created_at, updated_at, deleted_at) FROM stdin;
1	c4ca4238a0b923820dcc509a6f75849b	le travail du bois	["dessin"]		2004	Edition vial	1	16	/storage/books/logo.png	\N		2-85101-130-8	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
2	c81e728d9d4c2f636f067f89cc14862c	les bases de la mécanique appliquée	["m\\u00e9canique g\\u00e9n\\u00e9rale"]		1996	Paris	1	16	/storage/books/logo.png	\N		2-206-00788-6	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
3	eccbc87e4b5ce2fe28308fd9f2a7baf3	travaux de construction	["construction"]		1996	Foucher	1	16	/storage/books/logo.png	\N		2-216-03546-7	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
4	a87ff679a2f3e71d9181a67b7542122c	construction mécanique 1	["transmission de puissance 1"]		2000	Dunod	1	16	/storage/books/logo.png	\N		2-10-049125-3	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
5	e4da3b7fbbce2345d7772b0674a318d5	construction mécanique 2	["transmission de puissance 2"]		2001	Dunod	1	16	/storage/books/logo.png	\N		2-10-005402-3	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
6	1679091c5a880faf6fb5e6087eb1b2dc	construction mécanique 3	["transmission de puissance 3"]		2002	Dunod	1	16	/storage/books/logo.png	\N		2-10-00-55-12 7	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
7	8f14e45fceea167a5a36dedd4bea2543	bâtiment 1 dessin	["\\u00e9quipement g\\u00e9n\\u00e9ralit\\u00e9"]		2003	Paris	1	16	/storage/books/logo.png	\N		2-206-00306-6	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
8	c9f0f895fb98ab9159f51fd0297e236d	bâtiment 2 dessin	["construction b\\u00e2timent"]		1990	Paris	1	16	/storage/books/logo.png	\N		2-206-00665-0	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
9	45c48cce2e2d7fbdea1afc51c7c6ad26	bâtiment 2  dessin	["\\u00e9l\\u00e9ments de construction"]		1990	Paris	1	16	/storage/books/logo.png	\N		2-206-00665-0	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
10	d3d9446802a44259755d38e6d163e820	dessin  technique 1	["lecture de plan"]		1996	Paris	1	16	/storage/books/logo.png	\N		2-216-03266-2	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
11	6512bd43d9caa6e02c990b0a82652dca	dessin  technique 2	["\\u00e9lectricit\\u00e9"]		1991	Paris	1	16	/storage/books/logo.png	\N		2-7135-1161-5	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
12	c20ad4d76fe97759aa27a0c99bff6710	mesures et essais sur circuits électriques et dispositifs électriques tome 2	["\\u00e9lectricit\\u00e9"]		1992	Paris	1	16	/storage/books/logo.png	\N		2-7135-1184-4	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
13	c51ce410c124a10e0db5e4b97fc2af39	mesures et essais sur circuits électriques et dispositifs électriques tome 1	["\\u00e9lectricit\\u00e9"]		1995	Paris	1	16	/storage/books/logo.png	\N		2-206-00738-X	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
14	aab3238922bcc25a6f606eb525ffdc56	schémas et etude d-équipements	["dessin"]		1990	Paris	1	16	/storage/books/logo.png	\N		2-04-018976-9	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
15	9bf31c7ff062936a96d3c8bd1f8f2ff3	ateliers de dessin technique	["fabrications m\\u00e9caniques"]		2002	Paris	1	16	/storage/books/logo.png	\N		2-7135-2282.X	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
16	c74d97b01eae257e44aa9d5bade97baf	memo-formulaire fabrications mécaniques	["fabrications des pi\\u00e8ces"]		2004	paris	1	16	/storage/books/logo.png	\N		2-216-09389-0	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
17	70efdf2ec9b086079795c442636b55fb	production  mécanique: de la conduite à l-industrialisation	["calcul"]		2002	Paris	1	16	/storage/books/logo.png	\N		2-7298-0912-0	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
18	6f4922f45568161a8cdf4ad2299f6d23	machines électriques théorie et mise en œuvre	["construction bois"]		2004	Paris	1	16	/storage/books/logo.png	\N		2-88074-609-4	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
19	1f0e3dad99908345f7439f8ffabdffc4	construction en bois volume 13	["physique"]		2002	Paris	1	16	/storage/books/logo.png	\N		2-09-178602-0	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
20	98f13708210194c475687be6106a3b84	physique  appliquée	["exercices"]		2001	Paris	1	16	/storage/books/logo.png	\N		2-216-08937-6	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
21	3c59dc048e8850243be8079a5c74d079	mathématiques	["dactylo"]		1991	Paris	1	16	/storage/books/logo.png	\N		2-7352-0179-5	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
22	b6d767d2f8ed5d21a44b0e5886680cb9	initiation à  la dactylographie	["st\\u00e9no"]		1991	Paris	1	16	/storage/books/logo.png	\N		2-7352-0010-8	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
23	37693cfc748049e45d87b8c7d8b9aacd	cours complet de sténographie	["calcul pour les constructions"]		1987	Paris	1	16	/storage/books/logo.png	\N		2-89105-328-1	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
24	1ff1de774005f8da13f42943881c655f	béton arme calcul aux états limites théorie et pratique 2è édition	[""]		2002	Paris	1	16	/storage/books/logo.png	\N		2-7135-2371-0	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
25	8e296a067a37563370ded05f5a3bf3ec	le grafcet conception-implantation dans les automates programmables industriels	["\\u00e9lectricit\\u00e9"]		1996	Paris	1	16	/storage/books/logo.png	\N		2-09-177 224-0	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
26	4e732ced3463d06de0ca9a15b6153677	electricité lois générales	["\\u00e9lectricit\\u00e9"]		2008	Paris	1	16	/storage/books/logo.png	\N		978-2-84138-342-9	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
27	02e74f10e0327ad868d138f2b4fdd6f0	produire son électricité	["\\u00e9lectricit\\u00e9"]		1995	Paris	1	16	/storage/books/logo.png	\N		2-01-11-6575-X	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
28	33e75ff09dd601bbe69f351039152189	guide du technicien en électronique	["m\\u00e9canique"]		2005	Paris	1	16	/storage/books/logo.png	\N		2-206-00061-x	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
29	6ea9ab1baa0efb9e19094440c317e21b	mécanique première partie	[""]		1998	Paris	1	16	/storage/books/logo.png	\N		978-2-09-882574-1	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
30	34173cb38f07f89ddbebc2ac9128303f	la  climatisation	[""]		1997	Paris	1	16	/storage/books/logo.png	\N		79978-2-09-882566-6	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
31	c16a5320fa475530d9583c34fd356ef5	l-isolation et l-étanchéité	[""]		1998	Paris	1	16	/storage/books/logo.png	\N		978-2-09-882571-0	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
32	6364d3f0f495b6ab9dcf8d3b5c6e0b01	le plâtrier	["math\\u00e9matique"]		2004	Economica	1	16	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
33	182be0c5cdcd5072bb1864cdee4d3d6e	mathématique financières questions et exercices corrigés	["math\\u00e9matique"]		2002	Economica	1	16	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
34	e369853df766fa44e1ed0ff613f563bd	500 exercices corrigés de mathématiques pour l-économie et la gestion	["m\\u00e9canique"]		2000	Paris	1	16	/storage/books/logo.png	\N		2-7056-6121-2	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
35	1c383cd30b7c298ab50293adfecb7b18	mécanique quantique ii	["bois"]		2004	Paris	1	16	/storage/books/logo.png	\N		2-212-11446-X	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
36	19ca14e7ea6328a42e0eb13d585e4c22	assemblages en bois	[""]		2001	Apce	1	16	/storage/books/logo.png	\N		2-7081-2584-2	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
37	a5bfc9e07964f8dddeb95fc584cd965d	devenez artisan du bâtiment!	["math"]		1998	Paris	1	16	/storage/books/logo.png	\N		2-7011-2501-4	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
38	a5771bce93e200c36f7cd9dfd0e5deaa	mathematique terminale. s analyse	["l'habillement soie"]		\N	paris	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
39	d67d8ab4f4c10bf22aa353e27879133c	technologie des métiers de l-habillement textiles	["st\\u00e9nographies simplifi\\u00e9e"]		\N	paris	1	16	/storage/books/logo.png	\N		2-7352-0015-9	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
40	d645920e395fedad7bbbed0eca3fe2e0	90 gammes et 90 dictées	["exercices"]		1997	Paris	1	16	/storage/books/logo.png	\N		2-7135-1648-x	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
41	3416a75f4cea9109507cacd8e2f2aefc	le photovoltaïque pour tous conception et réalisation d-installations	["photovolta\\u00efque"]		2010	Berlin	1	16	/storage/books/logo.png	\N		978-2-913620-48-3	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
42	a1d0c6e83f027327d8461063f4ac58a6	electrotechnique des énergies renouvelables et de la cogénération	["\\u00e9lectronique"]		2008	Paris	1	16	/storage/books/logo.png	\N		978-2-10-051544-8	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
43	17e62166fc8586dfa4d1bc0e1742c08b	travaux de maçonnerie	["structure de la maison"]		2001	Paris	1	16	/storage/books/logo.png	\N		2-7328-3223-5	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
44	f7177163c833dff4b38fc8d2872f1ec6	plate-forme de forage	[""]		\N	Paris	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
45	6c8349cc7260ae62e3b1396831a8398f	rapport sur l-inventaire et le diagnostic de l’installation utilisant les énergies renouvelables au togo	[""]		1999	\N	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
46	d9d4f495e875a2e075a1a4a6e1b9770f	manuel de formation en énergie solaire photovoltaïque au togo 1	[""]		2016	\N	1	16	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
47	67c6a1e7ce56d3d6fa748ab6d9af3fd7	solartrainer	[""]		2009	Togo	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
48	642e92efb79421734881b53e1e1b18b6	manuel  en énergie solaire photovoltaïque au togo	[""]		2009	Togo	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
49	f457c545a9ded88f18ecee47145a72c0	une plate-forme de forage	[""]		1977	Paris	1	16	/storage/books/logo.png	\N		2-7130-0340-7	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
50	c0c7c76d30bd3dcaefc96f40275bdc0a	vingt-cinq ans sur les volcans du globe	[""]		1975	Paris	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
51	2838023a778dfaecdc212708f721b788	manuel de formation en énergie solaire photovoltaïque au togo 2	[""]		2014	Togo	1	16	/storage/books/logo.png	\N		\N	4	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
52	9a1158154dfa42caddbd0694a4e9bdc8	physique  appliquée  génie mécanique	["exercices"]		1995	Paris	1	16	/storage/books/logo.png	\N		2-01-166888-3	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
53	d82c8d1619ad8176d665453cfb2e55f0	l-énergie solaire et photovoltaïque pour le particulier	["panneaux"]		2008	Paris	1	16	/storage/books/logo.png	\N		978-2-212-12221-3	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
54	a684eceee76fc522773286a895bc8436	rural électrification photovoltaïques	["Silicone"]		2009	Stiffung	1	16	/storage/books/logo.png	\N		978-3-033-01926-3	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
55	b53b3a3d6ab90ce0268229151c9bde11	installations photovoltaïques et solaires	["besoins"]		2007	Francis verlag	1	16	/storage/books/logo.png	\N		978-2-7372-4586-2	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
56	9f61408e3afb633e50cdf1b20de6f466	physique des cellules solaires a base de silicium cristallin	["physique solaire"]		2012	Awoudy	1	16	/storage/books/logo.png	\N		978-10-91011-08-2	7	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
57	72b32a1f754ba1c09b3695e0cb6cde7f	cours complet sur l-informatique	["notion sur l'informatique"]		\N	\N	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
58	66f041e16a60928b05a7e228a89c3799	mathématiques terminale s dimatheme	["fonction"]		1994	Paris	1	16	/storage/books/logo.png	\N		2-278-04386-2	1	\N	2023-12-11 11:23:26	2023-12-11 11:23:26	\N
59	093f65e080a295f8076b1c5722a46aa2	gestion comptable	["dossier"]		1997	Paris	1	16	/storage/books/logo.png	\N		2-216-03375-8	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
60	072b030ba126b2f4b2374f342be9ed44	economie et organisation des entreprises  secondes g	["entreprises"]		\N	Togo	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
61	7f39f8317fbdb1988ef4c628eba02591	comptabilite  nationale	["cadre du syst\\u00e8me"]		2003	Paris	1	16	/storage/books/logo.png	\N		2-7178-48-712-x	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
62	44f683a84163b3523afe57c2e008bc8c	comptabilite analytique 4è édition	["standards"]		2003	Paris	1	16	/storage/books/logo.png	\N		2-7178-4678-6	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
63	03afdbd66e7929b125f8597834fa83a4	comptabilite  générale  techniques  quantitatives de gestion	["exercices"]		2001	Paris	1	16	/storage/books/logo.png	\N		2-16-08770-x	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
64	ea5d2f1c4608232e07d3aa3d998e5135	comptabilite  générale niveau  1	["exercices et corrig\\u00e9s indicatifs"]		2009	Butodra	1	16	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
65	fc490ca45c00b1249bbe3554a4fdf6fb	technique quantitative de gestion niveau 3	["exercices et sujets d'examen"]		2009	 Butodra	1	16	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
66	3295c76acbf4caaed33c36b1b5fc2cb1	comptabilite générale programme des classes g2, g3, 2è année cap/ac	["exercices corrig\\u00e9s"]		2014	Collection	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
67	735b90b4568125ed6c3f678819b6e058	comptabilite générale  programme des classes g2, g3, 1ère année cap/ac	["exercices corrig\\u00e9s"]		2014	Collection	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
68	a3f390d88e4c41f2747bfa2f1b5f87db	mathématiques au quotidien  classes g2, et g3 1ère	["exercices "]		2008	\N	1	16	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
69	14bfa6bb14875e45bba028a21ed38046	mathématique au quotidien des classes de terminales g2et g3	["exercices"]		2008	\N	1	16	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
70	7cbbc409ec990f19c78c75bd1e06f215	mathématique au quotidien des classes  de secondes g2et g3	["exercices"]		2008	\N	1	16	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
71	e2c420d928d4bf8ce0ff2ec19b371514	economie et organisation des entreprises première g	["exercices"]		\N	Collection butodra	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
72	32bb90e8976aab5298d5da10fe66f21d	analyse  économique: les concepts de base	["les concepts"]		1996	Grignoble	1	16	/storage/books/logo.png	\N		2-7061-0704-9	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
73	d2ddea18f00665ce8623e36bd4e3c7c5	français bts  annabts  corrigés	["synth\\u00e8se de documents"]		1999	Paris	1	15	/storage/books/logo.png	\N		2-218-72897-4	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
74	ad61ab143223efbc24c7d2583be69251	français bts  annabts  corrigés	["sujets et corrig\\u00e9s"]		2002	Paris	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
75	d09bf41544a3365a46c9077ebb5e35c3	français bts annabts corrigés tout le programme corrigé	["sujets"]		1994	Paris	1	15	/storage/books/logo.png	\N		2-218-06671-2	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
76	fbd7939d674997cdb4692d34de8633c4	thématique de l-économie générale baccalauréat première partie	["exercices"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
77	28dd2c7955ce926456240b2ff0100bde	economie générale terminales g  et bts 2 	["travaux dirig\\u00e9s corrig\\u00e9s"]		2004	Butodra	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
78	35f4a8d465e6e1edc05f3d8ab658c551	précis de fiscalité des entreprises	["le coin des amateurs"]		2006	Paris	1	15	/storage/books/logo.png	\N		2-7110-0697-2	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
79	d1fe173d08e959397adf34b1d77e88d7	comptabilite générale niveau 2	["exercices et corrig\\u00e9s indicatifs"]		2009	Butodra	1	16	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
80	f033ab37c30201f73f142449d037028d	dpecf 4 annales 2004 comptabilités	["corrig\\u00e9s comment\\u00e9s"]		2004	Paris	1	15	/storage/books/logo.png	\N		2-10-007419-9	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
81	43ec517d68b6edd3015b3edc9a11367b	dpecf 3 annales2004 corrigés commentés méthodes quantitatives	["corrig\\u00e9s comment\\u00e9s"]		2004	Paris	1	15	/storage/books/logo.png	\N		2-10-007418-0	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
82	9778d5d219c5080b9a6a17bef029331c	dpecf 3 manuel et applications méthodes quantitatives	["exercices"]		2003	Paris	1	15	/storage/books/logo.png	\N		2-10-007861-5	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
83	fe9fc289c3ff0af142b6d3bead98a923	dpecf 1et 2 annales 2004	["corrig\\u00e9s comment\\u00e9s"]		2004	Paris	1	15	/storage/books/logo.png	\N		2-10-007417-2	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
84	68d30a9594728bc39aa24be94b319d21	le français en bts nouvelles épreuves nouveau programme	["culture g\\u00e9n\\u00e9rale et expression"]		2006	Paris	1	15	/storage/books/logo.png	\N		2-09-179897-5	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
85	3ef815416f775098fe977004015c6193	mathématiques financières bac et bts 1ère édition	["sujets et exercices corrig\\u00e9s"]		2003	Le succes	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
86	93db85ed909c13838ff95ccfa94cebd9	economie  première  stg nouvelle édition	["agents"]		2007	Paris	1	15	/storage/books/logo.png	\N		978-2-01-180434-1	9	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
87	c7e1249ffc03eb9ded908c236bd1996d	mercatique  terminale  stg 	["activit\\u00e9s"]		2008	Nathan	1	15	/storage/books/logo.png	\N		978-2-09-160560-9	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
88	2a38a4a9316c49e5a833517c45d31070	management des organisations terminales stg nouvelle édition enrichie	["strat\\u00e9gie"]		2008	Nathan	1	15	/storage/books/logo.png	\N		978-2-09-160566-1	11	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
89	7647966b7343c29048673252e490f736	management des organisations première stg  édition mise à jour	["l'\\u00e9volution historique"]		2009	 Nathan	1	15	/storage/books/logo.png	\N		978-2-09-161082-5	11	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
90	8613985ec49eb8f757ae6439e879bb2a	information et communication 1ère  gestion  stg nouvelle édition	["cours"]		2007	Foucher	1	15	/storage/books/logo.png	\N		978-2-216-10414-7	8	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
91	54229abfcfa5649e7003b83dd4755294	information et communication 1ère  gestion  stg nouvelle édition	["cours"]		2007	Foucher	1	15	/storage/books/logo.png	\N		978-2-216-10412-3	7	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
92	92cc227532d17e56e07902b254dfad10	informatique de gestion et de communication enseignement de détermination	["activit\\u00e9s"]		2009	Fontaine	1	15	/storage/books/logo.png	\N		978-2-7446-1897-0	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
93	98dce83da57b0395e163467c9dae521b	information et gestion spécialité communication première stg	["exercices"]		2009	Fontaine	1	15	/storage/books/logo.png	\N		978-2-7446-1899-4	10	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
94	f4b9ec30ad9f68f89b29639786cb62ef	informatique de gestion et de communication  enseignement de détermination seconde	["activit\\u00e9s"]		2009	Fontaine	1	15	/storage/books/logo.png	\N		978-2-7446-1897-0	9	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
95	812b4ba287f5ee0bc9d43bbf5bbe87fb	td-préparation aux épreuves de spécialité cfe terminale stg	["activit\\u00e9s"]		2008	Fontaine	1	15	/storage/books/logo.png	\N		978-2-7446-1730-0	8	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
96	26657d5ff9020d2abefe558796b99584	mesures physiques et informatique seconde	["activit\\u00e9s"]		2003	Hachette	1	15	/storage/books/logo.png	\N		2-01-13-5328-9	12	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
97	e2ef524fbf3d9fe611d5a8e90fefdc9c	ciam  mathématiques  terminale  s m  guide pédagogique	["calcul des d\\u00e9riv\\u00e9s"]		2006	Edicef	1	15	/storage/books/logo.png	\N		978-2-84129-923-2	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
98	ed3d2c21991e3bef5e069713af9fa6ca	ciam  mathématiques  terminale s m 	["exercices"]		1999	Edicef	1	15	/storage/books/logo.png	\N		2-84-129554-0	4	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
99	ac627ab1ccbdb62ec96e702f07f6425b	ciam déclic math terminale s enseignement obligatoire	["exercices et fonction"]		2002	Hachette	1	15	/storage/books/logo.png	\N		2-01-13-55296-7	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
100	f899139df5e1059396431415e770c6dd	ciam  mathématique  première s	["cours"]		2001	Berlin	1	15	/storage/books/logo.png	\N		2-7011-2901-X	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
101	38b3eff8baf56627478ec76a704e9b52	ciam mathématique  seconde s avec thème d-étude	["exercices"]		2000	Berlin	1	15	/storage/books/logo.png	\N		2-7011-2718-1	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
102	ec8956637a99787bd197eacd77acce5e	ciam  mathématique  première s m  	["exercices"]		1998	Edicef	1	15	/storage/books/logo.png	\N		2-84-129350	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
103	6974ce5ac660610b44d9b9fed0ff9548	mimatheme  mathématiques  terminale  s	["exercices"]		1994	Paris	1	15	/storage/books/logo.png	\N		2-278-047386-2	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
104	c9e1074f5b3f9fc8ea15d152add07294	mimatheme  mathématiques  terminale  s	["exercices"]		1994	Paris	1	15	/storage/books/logo.png	\N		278-04388-9	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
105	65b9eea6e1cc6bb9f0cd2a47751a186f	ciam  mathématiques terminale scientifique option sciences expérimentales	["exercices"]		1999	Edicef	1	15	/storage/books/logo.png	\N		2-84-129478-1	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
106	f0935e4cd5920aa6c7c996a5ee53a70f	ciam  mathématiques  seconde  s	["d\\u00e9monstration"]		1997	Edicef	1	15	/storage/books/logo.png	\N		2-84-129216-9	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
107	a97da629b098b75c294dffdc3e463904	ciam  mathématiques  littéraire  terminale  guide pédagogique	["d\\u00e9monstration"]		2003	Edicef	1	15	/storage/books/logo.png	\N		978-2-84129-8	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
108	a3c65c2974270fd093ee8a9bf8ae7d0b	ciam  mathématiques  littéraire  terminale	["exercices"]		2002	Edicef	1	15	/storage/books/logo.png	\N		2-84-129836-1	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
109	2723d092b63885e0d7c260cc007e8b9d	ciam  mathématiques  littéraire   première	["exercices"]		2001	Edicef	1	15	/storage/books/logo.png	\N		2-84129757-8	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
110	5f93f983524def3dca464469d2cf9f3e	ciam  mathématiques  littéraire  première   guide  pédagogique	["exercices"]		2002	Edicef	1	15	/storage/books/logo.png	\N		978-284129-835-8	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
111	698d51a19d8a121ce581499d7b701668	ciam mathématiques  littéraire   seconde guide pédagogique	["exercices"]		2001	Edicef	1	15	/storage/books/logo.png	\N		978-2-84129-779-5	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
112	7f6ffaa6bb0b408017b62254211691b5	ciam  mathématiques littéraire seconde	["exercices et fonction"]		2000	Edicef	1	15	/storage/books/logo.png	\N		2-84-129653-9	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
113	73278a4a86960eeb576a8fd4c9ec6997	physique collection eurin-gié terminale c été nouvelle édition	["document"]		1989	Hachette	1	15	/storage/books/logo.png	\N		2-01.014724.3	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
114	5fd0b37cd7dbbb00f97ba6ce92bf5add	physique  terminale  c et d  collection arex	["document"]		2000	Africain	1	15	/storage/books/logo.png	\N		2-85049-841-6	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
115	2b44928ae11fb9384c4cf38708677c48	chimie  terminale  c  collection arex	["cours et exercices"]		2000	Africain	1	15	/storage/books/logo.png	\N		2-85049-842-4	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
116	c45147dee729311ef5b5c3003946c48f	physique  1ère s et e collection eurin-gié	["document"]		1988	Hachette	1	15	/storage/books/logo.png	\N		2-01-013486-9	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
117	eb160de1de89d9058fcb0b968dbbbd68	chimie  1ère s et e collection eurin-gié	["document"]		1988	Hachette	1	15	/storage/books/logo.png	\N		2-01-013487-7	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
118	5ef059938ba799aaa845e1c2e8a762bd	chimie  terminale d collection eurin-gié	["document"]		1989	Hachette	1	15	/storage/books/logo.png	\N		2-01-014725-1	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
119	07e1cd7dca89a1678042477183b7ac3f	physique et chimie seconde collection eurin-gié	["document"]		1987	Hachette	1	15	/storage/books/logo.png	\N		2-01-010886-8	4	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
120	da4fb5c6e93e74d3df8527599fa62642	physique   chimie  seconde  c  collection arex	["document"]		1999	Africain	1	15	/storage/books/logo.png	\N		2-85049-806-8	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
121	4c56ff4ce4aaf9573aa5dff913df997a	physique   chimie  seconde  livre du professeur	["manuel"]		1993	Hatier	1	15	/storage/books/logo.png	\N		2-218-05909-6	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
122	a0a080f42e6f13b3a2df133f073095dd	mathématiques  premières 	["exercices et probl\\u00e8mes"]		1998	Foucher	1	15	/storage/books/logo.png	\N		2-216-03995-0	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
123	202cb962ac59075b964b07152d234b70	sciences  physiques  première 	["manuel de cours"]		\N	Gado	1	15	/storage/books/logo.png	\N		99919-931-5-0	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
124	c8ffe9a587b126f152ed3d89a146b445	sciences physiques terminale c, d et e 10ème édition	["cours"]		2003	Gado	1	15	/storage/books/logo.png	\N		99919-931-1-8	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
125	3def184ad8f4755ff269862ea77393dd	physique  chimie terminale cde tome 1 collection oxygène	["exercices"]		2001	Le succes	1	15	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
126	069059b7ef840f0c74a814ec9237b6ec	mathématiques première  c et d collections oxygène tout le programme	["cours"]		2004	Le succes	1	15	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
127	ec5decca5ed3d6b8079e2e7e7bacc9f2	mathématique  terminale d c b a collection oxygéné	["r\\u00e9sum\\u00e9s de cours"]		2000	Le succes	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
128	76dc611d6ebaafc66cc0879c71b5db5c	physique première collection oxygéné	["r\\u00e9sum\\u00e9s de cours"]		\N	Le succes	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
129	d1f491a404d6854880943e5c3cd9ca25	chimie première collection oxygéné	["r\\u00e9sum\\u00e9s de cours"]		2002	Le succes	1	15	/storage/books/logo.png	\N		99919-974-4-x	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
130	9b8619251a19057cff70779273e95aa6	physique-chimie seconde  première  édition collection oxygéné	["r\\u00e9sum\\u00e9s de cours"]		2002	Le succes	1	15	/storage/books/logo.png	\N		99919-973-4-2	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
131	1afa34a7f984eeabdbb0a7d494132ee5	sciences de la vie et de la terre seconde  collection oxygène	["r\\u00e9sum\\u00e9s de cours"]		2000	Le succes	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
132	65ded5353c5ee48d0b7d48c591b8f430	sciences de la vie et de la terre bac  a b c d collections oxygène	["r\\u00e9sum\\u00e9s de cours"]		2000	Le succes	1	15	/storage/books/logo.png	\N		99919-974-6-6	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
133	9fc3d7152ba9336a670e36d0ed79bc43	sciences  physiques troisième 3e édition complétée	["sujets d'examen"]		2004	Le succes	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
134	02522a2b2726fb0a03bb19f2d8d9524d	sciences de la vie et de la terre première c d a,  collection oxygène	["r\\u00e9sum\\u00e9s de cours"]		2002	Le succes	1	15	/storage/books/logo.png	\N		99919-974-5-8	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
135	7f1de29e6da19d22b51c68001e7e0e54	annales corrigées du bac 1 s v t série d	["les sujets corrig\\u00e9s"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
136	42a0e188f5033bc65bf8d78622277c4e	svt terminale c-d 	["66 sujets corrig\\u00e9s"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
137	3988c7f88ebcb58c6ce932b957b6f332	l-année de la seconde	["cours"]		2002	Bordas	1	15	/storage/books/logo.png	\N		2-04-730096-7	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
138	013d407166ec4fa56eb1e1f8cbe183b9	l-année de la première	["cours"]		2001	Bordas	1	15	/storage/books/logo.png	\N		2-04730616-7	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
139	e00da03b685a0dd18fb6a08af0923de0	l-année de la terminale	["cours"]		2004	Bordas	1	15	/storage/books/logo.png	\N		2-04-730529-2	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
140	1385974ed5904a438616ff7bdb3f7439	wake up vol 1 . et vol 2	["sujets anglais"]		2014	Butodra	1	15	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
141	0f28b5d49b3020afeecd95b4009adf4c	traite d’analyse grammaticale et logique	["grammaires"]		\N	Cered	1	15	/storage/books/logo.png	\N		978-99919-71-68-1	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
142	a8baa56554f96369ab93e4f3bb068c22	les secrets de la langue anglaise	["conjugaison"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
143	903ce9225fca3e988c2af215d4e544d3	7000 lettres et courriers types	[""]		\N	\N	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
144	0a09c8844ba8f0936c20bd791130d6b6	annale mathématique  troisième  collection oxygène	["r\\u00e9sum\\u00e9s"]		1998	\N	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
145	2b24d495052a8ce66358eb576b8912c8	lumière du b. e. p. c s v t troisième	["sujets"]		2008	Lumiere	1	15	/storage/books/logo.png	\N		2-916481-03-6	5	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
146	a5e00132373a7031000fd987a3c9f87b	bepc au togo sciences physiques 	["sujets -corrig\\u00e9s"]		2014	Bref	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
147	8d5e957f297893487bd98fa830fa6413	bepc au togo anglais	["sujets -corrig\\u00e9s"]		2014	Bref	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
148	47d1e990583c9c67424d369f3414728e	bepc au togo histoire et géographie	["sujets -corrig\\u00e9s"]		2014	Bref	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
149	f2217062e9a397a1dca429e7d70bc6ca	education  civique et  moral	["sujets -corrig\\u00e9s"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
150	7ef605fc8dba5425d6965fbd4c8fbe1f	bepc au togo s v t  troisième	["sujets -corrig\\u00e9s"]		2014	Bref	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:27	2023-12-11 11:23:27	\N
151	a8f15eda80c50adb0e71943adc8015cf	annale  du   cepd   au togo	["sujets"]		2014	Bref	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
152	37a749d808e46495a8da1e5352d03cae	annale du cepd au togo	["sujets -corrig\\u00e9s"]		2014	Togo	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
153	b3e3e393c77e35a4a3f3cbd1e429b5dc	le génie annales corrigées du bac première série a4	["verbes"]		1997	Terre d'afrique	1	15	/storage/books/logo.png	\N		2-7027-0078-0	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
154	1d7f7abc18fcb43975065399b0d1e48e	je me débrouille en anglais	["verbes"]		2007	Pocket	1	15	/storage/books/logo.png	\N		978-2-266-17873-0	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
155	2a79ea27c279e471f4d180b08d62b00a	la grammaire anglaise pour tous	["cours"]		2005	Bordas	1	15	/storage/books/logo.png	\N		2-04-732039-9	9	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
156	1c9ac0159c94d8d0cbedc973445af2da	histoire   seconde	["textbuch 1 arbeitsbuch 1"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
157	6c4b761a28b734fe93831e3fb400ce87	ihr und wir plus	["th\\u00e8mes et les propositions"]		\N	Stuttgart	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
158	06409663226af2f3114485aa4e0a23b4	exercices de grammaire et de style	["textbuch 2"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
159	140f6969d5213fd0ece03148e62e461e	ihr und wir	["textbuch3"]		\N	\N	1	15	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
160	b73ce398c39f506af761d2277d853a92	ihr und wir	["le\\u00e7ons"]		1994	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523350-X	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
161	bd4c9ab730f5513206b999ec0d90d1fb	découvertes 1 série bleue	["le\\u00e7ons"]		1996	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523383-6	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
162	82aa4b0af34c2313a562076992e50aa3	découvertes3 série bleue lehrerbuch	["le\\u00e7ons"]		1997	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523393-3	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
163	0777d5c17d4066b82ab86dff8a46af6f	découvertes 4série bleue lehrerbuch	["diktat-und Transfer texte"]		1996	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523282-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
164	fa7cdfad1a5aaf8370ebeda47a1ff1c3	découvertes 1-2 serie verte/série bleue	["texte en allemand traduit"]		1997	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-520991-9	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
165	9766527f2b5d3e95d4a733fcfb77bd7e	nouveaux horizons  ausgabe b  lehrerbuch	["conjugaison"]		1973	Germany	1	15	/storage/books/logo.png	\N		3-7863-0300-2	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
166	7e7757b1e12abcb736ab9a754ffb617a	ubungen fur das 1.franzosischjahr	["textes"]		1995	Verlag	1	15	/storage/books/logo.png	\N		3-425-09659-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
167	5878a7ab84fb43402106c575658472fa	mots de passe  lehrerhandbuch	["le\\u00e7ons"]		1986	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523090-x	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
168	006f52e9102a8d3be2fe5614f42ba989	edition longue 1-4 , édition courte 1-4 diktat-und transfer texte	["grammatik -wortschatz-fehlerquellen"]		1980	Verlag	1	15	/storage/books/logo.png	\N		3-7863-0306-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
170	149e9677a5989fd342ae44213df68868	unter-und mittelstufe	["conjugaison"]		1981	Verlag	1	15	/storage/books/logo.png	\N		3-12-522720-8	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
171	a4a042cf4fd6bfb47701cbc8a1653ada	echanges 1grammatisches beiheft	["textes"]		1984	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-522830-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
172	1ff8a7b5dc7a7d1f0ed65aaa29c04b1e	etudes françaises echangs lehrerbuch	["sport"]		1979	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-597590-5	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
173	f7e6c85504ce6e82442c770f7c8606f0	sport et vie grund-und leistungskurse	["le\\u00e7ons"]		1994	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523352-6	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
174	bf8229696f7a3bb4700cfddef19fa23f	découverts 1 série bleue grammatisches beiheft	["le\\u00e7ons"]		1995	Stuttgart	1	15	/storage/books/logo.png	\N		3-12523362-3	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
175	82161242827b703e6acf9c726942a1e4	découvertes 2 série bleue grammatisches beiheft	["le\\u00e7ons"]		1998	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-530730-9	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
176	38af86134b65d0f10fe33d30dd76442e	cours intensif 1-2 diktat-und transfertexte	["le\\u00e7ons"]		1997	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523283-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
177	96da2f590cd7246bbde0051047b0d6f7	découverts 3-4 série verte/série bleue diktat-und transfert texte	["le\\u00e7ons"]		1997	Stuttgart	1	15	/storage/books/logo.png	\N		3-12523392-5	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
178	8f85517967795eeef66c225f7883bdcb	découvertes 4 série bleue  grammatisches beiheft	["le\\u00e7ons"]		1996	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523381-x	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
179	8f53295a73878494e9bc8dd6c3c7104f	cahier d-activités 3 série bleue	["le\\u00e7ons"]		1996	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523386-0	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
180	045117b0e0a11a242b9765e79cbf113f	cahier d-activités 3 lehrerausgabe série bleue	["le\\u00e7ons"]		1997	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523285-6	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
181	fc221309746013ac554571fbd180e1c8	kontrollaufgaben 3 série verte/série bleue	["le\\u00e7ons"]		2002	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523123-x	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
182	4c5bde74a8f110656874902f07378009	libre- service 3 materialien fur freiarbeit	["le\\u00e7ons"]		1997	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-523396-8	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
183	cedebb6e872f539bef8c3f919874e9d7	cahier d-activités 4 lehrerausgabe série bleue	["le\\u00e7ons"]		1982	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-522750-x	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
184	6cdd60ea0045eb7a6ec44c54d29ed402	etudes françaises échanges cahier d-exercices	["le\\u00e7ons"]		1989	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-522851-4	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
185	eecca5b6365d9607ee5a9d336962c534	etudes françaises échanges - édition longue cahier première langue iii	["vocabulaire"]		1991	Stuttgart	1	15	/storage/books/logo.png	\N		3-12-522353-9	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
186	9872ed9fc22fc182d371c3e9ed316094	face à face materialien  zur partnerarbeit	["textes"]		2001	Berlin	1	15	/storage/books/logo.png	\N		3-468-45513-5	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
187	31fefc0e570cb3860f2a6d4b38c6490d	das franzosisch-lehrwerk leherhandreichung	["cours"]		1986	Bordas	1	15	/storage/books/logo.png	\N		2-04-016299-2	4	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
188	9dcb88e0137649590b755372b040afad	ecologie géologie 2nd a,c 1ère c,d	["communication"]		1995	Hachette	1	15	/storage/books/logo.png	\N		3-19-003234-3	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
189	a2557a7b2e94197ff767970b67041697	espaces 1 méthode de français	["ateliers?"]		2003	Didier	1	15	/storage/books/logo.png	\N		2-278-05325-6	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
190	cfecdb276f634854f3ef915e2e980c31	nuevos rumbos	["comunichamo"]		2006	Guerra	1	15	/storage/books/logo.png	\N		88-7715-908-1	15	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
191	0aa1883c6411f7873cb83dacb17b0afc	ciao a tutti méthode d-italien pour débutants	["peuples"]		1997	Lome	1	15	/storage/books/logo.png	\N		2-909886-26-3	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
192	58a2fc6ed39fd083f55d4182bf88826d	histoire des togolais volumes i des origines a 1884	["conqu\\u00eate l'administration"]		2005	Lome	1	15	/storage/books/logo.png	\N		2-909886-59-x	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
193	bd686fd640be98efaae0091fa301e613	histoire des togolais volumes ii tome i	["plantes"]		1996	Bordas	1	15	/storage/books/logo.png	\N		2-09-882127-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
194	a597e50502f5ff68e3e25b9114205d4a	biologie 6è  édition enrichie	["invert\\u00e9br\\u00e9s"]		1996	Nathan	1	15	/storage/books/logo.png	\N		2-09-882124-7	4	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
195	0336dcbab05b9d5ad24f4333c7658a0e	biologie 5è édition enrichie	["cours"]		1996	Nathan	1	15	/storage/books/logo.png	\N		2-09-882122-0	5	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
196	084b6fbb10729ed4da8c3d3f5a3ae7c9	géologie biologie 4è édition enrichie	["cours"]		1991	Bordas	1	15	/storage/books/logo.png	\N		2-04-010880-7	5	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
197	85d8ce590ad8981ca2c8286f79f59954	biologie humaine 3è 	["civilisation"]		1971	Edicef	1	15	/storage/books/logo.png	\N		2-850-69147-X	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
198	0e65972dce68dad4d52d063967f0a705	histoire 6è	["civilisation"]		1971	Edicef	1	15	/storage/books/logo.png	\N		978-2-85069-149-2	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
199	84d9ee44e457ddef7f2c4f25dc8fa865	histoire 5è	["\\u00e9volution"]		1970	Edicef	1	15	/storage/books/logo.png	\N		2-85-069151-8	4	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
200	3644a684f98ea8fe223c713b77189a77	histoire 4è	["\\u00e9volution"]		1973	Edicef	1	15	/storage/books/logo.png	\N		2-850-69480-0	3	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
201	757b505cfd34c64c85ca5b5690ee5293	histoire 3è	["\\u00e9tude de la terre domaine climatique"]		1990	Edicef	1	15	/storage/books/logo.png	\N		2-850-69433-9	3	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
202	854d6fae5ee42911677c739ee1734486	géographie 6è	["\\u00e9tude du pays"]		1991	Edicef	1	15	/storage/books/logo.png	\N		2-850-6955-.8	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
203	e2c0be24560d78c5e599c2a9c9d0bbd2	géographie 5è	["\\u00e9tudes sur les pays oriental"]		2010	Berlin	1	15	/storage/books/logo.png	\N		978-2-7011-5597-5	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
204	274ad4786c3abca69fa097b85867d9a4	histoires géographie 5è	["cours sur les pays europ\\u00e9en"]		2001	Hatier	1	15	/storage/books/logo.png	\N		2-218-73465-6	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
205	eae27d77ca20db309e056e3d2dcd7d69	histoires géographie 5è	["religion"]		1994	Hatier	1	15	/storage/books/logo.png	\N		2-218-0555-7	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
206	7eabe3a1649ffa2b3ff8c02ebfd5659f	histoires géographie 6è	["sols"]		1986	Hatier	1	15	/storage/books/logo.png	\N		2-218-72092-2	3	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
207	69adc1e107f7f7d035d7baf04342e1ca	géographie 3è l’afrique occidentale le togo	["cours"]		1993	Edicef	1	15	/storage/books/logo.png	\N		2-85-069854-7	3	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
208	091d584fced301b442654dd8c23b3fc9	ciam  mathématiques 6è	["cours"]		1994	Edicef	1	15	/storage/books/logo.png	\N		2-85-069856-3	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
209	b1d10e7bafa4421218a51b1e1f1b0ba2	ciam mathématiques 5è	["activit\\u00e9s"]		2010	Hatier	1	15	/storage/books/logo.png	\N		978-2-218-94407-9	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
210	6f3ef77ac0e3619e98159e9b6febf557	géométrie mathématiques 5è	["cours"]		1995	Edicef	1	15	/storage/books/logo.png	\N		2-84-129043-3	3	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
211	eb163727917cbba1eea208541a643e74	ciam mathématiques 4è	["cours"]		1996	Edicef	1	15	/storage/books/logo.png	\N		2-84-129046-8	3	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
212	1534b76d325a8f591b52d302e7181331	ciam mathématiques 3è	["cours"]		2008	Edicef	1	15	/storage/books/logo.png	\N		978-27531-0166-1	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
213	979d472a84804b9f647bc185a877a8b5	ciam mathématiques 3è	["cours"]		2008	Edicef	1	15	/storage/books/logo.png	\N		978-2-7531-0167-8	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
214	ca46c1b9512a7a8315fa3c5a946e8265	ciam mathématiques 4è	["cours"]		2008	Edicef	1	15	/storage/books/logo.png	\N		978-2-7531-0168-5	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
215	3b8a614226a953a8cd9526fca6fe9ba5	ciam mathématiques 5è	["cours"]		2008	Edicef	1	15	/storage/books/logo.png	\N		978-2-7531-0169-2	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
216	45fbc6d3e05ebd93369ce542e8f2322d	ciam mathématiques 6è	["cours"]		\N	Paris	1	15	/storage/books/logo.png	\N		2-86877-033-9	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
217	63dc7ed1010d3c3b8269faf0ba7491d4	gria cote d-ivoire sciences physiques 6è 	["cours"]		1988	Paris	1	15	/storage/books/logo.png	\N		2.200.02.083-3	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
218	e96ed478dab8595a7dbda4cbcbee168f	gria togo sciences physiques 5è 	["cours"]		\N	Paris	1	15	/storage/books/logo.png	\N		2-86877-035-5	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
219	c0e190d8267e36708f955d7ab048990d	gria cote d-ivoire sciences physiques 4è 	["cours"]		\N	Paris	1	15	/storage/books/logo.png	\N		2-7616-0966-2	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
220	ec8ce6abb3e952a85b8551ba726a1227	gria togo sciences physiques 3è 	["cours"]		1986	Hachette	1	15	/storage/books/logo.png	\N		978-2-85069-8385-6	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
221	060ad92489947d410d897474079c1477	gria togo   sciences physiques 5è 	["Cours"]		1987	Hachette	1	15	/storage/books/logo.png	\N		978-2-85069-833-0	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
222	bcbe3365e6ac95ea2c0343a2395834dd	collection gado sciences physique, chimique et technologie	["cours"]		2006	Benin	1	15	/storage/books/logo.png	\N		99919-60-75-3	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
223	115f89503138416a242f40fb7d7f338e	physique-chimie 5è nouveau programme	["cours"]		2006	Hatier	1	15	/storage/books/logo.png	\N		2-218-74909-2	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
224	13fe9d84310e77f13a6d184dbf1232f3	sciences physiques 4è collection	["cours "]		1996	Hachette	1	15	/storage/books/logo.png	\N		978-2-85069-835-4	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
225	d1c38a09acc34845c6be3a127a5aacaf	sciences physiques 3è collection	["cours "]		1988	Hachette	1	15	/storage/books/logo.png	\N		978-85069-837-8	1	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
226	9cfdf10e8fc047a44b08ed031e1f0ed1	les plumes du togo apc anglais my excellency 6è	["Sujets et corrig\\u00e9s "]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	5	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
227	705f2172834666788607efbfca35afb3	les plumes du togo apc mathématiques chasles 4è	["Sujets et corrig\\u00e9s"]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
228	74db120f0a8e5646ef5a30154e9f6deb	les plumes du togo apc svt la lumiere 4è	["Sujets propos\\u00e9s"]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:28	2023-12-11 11:23:28	\N
229	57aeee35c98205091e18d1140e9f38cf	les  plumes du togo apc ecm le citoyen 4è	["Sujets "]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
230	6da9003b743b65f4c0ccd295cc484e57	les plumes du togo apc sciences physiques newton 4è	["Sujets propos\\u00e9s"]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
231	9b04d152845ec0a378394003c96da594	les plumes du togo apc cicéron histoire-géographie 4è	["Sujets et corrig\\u00e9s"]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
232	be83ab3ecd0db773eb2dc1b0a17836a1	 les plumes du togo apc anglais 4è the knowledge	["Sujets "]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
233	e165421110ba03099a1c0393373c5b43	les plumes du togo apc français 4è le littéraire	["Dict\\u00e9e"]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
234	289dff07669d7a23de0ef88d2f7129e7	français textes et activités 6è	["textes et activit\\u00e9s"]		1990	Larousse	1	17	/storage/books/logo.png	\N		2-03-800231-2	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
235	577ef1154f3240ad5b9b413aa7346a1e	français textes et activités 5è	["textes et activit\\u00e9s"]		1991	Larousse	1	17	/storage/books/logo.png	\N		2-03-800233-9	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
236	01161aaa0b6d1345dd8fe4e481144d84	fleurs d’encre français 5è	["textes"]		2010	Hachatte	1	17	/storage/books/logo.png	\N		978-2-01-125624-9	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
237	539fd53b59e3bb12d203f45a912eeaf2	français  textes et activités 4è	["textes"]		1991	Larousse	1	17	/storage/books/logo.png	\N		2-03-800226-6	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
238	ac1dd209cbcc5e5d1c6e28598e8cbbe8	méthode de français3 sans frontière	["textes"]		1984	Paris	1	17	/storage/books/logo.png	\N		2-19-033290-7	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
239	555d6702c950ecb729a966504af0a635	des poètes français contemporains	["po\\u00e8sie"]		2001	Adpf	1	17	/storage/books/logo.png	\N		2-911127-83-8	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
240	335f5352088d7d9bf74191e006d8e24c	l’éclosion de la parole	["litt\\u00e9rature orale "]		\N	Paris	1	17	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
241	f340f1b1f65b6df5b5e3f94d95b11daf	le livre dans tous ses états: écrire, lire, éditer	["textes"]		\N	Paris	1	17	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
242	e4a6222cdb5b34375400904f03d8e6a5	l’indépendance… et après?	["LA LANGUE"]		\N	Paris	1	17	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
243	cb70ab375662576bd1ac5aaf16b3fca4	au-delà du désert	["dialogue"]		\N	Paris	1	17	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
244	9188905e74c28e489b44e954ec0b9bca	la parole aux femmes	["les hommes et les femmes"]		\N	Paris	1	17	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
245	0266e33d3f546cb5436a10798e657d97	afrique sub-saharienne	["textes litt\\u00e9raires"]		\N	Paris	1	17	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
246	38db3aed920cf82ab059bfccbd02be6a	english for french- speaking africa i want to learn english 6è	["lecture et dialogue"]		1983	Paris	1	17	/storage/books/logo.png	\N		2-86644-059-5	4	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
247	3cec07e9ba5f5bb252d13f5f431e4bbb	english for french- speaking a africa enjoy learning english 5è	["textes"]		1986	Paris	1	17	/storage/books/logo.png	\N		2-86644-069-2	4	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
248	621bf66ddb7c962aa0d22ac97d69b793	english for french-speaking africa working with english 4è	["textes "]		1987	Paris	1	17	/storage/books/logo.png	\N		2-86644-075-7	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
249	077e29b11be80ab57e1a2ecabb7da330	english for french-speaking africa succeeding in english 3è	["le\\u00e7ons"]		1976	Paris	1	17	/storage/books/logo.png	\N		2-86644-007-2	4	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
250	6c9882bbac1c7093bd25041881277658	dictionnaire de 12000 verbes	["verbes"]		1997	Hatier	1	17	/storage/books/logo.png	\N		2-218-71716-6	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
251	19f3cd308f1455b3fa09a282e0d496f4	lumière du bepc maths 3è collection mg volume 1 et 2	["Sujets et corrig\\u00e9s"]		\N	Butodra	1	17	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
252	03c6b06952c750899bb03d998e631860	livre unique de français cm2	["Textes"]		2000	Hatier	1	17	/storage/books/logo.png	\N		2-218-72832-x	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
253	c24cd76e1ce41366a4bbe8a49b02a028	livre unique de français cm1	["Textes"]		2000	Hatier	1	17	/storage/books/logo.png	\N		2-218-72831-1	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
254	c52f1bd66cc19d05628bd8bf27af3ad6	livre unique de français ce2	["textes"]		2000	Hatier	1	17	/storage/books/logo.png	\N		2-218-72830-3	4	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
255	fe131d7f5a6b38b23cc967316c13dae2	livre unique de français cp2	["Textes"]		2000	Hatier	1	17	/storage/books/logo.png	\N		978-2-218-72828-0	4	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
256	f718499c1c8cef6730f9fd03c8125cab	bled cp/ce	["Orthographe"]		1998	Hachette	1	17	/storage/books/logo.png	\N		978-2-01-116119-2	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
257	d96409bf894217686ba124d7356686c9	bled ce2/cm	["Orthographe"]		1998	Hachette	1	17	/storage/books/logo.png	\N		978-2-01-116118-1	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
258	502e4a16930e414107ee22b6198c578f	mon nouveau livre de mathématiques cm1	["Calcul"]		1994	\N	1	17	/storage/books/logo.png	\N		2-85049-593-X	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
259	cfa0860e83a4c3a763a7e62d825349f7	mon nouveau livre de mathématiques cm2	["Calcul"]		1994	Africain	1	17	/storage/books/logo.png	\N		2-85049-594-8	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
260	a4f23670e1833f3fdb077ca70bbd5d66	d.i.f.o.p le nouveau calcul quotidien cp2	["Calcul"]		1990	Nathan	1	17	/storage/books/logo.png	\N		2-288-82352-6	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
261	b1a59b315fc9a3002ce38bbe070ec3f5	d.i.f.o.p le nouveau calcul quotidien ce1	["Calcul"]		1988	Nathan	1	17	/storage/books/logo.png	\N		2-228-82353-4	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
262	36660e59856b4de58a219bcf4e27eba3	d.i.f.o.p le nouveau calcul quotidien ce2	["Calcul"]		1988	Nathan	1	17	/storage/books/logo.png	\N		2-288-82354-2	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
263	8c19f571e251e61cb8dd3612f26d5ecf	 je sais parler en toutes circonstances	["Expression"]		1983	Paris	1	17	/storage/books/logo.png	\N		2-7256-1059-1	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
264	d6baf65e0b240ce177cf70da146c8dc8	atout france pour améliorer votre français	["Grammaires"]		1987	Paris	1	17	/storage/books/logo.png	\N		2-278-03799-7	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
265	e56954b4f6347e897f954495eab16a88	le sablier 2 de la langue orale à la langue écrite niveau c. p. et c. e	["L\\u00e9\\u00e7ons"]		1973	Hatier	1	17	/storage/books/logo.png	\N		2-218-02316-4	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
266	f7664060cc52bc6f3d620bcedc94a4b6	apprendre  à approfondir orthographe français cm1	["Orthographe"]		1991	Albin	1	17	/storage/books/logo.png	\N		2-226-05211-9	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
267	eda80a3d5b344bc40f3bc04f65b7a357	grammaire vivante du français	["Exercices d'apprentissage 1"]		1990	Larousse	1	17	/storage/books/logo.png	\N		2-19-039301-9	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
268	8f121ce07d74717e0b1f21d122e04521	grammaire vivante du français	["Exercices d'apprentissage 2"]		1990	Larousse	1	17	/storage/books/logo.png	\N		2-79-039302-7	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
269	06138bc5af6023646ede0e1f7c1eac75	grammaire vivante du français	["Exercices d'apprentissage 3"]		1992	Larousse	1	17	/storage/books/logo.png	\N		2-19-039303-5	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
270	39059724f73a9969845dfe4146c5660e	passeport nouveau pour le ce1	["MEMENTO J'apprend \\u00e0 lire"]		1986	Hachette	1	17	/storage/books/logo.png	\N		2-010108000-0	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
271	7f100b7b36092fb9b06dfb4fac360931	le nouvel espace 1	["Guide P\\u00e9dagogique"]		1995	Hachette	1	17	/storage/books/logo.png	\N		2-01-155014-9	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
272	7a614fd06c325499f1680b9896beedeb	contes	["Les contes de PERRAULT"]		2000	Delville	1	17	/storage/books/logo.png	\N		2-85922-114-X	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
273	4734ba6f3de83d861c3176a6273cac6d	droit terminale s t g	["Crit\\u00e8re"]		2008	Hachatte	1	15	/storage/books/logo.png	\N		978-2-01-180546-1	12	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
274	d947bf06a885db0d477d707121934ff8	sciences économique et social	["Dossiers "]		2004	Hatier	1	15	/storage/books/logo.png	\N		2-218-74790-9	7	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
275	63923f49e5241343aa7acb6a06a751e7	inventaire des études, enquêtes, évaluations et recherches réalisées sur les enfants et les femmes du togo	["Documents d'enqu\\u00eates"]		2008	Togo	1	15	/storage/books/logo.png	\N		\N	3	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
276	db8e1af0cb3aca1ae2d0018624204529	les droits de l’homme et les prisons	["Etude des cas"]		2005	New york	1	15	/storage/books/logo.png	\N		92-1-254149-6	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
277	20f07591c6fcb220ffe637cda29bb3f6	droits économiques, sociaux et culturels	["Manuel destin\\u00e9 aux institutions nationales des droits de l'homme"]		2005	New york	1	15	/storage/books/logo.png	\N		92-1-254152-6	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
278	07cdfd23373b17c6b337251c22b7ea57	sciences économiques et sociales série es annales bac 2005 corrigés	["Document"]		2004	Paris	1	15	/storage/books/logo.png	\N		2-7117-4325-X	2	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
279	d395771085aab05244a4fb8fd91bf4ee	sélection de décisions des comites des droits de l-homme prises en vertu du protocole facultatif	["Communication"]		2005	New york	1	15	/storage/books/logo.png	\N		92-1-254153-4	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
280	92c8c96e4c37100777c7190b76d28233	droits de l’homme application des lois	["Document"]		1997	New york	1	15	/storage/books/logo.png	\N		92-1-254124-0	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
281	e3796ae838835da0b6f6ea37bcf8bcb7	déclaration universelle des droits de l-homme	["articles"]		1988	Onu	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
282	6a9aeddfc689c1d0e3b9ccc3ab651bc5	principes et directives concernant les droits de l-homme et la traite	["recommandations"]		2002	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
283	0f49c89d1e7298bb9930789c8ed59d48	services consultatifs et de la coopération technique dans le domaine	["Projets"]		1948	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
284	46ba9f2a6976570b0353203ec4474217	dix-sept questions souvent posées au sujet des rapporteurs spéciaux	["commission"]		2001	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
285	0e01938fc48a2cfb5f2217fbfb00722d	discrimination a l-égard des femmes la convention et le comite	["convention"]		1993	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
286	16a5cdae362b8d27a1d8f8c7b78b4330	droits des minorités n°18	["dispositions"]		1992	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
287	918317b57931b6b7a7d29490fe5ec9f9	les droits de l-enfant n°10	["L'adoption"]		1993	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
288	48aedb8880cab8c45637abc7493ecddd	les droits de l-homme et les accords commerciaux internationaux	["HCDH"]		2005	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
289	839ab46820b524afda05122893c2fe8e	institutions nationales pour la promotion et la protection des droits de l-homme	["des droits de l'homme"]		1994	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
290	f90f2aca5c640289d0a29417bcb63a37	exécutions  extra judiciaires sommaires ou arbitraires n°11	["d\\u00e9claration"]		1998	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
291	9c838d2e45b2ad1094d42f4ef36764f6	la convention internationale sur la protection des droits de tous les travailleurs	["convention"]		2006	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
292	1700002963a49da13542e0726b7bb758	le groupe de travail sur la détention arbitraire n°26	["commission"]		2000	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
293	53c3bce66e43be4f209556518c2fcb54	procédures d-examen des requetés n°7	["HCDH"]		2003	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
294	6883966fd8f918a4aa29be29d2c386fb	les droits de l-homme et la lutte contre la pauvreté	["la pauvret\\u00e9"]		2004	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
295	49182f81e6a13cf5eaa496d51fea6406	le droit international humanitaire et les droits de l-homme n°13	["convention"]		1992	New york	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
296	d296c101daa88a51f6ca8cfc1ac79b50	le défi du racisme	["Mme Khadoudja"]		1987	Verlag Moritz Diesterweg	1	15	/storage/books/logo.png	\N		3-425-04413-3	1	\N	2023-12-11 11:23:29	2023-12-11 11:23:29	\N
297	9fd81843ad7f202f26c1a174c7357585	lehrerheft le défi du racisme	["document"]		1987	Verlag Moritz Diesterweg	1	15	/storage/books/logo.png	\N		3-425-09413-0	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
298	26e359e83860db1d11b6acca57d8ea88	 evaluer l-efficacité des institutions nationales des droits de l-homme	["INDH"]		2005	Trustesse	1	15	/storage/books/logo.png	\N		2-940259-68-2	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
299	ef0d3930a7b6c95bd2b32ed45989c61f	activités pratiques pour les écoles primaires et secondaires	["document domaine social"]		2004	New york	1	15	/storage/books/logo.png	\N		92-1-254142-9	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
300	94f6d7e04a4d452035300f18b984988c	les grands problèmes de l-économie contemporaine	["\\u00e9conomie contaporaine"]		2004	Larousse	1	15	/storage/books/logo.png	\N		2-7111-2993-4	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
301	34ed066df378efacc9b924ec161e7639	francois mitterand élu a l-académie française	["textes"]		1989	Ballande	1	15	/storage/books/logo.png	\N		2-7158-0771-6	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
302	577bcc914f9e55d5e4e4f82f9f00e7d4	la politique expliquée aux enfants  et  aux autres	["la politique"]		1990	Paris	1	15	/storage/books/logo.png	\N		2-7082-27416	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
303	11b9842e0a271ff252c1903e7132cd68	je ne suis pas un assassin	["on"]		2004	\N	1	15	/storage/books/logo.png	\N		2-915056-27-7	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
304	37bc2f75bf1bcfe8450a1a41c200364c	ma passion africaine	["on"]		1997	Lattes	1	15	/storage/books/logo.png	\N		2-7096-1770-6	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
305	496e05e1aea0a9c4655800e8a7b9ea28	je voulais juste rentrer chez moi…	["J'ai"]		2002	Paris	1	15	/storage/books/logo.png	\N		2-84098-870-4	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
306	b2eb7349035754953b57a32e2841bda5	analyse économique: les concepts de base	["des approches"]		1996	Grenoble	1	15	/storage/books/logo.png	\N		2-70610-0704-9	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
307	8e98d81f8217304975ccb23337bb5761	guide du  c. v. et de la lettre d-accompagnement	["pr\\u00e9paration du C.V."]		1997	Figaro	1	15	/storage/books/logo.png	\N		2-87845-311-5	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
308	a8c88a0055f636e4a163a5e3d16adab7	l-entreprise du 21è siècle	["document"]		2012	Le monde différent	1	15	/storage/books/logo.png	\N		978-2-89225-78293	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
309	eddea82ad2755b24c4e168c5fc2ebd40	père riche, père pauvre	["document"]		2014	Le monde différent	1	15	/storage/books/logo.png	\N		978-2-89225-857-8	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
310	06eb61b839a0cefee4967c67ccb099dc	avant de quitter votre emploi	["document"]		2006	Le monde différent	1	15	/storage/books/logo.png	\N		978-2-89225-624-6	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
311	9dfcd5e558dfa04aaf37f137a1d9d3e5	terrorisme et attentats  suicides	["musulmans"]		\N	Nil	1	15	/storage/books/logo.png	\N		978-1-932099-89-8	4	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
312	950a4152c2b4aa3ad78bdd6b366cc179	perles de sagesse	["Gulen"]		\N	Nil	1	15	/storage/books/logo.png	\N		978-975-278-234-1	2	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
313	158f3069a435b314a80bdcb024f8e422	l-islam vol 1	["Les muslimans"]		\N	\N	1	15	/storage/books/logo.png	\N		978-975-278-235-8	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
314	758874998f5bd0c393da094e1967a72b	les fondements de la foi islamique	["R\\u00e9ligion musliman"]		2011	\N	1	15	/storage/books/logo.png	\N		978-1-59784-084-2	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
315	ad13a2a07ca4b7642959dc0c4c740ab6	la perte de l-eldorado	["Documents social"]		1969	V.s.naipaul	1	15	/storage/books/logo.png	\N		2-259-02742-3	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
316	3fe94a002317b5f9259f82690aeea4cd	la cité de la joie	["Hasari"]		1985	Laffont	1	15	/storage/books/logo.png	\N		2-7242-2635-6	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
317	5b8add2a5d98b1a652ea7fd72d942dac	l-ile de pâques	["Makemake"]		1941	Gallimard	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
318	432aca3a1e345e339f35a30c8f65edce	sociologie et anthropologie	["Document social"]		1950	Paris	1	15	/storage/books/logo.png	\N		2-13-045288-4	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
319	8d3bba7425e7c98c50f52ca1b52d3735	l-école de lausanne	["Document social"]		1950	Paris	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
320	320722549d1751cf3f247855f937b982	pompidou et l’europe	["Histoire europ\\u00e9en"]		1974	Paris	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
321	caf1a3dfb505ffed0d024130f58c5cfa	recrutez votre patron	["Votre"]		1989	Paris	1	15	/storage/books/logo.png	\N		2-86930 207-X	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
322	5737c6ec2e0716f3d8a7a5c4e0de0d9a	le parfait secrétaire	["Courrier commercial"]		2002	Larousse	1	15	/storage/books/logo.png	\N		2-03-5660301-3	3	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
323	bc6dc48b743dc5d013b1abaebd2faed2	la cité de la joie	["Hasari"]		1985	Laffont	1	15	/storage/books/logo.png	\N		2-253-04031-2	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
324	f2fc990265c712c49d51a18a32b39f0c	statistique descriptive et initiation a l-analyse i	["Collecte scientifique"]		1962	Paris	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
325	89f0fd5c927d466d6ec9a21b9ac34ffa	de si bons amis	["Roman social"]		1994	Plon	1	15	/storage/books/logo.png	\N		2-266-06579-3	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
326	a666587afda6e89aec274a3657558a27	guide de l-enseignant lycée	["S\\u00e9ance"]		2008	Flammarion	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
327	b83aac23b9528732c23cc7352950e880	aide-mémoire de législation du travail	["S\\u00e9ries"]		1974	Paris	1	15	/storage/books/logo.png	\N		2-7135-0133-4	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
328	cd00692c3bfe59267d5ecfac5310286c	le manifeste radical	["Roman social"]		1970	Paris	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
329	6faa8040da20ef399b63a72d0e4ab575	la foule dans la révolution française	["Roman social"]		1982	Paris	1	15	/storage/books/logo.png	\N		2-7071-1329-8	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
330	fe73f687e5bc5280214e0486b273a5f9	et si nous n-avions rien compris à la sexualité?	["Gar\\u00e7on"]		2004	Albin	1	15	/storage/books/logo.png	\N		2-226-14222-3	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
331	6da37dd3139aa4d9aa55b8d237ec5d4a	lorsque l’enfant paraît tome 1	["Roman social"]		1977	Seuil	1	15	/storage/books/logo.png	\N		2-02-036065-9	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
332	c042f4db68f23406c6cecf84a7ebb0fe	lorsque l’enfant paraît tome 2	["Roman social"]		1978	Seuil	1	15	/storage/books/logo.png	\N		2-02036066-7	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
333	310dcbbf4cce62f762a2aaa148d556bd	lorsque l’enfant paraît tome 3	["Roman social"]		1979	Seuil	1	15	/storage/books/logo.png	\N		2-02-036067-5	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
334	2f2b265625d76a6704b08093c652fd79	la haine tranquille	["Roman social"]		1993	Seuil	1	15	/storage/books/logo.png	\N		2-02-019462-7	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
335	f9b902fc3289af4dd08de5d1de54f68f	boule de suif	["Phases"]		1991	Stuttgart	1	15	/storage/books/logo.png	\N		2-12-596281-1	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
336	6855456e2fe46a9d49d3d3af4f57443d	la campagne électorale	["Claire"]		1988	Besty haynes	1	15	/storage/books/logo.png	\N		2-8034-2311-1	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
337	357a6fdf7642bf815a88822c447d9dc4	la   douceur	["Jeu"]		1999	Seuil	1	15	/storage/books/logo.png	\N		2-87927-236-0	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
338	819f46e52c25763a55cc642422644317	economie domestique bien vivre chez soi	["Document domestique"]		2006	Mediaspaul	1	15	/storage/books/logo.png	\N		99951-10229	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
339	04025959b191f8f9de3f924f0940515f	le guide du jeune père	["Document domestique"]		1988	Paris	1	15	/storage/books/logo.png	\N		2-258-02365-3	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
340	40008b9a5380fcacce3976bf7c08af5b	on va s-gêner! les meilleurs moments de l-émission	["J.B"]		2005	Plon	1	15	/storage/books/logo.png	\N		2-259-19771-x	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
341	3dd48ab31d016ffcbf3314df2b3cb9ce	l-argent fou	["la r\\u00e9volution sexuelle"]		1990	Grasset	1	15	/storage/books/logo.png	\N		2-246-43081-x	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
342	58238e9ae2dd305d79c2ebc8c1883422	crise, krach, boom	["boom"]		1988	Seuil	1	15	/storage/books/logo.png	\N		2-02-010087-8	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
343	3ad7c2ebb96fcba7cda0cf54a2e802f5	cours abrégés de philosophie bac série c, d et e	["document de cours philosophique"]		1991	Butodra	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
344	b3967a0e938dc2a6340e258630febd5a	cours abrégés de philosophie bac série a	["document de cours philosophique"]		1991	Butodra	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
345	d81f9c1be2e08964bf9f24b15f0e4900	cours méthodiques de philosophie terminales a	["document de cours philosophique"]		1991	Butodra	1	15	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
346	13f9896df61279c928f19721878fac41	la nostalgie n-est plus ce qu-elle était	["Simone"]		1975	Seuil	1	1	/storage/books/logo.png	\N		2-02-004919-8	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
347	c5ff2543b53f4cc0ad3819a36752467b	introduction à la psychanalyse	["roman philosophique"]		1978	Paris	1	1	/storage/books/logo.png	\N		2-228-30063-2	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
348	01386bd6d8e091c2ab4c7c7de644d37b	d-une sainte famille à l-autre	["critique"]		1969	Gallimard	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
349	0bb4aec1710521c12ee76289d9440817	critique de la raison pure	["roman philosophique"]		1944	Paris	1	1	/storage/books/logo.png	\N		2-13-038545-1	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
350	9de6d14fff9806d4bcd1ef555be766cd	comment écrire entrainement à l-expression écrire avec exercices et corrigés	["verbes"]		1989	Paris	1	1	/storage/books/logo.png	\N		2-7863-0721-0	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
351	efe937780e95574250dabe07151bdc23	le petit prince analyse modèle	["textes "]		1984	 Stuttgart	1	1	/storage/books/logo.png	\N		2-12-597150-0	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
352	371bce7dc83817b7893bcdeed13799b5	réflexions sur la question juive	["juifs"]		1954	Gallimard	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
353	138bb0696595b338afbab333c555292a	jamais je ne t-ai promis un jardin de roses	["Deborah"]		1964	New york	1	1	/storage/books/logo.png	\N		2-88-566-101-x	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
354	8dd48d6a2e2cad213179a3992c0be53c	les grands textes de la philosophie	["document de la philosophie"]		1968	Bordas	1	1	/storage/books/logo.png	\N		2-04-000127-1	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
355	82cec96096d4281b7c95cd7e74623496	guide du pari révolutionnaire	["document  de la r\\u00e9volution"]		1989	Paris	1	1	/storage/books/logo.png	\N		2-262-00670-9	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
356	6c524f9d5d7027454a783c841250ba71	l-algerie sans la france	["roman philosophique"]		1964	Paris	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
357	fb7b9ffa5462084c5f4e7e85a093e6d7	le mal français	["roman philosophique"]		1976	Paris	1	1	/storage/books/logo.png	\N		2-259-00204-8	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
358	aa942ab2bfa6ebda4840e7360ce6e7ef	les textes littéraires généraux	["roman philosophique"]		1991	Hachette	1	1	/storage/books/logo.png	\N		2-01-0117130-6	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
359	c058f544c737782deacefa532d9add4c	le monde de sophie 	["roman philosophique"]		1995	Seuil	1	1	/storage/books/logo.png	\N		2-02-021949-2	1	\N	2023-12-11 11:23:30	2023-12-11 11:23:30	\N
360	e7b24b112a44fdd9ee93bdf998c6ca0e	les mythes de l-amour	["roman philosophique"]		1961	Albin	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
361	52720e003547c70561bf5e03b95aa99f	propos sur le bonheur	["roman philosophique"]		1928	Gallimard	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
362	c3e878e27f52e2a57ace4d9a76fd9acf	le mythe de l-éternel retour	["roman philosophique"]		1969	Gallimard	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
363	00411460f7c92d2124a67ea0f4cb5f85	le creuset français histoire de l-immigration xixe-xxe siècle	["roman philosophique"]		1988	Seuil	1	1	/storage/books/logo.png	\N		2-02-015393-9	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
364	bac9162b47c56fc8a4d2a519803d51b3	apologie de socrate  criton	["roman philosophique"]		1997	Flammarion	1	1	/storage/books/logo.png	\N		978-2-0807-0848-9	2	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
365	9be40cee5b0eee1462c82c6964087ff9	introduction a la philosophie	["roman philosophique"]		1981	Plon	1	1	/storage/books/logo.png	\N		978-2-264-03444-1	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
366	5ef698cd9fe650923ea331c15af3b160	le médiaplanning	["Radio"]		1992	Paris	1	1	/storage/books/logo.png	\N		2-13-044361-3	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
367	05049e90fa4f5039a8cadc6acbb4b2cc	discours de la méthode 	["roman philosophique"]		\N	Larousse	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
368	cf004fdc76fa1a4f25f62e0eb5261ca3	voltaire œuvres philosophique	["roman philosophique"]		\N	Paris	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
369	0c74b7f78409a4022a2c4c5a5ca3ee19	les thibault extraits 1	["roman philosophique"]		\N	Gallimard	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
370	d709f38ef758b5066ef31b18039b8ce5	madame  de sevigne lettres choisies	["Lettres"]		\N	Paris	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
371	41f1f19176d383480afa65d325c06ed0	pour que l-enfant paraisse	["Sant\\u00e9"]		1990	Flammarion	1	1	/storage/books/logo.png	\N		2-08-201611-0	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
372	24b16fede9a67c9251d3e7c7161c83ac	guide des alicaments	["LDL"]		2000	Marabout	1	1	/storage/books/logo.png	\N		2-501-03355-8	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
373	ffd52f3c7e12435a724a8f30fddadd9c	comment guérir les maladies digestives	["Hygi\\u00e8ne digestive"]		1994	Africain	1	1	/storage/books/logo.png	\N		2-85049-415-1	2	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
374	ad972f10e0800b49d76fed33a21f6698	comment guérir rhumatismes, arthrites, arthroses-goutte sciatique	["Sant\\u00e9"]		1992	Africain	1	1	/storage/books/logo.png	\N		2-85049-499-2	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
375	f61d6947467ccd3aa5af24db320235dd	comment soigner le paludisme et la drépanocytose	["Sant\\u00e9"]		1994	Africain	1	1	/storage/books/logo.png	\N		2-85049-447-X	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
376	142949df56ea8ae0be8b5306971900a4	syndrome prémenstruel	["Sant\\u00e9"]		1996	Africain	1	1	/storage/books/logo.png	\N		2-921556-53-7	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
377	d34ab169b70c9dcd35e62896010cd9ff	une famille épanouie	["Document familial"]		2006	Iadpa	1	1	/storage/books/logo.png	\N		1-57554-436-9	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
378	8bf1211fd4b7b94528899de0a43b9fb3	250 recettes pour prévenir et guérir	["Recettes"]		2009	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-321-9	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
379	a02ffd91ece5e7efeb46db8f10a74059	santer par la nature vol2	["Document "]		2011	Safeliz	1	1	/storage/books/logo.png	\N		978-4-7208-285-4	2	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
380	bca82e41ee7b0833588399b1fcd177c7	santer par aliments	["Document "]		2010	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-288-5	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
381	00ec53c4682d36f5c4359f4ae7bd7ba1	un corps sain guide pratique pour le soin du corps	["Soin du corps"]		2009	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-099-7	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
382	4f6ffe13a5d75b2d6a3923922b3922e5	profitez de la vie guide pratique pour mieux et plus longtemps	["Document sant\\u00e9 physique"]		2012	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-376-9	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
383	beed13602b9b0e6ecb5b568ff5058f07	un esprit positif guide pratique pour affronter les réalités quotidiennes	["Document sportif pour la sant\\u00e9"]		2011	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-373-8	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
384	0584ce565c824b7b7f50282d9a19945b	l-itinéraire du couple une relation harmonieuse et durable	["R\\u00e9lations"]		2010	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-357-8	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
385	dc912a253d1e9ba40e2c597ed2376640	croquez la vie !	["aliments"]		2006	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-127-7	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
386	39461a19e9eddfb385ea76b26521ea48	les adolescents et leurs parents	["Sant\\u00e9"]		2002	Safeliz	1	1	/storage/books/logo.png	\N		84-7208-136-2	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
387	8efb100a295c0c690931222ff4467bb8	bien-être au féminin guide médical naturel pour la femme	["symptomes"]		2011	Safeliz	1	1	/storage/books/logo.png	\N		978-84-7208-171-0	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
388	d9fc5b73a8d78fad3d6dffe419384e70	j-attends un enfant	["comment"]		1999	Paris	1	1	/storage/books/logo.png	\N		2-7058-0270-3	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
389	c86a7ee3d8ef0b551ed58e354a836f2b	vous et votre enfant	["comment"]		1999	Bordas	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
390	a01a0380ca3c61428c26a231f0e49a09	j-attends un enfant	["document de naissance"]		1986	Paris	1	1	/storage/books/logo.png	\N		2-7058-0166-9	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
391	5a4b25aaed25c2ee1b74de72dc03c14e	l-aide -soignante	["les soins infirmiers"]		2000	Nathan	1	1	/storage/books/logo.png	\N		978-2-09-882575-8	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
392	f73b76ce8949fe29bf2a537cfa420e8f	bouddha	["j'ai"]		1987	Claude aveline	1	1	/storage/books/logo.png	\N		2-905998-06-7	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
393	70c639df5e30bdee440e4cdf599fec2b	traité de l-amour de dieu	["l'Eglise"]		\N	Paris	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
394	28f0b864598a1291557bed248a998d4e	la pastorale de la messe à l’usage des diocèses de france	["dir\\u00e8ctoire"]		1956	Paris	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
395	1543843a4723ed2ab08e18053ae6dc5b	dans une nuit obscure	["Jean de la croix"]		2001	Paris	1	1	/storage/books/logo.png	\N		2-290-31092-1	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
396	f8c1f23d6a8d8d7904fc0ea8e066b3bb	 la vie devant soi	["Madame Rosa"]		1975	Paris	1	1	/storage/books/logo.png	\N		87-11-08498-7	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
397	e46de7e1bcaaced9a54f1e9d0d2f800d	barabbas	["par lagerkvist"]		1946	Stock	1	1	/storage/books/logo.png	\N		\N	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
398	b7b16ecf8ca53723593894116071700c	vous pouvez vivre le vrai bonheur!	["Dieu"]		2000	Delville	1	1	/storage/books/logo.png	\N		978-09704497-2-6	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
399	352fe25daf686bdb4edca223c921acea	le défi	["Hans"]		2000	Glifa	1	1	/storage/books/logo.png	\N		978-3-906-58904-6	1	\N	2023-12-11 11:23:31	2023-12-11 11:23:31	\N
169	3636638817772e42b59d74cff571fbb3	franzosisch 2	["","textes",""]	erzrezrezrezrez	1965	Verlag	1	15	/storage/books/logo.png	\N	\N	\N	1	3636638817772e42b59d74cff571fbb3.pdf	2023-12-11 11:23:28	2023-12-11 11:55:21	\N
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: permissions; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.permissions (id, name, guard_name, created_at, updated_at) FROM stdin;
1	livres_papier_index	web	2023-12-11 11:19:18	2023-12-11 11:19:18
2	livres_papier_create	web	2023-12-11 11:19:18	2023-12-11 11:19:18
3	livres_papier_store	web	2023-12-11 11:19:18	2023-12-11 11:19:18
4	livres_papier_show	web	2023-12-11 11:19:18	2023-12-11 11:19:18
5	livres_papier_edite	web	2023-12-11 11:19:18	2023-12-11 11:19:18
6	livres_papier_update	web	2023-12-11 11:19:18	2023-12-11 11:19:18
7	livres_papier_delete	web	2023-12-11 11:19:18	2023-12-11 11:19:18
8	livres_numerique_index	web	2023-12-11 11:19:18	2023-12-11 11:19:18
9	livres_numerique_create	web	2023-12-11 11:19:18	2023-12-11 11:19:18
10	livres_numerique_store	web	2023-12-11 11:19:18	2023-12-11 11:19:18
11	livres_numerique_show	web	2023-12-11 11:19:18	2023-12-11 11:19:18
12	livres_numerique_edite	web	2023-12-11 11:19:18	2023-12-11 11:19:18
13	livres_numerique_update	web	2023-12-11 11:19:18	2023-12-11 11:19:18
14	livres_numerique_delete	web	2023-12-11 11:19:18	2023-12-11 11:19:18
15	approvisionnement_index	web	2023-12-11 11:19:18	2023-12-11 11:19:18
16	approvisionnement_create	web	2023-12-11 11:19:18	2023-12-11 11:19:18
17	approvisionnement_store	web	2023-12-11 11:19:18	2023-12-11 11:19:18
18	approvisionnement_show	web	2023-12-11 11:19:18	2023-12-11 11:19:18
19	approvisionnement_edite	web	2023-12-11 11:19:18	2023-12-11 11:19:18
20	approvisionnement_update	web	2023-12-11 11:19:18	2023-12-11 11:19:18
21	approvisionnement_delete	web	2023-12-11 11:19:18	2023-12-11 11:19:18
22	emprunt_index	web	2023-12-11 11:19:18	2023-12-11 11:19:18
23	emprunt_create	web	2023-12-11 11:19:18	2023-12-11 11:19:18
24	emprunt_store	web	2023-12-11 11:19:18	2023-12-11 11:19:18
25	emprunt_show	web	2023-12-11 11:19:18	2023-12-11 11:19:18
26	emprunt_edite	web	2023-12-11 11:19:18	2023-12-11 11:19:18
27	emprunt_update	web	2023-12-11 11:19:18	2023-12-11 11:19:18
28	emprunt_delete	web	2023-12-11 11:19:18	2023-12-11 11:19:18
29	restitution_index	web	2023-12-11 11:19:18	2023-12-11 11:19:18
30	restitution_create	web	2023-12-11 11:19:18	2023-12-11 11:19:18
31	restitution_store	web	2023-12-11 11:19:18	2023-12-11 11:19:18
32	restitution_show	web	2023-12-11 11:19:18	2023-12-11 11:19:18
33	restitution_edite	web	2023-12-11 11:19:18	2023-12-11 11:19:18
34	restitution_update	web	2023-12-11 11:19:18	2023-12-11 11:19:18
35	restitution_delete	web	2023-12-11 11:19:19	2023-12-11 11:19:19
36	abonne_index	web	2023-12-11 11:19:19	2023-12-11 11:19:19
37	abonne_create	web	2023-12-11 11:19:19	2023-12-11 11:19:19
38	abonne_store	web	2023-12-11 11:19:19	2023-12-11 11:19:19
39	abonne_show	web	2023-12-11 11:19:19	2023-12-11 11:19:19
40	abonne_edite	web	2023-12-11 11:19:19	2023-12-11 11:19:19
41	abonne_update	web	2023-12-11 11:19:19	2023-12-11 11:19:19
42	abonne_delete	web	2023-12-11 11:19:19	2023-12-11 11:19:19
43	personnel_index	web	2023-12-11 11:19:19	2023-12-11 11:19:19
44	personnel_create	web	2023-12-11 11:19:19	2023-12-11 11:19:19
45	personnel_store	web	2023-12-11 11:19:19	2023-12-11 11:19:19
46	personnel_show	web	2023-12-11 11:19:19	2023-12-11 11:19:19
47	personnel_edite	web	2023-12-11 11:19:19	2023-12-11 11:19:19
48	personnel_update	web	2023-12-11 11:19:19	2023-12-11 11:19:19
49	personnel_delete	web	2023-12-11 11:19:19	2023-12-11 11:19:19
\.


--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.personal_access_tokens (id, tokenable_type, tokenable_id, name, token, abilities, last_used_at, expires_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: personnels; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.personnels (id_personnel, statut, id_utilisateur, created_at, updated_at, deleted_at) FROM stdin;
1	Responsable	1	2023-12-11 11:19:19	2023-12-11 11:19:19	\N
2	Bibliothècaire	2	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
\.


--
-- Data for Name: registrations; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.registrations (id_registration, date_debut, date_fin, etat, id_abonne, id_tarif_abonnement, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: reservations; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.reservations (id_reservation, date_reservation, etat, durre, id_abonne, id_ouvrage, created_at, updated_at, deleted_at) FROM stdin;
\.


--
-- Data for Name: restitutions; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.restitutions (id_restitution, etat, date_restitution, id_abonne, id_personnel, id_emprunt, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: role_has_permissions; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.role_has_permissions (permission_id, role_id) FROM stdin;
1	1
2	1
3	1
4	1
5	1
6	1
7	1
8	1
9	1
10	1
11	1
12	1
13	1
14	1
15	1
16	1
17	1
18	1
19	1
20	1
21	1
22	1
23	1
24	1
25	1
26	1
27	1
28	1
29	1
30	1
31	1
32	1
33	1
34	1
35	1
36	1
37	1
38	1
39	1
40	1
41	1
42	1
43	1
44	1
45	1
46	1
47	1
48	1
49	1
1	2
3	2
4	2
5	2
6	2
7	2
8	2
10	2
11	2
12	2
13	2
14	2
22	2
23	2
24	2
25	2
26	2
27	2
28	2
29	2
30	2
31	2
32	2
33	2
34	2
35	2
36	2
37	2
38	2
39	2
40	2
41	2
42	2
43	2
45	2
46	2
47	2
48	2
49	2
36	3
37	3
38	3
39	3
40	3
41	3
42	3
1	3
4	3
8	3
11	3
\.


--
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.roles (id, name, guard_name, created_at, updated_at) FROM stdin;
1	responsable	web	2023-12-11 11:19:18	2023-12-11 11:19:18
2	bibliothecaire	web	2023-12-11 11:19:18	2023-12-11 11:19:18
3	abonne	web	2023-12-11 11:19:18	2023-12-11 11:19:18
\.


--
-- Data for Name: tarif_abonnements; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.tarif_abonnements (id_tarif_abonnement, tarif, duree_validite, designation, created_at, updated_at) FROM stdin;
1	200	279	secondaire	2023-12-11 11:19:20	2023-12-11 11:19:20
2	500	279	supérieure	2023-12-11 11:19:20	2023-12-11 11:19:20
\.


--
-- Data for Name: tmoneys; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.tmoneys (id_tmoney, id_registration, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: types_ouvrages; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.types_ouvrages (id_type_ouvrage, libelle, created_at, updated_at) FROM stdin;
1	roman	\N	\N
2	nouvelle	\N	\N
3	essai	\N	\N
4	poésie	\N	\N
5	drame	\N	\N
6	biographie	\N	\N
7	autobiographie	\N	\N
8	mémoires	\N	\N
9	thriller	\N	\N
10	science-fiction	\N	\N
11	fantasy	\N	\N
12	historique	\N	\N
13	documentaire	\N	\N
14	roman	\N	\N
15	document pédagogique	\N	\N
16	document technique	\N	\N
17	manuel scolaire	\N	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: amk
--

COPY public.users (id_utilisateur, nom, prenom, nom_utilisateur, email, password, contact, photo_profil, adresse, sexe, remember_token, created_at, updated_at, deleted_at) FROM stdin;
1	SUP ADMIN	SUP ADMIN	_admin	abdoulmalikkondi8@gmail.com	$2y$12$hUE0t5NxHEAMYT0.S62TJe7nv31R7ftQTJNCB20NRofBUQC0S0q7W	93561240	profil.png	{"ville":"Sokode","quartier":"komah 2","numero_maison":""}	Masculin	\N	2023-12-11 11:19:19	2023-12-11 11:19:19	\N
2	SHINTARO	midorima	daiki5	alhassan@gmail.com	$2y$12$L0TjEw8IPWGMX2VhjxAIQOJrWV/sxOU/1lSH64J1HW2mdXCF7vUZW	91817907	profil.png	{"ville":"Sokode","quartier":"Lome","numero_maison":"N102"}	Masculin	\N	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
3	SHINTARO	midorima	Daiki5	alhassan.blog@gmail.com	$2y$12$0clZ05GEvdDpA3lUHyB7muLkCvGlXKnpWJxHCF8xNkj5uwr.c5FgG	91817907	profil.png	{"ville":"Sokode","quartier":"Lome","numero_maison":"N102"}	Masculin	\N	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
4	TCHABANA	hafiz	Haf	hafiz@gmail.com	$2y$12$wZVPXy/bN6WPBDwaTDgXauzt0.kC0m/xRnAtqhTlE92.6U7hRxWrS	90229029	profil.png	{"ville":"Dakar","quartier":"S\\u00e9dhiou","numero_maison":"N108"}	Masculin	\N	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
5	TABATE	daniel	James	Daniel@gmail.com	$2y$12$oWM52QsBVzmebu9PJaB00OyWYvqlNcQOnqO/jq54EDBD6E3I2X.pK	91919191	profil.png	{"ville":"Sokode","quartier":"Komah","numero_maison":"N201"}	Masculin	\N	2023-12-11 11:19:20	2023-12-11 11:19:20	\N
\.


--
-- Name: abonnes_id_abonne_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.abonnes_id_abonne_seq', 3, true);


--
-- Name: activites_id_activite_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.activites_id_activite_seq', 1, false);


--
-- Name: approvisionnements_id_approvisionnement_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.approvisionnements_id_approvisionnement_seq', 1, false);


--
-- Name: auteurs_id_auteur_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.auteurs_id_auteur_seq', 300, true);


--
-- Name: classification_dewey_centaine_id_classification_dewey_centa_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.classification_dewey_centaine_id_classification_dewey_centa_seq', 10, true);


--
-- Name: classification_dewey_dizaines_id_classification_dewey_dizai_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.classification_dewey_dizaines_id_classification_dewey_dizai_seq', 90, true);


--
-- Name: domaines_id_domaine_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.domaines_id_domaine_seq', 28, true);


--
-- Name: domaines_ouvrages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.domaines_ouvrages_id_seq', 423, true);


--
-- Name: emprunts_id_emprunt_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.emprunts_id_emprunt_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: floozs_id_flooz_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.floozs_id_flooz_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: langues_id_langue_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.langues_id_langue_seq', 3, true);


--
-- Name: lignes_emprunts_id_ligne_emprunt_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.lignes_emprunts_id_ligne_emprunt_seq', 1, false);


--
-- Name: lignes_restitutions_id_ligne_restitution_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.lignes_restitutions_id_ligne_restitution_seq', 1, false);


--
-- Name: liquides_id_liquide_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.liquides_id_liquide_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.migrations_id_seq', 33, true);


--
-- Name: natures_id_nature_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.natures_id_nature_seq', 1, false);


--
-- Name: niveaux_id_niveau_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.niveaux_id_niveau_seq', 4, true);


--
-- Name: ouvrages_id_ouvrage_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.ouvrages_id_ouvrage_seq', 399, true);


--
-- Name: permissions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.permissions_id_seq', 49, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: personnels_id_personnel_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.personnels_id_personnel_seq', 2, true);


--
-- Name: registrations_id_registration_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.registrations_id_registration_seq', 1, false);


--
-- Name: reservations_id_reservation_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.reservations_id_reservation_seq', 1, false);


--
-- Name: restitutions_id_restitution_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.restitutions_id_restitution_seq', 1, false);


--
-- Name: roles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.roles_id_seq', 3, true);


--
-- Name: tarif_abonnements_id_tarif_abonnement_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.tarif_abonnements_id_tarif_abonnement_seq', 2, true);


--
-- Name: tmoneys_id_tmoney_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.tmoneys_id_tmoney_seq', 1, false);


--
-- Name: types_ouvrages_id_type_ouvrage_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.types_ouvrages_id_type_ouvrage_seq', 17, true);


--
-- Name: users_id_utilisateur_seq; Type: SEQUENCE SET; Schema: public; Owner: amk
--

SELECT pg_catalog.setval('public.users_id_utilisateur_seq', 5, true);


--
-- Name: abonnes abonnes_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.abonnes
    ADD CONSTRAINT abonnes_pkey PRIMARY KEY (id_abonne);


--
-- Name: activites activites_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.activites
    ADD CONSTRAINT activites_pkey PRIMARY KEY (id_activite);


--
-- Name: approvisionnements approvisionnements_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.approvisionnements
    ADD CONSTRAINT approvisionnements_pkey PRIMARY KEY (id_approvisionnement);


--
-- Name: auteurs_ouvrages auteurs_ouvrages_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.auteurs_ouvrages
    ADD CONSTRAINT auteurs_ouvrages_pkey PRIMARY KEY (id_auteur, id_ouvrage);


--
-- Name: auteurs auteurs_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.auteurs
    ADD CONSTRAINT auteurs_pkey PRIMARY KEY (id_auteur);


--
-- Name: classification_dewey_centaines classification_dewey_centaines_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_centaines
    ADD CONSTRAINT classification_dewey_centaines_pkey PRIMARY KEY (id_classification_dewey_centaine);


--
-- Name: classification_dewey_centaines classification_dewey_centaines_section_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_centaines
    ADD CONSTRAINT classification_dewey_centaines_section_unique UNIQUE (section);


--
-- Name: classification_dewey_centaines classification_dewey_centaines_theme_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_centaines
    ADD CONSTRAINT classification_dewey_centaines_theme_unique UNIQUE (theme);


--
-- Name: classification_dewey_dizaines classification_dewey_dizaines_classe_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_dizaines
    ADD CONSTRAINT classification_dewey_dizaines_classe_unique UNIQUE (classe);


--
-- Name: classification_dewey_dizaines classification_dewey_dizaines_matiere_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_dizaines
    ADD CONSTRAINT classification_dewey_dizaines_matiere_unique UNIQUE (matiere);


--
-- Name: classification_dewey_dizaines classification_dewey_dizaines_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_dizaines
    ADD CONSTRAINT classification_dewey_dizaines_pkey PRIMARY KEY (id_classification_dewey_dizaine);


--
-- Name: domaines_ouvrages domaines_ouvrages_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.domaines_ouvrages
    ADD CONSTRAINT domaines_ouvrages_pkey PRIMARY KEY (id);


--
-- Name: domaines domaines_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.domaines
    ADD CONSTRAINT domaines_pkey PRIMARY KEY (id_domaine);


--
-- Name: emprunts emprunts_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.emprunts
    ADD CONSTRAINT emprunts_pkey PRIMARY KEY (id_emprunt);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: floozs floozs_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.floozs
    ADD CONSTRAINT floozs_pkey PRIMARY KEY (id_flooz);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: langues langues_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.langues
    ADD CONSTRAINT langues_pkey PRIMARY KEY (id_langue);


--
-- Name: lignes_emprunts lignes_emprunts_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_emprunts
    ADD CONSTRAINT lignes_emprunts_pkey PRIMARY KEY (id_ligne_emprunt);


--
-- Name: lignes_restitutions lignes_restitutions_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_restitutions
    ADD CONSTRAINT lignes_restitutions_pkey PRIMARY KEY (id_ligne_restitution);


--
-- Name: liquides liquides_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.liquides
    ADD CONSTRAINT liquides_pkey PRIMARY KEY (id_liquide);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: model_has_permissions model_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_pkey PRIMARY KEY (permission_id, model_id, model_type);


--
-- Name: model_has_roles model_has_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_pkey PRIMARY KEY (role_id, model_id, model_type);


--
-- Name: natures natures_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.natures
    ADD CONSTRAINT natures_pkey PRIMARY KEY (id_nature);


--
-- Name: niveaux niveaux_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.niveaux
    ADD CONSTRAINT niveaux_pkey PRIMARY KEY (id_niveau);


--
-- Name: ouvrage_reservation ouvrage_reservation_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.ouvrage_reservation
    ADD CONSTRAINT ouvrage_reservation_pkey PRIMARY KEY (ouvrage_physique_id_ouvrage_physique, reservation_id_reservation);


--
-- Name: ouvrages ouvrages_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.ouvrages
    ADD CONSTRAINT ouvrages_pkey PRIMARY KEY (id_ouvrage);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: permissions permissions_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: permissions permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.permissions
    ADD CONSTRAINT permissions_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: personnels personnels_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.personnels
    ADD CONSTRAINT personnels_pkey PRIMARY KEY (id_personnel);


--
-- Name: registrations registrations_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_pkey PRIMARY KEY (id_registration);


--
-- Name: reservations reservations_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_pkey PRIMARY KEY (id_reservation);


--
-- Name: restitutions restitutions_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.restitutions
    ADD CONSTRAINT restitutions_pkey PRIMARY KEY (id_restitution);


--
-- Name: role_has_permissions role_has_permissions_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_pkey PRIMARY KEY (permission_id, role_id);


--
-- Name: roles roles_name_guard_name_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_name_guard_name_unique UNIQUE (name, guard_name);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: tarif_abonnements tarif_abonnements_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.tarif_abonnements
    ADD CONSTRAINT tarif_abonnements_pkey PRIMARY KEY (id_tarif_abonnement);


--
-- Name: tmoneys tmoneys_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.tmoneys
    ADD CONSTRAINT tmoneys_pkey PRIMARY KEY (id_tmoney);


--
-- Name: types_ouvrages types_ouvrages_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.types_ouvrages
    ADD CONSTRAINT types_ouvrages_pkey PRIMARY KEY (id_type_ouvrage);


--
-- Name: users users_nom_utilisateur_unique; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_nom_utilisateur_unique UNIQUE (nom_utilisateur);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id_utilisateur);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: amk
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: model_has_permissions_model_id_model_type_index; Type: INDEX; Schema: public; Owner: amk
--

CREATE INDEX model_has_permissions_model_id_model_type_index ON public.model_has_permissions USING btree (model_id, model_type);


--
-- Name: model_has_roles_model_id_model_type_index; Type: INDEX; Schema: public; Owner: amk
--

CREATE INDEX model_has_roles_model_id_model_type_index ON public.model_has_roles USING btree (model_id, model_type);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: amk
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: abonnes abonnes_id_utilisateur_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.abonnes
    ADD CONSTRAINT abonnes_id_utilisateur_foreign FOREIGN KEY (id_utilisateur) REFERENCES public.users(id_utilisateur) ON DELETE CASCADE;


--
-- Name: activites activites_id_abonne_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.activites
    ADD CONSTRAINT activites_id_abonne_foreign FOREIGN KEY (id_abonne) REFERENCES public.abonnes(id_abonne);


--
-- Name: approvisionnements approvisionnements_id_ouvrage_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.approvisionnements
    ADD CONSTRAINT approvisionnements_id_ouvrage_foreign FOREIGN KEY (id_ouvrage) REFERENCES public.ouvrages(id_ouvrage) ON DELETE SET NULL;


--
-- Name: approvisionnements approvisionnements_id_personnel_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.approvisionnements
    ADD CONSTRAINT approvisionnements_id_personnel_foreign FOREIGN KEY (id_personnel) REFERENCES public.personnels(id_personnel) ON DELETE SET NULL;


--
-- Name: classification_dewey_dizaines classification_dewey_dizaines_id_classification_dewey_centaine_; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.classification_dewey_dizaines
    ADD CONSTRAINT classification_dewey_dizaines_id_classification_dewey_centaine_ FOREIGN KEY (id_classification_dewey_centaine) REFERENCES public.classification_dewey_centaines(id_classification_dewey_centaine);


--
-- Name: domaines_ouvrages domaines_ouvrages_id_domaine_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.domaines_ouvrages
    ADD CONSTRAINT domaines_ouvrages_id_domaine_foreign FOREIGN KEY (id_domaine) REFERENCES public.domaines(id_domaine) ON DELETE SET NULL;


--
-- Name: emprunts emprunts_id_abonne_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.emprunts
    ADD CONSTRAINT emprunts_id_abonne_foreign FOREIGN KEY (id_abonne) REFERENCES public.abonnes(id_abonne) ON DELETE SET NULL;


--
-- Name: emprunts emprunts_id_personnel_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.emprunts
    ADD CONSTRAINT emprunts_id_personnel_foreign FOREIGN KEY (id_personnel) REFERENCES public.personnels(id_personnel) ON DELETE SET NULL;


--
-- Name: floozs floozs_id_registration_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.floozs
    ADD CONSTRAINT floozs_id_registration_foreign FOREIGN KEY (id_registration) REFERENCES public.registrations(id_registration);


--
-- Name: lignes_emprunts lignes_emprunts_id_emprunt_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_emprunts
    ADD CONSTRAINT lignes_emprunts_id_emprunt_foreign FOREIGN KEY (id_emprunt) REFERENCES public.emprunts(id_emprunt) ON DELETE SET NULL;


--
-- Name: lignes_emprunts lignes_emprunts_id_ouvrage_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_emprunts
    ADD CONSTRAINT lignes_emprunts_id_ouvrage_foreign FOREIGN KEY (id_ouvrage) REFERENCES public.ouvrages(id_ouvrage) ON DELETE SET NULL;


--
-- Name: lignes_restitutions lignes_restitutions_id_ouvrage_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_restitutions
    ADD CONSTRAINT lignes_restitutions_id_ouvrage_foreign FOREIGN KEY (id_ouvrage) REFERENCES public.ouvrages(id_ouvrage) ON DELETE SET NULL;


--
-- Name: lignes_restitutions lignes_restitutions_id_restitution_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.lignes_restitutions
    ADD CONSTRAINT lignes_restitutions_id_restitution_foreign FOREIGN KEY (id_restitution) REFERENCES public.restitutions(id_restitution) ON DELETE SET NULL;


--
-- Name: liquides liquides_id_registration_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.liquides
    ADD CONSTRAINT liquides_id_registration_foreign FOREIGN KEY (id_registration) REFERENCES public.registrations(id_registration);


--
-- Name: model_has_permissions model_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.model_has_permissions
    ADD CONSTRAINT model_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- Name: model_has_roles model_has_roles_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.model_has_roles
    ADD CONSTRAINT model_has_roles_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: ouvrages ouvrages_id_langue_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.ouvrages
    ADD CONSTRAINT ouvrages_id_langue_foreign FOREIGN KEY (id_langue) REFERENCES public.langues(id_langue) ON DELETE SET NULL;


--
-- Name: ouvrages ouvrages_id_niveau_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.ouvrages
    ADD CONSTRAINT ouvrages_id_niveau_foreign FOREIGN KEY (id_niveau) REFERENCES public.niveaux(id_niveau) ON DELETE SET NULL;


--
-- Name: ouvrages ouvrages_id_type_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.ouvrages
    ADD CONSTRAINT ouvrages_id_type_foreign FOREIGN KEY (id_type) REFERENCES public.types_ouvrages(id_type_ouvrage) ON DELETE SET NULL;


--
-- Name: personnels personnels_id_utilisateur_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.personnels
    ADD CONSTRAINT personnels_id_utilisateur_foreign FOREIGN KEY (id_utilisateur) REFERENCES public.users(id_utilisateur);


--
-- Name: registrations registrations_id_abonne_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_id_abonne_foreign FOREIGN KEY (id_abonne) REFERENCES public.abonnes(id_abonne);


--
-- Name: registrations registrations_id_tarif_abonnement_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.registrations
    ADD CONSTRAINT registrations_id_tarif_abonnement_foreign FOREIGN KEY (id_tarif_abonnement) REFERENCES public.tarif_abonnements(id_tarif_abonnement);


--
-- Name: reservations reservations_id_abonne_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_id_abonne_foreign FOREIGN KEY (id_abonne) REFERENCES public.abonnes(id_abonne);


--
-- Name: reservations reservations_id_ouvrage_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.reservations
    ADD CONSTRAINT reservations_id_ouvrage_foreign FOREIGN KEY (id_ouvrage) REFERENCES public.ouvrages(id_ouvrage);


--
-- Name: restitutions restitutions_id_abonne_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.restitutions
    ADD CONSTRAINT restitutions_id_abonne_foreign FOREIGN KEY (id_abonne) REFERENCES public.abonnes(id_abonne) ON DELETE SET NULL;


--
-- Name: restitutions restitutions_id_emprunt_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.restitutions
    ADD CONSTRAINT restitutions_id_emprunt_foreign FOREIGN KEY (id_emprunt) REFERENCES public.emprunts(id_emprunt) ON DELETE SET NULL;


--
-- Name: restitutions restitutions_id_personnel_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.restitutions
    ADD CONSTRAINT restitutions_id_personnel_foreign FOREIGN KEY (id_personnel) REFERENCES public.personnels(id_personnel) ON DELETE SET NULL;


--
-- Name: role_has_permissions role_has_permissions_permission_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_permission_id_foreign FOREIGN KEY (permission_id) REFERENCES public.permissions(id) ON DELETE CASCADE;


--
-- Name: role_has_permissions role_has_permissions_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.role_has_permissions
    ADD CONSTRAINT role_has_permissions_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id) ON DELETE CASCADE;


--
-- Name: tmoneys tmoneys_id_registration_foreign; Type: FK CONSTRAINT; Schema: public; Owner: amk
--

ALTER TABLE ONLY public.tmoneys
    ADD CONSTRAINT tmoneys_id_registration_foreign FOREIGN KEY (id_registration) REFERENCES public.registrations(id_registration);


--
-- PostgreSQL database dump complete
--

