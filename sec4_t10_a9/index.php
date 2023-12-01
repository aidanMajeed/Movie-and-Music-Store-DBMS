<!DOCTYPE html>
<!--Aidan Majeed (501084337)
Jaedon Smith (501114117)
Darien Choueiri (500986669)
-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL User Interface A9</title>
    
</head>
<body style="
font-family: 'Comic Sans MS', cursive, sans-serif; background-image: url('https://ihypress.com/textures/books.gif'); background-repeat: repeat;">
<h1> Movie and Music Store Database </h1>
<!-- Drop Tables Form -->
<form method="post">
    <input type="submit" name="drop_tables" value="Drop Tables">
</form> <br>

<!-- Create Tables Form -->
<form method="post">
    <input type="submit" name="create_tables" value="Create Tables">
</form><br>

<!-- Insert Data Form -->
<form method="post">
    <input type="submit" name="insert_data" value="Insert Data">
</form><br>

<!-- Run Queries Form -->
<form method="post">
    <input type="submit" name="run_queries" value="Run Queries">
</form><br>

<!-- Button to go to the update movie page -->
<form action="update_movie.php" method="get">
    <button type="submit">Update Movie Table</button>
</form><br>

<!-- Button to go to the update music page -->
<form action="update_music.php" method="get">
    <button type="submit">Update Music Table</button>
</form><br>

<!-- Button to go to the update Customer page -->
<form action="update_customers.php" method="get">
    <button type="submit">Update Customer Table</button>
</form><br>

<!-- Button to go to the update Customer page -->
<form action="update_transactions.php"get">
    <button type="submit">Update Transaction Table</button>
</form><br>

<!-- Button to go to the update Customer page -->
<form action="update_admin_cart.php"get">
    <button type="submit">Update Admin and Cart Tables</button>
</form><br>

<!-- view tableForm -->
<form method="post">
    <input type="submit" name="view_table" value="View Table">
</form><br>

<!-- Search Table Form -->
<form method="post">
    <h2>Search for Table</h2>
    <label for="table_name">Table Name (Movies, Transactions, Customers, Music, Adminstrator, Cart):</label>
    <input type="text" name="table_name" required>
    <input type="submit" name="search_table" value="Search Table">
</form><br>

<!-- Form for deleting a movie -->
<h2>Delete Movie</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="bluray_id">Enter Blu-ray ID to Delete:</label>
    <input type="text" name="bluray_id" required>
    <button type="submit" name="delete_movie">Delete Movie</button>
</form><br>

<!-- Form for deleting a Music -->
<h2>Delete Music</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="CD_id">Enter CD ID to Delete:</label>
    <input type="text" name="CD_id" required>
    <button type="submit" name="delete_music">Delete Music</button>
</form><br>

<!-- Form for deleting a Transaction -->
<h2>Delete Transaction</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="transaction_id">Enter Transaction ID to Delete:</label>
    <input type="text" name="transaction_id" required>
    <button type="submit" name="delete_transaction">Delete Transaction</button>
</form><br>

<!-- Form for deleting a Cart -->
<h2>Delete Cart</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="cart_id">Enter Cart ID to Delete:</label>
    <input type="text" name="cart_id" required>
    <button type="submit" name="delete_cart">Delete Cart</button>
</form><br>

<!-- Form for deleting a Admin -->
<h2>Delete Admin</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="admin_id">Enter Admin ID to Delete:</label>
    <input type="text" name="admin_id" required>
    <button type="submit" name="delete_admin">Delete Admin</button>
</form><br>

<!-- Form for deleting a Customer -->
<h2>Delete Customer (Make sure they are deleted from Cart and Transaction First!)</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID to Delete:</label>
    <input type="text" name="customer_id" required>
    <button type="submit" name="delete_customer">Delete Customer</button>
</form><br>

</body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Create connection to Oracle
$conn = oci_connect('aomajeed', '02124337', '(DESCRIPTION=(ADDRESS=(PROTOCOL=TCP)(Host=oracle.scs.ryerson.ca)(Port=1521))(CONNECT_DATA=(SID=orcl)))');
if (!$conn) {
    $m = oci_error();
    echo $m['message'];
} 

