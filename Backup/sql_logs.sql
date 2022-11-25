MYSQL Username: ynp062
MYSQL Password: yash123

Database name : ynp062

CREATE TABLE Citadel_Users(
    uid INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,

    PRIMARY KEY (uid)
);

CREATE TABLE Citadel_Books(
    bid INT NOT NULL AUTO_INCREMENT,
    uid INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    publishDate DATE NOT NULL,
    pageCount INT NOT NULL,
    isbn BIGINT NOT NULL,
    bookSummary VARCHAR(501) NOT NULL,
    bookCover VARCHAR(255),

    PRIMARY KEY (bid),
    FOREIGN KEY (uid) REFERENCES Citadel_Users (uid)
);

INSERT INTO Citadel_Users (username, email, password, profilePhoto)
VALUES ("Yash", "yash@gmail.com", "Yash@123", "ProfilePhoto_Uploads/yp.jpg");
INSERT INTO Citadel_Users (username, email, password, profilePhoto)
VALUES ("Jaydeep", "jaydeep@gmail.com", "Jaydeep@123", "ProfilePhoto_Uploads/jp.jpg");
INSERT INTO Citadel_Users (username, email, password, profilePhoto)
VALUES ("Luffy", "luffy@gmail.com", "Luffy@123", "ProfilePhoto_Uploads/lp.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (1, "Hello World #1", "2008-01-01", 101, 1234567890001, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/a1.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (1, "Game of Words", "2010-02-20", 300, 1234567890002, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/a2.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (1, "Worlds at Seas", "2011-09-10", 500, 1234567890003, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/a3.jpg");


INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (2, "Love at First", "2011-09-01", 150, 1234567890004, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/b1.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (2, "Fire over House", "2010-08-10", 325, 1234567890005, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/b2.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (2, "Thief of Dark", "2012-06-10", 400, 1234567890006, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/b3.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (3, "Hello There #1", "2011-05-20", 200, 1234567890007, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/c1.jpg");

INSERT INTO Citadel_Books (uid, title, publishDate, pageCount, isbn, bookSummary, bookCover)
VALUES (3, "Hello There #2", "2012-05-20", 250, 1234567890008, "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.", "BookCover_Uploads/c2.jpg");

CREATE TABLE Citadel_Admins(
    aid INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,

    PRIMARY KEY (aid)
);

INSERT INTO Citadel_Admins (username, email, password)
VALUES ("Admin", "admin@gmail.com", "Admin@123");