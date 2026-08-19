<?php
echo "CDPO User Generated Code...";die;
// Database connection parameters
$host   = "localhost";      // PostgreSQL server (e.g., localhost or IP address)
$port   = "5433";           // Default PostgreSQL port
$dbname = "cmrts";  // Database name
$user   = "postgres";  // PostgreSQL username
$password = "root"; // PostgreSQL password
// Create the connection string (DSN)
$conn_string = "host=$host port=$port dbname=$dbname user=$user password=$password";
$dbconn = pg_connect($conn_string); // Connect to the PostgreSQL database

$query = "SELECT * FROM rp_location_master_block as block 
JOIN rp_location_master_district as district ON block.district_id_fk = district.district_id_pk ORDER BY block_name ASC";
$result = pg_query($dbconn, $query);
$block_data = pg_fetch_all($result);
// echo "<pre>";print_r($block_data); // Display the result
$insetUserData = array();
foreach ($block_data as $key => $value) {

	// echo "<pre>";print_r($value);die;
	$block_name    = $value['block_name'];
	$district_name = $value['district_name'];
	$district_id=!empty($value['district_id_pk']) ?intval($value['district_id_pk']) :0;
	$block_id_pk=!empty($value['block_id_pk']) ? intval($value['block_id_pk']) :0;
	$subdiv_id  =!empty($value['subdiv_id_fk']) ? intval($value['subdiv_id_fk']) :0;

	$district = str_replace(' ', '-', $district_name);
	$user_name = "CDPO.".$block_name.'.'.$district;
	// echo $user_name."<br>";die;

	$query = "SELECT * FROM cm_stake_holder_login WHERE login_id='".$user_name."' ";
	$result = pg_query($dbconn, $query);
	$user_exist_count = pg_num_rows($result);
	
	if($user_exist_count!=0){
		echo $user_name.'----->> Already Exist </br>';
	}else{
		//echo 'Else-->>'.$user_exist_count;
		$password = generatePassword();
		$password_hash = hash('sha256',$password);
		$date = date('Y-m-d H:i:s');
	
        pg_query($dbconn, "BEGIN");
		try {
			// SQL query using placeholders for safety
			$query = "INSERT INTO cm_stake_holder_login (
		    stake_id_fk, login_id, login_password, active_status, entry_time, entry_ip, 
		    stake_holder_details, stake_details_id_fk, base_password, base_login_id, 
		    district, block, status, subdiv, login_status, master_password
			) VALUES (5, '".$user_name."', '".$password_hash."', 0, '".$date."', '".$_SERVER['REMOTE_ADDR']."', 'CDPO', 5, '".$password."', '".$user_name."', '".$district_id."', '".$block_id_pk."', 0, '".$subdiv_id."', 0, '".hash('sha256','cmrts123#')."' )";
			// echo $query;die;
			// Execute the query securely with pg_query_params
			$result = pg_query($dbconn, $query);
			if ($result) {
		        // Commit transaction on success
		        pg_query($dbconn, "COMMIT");
		        echo $key."-- Transaction successful: Data inserted! >>>>".$user_name.'</br>';
		    } else {
		        // Rollback transaction on failure
		        pg_query($dbconn, "ROLLBACK");
		        echo "Transaction failed: " . pg_last_error($dbconn);
		    }

		}catch (Exception $e) {
		    // Handle exceptions and rollback
		    pg_query($dbconn, "ROLLBACK");
		    echo "Transaction error: " . $e->getMessage();
		}
	}
	// die;
}


function generatePassword($minLength = 8, $maxLength = 15) {
    // Define character pools
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits    = '0123456789';
    $specialChars = '!@#$%^&*()-_=+[]{}<>?,./';

    // Ensure at least one character from each category
    $password = '';
    $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
    $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
    $password .= $specialChars[random_int(0, strlen($specialChars) - 1)];
    $password .= $digits[random_int(0, strlen($digits) - 1)];

    // Fill the rest of the password length with random characters from all pools
    $allChars = $lowercase . $uppercase . $digits . $specialChars;
    $remainingLength = random_int($minLength, $maxLength) - strlen($password);

    for ($i = 0; $i < $remainingLength; $i++) {
        $password .= $allChars[random_int(0, strlen($allChars) - 1)];
    }
    // Shuffle the password to avoid predictable patterns
    $password = str_shuffle($password);
    return $password;
}

?>