// Handle button clicks and form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //handle form for create tables
    if (isset($_POST["create_tables"])) {
        createAllTables($conn);
        //handle form for drop tables
    } elseif (isset($_POST["drop_tables"])) {
        dropAllTables($conn);
        //handle form for insert data
    } elseif (isset($_POST["insert_data"])) {
        insertData($conn);
        //handle form to run queries
    } elseif (isset($_POST["run_queries"])) {
        runQueries($conn);
        //handle form to view tables
    } elseif (isset($_POST["view_table"])) {
        viewTables($conn);
        //handle form to search tables
    } elseif (isset($_POST["search_table"])) {

        // Check if the table name is set in the form data
        if (isset($_POST["table_name"])) {
            $tableName = $_POST["table_name"];
            searchTable($conn, $tableName);
        } else {
            echo "Table name not provided for search.";
        }


    //handle forms to delete rows from tables

        // form to delete movie
    } elseif (isset($_POST["delete_movie"])) {
        if (isset($_POST["bluray_id"])) {
            $blurayId = $_POST["bluray_id"];

            //call delete function for table, if invalid call error
            deleteMovie($conn, $blurayId);
        } else {
            echo "Incomplete form data.";
        }
                
        // form to delete music
    } elseif (isset($_POST["delete_music"])) {
        if (isset($_POST["CD_id"])) {
            $cdId = $_POST["CD_id"];

            //call delete function for table, if invalid call error
            deleteMusic($conn, $cdId);
        } else {
            echo "Incomplete form data.";
        }
        // form to delete transaction
    } elseif (isset($_POST["delete_transaction"])) {
        if (isset($_POST["transaction_id"])) {
            $tID = $_POST["transaction_id"];

            //call delete function for table, if invalid call error
            deleteTransaction($conn, $tID);
        } else {
            echo "Incomplete form data.";
        }
        // form to delete cart
    } elseif (isset($_POST["delete_cart"])) {
        if (isset($_POST["cart_id"])) {
            $cartId = $_POST["cart_id"];

            //call delete function for table, if invalid call error
            deleteCart($conn, $cartId);
        } else {
            echo "Incomplete form data.";
        }
    } 
        // form to delete admin
        elseif (isset($_POST["delete_admin"])) {
            if (isset($_POST["admin_id"])) {
                $adminId = $_POST["admin_id"];

                //call delete function for table, if invalid call error
                deleteAdministrator($conn, $adminId);
            } else {
                echo "Incomplete form data.";
            }   
        }   
        // form to delete admin
        elseif (isset($_POST["delete_customer"])) {
            if (isset($_POST["customer_id"])) {
                $customerId = $_POST["customer_id"];

                //call delete function for table, if invalid call error
                deleteCustomer($conn, $customerId);
            } else {
                echo "Incomplete form data.";
            }   
        }     
}


// Function to create all tables
function createAllTables($conn) {
    $queries = [
        "
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
        )",

        "
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
        )",

        "
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
        )",

        "
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

        )",

        "
        CREATE TABLE Administrator (
            admin_id VARCHAR(10) PRIMARY KEY,
            first_name VARCHAR(255),
            last_name VARCHAR(255),
            position_ VARCHAR(255),
            access_ VARCHAR(255)
        )",

        "
        CREATE TABLE Cart (
            cart_id VARCHAR(10) PRIMARY KEY,
            customer_id VARCHAR(30),
            FOREIGN KEY(customer_id) REFERENCES Customers(customer_id),
            quantity INT DEFAULT 1
        )"
    ];

    // Parse the SQL query and execute it
    foreach ($queries as $query) {
        $stid = oci_parse($conn, $query);
        $result = oci_execute($stid);

        //check for errors
        if (!$result) {
            $error = oci_error($stid);
            echo "Error creating tables: " . $error['message'];
            return;
        }
    }

    echo "All tables created successfully";
}


