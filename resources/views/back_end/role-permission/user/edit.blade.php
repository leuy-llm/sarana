@extends('layout.app')
@section('style')
@endsection
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.room'), 'url' => route('rooms.index')],
            ['title' => __('label.editRoom'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.editRooms');
    @endphp
    @include('layout.breadcrumbs', [
        'breadcrumbs' => $breadcrumbs,
        'currentPageTitle' => $currentPageTitle,
    ])

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-4">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-rounded mb-2"><span
                                class=" uil-corner-up-left"></span> @lang('label.back')</a>
                    </div>
                </div>
                <form class="needs-validation" enctype="multipart/form-data" action="{{ url('users/' . $user->id) }}"
                    method="POST" novalidate="">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.userName')</label>
                                <input type="text" name="name"  value="{{ old('name', $user->name) }}"
                                    class="form-control  @error('name') is-invalid @enderror "
                                    placeholder="@lang('label.enterUserName') . . ." required="">
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.fullName') <span class="text-danger">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name',$user->full_name) }}"
                                    class="form-control  @error('full_name') is-invalid @enderror "
                                    placeholder="@lang('label.enterFullname') . . ." required="">
                                @error('full_name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3 ">
                                <label class="form-label">@lang('label.dob') <span class="text-danger">*</span></label>
                                <input type="date" id="datepicker" name="DateOfBirth"
                                    value="{{ old('DateOfBirth',$user->DateOfBirth) }}"
                                    class="form-control  @error('DateOfBirth') is-invalid @enderror "
                                    placeholder="@lang('label.enterDob') . . ." required="">
                                @error('DateOfBirth')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.gender') <span class="text-danger">*</span></label>
                                <div class="mt-1">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="male" name="gender" value="male" class="form-check-input" {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }}>
                                        <label class="form-check-label" style="margin-top: 2px;">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="female" name="gender" value="female" class="form-check-input" {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                                        <label class="form-check-label" style="margin-top: 2px;">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="other" name="gender" value="other" class="form-check-input" {{ old('gender', $user->gender) == 'other' ? 'checked' : '' }}>
                                        <label class="form-check-label" style="margin-top: 2px;">Other</label>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.phone') <span class="text-danger">*</span></label>
                                <input type="number" value="{{ old('phone', $user->phone) }}" name="phone"
                                    class="form-control  @error('phone') is-invalid @enderror "
                                    placeholder="@lang('label.enterPhone') . . ." required="">
                                @error('phone')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.email') <span class="text-danger">*</span></label>
                                <input type="email" value="{{ old('email', $user->email) }}" name="email"
                                    class="form-control  @error('email') is-invalid @enderror "
                                    placeholder="@lang('label.enterEmail') . . ." required="">
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">@lang('label.password')</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password"
                                        class="form-control @error('password') is-invalid @enderror "
                                        placeholder="@lang('label.enterPassword') . . . " >
                                        
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                    
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.role') <span
                                        class="text-danger">*</span></label>
                                <select name="roles[]" data-toggle="select2" multiple="multiple"
                                    data-placeholder="Choose Role . . ."
                                    class="form-control select2-multiple @error('roles') is-invalid @enderror"
                                    required>
                                    {{-- @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ in_array($role->id, old('roles', [])) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach --}}

                                    @foreach ($roles as $role)
                                    <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                        {{ $role }}
                                    </option>
                                    @endforeach

                                </select>
                                @error('roles')
                                    <span class="invalid-feedback d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">@lang('label.address') <span
                                        class="text-danger">*</span></label>
                                <textarea name="address" class="form-control" required placeholder="@lang('label.enterAddress') . . .">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <button class="btn btn-primary btn-rounded" type="submit">@lang('label.submit')</button>
                    <a href="{{ url('users') }}" class="btn btn-light btn-rounded ">@lang('label.cancel')</a>
                </form>
            </div>
        </div>

    </div>

</div>
@endsection
@section('script')
    <script></script>
@endsection
