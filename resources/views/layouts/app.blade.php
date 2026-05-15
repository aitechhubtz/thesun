<!DOCTYPE html>
<html lang="sw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Syne:wght@700;800&display=swap" rel="stylesheet">
    <style>
        :root{--orange:#ff6b35;--orange2:#f7931e;--dark:#050507;--panel:#11111b;--muted:#9ca3af;--white:#fff;--green:#00ff66;--red:#ff0055;--blue:#00f0ff}*{box-sizing:border-box;margin:0;padding:0}body{font-family:Inter,sans-serif;background:radial-gradient(circle at 20% 10%,rgba(255,107,53,.18),transparent 30%),#050507;color:#fff;line-height:1.6}a{color:inherit;text-decoration:none}.container{max-width:1180px;margin:auto;padding:0 22px}.nav{position:sticky;top:0;z-index:20;background:rgba(5,5,7,.82);backdrop-filter:blur(18px);border-bottom:1px solid rgba(255,255,255,.08)}.nav-inner{height:74px;display:flex;align-items:center;justify-content:space-between}.brand{font-family:Syne,sans-serif;font-size:1.6rem;font-weight:800}.brand span,.grad{background:linear-gradient(135deg,var(--orange),var(--orange2));-webkit-background-clip:text;background-clip:text;color:transparent}.menu{display:flex;gap:24px;align-items:center}.menu a{color:#d1d5db;font-weight:600}.menu a:hover,.menu a.active{color:var(--orange)}.btn{display:inline-flex;align-items:center;justify-content:center;padding:12px 20px;border-radius:999px;background:linear-gradient(135deg,var(--orange),var(--orange2));font-weight:800;border:0;color:#fff;cursor:pointer}.btn.ghost{background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1)}.hero{padding:110px 0 70px}.badge{display:inline-flex;padding:8px 16px;border:1px solid rgba(255,107,53,.35);border-radius:999px;color:var(--orange);background:rgba(255,107,53,.12);font-weight:700;margin-bottom:18px}.hero h1{font-family:Syne,sans-serif;font-size:clamp(2.6rem,6vw,5.5rem);line-height:.98;margin-bottom:20px}.lead{font-size:1.12rem;color:var(--muted);max-width:760px}.grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:22px}.card{background:linear-gradient(180deg,rgba(255,255,255,.075),rgba(255,255,255,.035));border:1px solid rgba(255,255,255,.1);border-radius:24px;padding:28px;box-shadow:0 24px 60px rgba(0,0,0,.28)}.card:hover{border-color:rgba(255,107,53,.4);transform:translateY(-4px);transition:.25s}.section{padding:70px 0}.section h2{font-family:Syne,sans-serif;font-size:clamp(2rem,4vw,3.4rem);margin-bottom:14px}.muted{color:var(--muted)}.footer{border-top:1px solid rgba(255,255,255,.08);padding:34px 0;color:var(--muted);margin-top:60px}.form{display:grid;gap:14px}.input,textarea,select{width:100%;padding:14px 16px;border-radius:14px;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff}textarea{min-height:130px}.alert{padding:14px 18px;border-radius:14px;margin-bottom:18px}.alert.success{background:rgba(0,255,102,.12);border:1px solid rgba(0,255,102,.25);color:var(--green)}.alert.error{background:rgba(255,0,85,.12);border:1px solid rgba(255,0,85,.25);color:#ff8aac}.table{width:100%;border-collapse:collapse}.table th,.table td{padding:14px;border-bottom:1px solid rgba(255,255,255,.08);text-align:left}.sidebar-layout{display:grid;grid-template-columns:280px 1fr;min-height:100vh}.sidebar{background:rgba(5,5,8,.85);border-right:1px solid rgba(255,255,255,.08);padding:28px;position:sticky;top:0;height:100vh}.admin-main{padding:32px;overflow:auto}.admin-link{display:block;padding:12px 14px;border-radius:12px;color:#cbd5e1;margin-bottom:7px}.admin-link:hover{background:rgba(255,255,255,.07);color:#fff}@media(max-width:800px){.menu{display:none}.sidebar-layout{grid-template-columns:1fr}.sidebar{height:auto;position:relative}.hero{padding-top:70px}}
    </style>
</head>
<body>
    @hasSection('plain')
        @yield('content')
    @else
        <nav class="nav">
            <div class="container nav-inner">
                <a href="{{ route('home') }}" class="brand">the sun<span>.</span></a>
                <div class="menu">
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('services') }}">Services</a>
                    <a href="{{ route('blog') }}">Blog</a>
                    <a href="{{ route('contact') }}">Contact</a>
                    @auth
                        @if(auth()->user()->isAdmin())<a href="{{ route('admin.dashboard') }}">Admin</a>@endif
                        <form method="POST" action="{{ route('logout') }}">@csrf<button class="btn ghost" type="submit">Logout</button></form>
                    @else
                        <a class="btn" href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            </div>
        </nav>
        <main>@yield('content')</main>
        <footer class="footer"><div class="container">© {{ date('Y') }} the sun Agency. All rights reserved.</div></footer>
    @endif
</body>
</html>
