<?php
declare(strict_types=1);

const DB_HOST = 'sql12.freesqldatabase.com';
const DB_NAME = 'sql12837435';
const DB_USER = 'sql12837435';
const DB_PASS = 'Xk1VbNIsag';
const DB_PORT = 3306;
const ADMIN_USER = 'mamadgh379d';
const ADMIN_PASS_HASH = '$2y$12$lLzd6rMKt0Bc7.DrgDFhQ.RJoP4m79ueHij8dTB3nx4GUvUSg0nue';

function db(): PDO {
    static $pdo = null;
    if ($pdo instanceof PDO) return $pdo;
    $dsn = 'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset=utf8mb4';
    $pdo = new PDO($dsn, DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    return $pdo;
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_set_cookie_params([
        'httponly' => true,
        'secure' => (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
        'samesite' => 'Lax',
    ]);
    session_start();
}

function e(string $value): string { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); }
function csrf_token(): string { if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32)); return $_SESSION['csrf']; }
function verify_csrf(): void { if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) { http_response_code(419); exit('درخواست نامعتبر است.'); } }
function logged_in(): bool { return !empty($_SESSION['user_id']); }
function admin_logged_in(): bool { return !empty($_SESSION['admin']); }
function redirect(string $url): never { header('Location: '.$url); exit; }
