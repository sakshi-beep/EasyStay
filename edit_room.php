<?php

ob_start();
$id=$_GET['id'];
$conn = mysqli_connect("localhost","root","","kimc");
$qrt = "SELECT * FROM `rooms` WHERE id = '$id'";
$exet = mysqli_query($conn,$qrt);
$editroom = mysqli_fetch_array($exet);


?>

<?php

  session_start();
  $femail = $_SESSION['uemail'];
  $fpass = $_SESSION['upass'];

  $conn = mysqli_connect("localhost","root","","kimc");
  $qu = "SELECT * FROM `stud` WHERE email='$femail' AND password='$fpass'";
  $e=mysqli_query($conn,$qu);

  $reg = mysqli_fetch_array($e);
?>

<?php
$t = "SELECT * FROM `profile` WHERE email='$femail'";
$r = mysqli_query($conn,$t);
$profile = mysqli_fetch_array($r);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Page / Room Booking</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/fav.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Sweet alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    <style>
    .sub-dropdown {
      display: block;
    }
  </style>
</head>

<body>
<?php
              $is_admin=($femail=='admin' && $fpass=='2002');
 ?>


    <!-- ======= Header ======= -->
      <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="assets/img/kimc.png" alt="">
                <span class="d-none d-lg-block">KIMC</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <!-- Notification Nav ... -->

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?= $profile[1] ?? 'assets/img/Profile.jpg'?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= $reg[1] ?></span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile" aria-labelledby="userDropdown">
                        <li class="dropdown-header">
                            <h6><?= $reg[1] ?></h6>
                            <span><?= $reg[4] ?></span>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="booked_rooms.php">
              <i class="bi bi-circle"></i><span>Room Allocation</span>
            </a>
          </li>
          <li>
            <a href="user_details.php">
              <i class="bi bi-circle"></i><span>User Details</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="room_booking.php" >
          <i class="bi bi-houses"></i>
          <span>Room Booking</span>
        </a>
      </li><!-- End book room Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="users-profile.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.php">
          <i class="bi bi-envelope"></i>
          <span>Contact</span>
        </a>
      </li><!-- End Contact Page Nav -->


      <?php if($is_admin):?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li>
      <?php endif;?><!-- End Register Page Nav -->



      <li class="nav-item">
        <a class="nav-link collapsed" href="index.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li><!-- End Login Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Room</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Edit Room</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="card-title">Edit Room</h1>
              <form class="row g-3" method="post">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="inputName5" value="<?=$editroom[1]?>" readonly name="fname">
                </div>
                <div class="col-md-6">
                  <label for="na" class="form-label">Email</label>
                  <input type="text" class="form-control" id="na" value="<?=$editroom[2]?>" readonly name="email">
                </div>
                <div class="col-md-6">
                  <label for="depart" class="form-label">Adm No.</label>
                  <input type="text" class="form-control" id="depart" value="<?=$editroom[3]?>" readonly name="adm">
                </div>
                <div class="col-md-6">
                  <label for="couser1" class="form-label">Course</label>
                  <input type="text" class="form-control" id="couser1" value="<?=$editroom[4]?>" readonly name="course">
                </div>
                <div class="col-md-6">
                  <label for="floor" class="form-label">Current Floor</label>
                  <input type="text" class="form-control" id="floor" value="<?=$editroom[5]?>" readonly name="flo">
                </div>
                <div class="col-md-6">
                  <label for="room" class="form-label">Current Room</label>
                  <input type="text" class="form-control" id="room" value="<?=$editroom[6]?>" readonly name="rm">
                </div>
                <div class="col-12">
                <div class="form-group">
                      <label for="mainDropdown">Choose Floor:</label>
                     <!-- Update your select element in HTML -->
                            <select class="form-control" name="floor" id="mainDropdown" onchange="toggleSubDropdowns(this)" >
                              <option value="none">Select an option</option>
                              <option value="0">G Floor</option>
                              <option value="1">1 Floor</option>
                              <option value="2">2 Floor</option>
                              <option value="3">3 Floor</option>
                              <option value="4">4 Floor</option>
                            </select>

                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-4 sub-dropdown" id="subDropdown0" style="display: none;">
                        <div class="form-group">
                          <label for="subDropdown0">G Floor Rooms:</label>
                          <select class="form-control" name="room_g">
                            <option value="none">--Select an option--</option>
                            <option value="AF01" >AF01 </option>
                            <option value="AF02" >AF02 </option>
                            <option value="AF03" >AF03</option>
                            <option value="AF04" >AF04 </option>
                            <option value="AF05" >AF05 </option>
                            <option value="AF06" >AF06 </option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 sub-dropdown" id="subDropdown1" style="display: none;">
                        <div class="form-group">
                          <label for="subDropdown1">1 Floor Rooms:</label>
                          <select class="form-control" name="room_1">
                            <option value="none">--Select an option--</option>
                            <option value="BF01" >BF01 </option>
                            <option value="BF02" >BF02 </option>
                            <option value="BF03" >BF03 </option>
                            <option value="BF04" >BF04 </option>
                            <option value="BF05" >BF05 </option>
                            <option value="BF06">BF06</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 sub-dropdown" id="subDropdown2" style="display: none;">
                        <div class="form-group">
                          <label for="subDropdown2">2 Floor Rooms:</label>
                          <select class="form-control" name="room_2">
                            <option value="none">--Select an option--</option>
                            <option value="CF01" >CF01</option>
                            <option value="CF02" >CF02 </option>
                            <option value="CF03" >CF03 </option>
                            <option value="CF04" >CF04 </option>
                            <option value="CF05" >CF05 </option>
                            <option value="CF06" >CF06 </option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 sub-dropdown" id="subDropdown3" style="display: none;">
                        <div class="form-group">
                          <label for="subDropdown3">3 Floor Rooms:</label>
                          <select class="form-control" name="room_3">
                            <option value="none">--Select an option--</option>
                            <option value="DF01" >DF01 </option>
                            <option value="DF02" >DF02 </option>
                            <option value="DF03">DF03 </option>
                            <option value="DF04" >DF04</option>
                            <option value="DF05" >DF05 </option>
                            <option value="DF06" >DF06</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 sub-dropdown" id="subDropdown4" style="display: none;">
                        <div class="form-group">
                          <label for="subDropdown4">4 Floor Rooms:</label>
                          <select class="form-control" name="room_4">
                            <option value="none">--Select an option--</option>
                            <option value="EF01" >EF01 </option>
                            <option value="EF02" >EF02 </option>
                            <option value="EF03" >EF03 </option>
                            <option value="EF04" >EF04 </option>
                            <option value="EF05" >EF05 </option>
                            <option value="EF06" >EF06 </option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="roomedit">Save Changes</button>
                </div>
                <br>
              </form>
            </div>
          </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php
  if (isset($_POST['roomedit'])){
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $admno = $_POST['adm'];
    $course = $_POST['course'];
    $floor = $_POST['floor'];

        // Choose the correct room based on the selected floor
    switch ($floor) {
        case '0':
            $room = $_POST['room_g'];
            break;
        case '1':
            $room = $_POST['room_1'];
            break;
        case '2':
            $room = $_POST['room_2'];
            break;
        case '3':
            $room = $_POST['room_3'];
            break;
        case '4':
            $room = $_POST['room_4'];
            break;
    }

    $co = mysqli_connect("localhost","root","","kimc");

    // $tu = $co->prepare("INSERT INTO `rooms`(`id`, `Name`, `Email`, `Adm`, `Course`, `Floor`, `Room`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
    // $tu->bind_param("ssssss", $fname, $email, $admno, $course, $floor, $room);
    // $tu->execute();

    $tu = "UPDATE `rooms` SET `Name`='$fname',`Email`='$email',`Adm`='$admno',`Course`='$course',`Floor`='$floor',`Room`='$room' WHERE `id`='$id'";
    $et = mysqli_query($co,$tu);

    //     echo '<script>
    //     Swal.fire({
    //         title: "Room Changed!",
    //         text: "Your room has been successfully changed.",
    //         icon: "success",
    //         confirmButtonText: "OK"
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             window.location.href = "booked_rooms.php"; // Redirect to booked_rooms.php
    //         }
    //     });
    // </script>';

    header("Location:booked_rooms.php");


  }
  ?>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>KIMC</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="mailto:arnoldjoshua78@gmail.com">Arnold Joshua</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Add this script in the head or before the closing body tag -->
<script>
function toggleSubDropdowns(selectElement) {
  var selectedValue = selectElement.value;

  // Hide all sub-dropdowns
  var subDropdowns = document.querySelectorAll('.sub-dropdown');
  subDropdowns.forEach(function(subDropdown) {
    subDropdown.style.display = 'none';
  });

  // Show the selected sub-dropdown
  if (selectedValue !== 'none') {
    var selectedSubDropdown = document.getElementById('subDropdown' + selectedValue);
    if (selectedSubDropdown) {
      selectedSubDropdown.style.display = 'block';
    }
  }
}
</script>



  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
 
  </script>

</body>

</html>