<?php
// ===============================
// Enable error reporting (disable in production)
// ===============================
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ===============================
// PostgreSQL connection settings
// ===============================
$host     = "127.0.0.1";       // or your VPS IP if remote
$port     = "5432";
$dbname   = "quote_db";
$user     = "quote_user";
$password = "Zilitech@2025";

// ===============================
// Connect to PostgreSQL
// ===============================
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("<h3 style='color:red;'>❌ Database connection failed: " . pg_last_error() . "</h3>");
}

// ===============================
// Collect and sanitize input
// ===============================
$name    = htmlspecialchars(trim($_POST['name'] ?? ''));
$email   = htmlspecialchars(trim($_POST['email'] ?? ''));
$phone   = htmlspecialchars(trim($_POST['phone'] ?? ''));
$service = htmlspecialchars(trim($_POST['service'] ?? ''));
$message = htmlspecialchars(trim($_POST['message'] ?? ''));

// ===============================
// Validate required fields
// ===============================
if (empty($name) || empty($email) || empty($phone) || empty($service) || empty($message)) {
    echo "<h3 style='color:orange;'>⚠️ Please fill in all required fields.</h3>";
    exit;
}

// Basic email format check
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<h3 style='color:orange;'>⚠️ Invalid email format.</h3>";
    exit;
}

// ===============================
// Insert data securely
// ===============================
$query = "INSERT INTO public.quote_requests (name, email, phone, service, message)
          VALUES ($1, $2, $3, $4, $5)";

$result = pg_query_params($conn, $query, [$name, $email, $phone, $service, $message]);

if ($result) {
    echo "<h3 style='color:green;'>✅ Thank you, $name! Your quote request has been submitted successfully.</h3>";
} else {
    echo "<h3 style='color:red;'>❌ Insert failed: " . pg_last_error($conn) . "</h3>";
}

// ===============================
// Close connection
// ===============================
pg_close($conn);
?>
