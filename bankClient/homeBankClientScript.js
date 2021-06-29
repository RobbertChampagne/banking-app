window.addEventListener("load", loaded);

function loaded() {

    function showClientInfo(clientInfo){
        let infoContainer = document.getElementById("infoContainer");
        let nameClient = document.getElementById("nameClient");
        let loanTypeImg = document.getElementById("loanTypeImg");
        let progressBar = document.getElementById("progressBar");
        let checkboxContainer = document.getElementById("checkboxContainer");

        //name
        nameClient.textContent = clientInfo[1];

        //img
        if(clientInfo[4] === "home"){
            loanTypeImg.setAttribute("src","../images/icons/house.svg");
        }else if(clientInfo[4] === "car"){
            loanTypeImg.setAttribute("src","../images/icons/car.svg");
        }else{
            loanTypeImg.setAttribute("src","../images/icons/money.svg");
        }

        //progress bar count
        let progressBarCount = 0;
    
        //checkboxes
        for(let i = 5; i < clientInfo.length; i++) {
            

            //checkbox
            let checkbox = document.createElement("input");
            checkbox.setAttribute("type", "checkbox");

            if(clientInfo[i] === 1){
                checkbox.checked = true;
                progressBarCount += 20; //add to progress bar
            }
            checkbox.disabled = true;

            //label
            let label = document.createElement("label");

            if(i === 5){
                checkbox.setAttribute("id", "step_one");
                label.setAttribute("for", "step_one");
                label.textContent = "Step one";
            }else if(i === 6){
                checkbox.setAttribute("id", "step_two");
                label.setAttribute("for", "step_two");
                label.textContent = "Step two";
            }else if(i === 7){
                checkbox.setAttribute("id", "step_three");
                label.setAttribute("for", "step_three");
                label.textContent = "Step three";
            }else if(i === 8){
                checkbox.setAttribute("id", "step_four");
                label.setAttribute("for", "step_four");
                label.textContent = "Step four";
            }else{
                checkbox.setAttribute("id", "approved");
                label.setAttribute("for", "approved");
                label.textContent = "Approved";
            }

            checkboxContainer.appendChild(checkbox);
            checkboxContainer.appendChild(label);

            let br = document.createElement("br");
            checkboxContainer.appendChild(br);

        }

        //show progress bar
        progressBar.setAttribute("value", progressBarCount);

    }

    ajaxCallStartOnLoad();

    function ajaxCallStartOnLoad(){ //AJAX CALL TO homeBankClient.php TO GET CLIENT
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                let jsonOb = JSON.parse(this.responseText);
                showClientInfo(jsonOb);

            }
        };

        xmlhttp.open("POST", "serverBankGetClient.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getClient=true");
    }

}