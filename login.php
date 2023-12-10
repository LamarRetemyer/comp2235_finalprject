<?php
$is_invalid = false;
$emailaddress = $_POST["Email"];
// $dropdown = $_POST["dropdown"];
$password = $_POST["Password"];

$mysqli = require __DIR__ . "/database.php";
$sql = sprintf("SELECT * FROM user
        WHERE email = '%s'", 
        $mysqli->real_escape_string($emailaddress));

$result = $mysqli->query($sql);

$user = $result->fetch_assoc();

if ($user) {
    if (password_verify($_POST["Password"], $user["password_hash"])) {
        session_start();

        session_regenerate_id();
        
        $_SESSION["user_id"] = $user["id"];

        header("Location: dashboard.php");
        exit;
    }
}
$is_invalid = true;  

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="login.php">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">                
    <title>Login</title>
</head>
<body>
        <header>
            <img class="Logo"src="images/Logo.png" />
            <div class="DolphinCrm">Dolphin CRM</div>
        </header>
        
        <?php if ($is_invalid): ?>
            <em><h1>Invalid login attempt</h1></em> 
        <?php endif; ?>
        <a href="login.html">Return to login</a>
        
        
        <footer>
            <p>Copyright &copy; 2023 Dolphin CRM </p>
        </footer>  
            
  
      
</body>
</html>        