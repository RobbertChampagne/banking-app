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

if(isset($_POST['confirmClient'])) { //APPROVE CLIENT LOANS
    
    $clientArr = $_SESSION['client'];

    //VALIDATION
    foreach($clientArr as $attribute){
        $attribute = filter_var($attribute, FILTER_SANITIZE_SPECIAL_CHARS); //This filter is used to escape "<>& and characters with ASCII value below 32
    }

    $confirmed = 0;
    
    //CONFIG CLIENT
    //[5,"bert","bert@gmail.com",0,"car",0,0,0,0,0]
    $query = "UPDATE bankclients SET new_client=? WHERE id=?";
    $result = $connection->prepare($query); //prepares query
    $result->bind_param("ii", $confirmed, $clientArr[0]); //add type to var
    $result->execute(); //uses query on DB  
    $result->store_result(); //save result
    $result->close();

    $_SESSION['client'] = $clientArr; //save new client in session

    header("location: clientTableBank.php");
}


if(isset($_POST['updatedClient'])) { //UPDATE CLIENTS STEPS

    $clientArr = $_SESSION['client'];


    for ($i = 0; $i < count($clientArr); $i++){ // is checked?
        
        if($i === 5){//one
            //php does not see "checkbox_two.checked = true; && checkbox_two.disabled = true;" in JS 
            //previous checkboxes come in empty and get removed
            if(!empty($_POST['step_one']) or $clientArr[$i] == 1){ //or == check if it was checked last time
                $clientArr[$i] = 1;
            }else{
                $clientArr[$i] = 0;
            }

        }else if($i === 6){//two
            if(!empty($_POST['step_two']) or $clientArr[$i] == 1){
                $clientArr[$i] = 1;
            }else{
                $clientArr[$i] = 0;
            }

        }else if($i === 7){//three
            if(!empty($_POST['step_three']) or $clientArr[$i] == 1){
                $clientArr[$i] = 1;
            }else{
                $clientArr[$i] = 0;
            }

        }else if($i === 8){//four
            if(!empty($_POST['step_four']) or $clientArr[$i] == 1){
                $clientArr[$i] = 1;
            }else{
                $clientArr[$i] = 0;
            }

        }else if($i === 9){//approved
            if(!empty($_POST['approved']) or $clientArr[$i] == 1){
                $clientArr[$i] = 1;
            }else{
                $clientArr[$i] = 0;
            }
        }
    }


    //VALIDATION
    foreach($clientArr as $attribute){
        $attribute = filter_var($attribute, FILTER_SANITIZE_SPECIAL_CHARS); //This filter is used to escape "<>& and characters with ASCII value below 32
    }

    //CONFIG CLIENT
    //[5,"bert","bert@gmail.com",0,"car",0,0,0,0,0]
    $query = "UPDATE bankclients SET step_one=?, step_two=?, step_three=?, step_four=?, approved=? WHERE id=?";
    $result = $connection->prepare($query); //prepares query
    $result->bind_param("iiiiii", $clientArr[5], $clientArr[6], $clientArr[7], $clientArr[8], $clientArr[9], $clientArr[0] ); //add type to var
    $result->execute(); //uses query on DB  
    $result->store_result(); //save result
    $result->close();
    
    $_SESSION['client'] = $clientArr; //save new client in session

    header("location: clientTableBank.php");

}


?>