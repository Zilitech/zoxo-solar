<?php
// Database connection info from Hostinger PostgreSQL
$host = "postgresql.hostinger.in";   // replace with your actual host
$port = "5432";
$dbname = "your_database_name";
$user = "your_username";
$password = "your_password";

try {
    // Connect to PostgreSQL on Hostinger
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get form data safely
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $service = $_POST['service'] ?? '';
    $message = $_POST['message'] ?? '';

    // Insert into the database
    $sql = "INSERT INTO quote_requests (name, email, phone, service, message)
            VALUES (:name, :email, :phone, :service, :message)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':service' => $service,
        ':message' => $message
    ]);

    echo "<script>alert('Your request has been submitted successfully!'); window.location.href='index.html';</script>";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
