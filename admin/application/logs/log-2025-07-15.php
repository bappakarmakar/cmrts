<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-07-15 10:47:47 --> Severity: Warning --> pg_connect(): Unable to connect to PostgreSQL server: could not connect to server: Connection refused (0x0000274D/10061)
	Is the server running on host &quot;localhost&quot; (::1) and accepting
	TCP/IP connections on port 5433?
could not connect to server: Connection refused (0x0000274D/10061)
	Is the server running on host &quot;localhost&quot; (127.0.0.1) and accepting
	TCP/IP connections on port 5433? D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 154
ERROR - 2025-07-15 10:47:47 --> Unable to connect to the database
ERROR - 2025-07-15 10:49:39 --> Severity: Notice --> Undefined variable: cap D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 10:49:39 --> Severity: Notice --> Trying to access array offset on value of type null D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 12:05:33 --> Severity: Notice --> Undefined variable: cap D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 12:05:33 --> Severity: Notice --> Trying to access array offset on value of type null D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 12:05:43 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:05:43 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:07:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:07:30 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:07:32 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:07:32 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:08:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:08:22 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:08:24 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:08:24 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:08:28 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:08:28 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:09:36 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:09:36 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:10:22 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te&quot;, &quot;inc&quot;.&quot;reporting_id&quot;, &quot;inc&quot;.&quot;marriage_date&quot;, &quot;inc&quot;.&quot;new...
                                                             ^ D:\xampp\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-07-15 12:10:22 --> Query error: ERROR:  column inc.new_schd_status does not exist
LINE 1: ...te", "inc"."reporting_id", "inc"."marriage_date", "inc"."new...
                                                             ^ - Invalid query: SELECT DISTINCT "inc"."stake_holder_id_fk", "inc"."incident_id_pk", "inc"."incident_date", "inc"."reporting_id", "inc"."marriage_date", "inc"."new_schd_status", "inc"."schd_generated_date", "cp1"."cp_dob" as "cp_1_dob", "cp2"."cp_dob" as "cp_2_dob", "cp1"."cp_type" as "cp_1_type", "cp2"."cp_type" as "cp_2_type", "cp1"."cp_id_pk" as "cp_1_id_pk", "cp2"."cp_id_pk" AS "cp_2_id_pk", "cp1"."cp_gender" as "cp1_gender", "cp2"."cp_gender" as "cp2_gender", "cp1"."cp_name" as "cp_1_name", "cp2"."cp_name" as "cp_2_name"
FROM "cm_incident_report" "inc"
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp1" ON "inc"."incident_id_pk" = "cp1"."incident_id_fk" AND "cp1"."cp_type" = 1
LEFT JOIN "cm_incident_report_contracting_parties" AS "cp2" ON "inc"."incident_id_pk" = "cp2"."incident_id_fk" AND "cp2"."cp_type" = 2
WHERE "inc"."current_status" = 3
AND "inc"."district" = '2'
AND "cp1"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "cp2"."cp_dob" > inc.incident_date - INTERVAL '21 years'
AND "inc"."new_schd_status" IS NULL
AND "inc"."reporting_id" = '112400311'
ERROR - 2025-07-15 12:12:33 --> Severity: Notice --> Undefined variable: cap D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 12:12:33 --> Severity: Notice --> Trying to access array offset on value of type null D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 12:36:07 --> Severity: error --> Exception: Call to undefined function get_cp_full_age() D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\reporting\incident\scheduler_generate_table_view.php 68
ERROR - 2025-07-15 15:25:15 --> Severity: Notice --> Undefined variable: cap D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 15:25:15 --> Severity: Notice --> Trying to access array offset on value of type null D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 16:39:20 --> Severity: Notice --> Undefined variable: cap D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-07-15 16:39:20 --> Severity: Notice --> Trying to access array offset on value of type null D:\xampp\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
