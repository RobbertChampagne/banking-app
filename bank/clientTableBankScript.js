window.addEventListener("load", loaded);

function loaded() {

    ajaxCallStartOnLoad()

    function createTable(clients){
        
        let table = document.getElementById("clientTable");

        //TABLE HEADERS
        let tr = document.createElement("tr");

        for (i = 0; i < 10; i++) {
            let th = document.createElement("th");

            if (i === 0) {
                th.textContent = "ID";
                //th.setAttribute("class", "clientTd");
            } else if (i === 1) {
                th.textContent ="NAME";
            } else if (i === 2) {
                th.textContent = "EMAIL";
            } else if (i === 3) {
                th.textContent = "NEW CLIENT";
            } else if (i === 4) {
                th.textContent = "LOAN TYPE";
            } else if (i === 5) {
                th.textContent = "STEP ONE";
            } else if (i === 6) {
                th.textContent = "STEP TWO";
            } else if (i === 7) {
                th.textContent = "STEP THREE";
            } else if (i === 8) {
                th.textContent = "STEP FOUR";
            }else{
                th.textContent = "APPROVED";
            }

            tr.appendChild(th);
        }

        table.appendChild(tr);

        //TABLE CLIENTS
        //$client = [$clientId, $name, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
        for (let client of clients){

            let tr = document.createElement("tr");

            for (i = 0; i < 10; i++) {
                let td = document.createElement("td");

                if (i === 0) {
                    td.textContent = client[i];
                    //td.setAttribute("class", "clientTd");
                } else if (i === 1) {
                    td.textContent = client[i];
                } else if (i === 2) {
                    td.textContent = client[i];
                } else if (i === 3) {
                    td.textContent = client[i];
                } else if (i === 4) {
                    td.textContent = client[i];
                } else if (i === 5) {
                    td.textContent = client[i];
                } else if (i === 6) {
                    td.textContent = client[i];
                } else if (i === 7) {
                    td.textContent = client[i];
                } else if (i === 8) {
                    td.textContent = client[i];
                } else {
                    td.textContent = client[i];
                }

                tr.appendChild(td);
            }

            table.appendChild(tr);
        }
    }


    //AJAX CALL TO serverBank.php TO GET CLIENTS TO SHOW IN TABLE
    function ajaxCallStartOnLoad(){
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let objectsJson = JSON.parse(this.responseText);
                createTable(objectsJson);
            }
        };
    
        xmlhttp.open("POST", "serverClientTableBank.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("getClients=true");
    }
}