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

if (isset($_REQUEST['updatedClient'])) {

    $client = $_REQUEST['updatedClient'];

    //VALIDATION
    foreach($client as $attribute){
        $attribute = filter_var($attribute, FILTER_SANITIZE_SPECIAL_CHARS); //This filter is used to escape "<>& and characters with ASCII value below 32
    }
//////////////////////////////////////////////
    //CONFIG CLIENT IF NO ERROR
    $query = "UPDATE customer_profile SET name=?, email=?, creditcardnumber=?, address=? WHERE email=?";
    $result = $connection->prepare($query); //prepares query
    $result->bind_param("sssss", $name, $email, $creditcardnumber, $address, $session_email ); //add type to var
    $result->execute(); //uses query on DB  
    $result->store_result(); //save result
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $result->close();
    
}


?>