<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="newcontact.css">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jaldi" rel="stylesheet">   
                           
    <title>New Contact</title>
</head>
<body>
    <header> 
        <img class="Logo"src="images/Logo.png" />
        <div class="DolphinCrm">Dolphin CRM</div>
    </header>    
    <div class="box"></div>


    <!-- Title -->
    <h1 class="NewContactB">New Contact</h1>

    <!-- Sidebar Contents -->
    <div class="sidebar"></div>
    <label class="Users">Users</label>
    <img class="Newcontactimg" src="images/NewContactImg.png" />
    <img class="Homeimg" src="images/Homeimg.png" />
    <img class="Usersimg"  src="images/Usersimg.png" />
    <label class="Home">Home</label>
    <label class="NewContact">New Contact</label>
    <div class="Line1"></div>
    <img class="Logoutimg" src="images/Logoutimg.png"/>
    <label class="Logout">Logout</label>
    </div>
    <script src="sidebar.js"></script>

    <!-- Content form -->
    <form method="post">

        <label class="Title">Title</label>
        <select class="title" name="title">
            <option value="Mr.">Mr.</option>
            <option value="Ms.">Ms.</option>
            <option value="Mrs.">Mrs.</option>
        </select>

        <label class="FirstName">First Name</label>
        <input class ="firstname" type="text" name="firstname">

        <label class="LastName">Last Name</label>
        <input class="lastname" type="text" name="lastname">

        <label class="Email">Email</label>
        <input class= "email" type ="email" name="email">


        <label class="Telephone">Telephone</label>
        <input class="telephone" type="tel" name="telephone">

        <label class="Company">Company</label>
        <input class="company" type ="text" name="company">

        <label class="Type">Type</label>
        <select class= "type" name="type">
            <option value="SalesLead">Sales Lead</option>
            <option value="Support">Support</option>

        

        </select>

        <label class="AssignedTo">Assigned To</label>
        <select class="assignedto" name="assignedto">
            <?php
            // Include the database.php file
            $mysqli = require __DIR__ . "/database.php";

            // Fetch users from the database
            $sql = "SELECT id, firstname, lastname FROM user";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row['id'].">".$row['firstname'] . $row[ "lastname"]. "</option>";
                }
            }
            ?>
        </select>

        <input class="Save" type="submit" value="Save">

    </form>




    

</body>
</html>


<?php
session_start();

$mysqli = require __DIR__ . "/database.php"; 

if (isset($_SESSION["user_id"])) {   
    $sql = "SELECT id FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    $userid = $user["id"];
} else {
    die("User ID not found in the session.");
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : "";
    $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : "";
    $emailaddress = isset($_POST["email"]) ? $_POST["email"] : "";
    $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
    $company = isset($_POST["company"]) ? $_POST["company"] : "";
    $type = isset($_POST["type"]) ? $_POST["type"] : "";
    $assignedto = isset($_POST["assignedto"]) ? $_POST["assignedto"] : "";
    $createdby = $user["id"] . $user["firstname"] . $user["lastname"];

    if (empty($firstname) || empty($lastname) || empty($telephone) || empty($company) || !filter_var($emailaddress, FILTER_VALIDATE_EMAIL)) {
        die("Please fill in all required fields.");
    }

    $createdat = $updatedat = date("Y-m-d H:i:s");

    $sql2 = "INSERT INTO contacts (firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->stmt_init();

    if (!$stmt->prepare($sql2)) {
        die("SQL error: " . $mysqli->error);
    }

    $stmt->bind_param("ssssssssss", 
                    $firstname, 
                    $lastname,
                    $emailaddress,
                    $telephone,
                    $company,
                    $type,
                    $assignedto,
                    $createdby,
                    $createdat,
                    $updatedat);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit;
    } else {
        if ($mysqli->errno === 1062) {
            die("Email Already Taken");
        }

        die($mysqli->error . " " . $mysqli->errno);
    }
}
?>

