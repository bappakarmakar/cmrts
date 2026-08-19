<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2025-05-06 16:48:44 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:48:44 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:48:48 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:48:48 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:48:56 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:48:56 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:49:18 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:49:18 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:51:23 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:51:23 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:51:25 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:51:25 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:54:14 --> Severity: Notice --> Undefined variable: cap C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 16:54:14 --> Severity: Notice --> Trying to access array offset on value of type null C:\xampp7.4.33\htdocs\cmrts_report\admin\application\views\themes\adminlte\otp_pages\cmrts_otp_verification_view.php 196
ERROR - 2025-05-06 17:14:30 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column inc.police_case does not exist
LINE 39: ...p_2_mother_alive, cp2.cp_address as cp_2_address, inc.police...
                                                              ^ C:\xampp7.4.33\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-05-06 17:14:30 --> Query error: ERROR:  column inc.police_case does not exist
LINE 39: ...p_2_mother_alive, cp2.cp_address as cp_2_address, inc.police...
                                                              ^ - Invalid query: SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
            district_location_master_description(cp1.cp_district) AS cp_1_district,

            block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
            cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
            gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
            cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
            cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
            cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
            cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
            cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
            cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
            cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
            FROM cm_incident_report inc
            LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            AND cp1.cp_type = 1
            LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            AND cp2.cp_type = 2
            WHERE incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            LEFT JOIN cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '2' AND cmir.block = '110' AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '2' and cmircpo.cp_block = '110' AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '2' and cp_address.block = '110' AND cmir.current_status in(3,4))

                    OR (cmir.district = '2' AND cmir.block = '110' AND cmir.current_status in(1) AND cmir.stake_holder_id_fk = '304')
                )
            )
ERROR - 2025-05-06 17:18:50 --> Severity: Warning --> pg_query(): Query failed: ERROR:  column cp1.cp_police_case does not exist
LINE 39: ... cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_pol...
                                                              ^ C:\xampp7.4.33\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-05-06 17:18:50 --> Query error: ERROR:  column cp1.cp_police_case does not exist
