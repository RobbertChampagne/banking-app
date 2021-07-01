window.addEventListener("load", loaded);

function loaded() {
    //CREATE BORDER AROUND CHOOSEN BUTTON
    let car = document.getElementById("car");
    let house = document.getElementById("house");
    let money = document.getElementById("money");

    let buttons = [car, house, money];

    for(let button of buttons){
        button.addEventListener("click", selectLoanType);
    }


    function selectLoanType(event){
        
        for(let button of buttons){
            button.style = "border: 0px solid black";
        }

        choosenLoanType = event.target.id;
        event.target.style = "border: 2px solid black";

        //set value intput --> PHP
        document.getElementById("loanTypeValue").setAttribute("value", choosenLoanType);

    }

}