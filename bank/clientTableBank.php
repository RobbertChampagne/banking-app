<?php

    include('serverClientTableBank.php');
    
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

    //get so this page knows what table was clicked
    if(empty($_SESSION['table'])){
        $_SESSION['table'] = $_GET["table"]; //coming from homeBank.php
    }//else coming from configClientBank.php (back)

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="clientTableBankStyle.css">
    <script type="text/javascript" src="clientTableBankScript.js"></script>

    <title>Client Table</title>
</head>
<body>

    <div id="container" value=<?php echo $_SESSION['table']?>>

        <a id="backLink" href="homeBank.php">
            <img id="backImg" src="..\images\icons\back.svg" alt="">
        </a>

        <p id=tableTitle></p>

        <div id="tableContainer">
            <table id="clientTable"></table>
        </div>
    </div>

</body>
</html>