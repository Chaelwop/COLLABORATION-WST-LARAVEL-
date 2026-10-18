<div class="row-item">
    <div class="grid">
        @foreach($fields as $f)
            @php
                [$key, $label, $type] = $f;
            @endphp
            <div class="{{ $type === 'textarea' ? 'full' : '' }}">
                <label>{{ $label }}</label>
                @if($type === 'textarea')
                    <textarea name="{{ $name }}[{{ $i }}][{{ $key }}]" rows="3">{{ $row[$key] ?? '' }}</textarea>
                @else
                    <input type="text" name="{{ $name }}[{{ $i }}][{{ $key }}]" value="{{ $row[$key] ?? '' }}">
                @endif
            </div>
        @endforeach
    </div>
    <button type="button" class="btn btn-sm btn-outline remove-row">Remove</button>
</div>
