

<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "hotel_management-system";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

/* Total Rooms */
$totalRoomsQuery = "SELECT COUNT(*) AS totalRooms FROM rooms";
$result = mysqli_query($conn, $totalRoomsQuery);
$row = mysqli_fetch_assoc($result);
$totalRooms = $row['totalRooms'];

/* Available Rooms */
$availableQuery = "SELECT COUNT(*) AS availableRooms
                   FROM rooms
                   WHERE status='available'";
$result = mysqli_query($conn, $availableQuery);
$row = mysqli_fetch_assoc($result);
$availableRooms = $row['availableRooms'];

/* Booked Rooms */
$bookedQuery = "SELECT COUNT(*) AS bookedRooms
                FROM rooms
                WHERE status='booked'";
$result = mysqli_query($conn, $bookedQuery);
$row = mysqli_fetch_assoc($result);
$bookedRooms = $row['bookedRooms'];

/* Total Reservations */
$reservationQuery = "SELECT COUNT(*) AS totalReservations
                     FROM reservations";
$result = mysqli_query($conn, $reservationQuery);
$row = mysqli_fetch_assoc($result);
$totalReservations = $row['totalReservations'];

/* Recent Reservations */
$recentQuery = "SELECT *
                FROM reservation_details
                ORDER BY reservationID DESC
                LIMIT 5";

$recentResult = mysqli_query($conn, $recentQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Grand Palace Hotel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Customer.css">
</head>

<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-gold border-bottom">
    <div class="container-fluid">
        <a class="navbar-brand fw-semibold fs-3" href="#">Grand Palace Hotel</a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item me-4">
                    <a class="nav-link active"
                       href="Admin_Dashboard.php"
                       style="padding-right:100px;">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item me-4">
                    <a class="nav-link"
                       href="Manage_room.php"
                       style="padding-right:100px; padding-left:50px;">
                        Manage Rooms
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger"
                       href="#"
                       data-bs-toggle="modal"
                       data-bs-target="#logoutModal"
                       style="padding-left:50px;">
                        Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="container mt-5">

    <h2 class="fw-bold mb-4">Admin Dashboard</h2>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Total Rooms</h5>
                    <p class="fs-4 mb-0"><?php echo $totalRooms; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Available Rooms</h5>
                    <p class="fs-4 mb-0"><?php echo $availableRooms; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Booked Rooms</h5>
                    <p class="fs-4 mb-0"><?php echo $bookedRooms; ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">Total Reservations</h5>
                    <p class="fs-4 mb-0"><?php echo $totalReservations; ?></p>
                </div>
            </div>
        </div>

    </div>




    <!-- Recent Reservations -->
    <h3 class="fw-bold mb-3">Recent Reservations</h3>

    <div class="table-responsive">
        <table class="table table-striped align-middle">

            <thead class="table-dark">
    <tr>
        <th>Customer</th>
        <th>Room</th>
        <th>Check In</th>
        <th>Check Out</th>
        <th>Status</th>
    </tr>
</thead>

            <tbody>

            <?php
            while ($row = mysqli_fetch_assoc($recentResult))
            {
            ?>
                <tr>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['roomNo']; ?></td>
    <td><?php echo $row['checkInDate']; ?></td>
    <td><?php echo $row['checkOutDate']; ?></td>
    <td><?php echo ucfirst($row['reservationStatus']); ?></td>
</tr>
            <?php
            }
            ?>

            </tbody>

        </table>
    </div>

</div>




<!-- Logout Modal -->
<div class="modal fade"
     id="logoutModal"
     tabindex="-1"
     aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">
                    Confirm Logout
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                </button>
            </div>

            <div class="modal-body text-center">
                Are you sure you want to log out?
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <a href="../logout.php"
                   class="btn btn-warning">
                    Yes
                </a>
            </div>

        </div>
    </div>

</div>

<footer class="bg-dark text-light text-center py-3 mt-5">
    <p class="mb-0">
        &copy; 2026 Grand Palace Hotel · All rights reserved
    </p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>