<?php

$connection = mysqli_connect('localhost', 'root', '', 'book_db');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    // Validate input
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $guests = (int)$_POST['guests'];
    $arrivals = mysqli_real_escape_string($connection, $_POST['arrivals']);
    $leaving = mysqli_real_escape_string($connection, $_POST['leaving']);

    // Prepare the SQL statement
    $stmt = mysqli_prepare($connection, "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'ssississ', $name, $email, $phone, $address, $location, $guests, $arrivals, $leaving);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        header('Location: book.html');
        exit();
    } else {
        echo "Error: " . mysqli_error($connection);
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($connection);
?>
