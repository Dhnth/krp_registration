<?php
// Database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', '');

// Base URL - Deteksi otomatis (dinamis) agar bisa diakses di localhost maupun saat di-hosting
$scheme = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$dir = dirname($scriptName);
$dir = ($dir === '\\' || $dir === '/') ? '' : str_replace('\\', '/', $dir);
$dir = rtrim($dir, '/');
define('BASE_URL', $scheme . '://' . $host . $dir);
define('BASE_PATH', dirname(__DIR__));

// Admin credentials (hardcode)
define('ADMIN_USERNAME', '');
define('ADMIN_PASSWORD', '');

// Theme colors
define('THEME_PRIMARY', '#006e2f');
define('THEME_PRIMARY_CONTAINER', '#22c55e');
define('THEME_SURFACE', '#f8f9ff');
define('THEME_SURFACE_DIM', '#cbdbf5');
define('THEME_SURFACE_BRIGHT', '#f8f9ff');
define('THEME_SURFACE_CONTAINER_LOWEST', '#ffffff');
define('THEME_SURFACE_CONTAINER_LOW', '#eff4ff');
define('THEME_SURFACE_CONTAINER', '#e5eeff');
define('THEME_SURFACE_CONTAINER_HIGH', '#dce9ff');
define('THEME_SURFACE_CONTAINER_HIGHEST', '#d3e4fe');
define('THEME_ON_SURFACE', '#0b1c30');
define('THEME_ON_SURFACE_VARIANT', '#3d4a3d');
define('THEME_OUTLINE', '#6d7b6c');
define('THEME_OUTLINE_VARIANT', '#bccbb9');
define('THEME_SECONDARY', '#565e74');
define('THEME_ERROR', '#ba1a1a');

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}