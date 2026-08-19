<?php
    $dsn = "pgsql:host=localhost;port=5433;dbname=cmrts_new;";
    $username = "postgres";
    $password = "padmin";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all users
    $district_incident = "SELECT * FROM cm_incident_report WHERE district=10"; // Replace 'users' with your actual user table name
    $get_incident = $pdo->query($district_incident);
    $incident = $get_incident->fetchAll(PDO::FETCH_ASSOC);
    echo "<pre>";
    print_r($incident);die;

    if(isset($incident) && !empty($incident)){

        $delete_cp = "DELETE FROM cm_incident_report_contracting_parties WHERE cp_district = 23"; // Replace with actual table and conditions
        $del_cp = $pdo->prepare($delete_cp);
        $del_cp->execute();
    
        foreach ($incident as $incid_id) {
    
            // delete for Local person
            $delee_local_per = "DELETE FROM cm_incident_report_local_persons_involved_details WHERE incident_id_fk = :id"; 
            $del_local = $pdo->prepare($delee_local_per);
            $del_local->execute(['id' => $incid_id['incident_id_pk']]); // Bind and execute with dynamic value
    
            // delete for Official person
            $delete_official_per = "DELETE FROM cm_incident_report_officials_involved_details WHERE incident_id_fk = :id";
            $del_official = $pdo->prepare($delete_official_per);
            $del_official->execute(['id' => $incid_id['incident_id_pk']]);
    
            // Delete Home Enquiry Data
            $delete_HE_data = "DELETE FROM cm_incident_report_home_visit WHERE incident_id_fk = :id";
            $del_HE = $pdo->prepare($delete_HE_data);
            $del_HE->execute(['id' => $incid_id['incident_id_pk']]);
    
            // Delete Home Enquiry Siblings Data
            $delete_HE_siblings = "DELETE FROM cm_incident_report_home_visit_siblings_details WHERE incident_id_fk = :id";
            $del_HE_sibling = $pdo->prepare($delete_HE_siblings);
            $del_HE_sibling->execute(['id' => $incid_id['incident_id_pk']]);
    
            // Delete Follow-up Data
            $delete_FU = "DELETE FROM cm_follow_up_visit_details WHERE incident_id_fk = :id";
            $del_FUV = $pdo->prepare($delete_FU);
            $del_FUV->execute(['id' => $incid_id['incident_id_pk']]);
    
            echo "Delete Local Person and Official person user ID ==>>".$incid_id['incident_id_pk'];
            echo "</br>";
        }
    
        $delete_incident = "DELETE FROM cm_incident_report WHERE district = 23"; // Replace with actual table and conditions
        $del_incident = $pdo->prepare($delete_incident);
        $del_incident->execute();

    }else{
        echo "<h2>No Intervention data found for the given district</h2>";die;
    }


?>