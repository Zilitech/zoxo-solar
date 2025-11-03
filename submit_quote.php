<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// PostgreSQL connection settings
$host = "82.112.226.186";
$port = "5432";
$dbname = "mydb";
$user = "myuser";
$password = "Zilitech@2025";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("❌ Connection failed: " . pg_last_error());
}

// Get form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$service = $_POST['service'] ?? '';
$message = $_POST['message'] ?? '';

if ($name && $email && $phone && $service && $message) {
    $query = "INSERT INTO public.quote_data (name, email, phone, service, message)
              VALUES ($1, $2, $3, $4, $5)";
    $result = pg_query_params($conn, $query, [$name, $email, $phone, $service, $message]);

    if ($result) {
        echo "<h3>✅ Thank you, $name! Your quote request has been submitted successfully.</h3>";
    } else {
        echo "❌ Insert failed: " . pg_last_error($conn);
    }
} else {
    echo "⚠️ Missing required fields.";
}

pg_close($conn);
?>
