document.getElementById("username_field").addEventListener("keyup", validateUsername, false);
document.getElementById("email_field").addEventListener("keyup", validateEmail, false);
document.getElementById("password_field").addEventListener("keyup", validatePassword, false);
document.getElementById("confirmpassword_field").addEventListener("keyup", validateConfirmPassword, false);

document.getElementById("signup_form").addEventListener("submit", validateSignUp, false);