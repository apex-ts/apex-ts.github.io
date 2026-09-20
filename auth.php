<?php require __DIR__.'/config.php';
$action = $_POST['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') redirect('login.php');
verify_csrf();
try {
  if ($action === 'signup') {
    $username = trim($_POST['username'] ?? ''); $email = trim($_POST['email'] ?? ''); $pass = $_POST['password'] ?? '';
    if (!preg_match('/^[A-Za-z0-9_]{3,50}$/',$username) || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($pass)<8) throw new RuntimeException('نام کاربری، ایمیل یا رمز عبور معتبر نیست. رمز باید حداقل ۸ کاراکتر باشد.');
    $st=db()->prepare('INSERT INTO users(username,email,password_hash) VALUES(?,?,?)'); $st->execute([$username,$email,password_hash($pass,PASSWORD_DEFAULT)]);
    session_regenerate_id(true); $_SESSION['user_id']=(int)db()->lastInsertId(); $_SESSION['username']=$username; redirect('dashboard.php');
  }
  if ($action === 'login') {
    $login=trim($_POST['login']??''); $pass=$_POST['password']??'';
    $st=db()->prepare('SELECT * FROM users WHERE username=? OR email=? LIMIT 1'); $st->execute([$login,$login]); $u=$st->fetch();
    if (!$u || !password_verify($pass,$u['password_hash'])) throw new RuntimeException('اطلاعات ورود اشتباه است.');
    session_regenerate_id(true); $_SESSION['user_id']=(int)$u['id']; $_SESSION['username']=$u['username']; redirect('dashboard.php');
  }
  throw new RuntimeException('درخواست نامعتبر است.');
} catch (Throwable $e) { redirect('login.php?error='.rawurlencode($e->getMessage())); }
