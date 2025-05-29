<?php

require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

// require('inc/paytm/config_paytm.php');
// require('inc/paytm/encdec_paytm.php');

date_default_timezone_set("Asia/Kathmandu");

session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
  redirect('index.php');
}

if (isset($_POST['pay_now'])) {
  header("Pragma: no-cache");
  header("Cache-Control: no-cache");
  header("Expires: 0");

  $checkSum = "";

  $ORDER_ID = 'ORD_' . $_SESSION['uId'] . random_int(11111, 9999999);
  $CUST_ID = $_SESSION['uId'];
  $TXN_AMOUNT = $_SESSION['room']['payment'];



  // Create an array having all required parameters for creating checksum.



  //Here checksum string will return by getChecksumFromArray() function.

  // Insert payment data into database

  $frm_data = filteration($_POST);

  $query1 = "INSERT INTO `booking_order`(`user_id`, `room_id`, `check_in`, `check_out`,`order_id`, `trans_amt`) VALUES (?,?,?,?,?, ?)";


  insert($query1, [
    $CUST_ID,
    $_SESSION['room']['id'],
    $frm_data['checkin'],
    $frm_data['checkout'],
    $ORDER_ID,
    $TXN_AMOUNT
  ], 'isssss');

  $booking_id = mysqli_insert_id($con);

  $query2 = "INSERT INTO `booking_details`(`booking_id`, `room_name`, `price`, `total_pay`,
      `user_name`, `phonenum`, `address`) VALUES (?,?,?,?,?,?,?)";

// 9800000001 1111 987654

  insert($query2, [


    $booking_id,
    $_SESSION['room']['name'],
    $_SESSION['room']['price'],
    $TXN_AMOUNT,
    $frm_data['name'],
    $frm_data['phonenum'],
    $frm_data['address']
  ], 'issssss');

  $curl = curl_init();
  $data = [
    'return_url' => 'http://localhost/EasyStay/pay_response.php',
    'website_url' => 'http://localhost/EasyStay/',
    'amount' => $TXN_AMOUNT,
    'purchase_order_id' => $ORDER_ID,
    'purchase_order_name' => 'test',
    "payment_preference" => [
      "KHALTI",
    ],
  ];
  curl_setopt_array($curl, [
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
      'Authorization: Key 7869e37d1d084edda4c12696ca589155',
      'Content-Type: application/json',
    ],
  ]);

  $response = json_decode(curl_exec($curl));

  if (isset($response->error_key)) { ?>
    echo "<p>Errror</p>";
  <?php } else {

    header('Location:' . $response->payment_url);
  }
  curl_close($curl);

}

?>