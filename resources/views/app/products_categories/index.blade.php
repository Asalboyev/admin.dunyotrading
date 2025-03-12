@extends('layouts.app')

@section('content')
<!-- HEADER -->
<div class="header">
    <div class="container-fluid">

        <!-- Body -->
        <div class="header-body">
            <div class="row align-items-end">
                <div class="col">

                    <!-- Title -->
                    <h1 class="header-title">
                        {{ $title }}
                    </h1>

                </div>
                <div class="col-auto">

                    <!-- Button -->
                    <a href="{{ route($route_name.'.create') }}" class="btn btn-primary lift">
                        Добавить
                    </a>

                </div>
            </div> <!-- / .row -->
        </div> <!-- / .header-body -->
        @include('app.components.breadcrumb', [
        'datas' => [
        [
        'active' => true,
        'url' => '',
        'name' => $title,
        'disabled' => false
        ]
        ]
        ])
    </div>
</div> <!-- / .header -->

<!-- CARDS -->
<div class="container-fluid">
    <div class="card mt-4">
        <div class="card-body">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Родительская категория</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($educational_programs as $programItem)
                        <tr>
                            <td>{{ $programItem['menu']->id ?? '-' }}</td>
                            <td><strong>{{ $programItem['menu']->title[$languages->first()->code] ?? 'No Name' }}</strong></td>
                            <td>Parent Category</td>

                            <td>
                                <a href="{{ route('products_categories.edit', $programItem['menu']->id) }}" class="btn btn-sm btn-info">
                                    <i class="fe fe-edit-2"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger"
                                   onclick="if(confirm('Are you sure?')) { event.preventDefault(); document.getElementById('delete-form-{{ $programItem['menu']->id }}').submit(); }">
                                    <i class="fe fe-trash"></i>
                                </a>
                                <form id="delete-form-{{ $programItem['menu']->id }}" action="{{ route($route_name.'.destroy', $programItem['menu']->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>

                        {{-- Sub-kategoriyalar --}}
                        @if (!empty($programItem['children']))
                            @foreach ($programItem['children'] as $child)
                                <tr>
                                    <td>{{ $child['menu']->id ?? '-' }}</td>
                                    <td>&mdash; {{ $child['menu']->title[$languages->first()->code] ?? 'No Name' }}</td>
                                    <td>{{ $programItem['menu']->title[$languages->first()->code] ?? 'No Parent' }}</td>

                                    <td>
                                        <a href="{{ route('products_categories.edit', $child['menu']->id) }}" class="btn btn-sm btn-info">
                                            <i class="fe fe-edit-2"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-danger"
                                           onclick="if(confirm('Are you sure?')) { event.preventDefault(); document.getElementById('delete-form-{{ $child['menu']->id }}').submit(); }">
                                            <i class="fe fe-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $child['menu']->id }}" action="{{ route($route_name.'.destroy', $child['menu']->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                {{-- Sub-sub-kategoriyalar --}}
                                @if (!empty($child['children']))
                                    @foreach ($child['children'] as $subChild)
                                        <tr>
                                            <td>{{ $subChild['menu']->id ?? '-' }}</td>
                                            <td>&mdash;&mdash; {{ $subChild['menu']->title[$languages->first()->code] ?? 'No Name' }}</td>
                                            <td>{{ $child['menu']->title[$languages->first()->code] ?? 'No Parent' }}</td>

                                            <td>
                                                <a href="{{ route('products_categories.edit', $subChild['menu']->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fe fe-edit-2"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-danger"
                                                   onclick="if(confirm('Are you sure?')) { event.preventDefault(); document.getElementById('delete-form-{{ $subChild['menu']->id }}').submit(); }">
                                                    <i class="fe fe-trash"></i>
                                                </a>
                                                <form id="delete-form-{{ $subChild['menu']->id }}" action="{{ route($route_name.'.destroy', $subChild['menu']->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                    {{ $count->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
{{--<td style="width: 200px">--}}
{{--    <div class="d-flex justify-content-end">--}}
{{--        <a href="{{ route('products_categories.edit', [$route_parameter => $item]) }}" class="btn btn-sm btn-info"><i class="fe fe-edit-2"></i></a>--}}
{{--        <a class="btn btn-sm btn-danger ms-3" onclick="var result = confirm('Want to delete?');if (result){event.preventDefault();document.getElementById('delete-form{{ $item->id }}').submit();}"><i class="fe fe-trash"></i></a>--}}
{{--        <form action="{{ route($route_name.'.destroy', [$route_parameter => $item]) }}" id="delete-form{{ $item->id }}" method="POST" style="display: none;">--}}
{{--            @csrf--}}
{{--            @method('DELETE')--}}
{{--        </form>--}}
{{--    </div>--}}
{{--</td>--}}
