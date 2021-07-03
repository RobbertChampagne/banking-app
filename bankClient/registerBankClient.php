<?php include('serverBankClient.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="registerBankClientStyle.css" >
    <script type="text/javascript" src="registerBankClientScript.js"></script>

    <title>Register</title>
</head>
<body>
    
    <div id="container">
        <a id="backLink" href="indexBankClient.php"> 
            <img id="backImg" src="..\images\icons\logout.svg" alt="">
        </a>

        <div id="registerContainer">

            <div id="loanTypeButtonsContainer">
                <img id="car" src="..\images\icons\car.svg" alt="">
                <img id="house" src="..\images\icons\house.svg" alt="">
                <img id="money" src="..\images\icons\money.svg" alt="">
            </div>

            <form id="form" action="registerBankClient.php" method="post">
                <h2>Name</h2>
                <input name="name" class="registerInputs" type="text" id="nameInput" placeholder="Enter your name"  required >

                <h2>Password</h2>
                <input name="password" autocomplete class="registerInputs" type="password" id="passwordInput" placeholder="Enter your password" required  >
                    
                <h2>Password (repeat)</h2>
                <input name= "passwordrepeat" autocomplete class="registerInputs" type="password" id="passwordInputRepeat" placeholder="Enter your password" required >
                   
                <h2>Email</h2>
                <input name= "email" class="registerInputs" type="email" id="emailInput" placeholder="Enter your email" required >
                
                <input type="text" id="loanTypeValue" name="loanTypeValue" value="car">
                    
                <br><br>
                <button type="submit" name="registerbutton" value="registerbutton">Register</button>
    
            </form>
            
        </div>


    </div>

    <?php include('..\error.php'); ?> <!--include errors page (shows errors)-->


</body>
</html>