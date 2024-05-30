<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pages / Register </title>
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
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post">
                    <div class="col-12">
                      <label for="yourName" class="form-label">Full Name</label>
                      <input type="text" name="fname" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>
                    
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Admission Number</label>
                      <div class="input-group has-validation">
                        <input type="text" name="adm" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your Admission number.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourDep" class="form-label">Department</label>
                      <select name="department" class="form-control" id="yourDep" required onchange="populateCourses(this.value)">
                        <option value="">Select Department</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="TV/Radio Program Production">TV/Radio Program Production</option>
                        <option value="Film/Video Program Production">Film/Video Program Production</option>
                        <option value="Engineering">Engineering Training</option>

                      </select>
                      <div class="invalid-feedback">Please, select your department</div>
                    </div>

                    <div class="col-12">
                      <label for="yourCourse" class="form-label">Course</label>
                      <select name="course" class="form-control" id="yourCourse" required>
                        <option value="">Select Course</option>
                        <!-- Options will be dynamically populated based on department selection -->
                      </select>
                      <div class="invalid-feedback">Please, select your course!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>


                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="index.php">Log in</a></p>
                    </div>

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
                      // Check if the email is already taken
                          $check_query = "SELECT * FROM `stud` WHERE `Email` = '$email'";
                          $check_result = mysqli_query($connect, $check_query);

                          if(mysqli_num_rows($check_result) > 0) {
                              // Email already exists, show error message
                              echo '<script>alert("Email already taken. Please choose a different email address.");</script>';
                          } else {
                              // Email is not taken, proceed with registration
                              $q = "INSERT INTO `stud` (`id`, `Name`, `ADM No`, `Department`, `Course`, `Email`, `Password`) VALUES (NULL, '$name', '$adm', '$dep', '$course', '$email', '$pass')";
                              $e = mysqli_query($connect,$q);

                              // Redirect to login page after successful registration
                              header("Location:index.php");
                          }
                      }
                      ?>
                  </form>

                </div>
              </div>

              <div class="credits">
                Developed by <a href="mailto:arnoldjoshua78@gmail.com">Arnold Joshua</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/main.js"></script>

  <script>
    function populateCourses(department) {
      var courseSelect = document.getElementById("yourCourse");
      courseSelect.innerHTML = "";

      if (department === "Information Technology") {
        var options = ["Select Course", "Broadcast Journalism", "Advertising and Public Relations", "Journalism"];
      } else if (department === "TV/Radio Program Production") {
        var options = ["Select Course", "TV Production", " Radio Production"];
      } else if (department === "Film/Video Program Production") {
        var options = ["Select Course", "Production & Directing option", "Editing option", "Camera option", "Sound option", "Animation & Graphic Design"];
      } else if (department === "Engineering") {
        var options = ["Select Course", "Graphics and Web Design", "Instrument Option ", "Telecommunication Option", "Media Technology"];
      }
      else {
        var options = ["Select Course"];
      }

      options.forEach(function(option) {
        var opt = document.createElement("option");
        opt.value = option;
        opt.textContent = option;
        courseSelect.appendChild(opt);
      });
    }
  </script>

</body>

</html>
