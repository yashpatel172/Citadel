document.getElementById("title_field").addEventListener("keyup", validateTitle, false);
document.getElementById("pd_field").addEventListener("keyup", validatePublishDate, false);
document.getElementById("pc_field").addEventListener("keyup", validatePageCount, false);
document.getElementById("isbn_field").addEventListener("keyup", validateISBN, false);
document.getElementById("bs_field").addEventListener("keyup", validateBookSummary, false);

document.getElementById("editBook_form").addEventListener("submit", validateEditBook, false);