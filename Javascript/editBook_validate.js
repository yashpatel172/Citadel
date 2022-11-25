//------------------------------Title------------------------------
function validateTitle(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var title_textbox = elements.value;

    //----------------Call the tester----------------
    checkTitle(title_textbox);
}
function checkTitle(title_textbox) {
    var isValid = true;

    //----------------Labels----------------
    var title_label = document.getElementById("label_title");

    //----------------Empty the label text----------------
    title_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_title = /^[^"$%'()*+,./;<=>?@^_'{|}~]+$/;

    //----------------Username Checker----------------
    if (title_textbox == null || title_textbox == "") {
        textNode = document.createTextNode("Enter a title");
        title_label.style.color = "tomato";
        title_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_title.test(title_textbox) == false) {
        textNode = document.createTextNode("Sorry, can't allow $%'()*+,./;<=>?@^_'{|}~ characters.");
        title_label.style.color = "tomato";
        title_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_title.test(title_textbox) == true) {
        textNode = document.createTextNode("Valid format!");
        title_label.style.color = "mediumseagreen";
        title_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Publish Date------------------------------
function validatePublishDate(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var pd_textbox = elements.value;

    //----------------Call the tester----------------
    checkPublishDate(pd_textbox);
}
function checkPublishDate(pd_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var pd_label = document.getElementById("label_pd");

    //----------------Empty the label text----------------
    pd_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_pd = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))$/;

    //----------------DOB Checker----------------
    if (pd_textbox == null || pd_textbox == "") {
        textNode = document.createTextNode("Enter publish date.");
        pd_label.style.color = "tomato";
        pd_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_pd.test(pd_textbox) == false) {
        textNode = document.createTextNode("Invalid publish date.");
        pd_label.style.color = "tomato";
        pd_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_pd.test(pd_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        pd_label.style.color = "mediumseagreen";
        pd_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Page Count------------------------------
function validatePageCount(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var pc_textbox = elements.value;

    //----------------Call the tester----------------
    checkPageCount(pc_textbox);
}
function checkPageCount(pc_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var pc_label = document.getElementById("label_pc");

    //----------------Empty the label text----------------
    pc_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_pc = /^[1-9][0-9]{0,50000}$/;

    //----------------DOB Checker----------------
    if (pc_textbox == null || pc_textbox == "") {
        textNode = document.createTextNode("Enter page count.");
        pc_label.style.color = "tomato";
        pc_label.appendChild(textNode);
        isValid = false;
    }
    else if (pc_textbox == "0") {
        textNode = document.createTextNode("A book can't be of 0 page.");
        pc_label.style.color = "tomato";
        pc_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_pc.test(pc_textbox) == false) {
        textNode = document.createTextNode("Sorry, can't start with 0 and only digits are allowed.");
        pc_label.style.color = "tomato";
        pc_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_pc.test(pc_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        pc_label.style.color = "mediumseagreen";
        pc_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------ISBN------------------------------
function validateISBN(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var isbn_textbox = elements.value;

    //----------------Call the tester----------------
    checkISBN(isbn_textbox);
}
function checkISBN(isbn_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var isbn_label = document.getElementById("label_isbn");

    //----------------Empty the label text----------------
    isbn_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;
    var regex_isbn = /^!*(\d){13,13}$/;

    var characters = document.getElementById("isbn_field").value.length;  

    //----------------DOB Checker----------------
    if (isbn_textbox == null || isbn_textbox == "") {
        textNode = document.createTextNode("Enter a ISBN.");
        isbn_label.style.color = "tomato";
        isbn_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_isbn.test(isbn_textbox) == false) {
        textNode = document.createTextNode("Need " + (13 - characters) + " more digits.");
        isbn_label.style.color = "tomato";
        isbn_label.appendChild(textNode);
        isValid = false;
    }
    else if (regex_isbn.test(isbn_textbox) == true) {
        textNode = document.createTextNode("Valid Format!");
        isbn_label.style.color = "mediumseagreen";
        isbn_label.appendChild(textNode);
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------Book Summary------------------------------
function validateBookSummary(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var bs_textbox = elements.value;

    //----------------Call the tester----------------
    checkBookSummary(bs_textbox);
}
function checkBookSummary(bs_textbox) {
    //----------------Extra Variables----------------
    var isValid = true;

    //----------------Labels----------------
    var bs_label = document.getElementById("label_bs");

    //----------------Empty the label text----------------
    bs_label.innerHTML = "";

    //----------------Formats----------------
    var textNode;

    var characters = document.getElementById("bs_field").value.length; 

    //----------------DOB Checker----------------
    if (bs_textbox == null || bs_textbox == "") {
        textNode = document.createTextNode("Enter Book Summary.");
        bs_label.style.color = "tomato";
        bs_label.appendChild(textNode);
        isValid = false;
    }
    else if (bs_textbox != "" && characters < 500){
        textNode = document.createTextNode("Can enter " + (500 - characters) + " more characters.");
        bs_label.style.color = "mediumseagreen";
        bs_label.appendChild(textNode);
        isValid = true; 
    }
    else if (characters == 500) {
        textNode = document.createTextNode("MAX characters limit reached.");
        bs_label.style.color = "tomato";
        bs_label.appendChild(textNode);
        isValid = true;
    }

    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------editBook_Button------------------------------
function validateEditBook(event) {
    //----------------Extra Variables----------------
    var valid1, valid2, valid3, valid4, valid5;

    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var title_textbox = elements[0].value;
    var pd_textbox = elements[1].value;
    var pc_textbox = elements[2].value;
    var isbn_textbox = elements[3].value;
    var bs_textbox = elements[6].value;

    //----------------Access----------------
    if (checkTitle(title_textbox)) {
        valid1 = checkTitle(title_textbox);
    }
    if (checkPublishDate(pd_textbox)) {
        valid2 = checkPublishDate(pd_textbox);
    }
    if (checkPageCount(pc_textbox)) {
        valid3 = checkPageCount(pc_textbox);
    }
    if (checkISBN(isbn_textbox)) {
        valid4 = checkISBN(isbn_textbox);
    }
    if (checkBookSummary(bs_textbox)) {
        valid5 = checkBookSummary(bs_textbox);
    }

    if (!valid1 || !valid2 || !valid3 || !valid4 || !valid5) {
        console.log("EditBook Form is invalid");
        event.preventDefault();
    }
}