<?php

session_start();

//CONNECT TO DB
$dbPassword = "robbertadmin";
$dbUserName = "admin_robbert";
$dbServer = "localhost";
$dbName = "bankingapp";

$connection = mysqli_connect($dbServer, $dbUserName, $dbPassword, $dbName);


if($connection->connect_errno) //when there is no connection 
{
    exit("Connection DB failed. Reason: ".$connection->connect_error);
}


//SHOW CLIENTS
$query = "SELECT * FROM bankclients";
$result = $connection->prepare($query); //prepares query
$result->execute(); //uses query on DB
$result->bind_result($clientId, $name, $passwd, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved ); //save output query in variable
$result->store_result(); //save result

$clientsToShow = array();

if($result->num_rows > 0){
    while($result->fetch()){
        $client = [$clientId, $name, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
        Array_push($clientsToShow, $client);
    }
}
$result->close();

//AJAX CALL FROM clientTableBankScript.js TO SHOW clients IN TABLE
if (isset($_POST['getClients'])) {
    $clientsToShow = json_encode($clientsToShow); //to json
    echo $clientsToShow; 
}

?>