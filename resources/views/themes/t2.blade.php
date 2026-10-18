<style>
.t2{background:#eaeefa;font-family:'Poppins',system-ui,sans-serif;color:#1d2340;padding-bottom:70px}
.t2 .banner{height:200px;background:linear-gradient(120deg,#1d2b64,#3b6fd8)}
.t2 .layout{max-width:1060px;margin:-90px auto 0;padding:0 20px;display:grid;grid-template-columns:300px 1fr;gap:22px;align-items:start}
.t2 .card{background:#fff;border-radius:16px;padding:22px;box-shadow:0 6px 20px rgba(29,43,100,.10);margin-bottom:20px}
.t2 .side{text-align:center}
.t2 .avatar{width:140px;height:140px;border-radius:50%;object-fit:cover;border:5px solid #fff;box-shadow:0 4px 14px rgba(0,0,0,.2);margin-top:-70px;background:#c9d4f5}
.t2 .avatar-fallback{width:140px;height:140px;border-radius:50%;border:5px solid #fff;box-shadow:0 4px 14px rgba(0,0,0,.2);margin:-70px auto 0;background:#3b6fd8;color:#fff;display:grid;place-items:center;font-size:3rem;font-weight:600}
.t2 h1{font-size:1.5rem;margin:12px 0 2px}
.t2 .tag{color:#3b6fd8;font-weight:500;margin:0 0 14px}
.t2 .info{text-align:left;font-size:.9rem;margin:0;padding:0;list-style:none;border-top:1px solid #e3e8f7;padding-top:12px}
.t2 .info li{margin-bottom:8px;word-break:break-word}
.t2 .info b{display:block;font-size:.78rem;color:#7b86b0;font-weight:500}
.t2 h2{font-size:1.1rem;margin:0 0 14px;color:#1d2b64;display:flex;align-items:center;gap:10px}
.t2 h2::before{content:"";width:6px;height:20px;border-radius:3px;background:#3b6fd8}
.t2 .chips{display:flex;flex-wrap:wrap;gap:8px;justify-content:center}
.t2 .chip{background:#e4ebfd;color:#1d2b64;border-radius:99px;padding:4px 14px;font-size:.85rem;font-weight:500}
.t2 .links a{display:block;background:#3b6fd8;color:#fff;border-radius:10px;padding:8px 12px;margin-bottom:8px;text-decoration:none;font-size:.9rem;text-align:center}
.t2 .timeline{border-left:3px solid #d0dafa;padding-left:18px}
.t2 .tl-item{position:relative;margin-bottom:18px}
.t2 .tl-item::before{content:"";position:absolute;left:-26px;top:6px;width:11px;height:11px;border-radius:50%;background:#3b6fd8}
.t2 .tl-item .head{font-weight:600}
.t2 .tl-item .sub{color:#6c78a6;font-size:.88rem}
.t2 .proj-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:14px}
.t2 .proj{background:#f4f6fe;border-radius:12px;padding:16px;border:1px solid #e0e6fa}
.t2 .proj .head{font-weight:600;margin-bottom:4px}
.t2 .proj a{color:#3b6fd8;font-size:.88rem}
.t2 p{line-height:1.7}
@media(max-width:820px){.t2 .layout{grid-template-columns:1fr}}
</style>
<div class="t2">
    <div class="banner"></div>
    <div class="layout">
        <aside>
            <div class="card side">
                @if($p->photo)<img class="avatar" src="{{ $p->photo }}" alt="{{ $p->full_name }}">
                @else<div class="avatar-fallback">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($p->full_name, 0, 1)) }}</div>@endif
                <h1>{{ $p->full_name }}</h1>
                @if($p->tagline)<p class="tag">{{ $p->tagline }}</p>@endif
                <ul class="info">
                    <li><b>Email</b><a href="mailto:{{ $p->email }}">{{ $p->email }}</a></li>
                    <li><b>Phone</b>{{ $p->phone }}</li>
                    <li><b>Address</b>{{ $p->address }}</li>
                </ul>
            </div>
            @if(!empty($p->skills))
            <div class="card"><h2>Skills</h2><div class="chips">@foreach($p->skills as $s)<span class="chip">{{ $s }}</span>@endforeach</div></div>
            @endif
            @if(!empty($p->links))
            <div class="card links"><h2>Links</h2>@foreach($p->links as $l)<a href="{{ $l['url'] }}" target="_blank" rel="noopener">{{ $l['label'] ?: $l['url'] }}</a>@endforeach</div>
            @endif
        </aside>

        <main>
            <div class="card"><h2>About me</h2><p style="margin:0">{!! nl2br(e($p->about)) !!}</p></div>

            @if(!empty($p->experience))
            <div class="card"><h2>Work experience</h2><div class="timeline">
                @foreach($p->experience as $e)
                <div class="tl-item">
                    <div class="head">{{ $e['role'] }}@if($e['company']) &middot; {{ $e['company'] }}@endif</div>
                    @if($e['years'])<div class="sub">{{ $e['years'] }}</div>@endif
                    @if($e['description'])<div>{!! nl2br(e($e['description'])) !!}</div>@endif
                </div>
                @endforeach
            </div></div>
            @endif

            @if(!empty($p->education))
            <div class="card"><h2>Education</h2><div class="timeline">
                @foreach($p->education as $e)
                <div class="tl-item">
                    <div class="head">{{ $e['school'] }}</div>
                    <div class="sub">{{ $e['degree'] }}@if($e['degree'] && $e['years']) &middot; @endif{{ $e['years'] }}</div>
                </div>
                @endforeach
            </div></div>
            @endif

            @if(!empty($p->projects))
            <div class="card"><h2>Projects</h2><div class="proj-grid">
                @foreach($p->projects as $pr)
                <div class="proj">
                    <div class="head">{{ $pr['title'] }}</div>
                    @if($pr['description'])<div style="font-size:.9rem">{!! nl2br(e($pr['description'])) !!}</div>@endif
                    @if($pr['link'])<a href="{{ $pr['link'] }}" target="_blank" rel="noopener">View project</a>@endif
                </div>
                @endforeach
            </div></div>
            @endif
        </main>
    </div>
</div>
