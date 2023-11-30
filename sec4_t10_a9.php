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

<!-- Update Table Form -->
<form method="post">
    <input type="submit" name="update_table" value="Update Table">
</form><br>

<!-- Update Table Form -->
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

<!-- Search Table to delete Form -->
<form method="post">
    <h2>Delete Row from Table</h2>
    <label for="delete_table_name">Table Name:</label>
    <input type="text" name="delete_table_name" required><br>
    
    <label for="row_number">Row Number:</label>
    <input type="number" name="row_number" required><br>

    <input type="submit" name="delete_row" value="Delete Row">
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
    if (isset($_POST["create_tables"])) {
        createAllTables($conn);
    } elseif (isset($_POST["drop_tables"])) {
        dropAllTables($conn);
    } elseif (isset($_POST["insert_data"])) {
        insertData($conn);
    } elseif (isset($_POST["run_queries"])) {
        runQueries($conn);
    } elseif (isset($_POST["update_table"])) {
        updateTable($conn);
    } elseif (isset($_POST["view_table"])) {
        viewTables($conn);
    } elseif (isset($_POST["search_table"])) {
        // Check if the table name is set in the form data
        if (isset($_POST["table_name"])) {
            $tableName = $_POST["table_name"];
            searchTable($conn, $tableName);
        } else {
            echo "Table name not provided for search.";
        }
    } elseif (isset($_POST["delete_row"])) {
        // Check if the table name and row number are set in the form data
        if (isset($_POST["delete_table_name"]) && isset($_POST["row_number"])) {
            $tableNameDelete = $_POST["delete_table_name"];
            $rowNumberDelete = $_POST["row_number"];
            deleteRow($conn, $tableNameDelete, $rowNumberDelete);
        } else {
            echo "Table name or row number not provided for deletion.";
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

function updateTable($conn) {
    $updates = [
        "UPDATE Movies SET blu_ray_price = 25.99 WHERE movie_name = 'Tenet'",
        "UPDATE Music SET CD_price = 14.99 WHERE music_name = 'Blinding Lights'",
        "UPDATE Customers SET city = 'New York' WHERE customer_id = 'C00000001'",
	"UPDATE Movies SET genre = 'Action' WHERE movie_name = 'Dunkirk'",
    	"UPDATE Music SET vinyl_price = 34.99 WHERE music_name = 'Bad Romance'",
   	"UPDATE Customers SET street_number = '555' WHERE customer_id = 'C00000002'"
    ];

    foreach ($updates as $update) {
        $stid = oci_parse($conn, $update);
        $result = oci_execute($stid);

        if (!$result) {
            $error = oci_error($stid);
            echo "Error executing update: " . $error['message'];
            return;
        }

        // Check if any rows were affected
        $rowsAffected = oci_num_rows($stid);

        if ($rowsAffected > 0) {
            echo "Update successful. $rowsAffected row(s) affected. Query: $update<br>";
        } else {
            echo "Update did not affect any rows. Query: $update<br>";
        }
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

// Function to delete a row from a table
function deleteRow($conn, $tableName, $rowNumber) {
    // Construct the DELETE query
    $query = "DELETE FROM $tableName WHERE ROWNUM = :rowNumber";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':rowNumber', $rowNumber);

    // Execute the query
    $result = oci_execute($stid);

    // Check for errors
    if (!$result) {
        $error = oci_error($stid);
        echo "Error deleting row: " . $error['message'];
        return false;
    }

    // Check if any rows were affected
    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "Row deleted successfully. $rowsAffected row(s) affected. Table: $tableName, Row Number: $rowNumber<br>";
        return true;
    } else {
        echo "No rows were deleted. Table: $tableName, Row Number: $rowNumber<br>";
        return false;
    }
}


// Close the Oracle connection
oci_close($conn);
?>