<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Movies</title>
    <h1>Update Movies</h1>
    <nav>
        <li><a href="https://webdev.scs.ryerson.ca/~aomajeed/index.php">Home</a></li>
    </nav>
</head>
<body style="
font-family: 'Comic Sans MS', cursive, sans-serif; background-image: url('https://ihypress.com/textures/books.gif'); background-repeat: repeat;">

<!-- Form for updating movie_name -->
<h2>Update Movie Name</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="blu_ray_id">Enter Blu-ray ID:</label>
    <input type="text" name="blu_ray_id" required>
    <label for="new_movie_name">New Movie Name:</label>
    <input type="text" name="new_movie_name" required>
    <button type="submit" name="update_movie_name">Update Movie Name</button>
</form>

<!-- Form for updating director -->
<h2>Update Movie Director</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="blu_ray_id">Enter Blu-ray ID:</label>
    <input type="text" name="blu_ray_id" required>
    <label for="new_director">New Director:</label>
    <input type="text" name="new_director" required>
    <button type="submit" name="update_director">Update Director</button>
</form>

<!-- Form for updating genre -->
<h2>Update Movie Genre</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="blu_ray_id">Enter Blu-ray ID:</label>
    <input type="text" name="blu_ray_id" required>
    <label for="new_genre">New Genre:</label>
    <input type="text" name="new_genre" required>
    <button type="submit" name="update_genre">Update Movie Genre</button>
</form>

<!-- Form for updating bluray stock -->
<h2>Update Bluray Stock</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="blu_ray_id">Enter Blu-ray ID:</label>
    <input type="text" name="blu_ray_id" required>
    <label for="new_blu_ray_stock">New Bluray Stock:</label>
    <input type="text" name="new_blu_ray_stock" required>
    <button type="submit" name="update_bluray_stock">Update Bluray Stock</button>
</form>

<!-- Form for updating dvd stock -->
<h2>Update DVD Stock</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="dvd_id">Enter DVD ID:</label>
    <input type="text" name="dvd_id" required>
    <label for="new_dvd_stock">New DVD Stock:</label>
    <input type="text" name="new_dvd_stock" required>
    <button type="submit" name="update_dvd_stock">Update DVD Stock</button>
</form>

<!-- Form for updating bluray price -->
<h2>Update Bluray Price</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="blu_ray_id">Enter Blu-ray ID:</label>
    <input type="text" name="blu_ray_id" required>
    <label for="new_bluray_price">New Bluray Price:</label>
    <input type="text" name="new_bluray_price" required>
    <button type="submit" name="update_bluray_price">Update Bluray Price</button>
</form>

