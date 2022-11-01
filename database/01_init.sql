CREATE TABLE Movies
(
    id           int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name         varchar(64) NOT NULL,
    trailer      longtext    NOT NULL,
    description  longtext    NOT NULL,
    release_date date        NOT NULL,
    rating       int(11)     NOT NULL,
    duration     int(11)     NOT NULL
);

CREATE TABLE Genres
(
    id          int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name        varchar(64) NOT NULL,
    description longtext    NOT NULL
);

CREATE TABLE MovieGenre
(
    movie_id int(11) NOT NULL,
    genre_id int(11) NOT NULL,
    PRIMARY KEY (movie_id, genre_id),
    FOREIGN KEY (movie_id) REFERENCES Movies (id),
    FOREIGN KEY (genre_id) REFERENCES Genres (id)
);

CREATE TABLE Theatres
(
    id      int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name    varchar(64) NOT NULL,
    address varchar(64) NOT NULL
);

CREATE TABLE Shows
(
    id         int(11)  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    movie_id   int(11)  NOT NULL,
    theatre_id int(11)  NOT NULL,
    show_time  datetime NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES Movies (id),
    FOREIGN KEY (theatre_id) REFERENCES Theatres (id)
);

CREATE TABLE Seats
(
    id      int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
    show_id int(11)     NOT NULL,
    seat_no varchar(64) NOT NULL,
    status  varchar(64) NOT NULL,
    FOREIGN KEY (show_id) REFERENCES Shows (id)
);

CREATE TABLE Users
(
    id       int(11)     NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name     varchar(64) NOT NULL,
    email    varchar(64) NOT NULL,
    password varchar(64) NOT NULL
);

CREATE TABLE TicketType
(
    id   int(11)        NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name varchar(64)    NOT NULL,
    cost decimal(10, 2) NOT NULL
);

CREATE TABLE Booking
(
    id        int(11)        NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_id   int(11)        NOT NULL,
    seat_id   int(11)        NOT NULL,
    timestamp datetime       NOT NULL,
    cost      decimal(10, 2) NOT NULL,
    ticket_type int(11)      NOT NULL,
    FOREIGN KEY (user_id) REFERENCES Users (id),
    FOREIGN KEY (ticket_type) REFERENCES TicketType (id),
    FOREIGN KEY (seat_id) REFERENCES Seats (id)
);

CREATE TABLE Images
(
    id       int(11)  NOT NULL PRIMARY KEY AUTO_INCREMENT,
    poster   longtext NOT NULL,
    image1   longtext NOT NULL,
    image2   longtext NOT NULL,
    movie_id int(11)  NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES Movies (id)
);

ALTER TABLE Seats
    ADD UNIQUE unique_index (show_id, seat_no);

delimiter //
CREATE TRIGGER Booking_AFTER_INSERT
    AFTER INSERT
    ON Booking
    FOR EACH ROW
BEGIN
    UPDATE Seats SET status = 'TAKEN' WHERE id = NEW.seat_id;
END;
//

delimiter ;

delimiter //
CREATE TRIGGER Seats_AFTER_INSERT
    AFTER INSERT
    ON Shows
    FOR EACH ROW
BEGIN
    DECLARE x INT;
    SET x = 1;
    WHILE x < 65
        DO
            INSERT INTO Seats (show_id, seat_no, status) VALUES (NEW.id, x, 'EMPTY');
            SET x = x + 1;
        END WHILE;
END;
//

delimiter ;
