<?php
/**
 * Lightweight health check probe endpoint.
 * Returns 200 OK without opening database connections.
 */
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
http_response_code(200);

echo json_encode([
    'status' => 'healthy',
    'timestamp' => gmdate('Y-m-d\TH:i:s\Z'),
    'uptime_check' => true,
    'service' => 'Notes Management System'
], JSON_PRETTY_PRINT);
exit;

