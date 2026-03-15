let fName = document.getElementById("fName");
let lName = document.getElementById("lName");
let email = document.getElementById("email");
let phone = document.getElementById("phone");
let message = document.getElementById("message");

let error = document.querySelectorAll(".error");

function validateFirstName(){

    if(fName.value === ""){
        error[0].innerHTML = "First Name need to be filled up";
        return false;
    }

    error[0].innerHTML = "";
    return true;
}

function validateLastName(){

    if(lName.value === ""){
        error[1].innerHTML = "Last Name need to be filled up";
        return false;
    }

    error[1].innerHTML = "";
    return true;
}

function validateEmail(){

    if(email.value === ""){
        error[2].innerHTML = "Email need to be filled up";
        return false;
    }

    error[2].innerHTML = "";
    return true;
}

function validatePhone(){

    if(phone.value === ""){
        error[3].innerHTML = "Phone Number need to be filled up";
        return false;
    }

    error[3].innerHTML = "";
    return true;
}

function validateMessage(){

    if(message.value === ""){
        error[4].innerHTML = "Field Value need to be filled up";
        return false;
    }

    error[4].innerHTML = "";
    return true;
}

function collectData(event){

    event.preventDefault();

    let isValidFname = validateFirstName();
    let isValidLname = validateLastName();
    let isValidEmail = validateEmail();
    let isValidPhone = validatePhone();
    let isValidMessage = validateMessage();

    if(isValidFname && isValidLname && isValidEmail && isValidPhone && isValidMessage){

        console.log("First Name:", fName.value);
        console.log("Last Name:", lName.value);
        console.log("Email:", email.value);
        console.log("Phone:", phone.value);
        console.log("Message:", message.value);

        alert("Submitted Successfully");

        fName.value = "";
        lName.value = "";
        email.value = "";
        phone.value = "";
        message.value = "";
    }
}