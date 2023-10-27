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

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Interstellar', 'Christopher Nolan', 'Sci-Fi', 30, 60, 29.99, 17.99, 'BLU0000005', 'DVD0000005');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('The Prestige', 'Christopher Nolan', 'Drama', 25, 45, 29.99, 17.99, 'BLU0000006', 'DVD0000006');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Memento', 'Christopher Nolan', 'Mystery', 18, 38, 29.99, 17.99, 'BLU0000007', 'DVD0000007');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('Dunkirk', 'Christopher Nolan', 'War', 22, 55, 29.99, 17.99, 'BLU0000008', 'DVD0000008');
  
INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('The Departed', 'Martin Scorsese', 'Crime', 20, 48, 29.99, 17.99, 'BLU0000009', 'DVD0000009');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('The Conjuring', 'James Wan', 'Horror', 0, 0, 29.99, 17.99, 'BLU0000010', 'DVD0000010');

INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
VALUES ('A Quiet Place', 'John Krasinski', 'Horror', 0, 0, 29.99, 17.99, 'BLU0000011', 'DVD0000011');



INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Stairway to Heaven', 'Led Zeppelin', 'Rock', 15, 12, 12.99, 29.99, 'CD0000005', 'VI0000005');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Blinding Lights', 'The Weeknd', 'Pop', 30, 25, 12.99, 29.99, 'CD0000006', 'VI0000006');
  
INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Bad Romance', 'Lady Gaga', 'Pop', 22, 18, 12.99, 29.99, 'CD0000007', 'VI0000007');

INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Billie Jean', 'Michael Jackson', 'Pop', 28, 20, 12.99, 29.99, 'CD0000008', 'VI0000008');
  
INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
VALUES ('Hotel California', 'Eagles', 'Rock', 20, 15, 12.99, 29.99, 'CD0000011', 'VI0000011');

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


-- Customer 4
INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000004', 'Bob', 'Miller', 'bob.miller@gmail.com', 'Ontario', 'Toronto', 'Maple St', '456', 'M1B 2C2');

-- Customer 5
INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000005', 'Michaela', 'Johnson', 'michaela.j@gmail.com', 'Ontario', 'Toronto', 'Oak St', '789', 'M1C 3D3');

-- Customer 6
INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000006', 'Emma', 'Davis', 'emma.d@outlook.com', 'Ontario', 'Toronto', 'Elm St', '101', 'M1D 4E4');

-- Customer 7
INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000007', 'Daniel', 'Smith', 'daniel.smith@gmail.com', 'Ontario', 'Toronto', 'Cedar St', '202', 'M1E 5F5');

-- Customer 8
INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
VALUES ('C00000008', 'Olivia', 'Martin', 'olivia.m@outlook.com', 'Ontario', 'Toronto', 'Pine St', '303', 'M1F 6G6');



INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000001', 'C00000001', 'Movie', 'Oppenheimer', 'Credit Card', 2, 59.98, 'BLU0000001', NULL, NULL, NULL);

INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000002', 'C00000002', 'Music', 'Flawless', 'Credit Card', 2, 59.98, NULL, NULL, NULL, 'VI0000001');

INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000003', 'C00000003', 'Movie', 'Barbie', 'Debit', 1, 17.99, NULL, 'DVD0000002', NULL, NULL);

INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000005', 'C00000001', 'Music', 'Blinding Lights', 'Credit Card', 3, 38.97, NULL, NULL, 'CD0000008', NULL);

INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
VALUES ('T00000006', 'C00000001', 'Music', 'Billie Jean', 'Credit Card', 1, 12.99, NULL, NULL, NULL, 'VI0000008');


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

--aidan queries--
CREATE VIEW TransactionDetails AS
SELECT  C.customer_id,
        M.movie_name AS movie_product_name,
        Mu.music_name AS music_product_name,
        T.blu_ray_id, T.dvd_id, T.CD_id, T.vinyl_id,
        T.transaction_id, 
        T.payment_method, T.total_cost, 
        C.cart_id
FROM Transactions T
JOIN Cart C ON T.customer_id = C.customer_id
LEFT JOIN Movies M ON T.blu_ray_id = M.blu_ray_id OR T.dvd_id = M.dvd_id
LEFT JOIN Music Mu ON T.CD_id = Mu.CD_id OR T.vinyl_id = Mu.vinyl_id;

SELECT Movies.movie_name, Movies.director, Movies.genre, Customers.first_name, Customers.last_name
FROM Movies
JOIN Transactions ON Movies.blu_ray_id = Transactions.blu_ray_id OR Movies.dvd_id = Transactions.dvd_id
LEFT JOIN Customers ON Transactions.customer_id = Customers.customer_id;

--jaedon queries--
SELECT Customers.first_name, Customers.last_name, Music.music_name, SUM(Transactions.quantity) AS total_quantity
FROM Transactions
JOIN Customers ON Transactions.customer_id = Customers.customer_id
JOIN Music ON Transactions.item_name = Music.music_name
GROUP BY Customers.first_name, Customers.last_name, Music.music_name;

CREATE VIEW AvailableMoviesView AS
SELECT movie_name, director, genre, blu_ray_stock, dvd_stock
FROM Movies
WHERE blu_ray_stock > 0 OR dvd_stock > 0;

--darien queries--

CREATE VIEW Admin AS
SELECT admin_id, first_name, last_name
FROM Administrator
WHERE position_ = 'manager';

SELECT T.customer_id, T.transaction_id, T.item_name, T.quantity, T.total_cost, C.cart_id, Customers.email
FROM Transactions T
JOIN Customers ON T.customer_id = Customers.customer_id
JOIN Cart C ON T.customer_id = C.customer_id;


--a5 queries

--Query 1: Find which customers bought only movies and no music
SELECT C.customer_id, C.first_name, C.last_name
FROM Customers C
WHERE EXISTS (
   SELECT 1
   FROM Transactions T
   WHERE T.customer_id = C.customer_id AND T.category = 'Movie'
)
MINUS
SELECT C.customer_id, C.first_name, C.last_name
FROM Customers C
WHERE EXISTS (
   SELECT 1
   FROM Transactions T
   WHERE T.customer_id = C.customer_id AND T.category = 'Music'
);


--Query 2: Select movie names and directors, music names and artists who’s movie genre is Horror and Rap

SELECT movie_name AS item_name, director
FROM Movies
WHERE genre = 'Horror'
UNION
SELECT music_name AS item_name, artist
FROM Music
WHERE genre = 'Rap';



--Query 3: Displays the count of customers with “example.com” email addresses grouped by each postal code, where each customer must have an active transaction entry having spent 12.99 or more

SELECT c.postal_code, COUNT(c.customer_id) AS customer_count
FROM Customers c
JOIN Transactions t ON c.customer_id = t.customer_id
WHERE c.email LIKE '%example.com'
GROUP BY c.postal_code
HAVING SUM(t.total_cost) > 12.99
ORDER BY customer_count ASC;

--Query 4: Count the number of customers who has more than 1 transaction and spent a total amount greater than $25

SELECT customer_id, COUNT(*) AS order_count, SUM(total_cost) AS total_amount
FROM Transactions
GROUP BY customer_id
HAVING COUNT(*) > 1 AND SUM(total_cost) > 25;

--Query 5: find customers from Ontario, specifically in Toronto,  but without postal code M1A 1A1

(SELECT first_name, last_name
FROM Customers
WHERE province = 'Ontario'
UNION 
SELECT first_name, last_name
FROM Customers
WHERE city = 'Toronto')
MINUS
(SELECT first_name, last_name
FROM Customers
WHERE postal_code = 'M1A 1A1');


















