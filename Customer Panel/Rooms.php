<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit();
}
?>





<?php
include "../db.php";

$sql = "SELECT * FROM rooms";
$result = mysqli_query($conn, $sql);
?>
































<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/Customer.css">
</head>
<body>

<section class="hero-section text-light d-flex flex-column" style="background: url('../Assets/Hotel3.webp') no-repeat center center/cover; height: 100vh; position: relative;">
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
    <h1 class="display-4 fw-bold">Browse our Rooms</h1>
    <p class="lead mb-4">Book your room according to your choice.</p>
  </div>
</section>





<section class="py-5">
  <div class="container">

    <h2 class="text-center mb-5">Available Rooms</h2>

    <div class="row g-4">

      <?php while($row = mysqli_fetch_assoc($result)) { ?>

        <div class="col-md-4">
          <div class="card h-100">

            <img src="../Assets/SRoom3.jpg" class="card-img-top" alt="Room">

            <div class="card-body text-center">

              <h5 class="card-title">
                Room No: <?php echo $row['roomNo']; ?>
              </h5>

              <p class="card-text">
                Type: <?php echo $row['roomType']; ?>
              </p>

              <p class="fw-bold">
                <?php echo $row['pricePerNight']; ?> / night
              </p>

              <p>
                Status:
                <?php if($row['status'] == 'available') { ?>
                  <span class="text-success">Available</span>
                <?php } else { ?>
                  <span class="text-danger">Booked</span>
                <?php } ?>
              </p>

              <?php if($row['status'] == 'available') { ?>

  <a href="#"
     class="btn btn-gold"
     data-bs-toggle="modal"
     data-bs-target="#bookingModal"
     data-room="<?php echo $row['roomID']; ?>">
     Book Now
  </a>

<?php } else { ?>

  <button class="btn btn-secondary" disabled>
    Booked
  </button>

<?php } ?>

            </div>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>
</section>







<!-- Booking Confirmation Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="bookingModalLabel">Book Your Stay</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form action="book.php" method="POST">
          <!-- Hidden room field -->
          <input type="hidden" name="room" id="roomInput">

          <div class="mb-3">
            <label class="form-label">Check In</label>
            <input type="date" class="form-control" name="check_in" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Check Out</label>
            <input type="date" class="form-control" name="check_out" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Adults</label>
            <select class="form-select" name="adults" required>
              <option value="1">1 adult</option>
              <option value="2">2 adults</option>
              <option value="3">3 adults</option>
              <option value="4">4 adults</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Children</label>
            <select class="form-select" name="children" required>
              <option value="0">0 child</option>
              <option value="1">1 child</option>
              <option value="2">2 children</option>
              <option value="3">3 children</option>
            </select>
          </div>
<br>
          <button type="submit" class="btn btn-gold w-100">Confirm Booking</button><br>
        </form>
      </div>
    </div>
  </div>
</div>

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

<!-- Footer -->
<footer class="bg-dark text-light text-center py-3 mt-5" style="background-color: #2C2C2C; color: aliceblue;">
  <p class="mb-0">&copy; 2026 Grand Palace Hotel · All rights reserved</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
var bookingModal = document.getElementById('bookingModal')

bookingModal.addEventListener('show.bs.modal', function (event) {
  var button = event.relatedTarget
  var roomId = button.getAttribute('data-room')

  document.getElementById('roomInput').value = roomId
})
</script>
</body>
</html>
