@extends('layouts.app')
@section('title', $portfolio->exists ? 'Edit portfolio' : 'Create portfolio')
@section('content')
@php
    $editing = $portfolio->exists;
@endphp
<div class="container narrow">
    <h1>{{ $editing ? 'Edit portfolio' : 'Enter your information' }}</h1>
    <p class="lead">Fields marked * are required. Empty rows are ignored when you save.</p>

    @if($errors->any())
        <div class="alert alert-err">
            <strong>Please fix the following:</strong>
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data"
          action="{{ $editing ? route('portfolios.update', $portfolio) : route('portfolios.store') }}">
        @csrf
        @if($editing) @method('PUT') @endif

        <div class="panel">
            <h2>Personal information</h2>
            <div class="grid">
                <div><label for="full_name">Full name *</label>
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $portfolio->full_name) }}" required></div>
                <div><label for="tagline">Headline (e.g. Web Developer)</label>
                    <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $portfolio->tagline) }}"></div>
                <div><label for="email">Email *</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $portfolio->email) }}" required></div>
                <div><label for="phone">Contact number *</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $portfolio->phone) }}" required></div>
                <div class="full"><label for="address">Address *</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $portfolio->address) }}" required></div>
                <div class="full">
                    <label for="photo">Profile picture (JPG, PNG, WEBP or GIF, up to 2 MB)</label>
                    @if($portfolio->photo)
                        <div class="actions" style="margin-bottom:8px">
                            <img class="photo-current" src="{{ $portfolio->photo }}" alt="Current profile picture">
                            <label style="margin:0;font-weight:400"><input type="checkbox" name="remove_photo" value="1"> Remove current picture</label>
                        </div>
                    @endif
                    <input type="file" id="photo" name="photo" accept="image/png,image/jpeg,image/webp,image/gif">
                </div>
                <div class="full"><label for="about">About me *</label>
                    <textarea id="about" name="about" rows="5" required>{{ old('about', $portfolio->about) }}</textarea></div>
                <div class="full"><label for="skills">Skills</label>
                    <input type="text" id="skills" name="skills" value="{{ old('skills', implode(', ', $portfolio->skills ?? [])) }}" placeholder="HTML, CSS, Laravel, Teamwork">
                    <div class="hint">Separate skills with commas.</div></div>
            </div>
        </div>

        @foreach(\App\Models\Portfolio::groups() as $name => [$title, $addLabel, $fields])
            @php
                $rows = old($name, $portfolio->{$name} ?: [[]]);
            @endphp
            <div class="panel">
                <h2>{{ $title }}</h2>
                <div class="rows" id="rows-{{ $name }}">
                    @foreach($rows as $i => $row)
                        @include('portfolios._row', ['name' => $name, 'i' => $i, 'row' => (array) $row, 'fields' => $fields])
                    @endforeach
                </div>
                <template id="tpl-{{ $name }}">
                    @include('portfolios._row', ['name' => $name, 'i' => '__i__', 'row' => [], 'fields' => $fields])
                </template>
                <button type="button" class="btn btn-outline btn-sm add-row" data-group="{{ $name }}">{{ $addLabel }}</button>
            </div>
        @endforeach

        <div class="actions">
            <button type="submit" class="btn">{{ $editing ? 'Save changes' : 'Save and choose template' }}</button>
            <a class="btn btn-outline" href="{{ $editing ? route('portfolios.index') : route('home') }}">Cancel</a>
        </div>
    </form>
</div>

<script>
document.querySelectorAll('.add-row').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var g = btn.dataset.group;
        var html = document.getElementById('tpl-' + g).innerHTML.split('__i__').join('n' + Date.now() + Math.floor(Math.random() * 1000));
        document.getElementById('rows-' + g).insertAdjacentHTML('beforeend', html);
    });
});
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-row')) {
        e.target.closest('.row-item').remove();
    }
});
</script>
@endsection