// Function to drop all tables
function dropAllTables($conn) {
    $tablesToDrop = array("Cart", "Administrator", "Transactions", "Customers", "Music", "Movies");

    foreach ($tablesToDrop as $table) {
        // Parse the SQL query and execute it
        $query = "DROP TABLE $table";
        $stid = oci_parse($conn, $query);
        $result = oci_execute($stid);
        //check for errors and return meessage if successful
        if ($result) {
            echo "Table '$table' dropped successfully<br>";
        } else {
            $error = oci_error($stid);
            echo "Error dropping table '$table': " . $error['message'] . "<br>";
        }
    }
}

// Function to insert data
function insertData($conn) {
    $queries = [
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Oppenheimer', 'Christopher Nolan', 'Historical', 40, 78, 29.99, 17.99, 'BLU0000001', 'DVD0000001')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Tenet', 'Christopher Nolan', 'Psychological', 12, 78, 29.99, 17.99, 'BLU0000004', 'DVD0000004')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Barbie', 'Greta Gerwig', 'Comedy', 12, 18, 29.99, 17.99, 'BLU0000002', 'DVD0000002')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Psycho', 'Alfred Hitchcock', 'Thriller', 0, 19, 29.99, 17.99, 'BLU0000003', 'DVD0000003')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Interstellar', 'Christopher Nolan', 'Sci-Fi', 30, 60, 29.99, 17.99, 'BLU0000005', 'DVD0000005')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('The Prestige', 'Christopher Nolan', 'Drama', 25, 45, 29.99, 17.99, 'BLU0000006', 'DVD0000006')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Memento', 'Christopher Nolan', 'Mystery', 18, 38, 29.99, 17.99, 'BLU0000007', 'DVD0000007')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('Dunkirk', 'Christopher Nolan', 'War', 22, 55, 29.99, 17.99, 'BLU0000008', 'DVD0000008')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('The Departed', 'Martin Scorsese', 'Crime', 20, 48, 29.99, 17.99, 'BLU0000009', 'DVD0000009')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('The Conjuring', 'James Wan', 'Horror', 0, 0, 29.99, 17.99, 'BLU0000010', 'DVD0000010')
        ",
        "
        INSERT INTO Movies (movie_name, director, genre, blu_ray_stock, dvd_stock, blu_ray_price, dvd_price, blu_ray_id, dvd_id)
        VALUES ('A Quiet Place', 'John Krasinski', 'Horror', 0, 0, 29.99, 17.99, 'BLU0000011', 'DVD0000011')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('Stairway to Heaven', 'Led Zeppelin', 'Rock', 15, 12, 12.99, 29.99, 'CD0000005', 'VI0000005')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('Blinding Lights', 'The Weeknd', 'Pop', 30, 25, 12.99, 29.99, 'CD0000006', 'VI0000006')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('Bad Romance', 'Lady Gaga', 'Pop', 22, 18, 12.99, 29.99, 'CD0000007', 'VI0000007')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('Billie Jean', 'Michael Jackson', 'Pop', 28, 20, 12.99, 29.99, 'CD0000008', 'VI0000008')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('Hotel California', 'Eagles', 'Rock', 20, 15, 12.99, 29.99, 'CD0000011', 'VI0000011')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('No Diggity', 'Blackstreet', 'Rap', 12, 1, 12.99, 29.99, 'CD0000002', 'VI0000002')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('Your Song', 'Elton John', 'Soft Rock', 9, 27, 12.99, 29.99, 'CD0000003', 'VI0000003')
        ",
        "
        INSERT INTO Music (music_name, artist, genre, CD_stock, vinyl_stock, CD_price, vinyl_price, CD_id, vinyl_id)
        VALUES ('IMY2', 'Drake', 'Rap', 99, 7, 12.99, 29.99, 'CD0000004', 'VI0000004')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000001', 'John', 'Doe', 'johndoe@example.com', 'Ontario', 'Toronto', 'Main St', '123', 'M1A 1A1')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000002', 'Alice', 'Johnson', 'alice@example.com', 'Ontario', 'Toronto', 'Maple Ave', '456', 'M2B 2B2')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000003', 'Eva', 'Smith', 'eva@example.com', 'Ontario', 'Toronto', 'Oak St', '789', 'M3C 3C3')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000004', 'Bob', 'Miller', 'bob.miller@gmail.com', 'Ontario', 'Toronto', 'Maple St', '456', 'M1B 2C2')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000005', 'Michaela', 'Johnson', 'michaela.j@gmail.com', 'Ontario', 'Toronto', 'Oak St', '789', 'M1C 3D3')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000006', 'Emma', 'Davis', 'emma.d@outlook.com', 'Ontario', 'Toronto', 'Elm St', '101', 'M1D 4E4')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000007', 'Daniel', 'Smith', 'daniel.smith@gmail.com', 'Ontario', 'Toronto', 'Cedar St', '202', 'M1E 5F5')
        ",
        "
        INSERT INTO Customers (customer_id, first_name, last_name, email, province, city, street_name, street_number, postal_code)
        VALUES ('C00000008', 'Olivia', 'Martin', 'olivia.m@outlook.com', 'Ontario', 'Toronto', 'Pine St', '303', 'M1F 6G6')
        ",
        "
        INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
        VALUES ('T00000001', 'C00000001', 'Movie', 'Oppenheimer', 'Credit Card', 2, 59.98, 'BLU0000001', NULL, NULL, NULL)
        ",
        "
        INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
        VALUES ('T00000002', 'C00000002', 'Music', 'Flawless', 'Credit Card', 2, 59.98, NULL, NULL, NULL, 'VI0000001')
        ",
        "
        INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
        VALUES ('T00000003', 'C00000003', 'Movie', 'Barbie', 'Debit', 1, 17.99, NULL, 'DVD0000002', NULL, NULL)
        ",
        "
        INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
        VALUES ('T00000005', 'C00000001', 'Music', 'Blinding Lights', 'Credit Card', 3, 38.97, NULL, NULL, 'CD0000008', NULL)
        ",
        "
        INSERT INTO Transactions (transaction_id, customer_id, category, item_name, payment_method, quantity, total_cost, blu_ray_id, dvd_id, CD_id, vinyl_id)
        VALUES ('T00000006', 'C00000001', 'Music', 'Billie Jean', 'Credit Card', 1, 12.99, NULL, NULL, NULL, 'VI0000008')
        ",
        "
        INSERT INTO Administrator (admin_id, first_name, last_name, position_, access_)
        VALUES ('A00000001', 'Steven', 'Stone', 'manager', 'Movie,Music,Customer,Transaction')
        ",
        "
        INSERT INTO Administrator (admin_id, first_name, last_name, position_, access_)
        VALUES ('A00000002', 'Timmy', 'Turner', 'stocker', 'Movie,Music')
        ",
        "
        INSERT INTO Administrator (admin_id, first_name, last_name, position_, access_)
        VALUES ('A00000003', 'Jim', 'Wall', 'customer service', 'Customer,Transaction')
        ",

        "
        INSERT INTO Cart (cart_id, customer_id, quantity)
        VALUES ('CART000001', 'C00000001', 2)
        ",

        "
        INSERT INTO Cart (cart_id, customer_id, quantity)
        VALUES ('CART000002', 'C00000002', 2)
        ",

        "
        INSERT INTO Cart (cart_id, customer_id, quantity)
        VALUES ('CART000003', 'C00000003', 1)
        "
    ];

    // Parse the SQL query and execute it
    foreach ($queries as $query) {
        $stid = oci_parse($conn, $query);
        $result = oci_execute($stid);
        //check for error
        if (!$result) {
            $error = oci_error($stid);
            echo "Error executing query: " . $error['message'];
            return;
        }
    }

    echo "Data inserted successfully";
}

