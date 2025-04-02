<?php
// current marketplace de csfloat

$apiKey = 'yFCzvwgXNfyOBjH4qkG9n2Ky1cKkAJGJ'; // Your API Key
$apiUrl = 'https://csfloat.com/api/v1/listings';

// Get query parameters from the request
$params = $_GET;

// Append parameters to the API URL
$queryString = http_build_query($params);
$finalUrl = $apiUrl . '?' . $queryString;

$ch = curl_init($finalUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: ' . $apiKey,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo json_encode(['error' => curl_error($ch)]);
    exit;
}
curl_close($ch);

header('Content-Type: application/json');
echo $response;
?>
