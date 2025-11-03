<?php
$host = "auth-db1191.hstgr.io"; // 👈 exact hostname from hPanel
$dbname = "u166377717_zoxosolar";
$user = "u166377717_zoxosolar";
$password = "Zilitech@2025"; // 👈 your updated DB password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $service = $_POST['service'] ?? '';
    $message = $_POST['message'] ?? '';

    $sql = "INSERT INTO quote_data (name, email, phone, service, message)
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
