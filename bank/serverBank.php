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
        $query = "SELECT * FROM bankers WHERE name = ? AND password= ? ";
        $result = $connection->prepare($query); //prepares query
        $result->bind_param("ss", $name, $password ); //add type to var
        $result->execute(); //uses query on DB
        $result->bind_result($userId, $loginName, $passwd); //save output query in variable
        $result->store_result(); //save result


        if($result->num_rows > 0){
            while($result->fetch()){
                $_SESSION['name'] = $loginName;
                $_SESSION['customerId'] = $userId;
                header("location: homeBank.php");
            }
        }else{
            array_push($errors, "Wrong username/password combination");
        }

        $result->close();

    }
}
?>