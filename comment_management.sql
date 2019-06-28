--
-- PostgreSQL database dump
--

-- Dumped from database version 11.4 (Debian 11.4-1.pgdg90+1)
-- Dumped by pg_dump version 11.2

-- Started on 2019-06-27 12:57:14 +03

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
-- TOC entry 2872 (class 1262 OID 16397)
-- Name: comment_management; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE comment_management WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.utf8' LC_CTYPE = 'en_US.utf8';


ALTER DATABASE comment_management OWNER TO postgres;

\connect comment_management

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
-- TOC entry 2866 (class 0 OID 16400)
-- Dependencies: 197
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comments (id, product_id, comment, user_id, user_name, comment_date) FROM stdin;
1	1	Bu fiyata olabilecek en iyi kalite diyebilirim dışarıda ki sesi min indirip kaliteli yüksek sesle müzik dinlemeye devam edebilirsiniz. Şarj süresi de oldukça iyi	1	admin	2019-06-26
2	1	ürünü alırken bir kaç yorum okumuştum, ses iyiydi sonra kullandıkça kesilmeye başladı sık sık kopmalar oldu diye. başta sorunsuz olan ürünün böyle bir konuda giderek sıkıntı çıkaracağını düşünmediğimden ürünü aldım. Aldım ama aynen söylendiği gibi oldu. Kullandıkça daha sık bağlantı/kopma sorunu yaşama başladım. Bu da hevesimi kaçırdı. Daha taksiti bitmeden kaldırdım bir kenarı, siz düşünün.	2	john doe	2019-06-26
3	1	sinan deneme	1	admin	2019-06-27
\.


--
-- TOC entry 2874 (class 0 OID 0)
-- Dependencies: 196
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.comments_id_seq', 3, true);


-- Completed on 2019-06-27 12:57:17 +03

--
-- PostgreSQL database dump complete
--

