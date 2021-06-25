window.addEventListener("load", loaded);

function loaded() {

    let checkbox_one;
    let checkbox_two;
    let checkbox_three;
    let checkbox_four;
    let approved;

    let step_one;
    let step_two;
    let step_three;
    let step_four;

    
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
    let clientArr = JSON.parse(document.getElementById("tableContainer").getAttribute("value"));
    //["5","bert","bert@gmail.com","0","car","0","0","0","0","0"]


    //CREATE TABLE

    function saveConfig(){ //after clicking save button/img

        let formClient = document.getElementById("configClientForm");
        formClient.submit();
        
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
                step_one = client[5];
                checkbox_one = document.createElement("input");
                checkbox_one.setAttribute("type", "checkbox");
                checkbox_one.setAttribute("name", "step_one");
                checkbox_one.setAttribute("id", "step_one");

                td.appendChild(checkbox_one);

            } else if (i === 5) {
                step_two = client[6];
                checkbox_two = document.createElement("input");
                checkbox_two.setAttribute("type", "checkbox");
                checkbox_two.setAttribute("name", "step_two");
                checkbox_two.setAttribute("id", "step_two");
                //checkbox_two.setAttribute("value", false);

                td.appendChild(checkbox_two);

            } else if (i === 6) {
                step_three = client[7];
                checkbox_three = document.createElement("input");
                checkbox_three.setAttribute("type", "checkbox");
                checkbox_three.setAttribute("name", "step_three");
                checkbox_three.setAttribute("id", "step_three");
                //checkbox_three.setAttribute("value", false);

                td.appendChild(checkbox_three);

            } else if (i === 7) {
                step_four = client[8];
                checkbox_four = document.createElement("input");
                checkbox_four.setAttribute("type", "checkbox");
                checkbox_four.setAttribute("name", "step_four");
                checkbox_four.setAttribute("id", "step_four");
                //checkbox_four.setAttribute("value", false);

                td.appendChild(checkbox_four);

            } else if (i === 8) {
                approved = client[9];
                checkbox_approved = document.createElement("input");
                checkbox_approved.setAttribute("type", "checkbox");
                checkbox_approved.setAttribute("name", "approved");
                checkbox_approved.setAttribute("id", "approved");
                //checkbox_approved.setAttribute("value", false);

                td.appendChild(checkbox_approved);

            } else {
                let imgInput = document.createElement("input");
                imgInput.setAttribute("type", "image");
                imgInput.setAttribute("src", "../images/icons/save.svg");
                imgInput.setAttribute("width", "50px");
                imgInput.addEventListener("click", saveConfig);

                td.appendChild(imgInput);

                //input type img can't pass value in form..
                let submitInput = document.createElement("input");
                submitInput.setAttribute("type", "text");
                submitInput.setAttribute("id", "hiddenSubmitButton");
                submitInput.setAttribute("name", "updatedClient");
                submitInput.setAttribute("value", "updatedClient");

                td.appendChild(submitInput);
            }

            tr.appendChild(td);
        }

        table.appendChild(tr);
        
        checkbox_one.checked = false;
        checkbox_two.checked = false;
        checkbox_three.checked = false;
        checkbox_four.checked = false;
        checkbox_approved.checked = false;

        //disable checkboxes when value is "1" (already checked once)
        if(step_one === "1"){
            checkbox_one.checked = true;
            checkbox_one.disabled = true;
        }
        if(step_two === "1"){
            checkbox_two.checked = true;
            checkbox_two.disabled = true;
        }
        if(step_three === "1"){
            checkbox_three.checked = true;
            checkbox_three.disabled = true;
        }
        if(step_four === "1"){
            checkbox_four.checked = true;
            checkbox_four.disabled = true;
        }
        if(approved === "1"){
            checkbox_approved.checked = true;
            checkbox_approved.disabled = true;
        }

        }
    
    }
}
