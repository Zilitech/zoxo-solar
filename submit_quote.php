<?php
// Database connection info from Hostinger MySQL
$host = "auth-db1191.hstgr.io";   // 🔹 replace with your actual Hostinger MySQL hostname
$dbname = "u166377717_zoxosolar"; // 🔹 replace with your actual DB name
$user = "u166377717_zoxosolar";        // 🔹 replace with your actual DB username
$password = "Zilitech@2025";    // 🔹 replace with your actual DB password

try {
    // Connect to MySQL on Hostinger
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
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
