<?php
function generatePassword($minLength = 8, $maxLength = 15) {
    // Define character pools
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $digits = '0123456789';
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

// // Generate and display a password
// echo generatePassword();


try {
    $dsn = "pgsql:host=localhost;port=5433;dbname=cmrts_new;";
    $username = "postgres";
    $password = "padmin";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch all users
    $query = "SELECT stake_holder_login_id_pk, update_password FROM cm_stake_holder_login WHERE update_password=0 order by stake_holder_login_id_pk desc"; // Replace 'users' with your actual user table name
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // echo "<pre>";
    // print_r($users);die;

    foreach ($users as $user) {
        // Generate a new password
        $newPassword = generatePassword();

            $flage =1;
            $hash_password = hash('sha256', $newPassword);
            $updateQuery = "UPDATE cm_stake_holder_login SET login_password = :hash_password, base_password = :new_password, update_password = :update_flage WHERE stake_holder_login_id_pk = :id";
            $updateStmt = $pdo->prepare($updateQuery);
            $updateStmt->execute(['hash_password' =>$hash_password, 'new_password' =>$newPassword, 'update_flage' =>$flage, 'id' =>$user['stake_holder_login_id_pk']]);

        echo "Updated password for user ID ==>>".$user['stake_holder_login_id_pk']." to ==>> ".$newPassword." ==>> Hash PW ==>>".$hash_password;
        echo "</br>";
        die;
    }

    echo "All passwords updated successfully.</br>";
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}


?>