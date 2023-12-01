<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Administrator and Cart</title>
    <h1>Update Administrator and Cart</h1>
    <nav>
        <li><a href="https://webdev.scs.ryerson.ca/~aomajeed/index.php">Home</a></li>
    </nav>
</head>
<body style="
font-family: 'Comic Sans MS', cursive, sans-serif; background-image: url('https://ihypress.com/textures/books.gif'); background-repeat: repeat;">

<!-- Form for updating first name -->
<h2>Update First Name</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="admin_id">Enter Admin ID:</label>
    <input type="text" name="admin_id" required>
    <label for="new_first_name">New First Name:</label>
    <input type="text" name="new_first_name" required>
    <button type="submit" name="update_first_name">Update First Name</button>
</form>

<!-- Form for updating last name -->
<h2>Update Last Name</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="admin_id">Enter Admin ID:</label>
    <input type="text" name="admin_id" required>
    <label for="new_last_name">New Last Name:</label>
    <input type="text" name="new_last_name" required>
    <button type="submit" name="update_last_name">Update Last Name</button>
</form>

<!-- Form for updating position -->
<h2>Update Position</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="admin_id">Enter Admin ID:</label>
    <input type="text" name="admin_id" required>
    <label for="new_position">New Position:</label>
    <input type="text" name="new_position" required>
    <button type="submit" name="update_position">Update Position</button>
</form>

<!-- Form for updating access -->
<h2>Update Access</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="admin_id">Enter Admin ID:</label>
    <input type="text" name="admin_id" required>
    <label for="new_access">New Access:</label>
    <input type="text" name="new_access" required>
    <button type="submit" name="update_access">Update Access</button>
</form>

<!-- Form for updating quantity in Cart -->
<h2>Update Cart Quantity</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id_cart">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_quantity">New Quantity:</label>
    <input type="text" name="new_quantity" required>
    <button type="submit" name="update_cart_quantity">Update Cart Quantity</button>
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
    // Handle update for first name
    if (isset($_POST["update_first_name"])) {
        if (isset($_POST["admin_id"]) && isset($_POST["new_first_name"])) {
            $adminId = $_POST["admin_id"];
            $newFirstName = $_POST["new_first_name"];

            // Your update logic goes here
            updateAdminFirstName($conn, $adminId, $newFirstName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for last name
    elseif (isset($_POST["update_last_name"])) {
        if (isset($_POST["admin_id"]) && isset($_POST["new_last_name"])) {
            $adminId = $_POST["admin_id"];
            $newLastName = $_POST["new_last_name"];

            // Your update logic goes here
            updateAdminLastName($conn, $adminId, $newLastName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for position
    elseif (isset($_POST["update_position"])) {
        if (isset($_POST["admin_id"]) && isset($_POST["new_position"])) {
            $adminId = $_POST["admin_id"];
            $newPosition = $_POST["new_position"];

            // Your update logic goes here
            updateAdminPosition($conn, $adminId, $newPosition);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for access
    elseif (isset($_POST["update_access"])) {
        if (isset($_POST["admin_id"]) && isset($_POST["new_access"])) {
            $adminId = $_POST["admin_id"];
            $newAccess = $_POST["new_access"];

            // Your update logic goes here
            updateAdminAccess($conn, $adminId, $newAccess);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for cart quantity
    elseif (isset($_POST["update_cart_quantity"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_quantity"])) {
            $customerId = $_POST["customer_id"];
            $newQuantity = $_POST["new_quantity"];

            // Your update logic goes here
            updateCartQuantity($conn, $customerId, $newQuantity);
        } else {
            echo "Incomplete form data.";
        }
    }
}

// Function to update first name in the Administrator table
function updateAdminFirstName($conn, $adminId, $newFirstName) {
    // Construct the UPDATE query
    $query = "UPDATE Administrator SET first_name = :new_first_name WHERE admin_id = :admin_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_first_name', $newFirstName);
    oci_bind_by_name($stid, ':admin_id', $adminId);

    // Execute the query
    executeUpdateQuery($stid, "First Name", $adminId);
}

// Function to update last name in the Administrator table
function updateAdminLastName($conn, $adminId, $newLastName) {
    // Construct the UPDATE query
    $query = "UPDATE Administrator SET last_name = :new_last_name WHERE admin_id = :admin_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_last_name', $newLastName);
    oci_bind_by_name($stid, ':admin_id', $adminId);

    // Execute the query
    executeUpdateQuery($stid, "Last Name", $adminId);
}

// Function to update position in the Administrator table
function updateAdminPosition($conn, $adminId, $newPosition) {
    // Construct the UPDATE query
    $query = "UPDATE Administrator SET position_ = :new_position WHERE admin_id = :admin_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_position', $newPosition);
    oci_bind_by_name($stid, ':admin_id', $adminId);

    // Execute the query
    executeUpdateQuery($stid, "Position", $adminId);
}

// Function to update access in the Administrator table
function updateAdminAccess($conn, $adminId, $newAccess) {
    // Construct the UPDATE query
    $query = "UPDATE Administrator SET access_ = :new_access WHERE admin_id = :admin_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_access', $newAccess);
    oci_bind_by_name($stid, ':admin_id', $adminId);

    // Execute the query
    executeUpdateQuery($stid, "Access", $adminId);
}

// Function to update quantity in the Cart table
function updateCartQuantity($conn, $customerId, $newQuantity) {
    // Construct the UPDATE query
    $query = "UPDATE Cart SET quantity = :new_quantity WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_quantity', $newQuantity);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Quantity", $customerId);

    // Update transactions table as well
    updateTransactionsTable($conn, $customerId, $newQuantity);
}

// Function to update quantity in the Transactions table
function updateTransactionsTable($conn, $customerId, $newQuantity) {
    // Construct the UPDATE query for Transactions table
    $query = "UPDATE Transactions SET quantity = :new_quantity WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_quantity', $newQuantity);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Quantity in Transactions", $customerId);
}

// Function to execute the update query and display result
function executeUpdateQuery($stid, $attribute, $adminId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error updating $attribute: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$attribute updated successfully. $rowsAffected row(s) affected. ID: $adminId<br>";
    } else {
        echo "No $attribute were updated. Admin ID: $adminId<br>";
    }
}
?>
