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
} else {
    // Redirect to login page or handle the case when the user is not logged in
    header("Location: login.php");
    exit();
}


$contactId = isset($_GET['id']) ? $_GET['id'] : die("Contact ID not provided.");

// Handle the form submission to add a new note
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["addanote"])) {
    $note = $_POST["addanote"];

    // Validate and sanitize the input
    $note = htmlspecialchars(strip_tags($note), ENT_QUOTES);

    // Insert the new note into the notes table
    $insertNoteSql = "INSERT INTO notes (contact_id, comment, created_by, created_at) VALUES (?, ?, ?, NOW())";
    $insertNoteStmt = $mysqli->prepare($insertNoteSql);
    $createdBy = $user["id"]; 
    $insertNoteStmt->bind_param("iss", $contactId, $note, $createdBy);

    $insertNoteStmt->execute();
    $insertNoteStmt->close();

    // Redirect to the same page to prevent form resubmission
    header("Location: {$_SERVER['PHP_SELF']}?id=$contactId");
    exit();
}

// Fetch contact information
$sql = "SELECT * FROM contacts WHERE id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $contactId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $contact = $result->fetch_assoc();

    // Fetch user information based on assigned_to
    $assignedToUserId = $contact['assigned_to'];
    $userSql = "SELECT firstname, lastname FROM user WHERE id = ?";
    $userStmt = $mysqli->prepare($userSql);
    $userStmt->bind_param("i", $assignedToUserId);
    $userStmt->execute();
    $userResult = $userStmt->get_result();

    if ($userResult->num_rows > 0) {
        $assignedUser = $userResult->fetch_assoc();
        $assignedToName = $assignedUser['firstname'] . ' ' . $assignedUser['lastname'];
    } else {
        $assignedToName = 'Not Assigned';
    }

} else {
    die("Contact not found.");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="contactdetails.css">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/jaldi" rel="stylesheet">   
    <link rel="stylesheet" href="signup.php">                         
    <title>Contact Details</title>
    <style>
        .Table1 {     
            width: 1110px;
            height: 45px;
            left: 290px;
            top: 250px;
            position: absolute;
            background: #ffff;
            border-collapse: collapse;
            margin: 20px;
            text-align: left;

        th, td {

            border: 1px solid #ddd;
            padding: 20px;
            text-align: center;

        }


        th {
            background-color: #D9D9D9;
        }

    }

        .Table2 {
            width: 1110px;
            height: 45px;
            left: 290px;
            top: 650px; /* Adjusted top position */
            position: absolute;
            background: #ffff;
            border-collapse: collapse;
            margin: 20px;
            text-align: left;

        }


    </style>
</head>
<body>
    <header> 
        <img class="Logo" src="images/Logo.png"/>
        <div class="DolphinCrm">Dolphin CRM</div>
    </header>   

    <!-- Sidebar Contents -->
    <div class="sidebar"></div>
    <label class="Users">Users</label>    
    <img class="Homeimg" src="images/Homeimg.png"/>
    <img class="Usersimg" src="images/Usersimg.png"/>
    <label class="Home">Home</label>
    <img class="NewContactimg" src="images/NewContactImg.png"/>
    <label class="NewContact">New Contact</label>
    <div class="Line1"></div>
    <img class="Logoutimg" src="images/Logoutimg.png"/>
    <label class="Logout">Logout</label>  
    <script src="sidebar.js"></script>



    <div class="box"></div>
    <div class="box2"></div>

    <!-- Title -->
    <h1 class="ContactInfo">Contact Info</h1>
    <table class="Table1">
        <tr>
            <th>Email</th>
            <td><?php echo htmlspecialchars($contact['email'], ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <th>Telephone</th>
            <td><?php echo htmlspecialchars($contact['telephone'], ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <th>Company</th>
            <td><?php echo htmlspecialchars($contact['company'], ENT_QUOTES); ?></td>
        </tr>
        <tr>
            <th>Assigned To</th>
            <td><?php echo htmlspecialchars($assignedToName, ENT_QUOTES); ?></td>
        </tr>
    </table>

    <!-- Notes Section -->
    <section>
    <h2>Notes</h2>
    <table class="Table2">
        <tr>
            <th>Date</th>
            <th>Comment</th>
            <th>Created By</th>
        </tr>
        <?php
        // Fetch notes for the contact
        $notesSql = "SELECT notes.created_at, notes.comment, notes.created_by, user.firstname, user.lastname
                     FROM notes
                     LEFT JOIN user ON notes.created_by = user.id
                     WHERE notes.contact_id = ?";
        $notesStmt = $mysqli->prepare($notesSql);
        $notesStmt->bind_param("i", $contactId);
        $notesStmt->execute();
        $notesResult = $notesStmt->get_result();

        while ($noteRow = $notesResult->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($noteRow['created_at'], ENT_QUOTES) . "</td>";
            echo "<td>" . htmlspecialchars($noteRow['comment'], ENT_QUOTES) . "</td>";
            echo "<td>" . htmlspecialchars($noteRow['firstname'] . ' ' . $noteRow['lastname'], ENT_QUOTES) . "</td>";
            echo "</tr>";
        }
        $notesStmt->close();
        ?>
    </table>

    <!-- Content form -->
    <form method="post">
        <label class="Notes">Notes</label>
        <label class="AddANote">Add a Note about this Contact</label>
        <textarea class="addanote" name="addanote" rows="4" cols="50"></textarea>
        <br>
        <input class="AddNote" type="submit" value="Add Note">
        <input class="AssignToMe" type="submit" value="Assign to me">
        <input class="SwitchToSalesLead" type="submit" value="Switch to Sales Lead">
    </form>
</section>
<img class="AssignToMePic" src="images/assigntomeicon.png">
<img class="NotesSymbol" src="images/notessymbol.png">

<div class="Line2"></div>
<img class="ProfilePic" src="images/profilepicicon.png">

</body>
</html>
