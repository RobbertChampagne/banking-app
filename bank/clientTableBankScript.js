window.addEventListener("load", loaded);

function loaded() {

    let value = document.getElementById("container").getAttribute("value");
    let title = document.getElementById("tableTitle");

    if(value === "newClients"){
        title.textContent = "New clients";
    }else {
        title.textContent = "Existing clients";
    }

    //LOAD CLIENT TABLE
    ajaxCallStartOnLoad() 

    function createTable(clients){
        
        let table = document.getElementById("clientTable");

        //TABLE HEADERS
        let tr = document.createElement("tr");

        if(value === "newClients"){

            for (i = 0; i < 5; i++) {
                let th = document.createElement("th");

                if (i === 0) {
                    th.textContent = "ID";
                } else if (i === 1) {
                    th.textContent ="NAME";
                } else if (i === 2) {
                    th.textContent = "EMAIL";
                } else if (i === 3) {
                    th.textContent = "LOAN TYPE";
                }else{
                    th.textContent = "CONFIG";
                }

                tr.appendChild(th);
            }

        } else{  //existing clients

            for (i = 0; i < 10; i++) {

                let th = document.createElement("th");
    
                if (i === 0) {
                    th.textContent = "ID";
                } else if (i === 1) {
                    th.textContent ="NAME";
                } else if (i === 2) {
                    th.textContent = "EMAIL";
                } else if (i === 3) {
                    th.textContent = "LOAN TYPE";
                } else if (i === 4) {
                    th.textContent = "STEP ONE";
                } else if (i === 5) {
                    th.textContent = "STEP TWO";
                } else if (i === 6) {
                    th.textContent = "STEP THREE";
                } else if (i === 7) {
                    th.textContent = "STEP FOUR";
                }else if (i === 8){
                    th.textContent = "APPROVED";
                }else{
                    th.textContent = "CONFIG";
                }
    
                tr.appendChild(th);
            }
        }

        table.appendChild(tr);

        //TABLE CLIENTS
        //$client = [$clientId, $name, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];
        for (let client of clients){

            if(value === "newClients" && client[3] === 1){

                let tr = document.createElement("tr");

                for (i = 0; i < 5; i++) {
                    let td = document.createElement("td");

                    if (i === 0) {
                        td.textContent = client[i];
                    } else if (i === 1) {
                        td.textContent = client[i];
                    } else if (i === 2) {
                        td.textContent = client[i];
                    } else if (i === 3) {
                        td.textContent = client[4];
                    } else if (i === 4) {
                        let link = document.createElement('a');
                        link.setAttribute("href", "configClientBank.php?client=" + client + "&&table=" + value );
                        let img = document.createElement('img'); 
                        img.src = '../images/icons/config.svg'; 
                        img.setAttribute("width", "30px");
                        link.appendChild(img);
	                    td.appendChild(link);
                    }

                    tr.appendChild(td);
                }

                table.appendChild(tr);

            } else if(value === "existingClients" && client[3] === 0){
                
                let tr = document.createElement("tr");

                for (i = 0; i < 10; i++) {
                    let td = document.createElement("td");

                    if (i === 0) {
                        td.textContent = client[i];
                    } else if (i === 1) {
                        td.textContent = client[i];
                    } else if (i === 2) {
                        td.textContent = client[i];
                    } else if (i === 3) {
                        td.textContent = client[4];
                    } else if (i === 4) {
                        td.textContent = client[5];
                    } else if (i === 5) {
                        td.textContent = client[6];
                    } else if (i === 6) {
                        td.textContent = client[7];
                    } else if (i === 7) {
                        td.textContent = client[8];
                    } else if (i === 8) {
                        td.textContent = client[9];
                    } else {
                        let link = document.createElement('a');
                        link.setAttribute("href", "configClientBank.php?client=" + client + "&&table=" + value );
                        let img = document.createElement('img'); 
                        img.src = '../images/icons/config.svg'; 
                        img.setAttribute("width", "30px");
                        link.appendChild(img);
	                    td.appendChild(link);
                    }

                    tr.appendChild(td);
                }

                table.appendChild(tr);
            
            }
        }
    }


    function ajaxCallStartOnLoad(){ //AJAX CALL TO serverBank.php TO GET CLIENTS TO SHOW IN TABLE
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