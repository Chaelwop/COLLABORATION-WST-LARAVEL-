<style>
.t3{background:#ffd23f;color:#1c1c1c;font-family:'Space Grotesk',system-ui,sans-serif;padding:40px 20px 90px;overflow:hidden}
.t3 .wrap{max-width:1080px;margin:0 auto}
.t3 .hero{display:grid;grid-template-columns:1fr 280px;gap:30px;align-items:center;margin-bottom:46px}
.t3 .name{font-family:'Archivo Black',sans-serif;font-size:clamp(2.6rem,9vw,6rem);line-height:.95;text-transform:uppercase;margin:0;word-break:break-word}
.t3 .tag{font-size:1.4rem;font-weight:700;margin:14px 0 0;background:#1c1c1c;color:#ffd23f;display:inline-block;padding:4px 14px}
.t3 .photo{width:260px;height:310px;object-fit:cover;border:5px solid #1c1c1c;transform:rotate(5deg);box-shadow:10px 10px 0 #1c1c1c;background:#ff5d73;display:block}
.t3 .photo-fallback{width:260px;height:310px;border:5px solid #1c1c1c;transform:rotate(5deg);box-shadow:10px 10px 0 #1c1c1c;background:#ff5d73;display:grid;place-items:center;font-family:'Archivo Black',sans-serif;font-size:6rem}
.t3 .block{border:4px solid #1c1c1c;box-shadow:8px 8px 0 #1c1c1c;padding:22px;margin-bottom:34px;background:#fff}
.t3 .block h2{font-family:'Archivo Black',sans-serif;text-transform:uppercase;font-size:1.6rem;margin:0 0 14px}
.t3 .b-about{background:#fff;transform:rotate(-.6deg)}
.t3 .b-skills{background:#6ee7c8}
.t3 .b-contact{background:#ff5d73}
.t3 .two{display:grid;grid-template-columns:1fr 1fr;gap:34px}
.t3 .word{display:inline-block;font-family:'Archivo Black',sans-serif;font-size:1.3rem;border:3px solid #1c1c1c;background:#fff;padding:4px 14px;margin:0 8px 10px 0;transform:rotate(-2deg)}
.t3 .word:nth-child(even){transform:rotate(2deg);background:#ffd23f}
.t3 .strip{border-top:4px solid #1c1c1c;padding:14px 0}
.t3 .strip:first-of-type{border-top:0;padding-top:0}
.t3 .strip .head{font-weight:700;font-size:1.15rem}
.t3 .strip .sub{display:inline-block;background:#1c1c1c;color:#fff;padding:0 10px;font-size:.85rem;margin:4px 0}
.t3 .tiles{display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:22px}
.t3 .tile{border:4px solid #1c1c1c;box-shadow:6px 6px 0 #1c1c1c;padding:16px;background:#fff}
.t3 .tile:nth-child(3n+1){background:#ff9bb0}
.t3 .tile:nth-child(3n+2){background:#a8f0dd}
.t3 .tile .head{font-family:'Archivo Black',sans-serif;font-size:1.15rem;text-transform:uppercase}
.t3 a{color:#1c1c1c;font-weight:700}
.t3 .contact-line{font-size:1.1rem;font-weight:700;margin-bottom:6px;word-break:break-word}
.t3 .link-btn{display:inline-block;background:#1c1c1c;color:#fff;padding:6px 14px;margin:0 8px 8px 0;text-decoration:none}
@media(max-width:820px){.t3 .hero,.t3 .two{grid-template-columns:1fr}.t3 .photo,.t3 .photo-fallback{width:200px;height:240px}}
</style>
<div class="t3"><div class="wrap">
    <div class="hero">
        <div>
            <h1 class="name">{{ $p->full_name }}</h1>
            @if($p->tagline)<p class="tag">{{ $p->tagline }}</p>@endif
        </div>
        <div>
            @if($p->photo)<img class="photo" src="{{ $p->photo }}" alt="{{ $p->full_name }}">
            @else<div class="photo-fallback">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($p->full_name, 0, 1)) }}</div>@endif
        </div>
    </div>

    <div class="block b-about"><h2>Hello, it's me</h2><div style="font-size:1.1rem">{!! nl2br(e($p->about)) !!}</div></div>

    @if(!empty($p->skills))
    <div class="block b-skills"><h2>What I do well</h2>@foreach($p->skills as $s)<span class="word">{{ $s }}</span>@endforeach</div>
    @endif

    <div class="two">
        @if(!empty($p->experience))
        <div class="block" style="margin-bottom:0"><h2>Work</h2>
            @foreach($p->experience as $e)
            <div class="strip">
                <div class="head">{{ $e['role'] }}</div>
                @if($e['company'] || $e['years'])<div class="sub">{{ $e['company'] }}@if($e['company'] && $e['years']) / @endif{{ $e['years'] }}</div>@endif
                @if($e['description'])<div>{!! nl2br(e($e['description'])) !!}</div>@endif
            </div>
            @endforeach
        </div>
        @endif
        @if(!empty($p->education))
        <div class="block" style="margin-bottom:0"><h2>School</h2>
            @foreach($p->education as $e)
            <div class="strip">
                <div class="head">{{ $e['school'] }}</div>
                @if($e['degree'] || $e['years'])<div class="sub">{{ $e['degree'] }}@if($e['degree'] && $e['years']) / @endif{{ $e['years'] }}</div>@endif
            </div>
            @endforeach
        </div>
        @endif
    </div>

    @if(!empty($p->projects))
    <h2 style="font-family:'Archivo Black',sans-serif;text-transform:uppercase;font-size:2rem;margin:44px 0 18px">Things I made</h2>
    <div class="tiles" style="margin-bottom:44px">
        @foreach($p->projects as $pr)
        <div class="tile">
            <div class="head">{{ $pr['title'] }}</div>
            @if($pr['description'])<div style="margin:6px 0">{!! nl2br(e($pr['description'])) !!}</div>@endif
            @if($pr['link'])<a href="{{ $pr['link'] }}" target="_blank" rel="noopener">Open project</a>@endif
        </div>
        @endforeach
    </div>
    @endif

    <div class="block b-contact">
        <h2>Let's talk</h2>
        <div class="contact-line"><a href="mailto:{{ $p->email }}">{{ $p->email }}</a></div>
        <div class="contact-line">{{ $p->phone }}</div>
        <div class="contact-line" style="margin-bottom:14px">{{ $p->address }}</div>
        @foreach($p->links ?? [] as $l)<a class="link-btn" href="{{ $l['url'] }}" target="_blank" rel="noopener">{{ $l['label'] ?: $l['url'] }}</a>@endforeach
    </div>
</div></div>
