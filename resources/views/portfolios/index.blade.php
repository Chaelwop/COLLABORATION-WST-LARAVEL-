@extends('layouts.app')
@section('title', 'My portfolios')
@section('content')
<div class="container">
    <div class="list-item" style="margin-bottom:20px">
        <div>
            <h1>My portfolios</h1>
            <p class="lead" style="margin:0">View, edit or delete the portfolios saved in the database.</p>
        </div>
        <a class="btn" href="{{ route('portfolios.create') }}">Create portfolio</a>
    </div>

    @forelse($portfolios as $p)
        <div class="panel list-item">
            <div>
                <strong style="font-size:1.1rem">{{ $p->full_name }}</strong>
                <span class="badge">{{ \App\Models\Portfolio::TEMPLATE_NAMES[$p->template] ?? 'Simple' }} template</span><br>
                <span style="color:var(--muted)">{{ $p->email }} &middot; updated {{ $p->updated_at->diffForHumans() }}</span>
            </div>
            <div class="actions">
                <a class="btn btn-sm" href="{{ route('portfolios.preview', $p) }}">View</a>
                <a class="btn btn-sm btn-outline" href="{{ route('portfolios.templates', $p) }}">Change template</a>
                <a class="btn btn-sm btn-outline" href="{{ route('portfolios.edit', $p) }}">Edit</a>
                <form method="POST" action="{{ route('portfolios.destroy', $p) }}" style="margin:0" onsubmit="return confirm('Delete this portfolio permanently?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="panel">
            <h2>No portfolios yet</h2>
            <p>Create your first portfolio to see it here.</p>
            <a class="btn" href="{{ route('portfolios.create') }}">Create portfolio</a>
        </div>
    @endforelse
</div>
@endsection
