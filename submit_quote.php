<?php
// PostgreSQL connection settings
$host = "82.112.226.186";
$port = "5432";
$dbname = "mydb";
$user = "myuser";
$password = "mypassword";

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Connection failed: " . pg_last_error());
}

// Get form data safely
$name = htmlspecialchars($_POST['name']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$service = htmlspecialchars($_POST['service']);
$message = htmlspecialchars($_POST['message']);

// Insert data into table (make sure this table exists)
$query = "INSERT INTO quote_data (name, email, phone, service, message)
          VALUES ($1, $2, $3, $4, $5)";
$result = pg_query_params($conn, $query, array($name, $email, $phone, $service, $message));

if ($result) {
    echo "<h3>✅ Thank you, $name! Your quote request has been submitted successfully.</h3>";
} else {
    echo "❌ Error inserting data: " . pg_last_error($conn);
}

// Close connection
pg_close($conn);
?>
