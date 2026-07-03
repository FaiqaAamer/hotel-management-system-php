DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    userID INT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    phoneNo VARCHAR(11),
    password VARCHAR(15) NOT NULL,
    role ENUM('admin','customer') NOT NULL
);

CREATE TABLE rooms (
    roomID INT PRIMARY KEY,
    roomNo INT NOT NULL,
    roomType ENUM('single','double','deluxe','suite'),
    status ENUM('booked','available'),
    pricePerNight INT
);

CREATE TABLE reservations (
    reservationID INT PRIMARY KEY,
    userID INT,
    roomID INT,
    checkInDate DATE NOT NULL,
    checkOutDate DATE,
    bookingDate DATE,
    reservationStatus ENUM('confirmed','cancelled','completed'),

    FOREIGN KEY (userID)
        REFERENCES users(userID),

    FOREIGN KEY (roomID)
        REFERENCES rooms(roomID)
);


ALTER TABLE users
ADD UNIQUE (email);

ALTER TABLE reservations
MODIFY reservationID INT NOT NULL AUTO_INCREMENT;


INSERT INTO users VALUES
(111,'Alina','alinaalina515@example.com','03000000000','xgs%nDbia','admin'),
(112,'Feroza','ferozaxyz515@example.com','03000000001','kwfu98^#%g','admin'),
(113,'Alice','aliceinthisland515@example.com','03000000002','fbiwu$#67','customer'),
(114,'Ranchard','theranchard515@example.com','03000000003','nchwcnc637','customer'),
(115,'Milli','millichilli515@example.com','03000000004','Bahsf6','customer'),
(116,'Areez','areezalex515@example.com','03000000005','735vevvi72','customer');

INSERT INTO rooms VALUES
(222,50,'deluxe','available',20000),
(223,51,'single','available',8000),
(224,52,'single','booked',8000),
(225,53,'double','available',15000),
(226,54,'double','available',15000),
(227,55,'suite','available',30000);

INSERT INTO reservations VALUES
(333,112,224,'2026-06-01','2026-06-03','2026-05-25','completed'),
(334,115,224,'2026-06-21','2026-07-03','2026-06-05','confirmed'),
(335,114,222,'2026-07-01','2026-07-03','2026-06-07','cancelled');

CREATE VIEW available_rooms AS
SELECT
    roomID,
    roomNo,
    roomType,
    pricePerNight
FROM rooms
WHERE status = 'available';

CREATE VIEW reservation_details AS
SELECT
    r.reservationID,
    u.name,
    rm.roomNo,
    rm.roomType,
    r.checkInDate,
    r.checkOutDate,
    r.bookingDate,
    r.reservationStatus
FROM reservations r
JOIN users u ON r.userID = u.userID
JOIN rooms rm ON r.roomID = rm.roomID;