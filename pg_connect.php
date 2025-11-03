<?php
$conn = pg_connect("host=82.112.226.186 port=5432 dbname=mydb user=myuser password=mypassword");

if ($conn) {
    echo "✅ Connected to PostgreSQL successfully!";
} else {
    echo "❌ Connection failed: " . pg_last_error();
}
?>
