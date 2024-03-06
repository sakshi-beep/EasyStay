<?php
$id = $_GET['id'];
$cn = mysqli_connect("localhost","root","","kimc");
$dlt = "DELETE FROM `rooms` WHERE id='$id'";

mysqli_query($cn,$dlt);

header("Location:booked_rooms.php");

?>