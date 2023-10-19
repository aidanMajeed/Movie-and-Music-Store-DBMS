CREATE TABLE Movies (
    movie_name VARCHAR(255),
    director VARCHAR(255),
    genre VARCHAR(255),
    blu_ray_stock INT,
    dvd_stock INT,
    blu_ray_price DECIMAL(6, 2) DEFAULT 29.99,
    dvd_price DECIMAL(6, 2) DEFAULT 17.99,
    blu_ray_id VARCHAR(10),
    dvd_id VARCHAR(10),
    PRIMARY KEY (blu_ray_id, dvd_id)
);


CREATE TABLE Music (
    music_name VARCHAR(255),
    artist VARCHAR(255),
    genre VARCHAR(255),
    CD_stock INT,
    vinyl_stock INT,
    CD_price DECIMAL(6, 2) DEFAULT 12.99,
    vinyl_price DECIMAL(6, 2) DEFAULT 29.99,
    CD_id VARCHAR(10),
    vinyl_id VARCHAR(10),
    PRIMARY KEY(CD_id, vinyl_id)
);


CREATE TABLE Customers (
    customer_id VARCHAR(10) PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    province VARCHAR(255),
    city VARCHAR(255),
    street_name VARCHAR(255),
    street_number VARCHAR(10),
    postal_code VARCHAR(10)
);

CREATE TABLE Transactions (
    transaction_id VARCHAR(10) PRIMARY KEY,
    customer_id VARCHAR(255),
    category VARCHAR(255),
    item_name VARCHAR(255),
    payment_method VARCHAR(255),
    quantity INT CHECK (quantity >= 1),
    total_cost DECIMAL(6, 2),
    blu_ray_id VARCHAR(10),
    dvd_id VARCHAR(10),
    CD_id VARCHAR(10),
    vinyl_id VARCHAR(10),
    FOREIGN KEY (blu_ray_id, dvd_id) REFERENCES Movies(blu_ray_id, dvd_id),
    FOREIGN KEY (CD_id, vinyl_id) REFERENCES Music(CD_id, vinyl_id),
    FOREIGN KEY (customer_id) REFERENCES Customers(customer_id)
);

CREATE TABLE Administrator (
    admin_id VARCHAR(10) PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    position_ VARCHAR(255),
    access_ VARCHAR(255)
);

CREATE TABLE Cart (
    cart_id VARCHAR(10) PRIMARY KEY,
    customer_id VARCHAR(30),
    FOREIGN KEY(customer_id) REFERENCES Customers(customer_id)
);

ALTER TABLE Cart
ADD quantity INT DEFAULT 1


INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Oppenheimer', 'Christopher Nolan', 'Historical', 40, 78, 29.99, 17.99, 'BLU0000001', 'DVD0000001');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Tenet', 'Christopher Nolan', 'Psychological', 12, 78, 29.99, 17.99, 'BLU0000004', 'DVD0000004');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Barbie', 'Greta Gerwig', 'Comedy', 12, 18, 29.99, 17.99, 'BLU0000002', 'DVD0000002');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Psycho', 'Alfred Hitchcock', 'Thriller', 0, 19, 29.99, 17.99, 'BLU0000003', 'DVD0000003');



INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('No Diggity', 'Blackstreet', 'Rap', 12, 1, 12.99, 29.99, 'CD0000002', 'VI0000002');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Your Song', 'Elton John', 'Soft Rock', 9, 27, 12.99, 29.99, 'CD0000003', 'VI0000003');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('IMY2', 'Drake', 'Rap', 99, 7, 12.99, 29.99, 'CD0000004', 'VI0000004');



INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000001', 'John', 'Doe', 'johndoe@example.com', 'Ontario', 'Toronto', 'Main St', '123', 'M1A 1A1');

INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000002', 'Alice', 'Johnson', 'alice@example.com', 'Ontario', 'Toronto', 'Maple Ave', '456', 'M2B 2B2');

INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000003', 'Eva', 'Smith', 'eva@example.com', 'Ontario', 'Toronto', 'Oak St', '789', 'M3C 3C3');



INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000001', 'C00000001', 'Movie', 'Oppenheimer', 'Credit Card', 2, 59.98, 'BLU0000001', NULL, NULL, NULL);

INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000002', 'C00000002', 'Music', 'Flawless', 'Credit Card', 2, 59.98, NULL, NULL, NULL, 'VI0000001');

INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000003', 'C00000003', 'Movie', 'Barbie', 'Debit', 1, 17.99, NULL, 'DVD0000002', NULL, NULL);




INSERT INTO Administrator (admin_id, first_name, last_name, position_, access_)
VALUES ('A00000001', 'Steven', 'Stone', 'manager', 'Movie,Music,Customer,Transaction');

INSERT INTO Administrator (admin_id, first_name, last_name, position_, access_)
VALUES ('A00000002', 'Timmy', 'Turner', 'stocker', 'Movie,Music');

INSERT INTO Administrator (admin_id, first_name, last_name, position_, access_)
VALUES ('A00000003', 'Jim', 'Wall', 'customer service', 'Customer,Transaction');




-- Inserting items into the cart for customer C00000001 (John Doe) - 2 items
INSERT INTO Cart (cart_id, customer_id, quantity)
VALUES ('CART000001', 'C00000001', 2);

-- Inserting items into the cart for customer C00000002 (Alice Johnson) - 2 items
INSERT INTO Cart (cart_id, customer_id, quantity)
VALUES ('CART000002', 'C00000002', 2);

-- Inserting items into the cart for customer C00000003 (Eva Smith) - 1 item
INSERT INTO Cart (cart_id, customer_id, quantity)
VALUES ('CART000003', 'C00000003', 1);


SELECT *
FROM Movies
WHERE Director = 'Christopher Nolan'
ORDER BY movie_name DESC

SELECT DISTINCT admin_id
FROM Administrator
WHERE access_ = 'Movie,Music,Customer,Transaction'

SELECT DISTINCT customer_id
FROM Transactions
WHERE category IN ('Music')
ORDER BY customer_id DESC;


SELECT customer_id, SUM(quantity) AS total_quantity
FROM Cart
GROUP BY customer_id
ORDER BY customer_id ASC;

SELECT *
FROM Transactions
WHERE total_cost >= 50
ORDER BY total_cost

SELECT * 
FROM Music
WHERE genre = 'Rap' AND vinyl_stock > 5
ORDER BY music_name;

SELECT customer_id, province, city, street_name, street_number,postal_code
FROM Customers
ORDER BY postal_code DESC;

SELECT *
FROM Transactions
WHERE payment_method = 'Credit Card';

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Interstellar', 'Christopher Nolan', 'Sci-Fi', 30, 60, 29.99, 17.99, 'BLU0000007', 'DVD0000007');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('The Prestige', 'Christopher Nolan', 'Drama', 25, 45, 29.99, 17.99, 'BLU0000008', 'DVD0000008');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Memento', 'Christopher Nolan', 'Mystery', 18, 38, 29.99, 17.99, 'BLU0000009', 'DVD0000009');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Dunkirk', 'Christopher Nolan', 'War', 22, 55, 29.99, 17.99, 'BLU0000010', 'DVD0000010');
  
INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('The Departed', 'Martin Scorsese', 'Crime', 20, 48, 29.99, 17.99, 'BLU0000011', 'DVD0000011');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Stairway to Heaven', 'Led Zeppelin', 'Rock', 15, 12, 12.99, 29.99, 'CD0000007', 'VI0000007');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Blinding Lights', 'The Weeknd', 'Pop', 30, 25, 12.99, 29.99, 'CD0000008', 'VI0000008');
  
INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Bad Romance', 'Lady Gaga', 'Pop', 22, 18, 12.99, 29.99, 'CD0000009', 'VI0000009');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Billie Jean', 'Michael Jackson', 'Pop', 28, 20, 12.99, 29.99, 'CD0000010', 'VI0000010');
  
INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Hotel California', 'Eagles', 'Rock', 20, 15, 12.99, 29.99, 'CD0000011', 'VI0000011');