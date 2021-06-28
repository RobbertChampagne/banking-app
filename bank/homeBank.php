<?php

    session_start();
    
    if(isset($_SESSION['table'])){
        unset($_SESSION['table']); //reset var when comming back from chosen table
    }

    //IF NOT LOGGED IN YET
    if(!isset($_SESSION['name'])){
        $_SESSION['msg'] = "You must log in first to view this page"; //message not logged in 
        header("location: indexBank.php");
    }


    //LOGGING OUT
    if(isset($_GET['logout'])){
            
        // Unset all of the session variables 
        //(so when logged out you can't go back with the back button)
        $_SESSION = array();
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        
        session_destroy();
        header("location: indexBank.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="homeBankStyle.css" >

    <title>Home</title>
</head>
<body>
    
    <div id="container">

        <a id="logoutLink" href="indexBank.php?logout">
            <img id="logout" src="..\images\icons\logout.svg" alt="">
            <p id="logoutP">Logout</p>
        </a>

        <div id="linkContainer">
            <div id="newClientContainer" class="newAndExistLinkContainers">
                <a href="clientTableBank.php?table=newClients">
                    <img id="newClientImg" src="..\images\icons\newclients.svg" alt=""> 
                    <p id="newClientP">New clients</p>
                </a>
            </div>
            <div id="existingClientContainer" class="newAndExistLinkContainers">
                <a href="clientTableBank.php?table=existingClients">
                    <img id="existClientImg" src="..\images\icons\clients.svg" alt="">
                    <p id="existClientP">Existing clients</p>
                </a>
            </div>
        
        </div>
    </div>

</body>
</html>