<?php
// Simple test file to verify the Nominatim proxy is working
echo "<h2>Nominatim Proxy Test</h2>";

// Test the proxy
$test_url = "nominatim_proxy.php?q=Marinduque&limit=1";
echo "<p>Testing URL: <code>$test_url</code></p>";

$response = file_get_contents($test_url);
$data = json_decode($response, true);

if ($data && !isset($data['error'])) {
    echo "<p style='color: green;'>✅ Proxy is working correctly!</p>";
    echo "<p>Found location: " . $data[0]['display_name'] . "</p>";
    echo "<p>Coordinates: " . $data[0]['lat'] . ", " . $data[0]['lon'] . "</p>";
} else {
    echo "<p style='color: red;'>❌ Proxy error: " . ($data['error'] ?? 'Unknown error') . "</p>";
}

echo "<p><a href='maps.php'>Go to Maps</a></p>";
?>