<!-- Form for updating dvd price -->
<h2>Update DVD Price</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="dvd_id">Enter DVD ID:</label>
    <input type="text" name="dvd_id" required>
    <label for="new_dvd_price">New DVD Price:</label>
    <input type="text" name="new_dvd_price" required>
    <button type="submit" name="update_dvd_price">Update DVD Price</button>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle update for movie_name
    if (isset($_POST["update_movie_name"])) {
        if (isset($_POST["blu_ray_id"]) && isset($_POST["new_movie_name"])) {
            $bluRayId = $_POST["blu_ray_id"];
            $newMovieName = $_POST["new_movie_name"];

            // Your update logic goes here
            updateMovieName($conn, $bluRayId, $newMovieName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for director
    elseif (isset($_POST["update_director"])) {
        if (isset($_POST["blu_ray_id"]) && isset($_POST["new_director"])) {
            $bluRayId = $_POST["blu_ray_id"];
            $newDirector = $_POST["new_director"];

            // Your update logic goes here
            updateDirector($conn, $bluRayId, $newDirector);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for genre
    elseif (isset($_POST["update_genre"])) {
        if (isset($_POST["blu_ray_id"]) && isset($_POST["new_genre"])) {
            $bluRayId = $_POST["blu_ray_id"];
            $newGenre = $_POST["new_genre"];

            // Your update logic goes here
            updateGenre($conn, $bluRayId, $newGenre);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for bluray stock
    elseif (isset($_POST["update_bluray_stock"])) {
        if (isset($_POST["blu_ray_id"]) && isset($_POST["new_blu_ray_stock"])) {
            $bluRayId = $_POST["blu_ray_id"];
            $newGenre = $_POST["new_blu_ray_stock"];

            // Your update logic goes here
            updateBlurayStock($conn, $bluRayId, $newGenre);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for dvd_stock
    elseif (isset($_POST["update_dvd_stock"])) {
        if (isset($_POST["dvd_id"]) && isset($_POST["new_dvd_stock"])) {
            $bluRayId = $_POST["dvd_id"];
            $newDvdStock = $_POST["new_dvd_stock"];

            // Your update logic goes here
            updateDvdStock($conn, $bluRayId, $newDvdStock);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for bluray_price
elseif (isset($_POST["update_bluray_price"])) {
    if (isset($_POST["blu_ray_id"]) && isset($_POST["new_bluray_price"])) {
        $bluRayId = $_POST["blu_ray_id"];
        $newBlurayPrice = $_POST["new_bluray_price"];

        // Your update logic goes here
        updateBlurayPrice($conn, $bluRayId, $newBlurayPrice);
    } else {
        echo "Incomplete form data.";
    }
}

// Handle update for dvd_price
elseif (isset($_POST["update_dvd_price"])) {
    if (isset($_POST["dvd_id"]) && isset($_POST["new_dvd_price"])) {
        $bluRayId = $_POST["dvd_id"];
        $newDvdPrice = $_POST["new_dvd_price"];

        // Your update logic goes here
        updateDvdPrice($conn, $bluRayId, $newDvdPrice);
    } else {
        echo "Incomplete form data.";
    }
}

    // Repeat similar blocks for other attributes

    // Add more elseif blocks for other attributes
}

// Function to update movie_name in the Movies table
function updateMovieName($conn, $bluRayId, $newMovieName) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET movie_name = :new_movie_name WHERE blu_ray_id = :blu_ray_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_movie_name', $newMovieName);
    oci_bind_by_name($stid, ':blu_ray_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "Movie Name", $bluRayId);
}

// Function to update director in the Movies table
function updateDirector($conn, $bluRayId, $newDirector) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET director = :new_director WHERE blu_ray_id = :blu_ray_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_director', $newDirector);
    oci_bind_by_name($stid, ':blu_ray_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "Director", $bluRayId);
}

// Function to update genre in the Movies table
function updateGenre($conn, $bluRayId, $newGenre) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET genre = :new_genre WHERE blu_ray_id = :blu_ray_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_genre', $newGenre);
    oci_bind_by_name($stid, ':blu_ray_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "Genre", $bluRayId);
}

// Function to update bluray stock in the Movies table
function updateBlurayStock($conn, $bluRayId, $newBlurayStock) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET blu_ray_stock = :new_blu_ray_stock WHERE blu_ray_id = :blu_ray_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_blu_ray_stock', $newBlurayStock);
    oci_bind_by_name($stid, ':blu_ray_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "Bluray Stock", $bluRayId);
}

// Function to update dvd stock in the Movies table
function updateDvdStock($conn, $bluRayId, $newDvdStock) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET dvd_stock = :new_dvd_stock WHERE dvd_id = :dvd_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_dvd_stock', $newDvdStock);
    oci_bind_by_name($stid, ':dvd_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "DVD Stock", $bluRayId);
}

// Function to update bluray price in the Movies table
function updateBlurayPrice($conn, $bluRayId, $newBlurayPrice) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET blu_ray_price = :new_blu_ray_price WHERE blu_ray_id = :blu_ray_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_blu_ray_price', $newBlurayPrice);
    oci_bind_by_name($stid, ':blu_ray_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "Bluray Price", $bluRayId);
}

// Function to update dvd price in the Movies table
function updateDvdPrice($conn, $bluRayId, $newDvdPrice) {
    // Construct the UPDATE query
    $query = "UPDATE Movies SET dvd_price = :new_dvd_price WHERE dvd_id = :dvd_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_dvd_price', $newDvdPrice);
    oci_bind_by_name($stid, ':dvd_id', $bluRayId);

    // Execute the query
    executeUpdateQuery($stid, "DVD Price", $bluRayId);
}

// Function to execute the update query and display result
function executeUpdateQuery($stid, $attribute, $bluRayId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error updating $attribute: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$attribute updated successfully. $rowsAffected row(s) affected. ID: $bluRayId<br>";
    } else {
        echo "No $attribute were updated. Blu-ray ID: $bluRayId<br>";
    }
}

// Add more functions for other attributes (dvd_stock, blu_ray_price, dvd_price, etc.)
?>

