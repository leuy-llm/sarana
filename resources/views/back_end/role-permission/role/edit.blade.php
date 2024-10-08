@extends('layout.app')
@section('content')
     @php
    $breadcrumbs = [
        ['title' => __('label.role'), 'url' => route('roles.index')],
        ['title' => __('label.editRole'), 'url' => route('roles.edit', $role->id)]
    ];
    $currentPageTitle = __('label.editRole');
@endphp
@include('layout.breadcrumbs', ['breadcrumbs' => $breadcrumbs, 'currentPageTitle' => $currentPageTitle])
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ url('roles/') }}" class="btn btn-secondary btn-rounded mb-2"> <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" method="POST" action="{{ url('roles/' . $role->id) }}" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label">@lang('label.roleName')</label>
                            <input type="text" value="{{ old('name', $role->name) }}" name="name"
                                class="form-control" placeholder="Full name" required>
                        </div>
                       
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
       
    </script>
@endsection
