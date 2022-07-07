//------------------------------Username------------------------------
function validateUsername(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var username_textbox = elements.value;

    //----------------Call the tester----------------
    checkUsername(username_textbox);
}
function checkUsername(username_textbox) {
    var isValid = true;

    //----------------Labels----------------
    var username_label = document.getElementById("label_username");

    //----------------Empty the label text----------------
    username_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_username = /^[^\s!@£$%^&*()+=]+$/;

    //----------------Username Checker----------------
    if (username_textbox == null || username_textbox == "") {
        textNode = document.createTextNode("Enter a username");
        username_label.style.color = "tomato";
        username_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_username.test(username_textbox) == false) {
        textNode = document.createTextNode("Sorry, only letters (a-z, A-Z), numbers (0-9) are allowed.");
        username_label.style.color = "tomato";
        username_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_username.test(username_textbox) == true) {
        textNode = document.createTextNode("Valid format!");
        username_label.style.color = "mediumseagreen";
        username_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Email------------------------------
function validateEmail(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var email_textbox = elements.value;

    //----------------Call the tester----------------
    checkEmail(email_textbox);
}
function checkEmail(email_textbox) {
    var isValid = true;

    //----------------Labels----------------
    var email_label = document.getElementById("label_email");

    //----------------Empty the label text----------------
    email_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_email = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,3}$/;

    //----------------Email Checker----------------
    if (email_textbox == null || email_textbox == "") {
        textNode = document.createTextNode("Enter a email address");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_email.test(email_textbox) == false) {
        textNode = document.createTextNode("Sorry, spaces and some special characters are not allowed.");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (email_textbox.length > 200) {
        textNode = document.createTextNode("Sorry, your email length exceeds 200 characters.");
        email_label.style.color = "tomato";
        email_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_email.test(email_textbox) == true) {
        textNode = document.createTextNode("Valid format!");
        email_label.style.color = "mediumseagreen";
        email_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Password------------------------------
function validatePassword(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var password_textbox = elements.value;

    //----------------Call the tester----------------
    checkPassword(password_textbox);
}
function checkPassword(password_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var password_label = document.getElementById("label_password");

    //----------------Empty the label text----------------
    password_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_password = /^(?=.*[^A-Za-z])(?=.*[*.!@$%^&)(}{:;<>,.?/~_+=|])(?=.*[0-9])(?=.*[A-Z])[A-Za-z\S]{6,}$/;

    //----------------Password Checker----------------
    if (password_textbox == null || password_textbox == "") {
        textNode = document.createTextNode("Enter a password");
        password_label.style.color = "tomato";
        password_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(password_textbox) == false) {
        textNode = document.createTextNode("Sorry, min 6 characters, atleast one (a-z, A-Z, 0-9, special) allowed.");
        password_label.style.color = "tomato";
        password_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(password_textbox) == true) {
        textNode = document.createTextNode("Valid format!");
        password_label.style.color = "mediumseagreen";
        password_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Confirm_Password------------------------------
function validateConfirmPassword(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var confirmpassword_textbox = elements.value;
    var temp_password_textbox = document.getElementById("password_field").value;

    //----------------Call the tester----------------
    checkConfirmPassword(confirmpassword_textbox, temp_password_textbox);
}
function checkConfirmPassword(confirmpassword_textbox, temp_password_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var confirmpassword_label = document.getElementById("label_confirmpassword");

    //----------------Empty the label text----------------
    confirmpassword_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_password = /^(?=.*[^A-Za-z])(?=.*[*.!@$%^&)(}{:;<>,.?/~_+=|])(?=.*[0-9])(?=.*[A-Z])[A-Za-z\S]{6,}$/;

    //----------------Confirm Password Checker----------------
    if (confirmpassword_textbox == null || confirmpassword_textbox == "") {
        textNode = document.createTextNode("Enter confirm password");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == false) {
        textNode = document.createTextNode("Sorry, min 6 characters, atleast one (a-z, A-Z, 0-9, special) allowed.");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == true && confirmpassword_textbox != temp_password_textbox) {
        textNode = document.createTextNode("Valid format but doesnt match the Password!");
        confirmpassword_label.style.color = "tomato";
        confirmpassword_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_password.test(confirmpassword_textbox) == true && confirmpassword_textbox == temp_password_textbox) {
        textNode = document.createTextNode("Valid format & matches the Password!");
        confirmpassword_label.style.color = "mediumseagreen";
        confirmpassword_label.appendChild(textNode);
    }
    
    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Signup_Button------------------------------
function validateSignUp(event) {
    //----------------Extra Variables----------------
    var valid1, valid2, valid3, valid4;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var username_textbox = elements[0].value;
    var email_textbox = elements[1].value;
    var password_textbox = elements[2].value;
    var confirmpassword_textbox = elements[3].value;

    //----------------Access----------------
    if (checkUsername(username_textbox)) {
        valid1 = checkUsername(username_textbox);
    }
    if (checkEmail(email_textbox)) {
        valid2 = checkEmail(email_textbox);
    }
    if (checkPassword(password_textbox)) {
        valid3 = checkPassword(password_textbox);
    }
    if (checkConfirmPassword(confirmpassword_textbox, password_textbox)) {
        valid4 = checkConfirmPassword(confirmpassword_textbox, password_textbox);
    }

    if (!valid1 || !valid2 || !valid3 || !valid4) {
        console.log("SignUp Form is invalid");
        event.preventDefault();
    }
}