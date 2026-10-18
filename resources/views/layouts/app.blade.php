<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FolioForge')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Source+Serif+4:wght@400;600;700&family=Poppins:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;700&family=Archivo+Black&display=swap" rel="stylesheet">
    <style>
        :root{--ink:#18221e;--muted:#65716b;--paper:#f5f4ef;--card:#fff;--accent:#236b50;--accent-dark:#194d3a;--line:#e3e4dc;--danger:#b3261e;--lime:#d9f27c;--shadow:0 18px 50px rgba(31,48,39,.08)}
        *{box-sizing:border-box}
        html{scroll-behavior:smooth}
        body{margin:0;font-family:'DM Sans',system-ui,sans-serif;color:var(--ink);background:var(--paper);line-height:1.6;-webkit-font-smoothing:antialiased}
        a{color:var(--accent)}
        .topbar{position:sticky;top:0;z-index:20;background:rgba(255,255,255,.92);border-bottom:1px solid rgba(227,228,220,.9);backdrop-filter:blur(14px)}
        .topbar-inner{max-width:1160px;margin:0 auto;padding:13px 24px;display:flex;align-items:center;justify-content:space-between;gap:20px}
        .brand{display:inline-flex;align-items:center;gap:10px;font-weight:700;font-size:1.16rem;letter-spacing:-.04em;color:var(--ink);text-decoration:none}
        .brand-mark{width:34px;height:34px;display:grid;place-items:center;border-radius:11px;background:var(--accent);color:#fff;font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:.94rem;letter-spacing:-.08em}
        .nav{display:flex;gap:5px;flex-wrap:wrap;align-items:center}
        .nav a{padding:8px 13px;border-radius:9px;text-decoration:none;color:#53615a;font-size:.92rem;font-weight:500;transition:background .18s,color .18s}
        .nav a:hover{background:#f1f3ec;color:var(--ink)}
        .nav a:last-child{background:var(--ink);color:white;margin-left:5px;padding-inline:16px}
        .nav a:last-child:hover{background:var(--accent-dark)}
        .container{max-width:1160px;margin:0 auto;padding:38px 24px 76px}
        .narrow{max-width:800px}
        h1,h2,h3{letter-spacing:-.035em}
        h1{font-size:2.15rem;line-height:1.16;margin:0 0 9px}
        h2{font-size:1.28rem;line-height:1.3;margin:0 0 14px}
        .lead{color:var(--muted);font-size:1.08rem;margin:0 0 24px}
        .btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;border:1px solid var(--accent);background:var(--accent);color:#fff;padding:11px 18px;border-radius:10px;font:inherit;font-size:.94rem;font-weight:600;text-decoration:none;cursor:pointer;transition:transform .18s,background .18s,box-shadow .18s}
        .btn:hover{background:var(--accent-dark);box-shadow:0 7px 18px rgba(35,107,80,.16);transform:translateY(-1px)}
        .btn-outline{background:transparent;color:var(--accent)}
        .btn-outline:hover{background:#e9f2eb;color:var(--accent-dark)}
        .btn-danger{background:var(--danger);border-color:var(--danger)}
        .btn-danger:hover{background:#8c1d18}
        .btn-sm{padding:7px 12px;font-size:.88rem}
        .alert{padding:13px 16px;border-radius:11px;margin-bottom:20px}
        .alert-ok{background:#e8f4ec;border:1px solid #c2dfca;color:#285739}
        .alert-err{background:#fbe9e7;border:1px solid #efb7b1}
        .alert-err ul{margin:6px 0 0 18px;padding:0}
        .panel{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:24px;margin-bottom:18px;box-shadow:0 5px 20px rgba(31,48,39,.035)}
        .grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
        .full{grid-column:1/-1}
        label{display:block;font-weight:600;margin-bottom:6px;font-size:.91rem;color:#334139}
        input[type=text],input[type=email],input[type=file],textarea{width:100%;padding:11px 13px;border:1px solid #dfe2da;border-radius:9px;font:inherit;font-size:.94rem;background:#fff;color:var(--ink);transition:border-color .18s,box-shadow .18s}
        input[type=file]{padding:9px}
        input:focus,textarea:focus{border-color:#72a88b;box-shadow:0 0 0 3px rgba(35,107,80,.1);outline:0}
        .btn:focus-visible,a:focus-visible{outline:3px solid #9bd0a9;outline-offset:2px}
        .hint{color:var(--muted);font-size:.86rem;margin-top:5px}
        .row-item{border:1px solid var(--line);border-radius:12px;padding:16px;margin-bottom:12px;background:#fbfcf9}
        .row-item .btn{margin-top:12px}
        .actions{display:flex;gap:10px;flex-wrap:wrap;align-items:center}
        .photo-current{width:84px;height:84px;border-radius:50%;object-fit:cover;border:1px solid var(--line)}
        .steps{display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px;margin:38px 0 0;padding:0;list-style:none;counter-reset:s}
        .steps li{background:var(--card);border:1px solid var(--line);border-radius:14px;padding:18px;counter-increment:s;color:var(--muted);font-size:.94rem}
        .steps li::before{content:counter(s,decimal-leading-zero);display:block;color:var(--accent);font-family:'Space Grotesk',sans-serif;font-size:.82rem;font-weight:700;letter-spacing:.08em;margin-bottom:12px}
        .steps strong{color:var(--ink)}
        .list-item{display:flex;justify-content:space-between;align-items:center;gap:14px;flex-wrap:wrap}
        .badge{display:inline-block;background:#e9f2eb;color:var(--accent-dark);border-radius:99px;padding:3px 10px;font-size:.8rem;font-weight:600}
        .tpl-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px}
        .tpl-card{background:var(--card);border:1px solid var(--line);border-radius:16px;padding:16px;box-shadow:0 5px 20px rgba(31,48,39,.035);transition:transform .2s,box-shadow .2s}
        .tpl-card:hover{transform:translateY(-3px);box-shadow:var(--shadow)}
        .tpl-card.active{border:2px solid var(--accent);padding:15px}
        .thumb{height:170px;border-radius:10px;margin-bottom:15px;overflow:hidden;position:relative;border:1px solid var(--line)}
        .previewbar{position:sticky;top:61px;z-index:10;background:var(--ink);color:#fff;padding:12px max(24px,calc((100% - 1112px)/2));display:flex;gap:10px;align-items:center;justify-content:space-between;flex-wrap:wrap}
        .previewbar .btn{background:#fff;color:var(--ink);border-color:#fff}
        .previewbar .btn-outline{background:transparent;color:#fff;border-color:#66736b}
        .previewbar form{margin:0}
        @media(max-width:820px){.tpl-grid{grid-template-columns:repeat(2,minmax(0,1fr))}.container{padding-inline:20px}}
        @media(max-width:620px){.topbar-inner{padding:11px 16px;align-items:flex-start;flex-direction:column;gap:8px}.nav{width:100%;gap:2px}.nav a{padding:7px 10px;font-size:.87rem}.nav a:last-child{margin-left:auto}.container{padding:28px 16px 56px}.grid,.tpl-grid{grid-template-columns:1fr}.panel{padding:18px}.previewbar{top:100px;padding:12px 16px}.previewbar .actions{width:100%}.steps{margin-top:28px}}
    </style>
    @stack('head')
</head>
<body>
<header class="topbar">
    <div class="topbar-inner">
        <a class="brand" href="{{ route('home') }}"><span class="brand-mark" aria-hidden="true">ff</span>FolioForge</a>
        <nav class="nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('portfolios.index') }}">My portfolios</a>
            <a href="{{ route('portfolios.create') }}">Create portfolio</a>
        </nav>
    </div>
</header>

@if(session('success'))
    <div class="container" style="padding-bottom:0;padding-top:20px"><div class="alert alert-ok" style="margin:0">{{ session('success') }}</div></div>
@endif

@yield('content')
</body>
</html>
