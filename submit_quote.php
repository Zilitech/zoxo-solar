<?php
// Enable full error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PostgreSQL connection settings
$host     = "127.0.0.1";         // Localhost since PHP & DB are on same VPS
$port     = "5432";
$dbname   = "quote_db";
$user     = "quote_user";
$password = "Zilitech@2025";     // Your PostgreSQL password

// Connect to PostgreSQL
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("❌ Connection failed: " . pg_last_error($conn));
}

// Collect form data safely using null coalescing operator
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if ($name && $email && $phone && $service && $message) {

    // Use parameterized query to prevent SQL injection
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

// Close connection
pg_close($conn);
?>
