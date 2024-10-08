<!-- =========== Edit Setting ==============-->
@extends('layout.app')
@section('content')
    @php
        $breadcrumbs = [
            ['title' => __('label.roomType'), 'url' => route('rooms.index')],
            ['title' => __('label.editRoomType'), 'url' => route('rooms.create')],
        ];
        $currentPageTitle = __('label.editRoomTypes');
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
                            <a href="{{ url('settings') }}" class="btn btn-danger btn-rounded mb-2"> <span
                                    class=" uil-corner-up-left"></span> @lang('label.back')</a>
                        </div>
                    </div>
                    <form class="needs-validation" method="POST" action="{{ route('contacts.update', $contact->id) }}"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="input-group flex-nowrap">
                                        <label class="form-label">@lang('label.address') <span class="text-danger">*</span></label>
                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-phone text-primary"></i></span>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $contact->address) }}" placeholder="Site title..."
                                        required>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.socialLink') <span class="text-danger">*</span></label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-office-building-marker-outline text-primary"></i></span>
                                        <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address', $contact->address) }}" placeholder="Site title..."
                                        required>
                                    @error('address')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>                                                
                                </div>                                               
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.googleMap') <span class="text-danger">*</span></label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-map-marker-radius-outline text-danger"></i></span>
                                        <input type="text" name="gmap"
                                        class="form-control @error('gmap') is-invalid @enderror"
                                        value="{{ old('gmap', $contact->gmap) }}" placeholder="Site title..." required>
                                    @error('gmap')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                   
                                    
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label" style="margin-bottom: 9px;">@lang('label.phones') <span class="text-danger">*</span></label>
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-phone text-primary"></i></span>
                                                        <input type="text" name="pn1"
                                                        class="form-control @error('pn1') is-invalid @enderror"
                                                        value="{{ old('pn1', $contact->pn1) }}" placeholder="Site title..." required>
                                                    @error('pn1')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>                                                
                                                </div>                                               
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-2" style="margin-top: 30px;">
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-phone text-primary"></i></span>
                                                        <input type="text" name="pn2"
                                                            class="form-control @error('pn1') is-invalid @enderror"
                                                            value="{{ old('pn2', $contact->pn2) }}" placeholder="Site title..." required>
                                                        @error('pn2')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-phone text-primary"></i></span>
                                                        <input type="text" name="pn3"
                                                        class="form-control @error('pn3') is-invalid @enderror"
                                                        value="{{ old('pn3', $contact->pn3) }}" required>
                                                    @error('pn3')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    </div>


                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">@lang('label.socialLink') <span class="text-danger">*</span></label>
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-facebook text-primary"></i></span>
                                                        <input type="text" name="fb" value="{{ old('fb', $contact->fb) }}" class="form-control @error('fb') is-invalid @enderror" aria-label="Username" aria-describedby="basic-addon1">
                                                        @error('fb')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>                                                
                                                </div>                                               
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="mb-2" style="margin-top: 28px;">
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-facebook text-primary"></i></span>
                                                        <input type="text" name="tripa" value="{{ old('tripa', $contact->tripa) }}" class="form-control @error('tripa') is-invalid @enderror" aria-label="Username" aria-describedby="basic-addon1">
                                                        @error('tripa')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                  
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-instagram text-warning"></i></span>
                                                        <input type="text" name="insta"
                                                        class="form-control @error('insta') is-invalid @enderror"
                                                        value="{{ old('insta', $contact->insta) }}" required>
                                                    @error('insta')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-2">
                                                    <div class="input-group flex-nowrap">
                                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-telegram text-primary"></i></span>
                                                    <input type="text" name="tele"
                                                        class="form-control @error('tele') is-invalid @enderror"
                                                        value="{{ old('insta', $contact->tele) }}" required>
                                                    @error('tele')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.email') <span class="text-danger">*</span></label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-email text-primary"></i></span>
                                        <input type="text" name="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email', $contact->email) }}" required>
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">@lang('label.iFrame') <span class="text-danger">*</span></label>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-map text-primary"></i></span>
                                        <input type="text" name="iframe"
                                        class="form-control @error('iframe') is-invalid @enderror"
                                        value="{{ old('iframe', $contact->iframe) }}" required>
                                    @error('iframe')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-rounded" type="submit">@lang('label.update')</button>
                        <a href="{{ url('settings') }}" class="btn btn-light btn-rounded">@lang('label.cancel')</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