// Function to run SELECT queries
function runQueries($conn) {
    $queries = [
        "SELECT *
        FROM Movies
        WHERE Director = 'Christopher Nolan'
        ORDER BY movie_name DESC",
        
        "SELECT DISTINCT admin_id
        FROM Administrator
        WHERE access_ = 'Movie,Music,Customer,Transaction'",

        "SELECT movie_name AS item_name, director
        FROM Movies
        WHERE genre = 'Horror'
        UNION
        SELECT music_name AS item_name, artist
        FROM Music
        WHERE genre = 'Rap'",

        "SELECT c.postal_code, COUNT(c.customer_id) AS customer_count
        FROM Customers c
        JOIN Transactions t ON c.customer_id = t.customer_id
        WHERE c.email LIKE '%example.com'
        GROUP BY c.postal_code
        HAVING SUM(t.total_cost) > 12.99
        ORDER BY customer_count ASC",

        "SELECT DISTINCT customer_id
        FROM Transactions
        WHERE category IN ('Music')
        ORDER BY customer_id DESC",

        "SELECT customer_id, COUNT(*) AS order_count, SUM(total_cost) AS total_amount
        FROM Transactions
        GROUP BY customer_id
        HAVING COUNT(*) > 1 AND SUM(total_cost) > 25",

        "SELECT *
        FROM Transactions
        WHERE total_cost >= 50
        ORDER BY total_cost"
    ];

    foreach ($queries as $query) {
        $stid = oci_parse($conn, $query);
        $result = oci_execute($stid);

        if (!$result) {
            $error = oci_error($stid);
            echo "Error executing query: " . $error['message'];
            return;
        }

        // Fetch column names
        $numCols = oci_num_fields($stid);
        echo "<table border='1'>";
        
        // Display column names as headers
        echo "<tr>";
        for ($i = 1; $i <= $numCols; $i++) {
            $colName = oci_field_name($stid, $i);
            echo "<th>$colName</th>";
        }
        echo "</tr>";

        // Fetch and display results
        echo "<h3>Results for query: $query</h3>";
        while ($row = oci_fetch_assoc($stid)) {
            echo "<tr>";
            foreach ($row as $col) {
                echo "<td>$col</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
}




// Function to view ALL tables with titles, column names, and data
function viewTables($conn) {
    $queries = [
        "SELECT * FROM Movies ORDER BY blu_ray_id ASC, dvd_id ASC",
        "SELECT * FROM Music ORDER BY CD_id ASC, vinyl_id ASC",
        "SELECT * FROM Customers ORDER BY customer_id ASC",
        "SELECT * FROM Transactions ORDER BY transaction_id ASC",
        "SELECT * FROM Administrator ORDER BY admin_id ASC",
        "SELECT * FROM Cart ORDER BY cart_id ASC"
    ];

    foreach ($queries as $query) {
        $stid = oci_parse($conn, $query);
        $result = oci_execute($stid);

        if (!$result) {
            $error = oci_error($stid);
            echo "Error executing query: " . $error['message'];
            return;
        }

        // Display table title
        echo "<h2>Table</h2>";

        // Fetch column names
        $numCols = oci_num_fields($stid);
        echo "<table border='1'>";
        
        // Display column names as headers
        echo "<tr>";
        for ($i = 1; $i <= $numCols; $i++) {
            $colName = oci_field_name($stid, $i);
            echo "<th>$colName</th>";
        }
        echo "</tr>";

        // Fetch and display results
        while ($row = oci_fetch_assoc($stid)) {
            echo "<tr>";
            foreach ($row as $col) {
                echo "<td>$col</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
}


// Function to search for a specific table
function searchTable($conn, $tableName) {
    // Construct and execute the query
    $query = "SELECT * FROM $tableName";
    $stid = oci_parse($conn, $query);
    $result = oci_execute($stid);

    // Display the results or an error message
    if (!$result) {
        $error = oci_error($stid);
        echo "Error executing query for table $tableName: " . $error['message'];
    } else {
        // Display table title
        echo "<h2>$tableName</h2>";

        // Fetch column names
        $numCols = oci_num_fields($stid);
        echo "<table border='1'>";

        // Display column names as headers
        echo "<tr>";
        for ($i = 1; $i <= $numCols; $i++) {
            $colName = oci_field_name($stid, $i);
            echo "<th>$colName</th>";
        }
        echo "</tr>";

        // Fetch and display results
        while ($row = oci_fetch_assoc($stid)) {
            echo "<tr>";
            foreach ($row as $col) {
                echo "<td>$col</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
    }
}

// Function to delete a movie from the movie table
function deleteMovie($conn, $blurayId) {
    // Construct the DELETE query
    $query = "DELETE FROM Movies WHERE blu_ray_id = :bluray_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':bluray_id', $blurayId);

    // Execute the query
    executeDeleteQueryMovie($stid, "Movie", $blurayId);
}

// Function to execute the delete query and display result
function executeDeleteQueryMovie($stid, $entity, $blurayId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error deleting $entity: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$entity deleted successfully. $rowsAffected row(s) affected. Movie ID: $blurayId<br>";
    } else {
        echo "No $entity found for deletion. Movie ID: $blurayId<br>";
    }
}


// Function to delete a movie from the movie table
function deleteMusic($conn, $cdId) {
    // Construct the DELETE query
    $query = "DELETE FROM Music WHERE CD_id = :CD_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':CD_id', $cdId);

    // Execute the query
    executeDeleteQueryMusic($stid, "Music", $cdId);
}

// Function to execute the delete query and display result
function executeDeleteQueryMusic($stid, $entity, $cdId) {
    $result1 = oci_execute($stid);

    if (!$result1) {
        $error = oci_error($stid);
        echo "Error deleting $entity: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$entity deleted successfully. $rowsAffected row(s) affected. Music ID: $cdId<br>";
    } else {
        echo "No $entity found for deletion. Music ID: $cdId<br>";
    }
}

// Function to delete a transaction from the transaction table
function deleteTransaction($conn, $tID) {
    // Construct the DELETE query
    $query = "DELETE FROM Transactions WHERE transaction_id = :transaction_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':transaction_id', $tID);

    // Execute the query
    executeDeleteQueryTransaction($stid, "Transaction", $tID);
}

// Function to execute the delete query and display result
function executeDeleteQueryTransaction($stid, $entity, $tID) {
    $result2 = oci_execute($stid);

    if (!$result2) {
        $error = oci_error($stid);
        echo "Error deleting $entity: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$entity deleted successfully. $rowsAffected row(s) affected. Transaction ID: $tID<br>";
    } else {
        echo "No $entity found for deletion. Transaction ID: $tID<br>";
    }
}

// Function to delete a cart from the cart table
function deleteCart($conn, $cartId) {
    // Construct the DELETE query
    $query = "DELETE FROM Cart WHERE cart_id = :cart_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':cart_id', $cartId);

    // Execute the query
    executeDeleteQueryCart($stid, "Cart", $cartId);
}

// Function to execute the delete query and display result
function executeDeleteQueryCart($stid, $entity, $cartId) {
    $result3 = oci_execute($stid);

    if (!$result3) {
        $error = oci_error($stid);
        echo "Error deleting $entity: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$entity deleted successfully. $rowsAffected row(s) affected. Cart ID: $cartId<br>";
    } else {
        echo "No $entity found for deletion. Cart ID: $cartId<br>";
    }
}

// Function to delete an administrator from the Administrator table
function deleteAdministrator($conn, $adminId) {
    // Construct the DELETE query
    $query = "DELETE FROM Administrator WHERE admin_id = :admin_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':admin_id', $adminId);

    // Execute the query
    executeDeleteQueryAdministrator($stid, "Administrator", $adminId);
}

// Function to execute the delete query and display result for Administrator table
function executeDeleteQueryAdministrator($stid, $entity, $adminId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error deleting $entity: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$entity deleted successfully. $rowsAffected row(s) affected. Admin ID: $adminId<br>";
    } else {
        echo "No $entity found for deletion. Admin ID: $adminId<br>";
    }
}

// Function to delete a customer from the Customers table
function deleteCustomer($conn, $customerId) {
    // Construct the DELETE query
    $query = "DELETE FROM Customers WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeDeleteQueryCustomer($stid, "Customer", $customerId);
}

// Function to execute the delete query and display result
function executeDeleteQueryCustomer($stid, $entity, $customerId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error deleting $entity: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$entity deleted successfully. $rowsAffected row(s) affected. Customer ID: $customerId<br>";
    } else {
        echo "No $entity found for deletion. Customer ID: $customerId<br>";
    }
}





// Close the Oracle connection
oci_close($conn);
?>