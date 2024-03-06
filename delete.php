<?php
$id = $_GET['id'];
$c = mysqli_connect("localhost","root","","kimc");
$del = "DELETE FROM `stud` WHERE id='$id'";

mysqli_query($c,$del);

header("Location:user_details.php");

?>