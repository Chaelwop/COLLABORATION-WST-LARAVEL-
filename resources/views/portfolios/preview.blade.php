@extends('layouts.app')
@section('title', $portfolio->full_name . ' - Portfolio')
@section('content')
<div class="previewbar">
    <div>
        Previewing the <strong>{{ \App\Models\Portfolio::TEMPLATE_NAMES[$template] }}</strong> template
        @if($template !== (int) $portfolio->template) (not saved yet) @endif
    </div>
    <div class="actions">
        @if($template !== (int) $portfolio->template)
            <form method="POST" action="{{ route('portfolios.select', $portfolio) }}">
                @csrf
                <input type="hidden" name="template" value="{{ $template }}">
                <button type="submit" class="btn btn-sm">Use this template</button>
            </form>
        @endif
        <a class="btn btn-sm btn-outline" href="{{ route('portfolios.templates', $portfolio) }}">Change template</a>
        <a class="btn btn-sm btn-outline" href="{{ route('portfolios.edit', $portfolio) }}">Edit</a>
        <a class="btn btn-sm btn-outline" href="{{ route('portfolios.index') }}">Manage</a>
    </div>
</div>

@include('themes.t' . $template, ['p' => $portfolio])
@endsection
