<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transactions</title>
    <h1>Update Transactions</h1>
    <h2>Please make sure your total matches with the product price and their respective quantities!</h2>
    <h3>Item name can be updated through the movie and music table</h3>
    <nav>
        <li><a href="https://webdev.scs.ryerson.ca/~aomajeed/index.php">Home</a></li>
    </nav>
</head>
<body style="
font-family: 'Comic Sans MS', cursive, sans-serif; background-image: url('https://ihypress.com/textures/books.gif'); background-repeat: repeat;">

<!-- Form for updating payment method -->
<h2>Update Payment Method</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="transaction_id">Enter Transaction ID:</label>
    <input type="text" name="transaction_id" required>
    <label for="new_payment_method">New Payment Method:</label>
    <input type="text" name="new_payment_method" required>
    <button type="submit" name="update_payment_method">Update Payment Method</button>
</form>

<!-- Form for updating quantity -->
<h2>Update Quantity</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="transaction_id">Enter Transaction ID:</label>
    <input type="text" name="transaction_id" required>
    <label for="new_quantity">New Quantity:</label>
    <input type="text" name="new_quantity" required>
    <button type="submit" name="update_quantity">Update Quantity</button>
</form>

<!-- Form for updating total cost -->
<h2>Update Total Cost</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="transaction_id">Enter Transaction ID:</label>
    <input type="text" name="transaction_id" required>
    <label for="new_total_cost">New Total Cost:</label>
    <input type="text" name="new_total_cost" required>
    <button type="submit" name="update_total_cost">Update Total Cost</button>
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
    // Handle update for payment method
    if (isset($_POST["update_payment_method"])) {
        if (isset($_POST["transaction_id"]) && isset($_POST["new_payment_method"])) {
            $transactionId = $_POST["transaction_id"];
            $newPaymentMethod = $_POST["new_payment_method"];

            // Your update logic goes here
            updatePaymentMethod($conn, $transactionId, $newPaymentMethod);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for quantity
    elseif (isset($_POST["update_quantity"])) {
        if (isset($_POST["transaction_id"]) && isset($_POST["new_quantity"])) {
            $transactionId = $_POST["transaction_id"];
            $newQuantity = $_POST["new_quantity"];

            // Your update logic goes here
            updateQuantity($conn, $transactionId, $newQuantity);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for total cost
    elseif (isset($_POST["update_total_cost"])) {
        if (isset($_POST["transaction_id"]) && isset($_POST["new_total_cost"])) {
            $transactionId = $_POST["transaction_id"];
            $newTotalCost = $_POST["new_total_cost"];

            // Your update logic goes here
            updateTotalCost($conn, $transactionId, $newTotalCost);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Repeat similar blocks for other attributes

    // Add more elseif blocks for other attributes
}

// Function to update payment method in the Transactions table
function updatePaymentMethod($conn, $transactionId, $newPaymentMethod) {
    // Construct the UPDATE query
    $query = "UPDATE Transactions SET payment_method = :new_payment_method WHERE transaction_id = :transaction_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_payment_method', $newPaymentMethod);
    oci_bind_by_name($stid, ':transaction_id', $transactionId);

    // Execute the query
    executeUpdateQuery($stid, "Payment Method", $transactionId);
}

// Function to update quantity in the Transactions table
function updateQuantity($conn, $transactionId, $newQuantity) {
    // Construct the UPDATE query
    $query = "UPDATE Transactions SET quantity = :new_quantity WHERE transaction_id = :transaction_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_quantity', $newQuantity);
    oci_bind_by_name($stid, ':transaction_id', $transactionId);

    // Execute the query
    executeUpdateQuery($stid, "Quantity", $transactionId);
}

// Function to update total cost in the Transactions table
function updateTotalCost($conn, $transactionId, $newTotalCost) {
    // Construct the UPDATE query
    $query = "UPDATE Transactions SET total_cost = :new_total_cost WHERE transaction_id = :transaction_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_total_cost', $newTotalCost);
    oci_bind_by_name($stid, ':transaction_id', $transactionId);

    // Execute the query
    executeUpdateQuery($stid, "Total Cost", $transactionId);
}

// Function to execute the update query and display result
function executeUpdateQuery($stid, $attribute, $transactionId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error updating $attribute: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$attribute updated successfully. $rowsAffected row(s) affected. ID: $transactionId<br>";
    } else {
        echo "No $attribute were updated. Transaction ID: $transactionId<br>";
    }
}

// Add more functions for other attributes (payment_method, quantity, total_cost, etc.)
?>
