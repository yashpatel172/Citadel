document.getElementById("visibilityButton1").addEventListener("click", togglePassword1, false);
document.getElementById("visibilityButton2").addEventListener("click", togglePassword2, false);

// Visibility for regular password
function togglePassword1(){
    var password_textbox =  document.getElementById("password_field");
    var password_icon1 =  document.getElementById("pass_icon1");

    if (password_textbox.type === "password") {
        password_textbox.type = "text";
        password_icon1.innerText = "visibility_off";
    }
    else {
        password_textbox.type = "password";
        password_icon1.innerText = "visibility";
    }
}

// Visibility for confirm password
function togglePassword2(){
    var confirmpassword_textbox =  document.getElementById("confirmpassword_field");
    var password_icon2 =  document.getElementById("pass_icon2");

    if (confirmpassword_textbox.type === "password") {
        confirmpassword_textbox.type = "text";
        password_icon2.innerText = "visibility_off";
    }
    else {
        confirmpassword_textbox.type = "password";
        password_icon2.innerText = "visibility";
    }
}