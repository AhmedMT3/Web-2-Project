<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['phone'])) {
  header('Content-Type: application/json');

  $phone = $_POST['phone'];

  $url = "https://whatsapp-number-validator3.p.rapidapi.com/WhatsappNumberHasItWithToken";
  $host = "whatsapp-number-validator3.p.rapidapi.com";
  $api_key = "YOUR_API_KEY"; // Replace with your actual API key

  $curl = curl_init();
  curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode(['phone_number' => $phone]),
    CURLOPT_HTTPHEADER => [
      "Content-Type: application/json",
      "x-rapidapi-host: $host",
      "x-rapidapi-key: $api_key"
    ],
  ]);

  $response = curl_exec($curl);
  $erro = curl_error($curl);
  curl_close($curl);

  if ($erro) {
    echo json_encode(["valid" => false, "msg" => "Could not resolve host address."]);
  } else {
    $data = json_decode($response, true);
    if (isset($data["status"]) && $data["status"] === "valid") {
      echo json_encode(["valid" => true, "msg" => "Valid WhatsApp number."]);
    } else {
      echo json_encode(["valid" => false, "msg" => "Invalid WhatsApp number."]);
    }
  }
}
