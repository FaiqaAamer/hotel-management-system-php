
<?php
session_start();
include "../db.php";

// 1. Get form data
$roomID = $_POST['room'];
$checkIn = $_POST['check_in'];
$checkOut = $_POST['check_out'];
$adults = $_POST['adults'];
$children = $_POST['children'];

// TEMP USER (we will fix later using login session)
$userID = $_SESSION['userID'];

// 2. Insert booking into reservations table
$sql = "INSERT INTO reservations 
(userID, roomID, checkInDate, checkOutDate, bookingDate, reservationStatus)
VALUES 
('$userID', '$roomID', '$checkIn', '$checkOut', CURDATE(), 'confirmed')";

if (mysqli_query($conn, $sql)) {

    // 3. Update room status
    $update = "UPDATE rooms 
               SET status='booked' 
               WHERE roomID='$roomID'";

    mysqli_query($conn, $update);

    // 4. Redirect back to Rooms page
    echo "<script>
        alert('Booking successful!');
        window.location.href = 'Rooms.php';
    </script>";

} else {
    echo "Error: " . mysqli_error($conn);
}
?>