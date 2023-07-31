<?php
// Get the URL to proxy from the query string
$proxy_url = $_GET['url'];

if (empty($proxy_url)) {
    die('Error: Proxy URL not specified.');
}

// Initialize a cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, $proxy_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, false);

// Add any additional headers you want to forward to the remote server
// For example, you can forward the client's User-Agent header to make the proxy look like a regular browser request.
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36',
));

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    die('Error: ' . curl_error($ch));
}

// Close the cURL session
curl_close($ch);

// Attempt to decode the JSON response
$json_data = json_decode($response, true);

// Check if JSON decoding was successful
if ($json_data === null) {
    die('Error: Unable to parse JSON data from the endpoint.');
}

// Set the appropriate Content-Type header for JSON
header('Content-Type: application/json');

// Output the JSON response to the client
echo json_encode($json_data);
