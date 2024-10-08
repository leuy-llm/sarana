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
                    <div class="d-flex justify-content-between  mb-2">
                        <div class="">
                            <div class="card-title">@lang('label.role') : {{$role->name}}</div>
                        </div>
                        <div class="">
                            <a href="{{ url('roles/') }}" class="btn btn-secondary btn-rounded mb-2"> <span class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" method="POST" action="{{url('roles/'.$role->id.'/give-permissions')}}" novalidate>
                        @csrf
                        @method('PUT')
                        <label class="form-label">@lang('label.PermissionName')</label>
                        <div class="mb-3 mt-2 row ">
                            @foreach ($permissions as $permission)
                                <div class="form-check col-sm-6 col-md-3 mb-2">
                                    <input type="checkbox" class="form-check-input" value="{{$permission->name}}" {{in_array($permission->id,$rolePermissions) ? 'checked':''}} name="permission[]">
                                    <label class="form-check-label" for="" style="margin-top: 1px">{{$permission->name}}</label>
                                </div>
                            @endforeach
                            
                        </div>
                       
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
                        <a href="{{ route('roles.index') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
                    </form>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
       
    </script>
@endsection
