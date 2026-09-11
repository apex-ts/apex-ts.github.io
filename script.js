/*
  APEX TS COUNTDOWN
  -----------------
  مهم: برای شروع شمارش دقیقاً بعد از انتشار نسخه جدید:
  مقدار START_AT را به زمان انتشار روی GitHub تغییر بده.
  مثال:
  const START_AT = "2026-09-11T15:30:00+03:30";
*/
const START_AT = "2026-09-11T15:30:00+03:30";

const $ = id => document.getElementById(id);
const pad = n => String(n).padStart(2, "0");

function tick() {
  const start = new Date(START_AT).getTime();
  const end = start + 12 * 60 * 60 * 1000;
  const left = end - Date.now();

  if (left <= 0) {
    $("hours").textContent = "00";
    $("minutes").textContent = "00";
    $("seconds").textContent = "00";
    $("message").textContent = "APEX TS IS LIVE";
    document.title = "Apex TS — LIVE";
    return;
  }

  const totalSeconds = Math.floor(left / 1000);
  const hours = Math.floor(totalSeconds / 3600);
  const minutes = Math.floor((totalSeconds % 3600) / 60);
  const seconds = totalSeconds % 60;

  $("hours").textContent = pad(hours);
  $("minutes").textContent = pad(minutes);
  $("seconds").textContent = pad(seconds);
  document.title = `Apex TS — ${pad(hours)}:${pad(minutes)}:${pad(seconds)}`;
}

tick();
setInterval(tick, 1000);
