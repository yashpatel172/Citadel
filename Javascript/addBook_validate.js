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

//------------------------------Cover------------------------------
function validateBookCover(event) {
    //----------------Textboxes----------------
    var elements = event.currentTarget;
    var cover_box = elements.value;

    //----------------Call the tester----------------
    checkBookCover(cover_box);
}
function checkBookCover(cover_box) {

    //----------------Extra Variables----------------
    var isValid = true;
    var file_size, final_file_size;

    if(cover_box != "")
    {
        file_size = document.getElementById("cover_field").files[0].size;
        final_file_size = (file_size / 1024);
    }

    //----------------Labels----------------
    var cover_label = document.getElementById("label_cover");

    //----------------Empty the label text----------------
    cover_label.innerHTML = "";

    //----------------Cover Checker----------------
    if (cover_box == "" || cover_box == null) {
        textNode = document.createTextNode("Upload a Book Cover.");
        cover_label.style.color = "tomato";
        cover_label.appendChild(textNode);
        console.log("inside NULL");
        isValid = false;
    }
    else if (final_file_size > 300 || final_file_size == 0) {
        textNode = document.createTextNode("File size is greater than 300.");
        cover_label.style.color = "tomato";
        cover_label.appendChild(textNode);
        isValid = false;
    }
    else if (cover_box != "" && cover_box != null && final_file_size <= 300) {
        cover_label.innerHTML = '<ion-icon name="checkmark-circle"></ion-icon>';
        textNode = document.createTextNode("Successfully uploaded!");
        cover_label.style.color = "mediumseagreen";
        cover_label.appendChild(textNode);
    }
    //----------------Return the correctness----------------
    return isValid;
}

//------------------------------addBook_Button------------------------------
function validateAddBook(event) {
    //----------------Extra Variables----------------
    var valid1, valid2, valid3, valid4, valid5, valid6;

    var title_textbox = document.getElementById("title_field").value;
    var pd_textbox = document.getElementById("pd_field").value;
    var pc_textbox = document.getElementById("pc_field").value;
    var isbn_textbox = document.getElementById("isbn_field").value;
    var bs_textbox = document.getElementById("bs_field").value;
    var cover_textbox = document.getElementById("cover_field").value;

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

    valid6 = checkBookCover(cover_textbox);


    if (!valid1 || !valid2 || !valid3 || !valid4 || !valid5 || !valid6) {
        console.log("AddBook Form is invalid");
        event.preventDefault();
    }
}