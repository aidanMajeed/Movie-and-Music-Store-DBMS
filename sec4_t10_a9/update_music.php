<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Music</title>
    <h1>Update Music</h1>
    <nav>
        <li><a href="https://webdev.scs.ryerson.ca/~aomajeed/index.php">Home</a></li>
    </nav>
</head>
<body style="
font-family: 'Comic Sans MS', cursive, sans-serif; background-image: url('https://ihypress.com/textures/books.gif'); background-repeat: repeat;">

<!-- Form for updating music_name using CD ID -->
<h2>Update Music Name with CD ID</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="cd_id">Enter CD ID:</label>
    <input type="text" name="cd_id" required>
    <label for="new_music_name_cd">New Music Name:</label>
    <input type="text" name="new_music_name_cd" required>
    <button type="submit" name="update_music_name_cd">Update Music Name</button>
</form>

<!-- Form for updating music_name using Vinyl ID -->
<h2>Update Music Name with Vinyl ID</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="vinyl_id">Enter Vinyl ID:</label>
    <input type="text" name="vinyl_id" required>
    <label for="new_music_name_vinyl">New Music Name:</label>
    <input type="text" name="new_music_name_vinyl" required>
    <button type="submit" name="update_music_name_vinyl">Update Music Name</button>
</form>

<!-- Form for updating artist -->
<h2>Update Artist</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="cd_id">Enter CD ID:</label>
    <input type="text" name="cd_id" required>
    <label for="new_artist">New Artist:</label>
    <input type="text" name="new_artist" required>
    <button type="submit" name="update_artist">Update Artist</button>
</form>

<!-- Form for updating genre -->
<h2>Update Music Genre</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="cd_id">Enter CD ID:</label>
    <input type="text" name="cd_id" required>
    <label for="new_genre">New Genre:</label>
    <input type="text" name="new_genre" required>
    <button type="submit" name="update_genre">Update Music Genre</button>
</form>

<!-- Form for updating CD stock -->
<h2>Update CD Stock</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="cd_id">Enter CD ID:</label>
    <input type="text" name="cd_id" required>
    <label for="new_cd_stock">New CD Stock:</label>
    <input type="text" name="new_cd_stock" required>
    <button type="submit" name="update_cd_stock">Update CD Stock</button>
</form>

<!-- Form for updating vinyl stock -->
<h2>Update Vinyl Stock</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="vinyl_id">Enter Vinyl ID:</label>
    <input type="text" name="vinyl_id" required>
    <label for="new_vinyl_stock">New Vinyl Stock:</label>
    <input type="text" name="new_vinyl_stock" required>
    <button type="submit" name="update_vinyl_stock">Update Vinyl Stock</button>
</form>

<!-- Form for updating CD price -->
<h2>Update CD Price</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="cd_id">Enter CD ID:</label>
    <input type="text" name="cd_id" required>
    <label for="new_cd_price">New CD Price:</label>
    <input type="text" name="new_cd_price" required>
    <button type="submit" name="update_cd_price">Update CD Price</button>
</form>

