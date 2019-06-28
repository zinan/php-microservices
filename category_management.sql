--
-- PostgreSQL database dump
--

-- Dumped from database version 11.4 (Debian 11.4-1.pgdg90+1)
-- Dumped by pg_dump version 11.2

-- Started on 2019-06-27 12:58:23 +03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2866 (class 0 OID 16388)
-- Dependencies: 197
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, category_name) FROM stdin;
1	Bilgisayar
2	Cep Telefonu
3	Ev Elektroniği
4	Müzik
5	Spor
6	deneme
7	deneme2
\.


--
-- TOC entry 2873 (class 0 OID 0)
-- Dependencies: 196
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 7, true);


-- Completed on 2019-06-27 12:58:25 +03

--
-- PostgreSQL database dump complete
--

