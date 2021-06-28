window.addEventListener("load", loaded);

function loaded() {

    function showClientInfo(clientInfo){
        let infoContainer = document.getElementById("infoContainer");
        let nameClient = document.getElementById("nameClient");
        let loanTypeImg = document.getElementById("loanTypeImg");
        let progressBar = document.getElementById("progressBar");
    }

    function ajaxCallStartOnLoad(){ //AJAX CALL TO serverBank.php TO GET CLIENTS TO SHOW IN TABLE
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let objectsJson = JSON.parse(this.responseText);
                showClientInfo(objectsJson);
            }
        };

        xmlhttp.open("POST", "serverBankClient.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getClient=true");
    }

}