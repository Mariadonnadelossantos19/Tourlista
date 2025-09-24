<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Check if the query parameter is provided
if (!isset($_GET['q']) || empty($_GET['q'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Query parameter "q" is required']);
    exit();
}

$query = urlencode($_GET['q']);
$limit = isset($_GET['limit']) ? intval($_GET['limit']) : 1;

// Construct the Nominatim API URL
$url = "https://nominatim.openstreetmap.org/search?format=json&q={$query}&limit={$limit}";

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'TourLista/1.0 (https://localhost)'); // Required by Nominatim
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json'
]);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

// Execute the request
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Handle cURL errors
if ($error) {
    http_response_code(500);
    echo json_encode(['error' => 'Request failed: ' . $error]);
    exit();
}

// Handle HTTP errors
if ($httpCode !== 200) {
    http_response_code($httpCode);
    echo json_encode(['error' => 'Nominatim API returned HTTP ' . $httpCode]);
    exit();
}

// Return the response
echo $response;
?>
