<?php include('serverBankClient.php') ?> <!--include PHP page-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../bank/indexBankStyle.css" >

    <title>index</title>
</head>
<body>
    
    <div id="container">
        <a id="backLink" href="..\index.php"> 
            <img id="backImg" src="..\images\icons\logout.svg" alt="">
        </a>

        <div id="loginContainer">
            <form id="form" action="indexBankClient.php" method="post">
                <h2>Name</h2>
                <input name="name" class="loginInputs" type="text" id="nameInput" placeholder="Enter your name"  required >

                <h2>Password</h2>
                <input name="password" class="loginInputs" type="password" id="passwordInput" placeholder="Enter your password" required  >
                    
                <br><br>
                <button type="submit" name="loginbutton">Login</button>
            </form>

            <?php include('..\error.php'); ?> <!--include errors page (shows errors)-->

        </div>
    </div>

</body>
</html>