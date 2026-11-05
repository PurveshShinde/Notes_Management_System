<?php
/**
 * Background Keep-Alive Daemon
 * 
 * Periodically issues HTTP GET requests to the external application URL
 * to prevent the hosting platform (e.g., Render free tier) from sleeping
 * after 15 minutes of inactivity.
 * 
 * Interval: 8 minutes (480 seconds)
 */

declare(ticks = 1);

$targetUrl = getenv('KEEP_ALIVE_URL') ?: 'https://notes-management-system-beae.onrender.com/ping.php';
$interval = (int)(getenv('KEEP_ALIVE_INTERVAL') ?: 480); // 8 minutes in seconds

// Delay initial execution to allow the web server to bind to port
echo "[" . gmdate('c') . "] [Keep-Alive] Daemon initialized. Waiting 20 seconds for server startup...\n";
sleep(20);

echo "[" . gmdate('c') . "] [Keep-Alive] Starting monitor for: {$targetUrl} (Interval: {$interval}s)\n";

while (true) {
    $timestamp = gmdate('Y-m-d H:i:s') . ' UTC';
    $statusCode = 0;
    $responseTime = 0;
    $start = microtime(true);

    try {
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => $targetUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 25,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_USERAGENT => 'NotesManagementSystem-KeepAlive/1.0'
            ]);
            $response = curl_exec($ch);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            if ($curlError) {
                echo "[{$timestamp}] [Keep-Alive Warning] cURL Notice: {$curlError}\n";
            }
        } else {
            // Fallback for environments without curl extension
            $context = stream_context_create([
                'http' => [
                    'method' => 'GET',
                    'timeout' => 25,
                    'header' => "User-Agent: NotesManagementSystem-KeepAlive/1.0\r\n"
                ],
                'ssl' => [
                    'verify_peer' => true
                ]
            ]);
            $response = @file_get_contents($targetUrl, false, $context);
            if (isset($http_response_header) && count($http_response_header) > 0) {
                if (preg_match('#HTTP/[0-9\.]+\s+([0-9]+)#', $http_response_header[0], $matches)) {
                    $statusCode = (int)$matches[1];
                }
            }
        }

        $responseTime = round((microtime(true) - $start) * 1000, 2);

        if ($statusCode >= 200 && $statusCode < 400) {
            echo "[{$timestamp}] [Keep-Alive Success] {$targetUrl} responded with HTTP {$statusCode} ({$responseTime}ms)\n";
        } else {
            echo "[{$timestamp}] [Keep-Alive Notice] {$targetUrl} returned HTTP {$statusCode} ({$responseTime}ms)\n";
        }
    } catch (Throwable $e) {
        echo "[{$timestamp}] [Keep-Alive Error] " . $e->getMessage() . "\n";
    }

    sleep($interval);
}

