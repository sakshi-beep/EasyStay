<?php

ob_start();
$id=$_GET['id'];
$co = mysqli_connect("localhost","root","","kimc");
$qr = "SELECT * FROM `stud` WHERE id = '$id'";
$exe = mysqli_query($co,$qr);
$edit = mysqli_fetch_array($exe);


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Update Details </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="assets/img/fav.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">


  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">


  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="#" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/kimc.png" alt="">
                  <span class="d-none d-lg-block">KIMC</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Edit Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post" id="updateForm">
                    <div class="col-12">
                      <label for="yourName" class="form-label">Full Name</label>
                      <input type="text" name="fname" class="form-control" id="yourName" required value="<?=$edit[1]?>">
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>
                    
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Admission Number</label>
                      <div class="input-group has-validation">
                        <input type="text" name="adm" class="form-control" id="yourUsername" required value="<?=$edit[2]?>">
                        <div class="invalid-feedback">Please enter your Id number.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourDep" class="form-label">Department</label>
                      <input type="text" name="department" class="form-control" id="yourDep" required value="<?=$edit[3]?>">
                      <div class="invalid-feedback">Please, enter your department</div>
                    </div>

                    <div class="col-12">
                      <label for="yourCourse" class="form-label">Course</label>
                      <input type="text" name="course" class="form-control" id="yourCourse" required value="<?=$edit[4]?>">
                      <div class="invalid-feedback">Please, enter your course!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required value="<?=$edit[5]?>">
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>


                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required value="<?=$edit[6]?>">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit">Update Changes</button>

                    </div>

                  </form>

                </div>
              </div>

              <div class="credits">
                Designed by <a href="mailto:arnoldjoshua78@gmail.com">Arnold Joshua</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>
                        
  <?php
                    if(isset($_POST['submit'])){



                      $name = $_POST['fname'];
                      $adm = $_POST['adm'];
                      $dep = $_POST['department'];
                      $course = $_POST['course'];
                      $email = $_POST['email'];
                      $pass = $_POST['password'];

                      //echo "$name,$adm,$dep,$course,$email,$pass";

                      $connect = mysqli_connect("localhost","root","","kimc");
                      $q = "UPDATE `stud` SET `Name`='$name',`ADM No`='$adm',`Department`='$dep',`Course`='$course',`Email`='$email',`Password`='$pass' WHERE `id`='$id'";
                      $e = mysqli_query($connect,$q);
                      // header("Location:user_details.php");
                    }
                  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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

</body>

</html>