window.addEventListener("load", loaded);

function loaded() {

    //GET BACK TO PREVIOUS PAGE
    let value = document.getElementById("backLink").getAttribute("value");
    let link = "";

    if (value === "newClients") {
        link = "clientTableBank.php?table=newClients";
    } else {
        link = "clientTableBank.php?table=existingClients";
    }

    let backLink = document.getElementById("backLink");
    backLink.setAttribute("href", link);



    //GET CLIENT ARRAY FROM configClientBank.php
    let clientArr = JSON.parse(
        document.getElementById("tableContainer").getAttribute("value")
    );



    //CREATE TABLE
    let step_one_checked = false;
    let step_two_checked = false;
    let step_three_checked = false;
    let step_four_checked = false;
    let approved_checked = false;

    function check(event){
        console.log(event.target.name);////////////////////////////////////////////
    }

    createTable(clientArr);

    function createTable(client) {
        let table = document.getElementById("clientTable");

        //TABLE HEADERS
        let tr = document.createElement("tr");

        if (value === "newClients") {
        for (i = 0; i < 5; i++) {
            let th = document.createElement("th");

            if (i === 0) {
            th.textContent = "ID";
            } else if (i === 1) {
            th.textContent = "NAME";
            } else if (i === 2) {
            th.textContent = "EMAIL";
            } else if (i === 3) {
            th.textContent = "LOAN TYPE";
            } else {
            th.textContent = "CONFIRM";
            }

            tr.appendChild(th);
        }
        } else {
        //existing client
        for (i = 0; i < 10; i++) {
            let th = document.createElement("th");

            if (i === 0) {
            th.textContent = "ID";
            } else if (i === 1) {
            th.textContent = "NAME";
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
            } else if (i === 8) {
            th.textContent = "APPROVED";
            } else {
            th.textContent = "UPDATE";
            }

            tr.appendChild(th);
        }
        }

        table.appendChild(tr);

        //TABLE CLIENTS
        //$client = [$clientId, $name, $email, $new_client, $loan_type, $step_one, $step_two, $step_three, $step_four, $approved];

        if (value === "newClients" && client[3] === "1") {
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
            let link = document.createElement("a");
            link.setAttribute("href","configClientBank.php?client=" + client + "&&table=" + value);
            let img = document.createElement("img");
            img.src = "../images/icons/save.svg";
            img.setAttribute("width", "50px");
            link.appendChild(img);
            td.appendChild(link);
            }

            tr.appendChild(td);
        }

        table.appendChild(tr);
        
        } else if (value === "existingClients" && client[3] === "0") {
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
                let step_one = client[5];
                let checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                checkbox.addEventListener("click", check);
                checkbox.setAttribute("name", "step_one");

                if(step_one === "1"){
                    checkbox.checked = true;
                    checkbox.disabled = true;
                    step_one_checked = true;
                }

                td.appendChild(checkbox);

            } else if (i === 5) {
                let step_two = client[6];
                let checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                checkbox.addEventListener("click", check);
                checkbox.setAttribute("name", "step_two");

                if(step_two === "1"){
                    checkbox.checked = true;
                    checkbox.disabled = true;
                    step_two_checked  = true;
                }

                td.appendChild(checkbox);

            } else if (i === 6) {
                let step_three = client[7];
                let checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                checkbox.addEventListener("click", check);
                checkbox.setAttribute("name", "step_three");

                if(step_three === "1"){
                    checkbox.checked = true;
                    checkbox.disabled = true;
                    step_three_checked = true; 
                }

                td.appendChild(checkbox);

            } else if (i === 7) {
                let step_four = client[8];
                let checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                checkbox.addEventListener("click", check);
                checkbox.setAttribute("name", "step_four");

                if(step_four === "1"){
                    checkbox.checked = true;
                    checkbox.disabled = true;
                    step_four_checked = true; 
                }

                td.appendChild(checkbox);

            } else if (i === 8) {
                let approved = client[9];
                let checkbox = document.createElement("input");
                checkbox.setAttribute("type", "checkbox");
                checkbox.addEventListener("click", check);
                checkbox.setAttribute("name", "approved");

                if(approved === "1"){
                    checkbox.checked = true;
                    checkbox.disabled = true;
                    approved_checked  = true; 
                }

                td.appendChild(checkbox);

            } else {
                let link = document.createElement("a");
                link.setAttribute("href","configClientBank.php?client=" + client + "&&table=" + value);
                let img = document.createElement("img");
                img.src = "../images/icons/save.svg";
                img.setAttribute("width", "50px");
                link.appendChild(img);
                td.appendChild(link);
            }

            tr.appendChild(td);
        }

        table.appendChild(tr);
        }
    }

}
