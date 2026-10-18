@extends('layouts.app')
@section('title', 'Choose a template')
@section('content')
<div class="container">
    <h1>Choose a template for {{ $portfolio->full_name }}</h1>
    <p class="lead">Preview each design with your own information, then pick the one you like.</p>

    @php
    $cards = [
        1 => ['Simple', 'Clean and professional. One calm column, easy to read.'],
        2 => ['Modern', 'Cards, a profile sidebar and colour banner.'],
        3 => ['Creative', 'Bold blocks, big type and a playful layout.'],
    ];
    @endphp

    <div class="tpl-grid">
        @foreach($cards as $n => [$label, $desc])
            <div class="tpl-card {{ (int) $portfolio->template === $n ? 'active' : '' }}">
                <div class="thumb" aria-hidden="true">
                    @if($n === 1)
                        <div style="background:#fff;height:100%;padding:18px;text-align:center">
                            <div style="width:42px;height:42px;border-radius:50%;background:#cfd6d4;margin:0 auto 8px"></div>
                            <div style="height:8px;width:50%;background:#333;margin:0 auto 6px"></div>
                            <div style="height:5px;width:35%;background:#bbb;margin:0 auto 14px"></div>
                            <div style="height:1px;background:#ccc;margin-bottom:8px"></div>
                            <div style="height:5px;background:#ddd;margin-bottom:5px"></div><div style="height:5px;width:80%;background:#ddd;margin-bottom:5px"></div><div style="height:5px;width:60%;background:#ddd"></div>
                        </div>
                    @elseif($n === 2)
                        <div style="background:#eaeefa;height:100%">
                            <div style="height:55px;background:linear-gradient(120deg,#1d2b64,#3b6fd8)"></div>
                            <div style="display:flex;gap:8px;padding:0 10px;margin-top:-18px">
                                <div style="width:34%;background:#fff;border-radius:8px;height:95px;box-shadow:0 2px 6px rgba(0,0,0,.12)"></div>
                                <div style="flex:1"><div style="background:#fff;border-radius:8px;height:44px;margin-bottom:7px;box-shadow:0 2px 6px rgba(0,0,0,.12)"></div><div style="background:#fff;border-radius:8px;height:44px;box-shadow:0 2px 6px rgba(0,0,0,.12)"></div></div>
                            </div>
                        </div>
                    @else
                        <div style="background:#ffd23f;height:100%;padding:14px;position:relative">
                            <div style="font-family:'Archivo Black',sans-serif;font-size:30px;line-height:.95;color:#1c1c1c;width:60%">YOUR NAME</div>
                            <div style="position:absolute;right:16px;top:14px;width:56px;height:68px;background:#ff5d73;border:3px solid #1c1c1c;transform:rotate(6deg)"></div>
                            <div style="position:absolute;left:14px;bottom:14px;width:46%;height:46px;background:#fff;border:3px solid #1c1c1c;box-shadow:4px 4px 0 #1c1c1c"></div>
                            <div style="position:absolute;right:14px;bottom:20px;width:34%;height:40px;background:#6ee7c8;border:3px solid #1c1c1c;box-shadow:4px 4px 0 #1c1c1c"></div>
                        </div>
                    @endif
                </div>
                <h2 style="margin-bottom:4px">{{ $label }} @if((int) $portfolio->template === $n)<span class="badge">Current</span>@endif</h2>
                <p style="margin:0 0 14px;color:var(--muted)">{{ $desc }}</p>
                <div class="actions">
                    <a class="btn btn-outline btn-sm" href="{{ route('portfolios.preview', ['portfolio' => $portfolio, 'template' => $n]) }}">Preview</a>
                    <form method="POST" action="{{ route('portfolios.select', $portfolio) }}" style="margin:0">
                        @csrf
                        <input type="hidden" name="template" value="{{ $n }}">
                        <button type="submit" class="btn btn-sm">Use this template</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <p style="margin-top:24px"><a href="{{ route('portfolios.edit', $portfolio) }}">Edit information</a> &middot; <a href="{{ route('portfolios.index') }}">Manage portfolios</a></p>
</div>
@endsection
