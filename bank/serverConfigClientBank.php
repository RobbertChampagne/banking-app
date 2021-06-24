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


if(isset($_POST['updatedClient'])) {

    /*$step_one = $_POST['step_one'];
    $step_two = $_POST['step_two'];
    $step_three = $_POST['step_three'];
    $step_four = $_POST['step_four'];
    $approved = $_POST['approved'];*/
    $clientArr = $_SESSION['client'];

    for ($i = 0; $i < count($clientArr); $i++){ // is checked?
        
        if($i === 5){//one
            if(empty($_POST['step_one'])){
                $clientArr[$i] = 0;
            }else{
                $clientArr[$i] = 1;
            }

        }else if($i === 6){//two
            if(empty($_POST['step_two'])){
                $clientArr[$i] = 0;
            }else{
                $clientArr[$i] = 1;
            }

        }else if($i === 7){//three
            if(empty($_POST['step_three'])){
                $clientArr[$i] = 0;
            }else{
                $clientArr[$i] = 1;
            }

        }else if($i === 8){//four
            if(empty($_POST['step_four'])){
                $clientArr[$i] = 0;
            }else{
                $clientArr[$i] = 1;
            }

        }else if($i === 9){//approved
            if(empty($_POST['approved'])){
                $clientArr[$i] = 0;
            }else{
                $clientArr[$i] = 1;
            }
        }
    }


    print_r($clientArr);


/*
    //VALIDATION
    foreach($client as $attribute){
        $attribute = filter_var($attribute, FILTER_SANITIZE_SPECIAL_CHARS); //This filter is used to escape "<>& and characters with ASCII value below 32
    }

    //CONFIG CLIENT
    //[5,"bert","bert@gmail.com",0,"car",0,0,0,0,0]
    $query = "UPDATE bankclients SET step_one=?, step_two=?, step_three=?, step_four=?, approved=? WHERE id=?";
    $result = $connection->prepare($query); //prepares query
    $result->bind_param("iiiiii", $client[5], $client[6], $client[7], $client[8], $client[9], $client[0] ); //add type to var
    $result->execute(); //uses query on DB  
    $result->store_result(); //save result
    $result->close();
    */
}


?>