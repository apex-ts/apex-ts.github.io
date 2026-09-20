<?php require __DIR__.'/config.php';
$comments = [];
try { $comments = db()->query("SELECT author_name, body, created_at FROM comments ORDER BY created_at DESC LIMIT 12")->fetchAll(); } catch (Throwable $e) {}
$msg = $_GET['msg'] ?? '';
?>
<!doctype html><html lang="fa" dir="rtl"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>APEX TS — More Than Just a Server</title>
<link rel="stylesheet" href="assets/style.css"></head><body>
<header class="nav"><a class="brand" href="index.php"><span class="brand-a">A</span><span>APEX <b>TS</b></span></a><nav>
<a href="#about">معرفی</a><a href="#features">امکانات</a><a href="#comments">نظرات</a><a href="rules.php">قوانین</a>
<?php if (logged_in()): ?><a class="pill" href="dashboard.php">حساب کاربری</a><?php else: ?><a class="pill" href="login.php">ورود / ثبت‌نام</a><?php endif; ?>
</nav></header>
<main>
<section class="hero"><div class="hero-copy"><div class="eyebrow">MORE THAN JUST A SERVER</div><h1>صدای دوستان،<br><span>در یک مکان.</span></h1><p>APEX TS یک فضای مدرن، پایدار و دوستانه برای ارتباط، بازی و ساختن لحظه‌های خوب با دوستانت.</p><div class="actions"><a class="btn primary" href="login.php">ورود به حساب</a><button class="btn ghost" onclick="copyIP()">کپی IP سرور</button></div><div class="quick"><span>🎙️ گفت‌وگو با کیفیت</span><span>🛡️ امنیت بالا</span><span>👥 جامعه دوستانه</span></div></div><div class="hero-card"><div class="logo-ring">A<span>TS</span></div><div class="server-label">TEAM SPEAK SERVER</div><div class="server-ip" id="serverIp">tstg.ir:4611</div><div class="status"><i></i> Online • Uptime بالا</div></div></section>
<section id="about" class="section split"><div><div class="eyebrow">ABOUT APEX</div><h2>معرفی سایت</h2><p>اینجا قرار است ارتباط ساده‌تر و تجربه‌ی TeamSpeak حرفه‌ای‌تر باشد؛ از اتاق‌های دوستانه تا پشتیبانی و مدیریت حساب.</p><div class="mini-grid"><span>⚡ پایدار و سریع</span><span>🛡️ امن و مطمئن</span><span>💙 دوستانه و صمیمی</span></div></div><div class="glass mock"><div class="mock-top"><b>APEX TS</b><span>● 99.9%</span></div><div class="mock-body"><aside>خانه<br>اتاق‌ها<br>دوستان<br>تنظیمات<br>پشتیبانی</aside><div><h3>به خانواده APEX خوش آمدید</h3><p>tstg.ir:4611</p><div class="bars"><i></i><i></i><i></i></div></div></div></div></section>
<section id="features" class="section"><div class="center"><div class="eyebrow">WHY APEX</div><h2>همه‌چیز برای یک جامعه خوب</h2></div><div class="features"><article>🎧<h3>سرور پایدار</h3><p>کیفیت صدای خوب و اتصال پایدار.</p></article><article>🛡️<h3>امنیت بالا</h3><p>حساب‌ها و اطلاعات با روش‌های امن مدیریت می‌شوند.</p></article><article>👥<h3>جامعه دوستانه</h3><p>فضایی برای بازی، گفتگو و آشنایی.</p></article><article>🎮<h3>مناسب گیمرها</h3><p>برای تیم‌ها و بازی‌های مختلف.</p></article><article>🎧<h3>پشتیبانی حرفه‌ای</h3><p>ارتباط سریع از طریق راه‌های معرفی‌شده.</p></article><article>⚡<h3>سرعت بالا</h3><p>تمرکز روی تجربه‌ای روان و ساده.</p></article></div></section>
<section id="comments" class="section comments"><div class="center"><div class="eyebrow">COMMUNITY</div><h2>نظرات کاربران</h2><p>تجربه‌ات از APEX TS را با بقیه به اشتراک بگذار.</p></div>
<?php if ($msg): ?><div class="notice"><?=e($msg)?></div><?php endif; ?>
<?php if (logged_in()): ?><form class="comment-form" action="comment.php" method="post"><input type="hidden" name="csrf" value="<?=e(csrf_token())?>"><textarea name="body" maxlength="1000" placeholder="نظرت رو بنویس..." required></textarea><button class="btn primary">ثبت نظر</button></form><?php else: ?><div class="login-note">برای ثبت نظر ابتدا <a href="login.php">وارد حساب شو</a>.</div><?php endif; ?>
<div class="comment-list"><?php foreach ($comments as $c): ?><article class="comment"><div class="avatar"><?=e(mb_substr($c['author_name'],0,1))?></div><div><b><?=e($c['author_name'])?></b><small><?=e(date('Y/m/d H:i', strtotime($c['created_at'])))?></small><p><?=nl2br(e($c['body']))?></p></div></article><?php endforeach; if (!$comments): ?><div class="empty">هنوز نظری ثبت نشده.</div><?php endif; ?></div></section>
</main><footer><b>APEX TS</b><span>MORE THAN JUST A SERVER</span><a href="admin.php">Admin</a></footer>
<script>function copyIP(){navigator.clipboard.writeText('tstg.ir:4611');alert('IP کپی شد: tstg.ir:4611')}</script></body></html>
