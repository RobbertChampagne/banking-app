<?php
    session_start();

    //AJAX CALL FROM homeBankClientScript.js TO SHOW client on page
    if (isset($_POST['getClient'])) {
        
        $clientToShow = json_encode($_SESSION['client']); //to json
        
        echo $clientToShow; 
    }


?>