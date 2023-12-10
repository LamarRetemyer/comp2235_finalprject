<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user 
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
} 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jaldi" rel="stylesheet">   
 

    <title>Dashboard</title>
</head>
<body>
    <header> 
        <img class="Logo"src="images/Logo.png" />
        <div class="DolphinCrm">Dolphin CRM</div>
    </header>    
    <div class="box"></div>
   
   
    <!-- Title -->
    <h1 class="Dashboard">Dashboard</h1>

    <img class="Filter" src="images/filter.png" />
    <label class="FilterBy">Filter by:</label>
    <label class="All">All</label>
    <label class="SalesLeads">Sales Leads</label>
    <label class="Support">Support</label>
    <label class="AssignedToMe">Assign to me</label>
    <div class="tablerow"></div>
    <label class="Name">Name</label>
    <label class="Email">Email</label>
    <label class="Company">Company</label>
    <label class="Type">Type</label>


    <!-- Content form -->
    <form action="signup.php" method="post">
        <input class="AddContact" type="submit" value="Add Contact">

    </form>

   
    

    <!-- Sidebar Contents -->
    <div class="sidebar"></div>

        <label class="Users">Users</label>
        <img class="Newcontactimg"src="images/NewContactImg.png" />
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


  
 