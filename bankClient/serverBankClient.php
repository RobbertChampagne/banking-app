<?php

session_start();

// Unset all of the session variables 
//(so when logged out you can't go back with the back button)
$_SESSION = array();

//INITIALISING VAR
$errors = array();
$name = "";
$password = "";


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


//LOGIN USER
if(isset($_POST['loginbutton'])){

    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS);     //This filter is used to escape "<>& and characters with ASCII value below 32
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);

    //FORM VALIDATION
    if(empty($name)) {array_push($errors, "Name is required!");}
    if(empty($password)) {array_push($errors, "Password is required!");}

    if(count($errors) == 0) {

        $password = md5($password);
        $query = "SELECT * FROM bankclients WHERE name = ? AND password= ? ";
        $result = $connection->prepare($query); //prepares query
        $result->bind_param("ss", $name, $password ); //add type to var
        $result->execute(); //uses query on DB
        $result->bind_result($clientId, $name, $passwd, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved ); //save output query in variable
        $result->store_result(); //save result

        if($result->num_rows > 0){
            while($result->fetch()){
                $_SESSION['name'] = $name;
                $_SESSION['customerId'] = $clientId;

                //$client = array("id" => $clientId, "name"=>$name, "email"=>$email); //, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
                $client = [$clientId, $name, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
                
                $_SESSION['client'] = $client;
                
                header("location: homeBankClient.php");
            }
        }else{
            array_push($errors, "Wrong username/password combination");
        }

        $result->close();

    }
}


//REGISTER USER
if (isset($_POST['registerbutton'])) {
    echo "ja";

    //FORM VALIDATION
    $name = filter_var($_POST['name'], FILTER_SANITIZE_SPECIAL_CHARS); //This filter is used to escape "<>& and characters with ASCII value below 32
    $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS); 
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); //remove all illegal characters from the $email variable
    $password = filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS);
    $password2 = filter_var($_POST['passwordrepeat'], FILTER_SANITIZE_SPECIAL_CHARS);
    $loan_type = filter_var($_POST['loanTypeValue'], FILTER_SANITIZE_SPECIAL_CHARS);


    //IS EMPTY? 
    if(empty($name)) {array_push($errors, "Username is required!");}
    if(empty($email)) {array_push($errors, "Email is required!");}
    if(empty($password)) {array_push($errors, "Password is required!");}
    if($password != $password2) {array_push($errors, "Passwords need to be the same!");}


    //CHECK DB FOR SAME USER WITH SAME email
    $email_check_query = "SELECT email FROM bankclients WHERE email = ? LIMIT 1"; //stops after finding 1
    $result = $connection->prepare($email_check_query); //prepares query on db
    $result->bind_param("s", $email ); //add type to var
    $result->execute(); //uses query on DB
    $result->bind_result($loginEmail); //save output query in variable
    $result->store_result(); //save result

    if($result->num_rows > 0){array_push($errors, "Email already in use.");}


    //REGISTER USER IF NO ERROR
    if(count($errors) == 0){
        $password = md5($password); //encrypt password
        
        $query = "INSERT INTO bankclients (name, password, email, new_client, loan_type, step_one, step_two, step_three, step_four, approved) VALUES (?, ?, ?, 1,?,0,0,0,0,0)";
        $result = $connection->prepare($query); //prepares query on db
        $result->bind_param("ssss", $name, $password, $email, $loan_type); //add type to var
        $result->execute(); //uses query on DB
        $result->close();

        //LOGIN 
        $password = md5($password);
        $query = "SELECT * FROM bankclients WHERE name = ? AND password= ? ";
        $result = $connection->prepare($query); //prepares query
        $result->bind_param("ss", $name, $password ); //add type to var
        $result->execute(); //uses query on DB
        $result->bind_result($clientId, $name, $passwd, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved ); //save output query in variable
        $result->store_result(); //save result

        if($result->num_rows > 0){
            while($result->fetch()){
                $_SESSION['name'] = $name;
                $_SESSION['customerId'] = $clientId;

                //$client = array("id" => $clientId, "name"=>$name, "email"=>$email); //, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
                $client = [$clientId, $name, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
                
                $_SESSION['client'] = $client;
                
                header("location: homeBankClient.php");
            }
        }else{
            array_push($errors, "Something went wrong");
        }

        $result->close();


    }
}


?>