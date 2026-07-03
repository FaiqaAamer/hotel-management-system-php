<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] != 'admin') {
    header("Location: ../login.php");
    exit();
}

$host = "localhost";
$user = "root";
$password = "";
$database = "hotel_management_system";
?>


<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "hotel_management-system";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$editMode = false;
$roomID = "";
$roomNo = "";
$roomType = "";
$pricePerNight = "";
$status = "";


if(isset($_GET['delete']))
{
    $roomID = $_GET['delete'];

    $deleteQuery = "
    DELETE FROM rooms
    WHERE roomID = $roomID
    ";

    mysqli_query($conn, $deleteQuery);

    header("Location: Manage_room.php");
    exit();
}


if(isset($_POST['addRoom']))
{

// echo "Form Submitted";


    $roomNo = $_POST['roomNo'];
    $roomType = $_POST['roomType'];
    $pricePerNight = $_POST['pricePerNight'];
    $status = $_POST['status'];

    // Generate next roomID
    $idQuery = "SELECT MAX(roomID) AS maxID FROM rooms";
    $idResult = mysqli_query($conn, $idQuery);
    $idRow = mysqli_fetch_assoc($idResult);

    $newRoomID = $idRow['maxID'] + 1;

    $insertQuery = "
    INSERT INTO rooms
    (roomID, roomNo, roomType, status, pricePerNight)
    VALUES
    ($newRoomID, $roomNo, '$roomType', '$status', $pricePerNight)
    ";

    if(mysqli_query($conn, $insertQuery))
    {
        echo "<script>alert('Room Added Successfully');</script>";
        echo "<script>window.location='Manage_room.php';</script>";
    }
    else
    {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_POST['updateRoom']))
{
    $roomID = $_POST['roomID'];
    $roomNo = $_POST['roomNo'];
    $roomType = $_POST['roomType'];
    $pricePerNight = $_POST['pricePerNight'];
    $status = $_POST['status'];

    $updateQuery = "
    UPDATE rooms
    SET
        roomNo = '$roomNo',
        roomType = '$roomType',
        status = '$status',
        pricePerNight = '$pricePerNight'
    WHERE roomID = '$roomID'
    ";

    mysqli_query($conn,$updateQuery);

    header("Location: Manage_room.php");
    exit();
}


if(isset($_GET['edit']))
{
    $editMode = true;

    $roomID = $_GET['edit'];

    $editQuery = "
    SELECT *
    FROM rooms
    WHERE roomID = $roomID
    ";

    $editResult = mysqli_query($conn,$editQuery);

    $row = mysqli_fetch_assoc($editResult);

    $roomNo = $row['roomNo'];
    $roomType = $row['roomType'];
    $pricePerNight = $row['pricePerNight'];
    $status = $row['status'];
}

/* Get all rooms */
$roomsQuery = "SELECT * FROM rooms";
$roomsResult = mysqli_query($conn, $roomsQuery);

/* Get only confirmed reservations */
$reservationQuery = "
SELECT
    reservationID,
    name,
    roomNo,
    checkInDate,
    checkOutDate,
    reservationStatus
FROM reservation_details
WHERE reservationStatus='confirmed'
";

$reservationResult = mysqli_query($conn, $reservationQuery);

?>













<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Rooms - Grand Horizon Hotel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/Customer.css">
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-gold border-bottom">
    <div class="container-fluid">
      <a class="navbar-brand fw-semibold fs-3" href="#">Grand Palace Hotel</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
              data-bs-target="#adminNav" aria-controls="adminNav" aria-expanded="false" 
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="adminNav">
        <ul class="navbar-nav mx-auto">
          <li class="nav-item me-4"><a class="nav-link active" href="../Admin Panel/Admin_Dashboard.php" style="padding-right: 100px;">Dashboard</a></li>
          <li class="nav-item me-4"><a class="nav-link" href="../Admin Panel/Manage_room.php " style="padding-right: 100px; padding-left: 50px;">Manage Rooms</a></li>
          <li class="nav-item">
  <a class="nav-link text-danger" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal" style="padding-left: 50px;">
    Logout
  </a>
