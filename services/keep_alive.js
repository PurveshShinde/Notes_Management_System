/**
 * Standalone Keep-Alive Service (Node.js)
 * 
 * Pings the application endpoint every 8 minutes (480,000 ms)
 * to keep Render instances awake.
 * 
 * Usage:
 *   node services/keep_alive.js
 */

const https = require('https');
const http = require('http');

const TARGET_URL = process.env.KEEP_ALIVE_URL || 'https://notes-management-system-beae.onrender.com/ping.php';
const INTERVAL_MS = parseInt(process.env.KEEP_ALIVE_INTERVAL_MS, 10) || 8 * 60 * 1000; // 8 minutes

function ping() {
    const timestamp = new Date().toISOString();
    const client = TARGET_URL.startsWith('https') ? https : http;
    const startTime = Date.now();

    const req = client.get(TARGET_URL, { timeout: 25000 }, (res) => {
        const duration = Date.now() - startTime;
        console.log(`[${timestamp}] [Keep-Alive] HTTP ${res.statusCode} from ${TARGET_URL} (${duration}ms)`);
        res.resume(); // Consume response data to free up memory
    });

    req.on('timeout', () => {
        req.destroy();
        console.error(`[${timestamp}] [Keep-Alive Error] Request timed out`);
    });

    req.on('error', (err) => {
        console.error(`[${timestamp}] [Keep-Alive Error] ${err.message}`);
    });
}

console.log(`[${new Date().toISOString()}] Keep-alive monitor started for: ${TARGET_URL}`);
console.log(`Interval: ${INTERVAL_MS / 1000 / 60} minutes`);

// Immediate initial ping
ping();

// Recurring schedule
setInterval(ping, INTERVAL_MS);

