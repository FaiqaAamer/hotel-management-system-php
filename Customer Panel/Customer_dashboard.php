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

<section class="hero-section text-light d-flex flex-column" style="background: url('../Assets/Hotel1.jpg') no-repeat center center/cover; height: 100vh; position: relative;">
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
    <h1 class="display-4 fw-bold">Welcome to Grand Palace</h1>
    <p class="lead mb-4">Your personalized dashboard to manage bookings and explore rooms.</p>
  </div>
</section>


<!-- Cards Section -->
<section class="py-5">
  <div class="container">
    <div class="row g-4">

      <!-- Browse Rooms: whole card with two halves -->
      <div class="col-md-12">
        <div class="card">
          <div class="row g-0 align-items-center">
            <!-- Left half: image -->
            <div class="col-md-6">
              <img src="../Assets/RoomEx.webp" alt="Rooms" class="img-fluid rounded-start">
            </div>
            <!-- Right half: text + button -->
            <div class="col-md-6 text-center">
              <div class="card-body">
                <h5 class="card-title">Browse Rooms</h5>
                <p class="card-text">Explore all available rooms with details and pricing.</p>
                <a href="../Customer Panel/Rooms.php" class="btn btn-gold">Go to Rooms</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 mx-auto">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">My Reservations</h5>
            <p class="card-text">View your reservation history and manage bookings.</p>
            <a href="../Customer Panel/Reservations.php" class="btn btn-gold">View Reservations</a>
          </div>
        </div>
      </div>

      <!-- Logout: smaller card, centered -->
      <div class="col-md-12 mx-auto">
        <div class="card text-center">
          <div class="card-body">
            <h5 class="card-title">Logout</h5>
            <p class="card-text">Securely log out of your account.</p>
            <a href="#" class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#logoutModal">
  Logout
</a>
          </div>
        </div>
      </div>

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

<!-- Footer -->
<footer class="bg-dark text-light text-center py-3 mt-5" style="background-color: #2C2C2C; color: aliceblue;">
  <p class="mb-0">&copy; 2026 Grand Palace Hotel · All rights reserved</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