LINE 39: ... cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_pol...
                                                              ^ - Invalid query: SELECT inc.stake_holder_id_fk, inc.incident_id_pk, inc.incident_date,inc.marriage_date, inc.street_landmark, inc.ward_gp,
            inc.state, inc.district, inc.block, district_location_master_description(inc.district) AS incident_district,
            block_location_master_description(inc.block) AS incident_block, inc.pin_code, inc.police_station,
            inc.marriage_details AS marriage_details, inc.prevented_details AS prevented_details,
            inc.location_description AS location_description, inc.anonymous, inc.identity_known_name,
            inc.identity_street_landmark, inc.identity_ward_gp, inc.identity_block as identity_block_id,
            inc.identity_state, district_location_master_description(inc.identity_district) AS identity_district,
            block_location_master_description(inc.identity_block) AS identity_block, inc.identity_pin_code,
            inc.identity_police_station, inc.identity_phone_no, inc.information_received AS information_received,
            inc.reporting_id, inc.cp_two_is_available, inc.current_status, inc.delete_status, inc.created_at,
            cp1.cp_id_pk as cp_1_id_pk, cp1.cp_type as cp_1_type, cp1.cp_name as cp_1_name, cp1.cp_street_landmark as cp_1_street_landmark,
            cp1.cp_ward_gp as cp_1_ward_gp, cp1.cp_state as cp_1_state, state_master_description(cp1.cp_state) AS cp_1_state_name,
            district_location_master_description(cp1.cp_district) AS cp_1_district,

            block_location_master_description(cp1.cp_block) AS cp_1_block, cp1.cp_block AS cp_1_block_id,
            cp1.cp_pin_code as cp_1_pin_code, cp1.cp_police_station as cp_1_police_station, cp1.cp_phone_no as cp_1_phone_no,
            gender_master_description(cp1.cp_gender) AS cp_1_gender_value, cp1.cp_gender AS cp_1_gender,
            cp1.cp_age as cp_1_age, cp1.cp_social_category AS cp_1_social_category, cp1.cp_religion AS cp_1_religion,
            cp1.cp_dob as cp_1_dob, cp1.cp_dob_document_available as cp_1_dob_document_available, cp1.cp_dob_document_id as cp_1_dob_document_id,
            cp1.cp_dob_document_type AS cp_1_dob_document_type, cp1.cp_identity_document_available as cp_1_identity_document_available,
            cp1.cp_identity_document_id as cp_1_identity_document_id, cp1.cp_identity_document_type AS cp_1_identity_document_type,
            cp1.cp_highest_educational_attainment AS cp_1_highest_educational_attainment, cp1.cp_father_name as cp_1_father_name,
            cp1.cp_father_mobile_no as cp_1_father_mobile_no, cp1.cp_father_id as cp_1_father_id, cp1.cp_father_id_type as cp_1_father_id_type, cp1.cp_father_alive as cp_1_father_alive,
            cp1.cp_mother_name as cp_1_mother_name, cp1.cp_mother_mobile_no as cp_1_mother_mobile_no, cp1.cp_mother_id as cp_1_mother_id, cp1.cp_mother_id_type as cp_mother_id_type,
            cp1.cp_mother_alive as cp_1_mother_alive, cp1.cp_address as cp_1_address,
            cp2.cp_id_pk as cp_2_id_pk, cp2.cp_type as cp_2_type, cp2.cp_name as cp_2_name, cp2.cp_street_landmark as cp_2_street_landmark,
            cp2.cp_ward_gp as cp_2_ward_gp, cp2.cp_state as cp_2_state, state_master_description(cp2.cp_state) AS cp_2_state_name,
            district_location_master_description(cp2.cp_district) AS cp_2_district,
            block_location_master_description(cp2.cp_block) AS cp_2_block, cp2.cp_block AS cp_2_block_id,
            cp2.cp_pin_code as cp_2_pin_code, cp2.cp_police_station as cp_2_police_station, cp2.cp_phone_no as cp_2_phone_no,
            gender_master_description(cp2.cp_gender) AS cp_2_gender_value, cp2.cp_gender AS cp_2_gender,
            cp2.cp_age as cp_2_age, cp2.cp_social_category AS cp_2_social_category, cp2.cp_religion AS cp_2_religion,
            cp2.cp_dob as cp_2_dob, cp2.cp_dob_document_available as cp_2_dob_document_available, cp2.cp_dob_document_id as cp_2_dob_document_id,
            cp2.cp_dob_document_type AS cp_2_dob_document_type, cp2.cp_identity_document_available as cp_2_identity_document_available,
            cp2.cp_identity_document_id as cp_2_identity_document_id, cp2.cp_identity_document_type AS cp_2_identity_document_type,
            cp2.cp_highest_educational_attainment AS cp_2_highest_educational_attainment, cp2.cp_father_name as cp_2_father_name,
            cp2.cp_father_mobile_no as cp_2_father_mobile_no, cp2.cp_father_id as cp_2_father_id, cp2.cp_father_id_type as cp_2_father_id_type, cp2.cp_father_alive as cp_2_father_alive,
            cp2.cp_mother_name as cp_2_mother_name, cp2.cp_mother_mobile_no as cp_2_mother_mobile_no, cp2.cp_mother_id as cp_2_mother_id, cp2.cp_mother_id_type as cp_2_mother_id_type,
            cp2.cp_mother_alive as cp_2_mother_alive, cp2.cp_address as cp_2_address, inc.police_case, cp1.cp_police_case AS cp1_police_case, cp2.cp_police_case AS cp2_police_case, cp1.cp_district AS cp_1_district_id, cp2.cp_district AS cp_2_district_id
            FROM cm_incident_report inc
            LEFT JOIN cm_incident_report_contracting_parties AS cp1 ON inc.incident_id_pk = cp1.incident_id_fk
            AND cp1.cp_type = 1
            LEFT JOIN cm_incident_report_contracting_parties AS cp2 ON inc.incident_id_pk = cp2.incident_id_fk
            AND cp2.cp_type = 2
            WHERE incident_id_pk in(
            SELECT incident_id_pk FROM cm_incident_report AS cmir
            LEFT JOIN cm_incident_report_contracting_parties AS cmircpo ON cmir.incident_id_pk = cmircpo.incident_id_fk
            LEFT JOIN cm_incident_report_cp_address_details as cp_address on cmircpo.cp_id_pk = cp_address.cp_id_fk
            WHERE cmir.delete_status = '0' and cmir.created_at is not null and
                (
                    (cmir.district = '2' AND cmir.block = '110' AND cmir.current_status in(2,3,4)) 

                    OR (cmircpo.cp_district = '2' and cmircpo.cp_block = '110' AND cmir.current_status in(3,4))
                    
                    OR (cp_address.district = '2' and cp_address.block = '110' AND cmir.current_status in(3,4))

                    OR (cmir.district = '2' AND cmir.block = '110' AND cmir.current_status in(1) AND cmir.stake_holder_id_fk = '304')
                )
            )
ERROR - 2025-05-06 17:21:49 --> Severity: error --> Exception: Call to undefined method Police_case_model::police_station() C:\xampp7.4.33\htdocs\cmrts_report\admin\application\controllers\reporting\incident\Incident_list.php 53
ERROR - 2025-05-06 17:24:50 --> Severity: Warning --> pg_query(): Query failed: ERROR:  relation &quot;cm_police_station_master&quot; does not exist
LINE 1: SELECT * FROM cm_police_station_master WHERE district_id_fk=...
                      ^ C:\xampp7.4.33\htdocs\cmrts_report\system\database\drivers\postgre\postgre_driver.php 242
ERROR - 2025-05-06 17:24:50 --> Query error: ERROR:  relation "cm_police_station_master" does not exist
LINE 1: SELECT * FROM cm_police_station_master WHERE district_id_fk=...
                      ^ - Invalid query: SELECT * FROM cm_police_station_master WHERE district_id_fk='2' AND active_status=1 ORDER BY police_station_id_pk ASC
ERROR - 2025-05-06 18:10:09 --> 404 Page Not Found: Police_case/Police_case
ERROR - 2025-05-06 18:10:09 --> 404 Page Not Found: Police_case/Police_case
ERROR - 2025-05-06 18:16:34 --> 404 Page Not Found: Police_case/Police_case
ERROR - 2025-05-06 18:16:34 --> 404 Page Not Found: Police_case/Police_case
