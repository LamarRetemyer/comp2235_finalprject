<?php


$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$emailaddress = $_POST["email"];
$dropdown = $_POST["dropdown"];
$password = $_POST["password"];

if (empty($firstname)) {
    die("Please enter First Name");
}

if (empty($lastname)) {
    die("Please enter Last Name");
}


if (! filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
    die("Email is required");
}

if (strlen($password) < 8) {
    die("Password is too short. Please use 8 or more characters.");
}

if (! preg_match("/[a-z]/i", $password)) {
    die("Password must contain at least one letter");
}

if (! preg_match("/[0-9]/", $password)) {
    die("Password must contain at least one number");
}
$createdat =  date("Y-m-d H:i:s");
$password_hash = password_hash($password, PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (firstname, lastname, email, password_hash, Role, created_at)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssssss", 
                $firstname, 
                $lastname,
                $emailaddress,
                $password_hash,
                $dropdown,
                $createdat);

if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;

} else {

    if ($mysqli->errno === 1062) {
        die("Email Already Taken");
    }

    die($mysqli->error . " " . $mysqli->errno);

}





?>