</li>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container mt-5">
    <h2 class="fw-bold mb-4">Manage Rooms</h2>








<form method="POST">
<input type="hidden"
       name="roomID"
       value="<?php echo $roomID; ?>">


  <div class="mb-3">
    <label class="form-label">Room Number</label>
    <input type="number" name="roomNo" class="form-control" value="<?php echo $roomNo; ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Room Type</label>
    <select name="roomType" class="form-select">

<option value="single"
<?php if($roomType=="single") echo "selected"; ?>>
Single
</option>

<option value="double"
<?php if($roomType=="double") echo "selected"; ?>>
Double
</option>

<option value="deluxe"
<?php if($roomType=="deluxe") echo "selected"; ?>>
Deluxe
</option>

<option value="suite"
<?php if($roomType=="suite") echo "selected"; ?>>
Suite
</option>

</select>
  </div>

  <div class="mb-3">
    <label class="form-label">Price Per Night</label>
    <input type="number" name="pricePerNight" class="form-control"  value="<?php echo $pricePerNight; ?>" required>
  </div>

  <div class="mb-3">
    <label class="form-label">Status</label>
    <select name="status" class="form-select">

<option value="available"
<?php if($status=="available") echo "selected"; ?>>
Available
</option>

<option value="booked"
<?php if($status=="booked") echo "selected"; ?>>
Booked
</option>

</select>
  </div>

  <?php if($editMode){ ?>

<button type="submit"
        name="updateRoom"
        class="btn btn-success">
    Update Room
</button>

<?php } else { ?>

<button type="submit"
        name="addRoom"
        class="btn btn-gold">
    Add Room
</button>

<?php } ?>

</form>











    <!-- View Rooms Table -->
    <h3 class="fw-bold mb-3">View Rooms</h3>
    <div class="table-responsive mb-5">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Room No</th>
            <th>Type</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

<?php
while($row = mysqli_fetch_assoc($roomsResult))
{
?>
<tr>
    <td><?php echo $row['roomNo']; ?></td>
    <td><?php echo ucfirst($row['roomType']); ?></td>
    <td><?php echo $row['pricePerNight']; ?></td>
    <td><?php echo ucfirst($row['status']); ?></td>

    <td>

    <!-- <button class="btn btn-gold btn-sm">
        Edit
    </button> -->
    <a href="Manage_room.php?edit=<?php echo $row['roomID']; ?>"
   class="btn btn-gold btn-sm">
   Edit
</a>

    <span style="padding-right:10px;"></span>

    <a href="Manage_room.php?delete=<?php echo $row['roomID']; ?>"
       class="btn btn-red btn-sm"
       onclick="return confirm('Delete this room?')">
        Delete
    </a>

</td>
</tr>
<?php
}
?>

</tbody>
      </table>
    </div>

    <!-- Optional Reservations Section -->
    <h3 class="fw-bold mb-3">Reservations</h3>
    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>Reservation ID</th>
            <th>Customer Name</th>
            <th>Room Number</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Status</th>
          </tr>
        </thead>
        
        <tbody>

<?php
while($row = mysqli_fetch_assoc($reservationResult))
{
?>
<tr>
    <td><?php echo $row['reservationID']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['roomNo']; ?></td>
    <td><?php echo $row['checkInDate']; ?></td>
    <td><?php echo $row['checkOutDate']; ?></td>

    <td>
        <span class="badge bg-success">
            <?php echo ucfirst($row['reservationStatus']); ?>
        </span>
    </td>
</tr>
<?php
}
?>

</tbody>
      </table>
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

    <footer class="bg-dark text-light text-center py-3 mt-5" style="background-color: #2C2C2C; color: aliceblue;">
  <p class="mb-0">&copy; 2026 Grand Palace Hotel · All rights reserved</p>
</footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