<!-- Form for updating vinyl price -->
<h2>Update Vinyl Price</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="vinyl_id">Enter Vinyl ID:</label>
    <input type="text" name="vinyl_id" required>
    <label for="new_vinyl_price">New Vinyl Price:</label>
    <input type="text" name="new_vinyl_price" required>
    <button type="submit" name="update_vinyl_price">Update Vinyl Price</button>
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
    // Handle update for music_name
    if (isset($_POST["update_music_name_cd"])) {
        if (isset($_POST["cd_id"]) && isset($_POST["new_music_name_cd"])) {
            $cdId = $_POST["cd_id"];
            $newMusicName = $_POST["new_music_name_cd"];

            //call update function for attributes (handler)
            updateMusicNameCD($conn, $cdId, $newMusicName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for artist
    elseif (isset($_POST["update_music_name_vinyl"])) {
        if (isset($_POST["vinyl_id"]) && isset($_POST["new_music_name_vinyl"])) {
            $cdId = $_POST["vinyl_id"];
            $newArtist = $_POST["new_music_name_vinyl"];

            //call update function for attributes (handler)
            updateMusicNameVinyl($conn, $cdId, $newArtist);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for artist
    elseif (isset($_POST["update_artist"])) {
        if (isset($_POST["cd_id"]) && isset($_POST["new_artist"])) {
            $cdId = $_POST["cd_id"];
            $newArtist = $_POST["new_artist"];

            //call update function for attributes (handler)
            updateArtist($conn, $cdId, $newArtist);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for genre
    elseif (isset($_POST["update_genre"])) {
        if (isset($_POST["cd_id"]) && isset($_POST["new_genre"])) {
            $cdId = $_POST["cd_id"];
            $newGenre = $_POST["new_genre"];

            //call update function for attributes (handler)
            updateGenre($conn, $cdId, $newGenre);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for CD stock
    elseif (isset($_POST["update_cd_stock"])) {
        if (isset($_POST["cd_id"]) && isset($_POST["new_cd_stock"])) {
            $cdId = $_POST["cd_id"];
            $newCdStock = $_POST["new_cd_stock"];

            //call update function for attributes (handler)
            updateCdStock($conn, $cdId, $newCdStock);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for vinyl stock
    elseif (isset($_POST["update_vinyl_stock"])) {
        if (isset($_POST["vinyl_id"]) && isset($_POST["new_vinyl_stock"])) {
            $cdId = $_POST["vinyl_id"];
            $newVinylStock = $_POST["new_vinyl_stock"];

            //call update function for attributes (handler)
            updateVinylStock($conn, $cdId, $newVinylStock);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for CD price
    elseif (isset($_POST["update_cd_price"])) {
        if (isset($_POST["cd_id"]) && isset($_POST["new_cd_price"])) {
            $cdId = $_POST["cd_id"];
            $newCdPrice = $_POST["new_cd_price"];

            //call update function for attributes (handler)
            updateCdPrice($conn, $cdId, $newCdPrice);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for vinyl price
    elseif (isset($_POST["update_vinyl_price"])) {
        if (isset($_POST["vinyl_id"]) && isset($_POST["new_vinyl_price"])) {
            $cdId = $_POST["vinyl_id"];
            $newVinylPrice = $_POST["new_vinyl_price"];

            //call update function for attributes (handler)
            updateVinylPrice($conn, $cdId, $newVinylPrice);
        } else {
            echo "Incomplete form data.";
        }
    }

}

// Function to update music_name in the Music table using CD ID
function updateMusicNameCD($conn, $cdId, $newMusicName) {
    // Construct the UPDATE query for Music table
    $musicQuery = "UPDATE Music SET music_name = :new_music_name WHERE CD_id = :cd_id";

    // Parse the SQL query and bind parameters for Music table
    $stidMusic = oci_parse($conn, $musicQuery);
    oci_bind_by_name($stidMusic, ':new_music_name', $newMusicName);
    oci_bind_by_name($stidMusic, ':cd_id', $cdId);

    // Execute the query for Music table
    executeUpdateQuery($stidMusic, "Music Name", $cdId);

    // Construct the UPDATE query for Transactions table
    $transactionQuery = "UPDATE Transactions SET item_name = :new_music_name WHERE cd_id = :cd_id";

    // Parse the SQL query and bind parameters for Transactions table
    $stidTransaction = oci_parse($conn, $transactionQuery);
    oci_bind_by_name($stidTransaction, ':new_music_name', $newMusicName);
    oci_bind_by_name($stidTransaction, ':cd_id', $cdId);

    // Execute the query for Transactions table
    executeUpdateQuery($stidTransaction, "Item Name in Transactions", $cdId);
}

// Function to update music_name in the Music table using Vinyl ID
function updateMusicNameVinyl($conn, $vinylId, $newMusicName) {
    // Construct the UPDATE query for Music table
    $musicQuery = "UPDATE Music SET music_name = :new_music_name WHERE vinyl_id = :vinyl_id";

    // Parse the SQL query and bind parameters for Music table
    $stidMusic = oci_parse($conn, $musicQuery);
    oci_bind_by_name($stidMusic, ':new_music_name', $newMusicName);
    oci_bind_by_name($stidMusic, ':vinyl_id', $vinylId);

    // Execute the query for Music table
    executeUpdateQuery($stidMusic, "Music Name", $vinylId);

    // Construct the UPDATE query for Transactions table
    $transactionQuery = "UPDATE Transactions SET item_name = :new_music_name WHERE vinyl_id = :vinyl_id";

    // Parse the SQL query and bind parameters for Transactions table
    $stidTransaction = oci_parse($conn, $transactionQuery);
    oci_bind_by_name($stidTransaction, ':new_music_name', $newMusicName);
    oci_bind_by_name($stidTransaction, ':vinyl_id', $vinylId);

    // Execute the query for Transactions table
    executeUpdateQuery($stidTransaction, "Item Name in Transactions", $vinylId);
}

// Function to update artist in the Music table
function updateArtist($conn, $cdId, $newArtist) {
    // Construct the UPDATE query
    $query = "UPDATE Music SET artist = :new_artist WHERE CD_id = :cd_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_artist', $newArtist);
    oci_bind_by_name($stid, ':cd_id', $cdId);

    // Execute the query
    executeUpdateQuery($stid, "Artist", $cdId);
}

// Function to update genre in the Music table
function updateGenre($conn, $cdId, $newGenre) {
    // Construct the UPDATE query
    $query = "UPDATE Music SET genre = :new_genre WHERE CD_id = :cd_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_genre', $newGenre);
    oci_bind_by_name($stid, ':cd_id', $cdId);

    // Execute the query
    executeUpdateQuery($stid, "Genre", $cdId);
}

// Function to update CD stock in the Music table
function updateCdStock($conn, $cdId, $newCdStock) {
    // Construct the UPDATE query
    $query = "UPDATE Music SET CD_stock = :new_cd_stock WHERE CD_id = :cd_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_cd_stock', $newCdStock);
    oci_bind_by_name($stid, ':cd_id', $cdId);

    // Execute the query
    executeUpdateQuery($stid, "CD Stock", $cdId);
}

// Function to update vinyl stock in the Music table
function updateVinylStock($conn, $cdId, $newVinylStock) {
    // Construct the UPDATE query
    $query = "UPDATE Music SET vinyl_stock = :new_vinyl_stock WHERE vinyl_id = :vinyl_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_vinyl_stock', $newVinylStock);
    oci_bind_by_name($stid, ':vinyl_id', $cdId);

    // Execute the query
    executeUpdateQuery($stid, "Vinyl Stock", $cdId);
}

// Function to update CD price in the Music table
function updateCdPrice($conn, $cdId, $newCdPrice) {
    // Construct the UPDATE query
    $query = "UPDATE Music SET CD_price = :new_cd_price WHERE CD_id = :cd_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_cd_price', $newCdPrice);
    oci_bind_by_name($stid, ':cd_id', $cdId);

    // Execute the query
    executeUpdateQuery($stid, "CD Price", $cdId);
}

// Function to update vinyl price in the Music table
function updateVinylPrice($conn, $cdId, $newVinylPrice) {
    // Construct the UPDATE query
    $query = "UPDATE Music SET vinyl_price = :new_vinyl_price WHERE vinyl_id = :vinyl_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_vinyl_price', $newVinylPrice);
    oci_bind_by_name($stid, ':vinyl_id', $cdId);

    // Execute the query
    executeUpdateQuery($stid, "Vinyl Price", $cdId);
}

// Function to execute the update query and display result
function executeUpdateQuery($stid, $attribute, $cdId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error updating $attribute: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$attribute updated successfully. $rowsAffected row(s) affected. ID: $cdId<br>";
    } else {
        echo "No $attribute were updated. ID: $cdId<br>";
    }
}

?>


