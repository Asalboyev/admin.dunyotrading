@foreach ($categories as $subCategory)
    @if ($subCategory->parent_id == $parent_id)
        <option value="{{ $subCategory->id }}"
            {{ (old('parent_id') ?? $selected_id) == $subCategory->id ? 'selected' : '' }}>
            {!! str_repeat('&nbsp;&nbsp;&nbsp;', $level) !!} ├ {{ $subCategory->title[$main_lang->code] }}
        </option>
        {{-- Rekursiv chaqiruv --}}
        @include('app.products_categories.category-options-edit', [
            'categories' => $categories,
            'parent_id' => $subCategory->id,
            'level' => $level + 1,
            'selected_id' => $selected_id
        ])
    @endif
@endforeach
