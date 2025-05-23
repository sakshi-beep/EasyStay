<?php
if (isset($_POST['paymentAmount'])) {
    $curl = curl_init();
    $amountInPaisa = $_POST['paymentAmount'];
    $data = [
				'return_url' => 'http://localhost/EasyStay/',
				'website_url' => 'http://localhost/EasyStay/',
				'amount' => $amountInPaisa,
				'purchase_order_id' => 1,
				'purchase_order_name' => 'test',
				"payment_preference" => [
					"KHALTI",
				],
				// 'customer_info' => [
				// 	'name' => $_SESSION['username'],
				// 	'email' => $_SESSION['login'],
				// 	'phone' => '9800000001',
				// ],
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
            // die(print_r($response));
			if (isset($response->error_key)) { ?>
             echo "<p>Errror</p>";
	<?php } else {
        
             echo  $response->payment_url;
				// header('Location:' . $response->payment_url);
			}
			curl_close($curl);
}
