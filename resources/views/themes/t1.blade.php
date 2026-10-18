<style>
.t1{background:#fff;color:#222;font-family:'Source Serif 4',Georgia,serif;line-height:1.7;padding:56px 20px 80px}
.t1 .wrap{max-width:720px;margin:0 auto}
.t1 header{text-align:center;margin-bottom:36px}
.t1 .avatar{width:128px;height:128px;border-radius:50%;object-fit:cover;margin:0 auto 16px;display:block;border:1px solid #ddd}
.t1 .avatar-fallback{width:128px;height:128px;border-radius:50%;background:#e8e8e4;color:#555;display:grid;place-items:center;font-size:2.4rem;margin:0 auto 16px}
.t1 h1{font-size:2.4rem;margin:0;font-weight:700;letter-spacing:-.01em}
.t1 .tag{color:#666;font-size:1.15rem;margin:4px 0 12px}
.t1 .contact{color:#555;font-size:.98rem;display:flex;flex-wrap:wrap;gap:4px 18px;justify-content:center}
.t1 .contact a{color:#555}
.t1 section{margin-top:34px;padding-top:20px;border-top:1px solid #ddd}
.t1 h2{font-size:1.3rem;margin:0 0 12px;font-weight:600}
.t1 .item{margin-bottom:16px}
.t1 .item .head{font-weight:600}
.t1 .item .sub{color:#666;font-size:.95rem}
.t1 a{color:#1b4d7a}
.t1 .skills{display:flex;flex-wrap:wrap;gap:8px;list-style:none;padding:0;margin:0}
.t1 .skills li{border:1px solid #ccc;border-radius:4px;padding:2px 12px;font-size:.95rem}
</style>
<div class="t1"><div class="wrap">
    <header>
        @if($p->photo)<img class="avatar" src="{{ $p->photo }}" alt="{{ $p->full_name }}">
        @else<div class="avatar-fallback">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($p->full_name, 0, 1)) }}</div>@endif
        <h1>{{ $p->full_name }}</h1>
        @if($p->tagline)<p class="tag">{{ $p->tagline }}</p>@endif
        <div class="contact">
            <a href="mailto:{{ $p->email }}">{{ $p->email }}</a>
            <span>{{ $p->phone }}</span>
            <span>{{ $p->address }}</span>
        </div>
    </header>

    <section><h2>About me</h2><p>{!! nl2br(e($p->about)) !!}</p></section>

    @if(!empty($p->skills))
    <section><h2>Skills</h2><ul class="skills">@foreach($p->skills as $s)<li>{{ $s }}</li>@endforeach</ul></section>
    @endif

    @if(!empty($p->experience))
    <section><h2>Work experience</h2>
        @foreach($p->experience as $e)
        <div class="item">
            <div class="head">{{ $e['role'] }}@if($e['company']), {{ $e['company'] }}@endif</div>
            @if($e['years'])<div class="sub">{{ $e['years'] }}</div>@endif
            @if($e['description'])<div>{!! nl2br(e($e['description'])) !!}</div>@endif
        </div>
        @endforeach
    </section>
    @endif

    @if(!empty($p->education))
    <section><h2>Education</h2>
        @foreach($p->education as $e)
        <div class="item">
            <div class="head">{{ $e['school'] }}</div>
            <div class="sub">{{ $e['degree'] }}@if($e['degree'] && $e['years']) &middot; @endif{{ $e['years'] }}</div>
        </div>
        @endforeach
    </section>
    @endif

    @if(!empty($p->projects))
    <section><h2>Projects</h2>
        @foreach($p->projects as $pr)
        <div class="item">
            <div class="head">@if($pr['link'])<a href="{{ $pr['link'] }}" target="_blank" rel="noopener">{{ $pr['title'] ?: $pr['link'] }}</a>@else{{ $pr['title'] }}@endif</div>
            @if($pr['description'])<div>{!! nl2br(e($pr['description'])) !!}</div>@endif
        </div>
        @endforeach
    </section>
    @endif

    @if(!empty($p->links))
    <section><h2>Find me online</h2>
        @foreach($p->links as $l)
            <div><a href="{{ $l['url'] }}" target="_blank" rel="noopener">{{ $l['label'] ?: $l['url'] }}</a></div>
        @endforeach
    </section>
    @endif
</div></div>
