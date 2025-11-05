<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PostgreSQL connection settings
$host = "2a02:4780:12:f25c::1";  // example: "203.0.113.50"
$port = "5432";
$dbname = "quote_db";
$user = "quote_user";
$password = "Zilitech@2025";// Use your updated PostgreSQL password

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Connection failed: " . pg_last_error());
}

// Collect form data safely
$name    = $_POST['name']    ?? '';
$email   = $_POST['email']   ?? '';
$phone   = $_POST['phone']   ?? '';
$service = $_POST['service'] ?? '';
$message = $_POST['message'] ?? '';

// Validate required fields
if ($name && $email && $phone && $service && $message) {

    // Insert query
    $query = "INSERT INTO public.quote_requests (name, email, phone, service, message)
              VALUES ($1, $2, $3, $4, $5)";

    $result = pg_query_params($conn, $query, [$name, $email, $phone, $service, $message]);

    if ($result) {
        echo "<h3>✅ Thank you, $name! Your quote request has been submitted successfully.</h3>";
    } else {
        echo "❌ Insert failed: " . pg_last_error($conn);
    }

} else {
    echo "⚠️ Please fill in all required fields.";
}

pg_close($conn);
?>
