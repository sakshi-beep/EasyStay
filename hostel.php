<?php
  ob_start();

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
    </header
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
        <a class="nav-link collapsed" href="hostel.php" >
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
      <h1>Room Booking</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Room Booking</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h1 class="card-title">Book your Room</h1>
              <form class="row g-3" method="post">
                <div class="col-md-6">
                  <label for="inputName5" class="form-label">Your Name</label>
                  <input type="text" class="form-control" id="inputName5" value="<?=$reg[1]?>" readonly name="pname">
                </div>
                <div class="col-md-6">
                  <label for="na" class="form-label">Email</label>
                  <input type="text" class="form-control" id="na" value="<?=$reg[5]?>" readonly name="pemail">
                </div>
                <div class="col-md-6">
                  <label for="depart" class="form-label">Adm No.</label>
                  <input type="text" class="form-control" id="depart" value="<?=$reg[2]?>" readonly name="padm">
                </div>
                <div class="col-md-6">
                  <label for="couser1" class="form-label">Course</label>
                  <input type="text" class="form-control" id="couser1" value="<?=$reg[4]?>" readonly name="pcourse">
                </div>
                <div class="col-12">
                <div class="form-group">
                      <label for="mainDropdown">Choose Floor:</label>
                     <!-- Update your select element in HTML -->
                            <select class="form-control" name="pfloor" id="mainDropdown" onchange="toggleSubDropdowns(this)">
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
                      <div class="col-md-4 sub-dropdown" id="subDropdown0">
                        <div class="form-group">
                          <label for="roomSelection">A Room Selection:</label>
                          <select class="form-control" name="room_g" id="roomSelection">
                            
                            <!-- G Floor Rooms -->
                            <optgroup label="AF Rooms">
                              <option value="none">Select an option</option>
                              <option value="AF01" <?php if (isRoomBooked('AF01')) echo 'disabled'; ?>>AF01 - (<?= getRoomBookingCount('AF01') ?>)</option>
                              <option value="AF02" <?php if (isRoomBooked('AF02')) echo 'disabled'; ?>>AF02 - (<?= getRoomBookingCount('AF02') ?>)</option>
                              <option value="AF03" <?php if (isRoomBooked('AF03')) echo 'disabled'; ?>>AF03 - (<?= getRoomBookingCount('AF03') ?>)</option>
                              <option value="AF04" <?php if (isRoomBooked('AF04')) echo 'disabled'; ?>>AF04 - (<?= getRoomBookingCount('AF04') ?>)</option>
                              <option value="AF05" <?php if (isRoomBooked('AF05')) echo 'disabled'; ?>>AF05 - (<?= getRoomBookingCount('AF05') ?>)</option>
                              <option value="AF06" <?php if (isRoomBooked('AF06')) echo 'disabled'; ?>>AF06 - (<?= getRoomBookingCount('AF06') ?>)</option>
                              
                            </optgroup>

                            <!-- AR Rooms -->
                            <optgroup label="AR Rooms">
                              <option value="AR01" <?php if (isRoomBooked('AR01')) echo 'disabled'; ?>>AR01 - (<?= getRoomBookingCount('AR01') ?>)</option>
                              <option value="AR02" <?php if (isRoomBooked('AR02')) echo 'disabled'; ?>>AR02 - (<?= getRoomBookingCount('AR02') ?>)</option>
                              <option value="AR03" <?php if (isRoomBooked('AR03')) echo 'disabled'; ?>>AR03 - (<?= getRoomBookingCount('AR03') ?>)</option>
                              <option value="AR04" <?php if (isRoomBooked('AR04')) echo 'disabled'; ?>>AR04 - (<?= getRoomBookingCount('AR04') ?>)</option>
                              <option value="AR05" <?php if (isRoomBooked('AR05')) echo 'disabled'; ?>>AR05 - (<?= getRoomBookingCount('AR05') ?>)</option>
                              <option value="AR06" <?php if (isRoomBooked('AR06')) echo 'disabled'; ?>>AR06 - (<?= getRoomBookingCount('AR06') ?>)</option>
                              
                            </optgroup>

                            <!-- AL Rooms -->
                            <optgroup label="AL Rooms">
                              <option value="AL01" <?php if (isRoomBooked('AL01')) echo 'disabled'; ?>>AL01 - (<?= getRoomBookingCount('AL01') ?>)</option>
                              <option value="AL02" <?php if (isRoomBooked('AL02')) echo 'disabled'; ?>>AL02 - (<?= getRoomBookingCount('AL02') ?>)</option>
                              <option value="AL03" <?php if (isRoomBooked('AL03')) echo 'disabled'; ?>>AL03 - (<?= getRoomBookingCount('AL03') ?>)</option>
                              <option value="AL04" <?php if (isRoomBooked('AL04')) echo 'disabled'; ?>>AL04 - (<?= getRoomBookingCount('AL04') ?>)</option>
                              <option value="AL05" <?php if (isRoomBooked('AL05')) echo 'disabled'; ?>>AL05 - (<?= getRoomBookingCount('AL05') ?>)</option>
                              <option value="AL06" <?php if (isRoomBooked('AL06')) echo 'disabled'; ?>>AL06 - (<?= getRoomBookingCount('AL06') ?>)</option>
                              
                            </optgroup>
                            
                          </select>
                        </div>
                      </div>


                      <div class="col-md-4 sub-dropdown" id="subDropdown1" style="display: none;">
                        <div class="form-group">
                          <label for="roomSelection">B Room Selection:</label>
                          <select class="form-control" name="room_1" id="roomSelection">
                            
                            <!-- BF Rooms -->
                            <optgroup label="BF Rooms">
                              <option value="none">Select an option</option>
                            <option value="BF01" <?php if (isRoomBooked('BF01')) echo 'disabled'; ?>>BF01 - (<?= getRoomBookingCount('BF01') ?>)</option>
                            <option value="BF02" <?php if (isRoomBooked('BF02')) echo 'disabled'; ?>>BF02 - (<?= getRoomBookingCount('BF02') ?>)</option>
                            <option value="BF03" <?php if (isRoomBooked('BF03')) echo 'disabled'; ?>>BF03 - (<?= getRoomBookingCount('BF03') ?>)</option>
                            <option value="BF04" <?php if (isRoomBooked('BF04')) echo 'disabled'; ?>>BF04 - (<?= getRoomBookingCount('BF04') ?>)</option>
                            <option value="BF05" <?php if (isRoomBooked('BF05')) echo 'disabled'; ?>>BF05 - (<?= getRoomBookingCount('BF05') ?>)</option>
                            <option value="BF06" <?php if (isRoomBooked('BF06')) echo 'disabled'; ?>>BF06 - (<?= getRoomBookingCount('BF06') ?>)</option>
                            
                            </optgroup>
                            <!-- BL Rooms -->
                            <optgroup label="BL Rooms">
                            <option value="BL01" <?php if (isRoomBooked('BL01')) echo 'disabled'; ?>>BL01 - (<?= getRoomBookingCount('BL01') ?>)</option>
                            <option value="BL02" <?php if (isRoomBooked('BL02')) echo 'disabled'; ?>>BL02 - (<?= getRoomBookingCount('BL02') ?>)</option>
                            <option value="BL03" <?php if (isRoomBooked('BL03')) echo 'disabled'; ?>>BL03 - (<?= getRoomBookingCount('BL03') ?>)</option>
                            <option value="BL04" <?php if (isRoomBooked('BL04')) echo 'disabled'; ?>>BL04 - (<?= getRoomBookingCount('BL04') ?>)</option>
                            <option value="BL05" <?php if (isRoomBooked('BL05')) echo 'disabled'; ?>>BL05 - (<?= getRoomBookingCount('BL05') ?>)</option>
                            <option value="BL06" <?php if (isRoomBooked('BL06')) echo 'disabled'; ?>>BL06 - (<?= getRoomBookingCount('BL06') ?>)</option>
                            
                            </optgroup>
                            <!-- BR Floor Rooms -->
                            <optgroup label="BR Rooms">
                            <option value="BR01" <?php if (isRoomBooked('BR01')) echo 'disabled'; ?>>BR01 - (<?= getRoomBookingCount('BR01') ?>)</option>
                            <option value="BR02" <?php if (isRoomBooked('BR02')) echo 'disabled'; ?>>BR02 - (<?= getRoomBookingCount('BR02') ?>)</option>
                            <option value="BR03" <?php if (isRoomBooked('BR03')) echo 'disabled'; ?>>BR03 - (<?= getRoomBookingCount('BR03') ?>)</option>
                            <option value="BR04" <?php if (isRoomBooked('BR04')) echo 'disabled'; ?>>BR04 - (<?= getRoomBookingCount('BR04') ?>)</option>
                            <option value="BR05" <?php if (isRoomBooked('BR05')) echo 'disabled'; ?>>BR05 - (<?= getRoomBookingCount('BR05') ?>)</option>
                            <option value="BR06" <?php if (isRoomBooked('BR06')) echo 'disabled'; ?>>BR06 - (<?= getRoomBookingCount('BR06') ?>)</option>
                            
                            </optgroup>
                          </select>
                        </div>
                      </div>


                      <div class="col-md-4 sub-dropdown" id="subDropdown2" style="display: none;">
                        <div class="form-group">
                          <label for="roomSelection">C Room Selection:</label>
                          <select class="form-control" name="room_2" id="roomSelection">
                            
                            <!-- CF Rooms -->
                            <optgroup label="CF Rooms">
                              <option value="none">Select an option</option>
                            <option value="CF01" <?php if (isRoomBooked('CF01')) echo 'disabled'; ?>>CF01 - (<?= getRoomBookingCount('CF01') ?>)</option>
                            <option value="CF02" <?php if (isRoomBooked('CF02')) echo 'disabled'; ?>>CF02 - (<?= getRoomBookingCount('CF02') ?>)</option>
                            <option value="CF03" <?php if (isRoomBooked('CF03')) echo 'disabled'; ?>>CF03 - (<?= getRoomBookingCount('CF03') ?>)</option>
                            <option value="CF04" <?php if (isRoomBooked('CF04')) echo 'disabled'; ?>>CF04 - (<?= getRoomBookingCount('CF04') ?>)</option>
                            <option value="CF05" <?php if (isRoomBooked('CF05')) echo 'disabled'; ?>>CF05 - (<?= getRoomBookingCount('CF05') ?>)</option>
                            <option value="CF06" <?php if (isRoomBooked('CF06')) echo 'disabled'; ?>>CF06 - (<?= getRoomBookingCount('CF01') ?>)</option>
                            
                            </optgroup>
                            <optgroup label="CL Rooms">
                            <option value="CL01" <?php if (isRoomBooked('CL01')) echo 'disabled'; ?>>CL01 - (<?= getRoomBookingCount('CL01') ?>)</option>
                            <option value="CL02" <?php if (isRoomBooked('CL02')) echo 'disabled'; ?>>CL02 - (<?= getRoomBookingCount('CL02') ?>)</option>
                            <option value="CL03" <?php if (isRoomBooked('CL03')) echo 'disabled'; ?>>CL03 - (<?= getRoomBookingCount('CL03') ?>)</option>
                            <option value="CL04" <?php if (isRoomBooked('CL04')) echo 'disabled'; ?>>CL04 - (<?= getRoomBookingCount('CL04') ?>)</option>
                            <option value="CL05" <?php if (isRoomBooked('CL05')) echo 'disabled'; ?>>CL05 - (<?= getRoomBookingCount('CL05') ?>)</option>
                            <option value="CL06" <?php if (isRoomBooked('CL06')) echo 'disabled'; ?>>CL06 - (<?= getRoomBookingCount('CL06') ?>)</option>
                            
                            </optgroup>

                            <optgroup label="CR Rooms">
                            <option value="CR01" <?php if (isRoomBooked('CR01')) echo 'disabled'; ?>>CR01 - (<?= getRoomBookingCount('CR01') ?>)</option>
                            <option value="CR02" <?php if (isRoomBooked('CR02')) echo 'disabled'; ?>>CR02 - (<?= getRoomBookingCount('CR02') ?>)</option>
                            <option value="CR03" <?php if (isRoomBooked('CR03')) echo 'disabled'; ?>>CR03 - (<?= getRoomBookingCount('CR03') ?>)</option>
                            <option value="CR04" <?php if (isRoomBooked('CR04')) echo 'disabled'; ?>>CR04 - (<?= getRoomBookingCount('CR04') ?>)</option>
                            <option value="CR05" <?php if (isRoomBooked('CR05')) echo 'disabled'; ?>>CR05 - (<?= getRoomBookingCount('CR05') ?>)</option>
                            <option value="CR06" <?php if (isRoomBooked('CR06')) echo 'disabled'; ?>>CR06 - (<?= getRoomBookingCount('CR07') ?>)</option>
                            
                            </optgroup>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 sub-dropdown" id="subDropdown3" style="display: none;">
                        <div class="form-group">
                          <label for="roomSelection">D Room Selection:</label>
                          <select class="form-control" name="room_3" id="roomSelection">
                            
                            <!-- DF Rooms -->
                            <optgroup label="DF Rooms">
                              <option value="none">Select an option</option>
                            <option value="DF01" <?php if (isRoomBooked('DF01')) echo 'disabled'; ?>>DF01 - (<?= getRoomBookingCount('DF01') ?>)</option>
                            <option value="DF02" <?php if (isRoomBooked('DF02')) echo 'disabled'; ?>>DF02 - (<?= getRoomBookingCount('DF02') ?>)</option>
                            <option value="DF03" <?php if (isRoomBooked('DF03')) echo 'disabled'; ?>>DF03 - (<?= getRoomBookingCount('DF03') ?>)</option>
                            <option value="DF04" <?php if (isRoomBooked('DF04')) echo 'disabled'; ?>>DF04 - (<?= getRoomBookingCount('DF04') ?>)</option>
                            <option value="DF05" <?php if (isRoomBooked('DF05')) echo 'disabled'; ?>>DF05 - (<?= getRoomBookingCount('DF05') ?>)</option>
                            <option value="DF06" <?php if (isRoomBooked('DF06')) echo 'disabled'; ?>>DF06 - (<?= getRoomBookingCount('DF06') ?>)</option>
                            
                            </optgroup>

                            <optgroup label="DL Rooms">
                            <option value="DL01" <?php if (isRoomBooked('DL01')) echo 'disabled'; ?>>DL01 - (<?= getRoomBookingCount('DL01') ?>)</option>
                            <option value="DL02" <?php if (isRoomBooked('DL02')) echo 'disabled'; ?>>DL02 - (<?= getRoomBookingCount('DL02') ?>)</option>
                            <option value="DL03" <?php if (isRoomBooked('DL03')) echo 'disabled'; ?>>DL03 - (<?= getRoomBookingCount('DL03') ?>)</option>
                            <option value="DL04" <?php if (isRoomBooked('DL04')) echo 'disabled'; ?>>DL04 - (<?= getRoomBookingCount('DL04') ?>)</option>
                            <option value="DL05" <?php if (isRoomBooked('DL05')) echo 'disabled'; ?>>DL05 - (<?= getRoomBookingCount('DL05') ?>)</option>
                            <option value="DL06" <?php if (isRoomBooked('DL06')) echo 'disabled'; ?>>DL06 - (<?= getRoomBookingCount('DL06') ?>)</option>
                          
                            </optgroup>

                            <optgroup label="DR Rooms">
                            <option value="DL01" <?php if (isRoomBooked('DL01')) echo 'disabled'; ?>>DL01 - (<?= getRoomBookingCount('DL01') ?>)</option>
                            <option value="DL02" <?php if (isRoomBooked('DL02')) echo 'disabled'; ?>>DL02 - (<?= getRoomBookingCount('DL02') ?>)</option>
                            <option value="DL03" <?php if (isRoomBooked('DL03')) echo 'disabled'; ?>>DL03 - (<?= getRoomBookingCount('DL03') ?>)</option>
                            <option value="DL04" <?php if (isRoomBooked('DL04')) echo 'disabled'; ?>>DL04 - (<?= getRoomBookingCount('DL04') ?>)</option>
                            <option value="DL05" <?php if (isRoomBooked('DL05')) echo 'disabled'; ?>>DL05 - (<?= getRoomBookingCount('DL05') ?>)</option>
                            <option value="DL06" <?php if (isRoomBooked('DL06')) echo 'disabled'; ?>>DL06 - (<?= getRoomBookingCount('DL06') ?>)</option>
                            
                            </optgroup>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-4 sub-dropdown" id="subDropdown4" style="display: none;">
                        <div class="form-group">
                          <label for="roomSelection">E Room Selection:</label>
                          <select class="form-control" name="room_4" id="roomSelection">
                            
                            <!-- EF Rooms -->
                            <optgroup label="EF Rooms">
                              <option value="none">Select an option</option>
                            <option value="EF01" <?php if (isRoomBooked('EF01')) echo 'disabled'; ?>>EF01 - (<?= getRoomBookingCount('EF01') ?>)</option>
                            <option value="EF02" <?php if (isRoomBooked('EF02')) echo 'disabled'; ?>>EF02 - (<?= getRoomBookingCount('EF02') ?>)</option>
                            <option value="EF03" <?php if (isRoomBooked('EF03')) echo 'disabled'; ?>>EF03 - (<?= getRoomBookingCount('EF03') ?>)</option>
                            <option value="EF04" <?php if (isRoomBooked('EF04')) echo 'disabled'; ?>>EF04 - (<?= getRoomBookingCount('EF04') ?>)</option>
                            <option value="EF05" <?php if (isRoomBooked('EF05')) echo 'disabled'; ?>>EF05 - (<?= getRoomBookingCount('EF05') ?>)</option>
                            <option value="EF06" <?php if (isRoomBooked('EF06')) echo 'disabled'; ?>>EF06 - (<?= getRoomBookingCount('EF06') ?>)</option>
                            
                            </optgroup>

                            <optgroup label="EL Rooms">
                            <option value="EL01" <?php if (isRoomBooked('EL01')) echo 'disabled'; ?>>EL01 - (<?= getRoomBookingCount('EL01') ?>)</option>
                            <option value="EL02" <?php if (isRoomBooked('EL02')) echo 'disabled'; ?>>EL02 - (<?= getRoomBookingCount('EL02') ?>)</option>
                            <option value="EL03" <?php if (isRoomBooked('EL03')) echo 'disabled'; ?>>EL03 - (<?= getRoomBookingCount('EL03') ?>)</option>
                            <option value="EL04" <?php if (isRoomBooked('EL04')) echo 'disabled'; ?>>EL04 - (<?= getRoomBookingCount('EL04') ?>)</option>
                            <option value="EL05" <?php if (isRoomBooked('EL05')) echo 'disabled'; ?>>EL05 - (<?= getRoomBookingCount('EL05') ?>)</option>
                            <option value="EL06" <?php if (isRoomBooked('EL06')) echo 'disabled'; ?>>EL06 - (<?= getRoomBookingCount('EL06') ?>)</option>
                          
                            </optgroup>

                            <optgroup label="ER Rooms">
                            <option value="ER01" <?php if (isRoomBooked('ER01')) echo 'disabled'; ?>>ER01 - (<?= getRoomBookingCount('ER01') ?>)</option>
                            <option value="ER02" <?php if (isRoomBooked('ER02')) echo 'disabled'; ?>>ER02 - (<?= getRoomBookingCount('ER02') ?>)</option>
                            <option value="ER03" <?php if (isRoomBooked('ER03')) echo 'disabled'; ?>>ER03 - (<?= getRoomBookingCount('ER03') ?>)</option>
                            <option value="ER04" <?php if (isRoomBooked('ER04')) echo 'disabled'; ?>>ER04 - (<?= getRoomBookingCount('ER04') ?>)</option>
                            <option value="ER05" <?php if (isRoomBooked('ER05')) echo 'disabled'; ?>>ER05 - (<?= getRoomBookingCount('ER05') ?>)</option>
                            <option value="EF06" <?php if (isRoomBooked('EF06')) echo 'disabled'; ?>>EF06 - (<?= getRoomBookingCount('EF06') ?>)</option>
                            
                            </optgroup>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" name="submitroom">Book Room</button>
                </div>
                <br>
              </form>
            </div>
          </div>
      </div>
    </section>

  </main><!-- End #main -->
  <?php

  function isRoomBooked($room) {
      $c = mysqli_connect("localhost", "root", "", "kimc");
      $query = "SELECT COUNT(*) as count FROM `rooms` WHERE `Room` = '$room'";
      $result = mysqli_query($c, $query);
      $row = mysqli_fetch_assoc($result);
      return $row['count'] >= 4;
    }


  if (isset($_POST['submitroom'])){
    $fname = $_POST['pname'];
    $email = $_POST['pemail'];
    $admno = $_POST['padm'];
    $course = $_POST['pcourse'];
    $floor = $_POST['pfloor'];

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

    // Check if the user has already booked a room
    $checkBookingQuery = "SELECT * FROM `rooms` WHERE `Email`='$email'";
    $checkBookingResult = mysqli_query($conn, $checkBookingQuery);

    // echo "$fname, $dep, $course, $floor, $room,  $admno";
    if (mysqli_num_rows($checkBookingResult) > 0) {
        // User has already booked a room
        echo '<script>
            Swal.fire({
                title: "Already Booked!",
                text: "You have already booked a room. You cannot book another one.",
                icon: "error",
                confirmButtonText: "OK"
            });
        </script>';
    } else {

    $co = mysqli_connect("localhost","root","","kimc");

    $tu = $co->prepare("INSERT INTO `rooms`(`id`, `Name`, `Email`, `Adm`, `Course`, `Floor`, `Room`) VALUES (NULL, ?, ?, ?, ?, ?, ?)");
    $tu->bind_param("ssssss", $fname, $email, $admno, $course, $floor, $room);
    $tu->execute();

    // Trigger SweetAlert after successfully booking the room
    echo '<script>
        Swal.fire({
            title: "Room Booked!",
            text: "Your room has been successfully booked.",
            icon: "success",
            confirmButtonText: "OK"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "booked_rooms.php"; // Redirect to booked_rooms.php
            }
        });
    </script>';
      }

  }
  function getRoomBookingCount($room) {
      $c = mysqli_connect("localhost", "root", "", "kimc");
      $query = "SELECT COUNT(*) as count FROM `rooms` WHERE `Room` = '$room'";
      $result = mysqli_query($c, $query);
      $row = mysqli_fetch_assoc($result);
      return $row['count'];
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
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
 
  </script>

</body>

</html>