<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Customer</title>
    <h1>Update Customer</h1>
    <nav>
        <li><a href="https://webdev.scs.ryerson.ca/~aomajeed/index.php">Home</a></li>
    </nav>
</head>
<body style="
font-family: 'Comic Sans MS', cursive, sans-serif; background-image: url('https://ihypress.com/textures/books.gif'); background-repeat: repeat;">

<!-- Form for updating first name -->
<h2>Update First Name</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_first_name">New First Name:</label>
    <input type="text" name="new_first_name" required>
    <button type="submit" name="update_first_name">Update First Name</button>
</form>

<!-- Form for updating last name -->
<h2>Update Last Name</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_last_name">New Last Name:</label>
    <input type="text" name="new_last_name" required>
    <button type="submit" name="update_last_name">Update Last Name</button>
</form>

<!-- Form for updating email -->
<h2>Update Email</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_email">New Email:</label>
    <input type="text" name="new_email" required>
    <button type="submit" name="update_email">Update Email</button>
</form>

<!-- Form for updating province -->
<h2>Update Province</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_province">New Province:</label>
    <input type="text" name="new_province" required>
    <button type="submit" name="update_province">Update Province</button>
</form>

<!-- Form for updating city -->
<h2>Update City</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_city">New City:</label>
    <input type="text" name="new_city" required>
    <button type="submit" name="update_city">Update City</button>
</form>

<!-- Form for updating street name -->
<h2>Update Street Name</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_street_name">New Street Name:</label>
    <input type="text" name="new_street_name" required>
    <button type="submit" name="update_street_name">Update Street Name</button>
</form>

<!-- Form for updating street number -->
<h2>Update Street Number</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_street_number">New Street Number:</label>
    <input type="text" name="new_street_number" required>
    <button type="submit" name="update_street_number">Update Street Number</button>
</form>

<!-- Form for updating postal code -->
<h2>Update Postal Code</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="customer_id">Enter Customer ID:</label>
    <input type="text" name="customer_id" required>
    <label for="new_postal_code">New Postal Code:</label>
    <input type="text" name="new_postal_code" required>
    <button type="submit" name="update_postal_code">Update Postal Code</button>
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
        if (isset($_POST["customer_id"]) && isset($_POST["new_first_name"])) {
            $customerId = $_POST["customer_id"];
            $newFirstName = $_POST["new_first_name"];

            // Your update logic goes here
            updateFirstName($conn, $customerId, $newFirstName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for last name
    elseif (isset($_POST["update_last_name"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_last_name"])) {
            $customerId = $_POST["customer_id"];
            $newLastName = $_POST["new_last_name"];

            // Your update logic goes here
            updateLastName($conn, $customerId, $newLastName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for email
    elseif (isset($_POST["update_email"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_email"])) {
            $customerId = $_POST["customer_id"];
            $newEmail = $_POST["new_email"];

            // Your update logic goes here
            updateEmail($conn, $customerId, $newEmail);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for province
    elseif (isset($_POST["update_province"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_province"])) {
            $customerId = $_POST["customer_id"];
            $newProvince = $_POST["new_province"];

            // Your update logic goes here
            updateProvince($conn, $customerId, $newProvince);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for city
    elseif (isset($_POST["update_city"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_city"])) {
            $customerId = $_POST["customer_id"];
            $newCity = $_POST["new_city"];

            // Your update logic goes here
            updateCity($conn, $customerId, $newCity);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for street name
    elseif (isset($_POST["update_street_name"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_street_name"])) {
            $customerId = $_POST["customer_id"];
            $newStreetName = $_POST["new_street_name"];

            // Your update logic goes here
            updateStreetName($conn, $customerId, $newStreetName);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for street number
    elseif (isset($_POST["update_street_number"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_street_number"])) {
            $customerId = $_POST["customer_id"];
            $newStreetNumber = $_POST["new_street_number"];

            // Your update logic goes here
            updateStreetNumber($conn, $customerId, $newStreetNumber);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Handle update for postal code
    elseif (isset($_POST["update_postal_code"])) {
        if (isset($_POST["customer_id"]) && isset($_POST["new_postal_code"])) {
            $customerId = $_POST["customer_id"];
            $newPostalCode = $_POST["new_postal_code"];

            // Your update logic goes here
            updatePostalCode($conn, $customerId, $newPostalCode);
        } else {
            echo "Incomplete form data.";
        }
    }

    // Repeat similar blocks for other attributes

    // Add more elseif blocks for other attributes
}

// Function to update first name in the Customers table
function updateFirstName($conn, $customerId, $newFirstName) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET first_name = :new_first_name WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_first_name', $newFirstName);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "First Name", $customerId);
}

// Function to update last name in the Customers table
function updateLastName($conn, $customerId, $newLastName) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET last_name = :new_last_name WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_last_name', $newLastName);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Last Name", $customerId);
}

// Function to update email in the Customers table
function updateEmail($conn, $customerId, $newEmail) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET email = :new_email WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_email', $newEmail);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Email", $customerId);
}

// Function to update province in the Customers table
function updateProvince($conn, $customerId, $newProvince) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET province = :new_province WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_province', $newProvince);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Province", $customerId);
}

// Function to update city in the Customers table
function updateCity($conn, $customerId, $newCity) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET city = :new_city WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_city', $newCity);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "City", $customerId);
}

// Function to update street name in the Customers table
function updateStreetName($conn, $customerId, $newStreetName) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET street_name = :new_street_name WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_street_name', $newStreetName);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Street Name", $customerId);
}

// Function to update street number in the Customers table
function updateStreetNumber($conn, $customerId, $newStreetNumber) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET street_number = :new_street_number WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_street_number', $newStreetNumber);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Street Number", $customerId);
}

// Function to update postal code in the Customers table
function updatePostalCode($conn, $customerId, $newPostalCode) {
    // Construct the UPDATE query
    $query = "UPDATE Customers SET postal_code = :new_postal_code WHERE customer_id = :customer_id";

    // Parse the SQL query and bind parameters
    $stid = oci_parse($conn, $query);
    oci_bind_by_name($stid, ':new_postal_code', $newPostalCode);
    oci_bind_by_name($stid, ':customer_id', $customerId);

    // Execute the query
    executeUpdateQuery($stid, "Postal Code", $customerId);
}

// Function to execute the update query and display result
function executeUpdateQuery($stid, $attribute, $customerId) {
    $result = oci_execute($stid);

    if (!$result) {
        $error = oci_error($stid);
        echo "Error updating $attribute: " . $error['message'];
        return;
    }

    $rowsAffected = oci_num_rows($stid);

    if ($rowsAffected > 0) {
        echo "$attribute updated successfully. $rowsAffected row(s) affected. ID: $customerId<br>";
    } else {
        echo "No $attribute were updated. Customer ID: $customerId<br>";
    }
}
?>




