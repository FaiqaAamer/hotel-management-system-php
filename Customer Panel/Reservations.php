<!-- <?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
?> -->











<?php
include "../db.php";
$userID = $_SESSION['userID'];

$sql = "
SELECT r.reservationID, r.checkInDate, r.checkOutDate, r.reservationStatus,
       rm.roomNo, rm.roomType
FROM reservations r
JOIN rooms rm ON r.roomID = rm.roomID
WHERE r.userID = $userID
";

$result = mysqli_query($conn, $sql);
?>









<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Reservations</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/Customer.css">
</head>
<body>

<section class="hero-section text-light d-flex flex-column" style="background: url('../Assets/Hotel2.webp') no-repeat center center/cover; height: 100vh; position: relative;">
  <nav class="navbar navbar-expand-lg navbar-dark bg-transparent">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold" href="#">Grand Palace Hotel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="../Customer Panel/Rooms.php">Browse Rooms</a></li>
          <li class="nav-item"><a class="nav-link" href="../Customer Panel/Reservations.php">My Reservations</a></li>
          <li class="nav-item">
  <a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
    Logout
  </a>
</li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Overlay for readability -->
  <div class="hero-overlay"></div>

  <!-- Hero Content -->
  <div class="container text-center hero-content flex-grow-1 d-flex flex-column justify-content-center">
    <h1 class="display-4 fw-bold">See your Reservations</h1>
    <p class="lead mb-4">Check the reservations that you currently have.</p>
  </div>
</section>

  <!-- Reservations Section -->
<section class="py-5">
  <div class="container">
    <h2 class="text-center mb-5">My Reservations</h2>

    <div class="row g-4">

      <?php if(mysqli_num_rows($result) > 0) { ?>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

          <div class="col-md-6">
            <div class="card shadow-lg border-0 h-100">

              <img src="../Assets/SRoom3.jpg" class="card-img-top" alt="Room">

              <div class="card-body">
                <h5 class="card-title">
                  Room No: <?php echo $row['roomNo']; ?>
                </h5>

                <p class="card-text mb-2">
                  <strong>Check-in:</strong> <?php echo $row['checkInDate']; ?> <br>
                  <strong>Check-out:</strong> <?php echo $row['checkOutDate']; ?>
                </p>

                <?php if($row['reservationStatus'] == 'confirmed') { ?>
                  <span class="badge bg-success">Confirmed</span>
                <?php } elseif($row['reservationStatus'] == 'cancelled') { ?>
                  <span class="badge bg-danger">Cancelled</span>
                <?php } else { ?>
                  <span class="badge bg-warning text-dark">Pending</span>
                <?php } ?>

              </div>

              <div class="card-footer bg-transparent d-flex justify-content-between">

                <button class="btn btn-outline-primary btn-sm">View</button>

                <?php if($row['reservationStatus'] == 'confirmed') { ?>
                  <a href="cancel.php?id=<?php echo $row['reservationID']; ?>"
                     class="btn btn-gold btn-sm">
                     Cancel
                  </a>
                <?php } ?>

              </div>

            </div>
          </div>

        <?php } ?>

      <?php } else { ?>

        <div class="alert alert-info text-center w-100">
          No reservations found. 
          <a href="../Customer Panel/Rooms.php">Browse Rooms</a>
        </div>

      <?php } ?>

    </div>
  </div>
</section>


<!-- Logout Confirmation Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="logoutModalLabel">Confirm Logout</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body text-center">
        Are you sure you want to log out?
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a href="../logout.php" class="btn btn-gold">Yes</a>
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="cancelModalLabel">Cancel Booking</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body text-center">
        Are you sure you want to cancel this booking?<br>
        This action cannot be undone.
      </div>

      <div class="modal-footer justify-content-center">
        <button type="button" class="btn btn-outline-gold btn-sm" data-bs-dismiss="modal">No, Keep Booking</button>
        <a href="cancel.php?reservation_id=123" class="btn btn-gold btn-sm">Yes, Cancel</a>
      </div>

    </div>
  </div>
</div>

  <!-- Footer -->
<footer class="bg-dark text-light text-center py-3 mt-5" style="background-color: #2C2C2C; color: aliceblue;">
  <p class="mb-0">&copy; 2026 Grand Palace Hotel · All rights reserved</p>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
