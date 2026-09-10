const $=s=>document.querySelector(s);
const users=()=>JSON.parse(localStorage.getItem("apex_users")||"[]");
const saveUsers=u=>localStorage.setItem("apex_users",JSON.stringify(u));
let current=JSON.parse(localStorage.getItem("apex_current")||"null");
window.addEventListener("load",()=>setTimeout(()=>$("#intro").classList.add("hide"),1500));
function openAuth(){$("#authModal").classList.remove("hidden")}
function logout(){current=null;localStorage.removeItem("apex_current");updateAuth()}
function updateAuth(){$("#authBtn").textContent=current?`خروج (${current.user})`:"ورود / ثبت‌نام";$("#commentHint").textContent=current?"":"برای ثبت نظر باید وارد حساب کاربری شوی."}
$("#authBtn").onclick=()=>current?logout():openAuth();
$("#closeModal").onclick=()=>$("#authModal").classList.add("hidden");
document.querySelectorAll(".tabs button").forEach(b=>b.onclick=()=>{document.querySelectorAll(".tabs button").forEach(x=>x.classList.remove("active"));b.classList.add("active");$("#loginForm").classList.toggle("hidden",b.dataset.tab!=="login");$("#signupForm").classList.toggle("hidden",b.dataset.tab!=="signup");$("#authMessage").textContent=""});
$("#signupBtn").onclick=()=>{const email=$("#signupEmail").value.trim(),user=$("#signupUser").value.trim(),pass=$("#signupPass").value;if(!email||!user||!pass)return $("#authMessage").textContent="همه فیلدها را کامل کن.";let u=users();if(u.some(x=>x.user===user||x.email===email))return $("#authMessage").textContent="این ایمیل یا نام کاربری قبلاً ثبت شده.";u.push({email,user,pass});saveUsers(u);current={user,email};localStorage.setItem("apex_current",JSON.stringify(current));$("#authModal").classList.add("hidden");updateAuth()};
$("#loginBtn").onclick=()=>{const user=$("#loginUser").value.trim(),pass=$("#loginPass").value,found=users().find(x=>x.user===user&&x.pass===pass);if(!found)return $("#authMessage").textContent="نام کاربری یا رمز عبور اشتباه است.";current={user:found.user,email:found.email};localStorage.setItem("apex_current",JSON.stringify(current));$("#authModal").classList.add("hidden");updateAuth()};
function esc(s){return s.replace(/[&<>"']/g,m=>({"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#039;"}[m]))}
function render(){const a=JSON.parse(localStorage.getItem("apex_comments")||"[]");$("#commentsList").innerHTML=a.length?a.map(c=>`<div class="comment"><b>${esc(c.user)}</b><p>${esc(c.text)}</p><small>${c.date}</small></div>`).join(""):"<div class='comment'>هنوز نظری ثبت نشده؛ اولین نفر باش!</div>"}
$("#commentBtn").onclick=()=>{if(!current)return openAuth();const text=$("#commentText").value.trim();if(!text)return;const a=JSON.parse(localStorage.getItem("apex_comments")||"[]");a.unshift({user:current.user,text,date:new Date().toLocaleString("fa-IR")});localStorage.setItem("apex_comments",JSON.stringify(a));$("#commentText").value="";render()};
updateAuth();render();