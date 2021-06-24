<?php

    session_start();

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

    $client = $_GET["client"]; //array send as string from clientTableBankScript.js
    $clientArray = explode(',', $client); //to array

    $_SESSION['client'] = $clientArray;

    print_r(json_encode($clientArray));

    //include('serverConfigClientBank.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="clientTableBankStyle.css">
    <link rel="stylesheet" type="text/css" href="ConfigClientBankStyle.css">
    <script type="text/javascript" src="configClientBankScript.js"></script>


    <title><?php echo $_SESSION['client'][1] ?></title> <!--$clientArray[1]-->
</head>
<body>

    <div id="container">

        <a id="backLink" value=<?php echo $_SESSION['table'] ?>> <!--$table-->
            <img id="backImg" src="..\images\icons\back.svg" alt="">
        </a>

        <div id="tableContainer" value=<?php echo json_encode($_SESSION['client']); ?>> <!--$clientArray-->
            <form action="serverConfigClientBank.php" method="POST" id="configClientForm">    
                <table id="clientTable"></table>
            </form>
        </div>

    </div>

</body>
</html>