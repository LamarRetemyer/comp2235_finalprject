<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user 
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
    $sqlContacts = "SELECT * FROM contacts";
    $resultContacts = $mysqli->query($sqlContacts);
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
    <style>
        table {
            width: 1110px;
            height: 45px;
            left: 277px;
            top: 250px;
            position: absolute;
            background: #ffff;
            border-collapse: collapse;
            margin-top: 20px;
            text-align: center;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #D9D9D9;
        }
        }
       
    </style>
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
    
  
     <!-- Display contacts in a table -->
    <table>
        <thead>
            <tr>
                <th >Name</th>
                <th>Email</th>
                <th >Company</th>
                <th >Type</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            while ($contact = $resultContacts->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $contact['firstname'] . " " . $contact['lastname'] . "</td>";
                echo "<td>" . $contact['email'] . "</td>";
                echo "<td>" . $contact['company'] . "</td>";
                echo "<td>" . $contact['type'] . "</td>";
                echo "<td><a href='contactdetails.php?id={$contact['id']}'>View</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Content form -->
    <form action="newcontact.php" method="post">
        <input class="AddContact" type="submit" value="+ Add Contact">

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


  
 