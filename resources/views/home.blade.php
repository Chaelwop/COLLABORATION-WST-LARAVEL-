@extends('layouts.app')
@section('title', 'FolioForge - Your work, beautifully presented')
@push('head')
<style>
    .home-shell{max-width:1160px}
    .home-hero{display:grid;grid-template-columns:minmax(0,1.05fr) minmax(360px,.95fr);gap:54px;align-items:center;padding:58px 0 64px}
    .home-copy{padding:10px 0}
    .eyebrow{display:inline-flex;align-items:center;gap:9px;color:var(--accent);font-size:.8rem;font-weight:700;letter-spacing:.11em;text-transform:uppercase;margin:0 0 18px}
    .eyebrow::before{content:"";width:24px;height:2px;background:var(--accent)}
    .home-copy h1{font-size:clamp(3rem,6vw,5.25rem);line-height:.99;max-width:10ch;letter-spacing:-.075em;margin:0 0 21px}
    .home-copy h1 em{font-family:'Source Serif 4',Georgia,serif;font-weight:600;color:var(--accent);letter-spacing:-.065em}
    .home-copy .lead{max-width:48ch;font-size:1.12rem;line-height:1.75;margin-bottom:26px}
    .home-actions{display:flex;gap:11px;flex-wrap:wrap}
    .hero-footnote{display:flex;align-items:center;gap:10px;margin:24px 0 0;color:var(--muted);font-size:.87rem}
    .footnote-icon{width:24px;height:24px;display:grid;place-items:center;border-radius:50%;background:#e5efde;color:var(--accent);font-weight:700}
    .showcase{position:relative;padding:14px 10px 14px 18px}
    .showcase::before{content:"";position:absolute;inset:0 0 0 20%;background:#e7eddb;border-radius:32px;transform:rotate(3deg)}
    .showcase-window{position:relative;background:#fff;border:1px solid #e5e8df;border-radius:17px;overflow:hidden;box-shadow:0 28px 70px rgba(30,48,37,.15);transform:rotate(-2deg)}
    .window-bar{height:43px;display:flex;align-items:center;gap:6px;padding:0 15px;border-bottom:1px solid #edf0e9;background:#fcfdfb}
    .window-dot{width:7px;height:7px;border-radius:50%;background:#d5dbd1}
    .window-title{margin-left:auto;color:#89928a;font-size:.64rem;font-weight:700;letter-spacing:.12em}
    .showcase-page{padding:22px 23px 24px}
    .showcase-label{display:flex;align-items:center;justify-content:space-between;color:#738077;font-size:.63rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase}
    .live-dot{display:inline-flex;align-items:center;gap:5px;color:var(--accent);letter-spacing:.04em}
    .live-dot::before{content:"";width:6px;height:6px;border-radius:50%;background:#71bb79}
    .profile-mini{display:grid;grid-template-columns:58px 1fr;gap:12px;align-items:center;padding:20px 0 17px;border-bottom:1px solid #edf0e9}
    .mini-avatar{width:58px;height:58px;border-radius:17px;background:linear-gradient(140deg,#d9f27c,#a5c98a);display:grid;place-items:center;color:#31503a;font-family:'Source Serif 4',serif;font-size:1.65rem;font-weight:700}
    .mini-name{font-family:'Source Serif 4',serif;font-size:1.32rem;font-weight:700;letter-spacing:-.04em;line-height:1.15}
    .mini-role{color:#748078;font-size:.78rem;margin-top:3px}
    .mini-section-head{display:flex;justify-content:space-between;align-items:center;margin:17px 0 9px;font-size:.76rem;font-weight:700}
    .mini-section-head span:last-child{font-size:.65rem;color:#89928a;font-weight:500}
    .mini-projects{display:grid;grid-template-columns:1fr 1fr;gap:9px}
    .mini-project{min-height:86px;border-radius:9px;padding:10px;background:#eff3e8;display:flex;flex-direction:column;justify-content:space-between}
    .mini-project:nth-child(2){background:#f8eee2}
    .mini-project-art{height:31px;width:42px;border-radius:7px;background:#bad094;position:relative}
    .mini-project:nth-child(2) .mini-project-art{background:#e9ba8e;width:55px}
    .mini-project-art::after{content:"";position:absolute;width:17px;height:19px;border:2px solid rgba(255,255,255,.85);border-radius:5px;right:-8px;top:7px}
    .mini-project-title{font-size:.7rem;font-weight:700}
    .mini-project-caption{font-size:.59rem;color:#778078}
    .mini-skills{display:flex;gap:6px;flex-wrap:wrap;margin-top:13px}
    .mini-skill{border:1px solid #e4e9df;border-radius:99px;padding:4px 8px;color:#647068;font-size:.62rem}
    .home-section{padding:54px 0}
    .section-heading{display:flex;justify-content:space-between;align-items:end;gap:24px;margin-bottom:22px}
    .section-kicker{color:var(--accent);font-size:.75rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;margin:0 0 8px}
    .section-heading h2{font-family:'Source Serif 4',Georgia,serif;font-size:clamp(2rem,4vw,2.8rem);line-height:1.1;margin:0;letter-spacing:-.05em}
    .section-heading p{max-width:42ch;color:var(--muted);margin:0;font-size:.96rem}
    .home-template-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px}
    .home-template{background:#fff;border:1px solid var(--line);border-radius:15px;padding:12px;box-shadow:0 5px 20px rgba(31,48,39,.035)}
    .home-template-art{height:190px;border-radius:9px;overflow:hidden;position:relative;padding:17px}
    .art-simple{background:#f4f1ea}
    .art-simple-sheet{width:62%;height:100%;margin:auto;background:white;border:1px solid #e9e4db;padding:18px 13px;text-align:center;box-shadow:0 5px 15px rgba(50,45,35,.06)}
    .art-simple-avatar{width:34px;height:34px;margin:0 auto 9px;border-radius:50%;background:#d7cfc0}
    .art-line{height:5px;border-radius:9px;background:#d8d9d0;margin:6px auto}
    .art-line.dark{width:58%;height:7px;background:#3d4941}
    .art-line.short{width:35%}
    .art-lines{border-top:1px solid #e8e8e1;padding-top:10px;margin-top:13px}
    .art-lines .art-line{margin:7px 0;width:100%;height:4px}
    .art-lines .art-line:nth-child(2){width:83%}
    .art-lines .art-line:nth-child(3){width:67%}
    .art-modern{background:#e6ecf4}
    .art-modern-banner{height:48px;margin:-17px -17px 0;background:linear-gradient(115deg,#243e46,#578274)}
    .art-modern-layout{display:grid;grid-template-columns:34% 1fr;gap:8px;margin-top:-17px}
    .art-modern-side,.art-modern-card{background:#fff;border-radius:8px;box-shadow:0 5px 13px rgba(35,54,59,.1)}
    .art-modern-side{height:105px;padding:24px 9px 9px;text-align:center}
    .art-modern-avatar{width:34px;height:34px;border:3px solid white;background:#a6c4b3;border-radius:50%;margin:-34px auto 6px}
    .art-modern-card{height:46px;margin-bottom:7px;padding:10px}
    .art-modern-card:last-child{height:52px}
    .art-modern-card .art-line{margin:4px 0;height:4px;background:#d9e2dc}
    .art-modern-card .art-line:first-child{width:54%;background:#638475}
    .art-creative{background:#d8ef7a}
    .art-creative-title{font-family:'Archivo Black',sans-serif;font-size:1.8rem;line-height:.92;text-transform:uppercase;max-width:60%;position:relative;z-index:1}
    .art-creative-photo{position:absolute;right:15px;top:19px;width:75px;height:93px;background:#f09a78;border:3px solid #17251d;transform:rotate(7deg);box-shadow:5px 5px 0 #17251d}
    .art-creative-block{position:absolute;left:17px;bottom:17px;width:46%;height:32px;background:#fff;border:2px solid #17251d;transform:rotate(-3deg)}
    .art-creative-block:last-child{left:auto;right:19px;width:25%;background:#f3a7bc;transform:rotate(4deg)}
    .home-template-info{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:14px 5px 4px}
    .home-template-info h3{font-size:1rem;margin:0 0 3px;letter-spacing:-.02em}
    .home-template-info p{color:var(--muted);font-size:.83rem;margin:0}
    .template-index{font-family:'Space Grotesk',sans-serif;font-size:.8rem;color:#89928a;font-weight:700}
    .workflow{background:#e9eee3;border-radius:20px;padding:30px}
    .workflow .steps{margin-top:23px}
    .workflow .steps li{background:rgba(255,255,255,.76);border-color:rgba(218,225,212,.9)}
    .home-cta{margin-top:45px;background:var(--ink);color:#fff;border-radius:18px;padding:30px 34px;display:flex;align-items:center;justify-content:space-between;gap:24px}
    .home-cta h2{font-family:'Source Serif 4',Georgia,serif;font-size:1.8rem;margin:0 0 4px;letter-spacing:-.04em}
    .home-cta p{color:#c5d0c8;margin:0}
    .home-cta .btn{background:var(--lime);border-color:var(--lime);color:var(--ink);white-space:nowrap}
    .home-cta .btn:hover{background:#e5f9a0}
    @media(max-width:820px){.home-hero{grid-template-columns:1fr;gap:30px;padding:42px 0 32px}.home-copy h1{max-width:12ch}.showcase{max-width:560px;width:100%;margin:auto}.home-template-grid{gap:11px}.home-template-art{height:155px}.section-heading{align-items:flex-start;flex-direction:column}.home-cta{align-items:flex-start;flex-direction:column}}
    @media(max-width:620px){.home-hero{padding-top:30px}.home-copy h1{font-size:clamp(2.8rem,14vw,4.1rem)}.showcase{padding:8px 5px}.showcase-page{padding:18px}.home-section{padding:38px 0}.home-template-grid{grid-template-columns:1fr;gap:12px}.home-template{display:grid;grid-template-columns:42% 1fr;gap:12px;align-items:center;padding:10px}.home-template-art{height:126px;padding:12px}.art-simple-sheet{padding:12px 9px}.art-simple-avatar{width:27px;height:27px}.art-modern-banner{margin:-12px -12px 0;height:38px}.art-modern-layout{gap:5px}.art-modern-side{height:78px;padding-inline:5px}.art-modern-card{height:35px;padding:7px}.art-modern-card:last-child{height:36px}.art-creative-title{font-size:1.35rem}.art-creative-photo{width:54px;height:70px;right:10px;top:13px}.art-creative-block{left:12px;bottom:12px}.art-creative-block:last-child{right:12px}.home-template-info{align-items:flex-start;padding:0}.home-template-info h3{font-size:.95rem}.home-template-info p{font-size:.78rem}.workflow{padding:21px 16px}.workflow .steps{grid-template-columns:1fr 1fr}.home-cta{padding:25px 22px;margin-top:30px}}
</style>
@endpush
@section('content')
<main class="container home-shell">
    <section class="home-hero">
        <div class="home-copy">
            <p class="eyebrow">A portfolio that feels like you</p>
            <h1>Make your work <em>impossible to miss.</em></h1>
            <p class="lead">Bring your experience, projects, and ideas together in one polished portfolio. Pick a look, preview it, and make it yours.</p>
            <div class="home-actions">
                <a class="btn" href="{{ route('portfolios.create') }}">Build your portfolio <span aria-hidden="true">&rarr;</span></a>
                <a class="btn btn-outline" href="{{ route('portfolios.index') }}">My portfolios</a>
            </div>
            <p class="hero-footnote"><span class="footnote-icon" aria-hidden="true">✓</span> Your details, your story, three distinct styles.</p>
        </div>

        <div class="showcase" aria-label="Portfolio preview illustration">
            <div class="showcase-window">
                <div class="window-bar" aria-hidden="true">
                    <span class="window-dot"></span><span class="window-dot"></span><span class="window-dot"></span>
                    <span class="window-title">FOLIOFORGE / PORTFOLIO</span>
                </div>
                <div class="showcase-page">
                    <div class="showcase-label"><span>Selected work</span><span class="live-dot">Portfolio preview</span></div>
                    <div class="profile-mini">
                        <div class="mini-avatar" aria-hidden="true">A</div>
                        <div><div class="mini-name">Alex Morgan</div><div class="mini-role">Designer · Maker · Problem solver</div></div>
                    </div>
                    <div class="mini-section-head"><span>A few things I've made</span><span>2022 &ndash; 2025</span></div>
                    <div class="mini-projects">
                        <div class="mini-project"><div class="mini-project-art"></div><div><div class="mini-project-title">Field Notes</div><div class="mini-project-caption">Brand &amp; digital</div></div></div>
                        <div class="mini-project"><div class="mini-project-art"></div><div><div class="mini-project-title">Good Things</div><div class="mini-project-caption">Product design</div></div></div>
                    </div>
                    <div class="mini-skills"><span class="mini-skill">Visual design</span><span class="mini-skill">Prototyping</span><span class="mini-skill">Creative direction</span></div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section" aria-labelledby="templates-heading">
        <div class="section-heading">
            <div><p class="section-kicker">Three ways to stand out</p><h2 id="templates-heading">One profile. Three personalities.</h2></div>
            <p>Start with your story, then choose the presentation that fits your work and the impression you want to make.</p>
        </div>
        <div class="home-template-grid">
            <article class="home-template">
                <div class="home-template-art art-simple" aria-hidden="true">
                    <div class="art-simple-sheet"><div class="art-simple-avatar"></div><div class="art-line dark"></div><div class="art-line short"></div><div class="art-lines"><div class="art-line"></div><div class="art-line"></div><div class="art-line"></div></div></div>
                </div>
                <div class="home-template-info"><div><h3>Simple</h3><p>Clean, calm, professional.</p></div><span class="template-index">01</span></div>
            </article>
            <article class="home-template">
                <div class="home-template-art art-modern" aria-hidden="true">
                    <div class="art-modern-banner"></div><div class="art-modern-layout"><div class="art-modern-side"><div class="art-modern-avatar"></div><div class="art-line dark"></div><div class="art-line short"></div></div><div><div class="art-modern-card"><div class="art-line"></div><div class="art-line"></div></div><div class="art-modern-card"><div class="art-line"></div><div class="art-line"></div></div></div></div>
                </div>
                <div class="home-template-info"><div><h3>Modern</h3><p>Structured, visual, polished.</p></div><span class="template-index">02</span></div>
            </article>
            <article class="home-template">
                <div class="home-template-art art-creative" aria-hidden="true">
                    <div class="art-creative-title">Make<br>some<br>noise.</div><div class="art-creative-photo"></div><div class="art-creative-block"></div><div class="art-creative-block"></div>
                </div>
                <div class="home-template-info"><div><h3>Creative</h3><p>Bold, playful, unmistakable.</p></div><span class="template-index">03</span></div>
            </article>
        </div>
    </section>

    <section class="home-section workflow" aria-labelledby="workflow-heading">
        <div class="section-heading">
            <div><p class="section-kicker">From details to done</p><h2 id="workflow-heading">Your portfolio, in four easy steps.</h2></div>
            <a class="btn btn-outline" href="{{ route('portfolios.create') }}">Get started <span aria-hidden="true">&rarr;</span></a>
        </div>
        <ol class="steps">
            <li><strong>Tell your story</strong><br>Add your profile, education, skills, projects, and experience.</li>
            <li><strong>Save your details</strong><br>Keep your portfolio information together and ready to update.</li>
            <li><strong>Choose your style</strong><br>Compare Simple, Modern, and Creative with your own content.</li>
            <li><strong>Preview and refine</strong><br>Make edits, switch templates, and get your portfolio ready to share.</li>
        </ol>
    </section>

    <section class="home-cta">
        <div><h2>Ready to show what you do?</h2><p>Your next opportunity deserves a great first impression.</p></div>
        <a class="btn" href="{{ route('portfolios.create') }}">Create your portfolio <span aria-hidden="true">&rarr;</span></a>
    </section>
</main>
@endsection
