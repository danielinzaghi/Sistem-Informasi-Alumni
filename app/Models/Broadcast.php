<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $title = $_POST['name'];
    $phoneNumber = $_POST['phone_number'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $description = $_POST['description'];

    // Format data menjadi "title|phone_number|date|category|desc"
    $formattedData = "$title|$phoneNumber|$date|$category|$description";

    // Tampilkan data yang diformat
    echo "<h2>Data Broadcast:</h2>";
    echo "<p>$formattedData</p>";
} else {
    // Jika bukan metode POST, redirect kembali ke form
    header("Location: form.html"); // Ganti dengan nama file form Anda
}