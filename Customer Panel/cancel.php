<?php
session_start();



include "../db.php";

$reservationID = $_GET['id'];
$userID = $_SESSION['userID'];

$getRoom = "
SELECT roomID
FROM reservations
WHERE reservationID = '$reservationID'
AND userID = '$userID'
";

$result = mysqli_query($conn, $getRoom);

if(mysqli_num_rows($result) > 0)
{
    $row = mysqli_fetch_assoc($result);
    $roomID = $row['roomID'];

    mysqli_query($conn,"
    UPDATE reservations
    SET reservationStatus='cancelled'
    WHERE reservationID='$reservationID'
    ");

    mysqli_query($conn,"
    UPDATE rooms
    SET status='available'
    WHERE roomID='$roomID'
    ");

    header("Location: Reservations.php");
    exit();
}
else
{
    echo "Reservation not found.";
}
?>