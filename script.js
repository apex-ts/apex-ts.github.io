// Apex TS — شمارش معکوس دقیقاً از 12:00:00 شروع می‌شود.
// شروع تایمر در اولین باز شدن صفحه ثبت می‌شود و با Refresh دوباره از ابتدا شروع نمی‌شود.

const DURATION = 12 * 60 * 60;
const STORAGE_KEY = "apex_ts_countdown_start";

let start = Number(localStorage.getItem(STORAGE_KEY));

if (!start || Number.isNaN(start)) {
  start = Date.now();
  localStorage.setItem(STORAGE_KEY, String(start));
}

function pad(number) {
  return String(number).padStart(2, "0");
}

function updateCountdown() {
  const elapsed = Math.floor((Date.now() - start) / 1000);
  const remaining = Math.max(DURATION - elapsed, 0);

  const hours = Math.floor(remaining / 3600);
  const minutes = Math.floor((remaining % 3600) / 60);
  const seconds = remaining % 60;

  document.getElementById("hours").textContent = pad(hours);
  document.getElementById("minutes").textContent = pad(minutes);
  document.getElementById("seconds").textContent = pad(seconds);

  if (remaining === 0) {
    document.getElementById("message").textContent = "سایت باز میشود";
    document.title = "Apex TS — سایت باز میشود";
    return;
  }

  document.title = `Apex TS — ${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
}

updateCountdown();
setInterval(updateCountdown, 1000);
