<?php
// Start the session
session_start();
$mysqli = require __DIR__ . "/database.php";
if (isset($_SESSION["user_id"])) {   
    $sql = "SELECT id, Role FROM user WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);
    $user = $result->fetch_assoc();
    $userid = $user["id"];
    $userRole = $user["Role"];
if ($userRole !== "admin") {
        // Redirect or display an access denied message
        header("Location: access-denied.php");
        exit;
}

} else {
    die("User ID not found in the session.");
}


$sql = "SELECT * FROM user";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="userlist.css">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jaldi" rel="stylesheet">   
    <title>User List</title>
    <style>
        /* Add your additional styles here */
        table {
            width: 1110px;     
            left: 276.53px; 
            top: 226.28px; 
            position: absolute;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #D9D9D9;
        }
    </style>
</head>
<body>
    <header> 
        <img class="Logo" src="images/Logo.png" />
        <div class="DolphinCrm">Dolphin CRM</div>
    </header>    
    <div class="box"></div>

    <!-- Title -->
    <h1 class="Dashboard">Users</h1>

    <!-- User Table -->
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch user data from the database and display in the table
            $mysqli = require __DIR__ . "/database.php";
            $sql = "SELECT firstname, lastname, email, Role, created_at FROM user";
            $result = $mysqli->query($sql);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['firstname']} {$row['lastname']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['Role']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "Error fetching user data: " . $mysqli->error;
            }

            // Close the database connection
            $mysqli->close();
            ?>
        </tbody>
    </table>

    <!-- Content form -->
    <form action="signup.html" method="post">
        <input class="AddUser" type="submit" value="+ Add User">
    </form>

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
</body>
</html>
